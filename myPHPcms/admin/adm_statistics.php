<?php
	// Basic script that builds the entire page from the templates

	// Standard includes
	include("config.php");
	include("$site_root/libs/lib_db.php");
	include("$site_root/libs/lib_templates.php");
	include("$site_root/libs/lib_html.php");
	
	// Log page access in database
	include("$site_root/logging/inc_logger.php");
			
	// ----------------------------------------------------------------
	// Page code starts below
	// ----------------------------------------------------------------
	
	// Call statistics library
	include("$site_root/admin/libs/lib_statistics.php");
	
	// Set side ID to use a site with some big statistics !
	$site_id=2;
	$timescale="thisyear";
	$max_num=20;
	
	// Get total_page_views
	print "<H2>Total page views</H2>";
	$fred=total_page_views($link_id, $site_id);
	echo "$fred[0] total page requests since $fred[1]<BR><BR>";
	
	// Get browser types
	print "<H2>Browser types</H2>";
	$fred=browser_types($link_id, $site_id, $timescale);
	print "<table width=100% cellspacing='0' cellpadding='0' border='1'>";
	print "<tr>";
	print "<td width='25%'>Browser</td><td width='25%'>Version</td><td width='25%'>Platform</td><td width='25%'>Share (%)</td>";
	print "</tr>";
	foreach ($fred as $key=>$value) {
		print "<tr><td>";
		echo $fred[$key][0];
		print "</td>";
		print "<td>";
		echo $fred[$key][1];
		print "</td><td>";
		echo $fred[$key][2];
		print "</td><td>";
		echo $fred[$key][3];
		print "</td></tr>";
	}
	print "</tr>";
	print "</table>";
	
	//print "<H2>Unidentied Browser types</H2>";
	//$fred=browser_unknown($link_id, $site_id, $timescale);
	//print "<table width=100% cellspacing='0' cellpadding='0' border='1'>";
	//print "<tr>";
	//print "<td>Browser</td>";
	//print "</tr>";
	//foreach ($fred as $key=>$value) {
	//	print "<tr><td>";
	//	echo $fred[$key][0];
	//	print "</td>";
	//	print "<td>";
	//}
	//print "</tr>";
	//print "</table>";
	
	// List requests by hour
	print "<H2>Hourly requests</H2>";
	$fred=hourly_requests($link_id, $site_id, $timescale);
	print "<table width=100% cellspacing='0' cellpadding='0' border='1'>";
	print "<tr>";
	print "<td width='33%'>Hour (GMT)</td><td width='33%'>Total hits</td><td width='33%'>Percent</td>";
	print "</tr>";
	foreach ($fred as $key=>$value) {
		print "<tr><td>";
		echo $fred[$key][0];
		print "</td>";
		print "<td>";
		echo $fred[$key][1];
		print "</td>";
		print "<td>";
		echo $fred[$key][2];
		print "</td></tr>";		
	}
	print "</tr>";
	print "</table>";
	
	// List top pages
	print "<H2>Top pages</H2>";
	$fred=top_pages($link_id, $site_id, $timescale, $max_num);
	print "<table width=100% cellspacing='0' cellpadding='0' border='1'>";
	print "<tr>";
	print "<td width='33%'>Rank</td><td width='33%'>Page</td><td width='33%'>Requests</td>";
	print "</tr>";
	foreach ($fred as $key=>$value) {
		print "<tr><td>";
		echo $fred[$key][0];
		print "</td>";
		print "<td>";
		echo $fred[$key][1];
		print "</td>";
		print "<td>";
		echo $fred[$key][2];
		print "</td></tr>";		
	}
	print "</tr>";
	print "</table>";
	
	// List bottom pages
	print "<H2>Bottom pages</H2>";
	$fred=bottom_pages($link_id, $site_id, $timescale, $max_num);
	print "<table width=100% cellspacing='0' cellpadding='0' border='1'>";
	print "<tr>";
	print "<td width='33%'>Rank</td><td width='33%'>Page</td><td width='33%'>Requests</td>";
	print "</tr>";
	foreach ($fred as $key=>$value) {
		print "<tr><td>";
		echo $fred[$key][0];
		print "</td>";
		print "<td>";
		echo $fred[$key][1];
		print "</td>";
		print "<td>";
		echo $fred[$key][2];
		print "</td></tr>";		
	}
	print "</tr>";
	print "</table>";
	
	// List top referrers
	print "<H2>Top referrers</H2>";
	$fred=top_referrers($link_id, $site_id, $timescale, $max_num);
	print "<table width=100% cellspacing='0' cellpadding='0' border='1'>";
	print "<tr>";
	print "<td width='33%'>Rank</td><td width='33%'>Referrer</td><td width='33%'>Requests</td>";
	print "</tr>";
	foreach ($fred as $key=>$value) {
		print "<tr><td>";
		echo $fred[$key][0];
		print "</td>";
		print "<td>";
		echo $fred[$key][1];
		print "</td>";
		print "<td>";
		echo $fred[$key][2];
		print "</td></tr>";		
	}
	print "</tr>";
	print "</table>";
	
	// List top referrers sites
	print "<H2>Top referrering hosts</H2>";
	$fred=top_hosts($link_id, $site_id, $timescale, $max_num);
	print "<table width=100% cellspacing='0' cellpadding='0' border='1'>";
	print "<tr>";
	print "<td width='33%'>Rank</td><td width='33%'>Referrer</td><td width='33%'>Requests</td>";
	print "</tr>";
	foreach ($fred as $key=>$value) {
		print "<tr><td>";
		echo $fred[$key][0];
		print "</td>";
		print "<td>";
		echo $fred[$key][1];
		print "</td>";
		print "<td>";
		echo $fred[$key][2];
		print "</td></tr>";		
	}
	print "</tr>";
	print "</table>";
	
	// List top search strings
	print "<H2>Top search strings</H2>";
	$fred=searches($link_id, $site_id, $timescale, $max_num);
	print "<table width=100% cellspacing='0' cellpadding='0' border='1'>";
	print "<tr>";
	print "<td width='33%'>Rank</td><td width='33%'>Referrer</td><td width='33%'>Requests</td>";
	print "</tr>";
	foreach ($fred as $key=>$value) {
		print "<tr><td>";
		echo $fred[$key][0];
		print "</td>";
		print "<td>";
		echo $fred[$key][1];
		print "</td>";
		print "<td>";
		echo $fred[$key][2];
		print "</td></tr>";		
	}
	print "</tr>";
	print "</table>";
	
	// List top platforms
	print "<H2>Top platforms</H2>";
	$fred=operating_sys($link_id, $site_id, $timescale, $max_num);
	print "<table width=100% cellspacing='0' cellpadding='0' border='1'>";
	print "<tr>";
	print "<td width='33%'>Rank</td><td width='33%'>Platform</td><td width='33%'>Percentage</td>";
	print "</tr>";
	foreach ($fred as $key=>$value) {
		print "<tr><td>";
		echo $fred[$key][0];
		print "</td>";
		print "<td>";
		echo $fred[$key][1];
		print "</td>";
		print "<td>";
		echo $fred[$key][2];
		print "</td></tr>";		
	}
	print "</tr>";
	print "</table>";
	
	// List top exit pages
	print "<H2>Top Exit pages</H2>";
	$fred=top_exit($link_id, $site_id,$timescale, $max_num);
	print "<table width=100% cellspacing='0' cellpadding='0' border='1'>";
	print "<tr>";
	print "<td width='33%'>Rank</td><td width='33%'>Destination URL</td><td width='33%'>Requests</td>";
	print "</tr>";
	foreach ($fred as $key=>$value) {
		print "<tr><td>";
		echo $fred[$key][0];
		print "</td>";
		print "<td>";
		echo $fred[$key][1];
		print "</td>";
		print "<td>";
		echo $fred[$key][2];
		print "</td></tr>";		
	}
	print "</tr>";
	print "</table>";
	
	// List top entry pages
	print "<H2>Top Entry pages</H2>";
	$fred=top_entry($link_id, $site_id,$timescale, $max_num);
	print "<table width=100% cellspacing='0' cellpadding='0' border='1'>";
	print "<tr>";
	print "<td width='33%'>Rank</td><td width='33%'>Start page</td><td width='33%'>Requests</td>";
	print "</tr>";
	foreach ($fred as $key=>$value) {
		print "<tr><td>";
		echo $fred[$key][0];
		print "</td>";
		print "<td>";
		echo $fred[$key][1];
		print "</td>";
		print "<td>";
		echo $fred[$key][2];
		print "</td></tr>";		
	}
	print "</tr>";
	print "</table>";
		
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
