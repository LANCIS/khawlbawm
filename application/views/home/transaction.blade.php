@render('partials.message')

{{Form::open('/update', 'PUT', array('class'=>'form-inline'))}}
	<fieldset>
		<legend>{{$title}}</legend>

		<div class="control-group{{ $errors->has('particulars') ?' error':''}}">
			<div class='controls'>
				{{Form::text('particulars', Input::old('particulars', $transaction->particulars), array('readonly'=>'readonly', 'id'=>'particulars', 'placeholder'=>'Particulars', 'class'=>'input-xxlarge', 'title'=> ($errors->has('particulars') ?  $errors->first('particulars', ':message') : 'Particulars of Income') ))}}
			</div>
		</div>

		<div class="control-group">
			<div class='controls'>
				@if($transaction->type == "income" || $transaction->type == "expected")
				<span class="control-group{{ $errors->has('source') ?' error':''}}">
					{{Form::text('source', Input::old('source', $transaction->source), array('id'=>'source', 'placeholder'=>'Source', 'class'=>'input-medium', 'title'=> ($errors->has('source') ?  $errors->first('source', ':message') : 'Source of Income') ))}}
				</span>
				&nbsp;
				@endif
				<span class="input input-prepend control-group{{ $errors->has('amount') ?' error':''}}">
					<span class="add-on">Rs</span>
					{{Form::text('amount', Input::old('amount', $transaction->amount), array('id'=>'amount', 'placeholder'=>'Amount', 'class'=>'input-medium', 'title'=> ($errors->has('amount') ?  $errors->first('amount', ':message') : 'Amount of Income') ))}}
				</span>
				&nbsp;
				<span class="control-group{{ $errors->has('date') ?' error':''}}">
					{{Form::text('date', Input::old('date', date('Y-m-d',strtotime($transaction->date))), array('readonly'=>'readonly', 'id'=>'date', 'placeholder'=>'Date', 'class'=>'input-medium', 'title'=> ($errors->has('date') ?  $errors->first('date', ':message') : 'Date of Income') ))}}
				</span>
			</div>
		</div>

		<div class="control-group{{ $errors->has('notes') ?' error':''}}">
			<div class='controls'>
				{{Form::textarea('notes', Input::old('notes', $transaction->notes), array('id'=>'notes', 'placeholder'=>'notes', 'class'=>'input-xxlarge', 'rows'=>'3', 'title'=> ($errors->has('notes') ?  $errors->first('notes', ':message') : 'Optional notes on Income') ))}}
			</div>
		</div>

		<div class="control-group{{ $errors->has('type') ?' error':''}}">
			<div class='controls'>
				@if($transaction->type == "income" || $transaction->type == "expected")
				<label class="radio inline">
					{{ Form::radio("type", "income", ($transaction->type == "income")?true:false ) }} Income
				</label>
				<label class="radio inline">
					{{Form::radio("type", "expected", ($transaction->type == "expected")?true:false)}} Expected
				</label>
				@elseif($transaction->type == "expenditure" || $transaction->type == "credit")
				<label class="radio inline">
					{{ Form::radio("type", "expenditure", ($transaction->type == "expenditure")?true:false ) }} Expenditure
				</label>
				<label class="radio inline">
					{{Form::radio("type", "credit", ($transaction->type == "credit")?true:false)}} Credit
				</label>
				@endif
			</div>
		</div>

		<div class='form-actions'>
			{{Form::button('Update', array('type'=>'submit', 'class'=>'btn btn-success'))}}
			&nbsp;
			{{Form::button('Cancel', array('type'=>'button', 'class'=>'btn btn-danger', 'onclick'=>'window.location = "'.Request::server('http_referer').'"'))}}
		</div>
		
	</fieldset>
	{{Form::hidden('id', $transaction->id)}}
{{Form::close()}}
