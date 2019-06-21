<?php include_once(__DIR__ . '/../header.php'); ?>
	<p>
		<strong>Absender: </strong><?php echo htmlentities($name); ?>
	</p>
	<p>
		<strong>Absender E-Mail: </strong><?php echo htmlentities($email); ?>
	</p>
	<br/>
	<p><?php echo htmlentities($message); ?></p>
<?php include_once(__DIR__ . '/../footer.php'); ?>
