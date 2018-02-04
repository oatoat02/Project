@extends('layout')

@section('content')


<div class="ui selection dropdown select-language">
    <input name="language" type="hidden" value="fr-FR">
    <div class="text">French</div>
    <i class="dropdown icon"></i>
    <div class="menu ui transition hidden">
        <div class="item" data-value="en-US">English</div>
        <div class="item active" data-value="fr-FR">French</div>
    </div>
</div>

<script type="text/javascript">
	$( document ).ready(function() {
		console.log( "ready!" );
		$(".select-language").dropdown({
			onChange: function (val) {
				alert(val);
				console.log( "ready!" );
			}
		});
	});
</script>

@stop 