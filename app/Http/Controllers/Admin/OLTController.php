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
        $olt->capacite_en_port = $request->capacite_en_port;
        $olt->save();
        $carte_ids = explode(',', $request->concatenated_values);
        foreach ($carte_ids as $carte_id) {
            if(trim($carte_id) != "") {
                $olt->cartes()->attach($carte_id);
            }
        }
        return redirect()->route('olts')->with('success', 'Formulaire soumis avec succès!');
    }


    public function getOLTs(Request $request)
    {
        $searchInput = $request->searchInput;
        $olts = OLT::select('*', 
        DB::raw('ST_X(coordonne) as longitude'), 
        DB::raw('ST_Y(coordonne) as latitude'))
        ->where('nom', 'like', '%'.$searchInput.'%')
        ->with('cartes')
        ->with('hub')
        ->get();
        return view('Admin/OLT/olt', ['data' => $olts, 'page' => 'olts', 'searchInput' => $searchInput]);
    }
    
    public function addOLT()
    {
        $cartes = Carte::all();
        return view('Admin/OLT/ajouterOLT', ['cartes' => $cartes, 'page' => 'olts']);
    }

    public function getOLTId($id)
    {
        $olt = OLT::select('*', 
               DB::raw('ST_X(coordonne) as longitude'), 
               DB::raw('ST_Y(coordonne) as latitude'))
        ->where('id', $id)
        ->with('cartes')
        ->first();
        $olt->date_mise_service = $olt->date_mise_service ? Carbon::parse($olt->date_mise_service)->format('Y-m-d\TH:i') : Carbon::parse("2024-07-08 01:52:00")->format('Y-m-d\TH:i');
        $newCartes = Carte::all();
        return view('Admin/OLT/modifierOLT', ['data' => $olt, 'newCartes' => $newCartes, 'page' => 'olts']);
    }

    public function deleteOLT($id)
    {
        $olt = OLT::find($id);
        $olt->cartes()->detach();   
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
        $olt->numero_slot_board = $request->numero_slot_board;
        $olt->date_mise_service = Carbon::parse($request->date_mise_service)->format('Y-m-d H:i:s');
        $olt->capacite_en_port = $request->capacite_en_port;
        $olt->cartes()->detach(); 
        $carte_ids = explode(',', $request->concatenated_values);
        foreach ($carte_ids as $carte_id) {
            if(trim($carte_id) != "") {
                $olt->cartes()->attach($carte_id);
            }
        }
        $olt->update();
        return redirect()->route('olts')->with('message', 'OLT a ete bien modifié');
    }
}
