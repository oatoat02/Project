@extends('layout')
@section('content')


<script src="http://malsup.github.com/jquery.form.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
<form action="{{ route('Project.testupload') }}" method="post" enctype="multipart/form-data" id='testform'>
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <input type="file" name="myfile"><br>
  <input type="submit" value="Upload File to Server">
</form>

<div class="progress">
  <div class="bar"></div >
  <div class="percent" id=''>0%</div >
</div>

<div id="status"></div>
<div class="ui teal progress" id="example4">
  <div class="bar"></div>
  <div class="label">22% Earned</div>
</div>
<script type="text/javascript">
$('#ssss').change(function(){
      console.log('sssssssss');
});
</script>
<script type="text/javascript">
  $(function() {

    var bar = $('.bar');
    var percent = $('.percent');
    var status = $('#status');
    var percentVal;
    $('form').ajaxForm({
      beforeSend: function() {
        status.empty();
        var percentVal = '0%';
        bar.width(percentVal);
        percent.html(percentVal);
      },
      uploadProgress: function(event, position, total, percentComplete) {
        var percentVal = percentComplete + '%';
        bar.width(percentVal);
        percent.html(percentVal);
        $('#example4').progress({
          percent: percentComplete
        });
      },
      complete: function(xhr) {
        status.html(xhr.responseText);
      }

    });


  }); 
</script>

@stop