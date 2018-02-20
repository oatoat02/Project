@extends('layout')
@section('content')
<div class="sixteen wide column box1" style="margin:20px ">
	<div class="ui grey inverted segment">
		<h3>คลังข้อมูลรูปภาพ</h3>
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
	<div class="ui stackable four column grid" style="margin: 10px !important">
		<div class="column box3">
			<div class="ui segment ">
				<img src="photo/NOAA/I-noaa-19-08130855-contrasta-jpg.jpg" style="width: 100% ;height: 300px;">
				<p>Satellite Name: noaa-15 
					<br>
					Date Acquired: 2017-11-14 
					<br>
				Time Acquired: 07:53:21 UTC </p>
				<a download="I-noaa-19-08130855-contrasta-jpg.jpg" href="photo/NOAA/I-noaa-19-08130855-contrasta-jpg.jpg" title="Download">
				    <img alt="Download" src="/path/to/image">
				</a>
			</div>
		</div>
		<div class="column box3">
			<div class="ui segment ">
				<img src="photo/NOAA/I-noaa-19-08130855-contrastb-jpg.jpg" style="width: 100% ;height: 300px;">
				<p>Satellite Name: noaa-15 
					<br>
					Date Acquired: 2017-11-14 
					<br>
				Time Acquired: 07:53:21 UTC </p>
				<a download="I-noaa-19-08130855-contrasta-jpg.jpg" href="photo/NOAA/I-noaa-19-08130855-contrasta-jpg.jpg" title="Download">
				    <img alt="Download" src="/path/to/image">
				</a>
			</div>
		</div>
		<div class="column box3">
			<div class="ui segment ">
				<img src="photo/NOAA/I-noaa-19-08130855-hvct-jpg.jpg" style="width: 100% ;height: 300px;">
				<p>Satellite Name: noaa-15 
					<br>
					Date Acquired: 2017-11-14 
					<br>
				Time Acquired: 07:53:21 UTC </p>
				<a download="I-noaa-19-08130855-contrasta-jpg.jpg" href="photo/NOAA/I-noaa-19-08130855-contrasta-jpg.jpg" title="Download">
				    <img alt="Download" src="/path/to/image">
				</a>
			</div>
		</div>
		<div class="column box3">
			<div class="ui segment ">
				<img src="photo/NOAA/I-noaa-19-08130855-mcir-jpg.jpg" style="width: 100% ;height: 300px;">
				<p>Satellite Name: noaa-15 
					<br>
					Date Acquired: 2017-11-14 
					<br>
				Time Acquired: 07:53:21 UTC </p>
				<a download="I-noaa-19-08130855-contrasta-jpg.jpg" href="photo/NOAA/I-noaa-19-08130855-contrasta-jpg.jpg" title="Download">
				    <img alt="Download" src="/path/to/image">
				</a>
			</div>
		</div>
		<div class="column box3">
			<div class="ui segment ">
				<img src="photo/NOAA/I-noaa-19-08130855-msa-jpg.jpg"  style="width: 100% ;height: 300px;">
				<p>Satellite Name: noaa-15 
					<br>
					Date Acquired: 2017-11-14 
					<br>
				Time Acquired: 07:53:21 UTC </p>
				<a download="I-noaa-19-08130855-contrasta-jpg.jpg" href="photo/NOAA/I-noaa-19-08130855-contrasta-jpg.jpg" title="Download">
				    <img alt="Download" src="/path/to/image">
				</a>
			</div>
		</div>
		<div class="column box3">
			<div class="ui segment ">
				<img src="photo/NOAA/noaa-19-20171114075321-canaglyph-2-4.jpg"  style="width: 100% ;height: 300px;">
				<p>Satellite Name: noaa-15 
					<br>
					Date Acquired: 2017-11-14 
					<br>
				Time Acquired: 07:53:21 UTC </p>
				<a download="I-noaa-19-08130855-contrasta-jpg.jpg" href="photo/NOAA/I-noaa-19-08130855-contrasta-jpg.jpg" title="Download">
				    <img alt="Download" src="/path/to/image">
				</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
</script>
@stop