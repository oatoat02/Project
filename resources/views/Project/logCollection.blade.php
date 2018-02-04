@extends('layout')
@section('content')

<div class="sixteen wide column">
	<div class="ui segment">
		
		<div class="ui grey inverted segment">
			<h2>ประวัติการรับสัญญาณ</h2>
		</div>
		<br>
		<label>วันเวลาที่ต้องการค้นหา : </label>
		<div class="ui left icon input">
			<input type="date" name="StartDate" id="StartDate" placeholder="เวลาเริ่มต้น" value="<?php echo date('Y-m-d'); ?>">
			<i class="calendar icon"></i>
		</div>
		&nbsp;
		<button class="ui green button">ค้นหา</button>
		<table class="ui celled table">


			<thead>
				<th>Date</th>
				<th>Satellite</th>
				<th>เวลาที่รับ</th>

				<th>การรับสัญญาณ</th>

				<th>ไฟล์เสียง</th>
				<th>ไฟล์รูปภาพ</th>
				<th>ตัวอย่างรูปภาพ</th>



			</thead>
			<tbody>
				<tr>

					<td>1/11/2560</td>
					<td>NOAA-15</td>
					<td>14:02:10</td>
					<td><i class="green checkmark big icon"></i></td>
					<td>
						<a href="/Sound/08130855.wav" download><i class="download icon"></i>Download</a>
					</td>
					<td>
						<a download="I-noaa-19-08130855-contrasta-jpg.jpg" href="photo/NOAA/I-noaa-19-08130855-contrasta-jpg.jpg">
							<i class="photo icon"></i>Download</a>
						</td>
						<td>
							<center><img src="photo/NOAA/I-noaa-19-08130855-contrasta-jpg.jpg" style="width: 100px ;height: 100px;"></center>
						</td>



					</tr>
					<tr>

						<td>1/11/2560</td>
						<td>NOAA-15</td>
						<td>14:02:10</td>
						<td><i class="green checkmark big icon"></i></td>
						<td>
							<a href="/Sound/08130855.wav" download><i class="download icon"></i>Download</a>
						</td>
						<td>
							<a download="I-noaa-19-08130855-contrasta-jpg.jpg" href="photo/NOAA/I-noaa-19-08130855-contrasta-jpg.jpg">
								<i class="photo icon"></i>Download</a>
							</td>
							<td>
								<center><img src="photo/NOAA/I-noaa-19-08130855-contrasta-jpg.jpg" style="width: 100px ;height: 100px;"></center>
							</td>



						</tr>
						<tr>

							<td>1/11/2560</td>
							<td>NOAA-15</td>
							<td>14:02:10</td>
							<td><i class="green checkmark big icon"></i></td>
							<td>
								<a href="/Sound/08130855.wav" download><i class="download icon"></i>Download</a>
							</td>
							<td>
								<a download="I-noaa-19-08130855-contrasta-jpg.jpg" href="photo/NOAA/I-noaa-19-08130855-contrasta-jpg.jpg">
									<i class="photo icon"></i>Download</a>
								</td>
								<td>
									<center><img src="photo/NOAA/I-noaa-19-08130855-contrasta-jpg.jpg" style="width: 100px ;height: 100px;"></center>
								</td>



							</tr>
							<tr>

								<td>1/11/2560</td>
								<td>NOAA-15</td>
								<td>14:02:10</td>
								<td><i class="green checkmark big icon"></i></td>
								<td>
									<a href="/Sound/08130855.wav" download><i class="download icon"></i>Download</a>
								</td>
								<td>
									<a download="I-noaa-19-08130855-contrasta-jpg.jpg" href="photo/NOAA/I-noaa-19-08130855-contrasta-jpg.jpg">
										<i class="photo icon"></i>Download</a>
									</td>
									<td>
										<center><img src="photo/NOAA/I-noaa-19-08130855-contrasta-jpg.jpg" style="width: 100px ;height: 100px;"></center>
									</td>



								</tr>
								<tr>

									<td>1/11/2560</td>
									<td>NOAA-15</td>
									<td>14:02:10</td>
									<td><i class="green checkmark big icon"></i></td>
									<td>
										<a href="/Sound/08130855.wav" download><i class="download icon"></i>Download</a>
									</td>
									<td>
										<a download="I-noaa-19-08130855-contrasta-jpg.jpg" href="photo/NOAA/I-noaa-19-08130855-contrasta-jpg.jpg">
											<i class="photo icon"></i>Download</a>
										</td>
										<td>
											<center><img src="photo/NOAA/I-noaa-19-08130855-contrasta-jpg.jpg" style="width: 100px ;height: 100px;"></center>
										</td>



									</tr>
									<tr>

										<td>1/11/2560</td>
										<td>NOAA-15</td>
										<td>14:02:10</td>
										<td><i class="green checkmark big icon"></i></td>
										<td>
											<a href="/Sound/08130855.wav" download><i class="download icon"></i>Download</a>
										</td>
										<td>
											<a download="I-noaa-19-08130855-contrasta-jpg.jpg" href="photo/NOAA/I-noaa-19-08130855-contrasta-jpg.jpg">
												<i class="photo icon"></i>Download</a>
											</td>
											<td>
												<center><img src="photo/NOAA/I-noaa-19-08130855-contrasta-jpg.jpg" style="width: 100px ;height: 100px;"></center>
											</td>



										</tr>
										<tr>

											<td>1/11/2560</td>
											<td>NOAA-15</td>
											<td>14:02:10</td>
											<td><i class="green checkmark big icon"></i></td>
											<td>
												<a href="/Sound/08130855.wav" download><i class="download icon"></i>Download</a>
											</td>
											<td>
												<a download="I-noaa-19-08130855-contrasta-jpg.jpg" href="photo/NOAA/I-noaa-19-08130855-contrasta-jpg.jpg">
													<i class="photo icon"></i>Download</a>
												</td>
												<td>
													<center><img src="photo/NOAA/I-noaa-19-08130855-contrasta-jpg.jpg" style="width: 100px ;height: 100px;"></center>
												</td>



											</tr>
											<!--  -->

											
										</tbody>
									</table>

								</div>
								<br>


							</div>




							@stop