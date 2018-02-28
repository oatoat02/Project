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
		
		/*return view('Project.PhotoGallery')->with('listPhoto',$listPhoto)->with('listTLE',$listTLE)->with('data',$data);*/
		return view('Project.SoundArchive')->with('listSound',$listSound)->with('listTLE',$listTLE)->with('data',$data);
	}
	public function AddSound(Request $request){
	
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

			$originalname='sound/'.($store->SatelliteName).'/'.$sound->getClientOriginalName();
			$path = 'sound/'.($store->SatelliteName);

			$sound->move($path,$sound->getClientOriginalName());
			/*-----------------------------------------------------------*/
			$store->path=$originalname;
			$store->save();
		}
		return redirect()->back();
		
	}
}
