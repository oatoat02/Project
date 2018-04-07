<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TLE;
use App\control;
class AntennaController extends Controller
{
    public function control()
    {
        $listTLE = TLE::get();
        $listControl = control::where('status','N')->orderBy('timestamp', 'asc')->get();
        $timestart='';
        $timestop='';
        for($i = 0 ; $i < sizeof($listControl);$i++ ){
            if($timestart==''){
                $timestart=$listControl[$i]['timestart'];
            }
            $timestop=$listControl[$i]['timestop'];
            
        }
        $time=[];
        array_push($time,$timestart);
        array_push($time,$timestop);
        // dd($listControl);
        return view('Project.control')->with('listTLE',$listTLE)->with('listControl',$listControl)->with('time',$time);
    }

    public function showtimecontrol(Request $request)
    {
    	
    	$namesatellite = $request->namesatellite;
    	$data= $request->control;
    	$dataspilt = explode(",", $data);
        // dd($dataspilt);
    	// dd(sizeof($dataspilt));
    	$arraylist= array();
        $date="";
    	$timestart="";
    	for($i = 0 ; $i < sizeof($dataspilt);$i+=4 ){
    		if($timestart==''){
                $timestart=$dataspilt[$i].' ,'.$dataspilt[$i+1];
                
            }
         
    		$arrayfree= array();
    
            array_push($arrayfree,$dataspilt[$i],$dataspilt[$i+1],$dataspilt[$i+2],$dataspilt[$i+3]);
    		array_push($arraylist,$arrayfree);
            // dd($arrayfree);
    	}
    	// dd($timestart);
    	$listTLE = TLE::get();
        return view('Project.showtimecontrol')->with('arraylist',$arraylist)->with('namesatellite',$namesatellite)->with('timestart',$timestart)->with('data',$data)->with('timestamp',$request->timestamp);
    }
    public function settimecontrol(Request $request)
    {
    	
    	// dd($request);
    	$data= $request->control;
    	$dataspilt = explode(",", $data);
    	// dd($dataspilt);
    	$control= [];
    	$timestart="";
    	$timestop="";
    	for($i = 0 ; $i < sizeof($dataspilt);$i+=4 ){
            if($timestart==""){
                $timestart=$dataspilt[$i].' ,'.$dataspilt[$i+1];
                
            }
    		$arrayfree= [];
    		$arrayfree['time'] = $dataspilt[$i].' ,'.$dataspilt[$i+1];
    		$arrayfree['azimuth'] = $dataspilt[$i+2];
    		$arrayfree['elevation'] = $dataspilt[$i+3];
    		array_push($control,$arrayfree);
    		$timestop=$dataspilt[$i].' ,'.$dataspilt[$i+1];

    	}
    	$store = new control;
		$store->namesatellite = $request->namesatellite;
		$store->status = $request->status;
		$store->timestart =	$timestart;
		$store->timestop =	$timestop;
        $store->timestamp =  $request->timestamp;
		$store->control = $control;
		$store->save();
    	
    	$listTLE = TLE::get();
        return redirect('/control')->with('listTLE',$listTLE);
    }
    public function deleteTimeControl(Request $request)
    {
        
        $data = control::find($request->id);
        $data->delete();
       
        return redirect()->back();
    }
}
