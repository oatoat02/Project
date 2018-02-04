@extends('layout')
@section('content')

<div class="sixteen wide column box1" style="margin: 5px;">
  <center>
   <h1> <i class="send icon" style="width: auto;">  </i>
   Satellite</h1>

   <div class="" id="mapindex">

   </div>
 </center>

 <center>
  <div class="inline fields" style="margin: 10px;">
    <label>ดาวเทียม</label>

    <div class="ui radio checkbox">
      <input type="radio" name="frequency" value="NOAA-15" checked="checked">
      <label>NOAA-15</label>
    </div>


    <div class="ui radio checkbox">
      <input type="radio" name="frequency" value="NOAA-18">
      <label>NOAA-18</label>
    </div>


    <div class="ui radio checkbox">
      <input type="radio" name="frequency" value="NOAA-19">
      <label>NOAA-19</label>

    </div>


  </div>
</center>


<br>
<div class="ui form box3">
  <div class="fields">

    <div class="eight wide field">
      <h3><i class="big file  icon"></i>ตรวจสอบตำแหน่งของดาวเทียม</h3>
      <b>ตรวจสอบตำแหน่งของดาวเทียม</b>
      <p>ตรวจสอบตำแหน่งของดาวเทียม จะระบบุตำแหน่งของดาวเทียมบยโลกโดยจะแสดงตำแหน่งของดาวเทียมและดสเนขแองดาวเทียมที่จะเคลื่อนที่ไป</p>
    </div> 
    <div class="eight wide field">
      <h3><i class="big calendar icon"></i>ตรวจสอบตารางเวลาการรับสัญญาณ</h3>
      <b>ตรวจสอบตารางเวลาการรับสัญญาณ</b>
      <p>ตรวจสอบตารางเวลาการรับสัญญาณ ของดาวเทียมแต่ละดวงโดยแสดงตามวันที่ต้องการค้นหา  ทั้งวันที่ในอดีตและในปัจจุบัน</p>
    </div>
  </div>
</div>
</div>

</div>




<div class="ui inverted menu ">
  <div class="ui four column doubling stackable grid container" style="color: white;">
    <div class="column">
      <center>

        <h2>Satellite</h2>

        <a class="item" href="#"><i class="file icon "></i> ตำแหน่งของดาวเทียม</a>
        <a class="item" href="#"><i class="calendar  icon"></i> ตารางเวลาการรับสัญญาณ</a>
      </center>

    </div>
    <div class="column">
      <center>
        <h2>Member</h2>
        <a class="item" href="#"><i class="sign in icon "></i> เข้าสู่ระบบ</a>
        <a class="item" href="#"><i class="add user icon "></i> สมัครสมาชิก</a>
      </center>
    </div>
    <div class="column">
      <center>
        <h2>Social Network</h2>
        <a class="item" href="#"><i class="icon facebook"></i> Facebook</a>

      </center>
    </div>
    <div class="column">
      <center>
        <h2>About Us</h2>
        <p>Department of Computer Engineering</p>
        <p>Faculty of Engineering at Sriracha,</p>
        <p>Kasetsart University Sriracha Campus</p>
      </center>
    </div>

  </div>
</center>
</div>



<script type="text/javascript">
  /*draw map*/
  var mymap = L.map('mapindex',{
    worldCopyJump: true,
    inertia:false,
  }).setView([0, 0], 1);
  L.tileLayer('http://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png', {
    attribution: 'Department of Computer Engineering,<a href="http://www.src.ku.ac.th/"> Kasetsart University Sriracha Campus </a>',
    minZoom: 1,
    maxZoom: 5, 
    worldCopyJump:true,
    /*zoomSnap: 0.25,*/
    id: 'mapbox.streets',
    accessToken: 'your.mapbox.access.token'
  }).addTo(mymap);

  /*----------------------------------*/

// Sample TLE 
var nameSatellite ="NOAA-15";
var tleLine1 = '1 25338U 98030A   17319.72300734 +.00000042 +00000-0 +36583-4 0  9993',
tleLine2 = '2 25338 098.7792 330.9179 0011414 124.0275 236.1990 14.25825800014346';

// Initialize a satellite record 
var longitudeStrArr = new Array(),
latitudeStrArr  = new Array(),
latlngsArr  = new Array(),
azimuthArr  = new Array(),
elevationArr  = new Array(),
latlngs = new Array();
timeArr = new Array();
var SatelliteIcon = L.layerGroup();
var satrec = satellite.twoline2satrec(tleLine1, tleLine2);


