<!DOCTYPE html>
<html>
<head>
	<title>BWHS Robotics | About</title>
	<?php include 'template/meta.php'; ?>
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
			$pd->display("about");
			?>
		</div>

		<?php
		include 'template/footer.php';
		?>
	</div>
</body>
</html>