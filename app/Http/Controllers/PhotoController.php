<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;
use App\TLE;
use Session;


class PhotoController extends Controller
{
	public function AddPhoto(Request $request){ 
		if($request->hasFile('photo')){
			
			$store = new Photo;
			$store->SatelliteName = $request->SatelliteName;
			$store->Enhancement =	$request->Enhancement;
			$store->TimeAcquired = $request->TimeAcquired;
			$store->DateAcquired = $request->DateAcquired;

			$s=($request->DateAcquired).(':').$request->TimeAcquired.(':00');
			$date = date_create_from_format('d/m/Y:H:i:s', $s);	

			$store->Date = $date->format('m/d/Y');

			/*------------------save Photo to server---------------------*/
			$photo = $request->file('photo');
			$originalname='photo/'.($store->SatelliteName).'/'.$photo->getClientOriginalName();
			$path = 'photo/'.($store->SatelliteName);

			$photo->move($path,$photo->getClientOriginalName());
			/*-----------------------------------------------------------*/
			$store->path=$originalname;
			$store->save();
			
		}
		

		return redirect()->back();
		
	}
	public function PhotoGallery()
	{
		$listPhoto = Photo::orderBy('Date', 'desc')->get();
		$listTLE = TLE::get();	
		$data = ['All','All',date("Y/m/d"),date("Y/m/d")];
		
		return view('Project.PhotoGallery')->with('listPhoto',$listPhoto)->with('listTLE',$listTLE)->with('data',$data);
	}
	public function findPhoto(Request $request)
	{
		/*Session::put('selectSatellite',$request->input('SatelliteName'));*/
		$StartDate = date_create_from_format('d/m/Y', ($request->StartDate));	
		$StartDateFomat=($StartDate->format('m/d/Y'));
		$EndDate = date_create_from_format('d/m/Y', ($request->EndDate));	
		$EndDateFomat=($EndDate->format('m/d/Y'));
		$listTLE = TLE::get();
		
		if($request->Durations == 'All'){
			$listPhoto = Photo::where('SatelliteName',$request->SatelliteName)->orderBy('Date', 'desc')->get();
			$listTLE = TLE::get();
			
		}else{
			if($request->SatelliteName != 'All' ){
				$listPhoto = Photo::where('SatelliteName',$request->SatelliteName)
				->whereBetween('Date', [$StartDateFomat, $EndDateFomat])->get();
			}else{

				$listPhoto = Photo::whereBetween('Date', [$StartDateFomat, $EndDateFomat])->get();
			}
		}
		$data = [$request->SatelliteName ,$request->Durations ,$request->StartDate ,$request->EndDate];
		
		
		
		return view('Project.PhotoGallery')->with('listPhoto',$listPhoto)->with('listTLE',$listTLE)
				->with('data',$data);
	}
}
