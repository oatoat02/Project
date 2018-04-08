<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TLE;
use App\Users;
use App\control;
use Auth;
use DateTime;
class MainController extends Controller
{
    public function info()
    {
        return view('Project.info');
    }
    public function indexdashboard()
    {
        if(Auth::check()){
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

            
            $yearStart = date('01/01/Y');
            $yearEnd = date('31/12/Y');
            $StartDate = date_create_from_format('d/m/Y', ($yearStart));   
            $StartDateFomat=($StartDate->format('m/d/Y'));
            $EndDate = date_create_from_format('d/m/Y', ($yearEnd));   
            $EndDateFomat=($EndDate->format('m/d/Y'));
            // dd($EndDate);
            // dd($EndDate);

            $controlComplete = control::whereBetween('Date', [$StartDateFomat, $EndDateFomat])->get();
            dd($controlComplete);
            // return view('Project.dashboard')->with('listTLE',$listTLE)->with('listControl',$listControl)->with('time',$time);
        }else{
            return redirect('/login');
        }

    }
    public function checksatellite()
    {
        $listTLE = TLE::get();
        
    	return view('Project.checksatellite')->with('listTLE',$listTLE);
    }
    public function index()
    {
        $tleNOAA15 =TLE::where('name', 'NOAA-15')->first();
        $tleNOAA18 =TLE::where('name', 'NOAA-18')->first();
        $tleNOAA20 =TLE::where('name', 'NOAA-20')->first();
    	return view('Project.index')->with('tleNOAA15',$tleNOAA15)->with('tleNOAA18',$tleNOAA18)->with('tleNOAA20',$tleNOAA20);
    }
    public function checktle()
    {
        return view('Project.checktle');
    }
    public function test()
    {
        return view('Project.test');
    }
    public function testupload(Request $request)
    {
       
        return redirect()->back();
    }
    


}
