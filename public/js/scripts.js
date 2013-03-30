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

	$("#date, #date_from, #date_to").closest('.input-append').datetimepicker({
		format: 'yyyy-MM-dd HH:mm PP',
		pickSeconds:false,
		pick12HourFormat:true
	});
});