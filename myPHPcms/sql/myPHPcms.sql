# MySQL dump 8.13
#
# Host: localhost    Database: mtbwales
#--------------------------------------------------------
# Server version	3.23.37

#
# Table structure for table 'logging_cache'
#

CREATE TABLE logging_cache (
  ip_address varchar(15) NOT NULL default '',
  remote_host varchar(255) NOT NULL default 'unresolved',
  PRIMARY KEY  (ip_address)
) TYPE=MyISAM;

#
# Dumping data for table 'logging_cache'
#


#
# Table structure for table 'logging_log'
#

CREATE TABLE logging_log (
  day int(11) NOT NULL default '0',
  hour int(11) NOT NULL default '0',
  session_id varchar(32) default 'unknown',
  site_id int(11) default NULL,
  user_id int(11) default NULL,
  browser varchar(20) NOT NULL default '',
  ver float NOT NULL default '0',
  platform varchar(8) NOT NULL default 'OTHER',
  time int(11) NOT NULL default '0',
  page text,
  ip_address varchar(15) NOT NULL default 'unknown',
  remote_host varchar(255) NOT NULL default 'unresolved',
  referrer varchar(255) NOT NULL default 'unknown',
  exit_page varchar(255) NOT NULL default 'unknown'
) TYPE=MyISAM;

#
# Dumping data for table 'logging_log'
#


#
# Table structure for table 'logging_unknown'
#

CREATE TABLE logging_unknown (
  user_agent varchar(255) NOT NULL default '',
  PRIMARY KEY  (user_agent)
) TYPE=MyISAM;

#
# Dumping data for table 'logging_unknown'
#


#
# Table structure for table 'tpl_template'
#

CREATE TABLE tpl_template (
  template_id int(11) NOT NULL auto_increment,
  timestamp int(11) default NULL,
  site_id int(11) default NULL,
  template_name varchar(72) default NULL,
  template_content text,
  PRIMARY KEY  (template_id)
) TYPE=MyISAM;

#
# Dumping data for table 'tpl_template'
#

INSERT INTO tpl_template VALUES (51,1001522036,0,'<tpl>main_col1</tpl>','<!-- start of first column -->\n<td width=20% valign=top><tpl>lbox1</tpl><tpl>lbox2</tpl><tpl>lbox3</tpl>\n</td>\n<!-- end of first column -->\n');
INSERT INTO tpl_template VALUES (50,1000124887,0,'<tpl>whole_page</tpl>','<tpl>page_top</tpl><tpl>header</tpl><tpl>open_middle_row</tpl><tpl>nav_bar</tpl><tpl>separate_middle_row</tpl><tpl>content_area</tpl><tpl>close_middle_row</tpl><tpl>footer</tpl><tpl>page_bottom</tpl>');
INSERT INTO tpl_template VALUES (49,1000124887,0,'<tpl>page_top</tpl>','<HTML>\r\n	<HEAD>\r\n		<TITLE>Eurologic SPIDER Metrics</TITLE>\r\n	</HEAD>\r\n	<BODY>\r\n		<!-- Start of main table to hold entire page -->\r\n		<TABLE width=95% border=1 cellpadding=0 cellspacing=0>\r\n			<TR>\r\n				<TD valign=top>\r\n					<!-- Start of main table to hold entire page -->\r\n					<TABLE width=100% valign=top border=1 cellpadding=0 cellspacing=0>');
INSERT INTO tpl_template VALUES (48,1000124887,0,'<tpl>header</tpl>','<TR>\r\n							<!-- Start of top row to hold page header -->\r\n							<TD><H2>Eurologic SPIDER Metrics</H2></TD>\r\n							<!-- End of top row to hold page header -->\r\n						</TR>');
INSERT INTO tpl_template VALUES (43,1000124887,0,'<tpl>open_middle_row</tpl>','<TR>\r\n							<!-- Start of middle row to hold main page content -->\r\n							<TD>\r\n								<TABLE width=100% valign=top border=1 cellpadding=0 cellspacing=0>\r\n									<TR>\r\n										<TD width=25%>');
INSERT INTO tpl_template VALUES (44,1000124887,0,'<tpl>close_middle_row</tpl>','</TD>\r\n									</TR>\r\n								</TABLE>\r\n							</TD>\r\n							<!-- End of middle row to hold main page content -->\r\n						</TR>');
INSERT INTO tpl_template VALUES (45,1000124887,0,'<tpl>footer</tpl>','<TR>\r\n							<!-- Start of bottom row to hold page footer -->\r\n							<TD><FONT size=-2>The small print !</FONT></TD>\r\n							<!-- End of bottom row to hold page footer -->\r\n						</TR>');
INSERT INTO tpl_template VALUES (46,1000124887,0,'<tpl>separate_middle_row</tpl>','</TD>\r\n										<TD width=*>');
INSERT INTO tpl_template VALUES (47,1000124887,0,'<tpl>page_bottom</tpl>','</TABLE>\r\n					<!-- End of main table to hold entire page -->\r\n				</TD>\r\n			</TR>\r\n		</TABLE>\r\n		<!-- End of main table to hold entire page -->\r\n	</BODY>\r\n</HTML>');
INSERT INTO tpl_template VALUES (27,1000121553,0,'<tpl>open_middle_row</tpl>','<TR>\r\n							<!-- Start of middle row to hold main page content -->\r\n							<TD>\r\n								<TABLE width=100% valign=top border=1 cellpadding=0 cellspacing=0>\r\n									<TR>\r\n										<TD width=25%>,0');

