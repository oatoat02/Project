@extends('layout')
@section('content')
<div class="sixteen wide computer sixteen wide tablet sixteen wide mobile column" >
	<div class="ui segment">
		<div class="ui clearing grey inverted segment">
			@if(Auth::check())
			@if(Auth::user()->type=='admin' ) 
			<div class="ui right floated  inverted grey button AddPhoto" style="padding: .5em 1.5em .5em;">อัพโหลดรูปภาพ</div>
			@endif
			@endif
			<div class="ui left"><h2>คลังข้อมูลรูปภาพ</h2></div>


		</div>
		<br>
		
		<form action="{{ route('Project.findPhoto') }}"  method="post"  class="ui form segment">
			<h4 class="ui dividing header">ค้นห้ารูปภาพ</h4>
			<div class="four fields">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="inline fields " >
					
						<label>Satellite&nbsp;Name&nbsp;:</label>
						<div class="ui selection dropdown myDropdown" style="width: 100%">
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

				<div class="inline fields" style="margin-left:10px;" >
					<label>เวลาเริ่มต้น</label>
					<div class="ui calendar" id="Startcalendar" >
						<div class="ui left icon input" style="width: 100%">
							<input type="text" name="StartDate" id="StartDate" value="<?php echo date('d/m/Y'); ?>" style="width: 100%" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
							<i class="calendar icon"></i>
						</div>
					</div>
				</div>
				<div class="inline fields">
					<label>เวลาสิ้นสุด</label> 
					<div class="ui calendar" id="Endcalendar">
						<div class="ui left icon input">
							<input type="text" name="EndDate" id="EndDate" value="<?php echo date('d/m/Y'); ?>" style="width: 100%">
							<i class="calendar icon"></i>
						</div>
					</div>
				</div>
				<div class="inline fields">
					<button class="ui black button" style="width:100%">ค้นหา</button>
				</div>
			</div>
			
		</form>
		<br>

		<div class="ui four stackable link cards ">
			@foreach($listPhoto as $Item)
			<div class="card">
				
				<div class="image ShowPhoto" id="photopath" data-PathValue="{{ $Item->path }}">
					<img src="{{ $Item->path }}" style="  height: 25em; ">
				</div>
				<div class="content">
					<div class="header">{{ $Item->SatelliteName }}</div>
					
					<div class="description">
						Enhancement : {{ $Item->Enhancement }}
						<br>
						Date Acquired:  {{ $Item->DateAcquired }}
						<br>
						Time Acquired:{{ $Item->TimeAcquired }} </p>
						<a href="{{ $Item->path }}" download><i class="download icon"></i>Download</a>
					</div>
				</div>

			</div>
			@endforeach
			
		</div>
	</div>




	<div class="ui basic modal" id="ShowPhoto">
		<i class="close icon"></i>
		<div class="ui icon header">


			<img class="image" id='fullImage' style="min-width: 400px;min-height: 400px">
		</div>

	</div>

	<div class="ui modal" id="AddPhoto" >
		<i class="close icon"></i>
		<div class="header">
			เพิ่มรูปภาพ   
		</div>
		<div class="content">
			<form id="formAddPhoto" action="{{ route('Project.AddPhoto')}}" class="ui form" method="post" enctype="multipart/form-data">

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
					<div class="sixteen wide field">
						<label>Enhancement&nbsp;:&nbsp;&nbsp;</label>
						<input type="text"  name="Enhancement" >
					</div>
				</div>
				<div class="inline fields container">
					<div class="sixteen wide field">
						<label>Date&nbsp;Acquired&nbsp;:</label>
						<div class="ui calendar" name="DateAcquired" id="DateAcquired" style="width: 100%">
							<div class="ui left icon input">
								<input type="text" name="DateAcquired" value="<?php echo date('d-m-Y'); ?>">
								<i class="calendar icon"></i>
							</div>
						</div>

					</div>
				</div>
				<div class="inline fields container">
					<div class="sixteen wide field">
						<label>Time&nbsp;Acquired&nbsp;:</label>
						<input type="time"  name="TimeAcquired" value="00:00" >
					</div>
				</div>
				<div class="inline fields container">
					<div class="sixteen wide field">
						<label> รูปภาพ </label>
						<input type="file" name="photo" id="photo" value="" accept="image/*" >
					</div>
				</div>	


				<center>
					<div class="actions">
						<div class="ui black deny button" >
							ยกเลิก
						</div>
						<button class="ui positive right labeled icon button" id="SubmitAddPhoto" type="submit" >
							บันทึก
							<i class="checkmark icon"></i>
						</button>


					</div>
				</center>
			</form>
		</div>
	</div>


</div>
<script type="text/javascript" src="/js/date.js"></script>
<script type="text/javascript">


	$(document).on('click', '.AddPhoto', function() {
		$('#AddPhoto').modal({
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
	$(document).on('click', '.ShowPhoto', function() {
		var path =( $(this).data('pathvalue') );


		$("#fullImage").attr("src", path);
		$('#ShowPhoto').modal('show');
	});


	$('.actions').on('click', '#SubmitAddPhoto', function() {
		
		

		if ( $('#SatelliteName').val() === '' ) {
			alert('ชื่อดาวเทียม ไม่ถูกต้อง');
			return false;
		}
		if( document.getElementById("photo").files.length == 0 ){
			alert('โปรดเลือกรูปภาพ');
			return false;
		}
	});


</script>
@stop