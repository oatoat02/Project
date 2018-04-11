@extends('layout')
@section('content')
<!-- <link rel="stylesheet" type="text/css" href="/css/slider.css"/>
<link rel="stylesheet" type="text/css" href="/swiper-master/dist/css/swiper.min.css"/>

<script type="text/javascript" src="/swiper-master/dist/js/swiper.min.js"></script> -->
<link rel="stylesheet" type="text/css" href="/css/csslider.default.css"/>
<div class="sixteen wide computer sixteen wide tablet sixteen wide mobile column " box1" style="" >
  <div class="ui segment" >
    <center>
     <h1> 
      <i class="send icon">  </i>
      Satellite
    </h1>
  </center>
  <br>
  <center>
   <div class="csslider">
    <input type="radio" name="slides" id="slides_1" checked />
    <input type="radio" name="slides" id="slides_2" />
    <input type="radio" name="slides" id="slides_3" />

    <ul>
      <li><div class="" id="mapindex1"></div></li>
      <li><div class="" id="mapindex2"></div></li>
      <li><div class="" id="mapindex3"></div></li>

    </ul>
    <div class="arrows">
      <label for="slides_1"></label>
      <label for="slides_2"></label>
      <label for="slides_3"></label>

    </div>
    <div class="navigation">
      <div>
        <label for="slides_1"></label>
        <label for="slides_2"></label>
        <label for="slides_3"></label>

      </div>
    </div>
  </div>
</center>
</div>

<div class="ui form segment box3" style="margin: 20px!important;">
  <div class="fields">

    <div class="eight wide field">
      <h3><i class="big file  icon"></i>ตรวจสอบตำแหน่งของดาวเทียม</h3>
      <label>ตรวจสอบตำแหน่งของดาวเทียม</label>
      <p>ตรวจสอบตำแหน่งของดาวเทียม จะระบบุตำแหน่งของดาวเทียมบนโลกโดยจะแสดงตำแหน่งของดาวเทียมและแสดงเส้นทางของดาวเทียมที่จะเคลื่อนที่ไป</p>
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

        <a class="item" href="{{ route('Project.position') }}"><i class="file icon "></i> ตำแหน่งของดาวเทียม</a>
        <a class="item" href="{{ route('Project.checksatellite') }}"><i class="calendar  icon"></i> ตารางเวลาการรับสัญญาณ</a>
      </center>

    </div>
    <div class="column">
      <center>
        <h2>Member</h2>
        <a class="item" href="{{ route('Project.login') }}"><i class="sign in icon "></i> เข้าสู่ระบบ</a>
       
      </center>
    </div>
    <div class="column">
      <center>
        <h2>Social Network</h2>
        <a class="item" href="https://www.facebook.com/gistda/"><i class="icon facebook"></i> GISTDA</a>
        <a class="item" href="https://www.facebook.com/engineeringSRC/"><i class="icon facebook"></i> Faculty of Engineering at Sriracha</a>
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


  /*----------------------------------*/
  function test1(){
// Sample TLE 
var nameSatellite ='<?php echo $tleNOAA15->name ?>';
var tleLine1 = '<?php echo $tleNOAA15->line1 ?>',
tleLine2 = '<?php echo $tleNOAA15->line2 ?>';

// Initialize a satellite record 
var longitudeStrArr1 = new Array(),
latitudeStrArr1  = new Array(),
latlngsArr1  = new Array(),
azimuthArr1  = new Array(),
elevationArr1  = new Array(),
timeArr1 = new Array();
startlat1=-99,
startlngs1=-99;
var SatelliteIcon1 = L.layerGroup(); 
var satrec = satellite.twoline2satrec(tleLine1, tleLine2);


for ( var i = -60*10 ;i < 2*60*60; i+=5){
  var date = new Date();
  
  date.setSeconds( date.getSeconds() +i );

  timeArr1[i]=date;
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
  longitudeStrArr1[i] =  longitudeStr;
  latitudeStrArr1[i] =  latitudeStr;
  azimuthArr1[i]=azimuth;
  elevationArr1[i]=elevation;
  if(startlat1==-99 && startlngs1 == -99)
  {
    startlat1=latitudeStr;
    startlngs1=longitudeStr;
  }
}

for(var i = -60*10 ; i < 2*60*60; i+=5){
  arrFree  = new Array(2);  
  if(longitudeStrArr1[i-5]>0 && longitudeStrArr1[i]>0){

    arrFree[0]=([ latitudeStrArr1[i-5],longitudeStrArr1[i-5] ]);
    arrFree[1]=([ latitudeStrArr1[i],longitudeStrArr1[i] ]);
    latlngsArr1.push(arrFree);
  }else if(longitudeStrArr1[i-5]<0 && longitudeStrArr1[i]<0){
    arrFree[0]=([ latitudeStrArr1[i-5],longitudeStrArr1[i-5] ]);
    arrFree[1]=([ latitudeStrArr1[i],longitudeStrArr1[i] ]);
    latlngsArr1.push(arrFree);  

  }
  
  
}
/*draw map*/
var mymap1 = L.map('mapindex1',{
  worldCopyJump: true,
  inertia:false,
}).setView([startlat1, startlngs1], 2);
L.tileLayer('http://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png', {
  attribution: 'Department of Computer Engineering,<a href="http://www.src.ku.ac.th/"> Kasetsart University Sriracha Campus </a>',
  minZoom: 2,
  maxZoom: 5, 
  /*zoomSnap: 0.25,*/
  id: 'mapbox.streets',
    // subdomains:['mt0','mt1','mt2','mt3'],
    accessToken: 'your.mapbox.access.token'
  }).addTo(mymap1);
var WorldWarp=[[85,-180], [85, 232], [-85,232], [-85,-180]];
mymap1.setMaxBounds(WorldWarp);
L.control.scale().addTo(mymap1);


L.polyline(latlngsArr1, {
  color: 'red',
                weight: 2,//ขนาดของเส้น
                opacity: .50, //ความโปร่งแสง
                
              }).addTo(mymap1);





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
  
  var Icon = L.icon({
    iconUrl: 'Satellite.png',


    iconSize:     [50, 50], // size of the icon

    /* iconAnchor:   [0, 0], // point of the icon which will correspond to marker's location*/

    popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
  });
  
  L.marker([latitudeStr,longitudeStr],{icon: Icon}).addTo(SatelliteIcon1);

  info.update = function () {
    this._div.innerHTML = '<h4>Satellite : '+nameSatellite+'</h4>LAT : '+latitudeStr.toFixed( 2 ) +'<br>LNG : '+longitudeStr.toFixed(2)+'';
  };

  info.addTo(mymap1);
}
  // control that shows state info on hover
  var info = L.control();
  info.onAdd = function (mymap1) {
    this._div = L.DomUtil.create('div', 'info' );
    this.update();
    return this._div;
  };
  SatelliteIcon1.addTo(mymap1);
  // console.log(SatelliteIcon1);
  /*---------------*/
  /*update checktime*/
  setInterval(function () {
    // console.log(SatelliteIcon1);
    // console.log(SatelliteIcon1);
    for(i in SatelliteIcon1._layers) {
      mymap1.removeLayer(SatelliteIcon1._layers[i]);
    } 
    updateSatellite(); 
  }, 1000);
}




