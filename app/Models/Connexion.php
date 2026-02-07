<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Connexion extends Model
{
    protected $fillable = ['membre_id', 'date_connexion'];
}
