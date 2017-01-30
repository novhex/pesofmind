<?php


$routes = array
	(
	
	'GET|/|Controllers\home@index',
	'GET|/sign-up|Controllers\home@sign_up',
	'GET|/sign-in|Controllers\home@sign_in',
	'POST|/submit-registration|Controllers\home@submit_registration',
	'POST|/auth|Controllers\home@auth',
	'GET|/user|Controllers\user@index',
	'GET|/user/logout|Controllers\user@log_out',
	'GET|/new-expense-category|Controllers\user@new_expense_category',
	'GET|/add-expense|Controllers\user@add_expense',
	'GET|/expense-categories|Controllers\user@expense_categories',
	'POST|/submit-expense-category|Controllers\user@submit_expense_category',
	'POST|/submit-expense|Controllers\user@submit_expense'

	);