<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OLT extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'olt';
    protected $fillable = ['id', 'nom', 'type', 'modele', 'coordonne', 'adresse', 'centrale_optique', 'type_carte', 'num_slot_board', 'date_mise_service', 'carte_id', 'hub_id'];
}
