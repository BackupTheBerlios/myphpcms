# ----------------------------------------------------------------------------
#
# Database defination for logging system
#
# ---------------------------------------------------------------------------
USE mtbwales;

# ----------------------------------------------------------------------------
#
# Table structure for logging system
#
# ----------------------------------------------------------------------------

# Main Table for storing logging information
 
DROP TABLE IF EXISTS logging_log;
CREATE TABLE logging_log (
			day int(11) DEFAULT '0' NOT NULL,
  			hour int(11) DEFAULT '0' NOT NULL,
  			session_id varchar(32) DEFAULT 'unknown',
  			site_id int(11),
  			user_id int(11),
  			browser varchar(20) DEFAULT '' NOT NULL,
  			ver float DEFAULT '0' NOT NULL,
  			platform varchar(8) DEFAULT 'OTHER' NOT NULL,
  			time int(11) DEFAULT '0' NOT NULL,
  			page text,
  			ip_address varchar(15) DEFAULT 'unknown' NOT NULL,
  			remote_host varchar(255) DEFAULT 'unresolved' NOT NULL,
  			referrer varchar(255) DEFAULT 'unknown' NOT NULL,
  			exit_page varchar(255) DEFAULT 'unknown' NOT NULL
);

#
# Dumping data for table logging_log
#

# Table to store cache of hosts to remove need to perform reverse DNS lookups everytime statistics are generated

DROP TABLE IF EXISTS logging_cache;
CREATE TABLE logging_cache (
			ip_address varchar(15) UNIQUE NOT NULL,
			remote_host varchar(255) DEFAULT 'unresolved' NOT NULL
);



DROP TABLE IF EXISTS logging_unknown;
CREATE TABLE logging_unknown (
  user_agent varchar(255) DEFAULT '' NOT NULL,
  UNIQUE user_agent (user_agent)
);

