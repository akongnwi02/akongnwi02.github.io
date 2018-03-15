<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Maviance - Log In</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="shared/archive.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<h1> Maviance Coding Challenge </h1>
		<p>
			<label for="message">Log in to currency converter or <a href="?signupform">Sign Up</a></label>
		</P>
		<div>
			<?php if(isset($loginError)): ?>
				<p style="color:red"><?php echo $loginError; ?></p>
			<?php endif; ?>
			<form action="" method="post">
			
				<div>
					<label for="email">Email: <input type="email" name="email" required /></label>
				</div>
				<div>
					<label for="password">Password: <input type="password" name="password" required /></label>
				</div>
				<div>
					<input type="hidden" name="action" value="loggingIn" />
					<input type="submit" value="Log In" />
				</div>
			</form>
		</div>
	</body>
</html>