<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carte extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'carte';
    protected $fillable = ['id', 'modele_carte', 'nbr_ports', 'slot'];
}
