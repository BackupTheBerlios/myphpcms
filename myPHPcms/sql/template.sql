# ----------------------------------------------------------------------------
#
# Database defination for templating system
#
# ---------------------------------------------------------------------------
USE mtbwales;

# ----------------------------------------------------------------------------
#
# Table structure for templating system
#
# ----------------------------------------------------------------------------

# Main template table
 
DROP TABLE IF EXISTS tpl_template;
CREATE TABLE tpl_template	
				(template_id INT NOT NULL auto_increment,
			 	timestamp INT,
				site_id INT,
			 	template_name CHAR(72),
			 	template_content TEXT,
			 	PRIMARY KEY (template_id)
			);

# Table of site ids and owners

DROP TABLE IF EXISTS tpl_sites;
CREATE TABLE tpl_sites	
				(site_id INT NOT NULL auto_increment,
			 	site_name VARCHAR(50),
			 	site_url VARCHAR(50),
			 	site_owner VARCHAR(50),
			 	owner_email VARCHAR(50),
			 	PRIMARY KEY (site_id)
			);
