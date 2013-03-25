{{Form::open("/overview/process","POST", array('class'=>'form-inline'))}}
<fieldset>
	<legend>{{$title}}</legend>
	
	<div class="control-group">
		{{Form::text('date_from', Input::old('date_from', $date_from), array('title'=>'Date From', 'id'=>'date_from', 'class'=>'input-small', 'placeholder'=>'From'))}} - {{Form::text('date_to', Input::old('date_to', $date_to), array('title'=>'Date To','id'=>'date_to', 'class'=>'input-small', 'placeholder'=>'To'))}}
		{{Form::button('Go', array('type'=>'submit', 'class'=>'btn'))}}			
	</div>
	<span class="row-fluid">
		<span class="span12">
			Viewing records from <strong>{{date('d M Y',strtotime($date_from))}}</strong> to <strong>{{date('d M Y',strtotime($date_to))}}</strong>
		</span>
	</span>

	<table class="table table-condensed table-hover">
		<thead>
			<tr>
				<th>Type</th>
				<th class="ar">Total Amount</th>
			</tr>
		</thead>
		<tbody>
			@foreach($overview as $key => $value)
			<tr>
				<td>{{ucwords($key)}}</td>
				<td class="ar">{{$value}}</td>
			</tr>
			@endforeach
		</tbody>
		<tfoot>
			<tr>
				<th></th>
				<th>
					Balance: Rs {{$balance}}<br>
					Expected Balance: Rs {{$expected_balance}}
				</th>
			</tr>
		</tfoot>
	</table>
</fieldset>
{{Form::close()}}
