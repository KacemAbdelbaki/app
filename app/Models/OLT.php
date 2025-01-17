<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OLT extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'olt';
    protected $fillable = ['id', 'nom', 'type', 'modele', 'coordonne', 'adresse', 'centrale_optique', 'numero_slot_board', 'date_mise_service', 'capacite_en_port'];

    public function cartes()
    {
        return $this->belongsToMany(Carte::class, 'olt_carte', 'id_olt', 'id_carte');
    }
    public function hub()
    {
        return $this->hasOne(Hub::class, 'olt_id');
    }
}
