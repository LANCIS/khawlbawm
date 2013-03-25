<?php

class Create_Users_Table {    

	public function up()
    {
		Schema::create('users', function($table) {
			$table->increments('id');
			$table->string('name');
			$table->string('full_name');
			$table->string('email');
			$table->string('password');
			$table->timestamps();

		});

		$user = new User();
		$user->name = 'owner';
		$user->full_name = 'new owner';
		$user->email = 'owner@website.tld';
		$user->password = Hash::make('password');
		$user->save();
		echo 'things';

    }    

	public function down()
    {
		Schema::drop('users');

    }

}