@extends('layout')

@section('content')

<div class="eight wide computer eight wide tablet sixteen wide mobile column  ">

	<div class="ui segment" style="height: 100%">
		<div class="field box2 checkSolution" >
			<div  class="" id="mapid" >
			</div>
		</div>
	</div>
</div>

<div class="eight wide computer eight wide tablet sixteen wide mobile column " >
	<div class="ui segment" style="height: 100%">
		<div class="fields box1"  style="height: 500px;">
			<div class="ui form">
				<div class="field" style="display: inline-block;">
					<label>ดาวเทียม</label>
				</div>&nbsp; &nbsp;
				
				<div class="ui selection dropdown testonchange" style="z-index:10 !important">
					<i class="dropdown icon"></i>
					<div class="default text" id="selectSatellite">ดาวเทียม</div>
					<div class="menu">
						@foreach($listTLE as $Item)
						<div class="item" data-line1="{{ $Item->line1 }}" data-line2="{{ $Item->line2 }}">{{ $Item->name }}</div>
						
						@endforeach
					</div>
				</div>

				<div class="two fields">
					<div class="field" style="display: inline-block;">
						<label>เวลาเริ่มต้น</label>
						<div class="ui calendar" id="Startcalendar">
							<div class="ui left icon input">
								<input type="text" name="StartDate" id="StartDate" onchange="onChangeDateStart()" value="<?php echo date('d-m-Y'); ?>">
								<i class="calendar icon"></i>
							</div>
						</div>
					</div>
					<div class="field" style="display: inline-block; margin-left: 5px">
						<label>เวลาสิ้นสุด</label> 
						<div class="ui calendar" id="Endcalendar">
							<div class="ui left icon input">
								<input type="text" name="EndDate" id="EndDate" onchange="onChangeDateEnd()" value="<?php echo date('d-m-Y'); ?>">
								<i class="calendar icon"></i>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="fields">
				<button class="ui secondary button SubmitCal">คำนวณวงโคจร</button>
				<button class="ui red button removeLayerALL ">ล้าง</button>
				<table class="ui celled table ">
					<thead>
						<tr>
							<th>Date<br></th>
							<th>Start Time<br>(UTC+7:00)</th>
							<th>Start<br> Azimuth</th>
							<th>End <br>Azimuth</th>
							<th>Maximum<br> Elevation</th>
							<th>End time<br>(UTC+7:00)</th>
						</tr></thead>
						<tbody>
							<tr>
								<td>1/11/2560</td>
								<td>05:40:23</td>
								<td>42</td>
								<td>157</td>
								<td>16</td>
								<td>05:52:32</td>

							</tr>
							<tr>
								<td>2/11/2560</td>
								<td>07:22:13</td>
								<td>10</td>
								<td>132</td>
								<td>40</td>
								<td>07:34:32</td>
							</tr>
							<tr>
								<td>3/11/2560</td>
								<td>10:02:05</td>
								<td>123</td>
								<td>300</td>
								<td>20</td>
								<td>05:40:23</td>
							</tr>
						</tbody>

					</table>
				</div>

			</div>

		</div>
	</div>
	<script type="text/javascript">

		$('#Startcalendar').calendar({
			type: 'date',
			monthFirst: false,
			formatter: {
				date: function (date, settings) {
					if (!date) return '';
					var day = date.getDate();
					var month = date.getMonth() + 1;
					var year = date.getFullYear();
					return day + '/' + month + '/' + year;
				}
			}
		});
		$('#Endcalendar').calendar({
			type: 'date',
			monthFirst: false,
			formatter: {
				date: function (date, settings) {
					if (!date) return '';
					var day = date.getDate();
					var month = date.getMonth() + 1;
					var year = date.getFullYear();
					return day + '/' + month + '/' + year;
				}
			}
		});
	</script>
	<script type="text/javascript" >
		
		var mymap = L.map('mapid',{
			worldCopyJump: true,
			inertia:false,
		}).setView([13.11, 100.91972], 4);
		L.tileLayer('http://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png', {
			minZoom: 3,
			maxZoom: 10,
			/*zoomSnap: 0.25,*/
			id: 'mapbox.streets',
			accessToken: 'your.mapbox.access.token'
		}).addTo(mymap);

		L.marker([13.12036, 100.91972]).bindPopup('Kasetsart University Si Racha Campus').addTo(mymap); 

		var cicle = L.circle([13.12036, 100.91972], 2000000, {
			color: 'red',
			fillColor: '#f03',
			fillOpacity: 0
		}).addTo(mymap);
		L.control.scale().addTo(mymap);
		L.control.mousePosition().addTo(mymap);
		/*console.log(cicle)*/

		// define rectangle geographical bounds
		var Rectangle = [[31.10, 82.4331], [-5,119.4]];
		// create an orange rectangle
		/*L.rectangle(Rectangle, {color: "#ff7800", weight: 1}).addTo(mymap);*/
		// zoom the map to the rectangle bounds
		mymap.fitBounds(Rectangle);
		// Sample TLE
		var tleLine1 = '',
		tleLine2 = '';

		// Initialize a satellite record
		var longitudeStrArr = new Array(),
		latitudeStrArr  = new Array(),
		latlngsArr  = new Array(),
		azimuthArr  = new Array(),
		elevationArr  = new Array(),
		latlngsDaylight = new Array(),
		latlngsNight = new Array(),
		PolygonArr  = [];
		timeArr = new Array();
		var countClick=0;
		var DateSecond;
		var polygon;
		var layerGroup = new L.LayerGroup();
		var layerGroup2 = new L.LayerGroup();
		/* L.polyline([latitudeStrArr[1],longitudeStrArr[1]]).addTo(mymap);*/
		$(document).on('click', '.SubmitCal', function(){
			console.log(Date.parse($('#StartDate').val()));
			console.log(Date.parse($('#EndDate').val()));
			
			if( ($('#selectSatellite')[0].innerHTML != 'ดาวเทียม') && ( Date.parse($('#StartDate').val()) < Date.parse($('#EndDate').val())) ){
			for( i in mymap._layers) {
				if(mymap._layers[i]._path != undefined) {
					try {
						mymap.removeLayer(mymap._layers[i]);
					}
					catch(e) {
						console.log("problem with " + e + mymap._layers[i]);
					}
				}
				countClick=0;
			}
			var StartDateTemp = Date.parse($('#StartDate').val());
			var EndDateTemp = Date.parse($('#EndDate').val());

			StartDateTemp=StartDateTemp-25200000; //ปรับเวลาเป็นเืี่ยงคืน
			EndDateTemp=EndDateTemp-25200000;

			var StartDateTime = new Date();
			StartDateTime.setTime(StartDateTemp);
			var EndDateTime = new Date();
			EndDateTime.setTime(EndDateTemp);
			/*console.log(StartDateTime);
			console.log(EndDateTime);*/
			if(StartDateTemp==EndDateTemp){
				EndDateTime.setDate(EndDateTime.getDate()+1);
				EndDateTime.setSeconds(EndDateTime.getSeconds()-1);
			}else if(countClick==0){
				EndDateTime.setDate(EndDateTime.getDate()+1);
				EndDateTime.setSeconds(EndDateTime.getSeconds()-1);
			}

			DateSecond=(EndDateTime.getTime() - StartDateTemp)/1000; //เวลาที่จะพล็อตกี่วิ
			var satrec = satellite.twoline2satrec(tleLine1, tleLine2);
			
			for(var i = 30 ; i < DateSecond; i+=30){
			 	var date = new Date();
			 	date.setTime(StartDateTemp);
			 	date.setSeconds( date.getSeconds() +i );

			 	timeArr[i]=date;
			 	var positionAndVelocity = satellite.propagate(satrec, date);


			 	var positionEci = positionAndVelocity.position,
			 	velocityEci = positionAndVelocity.velocity;

				// Set the Observer at 122.03 West by 36.96 North, in RADIANS
				var observerGd = {
					longitude:100.92974  * (Math.PI/180),
					latitude: 13.10219	 * (Math.PI/180),
					height:0
				};
				var gmst = satellite.gstimeFromDate(date);

				// You can get ECF, Geodetic, Look Angles, and Doppler Factor.
				var positionEcf   = satellite.eciToEcf(positionEci, gmst),
				observerEcf   = satellite.geodeticToEcf(observerGd),
				positionGd    = satellite.eciToGeodetic(positionEci, gmst),
				lookAngles    = satellite.ecfToLookAngles(observerGd, positionEcf);
				
			  	//  dopplerFactor = satellite.dopplerFactor(observerCoordsEcf, positionEcf, velocityEcf);

				// The coordinates are all stored in key-value pairs.
				// ECI and ECF are accessed by `x`, `y`, `z` properties.
				var satelliteX = positionEci.x,
				satelliteY = positionEci.y,
				satelliteZ = positionEci.z;

				// Look Angles may be accessed by `azimuth`, `elevation`, `range_sat` properties.
				var azimuth   = lookAngles.azimuth,
				elevation = lookAngles.elevation,
				rangeSat  = lookAngles.rangeSat;

				// Geodetic coords are accessed via `longitude`, `latitude`, `height`.
				var longitude = positionGd.longitude,
				latitude  = positionGd.latitude,
				height    = positionGd.height;

				//  Convert the RADIANS to DEGREES for pretty printing (appends "N", "S", "E", "W", etc).
				var longitudeStr = satellite.degreesLong(longitude),
				latitudeStr  = satellite.degreesLat(latitude);
				longitudeStrArr[i] =  longitudeStr;
				latitudeStrArr[i] =  latitudeStr;
				timeArr[i] = date;
				azimuthArr[i] = azimuth*(180/Math.PI);
				elevationArr[i] = elevation*(180/Math.PI);
			}

			if(countClick==0){
				countClick++;
				var arrFree  = new Array(2);
				for(var i = 30 ; i <  DateSecond; i+=30){

					arrFree  = new Array(2);
					if(longitudeStrArr[i-30] > 43 && longitudeStrArr[i] < 150 && latitudeStrArr[i-30] > -29 && latitudeStrArr[i] < 45 ){
						arrFree[0]=([ latitudeStrArr[i-30],longitudeStrArr[i-30] ]);
						arrFree[1]=([ latitudeStrArr[i],longitudeStrArr[i] ]);
						latlngsArr.push(arrFree);

						PolygonArr =(	[[latitudeStrArr[i], longitudeStrArr[i]-3] , [ latitudeStrArr[i], longitudeStrArr[i]+3],
							[latitudeStrArr[i]+1.75, longitudeStrArr[i]+3] , [ latitudeStrArr[i]+1.75, longitudeStrArr[i]-3]] );
						/*console.log(PolygonArr);*/
						layerGroup = layerGroup.addLayer([PolygonArr,timeArr[i],azimuthArr[i],elevationArr[i]]);
					}
				}
				//เพิ่มเส้น
				L.polyline(latlngsArr, {
					color: 'green',
				            weight: 2,//ขนาดของเส้น
				            opacity: .50, //ความโปร่งแสง
				            dashArray: '5,15', //ความถี่มากสุดต่ำสุด
				}).addTo(mymap);

			}
		}else{
		
			if( Date.parse($('#StartDate').val()) > Date.parse($('#EndDate').val())){
				alert("กรุณากรอกเวลาให้ถูกต้อง");
			}
			if( ($('#selectSatellite')[0].innerHTML == 'ดาวเทียม')){
				alert("กรุณาเลือกดาวเทียม");
			}
		}
		});

			//แบบวงกลม
			/*  	 for(var i = 0 ; i < 9*60*60; i+=30){
				L.circle([latitudeStrArr[i],longitudeStrArr[i]]).bindPopup("time = "+ timeArr[i]).addTo(mymap);

			}*/

			//แบบเส้น

		$(document).on('click', '.removeLayerALL', function() {

			
			for(i in mymap._layers) {
				if(mymap._layers[i]._path != undefined) {
					try {
						mymap.removeLayer(mymap._layers[i]);
					}
					catch(e) {
						console.log("problem with " + e + mymap._layers[i]);
					}
				}
				countClick=0;
				L.circle([13.12036, 100.91972], 2000000, {
					color: 'red',
					fillColor: '#f03',
					fillOpacity: 0
				}).addTo(mymap);


			}

		});
		
		function onMapClick(e) {

			for(var j in layerGroup2._layers ){
					// console.log(layerGroup2._layers);
					mymap.removeLayer((layerGroup2._layers[j]));
				}
				//console.log((layerGroup._layers[62])[0][0]);
				

				for(var i in layerGroup._layers ){

					if(	(layerGroup._layers[i])[0][0][0] < e.latlng.lat &&
						(layerGroup._layers[i])[0][0][1] < e.latlng.lng &&
						(layerGroup._layers[i])[0][1][0] < e.latlng.lat &&
						(layerGroup._layers[i])[0][1][1] > e.latlng.lng &&
						(layerGroup._layers[i])[0][2][0] > e.latlng.lat &&
						(layerGroup._layers[i])[0][2][1] > e.latlng.lng &&
						(layerGroup._layers[i])[0][3][0] > e.latlng.lat &&
						(layerGroup._layers[i])[0][3][1] < e.latlng.lng )
					{

						layerGroup2 = layerGroup2.addLayer(
							L.polygon(layerGroup._layers[i],{
								color : 'green' ,
							})
							.addTo(mymap)
							.bindTooltip(	"Time : " + (layerGroup._layers[i])[1] + 
								"<br> AZ : " + (layerGroup._layers[i])[2] + 
								"EL : " + (layerGroup._layers[i])[3] )
							);




					}

				}


			}

			mymap.on('click', onMapClick);

			$( document ).ready(function() {
				$(".testonchange").dropdown({
					onChange: function (value, text , choice) {

						tleLine1=choice[0].dataset.line1;
						tleLine2=choice[0].dataset.line2;
					}
				});
			});
	</script>
@stop
