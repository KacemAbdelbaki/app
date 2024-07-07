<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EndBox extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'sub_Box';
    protected $fillable = [
        'id', 
        'nom', 
        'num_serie', 
        'modele', 
        'coordonne', 
        'adresse', 
        'num_dans_chaine', 
        // 'sub_box_precedent_id', 
        'date_mise_service'
    ];
}
