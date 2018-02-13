  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="stylesheet" type="text/css" href="/css/mystyles.css">
    <link rel="stylesheet" href="/css/leaflet/leaflet.css" />
    <link rel="stylesheet" type="text/css" href="/css/L.Control.MousePosition.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.min.css">
    <link rel="stylesheet" href="/semantic-ui-calendar/dist/calendar.css" />


    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="/semantic-ui-calendar/dist/calendar.js"></script>
    <script src="/css/leaflet/leaflet.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/satellite.js/1.3.0/satellite.min.js"></script>
    <script type="text/javascript" src="/satellite-js-master/dist/satellite.min.js"></script>
    <script src="/satellite-js-master/dist/satellite.js"></script>
    <script src="/satellite-js-master/sgp4_verification/lib/angular/angular.js"> </script>
    <script type="text/javascript" src="/css/L.Control.MousePosition.js"></script>
    <script type="text/javascript" src="/Semantic/semantic.min.js"></script>
    <script type="text/javascript" src="/js/main.js"></script>
    <script src="https://code.highcharts.com/highcharts.src.js"></script>
    <link rel="stylesheet" href="/flipclock/flipclock.css">
    <script src="/flipclock/flipclock.js"></script>
    <title>Project</title>
  </head>
  <body>
    <div class="ui grid">
      <div class="computer tablet only row">
        <div class="ui inverted menu main-nav">
          @if(Auth::check())

          <a href="{{ route('Project.dashboard') }}" >
            <div class="navbar-header">
              <img src="{{ asset('photo/gistdalogo3.png') }}" class="photologo">
            </div>
          </a>
          @else
          <a href="{{ route('Project.index') }}" >
            <div class="navbar-header">
              <img src="{{ asset('photo/gistdalogo3.png') }}" class="photologo">
            </div>
          </a>
          @endif
          <div class="right menu">
           <a class="item" href="{{ route('Project.checksatellite') }}">
            <i class="large send icon"></i>ตรวจสอบการเข้าถึงของดาวเทียม
          </a>
          <a class="item" href="{{ route('Project.position') }}">
            <i class="large rocket icon"></i>ตำแหน่งดาวเทียม
          </a>
          <div class="ui pointing dropdown link item ">
            <i class="large inverted archive icon"></i>คลังข้อมูล<i class="dropdown icon"></i>
            <div class="menu">
              <a class="item" href="{{ route('Project.PhotoGallery') }}"><i class="photo icon"></i>คลังรูปภาพ</a>
              <a class="item" href="{{ route('Project.SoundArchive') }}"><i class="signal icon"></i>คลังเสียง</a>
              @if(Auth::check())
              @if(Auth::user()->type=='admin' ) 
              <a class="item" href="{{ route('Project.logCollection') }}"><i class="list layout icon"></i>ประวัติการรับสัญาณ</a>
              @endif
              @endif
            </div>
          </div>
          @if(Auth::check())
          @if(Auth::user()->type=='admin' ) 
          <div class="ui pointing dropdown link item ">
            <i class="large settings icon"></i>จัดการระบบ<i class="dropdown icon" ></i>
            <div class="menu">

              <a class="item" href="{{ route('Project.control') }}">
                <i class="large rss icon"></i>ตั้งค่ามุมเสาอากาศ
              </a>
              <a class="item" href="{{ route('Project.tle') }}">
                <i class="large rocket icon"></i>TLE
              </a>
              <a class="item" href="{{ route('Project.member') }}">
                <i class="large users icon"></i>สมาชิก
              </a>
              

            </div>
          </div>
          @endif
          @endif



          @if(Auth::check())

          <div class="ui pointing dropdown link item ">
            <i class="large inverted blue user circle outline icon"></i>{{ Auth::user()->name }}<i class="dropdown icon"></i>
            <div class="menu">

              <a class="item editProfilelogin" data-id="{{ Auth::user()->id }}" data-name="{{ Auth::user()->name }}"  data-email="{{ Auth::user()->email }}"><i class="edit icon"></i>แก้ไขข้อมูลส่วนตัว</a>
              <a class="item" id="editpassword"><i class="settings icon"></i>เปลี่ยนPassword</a>
              <a class="item" href="" download='guideadmin.pdf'><i class="warning sign icon"></i>คู่มือแนะนำการใช้เว็ปไซต์</a>
              <a class="item" href="{{ route('Project.logout') }}"><i class="sign out icon"></i>ออกจากระบบ</a>
            </div>
          </div>


          @endif
          @if(Auth::check()==false)
          <a class="item" href="{{ route('Project.login') }}">
            <i class="large sign in icon"></i>login
          </a>
          @endif
        </div>
        

      </div>
    </div>

    <div class="mobile only row">
      <div class="ui fixed inverted menu navbar menu menu-nav" style="position: fixed;" >
         @if(Auth::check())

          <a href="{{ route('Project.dashboard') }}" >
            <div class="navbar-header">
              <img src="{{ asset('photo/gistdalogo3.png') }}" class="photologo">
            </div>
          </a>
          @else
          <a href="{{ route('Project.index') }}" >
            <div class="navbar-header">
              <img src="{{ asset('photo/gistdalogo3.png') }}" class="photologo">
            </div>
          </a>
          @endif
        <div class="right menu ">
          <a  class="menu item" id="menubar">
            <i class="sidebar icon"></i>
          </a>
        </div>
      </div>

      <div class="ui bottom attached segment pushable">
        <div class="ui inverted labeled  vertical wide sidebar menu">
          <a href="{{ route('Project.dashboard') }}" >
            <div class="navbar-header">
              <center><img src="{{ asset('photo/gistdalogo3.png') }}" class="photologo2"></center>
            </div>
          </a>
          <a class="ui item" href="{{ route('Project.checksatellite') }}">
            <div class="text "><i class="large send icon"></i>ตรวจสอบการเข้าถึงของดาวเทียม
            </div>
          </a>
          <a class="ui item" href="{{ route('Project.position') }}">
            <div class="text "><i class="large rocket  icon"></i>ตำแหน่งดาวเทียม
            </div>
          </a>

          <div class="ui item ">
            <div class="text " id="hideShowphoto"><i class="large archive icon"></i>คลังข้อมูล</div>
            <div class="menu">
              <div id="hidePhoto" >
                <a class="item" href="{{ route('Project.PhotoGallery') }}">
                  <i class="photo icon"></i>คลังรูปภาพ
                </a>
                <a class="item" href="{{ route('Project.SoundArchive') }}">
                  <i class="signal icon"></i>คลังเสียง
                </a>
                @if(Auth::check())
                @if(Auth::user()->type=='admin' ) 
                <a class="item" href="{{ route('Project.logCollection') }}">
                  <i class="list layout icon"></i>ประวัติการรับสัญาณ
                </a>
                @endif
                @endif
              </div>
            </div>

          </div>
          @if(Auth::check())

          <div class="ui item">
            <div class="text" id="hideShowSetting"><i class="large settings icon"></i>จัดการระบบ
            </div>
            <div class="menu">
              <div id="hideSetting">
                <a class="item" href="{{ route('Project.control') }}">
                  <i class="large rss icon"></i>ตั้งค่ามุมเสาอากาศ
                </a>
                <a class="item" href="{{ route('Project.tle') }}">
                  <i class="large rocket icon"></i>TLE
                </a>
                <a class="item" href="{{ route('Project.member') }}">
                  <i class="large users icon"></i>สมาชิก
                </a>
                

              </div>
            </div>

          </div>
          @endif

          @if(Auth::check())
          <div class="ui item">
           <div class="text" id="hideShowProfile"><i class="large address card outline icon"></i>{{ Auth::user()->name }}</div>


           <div class="menu">
            <div id="hideProfile">
              <a class="item editProfilelogin" data-id="{{ Auth::user()->id }}" data-name="{{ Auth::user()->name }}"  data-email="{{ Auth::user()->email }}"><i class="edit icon"></i>แก้ไขข้อมูลส่วนตัว</a>
              <a class="item" id="editpassword"><i class="settings icon"></i>เปลี่ยนPassword</a>
              <a class="item" href="/admin/guideadmin.pdf" download='guideadmin.pdf'><i class="warning sign icon"></i>คู่มือแนะนำการใช้เว็ปไซต์</a>
              <a class="item" href="{{ route('Project.logout') }}"><i class="sign out icon"></i>ออกจากระบบ</a>
            </div>
          </div>
        </div>
        @endif
        @if(Auth::check()==false)
        <a class="ui item" href="{{ route('Project.login') }}">
          <div class="text "> <i class="large sign in icon"></i>login
          </div>
        </a>

        @endif
      </div>


    </div>
    <br><br>

  </div>

  @if(Auth::check())
  <div class="ui modal" id="editmodal">
    <i class="close icon"></i>
    <div class="header">
      แก้ไขรหัสผ่าน
    </div>

    <div class="content">
      <div class="ui form">
        <div class="inline fields container">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" id="iduser" value="{{ Auth::user()->id }}">
          <div class="two wide field">
            <label>รหัสผ่านเดิม&nbsp;&nbsp;:</label>
          </div>
          <div class="fourteen wide field">
            <input type="password" id="passwordold">
          </div>
        </div>
        <div class="inline fields container">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" id="iduser" value="{{ Auth::user()->id }}">
          <div class="two wide field">
            <label>รหัสผ่านใหม่&nbsp;&nbsp;:</label>
          </div>
          <div class="fourteen wide field">
            <input type="password" id="passwordedit">
          </div>
        </div>
        <div class="inline fields container">
          <div class="two wide field">
            <label>ยืนยันรหัสผ่าน&nbsp;&nbsp;:</label>
          </div>
          <div class="fourteen wide field">
            <input type="password"  id="passwordedit2">
          </div>
        </div>
      </div>
    </div>

    <div class="actions">
      <div class="ui black deny button" >
        ยกเลิก
      </div>
      <div class="ui positive right labeled icon button" id="confirmpassword">
        บันทึก
        <i class="checkmark icon"></i>
      </div>
    </div>
  </div>

  <div class="ui basic modal" id="message-pass-modal" >
    <i class="close icon"></i>
    <div class="ui icon header">
      <i class="checkmark box icon"></i>
      เปลี่ยนรหัสผ่านสำเร็จ
    </div>
    <div class="content">
      <center>
        <p>โปรดเข้าสู่ระบบด้วยรหัสผ่านใหม่ในครั้งต่อไป</p>
      </center>
    </div>
  </div>

  <div class="ui modal" id="editProfilelogin">
    <i class="close icon"></i>
    <div class="header">
      แก้ไขข้อมูลส่วนตัว   
      
    </div>
    <div class="content">
      <div class="ui form" >
        <div class="inline fields container">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" id="iduserlogin" value="" >
          <div class="two wide field">
            <label>ชื่อ-นามสกุล&nbsp;&nbsp;:</label>
          </div>
          <div class="fourteen wide field">
            <input type="text"  id="nameuserlogin" required>
          </div>
        </div>
        <div class="inline fields container">
          <div class="two wide field">
            <label>Email&nbsp;&nbsp;:</label>
          </div>
          <div class="fourteen wide field">
            <input type="email"  id="emaillogin" required>
          </div>
        </div>
      </div>
    </div>

    <div class="actions">
      <div class="ui black deny button" >
        ยกเลิก
      </div>
      <div class="ui positive right labeled icon button" id="editsubmitlogin">
        บันทึก
        <i class="checkmark icon"></i>
      </div>
    </div>
  </div>

  @endif

  @yield('content')
