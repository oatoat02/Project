
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

		/*// define rectangle geographical bounds
		var Rectangle = [[31.10, 82.4331], [-5,119.4]];
		L.rectangle(Rectangle, {color: "#ff7800", weight: 1}).addTo(mymap);
		mymap.fitBounds(Rectangle);
		// Sample TLE*/
		var tleLine1 = '',
		tleLine2 = '',
		_id='';

		// Initialize a satellite record
		var longitudeStrArr = new Array(),
		latitudeStrArr  = new Array(),
		latlngsArr  = new Array(),
		latlngsTest  = new Array(),
		azimuthArr  = new Array(),
		elevationArr  = new Array(),
		latlngsDaylight = new Array(),
		latlngsNight = new Array(),
		PolygonArr  = [];
		timeArr = new Array();
		var DateSecond;
		var polygon;
		var layerGroup = new L.LayerGroup();
		var layerGroup2 = new L.LayerGroup();
		/* L.polyline([latitudeStrArr[1],longitudeStrArr[1]]).addTo(mymap);*/
		$(document).on('click', '.SubmitCal', function(){
			//console.log(mymap);
			longitudeStrArr =  Array(),
			latitudeStrArr  =  Array(),
			latlngsArr  =  Array(),
			azimuthArr  =  Array(),
			elevationArr  =  Array()
			PolygonArr  = [];
			timeArr =  Array();
			var ArrData  = new Array();
			var DateStartDefault=$('#StartDate').val();
				var DateStartSet=DateStartDefault.split('/')[0];
				var MonthStartSet=DateStartDefault.split('/')[1];
				var YearStartSet=DateStartDefault.split('/')[2];
				
				var DateEndDefault=$('#EndDate').val();
				var DateEndtSet=DateEndDefault.split('/')[0];
				var MonthEndSet=DateEndDefault.split('/')[1];
				var YearhEndSet=DateEndDefault.split('/')[2];

				var StartDateMDY = MonthStartSet+'/'+DateStartSet+'/'+YearStartSet;
				var EndDateMDY = MonthEndSet+'/'+DateEndtSet+'/'+YearhEndSet;
				var StartDateTemp = Date.parse(StartDateMDY);
				var EndDateTemp = Date.parse(EndDateMDY);

			if( ($('#selectSatellite')[0].innerHTML != 'ดาวเทียม') && ( StartDateTemp <= EndDateTemp) )
			{


				for(i in mymap._layers) 
				{
					if(mymap._layers[i]._path != undefined) 
					{
						try {
							mymap.removeLayer(mymap._layers[i]);
						}
						catch(e) {
							console.log("problem with " + e + mymap._layers[i]);
						}
					}
				}
				
				layerGroup.clearLayers();
				
				for(var j in layerGroup._layers )
				{
					
					mymap.removeLayer(layerGroup._layers[j]);
				}
				
				L.circle([13.12036, 100.91972], 2000000, {
					color: 'red',
					fillColor: '#f03',
					fillOpacity: 0
				}).addTo(mymap);



				StartDateTemp=StartDateTemp; //ปรับเวลาเป็นเืี่ยงคืน
				EndDateTemp=EndDateTemp;

				//var subDate=StartDateTemp.substring(1, 4);
				var StartDateTime = new Date();
				StartDateTime.setTime(StartDateTemp);
				var EndDateTime = new Date();
				EndDateTime.setTime(EndDateTemp);

				EndDateTime.setDate(EndDateTime.getDate()+1);
				EndDateTime.setSeconds(EndDateTime.getSeconds()-1);

			
				DateSecond=(EndDateTime.getTime() - StartDateTemp)/1000; //เวลาที่จะพล็อตกี่วิ
				var satrec = satellite.twoline2satrec(tleLine1, tleLine2);
				
				for(var i = 30 ; i < DateSecond; i+=30)
				{
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
					azimuthArr[i] = Math.ceil(azimuth*(180/Math.PI));
					elevationArr[i] = Math.ceil(elevation*(180/Math.PI));
				}
				var arrFree  = new Array(2);
				var countINrec=0;
				var jumlatStart = -999;
				var jumlongStart = -999;
				var jumlatStop = -999;
				var jumlongStop = -999;
				var azimuthStart=-999;
				var azimuthEnd=-999;
				var Maxelevation=-999;
				var timeStart=-999;
				var timeStop=-999;
				var Maxelevation=-999;
				var ArrTT  = new Array();
				ArrData  = new Array();
				for(var i = 30 ; i <  DateSecond; i+=30)
				{

					arrFree  = new Array(2);
					if(longitudeStrArr[i-30] > 43 && longitudeStrArr[i] < 150 && latitudeStrArr[i-30] > -29 && latitudeStrArr[i] < 45 )
					{

						arrFree[0]=([ latitudeStrArr[i-30],longitudeStrArr[i-30] ]);
						arrFree[1]=([ latitudeStrArr[i],longitudeStrArr[i] ]);
						latlngsArr.push(arrFree);
						//console.log(latlngsArr);

						var nameSattellite = $('#selectSatellite')[0].innerHTML;
						PolygonArr =(	[[latitudeStrArr[i], longitudeStrArr[i]-3] , [ latitudeStrArr[i], longitudeStrArr[i]+3],
							[latitudeStrArr[i]+1.75, longitudeStrArr[i]+3] , [ latitudeStrArr[i]+1.75, longitudeStrArr[i]-3]]);
						layerGroup = layerGroup.addLayer([PolygonArr,timeArr[i],azimuthArr[i],elevationArr[i],nameSattellite]);
					}
				
					if(longitudeStrArr[i-30] > 85 && longitudeStrArr[i] < 116 && latitudeStrArr[i-30] > -3 && latitudeStrArr[i] < 29 )
					{
						if(jumlatStart==-999 && jumlongStart==-999)
						{
							jumlatStart=latitudeStrArr[i];
							jumlongStart=longitudeStrArr[i];
							azimuthStart=azimuthArr[i];
							timeStart=timeArr[i];
						}
						if(Maxelevation<elevationArr[i]){
							Maxelevation=elevationArr[i];
						}
						jumlatStop=latitudeStrArr[i];
						jumlongStop=longitudeStrArr[i];
						azimuthEnd=azimuthArr[i];
						timeStop=timeArr[i];
					}
					else if(jumlatStart != -999){
						/*ArrTT.push([ [jumlatStart,jumlongStart], [jumlatStop,jumlongStop]]);*/
						ArrData.push([timeStart,timeStop,azimuthStart,azimuthEnd,Maxelevation,_id]);
						
						jumlatStart = -999;
						jumlongStart = -999;
						jumlatStop = -999;
						jumlongStop = -999;
						azimuthEnd=-999;
						azimuthStart=-999;
						Maxelevation=-999;
						timeStop=-999;
						timeStop=-999;
					}

				}
			/*	L.polyline(ArrTT, {
					color: 'blue',
					            weight: 2,//ขนาดของเส้น
					            opacity: .50, //ความโปร่งแสง
					            dashArray: '5,15', //ความถี่มากสุดต่ำสุด
					        }).addTo(mymap);
*/
					L.polyline(latlngsArr, {
						color: 'green',
					            weight: 2,//ขนาดของเส้น
					            opacity: .50, //ความโปร่งแสง
					            dashArray: '5,15', //ความถี่มากสุดต่ำสุด
					        }).addTo(mymap);
				}

			if( StartDateTemp > EndDateTemp){
				alert("กรุณากรอกเวลาให้ถูกต้อง");
			}
			if( ($('#selectSatellite')[0].innerHTML == 'ดาวเทียม')){
				alert("กรุณาเลือกดาวเทียม");
			}

			$("#tableshow tr").remove();
			for (var i = 0; i < ArrData.length ; i++) { 
			
				$('#tableshow').append("<tr class='item' id="+ArrData[i][5]+"> <td>"+ArrData[i][0].getDate()+"/"+(ArrData[i][0].getMonth()+1)+"/"+ArrData[i][0].getFullYear()+"</td><td>"+ArrData[i][0].toLocaleTimeString()+"</td><td>"+ArrData[i][2]+"</td><td>"+ArrData[i][3]+"</td><td>"+ArrData[i][4]+"</td><td>"+ArrData[i][1].toLocaleTimeString()+"</tr>");/*
				$('#tableshow').append("<tr class=""><td>ssssssssss</td></tr>");*/


			}
		});


			$(document).on('click', '.removeLayerALL', function() {

				$("#tableshow tr").remove();

				for(i in mymap._layers) {
					if(mymap._layers[i]._path != undefined) {
						try {
							mymap.removeLayer(mymap._layers[i]);
						}
						catch(e) {
							console.log("problem with " + e + mymap._layers[i]);
						}
					}
				
					L.circle([13.12036, 100.91972], 2000000, {
						color: 'red',
						fillColor: '#f03',
						fillOpacity: 0
					}).addTo(mymap);


				}
				

			});

			function onMapClick(e) {

				for(var j in layerGroup2._layers ){
					mymap.removeLayer((layerGroup2._layers[j]));
				}
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
						/*console.log((layerGroup._layers[i])[1]);*/
						layerGroup2 = layerGroup2.addLayer(
						L.polygon(layerGroup._layers[i][0],{
							color : 'green' ,
						})
						.addTo(mymap)
						.bindTooltip((layerGroup._layers[i])[4]+	" Time : " + (layerGroup._layers[i])[1] + 
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
						_id=choice[0].dataset._id;
						
					}
				});
			});
	