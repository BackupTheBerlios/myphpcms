<?php 

// Page Logging System - Exit logging script

// Get database connection
include("../admin/config.php");
include("$site_root/libs/lib_db.php");
include("$site_root/libs/lib_browser.php");

$site_id=$s;   // rename the $s variable to $site_id
$user_id=$u;   // rename the $u variable to $user_id
$exit_page=$e; // rename the $e variable to $exit_page;
$page=$p;      // rename the $p variable to $page;

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
    . browser_get_agent()
    . "','"
    . browser_get_version()
    . "','"
    . browser_get_platform()
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

// Then send the user on their way
Header("Location: $exit_page");
exit;  

?>