<?php

// Load in standard config stuff
include("admin/config.php");

// Load in database stuff
include("$site_root/libs/lib_db.php");

// First say that we wish to use template system
include("$site_root/libs/lib_templates.php");

// Delete previously defined templates in session file
destroy_template();

delete_template("open_middle_row",0);
delete_template("close_middle_row",0);
delete_template("footer",0);
delete_template("separate_middle_row",0);
delete_template("page_bottom",0);
delete_template("header",0);
delete_template("page_top",0);
delete_template("whole_page",0);

echo ("Templates deleted");

?>