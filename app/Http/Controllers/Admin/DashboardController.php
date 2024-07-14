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
    public function getAll()
{
    $olts = OLT::select('*', 
        DB::raw('ST_X(coordonne) as longitude'), 
        DB::raw('ST_Y(coordonne) as latitude'))
        ->get();

    $chaines = array();
    foreach ($olts as $olt) {
        $hub = Hub::find($olt->hub_id);
        $subBoxs = array();

        if ($hub) {
            $subBox = SubBox::find($hub->sub_box_id);

            while ($subBox->sub_box_suivant_id != null) {
                $subBoxs[] = $subBox;
                $subBox = SubBox::find($subBox->sub_box_suivant_id);
            }
            $subBoxs[] = $subBox;

            $endbox = EndBox::find($subBox->end_box_id);
        }

        $chaine = array('olt' => $olt, 'hub' => $hub, 'subBoxs' => $subBoxs, 'endBox' => $endbox);
        $chaines[] = $chaine; 
    }

    return view('Admin/dashboard', ['chaines' => $chaines, 'page' => 'adminHome']);
}

}
