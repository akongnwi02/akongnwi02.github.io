<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Maviance - Home</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="shared/archive.css" rel="stylesheet" type="text/css" />
	</head>
	
	</body>
		<h1> Maviance Coding Challenge </h1>
		<?php if(isset($_SESSION['email'])): ?>
			<p>Logged in as <i> <?php echo htmlspecialchars($_SESSION['email']); ?></i></p>
		<?php endif; ?>

		<div>
		<?php if(isset($passwordError)): ?>
			<p style="color:red"><?php echo $passwordError; ?></p>
		<?php endif; ?>
			<form action="" method="post">
				<div>
					<label for="currentPassword">Current Password: <input type="password" name="currentPassword" required /></label>
				</div>
				<div>
					<label for="password">New Password: <input type="password" name="password" required /></label>
				</div>
				<div>
					<label for="confirmPassword">Confirm Password: <input type="password" name="confirmPassword" required /></label>
				</div>
				<div>
					<input type="hidden" name="action" value="editPassword" />
					<input type="submit" value="Change Password"/>
				</div>
			</form>
		</div>
		<p><a href="?">Go back to Home</a></p>
	</body>
</html>
		
