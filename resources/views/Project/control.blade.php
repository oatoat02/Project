@extends('layout')
@section('content')

<div class="eight wide computer eight wide tablet sixteen wide mobile column"> 
	<div class="ui segment" style="height: 100%">
		<div class="ui grey inverted segment " >
			<h2>มุมองศาของเสาอากาศ</h2>
		</div>
		<center>
			<div class="ui form" >
				<div class="two inline fields">
					
					<div class="eight wide field" style="margin-top: 10px;">
						Azimuth (ปัจจุบัน)&nbsp;&nbsp;
						<input type="text" placeholder=" " value="149.0235893" disabled >
					</div>
					<div class="eight wide field">
						Azimuth&nbsp;&nbsp;
						<input type="text" placeholder=" " >
					</div>
					
				</div>

				<div class="two inline fields">

					
					<div class="eight wide field">
						Elevation (ปัจจุบัน)&nbsp;&nbsp;
						<input type="text" placeholder=" " value="0" disabled >
					</div>
					<div class="eight wide field">
						Elevation&nbsp;&nbsp;
						<input type="text" placeholder=" "  >
					</div>
					
				</div>



			</div>
			
			<br>
			<button class="ui black button">ปรับมุมองศา</button>
			<button class="ui red button" onclick="testclick()">ทดสอบ</button>
		</center>
	</div>
</div>
<div class="eight wide computer eight wide tablet sixteen wide mobile column"> 
	<div class="ui segment">
		<div class="ui grey inverted segment ">
			<h2>ดาวเทียมที่ติดต่อ</h2>
		</div>
		
		<table class="ui celled table" >
			

			<thead>
				<th>ชื่อดาวเทียม</th>
				<th>วันที่อัพเดทขอมูล</th>
				<th>อัพเดทข้อมูล</th>
				<th>ลบข้อมูล</th>
				
				



			</thead>
			<tbody>
				<tr>

					<td>NOAA-15</td>
					<td>17/11/2560</td>
					<td><button class="ui yellow button editpasswordUser" style="width: 100%">อัพเดท TLE</button></td>
					<td><button class="ui red button editpasswordUser" style="width: 100%">ลบ</button></td>


				</tr>
				<tr>
					<td>NOAA-18</td>
					<td>18/11/2560</td>
					<td><button class="ui yellow button editpasswordUser" style="width: 100%">อัพเดท TLE</button></td>
					<td><button class="ui red button editpasswordUser" style="width: 100%">ลบ</button></td>
					


				</tr>
				<tr>
					<td>NOAA-19</td>
					<td>20/11/2560</td>
					<td><button class="ui yellow button editpasswordUser" style="width: 100%">อัพเดท TLE</button></td>
					<td><button class="ui red button editpasswordUser" style="width: 100%">ลบ</button></td>
					


				</tr>
				
				

			</tbody>


		</table>
		เพิ่มดาวเทียม
		<div>
			TLE 1 : &nbsp; <div class="ui input ">
				<input type="text" >
			</div>
			TLE 2 : &nbsp; <div class="ui input ">
				<input type="text" >
			</div>
			&nbsp; &nbsp; &nbsp; 
			<button class="ui green button item " type="submit" > ยืนยัน</button>
		</div>
	</div>
</div>
<div class="sixteen wide  column ui segment" style="margin: 10px !important">
	<div class="ui grey inverted segment ">
		<center><h2>ตารางเวลาการควบคุมเสาอากาศ</h2></center>
	</div>
	
	<table class="ui celled table">
		

		<thead>
			<th>Date</th>
			<th>Satellite</th>
			<th>Start Time<br>(UTC+7:00)</th>
			<th>Start<br> Azimuth</th>
			<th>End <br>Azimuth</th>
			<th>Maximum<br> Elevation</th>
			<th>End time <br>(UTC+7:00)</th>
			<th>Delete</th>
			



		</thead>
		<tbody>
			<tr>

				<td>1/11/2560</td>
				<td>NOAA-15</td>
				<td>14:02:10</td>
				<td>149.0235893</td>
				<td>5.021346</td>
				<td>50.021346</td>
				<td>14:16:30</td>
				<td><button class="ui red button editpasswordUser" style="width: 100%">ลบ</button></td>


			</tr>
			<tr>
				<td>31/10/2560</td>
				<td>NOAA-18</td>
				<td>15:22:10</td>
				<td>149.0235893</td>
				
				<td>5.021346</td>
				<td>65.021346</td>
				<td>15:36:30</td>
				<td><button class="ui red button editpasswordUser" style="width: 100%">ลบ</button></td>


			</tr>
			<tr>
				<td>30/10/2560</td>
				<td>NOAA-19</td>
				<td>11:02:12</td>
				<td>149.0235893</td>
				
				<td>5.021346</td>
				<td>52.021346</td>
				<td>11:16:23</td>
				<td><button class="ui red button editpasswordUser" style="width: 100%">ลบ</button></td>


			</tr>
			
		</tbody>


	</table>
</div>



<script type="text/javascript">
	var d = new Date();
	var n = d.getDate();
	console.log(d);
	console.log(n);
</script>
<script type="text/javascipt">

</script>

@stop