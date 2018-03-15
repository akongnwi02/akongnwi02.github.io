<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Maviance - Sign Up</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="shared/archive.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
	<h1> Maviance Coding Challenge </h1>
		<p>
			<label for="message">Sign up to currency converter or <a href="?loginform">Log In</a></label>
		</P>
		<div>
		<?php if(isset($signupError)): ?>
			<p style="color:red"><?php echo $signupError; ?></p>
		<?php endif; ?>
			<form action="" method="post">
				<div>
					<label for="email">Email: <input type="email" name="email" required /></label>
				</div>
				<div>
					<label for="password1">Password: <input type="password" name="password1" required /></label>
				</div>
				<div>
					<label for="password2">Confirm Password: <input type="password" name="password2" required /></label>
				</div>
				<div>
					<input type="hidden" name="action" value="signingUp" />
					<input type="submit" value="Sign Up"/>
				</div>
			</form>
		</div>
	</body>
</html>