<?php

// PHP page template system
//
// Version 0.6 - Last modified 12 September 2001
//
// For more information see TEMPLATES_README.TXT and TEMPLATES_CHANGELOG.TXT

session_start();

global $tpl_local_templates;
$tpl_local_templates=array();

$link_id=db_connect();

// Template system initialised in previous session file ?
if (!isset($tpl_template_set)) {
	// Read data out of database, set values and globalise
	$tpl_number_of_variables=get_variables_from_db($link_id,$site_id);
} else {
	// Read data from old session file, set values and globalise
	if (!isset($tpl_global_variable_statement_string)) {
		$tpl_global_variable_statement_string=build_global_variable_string($link_id,$site_id);
	}
	eval($tpl_global_variable_statement_string);
	
	// Need more recent values ?
	$tpl_current_timestamp=mktime();
	if ($tpl_current_timestamp-$tpl_time_stamp>$template_age) {
		// Data too old - get from database
		$fred=$tpl_current_timestamp-$tpl_time_stamp;
		$tpl_number_of_variables=get_variables_from_db($link_id,$site_id);
	}
}

//**************************************************************************
//*                                                                        *
//* Public functions that are called from outside of the template system   *
//*                                                                        *
//**************************************************************************

function parse_template($tpl_input_string, $site_id='1') {
	// Take $tpl_input_string and replace values between <tpl> and </tpl> tags
	// with corresponding variables
	global $dbhost,$dbusername,$dbpassword,$default_dbname,$tpl_template_set;
	global $tpl_global_variable_statement_string;
	eval($tpl_global_variable_statement_string);
	// Only continue if we've got some variables
	if ($tpl_global_variable_statement_string!="global \$tpl_local_templates, \$;") {
		eval($tpl_global_variable_statement_string);
		// Get a list of the variables stored in the template system
		if (!isset($tpl_template_set)) {
			// Get them from database
			$link_id=db_connect();
			$tpl_template_names=get_variable_names($link_id,$site_id);
		} else {
			$tpl_template_names=extract_templates_from_global_string($tpl_global_variable_statement_string);
		}
		
		// Loop through $tpl_input_string, check whether variable exists and replace
		do {
			$tpl_start_pos=strpos($tpl_input_string,"<tpl>");
			$tpl_end_pos=strpos($tpl_input_string,"</tpl>",$tpl_start_pos)+5;
			$tpl_found_long_variable_name=substr($tpl_input_string,$tpl_start_pos,$tpl_end_pos-$tpl_start_pos+1);
			$tpl_found_short_variable_name=extract_variable_name($tpl_found_long_variable_name);
			if (variable_exists($tpl_template_names, $tpl_found_long_variable_name)==1) {
				// Replace found variable name with its contents
				eval("\$tpl_output_string=str_replace(\"$tpl_found_long_variable_name\",\$$tpl_found_short_variable_name,\"$tpl_input_string\");");
			} else {
				// See if found variable is a local variable. If it is, then replace it too
				if (exist_local_template($tpl_found_short_variable_name)) {
					eval("\$tpl_output_string=str_replace(\"$tpl_found_long_variable_name\",\$tpl_local_templates[\"$tpl_found_short_variable_name\"],\"$tpl_input_string\");");
				} else {
					eval("\$tpl_output_string=str_replace(\"$tpl_found_long_variable_name\",\"\",\"$tpl_input_string\");");
				}
			}
			$tpl_input_string=$tpl_output_string;
		} while (strstr($tpl_input_string,"<tpl>") && strstr($tpl_input_string,"</tpl>"));
		// Display parsed string to browser
		echo $tpl_output_string;
	}
}

