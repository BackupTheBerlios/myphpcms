<?php

// Small library of useful functions that aren't implemented elsewhere in PHP

function str_chop_head($haystack, $needle) {
	// Function to remove $needle from the front of $haystack
	if (strstr($haystack,$needle)) {
		$start=strlen($needle);
		$length=strlen($haystack)-$start;
		$output_string=substr($haystack,$start,$length);
		return $output_string;
	} else {
		return "";
	}
}

function str_chop_tail($haystack, $needle) {
	// Function to remove $needle from the rear of $haystack
	if (strstr($haystack,$needle)) {
		$start=0;
		$length=strlen($haystack)-strlen($needle);
		$output_string=substr($haystack,$start,$length);
		return $output_string;
	} else {
		return "";
	}
}

?>