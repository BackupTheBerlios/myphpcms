<?php 

// Get database connection
include("../admin/config.php");
include("$site_root/libs/lib_db.php");
include("$site_root/libs/lib_browser.php");

$site_id=$s;   // rename the $s variable to $site_id
$user_id=$u;   // rename the $u variable to $user_id
$exit_page=$e; // rename the $e vriable to $exit_page;
$page=$p;      // rename the $p variable to $page;

// Set up header
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache");
header("Cache-Control: post-check=0,pre-check=0");
header("Cache-Control: max-age=0");
header("Pragma: no-cache");

Header( "Content-type:  image/gif");
echo readfile ("clear.gif");

// Get browser information
$browser=detect_browser($link_id);

// Create the SQL query string
$sql =  "INSERT DELAYED INTO logging_log "
    . "(day,hour,session_id,site_id,user_id,browser,ver,platform,time,page,ip_address,remote_host,referrer,exit_page) "
    . "VALUES (" . date('Ymd', mktime()) . ",'" . date('H', mktime())
    . "','"
    . $PHPSESSID
    . "','"
    . $site_id
    . "','"
    . $user_id
    . "','"
    . $browser[1]
    . "','"
    . $browser[2]
    . "','"
    . $browser[0]
    . "','"
    . time()
    . "','"
    . $page
    . "','"
    . $REMOTE_ADDR 
    . "','"
    . $REMOTE_HOST
    . "','"
    . $HTTP_REFERER
    . "','"
    . $exit_page
    . "'"
    . ");";

// Insert into database
$link_id=db_connect();
$res_logger =mysql_query($sql, $link_id);
if (!$res_logger) echo mail("plee@eurologic.com","Logging error","Can't connect");
?>
