<?php
class Home_Controller extends Base_Controller
{
	public function __construct()
	{
		$this->filter('before', 'auth');

		parent::__construct();
	}

	public function get_index()
	{
		return Redirect::to('/income');
	}

	public function get_income()
	{
		$this->layout
			->with(array("title"=>"Create Income Record &raquo;"))
			->nest(
				'content',
				'home.income',
				array(
					'title'=>'Create Income Record'
					));
	}

	public function get_expected()
	{
		$this->layout
			->with(array("title"=>"Create Expected Income Record &raquo;"))
			->nest(
				'content',
				'home.expected',
				array(
					'title'=>'Create Expected Income Record'
					));
	}

	public function get_expenditure()
	{
		$this->layout
			->with(array("title"=>"Create Expenditure Record &raquo;"))
			->nest(
				'content',
				'home.expenditure',
				array(
					'title'=>'Create Expenditure Record'
					));
	}

	public function get_credit()
	{
		$this->layout
			->with(array("title"=>"Create Expenditure (Credit) Record &raquo;"))
			->nest(
				'content',
				'home.credit',
				array(
					'title'=>'Create Expenditure (Credit) Record'
					));
	}

	public function post_create()
	{
		$rules = array();

		$rules['particulars'] = 'required';
		
		if(Input::get('type') == 'income' || Input::get('type') == 'expected')
			$rules['source'] = 'required';
		
		$rules['type'] = 'required';
		$rules['amount'] = 'required';
		$rules['date'] = 'required';
		
		$validation = Validator::make(Input::all(), $rules);

		if($validation->fails())
		{
			return Redirect::to('/income')->with_errors($validation)->with_input();
		}
		else
		{
			$transaction = new Transaction;
			$transaction->particulars = Input::get('particulars');
			$transaction->source = Input::get('source');
			$transaction->type = Input::get('type');
			$transaction->amount = Input::get('amount');
			$transaction->notes = Input::get('notes');
			$transaction->date = Input::get('date')." 00:00:00";
			$transaction->user_id = Auth::user()->id;
			$transaction->save();

			if(Input::get('type') == "income")
				return Redirect::to('/income')->with('message', array('success'=>'Income record inserted. Add more below.'));
			elseif(Input::get('type') == "expected")
				return Redirect::to('/expected')->with('message', array('success'=>'Expected income record inserted. Add more below.'));
			elseif(Input::get('type') == "expenditure")
				return Redirect::to('/expenditure')->with('message', array('success'=>'Expenditure record inserted. Add more below.'));
			elseif(Input::get('type') == "credit")
				return Redirect::to('/credit')->with('message', array('success'=>'Expenditure (credit) record inserted. Add more below.'));
		}
	}

	public function get_overview()
	{
		$from = $to = time();
		$date_from = date('Y', $from).'-'.date('m', $from).'-01';
		$date_to = date('Y-m-t', $to);

		$input = Input::old();
		if($input != null)
		{
			$from = strtotime($input['date_from']);
			$to = strtotime($input['date_to']);
			
			$date_from = date('Y-m-d', $from);
			$date_to = date('Y-m-d', $to);
		}

		$overview_data = Transaction::where_between(DB::raw('DATE(`date`)'), $date_from, $date_to)
					->where_deleted(false)
					->group_by('type')
					->get(array('type', DB::raw('SUM(`amount`) as `amount`')));

		$overview = array(
			'income'=>0,
			'expected'=>0,
			'expenditure'=>0,
			'credit'=>0
			);

		foreach ($overview_data as $key => $value)
		{
			if($value->attributes['type'] == 'income')
				$overview['income'] = $value->attributes['amount'];
			
			if($value->attributes['type'] == 'expected')
				$overview['expected'] = $value->attributes['amount'];
			
			if($value->attributes['type'] == 'expenditure')
				$overview['expenditure'] = $value->attributes['amount'];
			
			if($value->attributes['type'] == 'credit')
				$overview['credit'] = $value->attributes['amount'];
		}

		$balance = $overview['income'] - ($overview['expenditure']);
		$expected_balance = ($overview['income'] + $overview['expected']) - ($overview['expenditure'] + $overview['credit']);

		
		$this->layout
			->with(array("title"=>"Account Overview &raquo;"))
			->nest(
				'content',
				'home.overview',
				array(
					'title'=>'Account Overview',
					'date_from' => $date_from,
					'date_to' => $date_to,
					'overview' => $overview,
					'balance' => $balance,
					'expected_balance' => $expected_balance
					));
	}