for ( var i = -60*10 ;i < 2*60*60; i+=5){
  var date = new Date();
  
  date.setSeconds( date.getSeconds() +i );

  timeArr[i]=date;
  var positionAndVelocity = satellite.propagate(satrec, date);


  var positionEci = positionAndVelocity.position,
  velocityEci = positionAndVelocity.velocity;

  // Set the Observer at 122.03 West by 36.96 North, in RADIANS 
  var observerGd = {
    longitude:100.92974  * (Math.PI/180),
    latitude: 13.10219   * (Math.PI/180),
    height:10
  };
  var gmst = satellite.gstimeFromDate(date);

  // You can get ECF, Geodetic, Look Angles, and Doppler Factor. 
  var positionEcf   = satellite.eciToEcf(positionEci, gmst),
  observerEcf   = satellite.geodeticToEcf(observerGd),
  positionGd    = satellite.eciToGeodetic(positionEci, gmst),
  lookAngles    = satellite.ecfToLookAngles(observerGd, positionEcf);


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
  azimuthArr[i]=azimuth;
  elevationArr[i]=elevation;
}






L.control.scale().addTo(mymap);
L.control.mousePosition().addTo(mymap);







for(var i = -60*10 ; i < 2*60*60; i+=5){
  arrFree  = new Array(2);

  
  
  if(longitudeStrArr[i-5]>0 && longitudeStrArr[i]>0){

    arrFree[0]=([ latitudeStrArr[i-5],longitudeStrArr[i-5] ]);
    arrFree[1]=([ latitudeStrArr[i],longitudeStrArr[i] ]);
    latlngsArr.push(arrFree);
  }else if(longitudeStrArr[i-5]<0 && longitudeStrArr[i]<0){
    arrFree[0]=([ latitudeStrArr[i-5],longitudeStrArr[i-5] ]);
    arrFree[1]=([ latitudeStrArr[i],longitudeStrArr[i] ]);
    latlngsArr.push(arrFree);  

  }
  
  
  
  
  
  
}

L.polyline(latlngsArr, {
  color: 'red',
                weight: 2,//ขนาดของเส้น
                opacity: .50, //ความโปร่งแสง
                
              }).addTo(mymap);





/*update updateSatellite*/
function updateSatellite(){
  

  var date = new Date();
  

  var positionAndVelocity = satellite.propagate(satrec, date);


  var positionEci = positionAndVelocity.position,
  velocityEci = positionAndVelocity.velocity;

  // Set the Observer at 122.03 West by 36.96 North, in RADIANS 
  var observerGd = {
    longitude:100.92974  * (Math.PI/180),
    latitude: 13.10219   * (Math.PI/180),
    height:10
  };
  var gmst = satellite.gstimeFromDate(date);

  // You can get ECF, Geodetic, Look Angles, and Doppler Factor. 
  var positionEcf   = satellite.eciToEcf(positionEci, gmst),
  observerEcf   = satellite.geodeticToEcf(observerGd),
  positionGd    = satellite.eciToGeodetic(positionEci, gmst),
  lookAngles    = satellite.ecfToLookAngles(observerGd, positionEcf);


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
  
  var greenIcon = L.icon({
    iconUrl: 'Satellite.png',


    iconSize:     [50, 50], // size of the icon

   /* iconAnchor:   [0, 0], // point of the icon which will correspond to marker's location*/

    popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
  });
  
  L.marker([latitudeStr,longitudeStr],{icon: greenIcon}).addTo(SatelliteIcon);
  info.update = function () {
   /* console.log('latitudeStr = '+latitudeStr);
    console.log('longitudeStr = '+longitudeStr);
    */
    this._div.innerHTML = '<h4>Satellite : '+nameSatellite+'</h4>LAT : '+latitudeStr.toFixed( 2 ) +'<br>LNG : '+longitudeStr.toFixed(2)+'';
  };

  info.addTo(mymap);
}
  // control that shows state info on hover
  var info = L.control();

  info.onAdd = function (mymap) {
    this._div = L.DomUtil.create('div', 'info' );
    this.update();
    return this._div;
  };

  


  SatelliteIcon.addTo(mymap);
  /*---------------*/

  /*update checktime*/


  setInterval(function () {
    for(i in SatelliteIcon._layers) {
      mymap.removeLayer(SatelliteIcon._layers[i]);
    }
    
    updateSatellite();
    
  }, 1000);
 /* $(function(){


    setInterval(updateSatellite, 1000);
  });*/

  /*---------------*/

  $(document).on('click', '.meneRes', function() {
    console.log('ssss');
    $('.ui.labeled.icon.sidebar').sidebar('toggle');

  });

</script>




@stop