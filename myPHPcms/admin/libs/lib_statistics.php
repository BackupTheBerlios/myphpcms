<?php

// PHP page logging system
//
// Version 0.7 - Last modified 23 October 2001
//
// For more information see LOGGING_README.TXT and LOGGING_CHANGELOG.TXT

//*************************************************************************
//*                                                                       *
//* Public functions that are called from outside of the logging system   *
//*                                                                       *
//*************************************************************************

function hourly_requests($link_id, $site_id, $timescale) {
	// Determine total hits by hour (GMT)
	$sub_sql=get_date($timescale);
	$sql_query="SELECT COUNT(*) FROM logging_log WHERE site_id='$site_id' $sub_sql;";
	$result1=mysql_query($sql_query, $link_id);
	if (!$result1) echo "Database error !";
	$dbdata=mysql_fetch_row($result1);
	$total=$dbdata[0];	
	$sql_query="SELECT hour,count(*) as hourly_requests FROM logging_log WHERE site_id='$site_id' $sub_sql GROUP BY hour;";
	$result2=mysql_query($sql_query, $link_id);
	if (!$result2) echo "Database error !";
	$output_array=array();
	$counter=0;
	$dbdata=mysql_fetch_row($result2);
	while ($dbdata=mysql_fetch_row($result2)) {
		// Correct times for GMT (+8 hours)
		$gmt=$dbdata[0]+8;
		if ($gmt>23) $gmt=$gmt-23;
		$output_array[$counter][0]=$gmt; // hour
		$output_array[$counter][1]=$dbdata[1]; // total requests
		$output_array[$counter][2]=number_format((($dbdata[1]/$total)*100),2,'.','');
		$counter++;
	}
	if ($counter==0) $output_array=return_empty();
	return $output_array;
}

function browser_types($link_id, $site_id, $timescale) {
	//Determine page views by browser version for site
	$sub_sql=get_date($timescale);
	$sql_query1="SELECT browser, ver, platform, count(*) AS num_browsers FROM logging_log WHERE site_id='$site_id' $sub_sql GROUP BY browser, ver, platform ORDER BY num_browsers DESC;";
	$result1=mysql_query($sql_query1, $link_id);
	if (!$result1) echo "Database error !";
	// Determine total number of page views
	$sql_query2="SELECT COUNT(*) FROM logging_log WHERE site_id='$site_id' $sub_sql;";
	$result2=mysql_query($sql_query2, $link_id);
	if (!$result2) echo "Database error !";
	$dbdata=mysql_fetch_row($result2);
	$total=$dbdata[0];
	$counter=0;
	$output_array=array();
	while ($dbdata=mysql_fetch_row($result1)) {
		$output_array[$counter][0]=$dbdata[0]; // browser
		$output_array[$counter][1]=$dbdata[1]; // version
		$output_array[$counter][2]=$dbdata[2]; // platform
		$output_array[$counter][3]=number_format((($dbdata[3]/$total)*100),2,'.',''); // percentage
		$counter++;
	}
	if ($counter==0) $output_array=return_empty();
	return $output_array;
}

function browser_unknown($link_id, $site_id,$timescale) {
	// Function to (eventually) list any unidentified browsers by date
}

function top_pages($link_id, $site_id, $timescale, $max_num) {
	// List all requested URL's in descending order and limited to $max_num records
	$sub_sql=get_date($timescale);
	$sql_query="SELECT page,count(*) AS top_pages FROM logging_log WHERE site_id='$site_id' $sub_sql GROUP BY page ORDER BY top_pages DESC LIMIT $max_num;";
	$result=mysql_query($sql_query, $link_id);
	if (!$result) echo "Database error !";
	$counter=0;
	while ($dbdata=mysql_fetch_row($result)) {
		$output_array[$counter][0]=$counter+1; // ranking
		$output_array[$counter][1]=$dbdata[0]; // page
		$output_array[$counter][2]=$dbdata[1]; // requests
		$counter++;
	}
	if ($counter==0) $output_array=return_empty();
	return $output_array;
}

