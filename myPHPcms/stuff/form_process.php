<?php
	// Entering just plain text and echoing shows that PHP has
	// added slashes automatically.  This also happens with
	// HTML source code - slashes are added but the browser
	// appears to ignore them.
	print "Raw code with slashes in . . . ";
	echo $text_string;
	
	// Actually it doesn't we need to stripslashes() first
	print "Raw code with slashes striped out . . . ";
	echo stripslashes($text_string);
	
	// Creating a variable with slashes in works too !  Although
	// we do NOT need to stripslashes since they do not render in
	// the browser.  If we do stripslashes() it makes no difference
	
	$html="<table width=\"100%\" border=\"1\" cellpadding=\"0\" cellspacing=\"0\"><tr><td>This is a test table with a cell 100% wide</td></tr></table>";
	print "\$html set in PHP with slashes already added";
	echo stripslashes($html);
	
	// Now to try setting a variable containing a text string with
	// quotes in it
	$fred="this is a string with \"quotes\" in it";
	print "The following is a string variable containing quotes<BR>";
	echo $fred;
	print "<BR>";
	
	// This also prints OK and the slashes are not displayed to the
	// browser.  So . . . the problem appears to be in the eval
	// function.
	print "Setting a variable and eval()ing it<BR>";
	// Setting a string to contain a variable and then eval()ing it
	//echo("\$fred1=\"this is a string with \"quotes\" in it\";");
	$bob="\$fred1=\"this is a string with \\\"quotes\\\" in it\";";
	// Confirm that the search string exists
	//$joe=strstr($bob," \"");
	//echo $joe;
	//$bob1=str_replace(" \""," \\\"",$bob);
	//$bob2=str_replace("\" ","\\\" ",$bob1);
	eval($bob);
	echo $fred1;
	
	$fp=fopen('/tmp/bob.txt',"a+");
	fwrite($fp,$bob1);
	fclose($fp);
	
	function my_addslashes($input_string) {
		// Custom version of addslashes() to add a total of 3 slashes to a
		// quote character
		echo $input_string;
		// Get string length
		$str_length=strlen($input_string);
		// Loop through looking for first set of quotes
		$counter=1;
		do {
			
		} while $counter<str_length+1;
	}
	
	
	
	
	
?>