<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Maviance - History</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="shared/archive.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
	<h1> Maviance Coding Challenge </h1>
	<?php if (count($histories) == 0): ?>
	<p><b style="color:blue"><?php echo "You have no items in your history"; ?></b></p>
	<?php endif; ?>

	
	<?php if (count($histories) > 0): ?>
	<p><b style="color:blue">You have made the following operations since you signed up for this app</b></p>
		<table rules="all">
			<thead>
				<tr>
					<th>Operation</th>
					<th>Time</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($histories as $history): ?>
				<tr valign="top">

					<td><?php echo $history['operator'];?>(<?php echo $history['currency'];?>, <?php echo $history['amount'];?>) = &euro;<?php echo $history['result'];?></td>
					<td><?php echo $history['time'];?></td>
					<td>
						<form action="" method="post">
							<div>
								<input type="hidden" name="action" value="delete"/>
								<input type="hidden" name="id" value="<?php echo $history['id']; ?>"/>
								<input type="submit" value="Delete"/>
							</div>
						</form>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php endif; ?>
	<p><a href="?">Go back to Home</a></p>
	</body>
</html>