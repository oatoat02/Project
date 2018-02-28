@extends('layout')
@section('content')
<div class="sixteen wide column">
	<div class="ui grey inverted segment">
		<h2>Dashboard</h2>
	</div>
	


</div>

<div class="eight wide computer eight wide tablet sixteen wide mobile column">

	<div class="ui segment" style="height: 300px">
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
		<div class="clock" id="counter" style="width: 530px"></div>

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
			<div class="two fields">
				<div class="field" style="display: inline-block;">
					<label>เวลาเริ่มต้น</label>

					<div class="ui calendar" id="Startcalendar">
						<div class="ui left icon input">
							<input type="text" name="StartDate" id="StartDate" onchange="onChangeDateStart()" value="<?php echo date('d/m/Y'); ?>">
							<i class="calendar icon"></i>
						</div>
					</div>
				</div>
				<div class="field" style="display: inline-block; margin-left: 5px">
					<label>เวลาสิ้นสุด</label> 
					<div class="ui calendar" id="Endcalendar">
						<div class="ui left icon input">
							<input type="text" name="EndDate" id="EndDate" onchange="onChangeDateEnd()" value="<?php echo date('d/m/Y'); ?>">
							<i class="calendar icon"></i>
						</div>
					</div>
				</div>
			</div>
			<div class="two fields">
				<div class="field" style="display: inline-block;">
					<label>ดาวเทียม</label>


					<div class="ui selection dropdown testonchange" style="z-index:10 !important">
						<i class="dropdown icon"></i>
						<div class="default text" id="selectSatellite">ดาวเทียม</div>
						<div class="menu">
							@foreach($listTLE as $Item)
							<div class="item" data-line1="{{ $Item->line1 }}" data-line2="{{ $Item->line2 }}" data-_id="{{ $Item->_id }}">{{ $Item->name }}</div>

							@endforeach
						</div>
					</div>
				</div>
				<div class="field" >

					<label><center>คำนวณ  </center></label> 
					<button class="ui red button SubmitCal" style="width: 100%">Submit</button>
					
				</div>

			</div>
		</div>
		<table class="ui celled table ">
			<thead>
				<tr>
					<th>Date</th>
					<th>Start Time</th>
					<th>Start<br> Azimuth</th>
					<th>End <br>Azimuth</th>
					<th>Maximum<br> Elevation</th>
					<th>End time</th>
				</tr></thead>
				<tbody id="tableshow">
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
				</tr>
				</table>
			</div>
			<br>
			<div class="ui segment">
				<div class="ui grey inverted segment ">
					<h2>TLE</h2>
				</div>
				
				<table class="ui celled table" >
					

					<thead>
						<th>ชื่อดาวเทียม</th>
						<th>วันที่อัพเดทขอมูล</th>
						<th>อัพเดทข้อมูล</th>
					</thead>
					<tbody>
						@foreach($listTLE as $Item)
						<tr>
							<td class="center aligned">{{ $Item->name }}</td>
							<td class="center aligned">
								<?php 
								$date = date_create($Item->updated_at);
								echo date_format($date, 'd/m/Y H:i:s');
								?>
							</td>
							<td class="center aligned"> 
								<button class="ui yellow button btTLE" data-id="{{$Item->_id }}" data-name="{{ $Item->name }}"  data-line1="{{ $Item->line1 }}" data-line2="{{ $Item->line2 }}">อัพเดท TLE</button>
							</td>
						</tr>
						@endforeach
						
						

					</tbody>


				</table>
				

			</div>
		</div>
		<script type="text/javascript" src="/js/date.js"></script>
		<script type="text/javascript" src="/js/dashboard.js"></script>
		<script type="text/javascript">
			var clock;
			
			$(document).ready(function() {
				var date = new Date();

				clock = $('.clock').FlipClock(date, {
					clockFace: 'TwelveHourClock'
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