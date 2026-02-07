<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Mensualite extends Model
{
    protected $fillable = ["engagement", "annee", "jan", "feb", "mar", "apr", "may", "jun", "jul", "aug", "sep", "oct", "nov", "dec", "membre_id"];
    public function membre()
    {
        return $this->belongsTo(Membre::class);
    }

    public function total()
    {
        return
            $this->jan +
            $this->feb +
            $this->mar +
            $this->apr +
            $this->may +
            $this->jun +
            $this->jul +
            $this->aug +
            $this->sep +
            $this->oct +
            $this->nov +
            $this->dec;
    }

    public function mensuel($mois)
    {
        return $this->{Str::lower($mois)};
    }
}
