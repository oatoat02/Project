<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TLE;
class MainController extends Controller
{
    public function info()
    {
        return view('Project.info');
    }
    public function indexdashboard()
    {
    	return view('Project.dashboard');
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

    public function control()
    {
        return view('Project.control');
    }

    public function PhotoGallery()
    {
        return view('Project.PhotoGallery');
    }
    public function SoundArchive()
    {
        return view('Project.SoundArchive');
    }
    public function settingSystem()
    {
        return view('Project.settingSystem');
    }
    public function logCollection()
    {
        return view('Project.logCollection');
    }
    public function checktle()
    {
        return view('Project.checktle');
    }
    public function tle()
    {
        return view('Project.tle');
    }
    public function test()
    {
        return view('Project.test');
    }
    


}
