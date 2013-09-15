<!DOCTYPE html>
<html>
<head>
	<title>BWHS Robotics | News</title>
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
			// Display the news "header" without drawing the <hr>
			$pd->display("news", false);

			// Facebook feed
			require_once "facebook-php-sdk/src/facebook.php";
			// http://stackoverflow.com/a/7193086/1275092

			// Create the Facebook object
			$fb = new Facebook(array(
				'appId' => '572573956113919',
				'secret' => 'bd5e8db924d8401a00cbf3ea06a494a8'
				));
			$fbUser = $fb->getUser();

			// Permissions
			$location = "" . $fb->getLoginUrl(array('scope' => 'user_groups'));

			// If the user is not logged in
			if ($fbUser) {
				try {
					$fbProfile = $fb->api('/me');
				} catch (FacebookApiException $e) {
					$fbUser = null;
					// Not enough perms, use JavaScript to redirect user instead of header() because of FB bug
					print '<script language="javascript" type="text/javascript"> top.location.href="'. $location .'"; </script>';

					// Kill the code so nothing will happen until the user gives us perms
					die();
				}
			} else {
				// User hasn't logged in; redirect to FB login page
				print '<script language="javascript" type="text/javascript"> top.location.href="'. $location .'"; </script>';

				// Kill the code so nothing will happen until the user gives us perms
				die();
			}

			// Store group id as a string instead of number in case of overflow
			$gid = '148185218647822';
			$info = $fb->api('/' . $gid . '?fields=name,description,feed.limit(5).fields(message,name,from,picture)');

			?>
		</div>

		<?php
		include 'common/footer.php';
		?>
	</div>
</body>
</html>