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
	function display($file, $lastModified = true) {
		// Prevent this function from potentially parsing a file called "site/.md"
		if (!isset($file) || $file == "") {
			return;
		}

		$fullFile = "site/$file.md";

		// If the file exists, is readable, and is not empty,
		if (is_readable($fullFile) && filesize($fullFile) != 0) {
			// Buffer the output
			ob_start();
			// Parse and print the file
			print $this->parsedown->parse(file_get_contents($fullFile));

			if ($lastModified) {
				$this->displayLastModified($file);
			}
			
			// Close the buffer
			ob_end_flush();
		}
	}
	
	function displayLastModified($file) {
		// Prevent this function from potentially parsing a file called "site/.md"
		if (!isset($file) || $file == "") {
			return;
		}
		
		$fullFile = "site/$file.md";
		
		print '<hr><p>Last modified ' . date('l jS, Y', filemtime($fullFile)) . '</p>';
	}

	function displaySingle($mdStr) {
		print $this->parsedown->parse($mdStr);
	}
}
?>