/*----------------------------------*/
function test2(){
// Sample TLE 
var nameSatellite ='<?php echo $tleNOAA18->name ?>';
var tleLine1 = '<?php echo $tleNOAA18->line1 ?>',
tleLine2 = '<?php echo $tleNOAA18->line2 ?>';

// Initialize a satellite record 
var longitudeStrArr = new Array(),
latitudeStrArr  = new Array(),
latlngsArr  = new Array(),
azimuthArr  = new Array(),
elevationArr  = new Array(),
latlngs = new Array();
timeArr = new Array();
startlat=-99,
startlngs=-99;
var SatelliteIcon2 = L.layerGroup();
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
  if(startlat==-99 && startlngs == -99)
  {
    startlat=latitudeStr;
    startlngs=longitudeStr;
  }
}

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
/*draw map*/
var mymap2 = L.map('mapindex2',{
  worldCopyJump: true,
  inertia:false,
}).setView([startlat, startlngs], 2);
L.tileLayer('http://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png', {
  attribution: 'Department of Computer Engineering,<a href="http://www.src.ku.ac.th/"> Kasetsart University Sriracha Campus </a>',
  minZoom: 2,
  maxZoom: 5, 
  /*zoomSnap: 0.25,*/
  id: 'mapbox.streets',
    // subdomains:['mt0','mt1','mt2','mt3'],
    accessToken: 'your.mapbox.access.token'
  }).addTo(mymap2);
