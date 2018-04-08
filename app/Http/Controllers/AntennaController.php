<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TLE;
use Auth;
use App\control;
use DateTime;
class AntennaController extends Controller
{
    public function control()
    {
        if(Auth::check()){

            $listTLE = TLE::get();
            $listControl = control::where('status','N')->orderBy('timestamp', 'asc')->get();
            return view('Project.control')->with('listTLE',$listTLE)->with('listControl',$listControl);
        }else{
          return redirect('/login');
      }
    }

    public function showtimecontrol(Request $request)
    {
    	// dd($request);
    	$namesatellite = $request->namesatellite;
    	$data= $request->control;
    	$dataspilt = explode(",", $data);
        // dd($dataspilt);
    	// dd(sizeof($dataspilt));
    	$arraylist= array();
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
        $Date =  DateTime::createFromFormat('m/d/Y , H:i:s A', $timestart);//ตามformat
        $store->Date = $Date;
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
    public function logCollection()
    {
        if(Auth::check()){
            $listControl = control::where('status','Y')->orderBy('timestamp', 'asc')->get();
            // dd($listControl);
            return view('Project.logCollection')->with('listControl',$listControl);
            
        }else{
            return redirect('/login');
        }
    }
    public function schedulecontrol(Request $request)
    {
        
        $listdata = control::find($request->id);
        // dd($listdata->control);
        return view('Project.schedulecontrol')->with('listdata',$listdata);
    }
    public function findControl(Request $request)
    {
        $StartDate = date_create_from_format('d/m/Y', ($request->StartDate));   
        $EndDate = date_create_from_format('d/m/Y', ($request->EndDate));   

        $listControl = control::where('status','Y')->whereBetween('Date', [$StartDate, $EndDate])->get();
    // dd($StartDate);
        return view('Project.logCollection')->with('listControl',$listControl);
       
    }
}
