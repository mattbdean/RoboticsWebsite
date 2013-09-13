<!DOCTYPE html>
<html>
<head>
	<title>BWHS Robotics | Rules and Hierarchy</title>
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
			$pd->display("rankings");
			?>
		</div>

		<?php
		include 'template/footer.php';
		?>
	</div>
</body>
</html>