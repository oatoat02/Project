@extends('layout')
@section('content')
<script type="text/javascript">
myAsyncFunc(callbackFunc);

function myAsyncFunc (callback) {
  callback();
  console.log('ttttttttt')
}

function callbackFunc () {
  console.log('this is callback function')
}
</script>

@stop