<?php
	// Basic script that builds the entire page from the templates

	// Standard includes
	include("admin/config.php");
	include("$site_root/libs/lib_db.php");
	include("$site_root/libs/lib_templates.php");
	include("$site_root/libs/lib_html.php");
	
	// Log page access in database
	include("$site_root/logging/inc_logger.php");
	
	// Connect to database
	$links_id=db_connect("mtbwales");
			
	// ----------------------------------------------------------------
	// Page code starts below
	// ----------------------------------------------------------------
		
	$html="";
	
	// ----------------------------------------------------------------
	// Page code ends above
	// ----------------------------------------------------------------
	
	// Format any HTML that we created
	if (!empty($html)) $html=pretty_html($html);
		
	// Create local templates for the page
	create_local_template("nav_bar","");
	create_local_template("content_area",$html);
	
	// Define the content of the page and then display it to the browser
	parse_template("<tpl>whole_page</tpl>",$site_id);
?>
