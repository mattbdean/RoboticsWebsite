<!--The only purpose of header-wrapper and navbar-wrapper is to extend the color to the edge of the page -->
<div id="header-wrapper">
	<div id="header">
		<a href="/">
			<img id="icon" src="res/falcon.png" width="200px">
		</a>

		<!-- Contains the static 'Briar Woods' heading and the random MOTD -->
		<div id="title-wrapper">
			<p id="title-main">Briar Woods Robotics</p>
			<p id="random-splash">
				<?php
				// Because I have to.
				$f_contents = file("motds.txt");
				echo $f_contents[rand(0, count($f_contents) - 1)];
				?>
			</p>
		</div>
	</div>
	<div id="navbar-wrapper">
		<div id="navbar">
			<?php
			// Print the navigation bar dynamically so that we are able
			// to add more places if necessary in the future easily

			// Defines the names and locations of the navbar elements
			$navs = array(
				"Home" => "/",
				"Rules and Rankings" => "rankings.php",
				"Robots" => "robots.php",
				"About" => "about.php"
			);

			// Loop through $navs and print an <a> tag
			foreach ($navs as $name => $location) {
				echo sprintf('<a href="%s" class="navbar-element">%s</a>', $location, $name);
			}
			?>
		</div>
	</div>
</div>
