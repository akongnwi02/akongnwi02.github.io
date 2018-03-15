<?php session_start();
	//function which returns true if user is already logged in
	function isLoggedIn ()
	{	
		
		if(isset($_POST['action']) and $_POST['action'] == "loggingIn")
		{
			$password = md5($_POST['password']);
			$email = $_POST['email'];
			if(user_found($email, $password)) 
			{
				start_session($email, $password);
				return TRUE;
			}
			else
			{
				end_session();
				$GLOBALS['loginError'] = "Incorrect username or password";
				return FALSE;
			}
		}
		if(isset($_POST['action']) and $_POST['action'] == "signingUp")
		{
			$password1 = md5($_POST['password1']);
			$password2 = md5($_POST['password2']);
			$email = $_POST['email'];
			if($password1 != $password2)
			{

				$GLOBALS['signupError'] = "Passwords do not match";
				return FALSE;
			}
			if(email_used($email))
			{
				$GLOBALS['signupError'] = 'Email has already been used';
				return FALSE;
			}
				create_user($email, $password1);
				if(user_found($email, $password1))
				{
					start_session($email, $password1);
					return TRUE;
				}
				else
				{
					return FALSE;
				}
		}	
		
		if(isset($_GET['logout']))
		{
			end_session();
			return FALSE;
		}
		if(isset($_SESSION['loggedIn']))
		{

			return(user_found($_SESSION['email'], $_SESSION['password']));
		}
	}
	
	function user_found ($email, $password)
	{
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
		$email = mysqli_real_escape_string($link, $email);
		$password = mysqli_real_escape_string($link, $password);
		$sql = "SELECT id FROM users WHERE email = '$email' AND password = '$password'";
		$result = mysqli_query($link, $sql);
		if(!$result)
		{
			$error = 'Error searching for user';
			include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
			exit();
		}
		if(mysqli_num_rows($result))
		{
			return TRUE;
		}
		else 
		{
			return FALSE;
		}
	}
	function start_session ($email, $password)
	{
		//session_start();
		$_SESSION['loggedIn'] = TRUE;
		$_SESSION['email'] = $email;
		$_SESSION['password'] = $password;
		return;
	}
	function end_session()
	{   
		//session_start();
		unset($_SESSION['loggedIn']);
		unset($_SESSION['email']);
		unset($_SESSION['password']);
		return;
	}
	function create_user($email, $password)
	{
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
		$email = mysqli_real_escape_string($link, $email);
		$password = mysqli_real_escape_string($link, $password);
		$sql = "INSERT INTO users SET email = '$email', password = '$password'";
		if(!mysqli_query($link, $sql))
		{
			$error = 'Error creating user';
			include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
			exit();
		}
	}
	function email_used($email)
	{
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
		$email = mysqli_real_escape_string($link, $email);
		$sql = "SELECT id FROM users WHERE email = '$email'";
		if(!($result=mysqli_query($link, $sql)))
		{
			$error = "Error checking if email exists";
			include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
			echo mysqli_error($result);
			exit();
		}

		if(mysqli_num_rows($result))
		{
			return TRUE;
		}
		else 
		{
			return FALSE;

		}
	}
?>