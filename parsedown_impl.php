<?php
include "parsedown/Parsedown.php";

/**
 * This class represents implementation of the Parsedown API
 * on this website
 */
class Parsedown_impl {
	
	private $parsedown;

	function __construct() {
		$this->parsedown = Parsedown::instance();
	}

	/**
	 * This funtion parses a file with a given basename in the "site/"
	 * directory. No ".md" is needed.
	 */
	function display($file) {
		$fullFile = "site/$file.md";

		// If the file exists, is readable, and is not empty,
		if (is_readable($fullFile) && filesize($fullFile) != 0) {
			// Parse the file
			echo $this->parsedown->parse(file_get_contents($fullFile));
		}
	}
}
?>