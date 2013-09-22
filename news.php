<?php
function getPictureUrlFor($id, $fb, $width = 50, $height = 50) {
	return $fb->api($id . '/' . "?fields=picture.width($width).height($height)")['picture']['data']['url'];
}

function getUrlFor($id) {
	return "http://facebook.com/$id";
}
?>

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
				// Production:
				'appId' => '572573956113919',
				'secret' => 'bd5e8db924d8401a00cbf3ea06a494a8'

				// Local developement
				// 'appId' => '580380555359498',
				// 'secret' => 'f1e3ad3b7a5e2a7b94a203f13e0fac7c'
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

			// Start output buffering
			ob_start();
			print '<hr>';
			$counter = 0;
			foreach ($feedData as $feed) {
				$counter++;

				print '<div class="fb-post">';
				print '<div class="fb-post-main">';
				print '<div class="fb-post-from">';
				
				// Get the poster's profile picture
				$poster = $feed['from'];
				// $url = $fb->api('/' . $poster['id'] . '?fields=picture.width(50).height(50)')['picture']['data']['url'];
				$url = getPictureUrlFor($poster['id'], $fb);
				print '<img class="fb-post-from-img" src="' . $url . '">';

				// Create a link to the poster's Facebook profile in a new tab
				// <a target="_blank" href="http://facebook.com/${POSTER_ID}">${POSTER_NAME}</a>
				print '<a class="fb-name" target="_blank" href="' . getUrlFor($poster['id']) . '">' . $poster['name'] . '</a>';

				// End fb-post-from
				print '</div>';

				// Replace URL with <a>
				// http://stackoverflow.com/a/6393848/1275092
				$message = preg_replace('#(\A|[^=\]\'"a-zA-Z0-9])(http[s]?://(.+?)/[^()<>\s]+)#i', '\\1<a href="\\2">\\3</a>', $feed['message']);
				print '<p class="fb-post-from-msg">' . $message . '</p>';

				// End fb-post-main
				print '</div>';

				// Get comments/likes of the main post
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
					print '<p class="fb-stats">Nobody really seems to care about this post.<p>';
				} else {
					// We have to grammar properly
					$likeStatus = "$likes like";
					if ($likes == 0) {
						$likeStatus = "No likes";
					} else if ($likes != 1) {
						$likeStatus .= "s";
					}

					$commentStatus = "$comments comment";
					if ($comments == 0) {
						$commentStatus = "no comments";
					} else if ($comments != 1) {
						$commentStatus .= "s";
					}
					
					// <p>5 likes, 10 comments</p>
					printf('<p class="fb-stats">%s, %s</p>', $likeStatus, $commentStatus);
				}

				print '<div class="fb-comment-list">';
				// Print all the comments, if they exist
				if (isset($feed['comments'])) {
					foreach ($feed['comments']['data'] as $comment) {
						// var_dump($comment);
						$from = $comment['from'];
						print('<p class="fb-comment"><a class="fb-name" href="' . getUrlFor($from['id']) . '" target="_blank">' . $from['name'] . '</a>: ' .$comment['message'] . '</p>');
					}
				}
				
				print '</div>';


				// End fb-post
				print '</div><hr>';
			}

			// End output buffering
			ob_end_flush();
			?>
		</div>

		<?php
		include 'common/footer.php';
		?>
	</div>
</body>
</html>