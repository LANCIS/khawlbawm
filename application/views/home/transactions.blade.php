@render('partials.message')
<fieldset>
	<legend>{{$title}}</legend>

	{{Form::open("/transactions", "POST", array("class"=>"form-inline form-search"))}}
		<span class="input">
			{{Form::select("type", array("all"=>"All", "income"=>"Income", "expected"=>"Expected", "expenditure"=>"Expenditure", "credit"=>"Credit"), "all", array("class"=>"input-medium"))}}
		</span>
		<span class="input input-append">
			{{Form::text("query", Input::old("query"), array("placeholder"=>"Search particulars", "class"=>"input-medium"))}}
			<button class="btn" type="submit" value="search">Go</button>
		</span>
	{{Form::close()}}

	{{Form::open("/transaction", "DELETE", array('class'=>'form-inline'))}}
	<table class="table table-condensed" data-provides="rowlink">
		<thead>
			<tr>
				<th class="span2">Date</th>
				<th class="span2">Type</th>
				<th class="span4">Particulars</th>
				<th class="span2 ar">Amount</th>
				<th class="span1"></th>
			</tr>
		</thead>
		<tbody>
		@if(empty($transactions->results))
			<tr class="info"><td colspan="5" class="ac"><em>No Record</em></td></tr>
		@endif

		<?php $j = $transactions->per_page * ($transactions->page - 1) ?>
		@foreach($transactions->results as $key => $item)
			<tr>
				<td><a href="/transaction/{{$item->id}}" title="Click to edit">{{date('d M Y',strtotime($item->date))}}</a></td>
				<td>
					@if($item->type == "income")
					<span class="text-success">{{ucwords($item->type)}}</span>
					@elseif($item->type == "expected")
					<span class="text-info">{{ucwords($item->type)}}</span>
					@elseif($item->type == "expenditure")
					<span class="text-error">{{ucwords($item->type)}}</span>
					@elseif($item->type == "credit")
					<span class="text-warning">{{ucwords($item->type)}}</span>
					@endif
				</td>
				<td>{{$item->particulars}}</td>
				<td class="ar">{{$item->amount}}</td>
				<td class="nolink ac"><button class="btn btn-link remove-transaction" type="submit" name="delete" value="{{$item->id}}"><i class="icon icon-trash"></i></button></td>
			</tr>
		@endforeach
		</tbody>
	</table>
	
	{{Form::close()}}

	{{$transactions->links()}}
</fieldset>
