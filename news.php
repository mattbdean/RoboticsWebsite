<!DOCTYPE html>
<html>
<head>
	<title>BWHS Robotics | News</title>
	<link rel="stylesheet" href="styles/facebook.css">
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
			$info = $fb->api('/' . $gid . '?fields=feed.limit(5).fields(message,from,likes,comments.fields(message,like_count,from))');

			$feedData = $info['feed']['data'];
			// echo '<pre>'; var_dump($feedData); echo '</pre>';

			print '<hr>';
			foreach ($feedData as $feed) {
				print '<div class="fb-post">';
				print '<div class="fb-post-main">';
				print '<div class="fb-post-from">';
				
				// Get the poster's profile picture
				$poster = $feed['from'];
				$url = $fb->api('/' . $poster['id'] . '?fields=picture.width(50).height(50)')['picture']['data']['url'];
				print '<img class="fb-post-from-img" src="' . $url . '">';

				// Create a link to the poster's Facebook profile in a new tab
				// <a target="_blank" href="http://facebook.com/${POSTER_ID}">${POSTER_NAME}</a>
				print '<a class="fb-post-from-name" target="_blank" href="http://facebook.com/' . $poster['id'] . '">' . $poster['name'] . '</a>';

				// End fb-post-from
				print '</div>';

				// Replace URL with <a>
				// http://stackoverflow.com/a/6393848/1275092
				$message = preg_replace('#(\A|[^=\]\'"a-zA-Z0-9])(http[s]?://(.+?)/[^()<>\s]+)#i', '\\1<a href="\\2">\\3</a>', $feed['message']);
				print '<p class="fb-post-from-msg">' . $message . '</p>';

				// End fb-post-main
				print '</div>';

				// Get comments/likes of the main post
				print '<div class="fb-stats">';
				$likes = 0;
				$comments = 0;
				if (isset($feed['likes'])) {
					$likes = count($feed['likes']);
				}
				if (isset($feed['comments'])) {
					$comments = count($feed['comments']['data']);
				}

				// No likes or comments
				if (!$likes && !$comments) {
					print '<p class="fb-no-activity">Nobody really seem to care about this post.<p>';
				} else {
					// <p>5 (fb like icon), 10 (fb comment icon)</p>
					printf('<p>%s %s, %s comments</p>', $likes == 0 ? "No" : $likes, $likes != 0 ? '<img src="res/fb_like.png" class="fb-icon" alt=" likes">' : "likes", $comments);
				}
				
				print '</div>';


				// End fb-post
				print '</div><hr>';
			}
			?>
		</div>

		<?php
		include 'common/footer.php';
		?>
	</div>
</body>
</html>