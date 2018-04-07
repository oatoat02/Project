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
            $yearEnd = date('12/31/Y');
            $controlComplete = control::where('status','Y')->whereBetween('Date', [$yearStart, $yearEnd])->get();
            dd($controlComplete);
            return view('Project.dashboard')->with('listTLE',$listTLE)->with('listControl',$listControl)->with('time',$time);
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
    	return view('Project.index');
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
