<!DOCTYPE html>
<html>
<head>
	<title>BWHS Robotics | Home</title>
	<link rel="stylesheet" type="text/css" href="styles/global.css">
	<link rel="stylesheet" type="text/css" href="styles/header.css">
	<link rel="stylesheet" type="text/css" href="styles/footer.css">
	<!-- Google Fonts: Open Sans -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<!-- Google Fonts: Aldrich -->
	<link href='http://fonts.googleapis.com/css?family=Aldrich' rel='stylesheet' type='text/css'>
</head>
<body>
	<div id="wrapper">
		<?php
		include 'template/header.php';
		?>

		<div id="content">
			<?php
			include "parsedown_impl.php";
			$pd = new Parsedown_impl();
			$pd->display("rankings");
			?>
		</div>

		<?php
		include 'template/footer.php';
		?>
	</div>
</body>
</html>