function bottom_pages($link_id, $site_id, $timescale, $max_num) {
	// List bottom 10/15/20 (set by function argument)
	$sub_sql=get_date($timescale);
	$sql_query="SELECT page,count(*) AS bot_pages FROM logging_log WHERE site_id='$site_id' $sub_sql GROUP BY page ORDER BY bot_pages ASC LIMIT $max_num;";
	$result=mysql_query($sql_query, $link_id);
	if (!$result) echo "Database error !";
	$counter=0;
	while ($dbdata=mysql_fetch_row($result)) {
		$output_array[$counter][0]=$counter+1; // ranking
		$output_array[$counter][1]=$dbdata[0]; // page
		$output_array[$counter][2]=$dbdata[1]; // requests
		$counter++;
	}
	if ($counter==0) $output_array=return_empty();
	return $output_array;
}

function total_page_views($link_id, $site_id) {
	// Returns total page views since start date for given site
	// Get total hits
	$sql_query="SELECT COUNT(*) FROM logging_log WHERE site_id='$site_id';";
	$result=mysql_query($sql_query, $link_id);
	if (!$result) echo "Database error !";
	$dbdata=mysql_fetch_row($result);
	$output[0]=$dbdata[0];
	
	// Get start date for this site
	$sql_query="SELECT FROM_UNIXTIME(MIN(time),'%D %M %Y') FROM logging_log WHERE site_id='$site_id';";
	$result=mysql_query($sql_query, $link_id);
	if (!$result) echo "Database error !";
	$dbdata=mysql_fetch_row($result);
	$output[1]=$dbdata[0];
	return $output;
}

function top_referrers($link_id, $site_id, $timescale, $max_num) {
	// Lists top referrers, number of occurences and limits the number to that set
	$sub_sql=get_date($timescale);
	$sql_query="SELECT referrer,count(*) AS ref_count FROM logging_log WHERE referrer!='' AND referrer LIKE 'http://%' AND referrer!='unknown' AND referrer NOT LIKE 'http://www.singletrack-mind.org.uk%' AND site_id='$site_id' $sub_sql GROUP BY referrer ORDER BY ref_count DESC LIMIT $max_num;";
	$result=mysql_query($sql_query, $link_id);
	if (!$result) echo "Database error !";
	$counter=0;
	while ($dbdata=mysql_fetch_row($result)) {
		$output_array[$counter][0]=$counter+1; // ranking
		$output_array[$counter][1]="<a href='$dbdata[0]'>$dbdata[0]</a>"; // referrer
		$output_array[$counter][2]=$dbdata[1]; // requests
		$counter++;
	}
	if ($counter==0) $output_array=return_empty();
	return $output_array;
}

function top_hosts($link_id, $site_id, $timescale, $max_num) {
	// Total up all page requests from each distinct IP address - needs sorting on count
	$sub_sql=get_date($timescale);
	$sql_query="SELECT ip_address,count(*) AS top_hosts FROM logging_log WHERE ip_address!='unknown' AND site_id='$site_id' $sub_sql GROUP BY ip_address ORDER BY top_hosts DESC LIMIT $max_num;";
	$result=mysql_query($sql_query, $link_id);
	if (!$result) echo "Database error !";
	$counter=0;
	while ($dbdata=mysql_fetch_row($result)) {
		$output_array[$counter][0]=$counter+1; // ranking
		// Look up hostname from IP address
		$host=gethostname($link_id, $dbdata[0]);
		$output_array[$counter][1]="<a href=http://$host>$host</a>"; // host
		$output_array[$counter][2]=$dbdata[1]; // requests
		$counter++;
	}
	if ($counter==0) $output_array=return_empty();
	return $output_array;	
}

