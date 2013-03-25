<?php

class Create_Transactions_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("transactions", function($table){
			$table->increments('id');
			$table->text('particulars');
			$table->text('type'); // income, expected_income, expenditure, credit
			$table->text('source')->nullable();
			$table->decimal('amount', '10','2');
			$table->text('notes')->nullable();
			$table->date('date');
			$table->boolean('deleted')->default(false);
			$table->integer('user_id');
			$table->timestamps();
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('transactions');
	}

}