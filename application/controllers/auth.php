<?php

class Auth_Controller extends Base_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function get_index()
	{
		if(!Auth::guest())
			return Redirect::to('/');

		$this->layout
			->with(array("title"=>"Authentication &raquo;"))
			->nest(
				'content',
				'auth.index',
				array(
					'title'=>'Login to do amazing stuffs'
					));
	}

	public function post_index()
	{
		$rules = array(
			'username' => 'required',
			'password' => 'required'
			);

		$validation = Validator::make(Input::all(), $rules);

		if($validation->fails())
		{
			return Redirect::to("/login")->with_errors($validation)->with_input();
		}
		else
		{
			$credentials = array(
				'username' => Input::get("username"),
				'password' => Input::get("password")
			);

			if(Auth::attempt($credentials))
			{
				return Redirect::to("/expenditure")->with('message',array("success"=>"Authentication successful. Welcome, ".Auth::user()->full_name));
			}
			else
			{
				return Redirect::to("/login")->with('message',array("error"=>"Username or Password incorrect! Please try again."));
			}
		}
	}

	public function get_logout()
	{
		if(Auth::guest())
			return Redirect::to("/login")->with('message',array("success"=>"No active authentication."));
		
		Auth::logout();
		return Redirect::to("/login")->with('message',array("success"=>"Cleared authenticated session successfully."));
	}
}