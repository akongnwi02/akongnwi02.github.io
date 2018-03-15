<?php 
	function fetch_new_rates()
	{
		//XML File has been downloaded for faster loading
		$xml_url = "eurofxref-daily.xml";
		$response_xml_data = file_get_contents($xml_url);
		if ($response_xml_data===false)
		{
			$error = 'Error getting ecb xml file content';
			include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
			exit();
		}

		libxml_use_internal_errors(true);
		$data = simplexml_load_string($response_xml_data);
		if (!$data)
		{
			$error = 'No data found on file';
			exit();
		}
		foreach($data->Cube->Cube->Cube as $currency)
		{
			$name = strval ($currency['currency']);
			$rate = floatval($currency['rate']);
			include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
			$sql = "UPDATE currency SET rate = "."$rate"." WHERE name = "."'$name'"; 
			if(!mysqli_query($link, $sql))
			{
				$error = "Unable to set currency rate";
				include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
				exit();
			}
		}
	}
	function valid_currency($currency)
	{
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
		$currency = strtoupper($currency);
		$sql = "SELECT name FROM currency WHERE name = '$currency'";
		if(!$result = mysqli_query($link, $sql))
		{
			$error = "Error verifying currency in database";
			include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
			exit();
		}
		if(mysqli_num_rows($result))
		{
			return TRUE;
		}
		else
		{
			$GLOBALS['convertError'] = "Enter currency supported by the ECB exchange rate service";
			return FALSE;
		}
	}
	function valid_operator($operator)
	{
		if(strtolower($operator) == 'con' or strtolower($operator) == 'convert' 
		or strtolower($operator) == 'rev' or strtolower($operator) == 'reverse')
		{
			return TRUE;
		}
		else
		{
			echo 'operator is invalid';
			$GLOBALS['convertError'] = "Enter valid operator Convert or Reverse";
			return FALSE;
		}
	}
	function convert_currency($operator, $currency, $amount)
	{
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
		$sql = "SELECT rate FROM currency WHERE name = '$currency' limit 1";
		if(!($result = mysqli_query($link, $sql)))
		{
			$error = "Error getting currency rate";
			include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
			exit();
		}
		$row = mysqli_fetch_object($result);
		$rate = $row->rate;
		if(strtolower($operator)=='con' or strtolower($operator) == 'convert')
		{
			$result = floatval($amount) / $rate;
			$currency = strtoupper($currency);
			$output = array("operator" => "CONVERT", "currency" =>"$currency", "amount" => "$amount", "result" => "$result");
			return $output;
		}
		if(strtolower($operator)=='rev' or strtolower($operator) == 'reverse')
		{
			$result = floatval($amount) * $rate;
			$currency = strtoupper($currency);
			$output = array("operator" => "REVERSE", "currency" =>"$currency", "amount" => "$amount", "result" => "$result");
			return $output;
		}
	}
	function save_history ($output)
	{
		$userid = get_session_userid($_SESSION['email']);
		$currencyid = get_currencyid($output['currency']);
		$operator = $output['operator'];
		$result = $output['result'];
		$amount = $output['amount'];

		include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
		$sql = "INSERT INTO history SET user_id = '$userid', currency_id = '$currencyid', operator = '$operator', result = '$result', amount = '$amount', create_time = NOW()";
		if(!mysqli_query($link,$sql))
		{
			$error = "Error saving history";
			include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
			echo mysqli_error($link);
			exit();
		}

	}
	function get_session_userid($email)
	{
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
		$sql = "SELECT id FROM users WHERE email = '$email'";
		if(!($result = mysqli_query($link, $sql)))
		{
			$error = "Error getting session user id";
			include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
			exit();
		}
		$row = mysqli_fetch_object($result);
		return $id = $row->id;
	}
	function get_currencyid ($currency)
	{
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
		$sql = "SELECT id FROM currency WHERE name = '$currency'";
		if(!($result = mysqli_query($link, $sql)))
		{
			$error = "Error getting currency id";
			include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
			exit();
		}
		$row = mysqli_fetch_object($result);
		return $id = $row->id;
	}
	function fetch_history($email)
	{
		$userid = get_session_userid($email);
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
		$sql = "SELECT history.id, operator, currency.name, amount, create_time, result FROM history INNER JOIN users ON users.id = history.user_id INNER JOIN currency ON currency.id = currency_id WHERE users.id = '$userid'";
		$result = mysqli_query($link, $sql);
		if(!$result)
		{
			$error = "Error getting history";
			include $_SERVER['DOCUMENT_ROOT'] . '/includese/error.html.php';
			echo mysqli_error($link);
			exit();
		}

		$histories = array();
		while($row = mysqli_fetch_array($result))
		{
			$histories[] = array(
						'id' => $row['id'],
						'operator'=> $row['operator'],
						'time'=>$row['create_time'],
						'currency'=>$row['name'],
						'amount'=>$row['amount'],
						'result'=>$row['result']);
		}
		return $histories;
	}
	function delete_row($id)
	{
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
		$id = mysqli_real_escape_string($link, $id);
		$sql = "DELETE FROM history WHERE id = '$id'";
		if (!mysqli_query($link, $sql))
		{
			$error = 'Error deleting joke: ' . mysqli_error($link);
			include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
			exit();
		}
		return;
	}
	function get_rates()
	{
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
		$sql = "SELECT name, rate FROM currency WHERE 1";
		$result = mysqli_query($link, $sql);
		if(!$result)
		{
			$error = "Error getting session rates";
			include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
			echo mysqli_error($link);
			exit();
		}

		$rates = array();
		while($row = mysqli_fetch_array($result))
		{
			$rates[] = array(
					'name' => $row['name'],
					'rate'=> $row['rate']);
		}
		return $rates;
	}
	function update_password($email, $password)
	{
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
		$password = md5(mysqli_real_escape_string($link,$password));
		$email = mysqli_real_escape_string($link, $email);
		$sql = "UPDATE users SET password = " ."'$password'". "WHERE email = " . "'$email'";
		if(!mysqli_query($link, $sql))
			{
				$error = "Unable to change password";
				include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
				exit();
			}
	
	}
?>