function insert_template($tpl_variable_name,$tpl_variable_content,$site_id='1') {
	global $dbhost,$dbusername,$dbpassword,$default_dbname;
	global $MYSQL_ERROR, $MYSQL_ERRNO;

	$tpl_long_variable_name="<tpl>" . $tpl_variable_name . "</tpl>";
	// Escape any string characters that need to be escaped
	$tpl_mysql_variable_content=addslashes($tpl_variable_content);
	$tpl_current_time=mktime();
	$link_id=db_connect();
	if (!$link_id) die(sql_error('Unable to connect to database'));
	// See if variable already exists
	$tpl_query="SELECT COUNT(template_name) FROM tpl_template WHERE template_name= '$tpl_long_variable_name' AND site_id='$site_id'";
	$tpl_result=mysql_query($tpl_query, $link_id);
	if (!$tpl_result) die(sql_error('Unable to connect to the database'));

	// Count the number of rows returned
	$tpl_total_templates=mysql_result($tpl_result, 0, 0);

	// Only continue if we don't have a duplicate
	if($tpl_total_templates==0) {
		$tpl_query="INSERT INTO tpl_template VALUES(NULL,'$tpl_current_time','$site_id','$tpl_long_variable_name','$tpl_mysql_variable_content')";
		$tpl_result=mysql_query($tpl_query,$link_id);
		eval("global \$$tpl_variable_name;");
		eval("\$$tpl_variable_name=\"$tpl_variable_content\";");
		eval("session_register('$tpl_variable_name');");
		global $tpl_time_stamp;
		session_register('tpl_time_stamp');
		$tpl_time_stamp=$tpl_current_time;
		if (!isset($tpl_template_set)) {
			global $tpl_template_set;
			session_register('tpl_template_set');
			$tpl_template_set=1;
		}
		global $tpl_global_variable_statement_string;
		session_register('tpl_global_variable_statement_string');
		$tpl_global_variable_statement_string=build_global_variable_string($link_id,$site_id);
	} else {
		refresh_template($tpl_variable_name, $tpl_variable_content);
	}
}

function refresh_template($tpl_variable_name,$tpl_variable_content,$site_id='1') {
	global $dbhost,$dbusername,$dbpassword,$default_dbname;
	global $MYSQL_ERROR, $MYSQL_ERRNO;

	$tpl_long_variable_name="<tpl>" . $tpl_variable_name . "</tpl>";

	// Escape any string characters that need to be escaped for MySQL
	$tpl_mysql_variable_content=addslashes($tpl_variable_content);
	$tpl_current_time=mktime();

	$link_id=db_connect();
	if (!$link_id) die(sql_error('Unable to connect to database'));
	// Check if variable already exists
	$tpl_query="SELECT COUNT(template_name) FROM tpl_template WHERE template_name= '$tpl_long_variable_name' AND site_id='$site_id'";
	$tpl_result=mysql_query($tpl_query, $link_id);
	if (!$tpl_result) die(sql_error('Unable to connect to the database'));
	// Count the number of rows returned
	$tpl_total_templates=mysql_result($tpl_result, 0, 0);
	// Only continue if we have a duplicate
	if($tpl_total_templates>0) {
		// We have duplicate so get template_id of it
		$tpl_query="SELECT template_id FROM tpl_template WHERE template_name='$tpl_long_variable_name' AND site_id='$site_id'";
		$tpl_result=mysql_query($tpl_query,$link_id);
		// Update old version with new
		$tpl_query_data=mysql_fetch_row($tpl_result);
		$tpl_template_id=$tpl_query_data[0];
		$tpl_query="UPDATE tpl_template SET template_content='$tpl_mysql_variable_content', timestamp=$tpl_current_time WHERE template_id='$tpl_template_id' AND site_id='$site_id'";
		$tpl_result=mysql_query($tpl_query);
		if ($tpl_result) {
			eval("global \$$tpl_variable_name;");
			eval("\$$tpl_variable_name=\"$tpl_variable_content\";");
			eval("session_register('$tpl_variable_name');");
			global $tpl_time_stamp;
			session_register('tpl_time_stamp');
			$tpl_time_stamp=$tpl_current_time;
		}
		global $tpl_global_variable_statement_string;
		session_register('tpl_global_variable_statement_string');
		$tpl_global_variable_statement_string=build_global_variable_string($link_id,$site_id);
	}
}

