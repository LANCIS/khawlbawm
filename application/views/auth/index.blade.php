<p class="lead">{{$title}}</p>

@render("partials.message")

{{Form::open("/login", "POST", array("class"=>"form-horizontal"))}}
	<div class="control-group{{ $errors->has('password') ?' error':''}}">
		{{Form::label("username", "Username", array("class"=>"control-label"))}}
		<div class="controls">
			{{Form::text("username", "", array())}}
			{{ $errors->first('username', '<span class="help-inline">:message</span>')}}
		</div>
	</div>
	<div class="control-group{{ $errors->has('password') ?' error':''}}">
		{{Form::label("password", "Password", array("class"=>"control-label"))}}
		<div class="controls">
			{{Form::password("password", array())}}
			{{ $errors->first('password', '<span class="help-inline">:message</span>')}}
		</div>
	</div>
	<div class="control-group">
		<div class="controls">
			{{Form::button('Login', array('type'=>'submit', 'class'=>'btn btn-primary'))}}
		</div>
	</div>
{{Form::close()}}