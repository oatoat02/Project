@extends('layout')
@section('content')

<div class="sixteen wide column">
	<div class="ui segment">
		
		<div class="ui grey inverted segment">
			<h2>เวลาการรับสัญญาณดาวเทียม {{ $listdata->namesatellite }} </h2>
		</div>
		<table class="ui celled structured table ">
			
			<thead>
				<tr>
					<th style="width: 25%"><center>Date</center></th>
					<th style="width: 25%"><center>Time</center></th>
					<th style="width: 25%"><center>Azimuth</center></th>
					<th style="width: 25%"><center>Elevation</center></th>
				</tr>
			</thead>
			<tbody>
				
				@foreach( ($listdata->control) as $data)
				<tr>
					<td> 
						<center>
							<?php 
							$dataspilt = explode(",", $data['time']);
							echo $dataspilt[0];
							?> 

						</center>
					</td>
					<td> 
						<center>
							<?php 
							$dataspilt = explode(",", $data['time']);
							echo $dataspilt[1];
							?> 
							
						</center>
					</td>
					<td> 
						<center>
							{{$data['azimuth']}}
							
						</center>
					</td>
					<td> 
						<center>
							{{$data['elevation']}}
							
						</center>
					</td>
					
				</tr>
				@endforeach

			</tbody>

		</table>

	</div>

</div>

<script type="text/javascript" src="/js/date.js"></script>


@stop