<?php

// Script to recreate basic template information for generic website

// Load in standard config stuff
include("config.php");

// Load in database stuff
include("$site_root/libs/lib_db.php");

// First say that we wish to use template system
include("$site_root/libs/lib_templates.php");

// Delete previously defined templates in session file
destroy_template();

// Uncomment these lines to delete variables
delete_template("lbox1");
delete_template("lbox2");
delete_template("lbox3");
delete_template("rbox1");
delete_template("rbox2");
delete_template("rbox3");
delete_template("main_col1");
delete_template("main_col2");
delete_template("main_col3");
delete_template("header");
delete_template("footer");
delete_template("middle");
delete_template("body");
delete_template("head");

// Now define some content for our templates
//insert_template("lbox1","<!-- start of first left hand box -->\n<table width=100% border=1 valign=top>\n<tr>\n<td>\nBox 1\n</td>\n</tr>\n</table>\n<!-- end of first left hand box -->");
//insert_template("lbox2","<!-- start of second left hand box -->\n<table width=100% border=1 valign=top>\n<tr>\n<td>\nBox 2\n</td>\n</tr>\n</table>\n<!-- end of second left hand box -->");
//insert_template("lbox3","<!-- start of third left hand box -->\n<table width=100% border=1 valign=top>\n<tr>\n<td>\nBox 3\n</td>\n</tr>\n</table>\n<!-- end of third left hand box -->");
//insert_template("rbox1","<!-- start of first right hand box -->\n<table width=100% border=1 valign=top>\n<tr>\n<td>\nBox 1\n</td>\n</tr>\n</table>\n<!-- end of first right hand box -->\n");
//insert_template("rbox2","<!-- start of second right hand box -->\n<table width=100% border=1 valign=top>\n<tr>\n<td>\nBox 2\n</td>\n</tr>\n</table>\n<!-- end of second right hand box -->\n");
//insert_template("rbox3","<!-- start of third right hand box -->\n<table width=100% border=1 valign=top>\n<tr>\n<td>\nBox 3\n</td>\n</tr>\n</table>\n<!-- end of third right hand box -->\n");
//insert_template("main_col1","<!-- start of first column -->\n<td width=20%><tpl>lbox1</tpl><tpl>lbox2</tpl><tpl>lbox3</tpl>\n</td>\n<!-- end of first column -->\n");
//insert_template("main_col2","<!-- start of second column -->\n<td>\n<tpl>main_text</tpl>\n</td>\n<!-- end of second column -->\n");
//insert_template("main_col3","<!-- start of first column -->\n<td width=20%><tpl>rbox1</tpl><tpl>rbox2</tpl><tpl>rbox3</tpl>\n</td>\n<!-- end of first column -->\n");
//insert_template("header","<!-- start of header -->\n<tr>\n<td colspan=3>\nHeader\n</td>\n</tr>\n<!-- end of header -->\n");
//insert_template("footer","<!-- start of footer section -->\n<tr>\n<td colspan=3>\nFooter\n</td>\n</tr>\n");
//insert_template("middle","<!-- start of middle section -->\n<tr><tpl>main_col1</tpl><tpl>main_col2</tpl><tpl>main_col3</tpl>\n</tr>\n<!-- end of middle section -->\n");
//insert_template("body","<body>\n<table width=100% border=1><tpl>header</tpl><tpl>middle</tpl><tpl>footer</tpl>\n</table>\n<!-- start of footer text -->\n<center>That's all folks</center>\n<!-- end of footer text -->\n</body>\n");
//insert_template("head","<head>\n<title>This is a dynamic test page with nested tables</title>\n</head>\n");

// Define the main content
$input_string="<html><tpl>head</tpl><tpl>body</tpl></html>";

// Parse the template file
parse_template($input_string);

?>
