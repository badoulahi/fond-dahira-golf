<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Membre extends Model
{
    protected $fillable = ['slug', 'nom_complet', 'engagement'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($membre) {
            $membre->slug = self::generateUniqueSlug($membre->nom_complet);
        });

        static::updating(function ($membre) {
            if ($membre->isDirty('nom_complet')) {
                $membre->slug = self::generateUniqueSlug($membre->nom_complet, $membre->id);
            }
        });
    }

    /**
     * Génère un slug unique
     */
    private static function generateUniqueSlug(string $nom_complet, ?int $excludeId = null): string
    {
        $slug = Str::slug($nom_complet);
        $original = $slug;
        $count = 2;

        $query = self::where('slug', $slug);

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        while ($query->exists()) {
            $slug = $original . '-' . $count++;
            $query = self::where('slug', $slug);

            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }
        }

        return $slug;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function mensualites()
    {
        return $this->hasMany(Mensualite::class);
    }
}
