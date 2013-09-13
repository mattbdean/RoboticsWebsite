<!DOCTYPE html>
<html>
<head>
	<title>BWHS Robotics | Rules and Hierarchy</title>
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
			$pd->display("rankings");
			?>
		</div>

		<?php
		include 'common/footer.php';
		?>
	</div>
</body>
</html>