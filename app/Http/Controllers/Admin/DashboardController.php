<?php

namespace App\Http\Controllers\Admin;

use App\Models\Carte;
use App\Models\Hub;
use App\Models\EndBox;
use App\Models\OLT;
use App\Models\SubBox;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController
{
    // public function getAll()
    // {
    //     $olts = OLT::select(
    //         '*',
    //         DB::raw('ST_X(coordonne) as longitude'),
    //         DB::raw('ST_Y(coordonne) as latitude')
    //     )
    //         ->get();

    //     $chaines = array();
    //     foreach ($olts as $olt) {
    //         $hub = Hub::find($olt->hub_id);
    //         $subBoxs = array();

    //         if ($hub) {
    //             $subBox = SubBox::find($hub->sub_box_id);

    //             while ($subBox->sub_box_suivant_id != null) {
    //                 $subBoxs[] = $subBox;
    //                 $subBox = SubBox::find($subBox->sub_box_suivant_id);
    //             }
    //             $subBoxs[] = $subBox;

    //             $endbox = EndBox::find($subBox->end_box_id);
    //         }

    //         $chaine = array('olt' => $olt, 'hub' => $hub, 'subBoxs' => $subBoxs, 'endBox' => $endbox);
    //         $chaines[] = $chaine;
    //     }

    //     return view('Admin/dashboard', ['chaines' => $chaines, 'page' => 'adminHome']);
    // }

    public function updateEquipmentOrder()
    {
        $olts = OLT::select('*',
                DB::raw('ST_X(coordonne) as longitude'),
                DB::raw('ST_Y(coordonne) as latitude'))
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
        return view('Admin/dashboard', ['chaines' => $chaines, 'page' => 'adminHome']);
    }
}
