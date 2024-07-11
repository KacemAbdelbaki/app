<?php

namespace App\Http\Controllers\Admin;

use App\Models\Carte;
use App\Models\Hub;
use App\Models\OLT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OLTController
{
    public function storeOLT(Request $request)
    {
        $olt = new OLT();
        $olt->nom = $request->nom;
        $olt->type = $request->type;
        $olt->modele = $request->modele;
        $longitude = $request->longitude;
        $latitude = $request->latitude;  
        $olt->coordonne = DB::raw("POINT($longitude, $latitude)");
        $olt->adresse = $request->adresse;
        $olt->centrale_optique = $request->centrale_optique;
        $olt->numero_slot_board = $request->num_slot_board;
        $olt->date_mise_service = Carbon::parse($request->date_mise_service)->format('Y-m-d H:i:s');
        $olt->hub_id = $request->hub_id;
        $olt->capacite_en_port = $request->capacite_en_port;
        $olt->save();
        $olt->cartes()->attach($request->carte_id);
        return redirect()->route('olts')->with('success', 'Formulaire soumis avec succès!');
    }


    public function getOLTs()
    {
        $olts = OLT::select('*', 
        DB::raw('ST_X(coordonne) as longitude'), 
        DB::raw('ST_Y(coordonne) as latitude'))
        ->with('cartes')
        ->with('hub')
        ->get();
        return view('Admin/OLT/olt', ['data' => $olts]);
    }
    
    public function addOLT()
    {
        $cartes = Carte::all();
        $hubs = Hub::all();
        return view('Admin/OLT/ajouterOLT', ['cartes' => $cartes, 'hubs' => $hubs]);
    }

    public function getOLTId($id)
    {
        $olt = OLT::select('*', 
               DB::raw('ST_X(coordonne) as longitude'), 
               DB::raw('ST_Y(coordonne) as latitude'))
        ->where('id', $id)
        ->first();
        $olt->date_mise_service = $olt->date_mise_service ? Carbon::parse($olt->date_mise_service)->format('Y-m-d\TH:i') : Carbon::parse("2024-07-08 01:52:00")->format('Y-m-d\TH:i');
        $cartes = Carte::all();
        $hubs = Hub::all();
        return view('Admin/OLT/modifierOLT', ['data' => $olt, 'cartes' => $cartes, 'hubs' => $hubs]);
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
        $olt->nom = $request->nom;
        $olt->type = $request->type;
        $olt->modele = $request->modele;
        $longitude = $request->longitude;
        $latitude = $request->latitude;  
        $olt->coordonne = DB::raw("POINT($longitude, $latitude)");
        $olt->adresse = $request->adresse;
        $olt->centrale_optique = $request->centrale_optique;
        $olt->numero_slot_board = $request->num_slot_board;
        $olt->date_mise_service = Carbon::parse($request->date_mise_service)->format('Y-m-d H:i:s');
        $olt->hub_id = $request->hub_id;
        $olt->capacite_en_port = $request->capacite_en_port;
        $olt->cartes()->attach($request->carte_id);
        $olt->update();
        return redirect()->route('olts')->with('message', 'OLT a ete bien modifié');
    }
}
