<?php

class Create_Items_Table {    

	public function up()
    {
		Schema::create('items', function($table) {
			$table->increments('id');
			$table->string('name');
			$table->timestamps();

		});
    }    

	public function down()
    {
		Schema::drop('items');

    }

}