	public function post_overview()
	{
		return Redirect::to("/overview")->with_input();
	}

	public function get_transactions()
	{
		$input = Input::old();
		$transactions = null;
		if($input != null)
		{
			if($input['type'] != "all")
			{
				$transactions = Transaction::where_user_id(Auth::user()->id)
						->where('particulars','LIKE','%'.$input['query'].'%')
						->where('type','=', $input['type'])
						->where_deleted(0)
						->order_by('date', 'desc')
						->paginate(0);

			}
			else
			{
				$transactions = Transaction::where_user_id(Auth::user()->id)
						->where('particulars','LIKE','%'.$input['query'].'%')
						->where_deleted(0)
						->order_by('date', 'desc')
						->paginate(0);
			}
		}
		else
		{
			$transactions = Transaction::where_user_id(Auth::user()->id)
						->where_deleted(0)
						->order_by('date', 'desc')
						->paginate(15);
		}

		$this->layout
			->with(array("title"=>"Transactions &raquo;"))
			->nest(
				'content',
				'home.transactions',
				array(
					'title'=>'Transactions',
					'transactions' => $transactions
					));
	}

	public function post_transactions()
	{
		return Redirect::to("/transactions")->with_input();
	}

	public function get_transaction($id)
	{
		$transaction = Transaction::where_user_id(Auth::user()->id)->where_id($id)->first();

		$this->layout
			->with(array("title"=>"Edit Transaction - ".ucwords($transaction->type)." &raquo;"))
			->nest(
				'content',
				'home.transaction',
				array(
					'title'=>'Edit Transaction - <span class="muted">'.ucwords($transaction->type).'</span>',
					'transaction' => $transaction
					));
	}

	public function put_update()
	{
		$rules = array();

		$rules['particulars'] = 'required';
		
		if(Input::get('type') == 'income' || Input::get('type') == 'expected')
			$rules['source'] = 'required';
		
		$rules['type'] = 'required';
		$rules['amount'] = 'required';
		$rules['date'] = 'required';
		
		$validation = Validator::make(Input::all(), $rules);

		if($validation->fails())
		{
			return Redirect::to('/transaction/'.Input::get('id'))->with_errors($validation)->with_input();
		}
		else
		{
			$transaction = Transaction::find(Input::get('id'));
			$transaction->particulars = Input::get('particulars');
			$transaction->source = Input::get('source');
			$transaction->type = Input::get('type');
			$transaction->amount = Input::get('amount');
			$transaction->notes = Input::get('notes');
			$transaction->date = Input::get('date')." 00:00:00";
			$transaction->user_id = Auth::user()->id;
			$transaction->save();

			if(Input::get('type') == "income")
				return Redirect::to('/transaction/'.Input::get('id'))->with('message', array('success'=>'Income record updated.'));
			elseif(Input::get('type') == "expected")
				return Redirect::to('/transaction/'.Input::get('id'))->with('message', array('success'=>'Expected income record updated.'));
			elseif(Input::get('type') == "expenditure")
				return Redirect::to('/transaction/'.Input::get('id'))->with('message', array('success'=>'Expenditure record updated.'));
			elseif(Input::get('type') == "credit")
				return Redirect::to('/transaction/'.Input::get('id'))->with('message', array('success'=>'Expenditure (credit) record updated.'));
		}
	}

	public function delete_transaction()
	{
		$id = Input::get('delete');
		if ($id) {
			$result = Transaction::update($id, array('deleted'=>true));
			if ($result) {
				return Redirect::to("/transactions")
					->with("message", array('success'=>'Transaction record trashed successfully.'));
			}
		}
	}

	public function get_trash()
	{
		$this->layout
			->with(array("title"=>"Trash &raquo;"))
			->nest(
				'content',
				'home.trash',
				array(
					'title'=>'Trash',
					'transactions' => Transaction::where_user_id(Auth::user()->id)
						->where_deleted(1)
						->order_by('date', 'desc')
						->paginate(15)
					));
	}

	public function put_trash()
	{
		$delete = Input::get('delete');
		$restore = Input::get('restore');
		if ($delete) {
			$result = Transaction::find($delete)->delete();
			if ($result) {
				return Redirect::to("/trash")
					->with("message", array('success'=>'Transaction record deleted permanently.'));
			}
		}
		else if($restore) {
			$result = Transaction::update($restore, array('deleted'=>false));
			if ($result) {
				return Redirect::to("/trash")
					->with("message", array('success'=>'Transaction record restored successfully.'));
			}
		}
	}
}