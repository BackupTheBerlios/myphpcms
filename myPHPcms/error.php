<?php
	// Script that announces to user that we have a problem with 
	// database.  It then emails the site administrator

	// Standard includes
	include("admin/config.php");
			
	// ----------------------------------------------------------------
	// Page code starts below
	// ----------------------------------------------------------------
		
	$html="<H1>Whoops !</H1><BR>";
	$html.="There has been an error accessing the site database<BR>";
	$html.="The site administrator a been notified via email<BR>";
	$html.="Sorry for the inconvenience - please try again later<BR>";
	
	// ----------------------------------------------------------------
	// Page code ends above
	// ----------------------------------------------------------------
	
	// Email the site administrator
	$subject="ERROR on " . $site_name;
	$address=$site_admin;
	$body="There has been an error connecting to the database";
	mail($address,$subject,$body);
	
	// Format any HTML that we created
	if (!empty($html)) $html=pretty_html($html);
		
	// Create local templates for the page
	create_local_template("nav_bar","");
	create_local_template("content_area",$html);
	
	// Define the content of the page and then display it to the browser
	parse_template("<tpl>whole_page</tpl>",$site_id);
?>
