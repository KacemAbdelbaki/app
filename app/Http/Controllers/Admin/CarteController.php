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
        $carte->nbr_ports = $request->nbr_ports;
        $carte->slot = $request->slot;
        $carte->save();
        return redirect()->route('cartes')->with('success', 'Formulaire soumis avec succès!');
    }


    public function getCartes(Request $request){
        $cartes = Carte::select('*')
        ->where('modele_carte', 'like', '%'.$request->searchInput.'%')
        ->get();
        return view('Admin/Carte/carte',['data'=>$cartes, 'page' => 'cartes', 'searchInput' => $request->searchInput]);
    }

    public function getCarteId($id){
        $carte = Carte::find($id);
        return view('Admin/Carte/modifierCarte',['data'=>$carte, 'page' => 'cartes']);
    }

    public function deleteCarte($id){
        $carte = Carte::find($id);
        $carte->delete();
         return redirect()->route('cartes')->with('message', 'Carte a ete bien supprimé');
    }

    public function updateCarte(Request $request){
        $carte = Carte::find($request->id);
        $carte->modele_carte = $request->modele_carte;
        $carte->nbr_ports = $request->nbr_ports;
        $carte->slot = $request->slot;
        $carte->update();
        return redirect()->route('cartes')->with('message', 'Carte a ete bien modifié');
    }
}
