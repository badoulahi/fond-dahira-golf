<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    /**
     * Redimensionner et sauvegarder une image
     *
     * @param UploadedFile $file Le fichier uploadé
     * @param string $directory Le répertoire de destination (ex: 'slides', 'products')
     * @param int $width Largeur souhaitée
     * @param int $height Hauteur souhaitée
     * @param string|null $filename Nom personnalisé (optionnel)
     * @return string|false Le nom du fichier sauvé ou false en cas d'erreur
     */
    public function resizeAndStore(
        UploadedFile $file,
        string $directory,
        int $width,
        int $height,
        string $filename = null
    ) {
        try {
            // Générer un nom de fichier unique si non fourni
            if (!$filename) {
                $filename = 'img-' . time() . '.' . $file->getClientOriginalExtension();
            }

            // Chemin complet dans public
            $publicPath = public_path("uploads/{$directory}");

            // Créer le répertoire s'il n'existe pas
            if (!file_exists($publicPath)) {
                mkdir($publicPath, 0755, true);
            }

            $destinationPath = $publicPath . '/' . $filename;

            // Redimensionner l'image
            $this->resizeImage($file->getRealPath(), $destinationPath, $width, $height);

            // Retourner le chemin relatif pour la base de données
            return $filename;

        } catch (\Exception $e) {
            \Log::error('Erreur lors du redimensionnement de l\'image: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Sauvegarder une image sans redimensionnement
     *
     * @param UploadedFile $file
     * @param string $directory
     * @param string|null $filename
     * @return string|false
     */
    public function store(
        UploadedFile $file,
        string $directory,
        string $filename = null
    ) {
        try {
            if (!$filename) {
                $filename = $directory . '-' . time() . '.' . $file->getClientOriginalExtension();
            }

            // Chemin complet dans public
            $publicPath = public_path("uploads/{$directory}");

            // Créer le répertoire s'il n'existe pas
            if (!file_exists($publicPath)) {
                mkdir($publicPath, 0755, true);
            }

            $destinationPath = $publicPath . '/' . $filename;

            // Déplacer le fichier
            $file->move($publicPath, $filename);

            return "uploads/{$directory}/" . $filename;

        } catch (\Exception $e) {
            \Log::error('Erreur lors de la sauvegarde de l\'image: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Supprimer une image du stockage
     *
     * @param string $path Chemin relatif de l'image depuis public/
     * @return bool
     */
    public function delete(string $path): bool
    {
        try {
            $fullPath = public_path($path);

            if (file_exists($fullPath)) {
                return unlink($fullPath);
            }
            return true;
        } catch (\Exception $e) {
            \Log::error('Erreur lors de la suppression de l\'image: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Obtenir l'URL publique d'une image
     *
     * @param string $path Chemin relatif de l'image depuis public/
     * @return string
     */
    public function getUrl(string $path): string
    {
        return asset($path);
    }

    /**
     * Redimensionner une image avec les fonctions PHP natives
     */
    private function resizeImage($sourcePath, $destinationPath, $newWidth, $newHeight)
    {
        // Obtenir les informations de l'image source
        list($originalWidth, $originalHeight, $imageType) = getimagesize($sourcePath);

        // Créer une resource image selon le type
        switch ($imageType) {
            case IMAGETYPE_JPEG:
                $sourceImage = imagecreatefromjpeg($sourcePath);
                break;
            case IMAGETYPE_PNG:
                $sourceImage = imagecreatefrompng($sourcePath);
                break;
            case IMAGETYPE_GIF:
                $sourceImage = imagecreatefromgif($sourcePath);
                break;
            default:
                throw new \Exception('Type d\'image non supporté');
        }

        // Créer une nouvelle image avec les dimensions souhaitées
        $destinationImage = imagecreatetruecolor($newWidth, $newHeight);

        // Préserver la transparence pour PNG
        if ($imageType == IMAGETYPE_PNG) {
            imagealphablending($destinationImage, false);
            imagesavealpha($destinationImage, true);
            $transparent = imagecolorallocatealpha($destinationImage, 0, 0, 0, 127);
            imagefill($destinationImage, 0, 0, $transparent);
        }

        // Redimensionner l'image
        imagecopyresampled(
            $destinationImage,
            $sourceImage,
            0,
            0,
            0,
            0,
            $newWidth,
            $newHeight,
            $originalWidth,
            $originalHeight
        );

        // Sauvegarder l'image selon le type
        switch ($imageType) {
            case IMAGETYPE_JPEG:
                imagejpeg($destinationImage, $destinationPath, 90);
                break;
            case IMAGETYPE_PNG:
                imagepng($destinationImage, $destinationPath);
                break;
            case IMAGETYPE_GIF:
                imagegif($destinationImage, $destinationPath);
                break;
        }

        // Libérer la mémoire
        imagedestroy($sourceImage);
        imagedestroy($destinationImage);

        /*
        $logoPath = public_path('uploads/logo.png'); // Chemin de ton logo
        if (file_exists($logoPath)) {
            $this->addWatermark($destinationPath, $logoPath);
        }
            */

        return true;
    }

    /**
     * Redimensionner en gardant les proportions
     */
    public function resizeAndStoreWithRatio(
        UploadedFile $file,
        string $directory,
        int $maxWidth,
        int $maxHeight,
        string $filename = null
    ) {
        try {
            if (!$filename) {
                $filename = $directory . '-' . time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            }

            $publicPath = public_path("uploads/{$directory}");

            if (!file_exists($publicPath)) {
                mkdir($publicPath, 0755, true);
            }

            $destinationPath = $publicPath . '/' . $filename;

            // Calculer les nouvelles dimensions en gardant le ratio
            list($originalWidth, $originalHeight) = getimagesize($file->getRealPath());

            $ratio = min($maxWidth / $originalWidth, $maxHeight / $originalHeight);
            $newWidth = (int) ($originalWidth * $ratio);
            $newHeight = (int) ($originalHeight * $ratio);

            $this->resizeImage($file->getRealPath(), $destinationPath, $newWidth, $newHeight);

            return "uploads/{$directory}/" . $filename;

        } catch (\Exception $e) {
            \Log::error('Erreur lors du redimensionnement avec ratio: ' . $e->getMessage());
            return false;
        }
    }

    private function addWatermark($destinationPath, $logoPath)
    {
        // Charger l'image principale
        $mainImage = imagecreatefromstring(file_get_contents($destinationPath));

        // Charger le logo (PNG recommandé)
        $logo = imagecreatefrompng($logoPath);

        // Dimensions originales du logo
        $logoWidth = imagesx($logo);
        $logoHeight = imagesy($logo);

        // Augmenter la taille du logo par 2
        $newLogoWidth = $logoWidth * 2;
        $newLogoHeight = $logoHeight * 2;

        // Créer un logo redimensionné
        $resizedLogo = imagecreatetruecolor($newLogoWidth, $newLogoHeight);

        // Préserver la transparence du logo
        imagealphablending($resizedLogo, false);
        imagesavealpha($resizedLogo, true);
        $transparent = imagecolorallocatealpha($resizedLogo, 0, 0, 0, 127);
        imagefill($resizedLogo, 0, 0, $transparent);

        // Redimensionner le logo
        imagecopyresampled(
            $resizedLogo,
            $logo,
            0,
            0,
            0,
            0,
            $newLogoWidth,
            $newLogoHeight,
            $logoWidth,
            $logoHeight
        );

        // Dimensions de l'image principale
        $mainWidth = imagesx($mainImage);

        // Position : en haut à droite avec marge de 10px
        $x = $mainWidth - $newLogoWidth - 10;
        $y = 10;

        // Coller le logo sur l'image principale
        imagecopy($mainImage, $resizedLogo, $x, $y, 0, 0, $newLogoWidth, $newLogoHeight);

        // Sauvegarder l'image finale
        imagepng($mainImage, $destinationPath);

        // Libérer la mémoire
        imagedestroy($mainImage);
        imagedestroy($logo);
        imagedestroy($resizedLogo);
    }
}
