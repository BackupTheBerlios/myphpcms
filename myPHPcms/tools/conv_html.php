<?php

// HTML-PHP convertor
//
// Version 0.1 - Last modified 28 September 2001
//
// For more information see CONV_README.TXT and CONV_CHANGELOG.TXT
//
// Library to aid in the conversion of HTML documents to PHP lib_html.php source

// Display form if no html
if (!isset($html) && (!isset($processed))) {
	
// Display initial form

?>

<HTML>
	<HEAD>
		<TITLE>HTML2PHP</TITLE>
	</HEAD>
	<BODY>
		<TABLE width="100%" cellpadding="0" cellspacing="1" border="0">
			<TR>
				<TD>Enter HTML to convert into the box below</TD>
			</TR>
			<TR>
				<TD>
					<FORM method="post" action="conv_html.php">
					<TEXTAREA wrap="hard" name="html" rows="30" cols="60"></TEXTAREA>
				</TD>
			</TR>
			<TR>
				<TD><INPUT TYPE="submit" name="  Process  "></TD>
			</TR>
		</TABLE>
	</BODY>
</HTML>

<?php 

} elseif (isset($html) && (!isset($processed))) {

	// Tidy up our source before we work on it
	$html=stripslashes($html);
	$html=str_replace("\"","'",$html);
	
	// Break it up into an array of lines
	$html_lines=explode("\r\n",$html);
	
	// Create new output array
	$output_array=array();

	foreach ($html_lines as $key=>$value) {
		$output_array[$key]=conv_html($html_lines[$key]);
	}
}

function conv_html($input_string) {
	// Function to convert a line of html to the relevant lib_html code.
	// This is the real meat of the function as it must recognise the tags
	// and replace them with the appropriate lib_html calls whilst preserving
	// all of the tag properties

	// Strip any leading and trailing whitespace and convert to upper case 
	$ucase_string=strtoupper(trim($input_string));
	
	// Check to see if we have a tag
	if (substr($ucase_string,1,1)=="<") {
		// We have a tag.  Now decide what type of tag.  If we don't have
		// white space then it's a simple tag
		if (strpos($ucase_string," ")==0) {
			// We've got a solo tag
			$output_string=solo_tag($ucase_string,$input_string);
			}
		} else {
			// We got either a complex tag or a wrapper tag
			// We've got a solo tag
			$output_string=wrapper_tag(ucase_string,$input_string);
			
			// Or we've got a complex tag
			$output_string=complex_tag(ucase_string,$input_string);
		}
	} else {
		// We have text of some kind.  Trim it and return it
		$output_string=trim($input_string);	
	}
	return $output_string;
	
function solo_tags($ucase_string,$input_string) {
	// Function to deal with solo tags
	
	switch ($ucase_string) {
		case "":
		$output_string=trim($input_string);
		break;
	}
	return $;
}

function wrapper_tag($ucase_string,$input_string) {
	// Function to deal with wrapper tags
}

function complex_tags($ucase_string,$input_string) {
	// Function to deal with complex tags
}

?>