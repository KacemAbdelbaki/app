<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubBox extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'sub_box';
    protected $fillable = ['id', 'nom', 'num_serie', 'modele', 'installation', 'coordonne', 'adresse', 'num_dans_chaine', 'sub_box_suivant_id', 'end_box_id', 'date_mise_service'];

    public function subBox(){
        return $this->belongsTo(SubBox::class, 'sub_box_suivant_id');
    }

    public function endBox(){
        return $this->belongsTo(EndBox::class, 'end_box_id');
    }
}
