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
			<ul>
				<li><a href="?viewRates">View Latest Rates</a></li>
				<li><a href="?checkHistory">Check History</a></li>
				<li><a href="?changePassword">Change Password</a></li>
				<li><a href="?logout">Log Out</a></li>
			</ul>
		<div>
	</body>
</html>
		
