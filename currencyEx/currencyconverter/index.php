<?php
	require_once 'access.php';
	include 'functions.php';
	if(!isLoggedIn() and !isset($_GET['signupform']))
	{
		include $_SERVER['DOCUMENT_ROOT'] . '/templates/loginform.php';
		exit();
	}
	if(isset($_GET['signupform']) and !isset($_SESSION['loggedIn'])) 
	{
		include $_SERVER['DOCUMENT_ROOT'] . '/templates/signupform.php';
		exit();
	}

	if(isset($_GET['convert']))
	{
		if(isset($_POST['action']) and $_POST['action'] == "convertData")
		{
			$operator = $_POST['operator'];
			$amount = $_POST['amount'];
			$currency = $_POST['currency'];
		
			if(valid_operator($operator) and valid_currency($currency))
			{
				$output = convert_currency($operator, $currency, $amount);
				save_history($output);
			}
		}
	}
	if(isset($_GET['checkHistory']) or (isset($_POST['action']) and ($_POST['action'] == 'delete')))
	{
		if(isset($_POST['action']) and ($_POST['action'] == 'delete'))
		{
			$historyid = $_POST['id'];
			delete_row($historyid);
		}
		$histories = fetch_history($_SESSION['email']);
		include $_SERVER['DOCUMENT_ROOT'] . '/templates/history.php';
		exit();
	}
	if(isset($_GET['viewRates']))
	{
		//fetch rates and save in local database
		fetch_new_rates();
		//get rates from database local database
		$currencies = get_rates();
		include $_SERVER['DOCUMENT_ROOT'] . '/templates/rates.php';
		exit();
	}
	if(isset($_GET['changePassword']))
	{
		if(isset($_POST['action']) and  $_POST['action'] == "editPassword")
		{
			$currentPassword = $_POST['currentPassword'];
			if(user_found($_SESSION['email'], md5($currentPassword)) and ($_POST['password'] === $_POST['confirmPassword']))
			{
				update_password($_SESSION['email'], $_POST['password']);
				$GLOBALS['passwordError'] = "Password successfully changed!";
			}
			else
			{
				$GLOBALS['passwordError'] = "Password error. Please try again";
			}
		}
		include $_SERVER['DOCUMENT_ROOT'] . '/templates/edit.php';
		exit();
	}
	//fetch currency rates and store in database
	include $_SERVER['DOCUMENT_ROOT'] . '/templates/home.php';
	include $_SERVER['DOCUMENT_ROOT'] . '/templates/currencyconverter.php';
	fetch_new_rates();
	
?>	