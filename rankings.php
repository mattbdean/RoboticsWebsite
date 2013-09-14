<!DOCTYPE html>
<html>
<head>
	<title>BWHS Robotics | Rules and Hierarchy</title>
	<link rel="stylesheet" href="styles/spoiler.css">
	<script src="js/jquery-1.10.2.min.js"></script>
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

			<script>

			$(function() {
				var hideText = "Hide changelog";
				var showText = "Show changelog";
				var $button = $('.spoiler-button');

				$button.click(function() {
					console.log('click');

					$(".spoiler-content").toggle('slow');

					// Toggle the text
					var newText = $(this).text() === showText ? hideText : showText;
					$(this).text(newText);
				});
			});

			</script>
			<div class="spoiler-container">
				<button class="spoiler-button">Show changelog</button>
				<div class="spoiler-content">
					<?php
					$pd->display("rankings_changes", false);
					?>
				</div>
			</div>
		</div>

		<?php
		include 'common/footer.php';
		?>
	</div>
</body>
</html>