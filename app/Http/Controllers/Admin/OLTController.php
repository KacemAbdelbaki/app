<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\OLT;
use Illuminate\Support\Facades\DB;

class OLTController
{
    public function storeOLT(Request $request)
    {
        $olt = new OLT();
        $olt->nom = $request->nom;
        $olt->type = $request->type;
        $olt->modele = $request->modele;
        $longitude = 14; // This should come from user input or another source
        $latitude = 5;   // This should come from user input or another source
        $olt->coordonne = DB::raw("POINT($longitude, $latitude)");
        $olt->adresse = $request->adresse;
        $olt->centrale_optique = $request->centrale_optique;
        $olt->type_carte = $request->type_carte;
        $olt->numero_slot_board = $request->num_slot_board;
        $olt->date_mise_service = $request->date_mise_service;
        $olt->carte_id = $request->carte_id;
        $olt->hub_id = $request->hub_id;
        $olt->save();
        return redirect()->route('olts')->with('success', 'Formulaire soumis avec succès!');
    }


    public function getOLTs()
    {
        $olts = OLT::select('*', 
        DB::raw('ST_X(coordonne) as longitude'), 
        DB::raw('ST_Y(coordonne) as latitude'))
        ->get();
        return view('Admin/OLT/olt', ['data' => $olts]);
    }

    public function getOLTId($id)
    {
        $olt = OLT::find($id);
        return view('Admin/OLT/modifierOLT', ['data' => $olt]);
    }

    public function deleteOLT($id)
    {
        $olt = OLT::find($id);
        $olt->delete();
        return redirect()->route('olts')->with('message', 'OLT a ete bien supprimé');
    }

    public function updateOLT(Request $request)
    {
        $olt = OLT::find($request->id);
        $olt->modele_olt = $request->modele_olt;
        $olt->num_ports = $request->num_ports;
        $olt->update();
        return redirect()->route('olts')->with('message', 'OLT a ete bien modifié');
    }
}
