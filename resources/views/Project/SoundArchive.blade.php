@extends('layout')
@section('content')
<div class="sixteen wide computer sixteen wide tablet sixteen wide mobile column" >
	<div class="ui segment">
		<div class="ui clearing grey inverted segment">
			@if(Auth::check())
			@if(Auth::user()->type=='admin' ) 
			<div class="ui right floated  inverted grey button AddSound" style="padding: .5em 1.5em .5em;">อัพโหลดเสียง
			</div>
			@endif
			@endif
			<div class="ui left">
				<h2>คลังข้อมูลเสียง</h2>
			</div>
		</div>
		<br>
		
		<form action="{{ route('Project.findSound') }}"  method="post"  class="ui form segment">

			<h4 class="ui dividing header">ค้นหาข้อมูลเสียง</h4>
			
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="two fields">
				<div class="inline fields " >
					
					<label>Satellite&nbsp;Name&nbsp;:</label>
					<div class="ui selection dropdown myDropdown selectSatellite" style="width: 100%">
						<input type="hidden" name="SatelliteName" value="All">
						<i class="dropdown icon"></i>
						<div class="default text">All</div>
						<div class="menu">
							@foreach($listTLE as $Item)
							<div class="item" data-value="{{$Item->name}}">{{$Item->name}}</div>
							@endforeach
							<div class="item" data-value="All">All</div>
						</div>
						<div class="Other"></div>
					</div>

				</div>
				<div class="inline fields " >
					<label style="margin-left: 10px">ช่วงเวลา&nbsp;</label>
					<div class="ui selection dropdown selectDurations" style="width: 80%">
						<input type="hidden" name="Durations" value="All">
						<i class="dropdown icon"></i>
						<div class="default text">All</div>
						<div class="menu">
							<div class="item" data-value="All">ทั้งหมด</div>
							<div class="item" data-value="Durations">เวลาเริ่มต้น - เวลาสิ้นสุด</div>
						</div>
						<div class="Other"></div>
					</div>
				</div>
				
				
			</div>


			<div class="three fields">
				<div class="inline fields" style="margin-left:10px;" >
					<label>เวลาเริ่มต้น</label>
					<div class="ui calendar" id="Startcalendar" style="width: 80% ;margin-left:5px" >
						<div class="ui left icon input" style="width: 80%">
							<input type="text" name="StartDate" id="StartDate" value="<?php echo date('d/m/Y'); ?>"  onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
							<i class="calendar icon"></i>
						</div>
					</div>
				</div>
				<div class="inline fields" style="margin-left:10px;" >
					<label>เวลาสิ้นสุด</label> 
					<div class="ui calendar" id="Endcalendar" style="width: 80% ;margin-left:5px">
						<div class="ui left icon input"  style="width: 80%">
							<input type="text" name="EndDate" id="EndDate" value="<?php echo date('d/m/Y'); ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
							<i class="calendar icon"></i>
						</div>
					</div>
				</div>
				<div class="inline fields">
					<button class="ui black button" style="width:100%">ค้นหา</button>
				</div>
				
			</div>
			
		</form>
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

</div>
<div class="ui modal" id="AddSound" style="z-index: 250 !important;" >
	<i class="close icon"></i>
	<div class="header">
		เพิ่มข้อมูลเสียง
	</div>
	<div class="content">
		<form  action="{{ route('Project.AddSound')}}" class="ui form" method="post" enctype="multipart/form-data">

			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="inline fields container">
				<div class="sixteen wide field">

					<label>Satellite&nbsp;Name&nbsp;:</label>
					<div class="ui selection dropdown myDropdown" style="width: 100%">
						<input type="hidden" name="SatelliteName">
						<i class="dropdown icon"></i>
						<div class="default text">SatelliteName</div>
						<div class="menu">
							@foreach($listTLE as $Item)
							<div class="item" data-value="{{$Item->name}}">{{$Item->name}}</div>

							@endforeach

						</div>
						<div class="Other"></div>
					</div>
				</div>
			</div>

			<div class="inline fields container">
				<div class="one wide field">
					<label>Date :</label>
				</div>
				<div class="fifteen wide field">
					<div class="ui calendar" name="DateAcquired" id="DateAcquired" style="width: 100%">
						<div class="ui left icon input">
							<input type="text" name="DateAcquired" value="<?php echo date('d-m-Y'); ?>">
							<i class="calendar icon"></i>
						</div>
					</div>

				</div>
			</div>
			<div class="inline fields container">
				
				<div class="one wide field">
					<label>Time :</label>
				</div>
				<div class="fifteen wide field">
					<input type="time"  name="TimeAcquired" value="00:00" >
				</div>
			</div>
			<div class="inline fields container">
				
				<label style="width: 60px">ไฟล์เสียง</label>
				<input type="file" name="Sound" id="Sound" value="" accept="audio/*" >

			</div>	


			<center>
				<div class="actions">
					<div class="ui black deny button" >
						ยกเลิก
					</div>
					<button class="ui positive right labeled icon button" id="SubmitAddSound" type="submit" >
						บันทึก
						<i class="checkmark icon"></i>
					</button>


				</div>
			</center>
		</form>
	</div>
</div>
<script type="text/javascript">


	$(document).on('click', '.AddSound', function() {
		$('#AddSound').modal({
			onShow: function(){
				$('#DateAcquired').calendar({
					type: 'date',formatter: {
						date: function(date, settings){
							if(!date) return '';
							var day = ("0" + date.getDate()).slice(-2);
							var month = ("0" + (date.getMonth() + 1)).slice(-2);
							var year = date.getFullYear();
							return day + '/' + month + '/' + year;
						}
					}
				});
			},
			onApprove : function() {
            return false; //block the modal here
        }

    }).modal('show');
	});
	$(document).on('click', '.ShowSound', function() {
		var path =( $(this).data('pathvalue') );


		$("#fullImage").attr("src", path);
		$('#ShowSound').modal('show');
	});


	$('.actions').on('click', '#SubmitAddSound', function() {



		console.log($('#SatelliteNameAdd').val());
		if ( $('#SatelliteNameAdd').val() == '-' ) {
			alert('ชื่อดาวเทียม ไม่ถูกต้อง');
			return false;
		}
		if( document.getElementById("Sound").files.length == 0 ){
			alert('โปรดเลือกไฟล์เสียง');
			return false;
		}
	});


</script>


@stop