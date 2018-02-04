<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="stylesheet" type="text/css" href="/css/mystyles.css">
	<link rel="stylesheet" href="/css/leaflet/leaflet.css" />
	<link rel="stylesheet" type="text/css" href="/css/L.Control.MousePosition.css">
	<link rel="stylesheet" type="text/css" href="/Semantic/semantic.min.css">
	
	<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
	<script src="/css/leaflet/leaflet.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/satellite.js/1.3.0/satellite.min.js"></script>
	<script type="text/javascript" src="/satellite-js-master/dist/satellite.min.js"></script>
	<script src="/satellite-js-master/dist/satellite.min.js"></script>
	<script src="/satellite-js-master/sgp4_verification/lib/angular/angular.js"> </script>
	<script type="text/javascript" src="/css/L.Control.MousePosition.js"></script>
	<script type="text/javascript" src="/Semantic/semantic.min.js"></script>

	<title>Project</title>
</head>
<body>


	<div class="ui inverted menu">
		<!-- <div class="navbar-header test">
			<a href="{{ route('Project.dashboard') }}" class="brand item">
			<img src="{{ asset('photo/gistdalogo3.png') }}" class="photologo"> 
			</a>     
		</div> -->

		<a href="{{ route('Project.dashboard') }}" >
            <div class="navbar-header">
              <img src="{{ asset('photo/gistdalogo3.png') }}" class="photologo">
            </div>
          </a>

		<div class="right menu">
			<a class="item" href="{{ route('Project.login') }}">
				<i class="large inverted blue user circle outline icon"></i>เข้าสู่ระบบ
			</a>

		</div>
	</div>
	

	<br>
	<div class="ui two column centered grid ">
		<div class=" ui segment column ">
			<div class="ui form ">  
				<center>
					@if (session('status'))
					<center>
						<h4 style="color: red">{{ session('status') }}</h4>
					</center>
					@endif
				</center>
				<div class="ui red inverted segment">
					<center>
						<h3> <i class="lock icon"></i> เข้าสู่ระบบ</h3>
					</center>
				</div>

				<br>
				<form action="{{ route('Project.login') }}" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="field required">
						<label>Username</label>
						<div class="ui left icon input">
							<i class="user icon"></i>
							<!-- <input type="text" name="username" placeholder="username" > -->
							<input type="text" name="username" placeholder="username"  required="" oninvalid="this.setCustomValidity('โปรดใส่ Username')" oninput="setCustomValidity('')">
						</div>
					</div>

					<div class="field required " >
						<label>Password</label>
						<div class="ui left icon input">
							<i class="lock icon"></i>
							<!-- <input type="password" name="password" placeholder="Password" > -->
							<input type="password" name="password" placeholder="Password" required="" oninvalid="this.setCustomValidity('โปรดใส่ Password')" oninput="setCustomValidity('')">
						</div>
					</div>

					<center>
						<h4 style="color: red"></h4>
					</center>

					<center>
						<button class="ui green button item " type="submit" style="width: 200px"><i class="sign in icon"></i>เข้าสู่ระบบ</button>
						<!-- <a href="{{ route('Project.dashboard') }}" class="ui green button  item " style="width: 200px"><i class="sign in icon"></i>เข้าสู่ระบบ</a> -->
						<a href="" class="ui green button item " style="width: 200px "> <i class="google icon"></i>เข้าสู่ระบบด้วย Google </a>
					</center>
				</form>
				<center>
					<br>
					<a href="{{ route('Project.register')}}" class="ui black button item  ">สมัครสมาชิก</a>
				</center>
			</div>
			
			<br>
		</div>
	</div>
</div>


<script type="text/javascript">

	$(document).on('click', '.test', function() {
		$('.ui.labeled.icon.sidebar').sidebar('toggle');
		
	});
</script>

</body>

</html>
