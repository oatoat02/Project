@extends('layout')

@section('content')


<div class="sixteen wide column ">
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

@stop 