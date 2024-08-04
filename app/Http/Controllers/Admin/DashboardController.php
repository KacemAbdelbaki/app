<?php

namespace App\Http\Controllers\Admin;

use App\Models\Carte;
use App\Models\Hub;
use App\Models\OLT;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController
{
    public function updateEquipmentOrder(Request $req)
    {
        $olts = OLT::select('*',
                DB::raw('ST_X(coordonne) as longitude'),
                DB::raw('ST_Y(coordonne) as latitude'))
        ->where('nom', 'like', '%'.$req->searchInput.'%')
        ->with(['hub.subBox' => function($query){
            $query->with('subBox');
        }])
        ->get();
        $chaines = [];
        foreach($olts as $olt){
            $subBoxs = [];
            $endBox = null;
            foreach ($olt->hub->subBox as $subBox) {
                $i = 3;
                while ($subBox) {
                    $subBox->num_dans_chaine = $i;
                    $subBox->update();
                    $i++;
                    if($subBox->type == "SubBox"){
                        $subBoxs[] = $subBox;
                    }
                    else{
                        $endBox = $subBox;
                    };
                    $subBox = $subBox->subBox;
                }
            }
            $chaine = array('olt' => $olt, 'hub' => $olt->hub, 'subBoxs' => $subBoxs, 'endBox' => $endBox);
            $chaines[] = $chaine;
        }
        return view('Admin/dashboard', ['chaines' => $chaines, 'searchInput' => $req->searchInput, 'page' => 'adminHome']);
    }

    public function chaineMap(Request $req)
    {
        $cartes = Carte::all();
        return view('Admin/chaineMap', ['cartes' => $cartes, 'searchInput' => $req->searchInput, 'page' => 'adminHome']);
    }

    public function storeChaine(Request $request){
        // OLT
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

        // HUB
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

        // SUBs

        // END

        return redirect()->route('adminHome')->with('success', 'Formulaire soumis avec succès!');
    }
}
