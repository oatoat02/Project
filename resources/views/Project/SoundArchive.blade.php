@extends('layout')
@section('content')
<div class="sixteen wide column box1" style="margin:20px ">
	<div class="ui grey inverted segment">
		<h3>คลังข้อมูลเสียง</h3>
	</div>
	
	<div class="ui form">
		<div class="two fields">
			<div class="field" style="display: inline-block;">
				<label>เวลาเริ่มต้น</label>

				<div class="ui left icon input ui calendar">
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
		</div>
		<center><button class="ui black button" style="width:70%">ค้นหา</button></center>
	</div>

	<table class="ui celled table">
		<thead>
			<tr>
				<th>Date</th>
				<th>Time</th>
				<th>Satellite</th>
				<th>Download</th>
			</tr>
		</thead>
			<tbody>
				<tr>
					<td>
						1/11/2560 
					</td>
					<td>14:02</td>
					<td>NOAA-15</td>
					<td><a href="/Sound/08130855.wav" download><i class="download icon"></i>Download</a></td>
				</tr>
				<tr>
					<td>2/11/2560</td>
					<td>14:02</td>
					<td>NOAA-18</td>
					<td><a href="/Sound/08130855.wav" download><i class="download icon"></i>Download</a></td>
				</tr>
				<tr>
					<td>3/11/2560</td>
					<td>14:02</td>
					<td>NOAA-19</td>
					<td><a href="/Sound/08130855.wav" download><i class="download icon"></i>Download</a></td>
				</tr>
			</tbody>
			
		</table>

	</div>
	<script type="text/javascript">




	</script>
	@stop