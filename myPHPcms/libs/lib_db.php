<?php
	//
	// Library to provide access to MySQL
	//
	// Acquired from Beginning PHP4, Sams

	$MYSQL_ERRNO='';
	$MYSQL_ERROR='';

	function db_connect($dbname='') {
		global $dbhost, $dbusername, $dbuserpassword, $default_dbname;
		global $MYSQL_ERRNO, $MYSQL_ERROR;

		$link_id=mysql_connect($dbhost, $dbusername, $dbuserpassword);
		if (!$link_id) {
			$MYSQL_ERRNO=0;
			$MYSQL_ERROR="Connection failed to the host $dbhost";
			return 0;
		}
		else if (empty($dbname) && !mysql_select_db($default_dbname)) {
			$MYSQL_ERRNO=mysql_errno();
			$MYSQL_ERROR=mysql_error();
			return 0;
		}
		else if (!empty($dbname) && !mysql_select_db($dbname)) {
			$MYSQL_ERRNO=mysql_errno();
			$MYSQL_ERROR=mysql_error();
			return 0;
		}
		else {
			return $link_id;
			}
	}

	function sql_error() {
		global $MYSQL_ERRNO, $MYSQL_ERROR;
		if (empty($MYSQL_ERROR)) {
			$MYSQL_ERRNO=mysql_errno();
			$MYSQL_ERROR=mysql_error();
		}
	return "$MYSQL_ERRNO: $MYSQL_ERROR";
	}

	function list_db($link_id) {
		global $dbhost, $dbusername, $dbuserpassword, $default_dbname;
		$result=mysql_list_dbs($link_id);
		$num_rows=mysql_num_rows($result);
		
		while ($db_data=mysql_fetch_row($result)) {
			echo $db_data[0] ."<BR>";
			$result2=mysql_list_tables($db_data[0]);
			$num_rows2=mysql_num_rows($result2);
			while($table_data=mysql_fetch_row($result2)) echo "--" . $table_data[0] . "<BR>";
			echo "==>$num_rows2 tables in " . $db_data[0] . "<P>";
		}
	}
?>
