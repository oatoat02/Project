<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TLE;
class AntennaController extends Controller
{
    
    public function antennacontrol()
    {
    	$listTLE = TLE::get();
        
        // dd($tleFrist);
        return view('Project.antennacontrol')->with('listTLE',$listTLE);
    }
    public function showtimecontrol(Request $request)
    {
    	/*dd($request);*/
    	$namesatellite = $request->namesatellite;
    	$data= $request->control;
    	$dataspilt = explode(",", $data);
    	// dd(sizeof($dataspilt));
    	$arraylist= array();
    	for($i = 0 ; $i < sizeof($dataspilt);$i+=3 ){
    		$arrayfree= array();
    		array_push($arrayfree,$dataspilt[$i],$dataspilt[$i+1],$dataspilt[$i+2]);
    		array_push($arraylist,$arrayfree);
    	}
    	// dd($arraylist);
    	$listTLE = TLE::get();
        return view('Project.showtimecontrol')->with('arraylist',$arraylist)->with('namesatellite',$namesatellite);
    }
}
