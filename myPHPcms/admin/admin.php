<?php


	// Script to build list of available administration modules

	// Search in this directory for PHP files starting adm_.  Strip the
	// adm_ off the front and capitalise the name to give the name of the
	// admin module.  Put these in a table with a hyperlink to call the
	// script.

	// Additional work might be needed to prevent users from running this
	// script either through the use of .htaccess files or passwords etc.

	// Standard includes
	include("config.php");
	include("$site_root/libs/lib_db.php");
	include("$site_root/libs/lib_templates.php");
	include("$site_root/libs/lib_html.php");
	
	// Log page access in database
	//include("$site_root/logging/inc_logger.php");
	include("$site_root/libs/lib_utils.php");
			
	// ----------------------------------------------------------------
	// Page code starts below
	// ----------------------------------------------------------------
	
	// Create file path
	$admin_dir="$site_root/admin";
	$modules=array();
	$count=0;
	// Get list of files in the directory matching
	if (!($dp=opendir($admin_dir))) die ("Cannot open $admin_dir");
	while ($files=readdir($dp))
		//if ($files !='.' && $files !='..') echo "$files<br>";
		// Only get files starting with adm_
		if (strstr($files,'adm_')) {
			$modules[$count][0]=$files;
			// Now to remove the adm_ from the name, remove the
			// ending and capitalise the first character.
			$modules[$count][0]=str_chop_head($files, 'adm_');
			$modules[$count][0]=str_chop_tail($modules[$count][0], '.php');
			$modules[$count][0]=ucfirst($modules[$count][0]);
			// Store URL for this
			$modules[$count][1]=$files;
			$count++;
		}
	closedir($dp);
	
	// Now to create a table to contain the links to the modules that we've
	// found
	
	$html="";
	
	// ----------------------------------------------------------------
	// Page code ends above
	// ----------------------------------------------------------------
	
	// Format any HTML that we created
	if (!empty($html)) $html=pretty_html($html);
		
	// Create local templates for the page
	create_local_template("nav_bar","<a href='top_bugs.php'>Top bugs</a><br><a href='cumulative.php'>Cumulative bug count</a><br><a href='bugzilla.php'>Home</a><br>");
	create_local_template("content_area",$html);
	
	// Define the content of the page and then display it to the browser
	parse_template("<tpl>whole_page</tpl>",$site_id);
?>
