<!DOCTYPE html>
<html>
<head>
	<title>BWHS Robotics | Challenge</title>
	<?php include 'common/meta.php'; ?>
</head>
<body>
	<div id="wrapper">
		<?php
		include 'common/header.php';
		?>

		<div id="content">
			<?php
			$pageName = "challenge";
			include "parsedown_impl.php";
			$pd = new Parsedown_impl();
			
			// Don't dipslay the "Last modified message because there's still some work to do
			$pd->display($pageName, false);
			?>
			
			<!-- The frameBorder attribute REQUIRES a capital "B" for IE 8 support -->
			<iframe width="560" height="315" src="http://www.youtube.com/embed/UPAATO-NpcM?&theme=light&showinfo=0&modestbranding=1&autohide=1&color=white" frameBorder="0" allowfullscreen></iframe>
			
			<?php 
			print '<p>' . $pd->displayLastModified($pageName) . '</p>';
			?>
		</div>

		<?php
		include 'common/footer.php';
		?>
	</div>
</body>
</html>
