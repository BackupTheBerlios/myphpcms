Dynamic logging system for use with dynamic websites
+--------------------------------------------------+

README
------

Version 0.8 08 November 2001 - Philip Lee

Files:  $SITE_ROOT/admin/adm_statistics.php
        $SITE_ROOT/logging/inc_logger.php
        $SITE_ROOT/logging/gif11.php
        $SITE_ROOT/logging/clear.gif
        $SITE_ROOT/logging/redir.php
        $SITE_ROOT/sql/logging.sql
       
Tables: logging_log
        logging_cache
        logging_unknown

Introduction
+----------+

Why use a database backed logging solution instead of log files ?
Basically because of information availability and speed.  Data is 
gathered on each hit that occurs on the site.  Analysis of this data
can be carried out at anytime and does not require the processing of long
log files - instead this task can be carried out by a graphcal front-end
which queries the logging database.  This means that any query run will
be run on the most up to date data available.

The logging system can be applied to either PHP pages or HTML pages.  Any
requests made to the webserver will result in the following information 
being stored:

     * name of page requested
     * date and time of request
     * session id (if applicable)
     * site id (allows multiple sites to be logged)
     * browser type, version and platform (depends upon lib_browser.php)
     * name of script calling logging system
     * ip of requesting host
     * name of requesting server (if resolvable)
     * referring web page or host
     * name of page that user is going to (click-thru tracking)

All of this information is stored in a single database table called
logging_log.  It is defined in logging.sql.

Overview
+------+

Any request made to the webserver can be made to generate an SQL query
to log details of the request in the database.  If the file being requested
is a PHP script then this can be achieved by including the following line
somewhere in the script:

     include("$site_root/libs/inc_logger.php");
     
If, however, the page requested is purely an HTML page or it resides on a
server that does not allow the use of PHP then the following 'GIF' can be
displayed on the page:

     <img src="gif11.php?site_id=0&page=index.html" width='1' height='1'>

Note that there are additinal parameters that need to be specified for the
'GIF' solution.  These are specified in the Reference section at the end of
this document.

The GIF solution is quite ingenious - instead of displaying a GIF it calls
a PHP file located on a server that can run PHP which parse the request, 
inserts the relevant data into the database and then passes through a 
transparent 1x1 GIF image ('clear.gif').

When the user leaves the site it can be desireable to know where they are 
going.  This can be useful in the context of tracking whether users click 
on a banner or a link to another website.  To allow this is to be monitored 
the following script can be used:

     <a href="logging/redir.php?e=http://www.phpbuilder.com">Link name</a>

This inserts the URL of the link that the user has clicked on together with
other data that can be gleaned from the execution of the script.  The target
URL is then opened in the same window as the request was made.

All of these techniques rely upon the insertion of data into the SQL database.
On a heavily used site this may result in some deterioration of performance 
so, in order to minimise this, the SQL INSERTS are delayed until the table is 
free.

Reporting
+-------+

Once the data is contained within the database it can be queried to generate 
the following information:

     * hourly requests
     * browser types
     * most requested pages
     * least requested pages
     * total page views since logging began
     * top referrers
     * top hosts requesting pages
     * top search strings
     * browser operating systems
     * top site entry pages
     * top site exit pages

It is suggested that this script be placed in a location that is only available
to the site administrator such as $site_root/admin.

All of these functions support the specification of the site_id to be investigated
and (optionally) a maximum number of results that should be returned.  All results
(with the exception of total page views since logging began) can have the timescale
over which the statistics should be reported defined by setting the $timescale to
one of the following: 'today', 'yesterday', 'thisweek', 'thismonth', 'thisquarter',
'thisyear'.

Reference
+-------+

function hourly_requests($link_id, $site_id, $timescale)

     Lists the number of hits per hour for the given $site_id and $timescale.

function browser_types($link_id, $site_id, $timescale)

     Lists the browser name, vesion, platform and percentage share of all
     requests for the specfied $site_id over the specified $timescale in descending
     order of popularity.

function top_pages($link_id, $site_id, $timescale, $max_num)

     Lists the most frequently requested pages for the site with the matching $site_id
     over the time period $timescale in descending order.  Results are limited to 
     $max_num rows of data.

function bottom_pages($link_id, $site_id, $timescale, $max_num)

     Lists the least popular pages for the site matching $site_id over the time period
     $timescale.  Results are limited to the $max_num rows.

function total_page_views($link_id, $site_id)

     Determines the total number of page requests since the site began logging.

function top_referrers($link_id, $site_id, $timescale, $max_num)

     Lists the most common referers for site $site_id over the time period $timescale.
     Results are limited to $max_num rows.  The returned values are presented as 
     hyperlinks so that they may be clicked.

function top_hosts($link_id, $site_id, $timescale, $max_num)

     Lists the most common hosts that request pages for site $site_id over the time 
     period $timescale.  Results are limited to $max_num rows.  Where possible the host
     IP addresses are resolved via a reverse DNS lookup.  To speed subsequent runs of 
     this query the host IP addresses and names are cached in the database table 
     logging_cache.  The returned values are presented as hyperlinks so that they 
     may be clicked for investigation.


function searches($link_id, $site_id, $timescale, $max_num)

     Lists the most common queries that have been executed to find the site.  This 
     information is obtained by searching all referring URLs for the words 'search' 
     and 'query'.  Results are limited to $max_num rows.
     
function operating_sys($link_id, $site_id, $timescale, $max_num)

     Lists the most common operating systems used to access the site $site_id over
     the specified time scale $timeperiod.  The number of rows rows returned is
     limited to $max_num.

function top_entry($link_id, $site_id, $timescale, $max_num)

     Lists the most commonly seen page by visitors when they enter the site $site_id.
     In theory this will be the home page but if enough traffic comes in from a link
     then it may be the page that has been linked to.  The time period over which the
     query runs can be set from the $timescale variable.  The number of rows returned
     is defined by the value of the $max_num variable.

function top_exit($link_id, $site_id, $timescale, $max_num)

     Lists the most commonly departed pages from site $site_id to allow the estimation 
     of traffic flows to another site or perhaps an advert.  The number of rows returned
     is set by $max_num.

Logging data is stored in the following format in MySQL in table logging_log:

FIELD       DEFAULT      TYPICALLY
day         '0'          20010924
hour        '0'          18
session_id  'unknown'    e11a0c6e30e09b9f67273fcd75949e51
user_id     '0'          4
site_id     '0'          0
browser     'OTHER'      IE
ver         '0'          5.5
platform    'OTHER'      Win
time        '0'          1001351949
page        NULL         /dev/bugzilla.php
ip_address  'unknown'    192.168.7.44
remote_host 'unresolved' bimble.eurologic.com
referrer    'unknown'
exit_page   'unknown'    http://www.phpbuilder.com

Host name and IP address data is stored in the following format in MySQL in table
logging_cache:

FIELD       DEFAULT      TYPICALLY
ip_address  none         192.168.7.24
host_name   null         diamond.eurologic.com

The user agent string is stored in the following format in the MySQL table
logging_unknown

FIELD       DEFAULT      TYPICALLY
user_agent  None         Mozilla/4.0b2 (Win95; I)*