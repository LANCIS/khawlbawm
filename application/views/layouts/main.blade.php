<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>{{$title}} Khawlbawm</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="img/ico/favicon.png">
	<?php echo Asset::styles(); ?>
	<?php echo Asset::scripts(); ?>
</head>
<body>
<div class="container-fluid">
	<div class="row-fluid">
		<h2 class="span12"><i class="icon-dashboard"></i> Khawlbawm</h2>
	</div>
	<div class="row-fluid content">
		@if(Auth::guest())
 		<div class="span8"><div class="row-fluid">{{$content}}</div></div>
 		@else
		<ul id="main_menu" class="nav nav-tabs nav-pills nav-stacked span3">
			<li{{URI::is('expenditure')?' class="active"':''}}><a href="/expenditure"><i class="icon-shopping-cart"></i> Expenditure</a></li>
			<li{{URI::is('credit')?' class="active"':''}}><a href="/credit"><i class="icon-credit-card"></i> Expenditure (Credit)</a></li>
			<li{{URI::is('income')?' class="active"':''}}><a href="/income"><i class="icon-leaf"></i> Income</a></li>
			<li{{URI::is('expected')?' class="active"':''}}><a href="/expected"><i class="icon-leaf"></i> Expected Income</a></li>
			<li{{URI::is('transactions')?' class="active"':''}}><a href="/transactions"><i class="icon-graph"></i> Transactions</a></li>
			<li{{URI::is('overview')?' class="active"':''}}><a href="/overview"><i class="icon-graph"></i> Account Overview</a></li>
			<li{{URI::is('trash')?' class="active"':''}}><a href="/trash"><i class="icon-trash"></i> Trash</a></li>
			<li{{URI::is('auth/logout')?' class="active"':''}}><a href="/auth/logout"><i class="icon-lock"></i> Logout</a></li>
		</ul>
 		<div class="span9"><div class="row-fluid">{{$content}}</div></div>
		@endif 
	</div>
</div>
</body>
</html>
