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


	<!-- FAVICONS -->

	<!-- Compiled from https://github.com/audreyr/favicon-cheat-sheet -->
	<link rel="icon" sizes="16x16 32x32 48x48 64x64" href="favicon/favicon.ico">
	<!--[if IE]><link rel="shortcut icon" href="favicon/favicon.ico"><![endif]-->

	<!-- Touch icon for iOS 2.0+ and Android 2.1+: -->
	<link rel="apple-touch-icon-precomposed" href="http://www.yourwebsite.com/favicon-152.png">
	<!-- IE 10 Metro tile icon (Metro equivalent of apple-touch-icon): -->
	<meta name="msapplication-TileColor" content="#FFFFFF">
	<meta name="msapplication-TileImage" content="favicon/favicon-144.png">
	<!-- For iPad with high-resolution Retina display running iOS ≥ 7: -->
	<link rel="apple-touch-icon-precomposed" sizes="152x152" href="favicon/favicon-152.png">
	<!-- For iPad with high-resolution Retina display running iOS ≤ 6: -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="favicon/favicon-144.png">
	<!-- For iPhone with high-resolution Retina display running iOS ≥ 7: -->
	<link rel="apple-touch-icon-precomposed" sizes="120x120" href="favicon/favicon-120.png">
	<!-- For iPhone with high-resolution Retina display running iOS ≤ 6: -->
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="favicon/favicon-114.png">
	<!-- For first- and second-generation iPad: -->
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="favicon/favicon-72.png">
	<!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
	<link rel="apple-touch-icon-precomposed" href="favicon/favicon-57.png">
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