<?php

// Library of functions to access the Bugzilla database

//**************************************************************************
//*                                                                        *
//* Public functions that are called from outside of the bugzilla library  *
//*                                                                        *
//**************************************************************************

function count_products_open($link_id) {
	// Count products that are OPEN for bug entry
	$disallownew_flag=0;
	$product_count=count_products($link_id, $disallownew_flag);
	return $product_count;
}

function count_products_closed($link_id) {
	// Count products that are CLOSED for bug entry
	$disallownew_flag=1;
	$product_count=count_products($link_id, $disallownew_flag);
	return $product_count;
}

function list_products_open($link_id) {
	// Get list of products and their descriptions of OPEN products in database
	$disallownew_flag=0;
	$product_count=list_products($link_id,$disallownew_flag);
	return $product_count;
}

function list_products_closed($link_id) {
	// Get list of products and their descriptions of CLOSED products in database
	$disallownew_flag=1;
	$product_count=list_products($link_id,$disallownew_flag);
	return $product_count;
}

function list_components($link_id,$program_name) {
	// Get list of components in given product	
	$sql_query="SELECT * FROM components WHERE program='$program_name'";
	$result=mysql_query($sql_query, $link_id);
	$counter=0;
	while ($dbdata=mysql_fetch_row($result)) {
		// Short name
		$components[$counter][0]=$dbdata[0];
		// Desciption
		$components[$counter][1]=$dbdata[3];
		$counter++;
	}
	return $components;
}

function count_components($link_id, $program_name) {
	// Get list of components for a specific product
	$sql_query="SELECT COUNT(*) FROM components WHERE program='$program_name'";
	$result=mysql_query($sql_query, $link_id);
	$component_count=mysql_result($result, 0, 0);
	return $component_count;
}

function list_bugs($link_id,$product,$component) {
	// Count total number of bugs for a given product/component combination
	$sql_query="SELECT bug_id,creation_ts,delta_ts,bug_status FROM bugs WHERE product='$product' AND component='$component' ORDER by 'creation_ts'";
	$result=mysql_query($sql_query, $link_id);
	$counter=0;
	while ($dbdata=mysql_fetch_row($result)) {
		// Bug id
		$bug_list[$counter][0]=$dbdata[0];
		// Creation date
		$bug_list[$counter][1]=$dbdata[1];
		// Last chage
		$bug_list[$counter][2]=$dbdata[2];
		// Bug status
		$bug_list[$counter][3]=$dbdata[3];
		$counter++;
	}
	return $bug_list;
}

function cummulative_bug_count($input_array) {
	// Loop through bugs in date order
	$all_bugs=0;
	$closed_bugs=0;
	$output_array=array();
	if (!empty($input_array)) {
		foreach ($input_array as $key=>$value) {
			// Increment all_bug counter
			$all_bugs++;
			// Is the bug closed ?
			if ($input_array[$key][3]=="RESOLVED" || $input_array[$key][3]=="CLOSED" || $input_array[$key][3]=="VERIFIED" ) {
				$closed_bugs++;
			}
			// Store the dates and counts in an array
			$output_array[$key][0]=$input_array[$key][1]; // date !
			$output_array[$key][1]=$all_bugs;
			$output_array[$key][2]=$closed_bugs;
		}
	}
	return $output_array;
}

function top_bugs($link_id, $bug_status, $bug_severity, $product, $component) {
	// Function to get number of bugs matching given criteria
	$output_array=bug_status($link_id, $bug_status, $bug_severity, $product, $component);
	return $output_array;
}

//**************************************************************************
//*                                                                        *
//* Private functions that are called from within the bugzilla library     *
//*                                                                        *
//**************************************************************************

function count_products($link_id,$disallownew_flag) {
	// General function to interrogate Bugzilla DB to get product list
	$sql_query="SELECT COUNT(*) FROM products WHERE disallownew=$disallownew_flag";
	$result=mysql_query($sql_query, $link_id);
	$product_count=mysql_result($result, 0, 0);
	return $product_count;
}

function list_products($link_id,$disallownew_flag) {
	// General function to interrogate Bugzilla DB to get product names and descriptions
	$sql_query="SELECT * FROM products WHERE disallownew=$disallownew_flag";
	$result=mysql_query($sql_query, $link_id);
	// Loop through and extract just the product name and description (fields 0 and 1)
	if (!$result) die("Nothing returned from database");
	$array_index=0;
	$products=array();
	while ($db_data=mysql_fetch_row($result)) {
		$products[$array_index][0]=$db_data[0]; // product name
		$products[$array_index][1]=$db_data[1]; // product description
		$array_index++;
	}
	return $products;
}

function bug_status($link_id, $bug_status, $bug_severity, $product, $component) {
	$sql_query="SELECT bug_id, version, assigned_to, short_desc, component FROM bugs WHERE product='$product' AND component='$component' AND bug_status='$bug_status' AND bug_severity='$bug_severity' ORDER BY bug_id";
	$result=mysql_query($sql_query, $link_id);
	if (!$result) echo "Database error";
	$array_index=0;
	while ($db_data=mysql_fetch_row($result)) {
		$output_array[$array_index][0]=$db_data[0]; // bug_id
		$output_array[$array_index][1]=$db_data[1]; // version
		$output_array[$array_index][2]=$db_data[2]; // owner
		$output_array[$array_index][3]=$db_data[3]; // description
		$output_array[$array_index][4]=$db_data[4]; // component
		$array_index++;
	}
	return $output_array;
}

function get_release_note_bugs($link_id, $product, $component, $version) {
	// Script to produce basis of release notes for a given release
	$sql_query="SELECT bug_id, short_desc FROM bugs WHERE (product='$product' AND component='$component') AND (bug_status='RESOLVED' AND resolution='FIXED') OR (bug_status='CLOSED' AND resolution='FIXED') ORDER BY bug_id";
	$result=mysql_query($sql_query, $link_id);
	if (!$result) echo "Database error";
	// Return result set for processing elsewhere
	return $result;
}

function build_notes($link_id,$input_result_set,$title,$separator) {
	// Function to pull text out and assemble it into a string
	$string=$title . "<BR><BR>";
	while ($db_data=mysql_fetch_row($input_result_set)) {
		$bug_id=$db_data[0]; // bug_id
		$summary=$db_data[1]; // 1-line summary text
		// String these together
		$string .="Bug " . $bug_id . " - " . $summary ."<BR><BR>";
		// Check to see if this bug has been chnaged since we last shipped code
		$sql_query="";
		
		// Get the long description for this bug from the database
		$sql_query="SELECT * FROM longdescs WHERE bug_id='$bug_id' ORDER BY 'bug_when'";
		$result2=mysql_query($sql_query, $link_id);
		if (!$result2) echo "Database error";
		// Extract the text
		while ($db_data2=mysql_fetch_row($result2)) {
			$string .=$db_data2[3] . "<BR>";
		}
		$string .=$separator . "<BR>";
	}
	return $string;
}

?>