<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\TLE;
use App\Sound;

class SoundController extends Controller
{
    //
	public function SoundArchive()
	{
		$listSound = Sound::orderBy('Date', 'desc')->get();
		$listTLE = TLE::get();	
		
		$data = ['All','All',date("Y/m/d"),date("Y/m/d")];
		/*dd($listSound);*/
		/*return view('Project.SoundGallery')->with('listSound',$listSound)->with('listTLE',$listTLE)->with('data',$data);*/
		return view('Project.SoundArchive')->with('listSound',$listSound)->with('listTLE',$listTLE)->with('data',$data);
	}
	public function AddSound(Request $request)
	{

		if($request->hasFile('Sound')){
			$store = new Sound;
			$store->SatelliteName = $request->SatelliteName;
			$store->TimeAcquired = $request->TimeAcquired;
			$store->DateAcquired = $request->DateAcquired;

			$s=($request->DateAcquired).(':').$request->TimeAcquired.(':00');
			$date = date_create_from_format('d/m/Y:H:i:s', $s);	

			$store->Date = $date->format('m/d/Y');

			/*------------------save Sound to server---------------------*/
			$sound = $request->file('Sound');
			$fileName = $request->SatelliteName.'_'.uniqid().'.'.$request->file('Sound')->getClientOriginalExtension();

			$path =  'sound/'.$request->SatelliteName;
			$sound->move($path, $fileName);
			/*-----------------------------------------------------------*/
			$store->path=$path.'/'.$fileName;
			/*	dd($store);*/
			$store->save();





		}

		$listSound = Sound::orderBy('Date', 'desc')->get();
		$listTLE = TLE::get();	
		$data = ['All','All',date("Y/m/d"),date("Y/m/d")];
;
		return view('Project.SoundArchive')->with('listSound',$listSound)->with('listTLE',$listTLE)->with('data',$data);
		
	}

	public function findSound(Request $request)
	{
	
		/*Session::put('selectSatellite',$request->input('SatelliteName'));*/
		$StartDate = date_create_from_format('d/m/Y', ($request->StartDate));	
		$StartDateFomat=($StartDate->format('m/d/Y'));
		$EndDate = date_create_from_format('d/m/Y', ($request->EndDate));	
		$EndDateFomat=($EndDate->format('m/d/Y'));
		$listTLE = TLE::get();
		
		if($request->Durations == 'All'){
			$listSound = Sound::where('SatelliteName',$request->SatelliteName)->orderBy('Date', 'desc')->get();
			$listTLE = TLE::get();
			
		}else{
			if($request->SatelliteName != 'All' ){
				$listSound = Sound::where('SatelliteName',$request->SatelliteName)
				->whereBetween('Date', [$StartDateFomat, $EndDateFomat])->get();
			}else{

				$listSound = Sound::whereBetween('Date', [$StartDateFomat, $EndDateFomat])->get();
			}
		}
		$data = [$request->SatelliteName ,$request->Durations ,$request->StartDate ,$request->EndDate];
		
		
		
		return view('Project.SoundArchive')->with('listSound',$listSound)->with('listTLE',$listTLE)
		->with('data',$data);
	}
}
