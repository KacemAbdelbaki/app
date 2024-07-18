<?php

namespace App\Http\Controllers\Admin;

use App\Models\Hub;
use App\Models\SubBox;
use App\Models\OLT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HubController
{
    public function storeHub(Request $request)
    {
        $hub = new Hub();
        $hub->nom = $request->nom;
        $hub->num_serie = $request->num_serie;
        $hub->modele = $request->modele;
        $hub->ports_affecte = $request->ports_affecte;
        $longitude = $request->longitude;
        $latitude = $request->latitude;  
        $hub->coordonne = DB::raw("POINT($longitude, $latitude)");
        $hub->adresse = $request->adresse;
        $hub->nbr_chaine_actif = $request->nbr_chaine_actif;
        $hub->olt_id = $request->olt_id;
        $hub->date_mise_service = Carbon::parse($request->date_mise_service)->format('Y-m-d H:i:s');
        $hub->installation = $request->installation; 
        $hub->save();
        return redirect()->route('hubs')->with('success', 'Formulaire soumis avec succès!');
    }


    public function getHubs(Request $request)
    {
        $hubs = Hub::select('*', 
        DB::raw('ST_X(coordonne) as longitude'), 
        DB::raw('ST_Y(coordonne) as latitude'))
        ->where('nom', 'like', '%'.$request->searchInput.'%')
        ->with('olt')
        ->get();
        return view('Admin/Hub/hub', ['data' => $hubs, 'page' => 'hubs']);
    }
    
    public function addHub()
    {
        $OLTs = OLT::all();
        return view('Admin/Hub/ajouterHub', ['OLTs' => $OLTs, 'page' => 'hubs']);
    }

    public function getHubId($id)
    {
        $hub = Hub::select('*', 
               DB::raw('ST_X(coordonne) as longitude'), 
               DB::raw('ST_Y(coordonne) as latitude'))
        ->where('id', $id)
        ->first();
        $hub->date_mise_service = $hub->date_mise_service ? Carbon::parse($hub->date_mise_service)->format('Y-m-d\TH:i') : Carbon::parse("2024-07-08 01:52:00")->format('Y-m-d\TH:i');
        $OLTs = OLT::all();
        return view('Admin/Hub/modifierHub', ['data' => $hub, 'OLTs' => $OLTs, 'page' => 'hubs']);
    }

    public function deleteHub($id)
    {
        $hub = Hub::find($id);
        $hub->delete();
        return redirect()->route('hubs')->with('message', 'Hub a ete bien supprimé');
    }

    public function updateHub(Request $request)
    {
        $hub = Hub::find($request->id);
        $hub->nom = $request->nom;
        $hub->num_serie = $request->num_serie;
        $hub->modele = $request->modele;
        $hub->ports_affecte = $request->ports_affecte;
        $longitude = $request->longitude;
        $latitude = $request->latitude;  
        $hub->coordonne = DB::raw("POINT($longitude, $latitude)");
        $hub->adresse = $request->adresse;
        $hub->nbr_chaine_actif = $request->nbr_chaine_actif;
        $hub->olt_id = $request->olt_id;  
        $hub->date_mise_service = Carbon::parse($request->date_mise_service)->format('Y-m-d H:i:s');
        $hub->installation = $request->installation;
        $hub->update();
        return redirect()->route('hubs')->with('message', 'Hub a ete bien modifié');
    }
}
