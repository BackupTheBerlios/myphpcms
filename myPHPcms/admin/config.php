<?php

// --------------------------------------------------------------------
//
// Configuration file for generic PHP template driven website
//
// ---------------------------------------------------------------------------

// ---------------------------------------------------------------------------
// DATABASE CONFIGURATION
// ---------------------------------------------------------------------------
//
// $dbhost         = hostname
// $dbusername     = MySQL database username
// $dbuserpassword = MySQL database password
// $default_dbname = MySQL database default database name if none
//                   specified when connecting to the database
//
// ---------------------------------------------------------------------------

$dbhost="localhost";
$dbusername="root";
$dbuserpassword="";
$default_dbname="mtbwales";

// ---------------------------------------------------------------------------
// SITE WIDE VARIABLES
// ---------------------------------------------------------------------------
//
// $site_root  = base directory for site
// $site_name  = name of website
// $site_URL   = URL of website
// $site_admin = email address(es) of site administrator (separated by commas)
//
// ---------------------------------------------------------------------------

$site_root="/usr/local/apache/htdocs/dev";
$site_name="MTB-Wales.com";
$site_URL="http://www.mtb-wales.com";
$site_admin="plee@eurologic.com";

// ---------------------------------------------------------------------------
// TEMPLATE SYSTEM CONFIGURATION
// ---------------------------------------------------------------------------
//
// $site_id      = number of site template to apply to this site
// $template_age = age in seconds of templates in session file before
//                 they must be pulled from the database once again
//
// ---------------------------------------------------------------------------

$site_id=0;
$template_age=20;

?>