function searches($link_id, $site_id, $timescale, $max_num) {
	// Looks at all referring URL's for words 'search', 'query', 'keywords' or 'q=' to try to locate search engine keywords
	$sub_sql=get_date($timescale);
	$sql_query="SELECT referrer,count(*) AS top_searches FROM logging_log WHERE referrer LIKE '%search%' OR referrer LIKE '%query%' OR referrer LIKE '%keywords%' OR referrer LIKE '%q=%' $sub_sql GROUP BY referrer ORDER BY top_searches DESC LIMIT $max_num;";
	$result=mysql_query($sql_query, $link_id);
	if (!$result) echo "Database error !";
	$counter=0;
	while ($dbdata=mysql_fetch_row($result)) {
		$output_array[$counter][0]=$counter+1; // ranking
		$output_array[$counter][1]="<a href='$dbdata[0]'>$dbdata[0]</a>"; // search string
		$output_array[$counter][2]=$dbdata[1]; // requests
		$counter++;
	}
	if ($counter==0) $output_array=return_empty();
	return $output_array;
}

function operating_sys($link_id, $site_id, $timescale, $max_num) {
	// List requests by platforms
	$sub_sql=get_date($timescale);
	$sql_query="SELECT platform, count(*) AS platform_count FROM logging_log WHERE site_id='$site_id' $sub_sql GROUP BY platform ORDER BY platform_count DESC LIMIT $max_num;";
	$result1=mysql_query($sql_query, $link_id);
	if (!$result1) echo "Database error !";
	// Determine total number of page views
	$sql_query2="SELECT COUNT(*) FROM logging_log WHERE site_id='$site_id' $sub_sql;";
	$result2=mysql_query($sql_query2, $link_id);
	if (!$result2) echo "Database error !";
	$dbdata=mysql_fetch_row($result2);
	$total=$dbdata[0];
	$counter=0;
	while ($dbdata=mysql_fetch_row($result1)) {
		$output_array[$counter][0]=$counter+1; // ranking
		$output_array[$counter][1]=$dbdata[0]; // platform
		$output_array[$counter][2]=number_format((($dbdata[1]/$total)*100),2,'.',''); // percentage
		$counter++;
	}
	if ($counter==0) $output_array=return_empty();
	return $output_array;
}

function top_entry($link_id, $site_id, $timescale, $max_num) {
	// Deterimine the page throught which most users enter the site
	$sub_sql=get_date($timescale);
	$sql_query="SELECT page,referrer,COUNT(*) AS top_entry FROM logging_log WHERE site_id='$site_id' AND referrer NOT LIKE 'http://www.singletrack-mind.org.uk' $sub_sql GROUP BY page ORDER by top_entry DESC LIMIT $max_num;";
	$result=mysql_query($sql_query, $link_id);
	if (!$result) echo "Database error !";
	$counter=0;
	while ($dbdata=mysql_fetch_row($result)) {
		$output_array[$counter][0]=$counter+1; // ranking
		$output_array[$counter][1]=$dbdata[0]; // start page
		$output_array[$counter][2]=$dbdata[2]; // requests
		$counter++;
	}
	if ($counter==0) $output_array=return_empty();
	return $output_array;
}

function top_exit($link_id, $site_id, $timescale, $max_num) {
	// List top exit destinations
	$sub_sql=get_date($timescale);
	$sql_query="SELECT exit_page,COUNT(*) AS totals FROM logging_log WHERE site_id='$site_id' AND exit_page LIKE 'http://%' $sub_sql GROUP BY exit_page ORDER BY totals DESC LIMIT $max_num;";
	$result=mysql_query($sql_query, $link_id);
	if (!$result) echo "Database error !";
	$counter=0;
	while ($dbdata=mysql_fetch_row($result)) {
		$output_array[$counter][0]=$counter+1; // ranking
		$output_array[$counter][1]="<a href='$dbdata[0]'>$dbdata[0]</a>"; // exit URL
		$output_array[$counter][2]=$dbdata[1]; // requests
		$counter++;
	}
	if ($counter==0) $output_array=return_empty();
	echo $output_array[0][0];
	return $output_array;
}

// UNFINISHED FUNCTIONS BELOW HERE

