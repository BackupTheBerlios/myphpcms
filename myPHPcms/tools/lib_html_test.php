<?php

// Standard includes
include("admin/config.php");
include("$site_root/libs/lib_html.php");

// Open table tag
$table=new table_open;
// Write it out to a string
$html=$table->write();

	// Write out a new row
	$table=new table_row_open;
	$html .=$table->write();
	
		// Write out new division
		$table=new table_div_open;
		$html .=$table->write();
		
			// Finally insert some text
			$html .="Here is some text";
		
		// Close the division
		$table=new table_div_close;
		$html .=$table->write();

	// Close table row
	$table=new table_row_close;
	$html .=$table->write();

// Close the table tag
$table=new table_close();
$html .=$table->write();

echo $html;

?>