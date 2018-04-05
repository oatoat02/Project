@extends('layout')
@section('content')
<div class="sixteen wide computer sixteen wide tablet sixteen wide mobile column " >
	<div class="ui segment">
		<div class="ui grey inverted segment">
			<div class="ui left"><h2>รับสัญญาณจากดาวเทียม {{ $namesatellite }}</h2></div>
		</div>
		<br>
		<div class="ui segment">
			<div >
				<button class='ui black button' style='width:49%' type='submit'>ดูรายละเอียด</button>
				<button class='ui green button' style='width:49%' type='submit'>ยืนยันการรับสัญญาณ</button>
			</div>
			<div class="ui accordion field">
				<div class="title">
					<i class="icon dropdown"></i>
					Optional Details
				</div>
				<div class="content field">
					<label class="transition hidden">Maiden Name</label>
					<input placeholder="Maiden Name" type="text" class="transition hidden">
				</div>
			</div>
			<table class="ui celled structured table ">
				<thead>
					<tr>
						<th style="width: 50%"><center>Time</center></th>
						<th style="width: 25%"><center>Azimuth</center></th>
						<th style="width: 25%"><center>Elevation</center></th>
					</tr>
				</thead>
				<tbody>
					@foreach($arraylist as $data)
					<tr>
						<td> <center> {{$data[0]}}</center></td>
						<td> <center> {{$data[1]}} </center></td>
						<td> <center> {{$data[2]}} </center></td>
					</tr>
					@endforeach

				</tbody>

			</table>
		</div>
	</div>

</div>

<script type="text/javascript">
	$('.ui.accordion')
  .accordion()
;
</script>

@stop