function unique_visitors($link_id, $site_id, $timescale) {
	// Count unique session_id - NOT FINISHED
	$sub_sql=get_date($timescale);
	$sql_query="SELECT COUNT(session_id) FROM logging_log WHERE session_id!='unknown' AND site_id='$site_id' $sub_sql;";
	// Or ip_address
	$sql_query="SELECT COUNT(ip_address) FROM logging_log WHERE ip_address!='unknown' AND site_id='$site_id' $sub_sql;";
	$result=mysql_query($sql_query, $link_id);
	if (!$result) echo "Database error !";
}

function users_online() {
	// Can this be done from here ?
}

function session_length() {
	// Need to count distinct session ids and then determine start and end times
}

// UNFINISHED FUNCTIONS ABOVE HERE

//*************************************************************************
//*                                                                       *
//* Private functions that are called from within the logging system      *
//*                                                                       *
//*************************************************************************

// Date functions

function today() {
	// Part SQL to limit search to today
	$sql=" AND day=FROM_UNIXTIME(UNIX_TIMESTAMP(),'%Y%m%d')";
	return $sql;
}

function yesterday() {
	// Part SQL to limit search to today
	$sql=" AND day=FROM_UNIXTIME(UNIX_TIMESTAMP(),'%Y%m%d')-1";
	return $sql;
}

function thisweek() {
	// Part SQL query to limit search to this week
	$sql=" AND day>=DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-DAYOFWEEK(NOW())+1),'%Y%m%d')";
	return $sql;
}

function thismonth() {
	// Part SQL query to limit search to this month
	$sql=" AND day>=DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-DAYOFMONTH(NOW())+1),'%Y%m%d')";
	return $sql;
}

function thisquarter() {
	// Part SQL query to limit search to this quarter
	$sql=" AND day>=DATE_SUB(DATE_FORMAT(NOW(),'%Y%m%d'), INTERVAL (MONTH(FROM_DAYS(TO_DAYS(NOW())-DAYOFMONTH(NOW())+1)))-((QUARTER(FROM_UNIXTIME(UNIX_TIMESTAMP(NOW())))-1)*3+1) MONTH)";
	return $sql;
}

function thisyear() {
	// Part SQL query to limit search to this year
	$sql=" AND day>=DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-DAYOFYEAR(NOW())+1),'%Y%m%d')";
	return $sql;
}

// Determine date range

function get_date($timescale) {
	// If $timescale set, build relevant date range string in SQL
	if (!empty($timescale)) {
		switch ($timescale) {
			case "today":
				$sub_sql=today();
				break;
			case "yesterday":
				$sub_sql=yesterday();
				break;
			case "thisweek":
				$sub_sql=thisweek();
				break;
			case "thismonth":
				$sub_sql=thismonth();
				break;
			case "thisquarter":
				$sub_sql=thisquarter();
				break;
			case "thisyear":
				$sub_sql=thisyear();
				break;
		}
	} else {
		$sub_sql="";	
	}
	return $sub_sql;
}

function return_empty() {
	// Error handler to fill returned array if the SQL query returns empty
	$output_array=array();
	$output_array[0][0]="none";
	$output_array[0][1]="none";
	$output_array[0][2]="none";
	$output_array[0][3]="none";
	return $output_array;
}

function gethostname($link_id,$ip_address) {
	// Function to retrieve host name from database if it's already been resolved
	// otherwise resolve hostname via a reverse DNS lookup.  Store results in database
	// for next time
	$sql_query="SELECT remote_host FROM logging_cache WHERE ip_address='$ip_address'";
	$result=mysql_query($sql_query, $link_id);
	if (!$result) echo "Database error !";
	$dbdata=mysql_fetch_row($result);
	$host=$dbdata[0];
	if (empty($host)) {
		// Look up hostname from DNS
		$host=gethostbyaddr($ip_address);
		$sql_query="INSERT INTO logging_cache VALUES ('$ip_address','$host');";
		$result=mysql_query($sql_query, $link_id);
		if (!$result) echo "Database error !";
	}
	return $host;
}

?>