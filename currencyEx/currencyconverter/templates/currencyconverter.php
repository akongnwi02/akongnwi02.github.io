<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Maviance - Currency Converter</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="shared/archive.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<p><h2>This is a simple <i>Currency Converter App</i></h2></p>
		<div>
		<?php if(isset($convertError)): ?>
			<p style="color:red"><?php echo $convertError; ?></p>
		<?php endif; ?>
			<form action="?convert" method="post">
				<div> <label for="message"> Enter Command </label></div>
				<div> <input type="text" id="operator" name="operator" placeholder="Operator" required /> ( 
					  <input type="text" id="currency" name="currency" placeholder="Currency" required />,
					  <input type="number" step="any" min="0" id="amount" name="amount" placeholder="Amount" required /> )
				</div>
				<div>
					<input type="submit" value="GO"/>
					<?php if (isset($output)): ?>
						<p><h3 style="color:blue"><?php echo $output['operator'];?>(<?php echo $output['currency'];?>, <?php echo $output['amount'];?>) = &euro;<?php echo $output['result'];?>
					
					
					<?php endif; ?>
				</div>
			</form>
		</div>
	</body>
</html>