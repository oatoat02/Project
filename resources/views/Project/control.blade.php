@extends('layout')
@section('content')

<div class="eight wide computer eight wide tablet sixteen wide mobile column"> 
	<div class="ui segment" style="height: 100%">
		<div class="ui grey inverted segment " >
			<h2>ตั้งค่าเสาอากาศล่วงหน้า</h2>
		</div>

		<div class="ui form" style="padding-top: 10px">
			<div class="two fields">
				<div class="field" style="display: inline-block; width: 50%	">
					<label>ดาวเทียม</label>
					<div class="ui selection dropdown testonchange">
						<i class="dropdown icon"></i>
						<div class="default text" id="selectSatellite">ดาวเทียม</div>
						<div class="menu">
							@foreach($listTLE as $Item)
							<div class="item" data-line1="{{ $Item->line1 }}" data-line2="{{ $Item->line2 }}" data-_id="{{ $Item->_id }}">{{ $Item->name }}</div>

							@endforeach
						</div>
					</div>
				</div>
				<div class="field" style="display: inline-block; width: 50%	">
					<label>ช่วงเวลา</label>
					<div class="ui selection dropdown " >
						<i class="dropdown icon"></i>
						<div class="default text" id="SelectTime" data-value="daylight">กลางวัน</div>
						<div class="menu">
							<div class="item" data-value="daylight">กลางวัน</div>
							<div class="item" data-value="Night">กลางคืน</div>
							<div class="item" data-value="All">ทั้งหมด</div>

						</div>
					</div>
				</div>
			</div>
			<div class="two fields">
				<div class="field" style="display: inline-block;">
					<label>เวลาเริ่มต้น</label>
					<div class="ui calendar" id="Startcalendar">
						<div class="ui left icon input">
							<input type="text" name="StartDate" id="StartDate" value="<?php echo date('d/m/Y'); ?>">
							<i class="calendar icon"></i>
						</div>
					</div>
				</div>
				<div class="field" style="display: inline-block; margin-left: 5px">
					<label>เวลาสิ้นสุด</label> 
					<div class="ui calendar" id="Endcalendar">
						<div class="ui left icon input">
							<input type="text" name="EndDate" id="EndDate" value="<?php echo date('d/m/Y'); ?>">
							<i class="calendar icon"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="fields">
			<button class="ui secondary button SubmitCal">คำนวณวงโคจร</button>
			<button class="ui red button removeLayerALL ">ล้าง</button>
			<table class="ui celled structured table ">
				<thead>
					<tr>
						<th style="width: 25%"><center>Date </center></th>
						<th style="width: 25%"><center>Start Time</center></th>
						<th style="width: 25%"><center>End time</center></th>
						<th style="width: 25%"><center>รายละเอียด</center></th>
					</tr>
				</thead>
				<tbody id="tableshow">

				</tbody>

			</table>
		</div>
		
	</div>
</div>
<div class="eight wide computer eight wide tablet sixteen wide mobile column"> 
	<div class="ui segment">
		<div class="ui grey inverted segment ">
			<h2>มุมองศาของเสาอากาศ</h2>
		</div>
		<div class="ui form" style="padding-top: 10px" >
			<div class="two fields">
				<div class="field" style="display: inline-block;">
					<label>Azimuth (ปัจจุบัน)</label>
					<input type="number"  value="14" disabled >
				</div>
				<div class="field" style="display: inline-block;">
					<label>Azimuth </label>
					<input type="number" min="0" max="360"  placeholder="ค่าระหว่าง 0-360"  name="azimuthnew" value=""  >
				</div>
			</div>
			<div class="two fields">
				<div class="field" style="display: inline-block;">
					<label>Elevation (ปัจจุบัน)</label>
					<input type="number" value="120" disabled >
				</div>
				<div class="field" style="display: inline-block;">
					<label>Elevation </label>
					<input type="number" min="0" max="180" placeholder="ค่าระหว่าง 0-180"  name="azimuthnew" value=""  >
				</div>
			</div>



		</div>

		<center>
			<button class="ui black button">ปรับมุมองศา</button>
			<button class="ui red button" onclick="testclick()">ทดสอบ</button>
		</center>

		
	</div>
</div>
<div class="sixteen wide  column ui segment" style="margin: 10px !important">
	<div class="ui grey inverted segment ">
		<center><h2>ตารางเวลาการควบคุมเสาอากาศ</h2></center>
	</div>

	<table class="ui celled table">


		<thead>
			<th style="width: 12.5%"><center>Date</center></th>
			<th style="width: 12.5%"><center>Satellite</center></th>
			<th style="width: 12.5%"><center>Start Time</center></th>
			<th style="width: 12.5%"><center>End time </center></th>
			<th style="width: 12.5%"><center>Start<br> Azimuth</center></th>
			<th style="width: 12.5%"><center>Start<br> Elevation</center></th>
			<th style="width: 12.5%"><center>รายละเอียด</center></th>
			<th style="width: 12.5%"><center>ลบการตั้งค่าล่วงหน้า</center></th>




		</thead>
		<tbody>
			@foreach($listControl as $Data)
			<tr>
				<td> 
					<center>
						<?php 
						$dataspilt = explode(",", $Data->timestart);
						echo $dataspilt[0];
						?> 
					</center>
				</td>
				<td> 
					<center>{{$Data->namesatellite}}</center>
				</td>
				<td> 
					<center>
						<?php 
						$dataspilt = explode(",", $Data->timestart);
						echo $dataspilt[1];
						?> 
					</center>
				</td>
				<td> 
					<center>
						<?php 
						$dataspilt = explode(",", $Data->timestop);
						echo $dataspilt[1];
						?> 
					</center>
				</td>
				<td> 
					<center>{{$Data->control[0]['azimuth']}}</center>
				</td>
				<td> 
					<center>{{$Data->control[0]['elevation']}}</center>
				</td>
				<td> 
					<form action="{{ route('Project.schedulecontrol') }}"  method='post'>
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="id" value="{{ $Data->_id }}">
							<button class='ui green button' style="width: 95%" type='submit'>ดูรายระเอียด</button>
						</form>
				</td>
				<td> 
					<form action="{{ route('Project.deleteTimeControl') }}"  method='post'>
						<input type='hidden' name='_token' value='{{ csrf_token() }}'>
						<input type='hidden' name='id' value='{{$Data->_id}}'>
						<center><button class='ui red button' type='submit'>ลบการสั่งการ</button></center>
					</form>
				</td>

			</tr>
			@endforeach

		</tbody>


	</table>
</div>




<script type="text/javascript" src="/js/date.js"></script>
<script type="text/javascript" src="/js/control.js"></script>

@stop