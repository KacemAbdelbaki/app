<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EndBox extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'end_box';
    protected $fillable = ['id', 'nom', 'installation', 'num_serie', 'modele', 'coordonne', 'adresse', 'num_dans_chaine', 'date_mise_service', 'sub_box_precedent_id'];
}
