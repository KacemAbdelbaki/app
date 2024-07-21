<?php

namespace App\Http\Controllers\Admin;

use App\Models\Hub;
use App\Models\SubBox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SubBoxController
{
    public function storeSubBox(Request $request)
    {
        $subBox = new SubBox();
        $subBox->type = $request->type;
        $subBox->nom = $request->nom;
        $subBox->num_serie = $request->num_serie;
        $subBox->modele = $request->modele;
        $longitude = $request->longitude;
        $latitude = $request->latitude;  
        $subBox->coordonne = DB::raw("POINT($longitude, $latitude)");
        $subBox->adresse = $request->adresse;
        // $subBox->num_dans_chaine = $request->num_dans_chaine; // automated
        $subBox->sub_box_precedent_id = $request->sub_box_precedent_id;
        $subBox->installation = $request->installation;
        $subBox->hub_id = $request->hub_id;
        $subBox->date_mise_service = Carbon::parse($request->date_mise_service)->format('Y-m-d H:i:s');
        $subBox->save();
        return redirect()->route('subBoxs')->with('success', 'Formulaire soumis avec succès!');
    }


    public function getSubBoxs(Request $request)
    {
        $subBoxs = SubBox::select('*', 
        DB::raw('ST_X(coordonne) as longitude'), 
        DB::raw('ST_Y(coordonne) as latitude'))
        ->where('nom', 'like', '%'.$request->searchInput.'%')
        ->with('subBox')
        ->get();
        (new DashboardController)->updateEquipmentOrder();
        return view('Admin/SubBox/subBox', ['data' => $subBoxs, 'page' => 'subBoxs']);
    }
    
    public function addSubBox()
    {
        $subBoxs = SubBox::all();
        $hubs = Hub::all();
        return view('Admin/SubBox/ajouterSubBox', ['subBoxs' => $subBoxs, 'hubs' => $hubs, 'page' => 'subBoxs']);
    }

    public function getSubBoxId($id)
    {
        $subBox = SubBox::select('*', 
               DB::raw('ST_X(coordonne) as longitude'), 
               DB::raw('ST_Y(coordonne) as latitude'))
        ->where('id', $id)
        ->first();
        $subBox->date_mise_service = $subBox->date_mise_service ? Carbon::parse($subBox->date_mise_service)->format('Y-m-d\TH:i') : Carbon::parse("2024-07-08 01:52:00")->format('Y-m-d\TH:i');
        $endBoxs = SubBox::select('*')
        ->where('type', 'like', 'EndBox')
        ->get();
        $subBoxs = SUbBox::all();
        return view('Admin/SubBox/modifierSubBox', ['data' => $subBox, 'endBoxs' => $endBoxs, 'subBoxs' => $subBoxs, 'page' => 'subBoxs']);
    }

    public function deleteSubBox($id)
    {
        $subBox = SubBox::find($id);
        $subBox->delete();
        return redirect()->route('subBoxs')->with('message', 'SubBox a ete bien supprimé');
    }

    public function updateSubBox(Request $request)
    {
        $subBox = SubBox::find($request->id);
        $subBox->nom = $request->nom;
        $subBox->num_serie = $request->num_serie;
        $subBox->modele = $request->modele;
        $longitude = $request->longitude;
        $latitude = $request->latitude;  
        $subBox->coordonne = DB::raw("POINT($longitude, $latitude)");
        $subBox->adresse = $request->adresse;
        // $subBox->num_dans_chaine = $request->num_dans_chaine; // automated
        $subBox->sub_box_precedent_id = $request->sub_box_precedent_id; 
        $subBox->installation = $request->installation;
        $subBox->date_mise_service = Carbon::parse($request->date_mise_service)->format('Y-m-d H:i:s');
        $subBox->update();
        return redirect()->route('subBoxs')->with('message', 'SubBox a ete bien modifié');
    }
}
