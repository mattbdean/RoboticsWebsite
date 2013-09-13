<!DOCTYPE html>
<html>
<head>
	<title>BWHS Robotics | About</title>
	<?php include 'common/meta.php'; ?>
</head>
<body>
	<div id="wrapper">
		<?php
		include 'common/header.php';
		?>

		<div id="content">
			<?php
			include "parsedown_impl.php";
			$pd = new Parsedown_impl();
			$pd->display("about");
			?>
		</div>

		<?php
		include 'common/footer.php';
		?>
	</div>
</body>
</html>