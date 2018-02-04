@extends('layout')
@section('content')
	

      <div class="ui sixteen wide column box4 ">
     
        <div class="ui grey inverted segment ">
        <h3>คำร้องขอเข้าใช้งาน</h3>
        </div>
          <table class="ui celled table  " >
            <thead>
            <tr>
              <th>#</th>
              <th>ชื่อ-นามสกุล</th>
              <th>Username</th>
              <th>E-mail</th>
             
              <th>รายละเอียด</th>
            
            </tr>
            </thead>
            <tbody>
           
              <tr>
                <td> 1</td>
                <td> ชนสิษฎ์ มรรยาทอ่อน</td>
                <td> oatoat02 </td>
                <td>chonnasit.m@ku.th</td>
               
                <td>
                  <div class="ui buttons" style="font-size: 10px !important; width:100%; ">
                    <button class="ui green button yes-allow" data-id="" style="font-size: 12px !important;">อนุมัติ</button>
                    <div class="or"></div>
                    <button class="ui yellow button No-allow" data-id="" style="font-size: 12px !important;">ปฏิเสธ</button>
                  </div>
                </td>
               
              </tr>
              <tr>
                <td> 2</td>
                <td> จิระพงศ์ ศรีคำไทย </td>
                <td> JirapongJack </td>
                <td>jirapong_Jack@hotmail.com</td>
               
                <td>
                  <div class="ui buttons" style="font-size: 10px !important; width:100%; ">
                    <button class="ui green button yes-allow" data-id="" style="font-size: 12px !important;">อนุมัติ</button>
                    <div class="or"></div>
                    <button class="ui yellow button No-allow" data-id="" style="font-size: 12px !important;">ปฏิเสธ</button>
                  </div>
                </td>
               
              </tr>
              <tr>
                <td> 3</td>
                <td> วิศรุต โชคสวัสดิ์</td>
                <td> Newza500 </td>
                <td>Newza500@gmail.com</td>
               
                <td>
                  <div class="ui buttons" style="font-size: 10px !important; width:100%; ">
                    <button class="ui green button yes-allow" data-id="" style="font-size: 12px !important;">อนุมัติ</button>
                    <div class="or"></div>
                    <button class="ui yellow button No-allow" data-id="" style="font-size: 12px !important;">ปฏิเสธ</button>
                  </div>
                </td>
               
              </tr>
          
            </tbody>
          </table>
          <br>
          <hr>
         
          <br>
        <div class="ui grey inverted segment ">
        <h3>บัญชี ที่มีในระบบ</h3>
        </div>
          <table class="ui celled table">
          <thead>
            <tr>
              <th>#</th>
              <th>ชื่อ-นามสกุล</th>
              <th>Username</th>
              <th>E-mail</th>
              
              <th>รายละเอียด</th>
            
            </tr>
          </thead>
          <tbody>
         
           
           
              <tr>
                 <td> 1</td>
                <td>สฤษดิ์วงศ์ หวานเสนาะ</td>
                <td> SalidwongJ </td>
                <td> Salidwong@hotmail.com</td>
                <td>
                  <div class="ui buttons" style="font-size: 10px !important; width:100%; ">
                    <button class="ui red button editpasswordUser" data-id="" data-name="" style="font-size: 12px !important;">แก้ไข Password</button>
                    <div class="or"></div>
                    <button class="ui olive button editProfileuser2" data-id="" data-name=""  data-email="" style="font-size: 12px !important;">แก้ไขข้อมูลส่วนตัว</button>
                  </div>
                </td>
              </tr>
           
      
         
            
                <tr>
                   <td>2</td>
                <td> สาวภาสินี ขันติวิศิษฎ์</td>
                <td> navigate </td>
                <td>pasinee.kh@ku.th</td>
                <td>
                  <div class="ui buttons" style="font-size: 10px !important; width:100%; ">
                    <button class="ui red button editpasswordUser" data-id="" data-name="" style="font-size: 12px !important;">แก้ไข Password</button>
                    <div class="or"></div>
                    <button class="ui olive button editProfileuser2" data-id="" data-name=""  data-email="" style="font-size: 12px !important;">แก้ไขข้อมูลส่วนตัว</button>
                  </div>
                </td>
                </tr>
           
          </tbody> 
          </table>
      
      </div> 
    </div> 
    <br>
    <br>

@stop