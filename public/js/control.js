

	circle = L.circle([13.12036, 100.91972], 2000000);
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
		var circle;

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
		var timestamp=-999;
		var arrControl = Array();
		var ArrData  = new Array();
		var ArrDataControl = Array();
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

		var SelectTime = $('#SelectTime').val();
		if( StartDateTemp > EndDateTemp || isNaN(EndDateTemp) || isNaN(StartDateTemp) ){
			$.uiAlert({
		            textHead: "กรุณากรอกเวลาให้ถูกต้อง", // header
		            text: '', // Text
		            bgcolor: '#DB2828', // background-color
		            textcolor: '#fff', // color
		            position: 'top-center',// position . top And bottom ||  left / center / right
		            icon: 'remove circle', // icon in semantic-UI
		            time: 3, // time
		        })

		}
		if( ($('#selectSatellite')[0].innerHTML == 'ดาวเทียม')){
			$.uiAlert({
		            textHead: "กรุณาเลือกดาวเทียม", // header
		            text: '', // Text
		            bgcolor: '#DB2828', // background-color
		            textcolor: '#fff', // color
		            position: 'top-center',// position . top And bottom ||  left / center / right
		            icon: 'remove circle', // icon in semantic-UI
		            time: 3, // time
		        })
		}

		if( ($('#selectSatellite')[0].innerHTML != 'ดาวเทียม') && ( StartDateTemp <= EndDateTemp) )
		{

			alert('กำลังประมวณผล')

			circle = L.circle([13.12036, 100.91972], 2000000);

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

			calculate();
			function calculate()
			{
				
				
				for(var i = 1 ; i < DateSecond; i+=1)
				{

					var date = new Date();
					date.setTime(StartDateTemp);
					date.setSeconds( date.getSeconds() +i );
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
				var arrFree  = new Array(3);
				var countINrec=0;
				var jumlatStart = -999;
				var jumlongStart = -999;
				var jumlatStop = -999;
				var jumlongStop = -999;
				var azimuthStart=-999;
				var azimuthEnd=-999;
				var Maxelevation=-999;
				var timeStart=-999;
				var timestamp=-999;

				var timeStop=-999;
				var Maxelevation=-999;
				var ArrTT  = new Array();
				ArrData  = new Array();
				ArrDataControl  = new Array();
				arrControl = new Array();
				for(var i = 1 ; i <  DateSecond; i+=1)
				{
					arrFree  = new Array(3);
					if(($('#SelectTime').text()) == "กลางวัน")
					{

						if( (timeArr[i].getHours()) >= 6  && (timeArr[i].getHours())<18 )
						{

							if( (circle.getLatLng().distanceTo([latitudeStrArr[i],longitudeStrArr[i]])) <= circle.getRadius() )
							{
								if(jumlatStart==-999 && jumlongStart==-999)
								{
									jumlatStart=latitudeStrArr[i];
									jumlongStart=longitudeStrArr[i];
									azimuthStart=azimuthArr[i];
									timeStart=timeArr[i];
									timestamp=timeArr[i].getTime();
									

								}
								if(Maxelevation<elevationArr[i])
								{
									Maxelevation=elevationArr[i];
								}
								jumlatStop=latitudeStrArr[i];
								jumlongStop=longitudeStrArr[i];
								azimuthEnd=azimuthArr[i];
								timeStop=timeArr[i];

								arrFree[0] = timeArr[i].toLocaleString();
								arrFree[1] = azimuthArr[i];
								arrFree[2] = elevationArr[i]
								arrControl.push(arrFree);

							}
							else if(jumlatStart != -999)
							{
								/*ArrTT.push([ [jumlatStart,jumlongStart], [jumlatStop,jumlongStop]]);*/
								ArrData.push([timeStart,timeStop,azimuthStart,azimuthEnd,Maxelevation,_id,timestamp]);
								ArrDataControl.push(arrControl);

								jumlatStart = -999;
								jumlongStart = -999;
								jumlatStop = -999;
								jumlongStop = -999;
								azimuthEnd=-999;
								azimuthStart=-999;
								Maxelevation=-999;
								timeStop=-999;
								timeStop=-999;
								arrControl = new Array();
							}

							
						}
					}
					else if(($('#SelectTime').text()) == "กลางคืน")
					{	

						if( ( (timeArr[i].getHours()) >= 18  && (timeArr[i].getHours())<24) || ( (timeArr[i].getHours()) > 0  && (timeArr[i].getHours())<6) )
						{
							if( (circle.getLatLng().distanceTo([latitudeStrArr[i],longitudeStrArr[i]])) <= circle.getRadius() )
							{
								if(jumlatStart==-999 && jumlongStart==-999)
								{
									jumlatStart=latitudeStrArr[i];
									jumlongStart=longitudeStrArr[i];
									azimuthStart=azimuthArr[i];
									timeStart=timeArr[i];
									timestamp=timeArr[i].getTime();
								}
								if(Maxelevation<elevationArr[i])
								{
									Maxelevation=elevationArr[i];
								}
								jumlatStop=latitudeStrArr[i];
								jumlongStop=longitudeStrArr[i];
								azimuthEnd=azimuthArr[i];
								timeStop=timeArr[i];

								arrFree[0] = timeArr[i].toLocaleString();
								arrFree[1] = azimuthArr[i];
								arrFree[2] = elevationArr[i]
								arrControl.push(arrFree);
							}
							else if(jumlatStart != -999)
							{


								ArrData.push([timeStart,timeStop,azimuthStart,azimuthEnd,Maxelevation,_id,timestamp]);

								ArrDataControl.push(arrControl);
								jumlatStart = -999;
								jumlongStart = -999;
								jumlatStop = -999;
								jumlongStop = -999;
								azimuthEnd=-999;
								azimuthStart=-999;
								Maxelevation=-999;
								timeStop=-999;
								timeStop=-999;
								arrControl = new Array();
							}
						}

					}
					else if( ($('#SelectTime').text()) == "ทั้งหมด")
					{
						if( (circle.getLatLng().distanceTo([latitudeStrArr[i],longitudeStrArr[i]])) <= circle.getRadius() )
						{
							if(jumlatStart==-999 && jumlongStart==-999)
							{
								jumlatStart=latitudeStrArr[i];
								jumlongStart=longitudeStrArr[i];
								azimuthStart=azimuthArr[i];
								timeStart=timeArr[i];
								timestamp=timeArr[i].getTime();

							}
							if(Maxelevation<elevationArr[i])
							{
								Maxelevation=elevationArr[i];
							}
							jumlatStop=latitudeStrArr[i];
							jumlongStop=longitudeStrArr[i];
							azimuthEnd=azimuthArr[i];
							timeStop=timeArr[i];
							arrFree[0] = timeArr[i].toLocaleString();
							arrFree[1] = azimuthArr[i];
							arrFree[2] = elevationArr[i]
							arrControl.push(arrFree);
						}
						else if(jumlatStart != -999)
						{
							ArrData.push([timeStart,timeStop,azimuthStart,azimuthEnd,Maxelevation,_id,timestamp]);
							ArrDataControl.push(arrControl);

							jumlatStart = -999;
							jumlongStart = -999;
							jumlatStop = -999;
							jumlongStop = -999;
							azimuthEnd=-999;
							azimuthStart=-999;
							Maxelevation=-999;
							timeStop=-999;

							arrControl = new Array();
						}
					}
				}
				if(ArrData.length==0){
					alert('ไม่มีเวลาที่สามารถรับสัญญาณได้')
				}
			}

		}
		$("#tableshow tr").remove();	
		var tostring = ArrDataControl.toString();
		// console.log(ArrDataControl);
		for (var i = 0; i < ArrData.length ; i++) 
		{
			var text ='';
			for(var j = 0 ; j < ArrDataControl[i].length ; j++)
			{
				if( j == ArrDataControl[i].length -1)
				{
					text =text+ String(ArrDataControl[i][j][0])+','+String(ArrDataControl[i][j][1])+','+String(ArrDataControl[i][j][2]);
				}
				else if( j != ArrDataControl[i].length)
				{
					text =text+ String(ArrDataControl[i][j][0])+','+String(ArrDataControl[i][j][1])+','+String(ArrDataControl[i][j][2])+',';
				}
			}
			//console.log(text);
			$('#tableshow').append("<tr class='item' id="+ArrData[i][5]+"> <td>"+ArrData[i][0].getDate()+"/"+(ArrData[i][0].getMonth()+1)+"/"+ArrData[i][0].getFullYear()+"</td><td>"+ArrData[i][0].toLocaleTimeString()+"</td><td>"+ArrData[i][1].toLocaleTimeString()+"</td>"+
				"<td class=ui compact striped> <form action='{{ route('Project.showtimecontrol') }}' method='post'>"+
				"<input type='hidden' name='_token' value='{{ csrf_token() }}'>"+
				"<input type='number' name='timestamp' value="+ArrData[i][6]+" style=display:none;>" +
				"<input type='hidden' name='control' value='"+text+"'>"+
				"<input type='hidden' name='namesatellite' value='"+ $('#selectSatellite').text()+"'>"+
				"<center><button class='ui green button' style='width:80%' type='submit'>ดูรายละเอียด</button> </center>"+
				"</form></td></tr>");
		}

	});


$(document).on('click', '.removeLayerALL', function() {

	$("#tableshow tr").remove();




});


$( document ).ready(function() {
	$(".testonchange").dropdown({
		onChange: function (value, text , choice) {

			tleLine1=choice[0].dataset.line1;
			tleLine2=choice[0].dataset.line2;
			_id=choice[0].dataset._id;

		}
	});
});

