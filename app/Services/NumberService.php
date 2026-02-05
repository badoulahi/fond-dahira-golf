<?php

namespace App\Services;

class NumberService
{
    public function generateNextCode(string $currentCode, string $prefix): string
    {
        // Construire la base : etu-YY-mm-
        $chaine = $prefix . "-" . substr(date('Y'), 2) . "-" . date('m') . "-";

        // Si aucun code existant, on commence à 1
        if (!$currentCode) {
            $nombre = 1;
        } else {
            // Extraire la partie numérique après le prefix-YY-mm-
            $nombre = (int) substr($currentCode, strlen($chaine)) + 1;
        }

        // Ajout des zéros devant selon la taille
        if ($nombre < 10) {
            $zero = "0000";
        } elseif ($nombre < 100) {
            $zero = "000";
        } elseif ($nombre < 1000) {
            $zero = "00";
        } elseif ($nombre < 10000) {
            $zero = "0";
        } else {
            $zero = "";
        }

        return $chaine . $zero . $nombre;
    }
}
