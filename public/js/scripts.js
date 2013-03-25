$(function(){
	/*
	User Login
	*/
	$("#username").tooltip({
		'trigger':'focus',
		'placement': 'top',
		'title': 'Enter your user name'
	});
	$("#password").tooltip({
		'trigger':'focus',
		'placement': 'top',
		'title': 'Enter your password'
	});


	/*
	Income
	*/
	$("#particulars, #source, #amount, #date, #notes, #filter_from, #filter_to").tooltip({
		'placement': 'top',
		'trigger': 'focus'
	});

	$("#date, #date_from, #date_to").datepicker({
		format: 'yyyy-mm-dd'
	}).on('changeDate', function(ev)
	{
        $('#date').datepicker('hide');
        $('#date_from').datepicker('hide');
        $('#date_to').datepicker('hide');
    });
});