function delete_template($tpl_variable_name,$site_id='1') {
	global $dbhost,$dbusername,$dbpassword,$default_dbname;
	global $MYSQL_ERROR, $MYSQL_ERRNO;
	
	$tpl_long_variable_name="<tpl>" . $tpl_variable_name . "</tpl>";
	$link_id=db_connect();
	if (!$link_id) die(sql_error('Unable to connect to database'));
	// Check to see if variable exists
	$tpl_query="SELECT COUNT(template_name) FROM tpl_template WHERE template_name= '$tpl_long_variable_name' AND site_id='$site_id'";
	$tpl_result=mysql_query($tpl_query, $link_id);
	if (!$tpl_result) die(sql_error('No results returned from database'));
	// Count the number of rows returned
	$tpl_matching_templates=mysql_result($tpl_result, 0, 0);
	// If we have non-zero result, we have duplicate so delete it
	if($tpl_matching_templates>0) {
		$tpl_query="DELETE FROM tpl_template WHERE template_name='$tpl_long_variable_name' AND site_id='$site_id'";
		$tpl_result=mysql_query($tpl_query,$link_id);
		eval("\$$tpl_variable_name=\"\";");
		eval("session_unregister('$tpl_variable_name');");
		// If this is last template unset tpl_template_set variable in the session file
		$tpl_query="SELECT COUNT(template_name) FROM tpl_template WHERE site_id='$site_id'";
		$tpl_result=mysql_query($tpl_query, $link_id);
		if (!$tpl_result) die(sql_error('No results returned from database'));
		$tpl_total_templates=mysql_result($tpl_result, 0, 0);
		if ($tpl_total_templates==0) {
			unset($tpl_template_set);
			session_unregister('tpl_template_set');
		}
		global $tpl_global_variable_statement_string;
		session_register('tpl_global_variable_statement_string');
		$tpl_global_variable_statement_string=build_global_variable_string($link_id,$site_id);
	}
}

function list_template($site_id='1') {
	// Query database and build an output string that implements the <OPTION></OPTION> data
	global $db_host,$dbusername,$dbpassword,$default_dbname;
	$link_id=db_connect();
	$tpl_template_names=get_variable_names($link_id,$site_id);
	$option_string="";
	foreach ($tpl_template_names as $tpl_key=>$tpl_value) {
		$tpl_short_variable_name=extract_variable_name($tpl_template_names[$tpl_key][0]);
		$option_string .="<OPTION value=" . $tpl_short_variable_name . ">" . $tpl_short_variable_name . "</OPTION>\n";
	}
	return $option_string;
}

function destroy_template() {
	// Destroy current session data and with it the variables stored within
	session_destroy();
}

function create_local_template($tpl_variable_name, $tpl_variable_content) {
	// Create a local template and set its values
	global $tpl_local_templates;
	// Does this variable already exist ?
	$tpl_exist=exist_local_template($tpl_variable_name);
	if (!$tpl_exist) {
		eval("\$tpl_local_templates[\"$tpl_variable_name\"]=\"$tpl_variable_content\";");
	}
}

function refresh_local_template($tpl_variable_name, $tpl_variable_content) {
	global $tpl_local_templates;
	$tpl_exist=exist_local_template($tpl_variable_name);
	if ($tpl_exist) {
		eval("\$tpl_local_templates[\"$tpl_variable_name\"]=\"$tpl_variable_content\";");
	}
}

function delete_local_template($tpl_variable_name) {
	// Check that the variable exists and then delete it
	global $tpl_local_templates;
	$tpl_exist=exist_local_template($tpl_variable_name);
	if ($tpl_exist) {
		eval("\$tpl_local_templates[\"$tpl_variable_name\"]=\"\";");
	}
}

//**************************************************************************
//*                                                                        *
//* Private functions that are called from within the template system      *
//*                                                                        *
//**************************************************************************

function exist_local_template($tpl_variable_name) {
	// Check whether local template already exists
	global $tpl_local_templates;
	eval("\$tpl_fred=\$tpl_local_templates[\"$tpl_variable_name\"];");
	if (empty($tpl_fred)) {
		return 0;
	} else {
		return 1;
	}
}

function get_variables_from_db($link_id,$site_id='1') {
	// Count total templates
	$tpl_total_templates=count_templates_in_db($link_id,$site_id);
	// Continue only if we have some templates
	if($tpl_total_templates>0) {
		// Get all of the templates from the database
		$tpl_query="SELECT * FROM tpl_template WHERE site_id='$site_id'";
		$tpl_result=mysql_query($tpl_query);
		if (!$tpl_result) die("Nothing returned from database");
		while ($tpl_db_data=mysql_fetch_row($tpl_result)) {
			// Register these variables
			$tpl_variable_name=extract_variable_name($tpl_db_data[3]);
			$tpl_variable_content=stripslashes($tpl_db_data[4]);
			$tpl_variable_content=str_replace("'","<null_quote>'",$tpl_variable_content);
			eval("global \$$tpl_variable_name;");
			eval("session_register(\"$tpl_variable_name\");");
			eval("\$$tpl_variable_name=\"$tpl_variable_content\";");
		}
		global $tpl_template_set;
		session_register('tpl_template_set');
		$tpl_template_set=1;
		// Register oldest time_stamp - may force re-reading of variables from database
		global $tpl_time_stamp;
		$tpl_time_stamp=mktime();
		session_register('tpl_time_stamp');
		// Build session global string and register
		global $tpl_global_variable_statement_string;
		session_register('tpl_global_variable_statement_string');
		$tpl_global_variable_statement_string=build_global_variable_string($link_id,$site_id);
	}
	return $tpl_total_templates;
}