var WorldWarp=[[85,-180], [85, 232], [-85,232], [-85,-180]];
mymap2.setMaxBounds(WorldWarp);
L.control.scale().addTo(mymap2);


L.polyline(latlngsArr, {
  color: 'red',
                weight: 2,//ขนาดของเส้น
                opacity: .50, //ความโปร่งแสง
                
              }).addTo(mymap2);





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
  
  L.marker([latitudeStr,longitudeStr],{icon: greenIcon}).addTo(SatelliteIcon2);
  info.update = function () {
   /* console.log('latitudeStr = '+latitudeStr);
    console.log('longitudeStr = '+longitudeStr);
    */
    this._div.innerHTML = '<h4>Satellite : '+nameSatellite+'</h4>LAT : '+latitudeStr.toFixed( 2 ) +'<br>LNG : '+longitudeStr.toFixed(2)+'';
  };

  info.addTo(mymap2);
}
  // control that shows state info on hover
  var info = L.control();
  info.onAdd = function (mymap2) {
    this._div = L.DomUtil.create('div', 'info' );
    this.update();
    return this._div;
  };
  SatelliteIcon2.addTo(mymap2);
   // console.log(SatelliteIcon2);
   /*---------------*/
   /*update checktime*/
   setInterval(function () {
    // console.log(SatelliteIcon2);
    for(i in SatelliteIcon2._layers) {
      mymap2.removeLayer(SatelliteIcon2._layers[i]);
    } 
    updateSatellite(); 
  }, 1000);
 }

 function test3(){
// Sample TLE 
var nameSatellite ='<?php echo $tleNOAA20->name ?>';
var tleLine1 = '<?php echo $tleNOAA20->line1 ?>',
tleLine2 = '<?php echo $tleNOAA20->line2 ?>';

// Initialize a satellite record 
var longitudeStrArr = new Array(),
latitudeStrArr  = new Array(),
latlngsArr  = new Array(),
azimuthArr  = new Array(),
elevationArr  = new Array(),
latlngs = new Array();
timeArr = new Array();
startlat=-99,
startlngs=-99;
var SatelliteIcon3 = L.layerGroup();
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
  if(startlat==-99 && startlngs == -99)
  {
    startlat=latitudeStr;
    startlngs=longitudeStr;
  }
}

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
/*draw map*/
var mymap3 = L.map('mapindex3',{
  worldCopyJump: true,
  inertia:false,
}).setView([startlat, startlngs], 2);
L.tileLayer('http://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png', {
  attribution: 'Department of Computer Engineering,<a href="http://www.src.ku.ac.th/"> Kasetsart University Sriracha Campus </a>',
  minZoom: 2,
  maxZoom: 5, 
  /*zoomSnap: 0.25,*/
  id: 'mapbox.streets',
    // subdomains:['mt0','mt1','mt2','mt3'],
    accessToken: 'your.mapbox.access.token'
  }).addTo(mymap3);
var WorldWarp=[[85,-180], [85, 232], [-85,232], [-85,-180]];
mymap3.setMaxBounds(WorldWarp);
L.control.scale().addTo(mymap3);


L.polyline(latlngsArr, {
  color: 'red',
                weight: 2,//ขนาดของเส้น
                opacity: .50, //ความโปร่งแสง
                
              }).addTo(mymap3);





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
  
  L.marker([latitudeStr,longitudeStr],{icon: greenIcon}).addTo(SatelliteIcon3);
  info.update = function () {
   /* console.log('latitudeStr = '+latitudeStr);
    console.log('longitudeStr = '+longitudeStr);
    */
    this._div.innerHTML = '<h4>Satellite : '+nameSatellite+'</h4>LAT : '+latitudeStr.toFixed( 2 ) +'<br>LNG : '+longitudeStr.toFixed(2)+'';
  };

  info.addTo(mymap3);
}
  // control that shows state info on hover
  var info = L.control();
  info.onAdd = function (mymap3) {
    this._div = L.DomUtil.create('div', 'info' );
    this.update();
    return this._div;
  };
  SatelliteIcon3.addTo(mymap3);
   // console.log(SatelliteIcon3);
   /*---------------*/
   /*update checktime*/
   setInterval(function () {
    // console.log(SatelliteIcon3);
    for(i in SatelliteIcon3._layers) {
      mymap3.removeLayer(SatelliteIcon3._layers[i]);
    } 
    updateSatellite(); 
  }, 1000);
 }

 setInterval(function () {
  test1();
  test2();
  test3();
}, 1000);
</script>


@stop