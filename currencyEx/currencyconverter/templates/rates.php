<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Maviance - Current Rates</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="shared/archive.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
	<h1> Maviance Coding Challenge </h1>
	
	<p><b style="color:blue">Here are the current rates from the ECB exchange service</b></p>
		<table rules = "all">
			<thead>
				<tr>
					<th>Currency</th>
					<th>Rate</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($currencies as $currency): ?>
				<tr valign="top">

					<td><?php echo $currency['name'];?></td>
					<td><?php echo $currency['rate'];?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<p><a href="?">Go back to Home</a></p>
	</body>
</html>