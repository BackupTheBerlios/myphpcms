<?php

// inc_logger HTML include for use in dynamic websites
//
// Version 0.3 16 October 2001 - Philip Lee

// Determine browser
include("$site_root/libs/lib_browser.php");

// Get connection to database
$link_id=db_connect();

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
    . $PHP_SELF
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
$res_logger =mysql_query($sql, $link_id);
if (!$res_logger) echo "Logging insert failed";
?>
