@render('partials.message')

{{Form::open('/create', 'POST', array('class'=>'form-inline'))}}
	<fieldset>
		<legend>{{$title}}</legend>

		<div class="control-group{{ $errors->has('particulars') ?' error':''}}">
			<div class='controls'>
				{{Form::text('particulars', Input::old('particulars'), array('id'=>'particulars', 'placeholder'=>'Particulars', 'class'=>'input-xxlarge', 'title'=> ($errors->has('particulars') ?  $errors->first('particulars', ':message') : 'Particulars of Income') ))}}
			</div>
		</div>

		<div class="control-group">
			<div class='controls'>
				<span class="control-group{{ $errors->has('source') ?' error':''}}">
					{{Form::text('source', Input::old('source'), array('id'=>'source', 'placeholder'=>'Source', 'class'=>'input-medium', 'title'=> ($errors->has('source') ?  $errors->first('source', ':message') : 'Source of Income') ))}}
				</span>
				&nbsp;
				<span class="input input-prepend control-group{{ $errors->has('amount') ?' error':''}}">
					<span class="add-on">Rs</span>
					{{Form::text('amount', Input::old('amount'), array('id'=>'amount', 'placeholder'=>'Amount', 'class'=>'input-medium', 'title'=> ($errors->has('amount') ?  $errors->first('amount', ':message') : 'Amount of Income') ))}}
				</span>
				&nbsp;
				<span class="control-group{{ $errors->has('date') ?' error':''}}">
					{{Form::text('date', Input::old('date'), array('readonly'=>'readonly', 'id'=>'date', 'placeholder'=>'Date', 'class'=>'input-medium', 'title'=> ($errors->has('date') ?  $errors->first('date', ':message') : 'Date of Income') ))}}
				</span>
			</div>
		</div>

		<div class="control-group{{ $errors->has('notes') ?' error':''}}">
			<div class='controls'>
				{{Form::textarea('notes', Input::old('notes'), array('id'=>'notes', 'placeholder'=>'notes', 'class'=>'input-xxlarge', 'rows'=>'3', 'title'=> ($errors->has('notes') ?  $errors->first('notes', ':message') : 'Optional notes on Income') ))}}
			</div>
		</div>

		<div class='form-actions'>
			{{Form::button('Create', array('type'=>'submit', 'class'=>'btn btn-primary'))}}
			&nbsp;
			{{Form::button('Reset', array('type'=>'reset', 'class'=>'btn btn-danger'))}}
		</div>
		
	</fieldset>
	{{Form::hidden('type', 'expected')}}
{{Form::close()}}
