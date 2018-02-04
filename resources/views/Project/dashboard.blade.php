@extends('layout')
@section('content')
<div class="sixteen wide column">
	<div class="ui grey inverted segment">
		<h2>Dashboard</h2>
	</div>
	


</div>

<div class="eight wide computer eight wide tablet sixteen wide mobile column">

	<div class="ui segment" style="height: 300px;";>
		<center>
			<div class="boxClock">
				<h1>
					<?php
					$mydate=getdate(date("U"));
					echo "$mydate[weekday], $mydate[month] $mydate[mday], $mydate[year]";
					?>

				</h1>
			</div>
		</center>
		<br>
		<div class="clock" id="counter"></div>

	</div>
	<br>
	<div class="ui segment" style="height: ">
		<div class="ui grey inverted segment">
			<h2>ประวัติการรับสัญญาณ</h2>

		</div>
		<div id="highcharts" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
	</div>
	
</div>
<div class="eight wide computer eight wide tablet sixteen wide mobile column">
	<div class=" ui segment">
		<div class="ui grey inverted segment">
			<h2>เช็คเวลารับสัญญาณ</h2>
		</div>
		<div class="ui form">
			<div class="three fields">
				<div class="field" style="display: inline-block;">
					<label>เวลาเริ่มต้น</label>

					<div class="ui left icon input">
						<input type="date" name="StartDate" id="StartDate" placeholder="เวลาเริ่มต้น" value="<?php echo date('Y-m-d'); ?>">
						<i class="calendar icon"></i>
					</div>
				</div>
				<div class="field" style="display: inline-block; margin-left: 5px">
					<label>เวลาสิ้นสุด</label> 
					<div class="ui left icon input">
						<input type="date" name="EndDate" id="EndDate" placeholder="เวลาสิ้นสุด" value="<?php echo date('Y-m-d'); ?>">
						<i class="calendar icon"></i>
					</div>
				</div>
				<div class="field" style="display: inline-block; margin-left: 5px">
					<label>คำนวณ  </label> 
					<button class="ui red button">Submit</button>
				</div>
			</div>
		</div>
		<table class="ui celled table ">
			<thead>
				<tr>
					<th>Date</th>
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
		<br>
		<div class=" ui segment">
			<div class="ui grey inverted segment">
				<h2>ตารางเวลาการควบคุมเสาอากาศ</h2>
			</div>
			<table class="ui celled table">
				

				<thead>
					<th>Date</th>
					<th>Satellite</th>
					<th>Start Time<br>(UTC+7:00)</th>
					
					<th>End<br> time</th>
					
					



				</thead>
				<tr>

					<td>1/11/2560</td>
					<td>NOAA-15</td>
					<td>14:02:10</td>
					
					
					<td>14:16:30</td>
					


				</tr>
				<tr>
					<td>31/10/2560</td>
					<td>NOAA-18</td>
					<td>15:22:10</td>
					
					
					<td>15:36:30</td>
					

				</tr>
				<tr>
					<td>30/10/2560</td>
					<td>NOAA-19</td>
					<td>11:02:12</td>
					
					<td>11:16:23</td>
					
				</table>
			</div>
			<br>
			<div class="ui segment">
				<div class="ui grey inverted segment ">
					<h2>สถานะของอุปกรณ์</h2>
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
				

			</div>
		</div>
		<script type="text/javascript">
			var clock;
			
			$(document).ready(function() {
				var date = new Date();

				clock = $('.clock').FlipClock(date, {
					clockFace: 'TwentyFourHourClock'
				});
			});
		</script>

		<script type="text/javascript">
			Highcharts.chart('highcharts', {
				chart: {
					plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false,
					type: 'pie'
				},
				title: {
					text: 'ประวัติการรับสัญญาณ ประจำปี 2017'
				},
				tooltip: {
					pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
				},
				plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						dataLabels: {
							enabled: true,
							format: '<b>{point.name}</b>: {point.percentage:.1f} %',
							style: {
								color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
							}
						}
					}
				},
				series: [{
					name: 'เปอร์เซ็นการรับ',
					colorByPoint: true,
					data: [{
						name: 'มกราคม',
						y: 14
					}, {
						name: 'กุมภาพันธ์',
						y: 24.03,
						sliced: true,
						selected: true
					}, {
						name: 'มีนาคม',
						y: 10.38
					}, {
						name: 'เมษายน',
						y: 4.77
					}, {
						name: 'พฤษภาคม',
						y: 6
					}, {
						name: 'มิถุนายน',
						y: 2
					}, {
						name: 'กรกฎาคม',
						y: 12
					}, {
						name: 'สิงหาคม',
						y: 20
					}, {
						name: 'กันยายน',
						y:13
					}, {
						name: 'ตุลาคม',
						y: 14.2
					}, {
						name: 'พฤศจิกายน',
						y: 5
					}, {
						name: 'ธันวาคม',
						y: 3
					}]
				}]
			});

		</script>



		@stop