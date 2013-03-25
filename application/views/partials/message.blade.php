<?php $message = Session::get('message') ?>

{{--
	We can have message status as
		block
		error
		info
		success

	Message should be passed as array
		array("block" => "Block message")
		array("error" => "Error message")
		array("info" => "Information message")
		array("success" => "Success message")
--}}

@if(!empty($message))
	@foreach($message as $key=>$m)
	<div class="alert fade in alert-{{$key}}">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		{{$m}}
	</div>
	@endforeach
@endif