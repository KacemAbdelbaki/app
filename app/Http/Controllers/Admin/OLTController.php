<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\OLT;

class OLTController
{
    public function storeOLT(Request $request)
    {
        $olt = new OLT();

        $olt->modele_olt = $request->modele_olt;
        $olt->num_ports = $request->num_ports;
        $olt->save();
        return redirect()->route('olts')->with('success', 'Formulaire soumis avec succès!');
    }


    public function getOLTs(){
        $olts = OLT::all();
        return view('Admin/OLT/olt',['data'=>$olts]);
    }

    public function getOLTId($id){
        $olt = OLT::find($id);
        return view('Admin/OLT/modifierOLT',['data'=>$olt]);
    }

    public function deleteOLT($id){
        $olt = OLT::find($id);
        $olt->delete();
         return redirect()->route('olts')->with('message', 'OLT a ete bien supprimé');
    }

    public function updateOLT(Request $request){
        $olt = OLT::find($request->id);
        $olt->modele_olt = $request->modele_olt;
        $olt->num_ports = $request->num_ports;
        $olt->update();
        return redirect()->route('olts')->with('message', 'OLT a ete bien modifié');
    }
}
