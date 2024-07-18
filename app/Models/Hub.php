<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hub extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'hub';
    protected $fillable = ['id', 'nom', 'modele', 'num_serie', 'installation', 'coordonne', 'adresse', 'ports_affecte', 'nbr_chaine_actif', 'date_mise_service', 'olt_id'];

    public function cartes()
    {
        return $this->belongsToMany(Carte::class, 'hub_carte', 'carte_id', 'carte_id');
    }

    public function olt(){
        return $this->belongsTo(OLT::class, 'olt_id');
    }
    public function subBox()
    {
        return $this->hasOne(SubBox::class, 'hub_id');
    }
}