</div>
<script type="text/javascript">
  $(document).on('click', '#hideShowphoto', function() {
    $("#hidePhoto").toggle('fast');

  });
  $(document).on('click', '#hideShowSetting', function() {
    $("#hideSetting").toggle('fast');

  });
  $(document).on('click', '#hideShowProfile', function() {
    $("#hideProfile").toggle('fast');

  });
  $(document).on('click', '#menubar', function() {

    $('.ui.labeled.sidebar')
    .sidebar('setting', 'transition', 'overlay')
    .sidebar('toggle');

  });

  $(document).ready(function(){


    $(document).on('click', '.editProfilelogin', function() {

      $('#iduserlogin').val($(this).data('id'));
      $('#nameuserlogin').val($(this).data('name'));
      $('#emaillogin').val($(this).data('email'));
      $('#editProfilelogin').modal('show');
    });
    $('.actions').on('click', '#editsubmitlogin', function() {
      if ( $('#emaillogin').val() == '' ) {
        alert('email ไม่ถูกต้อง');
      }else{
        $.ajax({
          type: 'post',
          url: '/submitEditProfile',
          data: {
            '_token': $('input[name=_token]').val(),
            'id': $('#iduserlogin').val(),
            'name' : $('#nameuserlogin').val(),
            'email' : $('#emaillogin').val()
          },
          success: function(data) {
            alert('ยืนยันสำเร็จ');
            location.reload();
          },
          error: function(){
            alert('มีemailนี้ในระบบ แล้ว กรุณาใช้email อื่น');
          }

        })
      }     
    });

    $(document).on('click', '#editpassword', function() {
      $('#editmodal').modal('show');
    });

    $('.actions').on('click', '#confirmpassword', function() {
      if($('#passwordedit').val()!=$('#passwordedit2').val()){
        alert('รหัสผ่านไม่ถูกต้อง');
      }else{
        $.ajax({
          type: 'post',
          url: '/settingPassword',
          data: {
            '_token': $('input[name=_token]').val(),
            'id': $('#iduser').val(),
            'password' : $('#passwordedit').val(),
            'passwordold' : $('#passwordold').val()

          },
          success: function(data) {
            console.log(data)
            $('#message-pass-modal').modal('show');
          },
          error: function(){
            alert('รหัสผ่านเก่าไม่ถูกต้อง');
          }
        })
      }
    });

  });
</script>


</body>

</html>