function count_templates_in_db($link_id,$site_id='1') {
	// Counts number of templates in database
	if (!$link_id) die(sql_error('Unable to connect to database'));
	$tpl_query="SELECT COUNT(template_name) FROM tpl_template WHERE site_id='$site_id'";
	$tpl_result=mysql_query($tpl_query);
	$tpl_total_templates=mysql_result($tpl_result, 0, 0);
	if (!$tpl_result) die(sql_error("No templates in the database"));
	return $tpl_total_templates;
}

function get_variable_names($link_id,$site_id='1') {
	// Get all templates from the database
	$tpl_query="SELECT * FROM tpl_template WHERE site_id='$site_id'";
	$tpl_result=mysql_query($tpl_query);
	if (!$tpl_result) die("Nothing returned from database");
	$tpl_array_index=0;
	while ($tpl_db_data=mysql_fetch_row($tpl_result)) {
		// Store these in an array - col 0 is the long name, 1 is short version
		$tpl_variable_name_array[$tpl_array_index][0]=$tpl_db_data[3];
		$tpl_variable_name_array[$tpl_array_index][1]=extract_variable_name($tpl_db_data[3]);
		$tpl_array_index++;
	}
	return $tpl_variable_name_array;
}

function extract_templates_from_global_string ($tpl_global_variable_statement_string) {
	// Creates an array containing the variables in [<tpl>name</tpl>] [name] format
	// by exploding the global string variable and then sorting it
	$fred=substr($tpl_global_variable_statement_string,0,strlen($tpl_global_variable_statement_string)-1);
	$tpl_array=explode(", $",$fred);
	$tpl_count=0;
	foreach ($tpl_array as $tpl_key => $tpl_value) {
		if ($tpl_key>0) {
			$fred1[$tpl_count][0]="<tpl>" . $tpl_array[$tpl_key] . "</tpl>";
			$fred1[$tpl_count][1]=$tpl_array[$tpl_key];
			$tpl_count++;
		}
	}
	return $fred1;
}

function build_global_variable_string($link_id,$site_id='1') {
	// Builds a PHP command to declare the variables contained in database.  Also builds an
	// array containing the long and short names for use in the parsing routine
	$tpl_all_variable_names=get_variable_names($link_id,$site_id);
	$tpl_prefix = "global \$tpl_local_templates, \$" . $tpl_all_variable_names[0][1];
	$tpl_total_variables=count_templates_in_db($link_id,$site_id);
	$tpl_count=1;
	while ($tpl_count<$tpl_total_variables) {
		$tpl_prefix = $tpl_prefix . ", \$" . $tpl_all_variable_names[$tpl_count][1];
		$tpl_count++;
	}
	$tpl_prefix=$tpl_prefix . ";";
	return $tpl_prefix;
}

function extract_variable_name($tpl_input_string) {
	// Strip out the <tpl> and </tpl> parts of the variable name
	$tpl_start_pos=strpos($tpl_input_string,">")+1;
	$tpl_end_pos=strpos($tpl_input_string,"<",$tpl_start_pos)-1;
	$tpl_output_string=substr($tpl_input_string,$tpl_start_pos,$tpl_end_pos-$tpl_start_pos+1);
	return $tpl_output_string;
}

function variable_exists($tpl_template_names, $tpl_target_name) {
	// Function to confirm the presence of a specific variable
	if (!empty($tpl_template_names)) {
		foreach ($tpl_template_names as $tpl_key=>$tpl_value) {
			if ($tpl_template_names[$tpl_key][0]==$tpl_target_name) {
				$tpl_variable_found=1;
				break;
			} else {
				$tpl_variable_found=0;
			}
		}
	} else {
		$tpl_variable_found=0;
	}
	return $tpl_variable_found;
}

?>
