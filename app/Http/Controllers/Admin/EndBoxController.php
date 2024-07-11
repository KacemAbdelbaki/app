<?php

namespace App\Http\Controllers\Admin;

use App\Models\Carte;
use App\Models\Hub;
use App\Models\EndBox;
use App\Models\SubBox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EndBoxController
{
    public function storeEndBox(Request $request)
    {
        $endBox = new EndBox();
        $endBox->nom = $request->nom;
        $endBox->num_serie = $request->num_serie;
        $endBox->modele = $request->modele;
        $longitude = $request->longitude;
        $latitude = $request->latitude;  
        $endBox->coordonne = DB::raw("POINT($longitude, $latitude)");
        $endBox->adresse = $request->adresse;
        $endBox->installation = $request->installation;
        $endBox->num_dans_chaine = $request->num_dans_chaine;
        // $endBox->sub_box_precedent_id = $request->sub_box_precedent_id; 
        $endBox->date_mise_service = Carbon::parse($request->date_mise_service)->format('Y-m-d H:i:s');
        $endBox->save();
        return redirect()->route('endBoxs')->with('success', 'Formulaire soumis avec succès!');
    }


    public function getEndBoxs()
    {
        $endBoxs = EndBox::select('*', 
        DB::raw('ST_X(coordonne) as longitude'), 
        DB::raw('ST_Y(coordonne) as latitude'))
        ->with('subBox')
        ->get();
        return view('Admin/EndBox/endBox', ['data' => $endBoxs]);
    }
    
    public function addEndBox()
    {
        $subBoxs = SubBox::all();
        return view('Admin/EndBox/ajouterEndBox', ['subBoxs' => $subBoxs]);
    }

    public function getEndBoxId($id)
    {
        $endBox = EndBox::select('*', 
               DB::raw('ST_X(coordonne) as longitude'), 
               DB::raw('ST_Y(coordonne) as latitude'))
        ->where('id', $id)
        ->first();
        $endBox->date_mise_service = $endBox->date_mise_service ? Carbon::parse($endBox->date_mise_service)->format('Y-m-d\TH:i') : Carbon::parse("2024-07-08 01:52:00")->format('Y-m-d\TH:i');
        $subBoxs = SubBox::all();
        return view('Admin/EndBox/modifierEndBox', ['data' => $endBox, 'subBoxs' => $subBoxs]);
    }

    public function deleteEndBox($id)
    {
        $endBox = EndBox::find($id);
        $endBox->delete();
        return redirect()->route('endBoxs')->with('message', 'EndBox a ete bien supprimé');
    }

    public function updateEndBox(Request $request)
    {
        $endBox = EndBox::find($request->id);
        $endBox->nom = $request->nom;
        $endBox->num_serie = $request->num_serie;
        $endBox->modele = $request->modele;
        $longitude = $request->longitude;
        $latitude = $request->latitude;  
        $endBox->coordonne = DB::raw("POINT($longitude, $latitude)");
        $endBox->adresse = $request->adresse;
        $endBox->installation = $request->installation;
        $endBox->num_dans_chaine = $request->num_dans_chaine;
        $endBox->sub_box_precedent_id = $request->sub_box_precedent_id; 
        $endBox->date_mise_service = Carbon::parse($request->date_mise_service)->format('Y-m-d H:i:s');
        $endBox->update();
        return redirect()->route('endBoxs')->with('message', 'EndBox a ete bien modifié');
    }
}
