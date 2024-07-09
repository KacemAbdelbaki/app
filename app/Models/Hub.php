<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hub extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'hub';
    protected $fillable = ['id', 'nom', 'modele', 'num_serie', 'installation', 'coordonne', 'adresse', 'ports_affecte', 'nbr_chaine_actif', 'date_mise_service', 'sub_box_id'];
}
