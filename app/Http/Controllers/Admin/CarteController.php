<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Carte;

class CarteController
{
    public function storeCarte(Request $request)
    {
        $carte = new Carte();

        $carte->modele_carte = $request->modele_carte;
        $carte->num_ports = $request->num_ports;
        $carte->save();
        return redirect()->route('cartes')->with('success', 'Formulaire soumis avec succès!');
    }


    public function getCartes(){
        $cartes = Carte::all();
        return view('Admin/Carte/carte',['data'=>$cartes]);
    }

    public function getCarteId($id){
        $carte = Carte::find($id);
        return view('Admin/Carte/modifierCarte',['data'=>$carte]);
    }

    public function deleteCarte($id){
        $carte = Carte::find($id);
        $carte->delete();
         return redirect()->route('cartes')->with('message', 'Carte a ete bien supprimé');
    }

    public function updateCarte(Request $request){
        $carte = Carte::find($request->id);
        $carte->modele_carte = $request->modele_carte;
        $carte->num_ports = $request->num_ports;
        $carte->update();
        return redirect()->route('cartes')->with('message', 'Carte a ete bien modifié');
    }
}
