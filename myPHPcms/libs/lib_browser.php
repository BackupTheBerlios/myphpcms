<?php

// Browser detection system
//
// Version 0.3 - Last modified 08 November 2001
//
// For more information see BROWSER_README.TXT and BROWSER_CHANGELOG.TXT

//**************************************************************************
//*                                                                        *
//* Public functions that are called from outside of the browser ID library*
//*                                                                        *
//**************************************************************************

function detect_browser($link_id,$UA="") {
	// Determine the platform [0], browser name[1] and version[2]
	if ($UA=="") $UA=getenv('HTTP_USER_AGENT');
	$output=array();
	$output[0]="";
	$output[1]="";
	$output[2]="";
	
	// Check for windows
	if (strstr($UA,'Win') || strstr($UA,'16bit') || strstr($UA,'95') || strstr($UA,'4.9')) {
		$output[0]=is_win($UA);
	} 
	// Check to see if they're using a MAC
	elseif (strstr($UA,'Mac') || strstr($UA,'apple') || strstr($UA,'68')) {
		$output[0]=is_mac($UA);
	} else {
		$output[0]=is_other($UA);
	}
	
	// Now check for browser and version
	if (strstr($UA,"Mozilla")) {
		// Mozilla based browser
		if (strstr($UA,"ANTFresco")) {
			$match="//";
			$output[1]="Bush Internet";
			$output[2]=get_version($UA,$match,0);
		} elseif (strstr($UA,"Multiphone")) {
			$match="//";
			$output[1]="Multiphone";
			$output[2]=get_version($UA,$match,0);
		} elseif (strstr($UA,"Konqueror")) {
			$match="//";
			$output[1]="Konqueror";
			$output[2]=get_version($UA,$match,0);
		} elseif (strstr($UA,"MSIE")) {
			$match="/MSIE ([1-9]\.[0-9]{1,2})/";
			$output[1]="Internet Explorer";
			$output[2]=get_version($UA,$match,1);
		} elseif (strstr($UA,"MS Front")) {
			$output[1]="Internet Explorer";
			$output[2]="4.0";
			$output[0]="Windows (32-bit)";
		}elseif (strstr($UA,"MSPIE")) {
			$match="/MSPIE ([1-9]\.[0-9])/";
			$output[1]="Pocket Internet Explorer";
			$output[2]=get_version($UA,$match,1);
		}  elseif (strstr($UA,"IWENG")) {
			$match="//";
			$output[1]="AOL browser";
			$output[2]=get_version($UA,$match,0);
		} elseif (strstr($UA,"aol")) {
			$match="//";
			$output[1]="AOL browser";
			$output[2]=get_version($UA,$match,0);
		} elseif (strstr($UA,"PowerBrowser")) {
			$match="//";
			$output[1]="Oracle PowerBrowser";
			$output[2]=get_version($UA,$match,0);
		} elseif (strstr($UA,"Opera")) {
			$match="//";
			$output[1]="Opera";
			$output[2]=get_version($UA,$match,0);
		} elseif (strstr($UA,"WebTV") && strstr($UA,"MSIE")) {
			$match="//";
			$output[1]="WebTV";
			$output[2]=get_version($UA,$match,0);
		} elseif (strstr($UA,"Dreamcast")) {
			$match="//";
			$output[1]="Dreamcast";
			$output[2]=get_version($UA,$match,0);
		} elseif (strstr($UA,"iCAB")) {
			$match="//";
			$output[1]="iCAB";
			$output[2]=get_version($UA,$match,0);
		} elseif (strstr($UA,"CJPENNYCATE")) {
			$match="//";
			$output[1]="Web2U";
			$output[2]=get_version($UA,$match,0);
		} elseif (strstr($UA,"AOLTV")) {
			$match="//";
			$output[1]="AolTV";
			$output[2]=get_version($UA,$match,0);
		} elseif (strstr($UA,"Netbox")) {
			$match="//";
			$output[1]="Netgen";
			$output[2]=get_version($UA,$match,0);
		} elseif (strstr($UA,"compatible")) {
			$match="/MSIE ([1-9]\.[0-9])/";
			$output[1]="Internet Explorer";
			$output[2]=get_version($UA,$match,1);
		} else {
			// No other matches so it must be some form of Netscape
			$match="/Mozilla\/([0-9].[0-9]{1,2})/";
			$output[1]="Netscape";
			$output[2]=get_version($UA,$match,1);
		}
	} else {
		// Non-Mozilla based browsers
		//
		// NEED TO CHECK TO SEE IF IT IS A ROBOT
		if (strstr($UA,"Internet Explorer") && !strstr($UA,"Pocket")) {
			$match="/Explorer\/4/";
			$output[1]="Internet Explorer";
			$output[2]="4.0 (beta)";
			
		} elseif (strstr($UA,"Pocket")) {
			$match="/Explorer\/([0-9]\.[0-9])/";
			$output[1]="Pocket Internet Explorer";
			$output[2]=get_version($UA,$match,1);
			$output[0]="Windows CE";
		} elseif (strstr($UA,"lynx") || strstr($UA,"libwww")) {
			$match="//";
			$output[1]="Lynx";
			$output[2]=get_version($UA,$match,0);
		} elseif (strstr($UA,"Mosaic")) {
			$match="//";
			$output[1]="NCSA Mosaic";
			$output[2]=get_version($UA,$match,0);
		} elseif (strstr($UA,"PRODIGY")) {
			$match="//";
			$output[1]="Prodigy";
			$output[2]=get_version($UA,$match,0);
		} elseif (strstr($UA,"HotJava")) {
			$match="//";
			$output[1]="HotJava";
			$output[2]=get_version($UA,$match,0);
		} elseif (strstr($UA,"IBrowse")) {
			$match="//";
			$output[1]="IBrowse";
			$output[2]=get_version($UA,$match,0);
		} elseif (strstr($UA,"IBrowse")) {
			$match="//";
			$output[1]="WebExplorer";
			$output[2]=get_version($UA,$match,0);
		} elseif (strstr($UA,"IBM-WebExplorer")) {
			$match="//";
			$output[1]="IBM-WebExplorer";
		} elseif (strstr($UA,"MacWeb")) {
			$match="//";
			$output[1]="MacWeb";
			$output[2]=get_version($UA,$match,0);
		} elseif (strstr($UA,"Cyberdog")) {
			$match="//";
			$output[1]="Cyberdog";
			$output[2]=get_version($UA,$match,0);
		} elseif (strstr($UA,"Amiga")) {
			$match="//";
			$output[1]="Amiga Voyager";
			$output[2]=get_version($UA,$match,0);
		} elseif (strstr($UA,"ANT")) {
			$match="//";
			$output[1]="ANT-Fresco";
			$output[2]=get_version($UA,$match,0);
		} elseif (strstr($UA,"Blazer")) {
			$match="//";
			$output[1]="Blazer";
			$output[2]=get_version($UA,$match,0);
		}
	}
	// Check to see if we need to store UA in database
	if (empty($output[0]) || empty($output[1]) || empty($output[2])) {
		store_unknown($link_id,$UA);
	}
	// Check for empty values and set them to 'unknown' if found
	if (empty($output[0])) $output[0]="unknown";
	if (empty($output[1])) $output[1]="unknown";
	if (empty($output[2])) $output[2]="unknown";
	return $output;
}

//**************************************************************************
//*                                                                        *
//* Private functions that are called from within the browser ID library   *
//*                                                                        *
//**************************************************************************

function store_unknown($link_id,$UA) {
	// Function to store any unidentified user agent strings in the database
	// user agent string
	$sql_query="INSERT INTO logging_unknown VALUES('$UA');";
	$result=mysql_query($sql_query,$link_id);
	if (!$result) echo("Database error !");
}

// Platform functions

function is_win($UA) {
	// Determine the specific version of Windows
	
	$platform="";
	// 16-bit versions
	if (preg_match('/in3.1/',$UA)) {
    		$platform='Windows (16-bit)';
	} elseif (preg_match('/16bit/',$UA)) {
    		$platform='Windows (16-bit)';
	} elseif (preg_match('/indows 3/',$UA)) {
    		$platform='Windows (16-bit)';
	} elseif (preg_match('/in16/',$UA)) {
    		$platform='Windows (16-bit)';
	} elseif (preg_match('/16bit/',$UA)) {
    		$platform='Windows (16-bit)';
	} elseif (preg_match('/95\/NT/',$UA)) {
		$platform='Windows (32-bit)';
	} 
	// 32-bit versions
	elseif (preg_match('/in95/',$UA)) {
		$platform='Windows 95';
	} elseif (preg_match('/indows 95/',$UA)) {
    		$platform='Windows 95';
	} elseif (preg_match('/in32/',$UA)) {
    		$platform='Windows (32-bit)';
	} elseif (preg_match('/in 32/',$UA)) {
    		$platform='Windows (32-bit)';
	} elseif (preg_match('/in98/',$UA)) {
    		$platform='Windows 98';
	} elseif (preg_match('/indows 98/',$UA)) {
    		$platform='Windows 98';
	} elseif (preg_match('/indows NT 5.0/',$UA)) {
    		$platform='Windows 2000';
	} elseif (preg_match('/in2000/',$UA)) {
    		$platform='Windows 2000';
	} elseif (preg_match('/indows 4.10/',$UA)) {
    		$platform='Windows 2000';
	} elseif (preg_match('/indows 2000/',$UA)) {
    		$platform='Windows 2000';
	} elseif (preg_match('/indows CE/',$UA)) {
    		$platform='WinCE';
	} elseif (preg_match('/4.90/',$UA)) {
    		$platform='Windows ME';
	} elseif (preg_match('/indows NT/',$UA)) {
    		$platform='Windows NT';
	} elseif (preg_match('/inNT/',$UA)) {
    		$platform='Windows NT';
	} elseif (preg_match('/indows NT 5/',$UA)) {
    		$platform='WinXP';
	} elseif (preg_match('/indows/',$UA)) {
		$platform="Windows (32-bit)";
	}
	return $platform;
}

function is_mac($UA) {
	// Determine if this is a Mac of some kind
	
	$platform="";
	if (preg_match('/Mac/',$UA)) {
		$platform='Apple';
	} elseif (preg_match('/apple/',$UA)) {
		$platform='MAC';
	} elseif (preg_match('/MacOS8/',$UA)) {
    		$platform='MacOS8';
	} elseif (preg_match('/Mac_PowerPC/',$UA)) {
		$platform='Mac PowerPC';
	} elseif (preg_match('/68000/',$UA)) {
    		$platform='Mac68K';
	} elseif (preg_match('/68K/',$UA)) {
		$platform='Mac68K';
	}
	return $platform;
}

function is_other($UA) {
	// Check for various flavours of Linux/UNIX/other platforms
	
	$platform="";
	if (preg_match('/AIX 1/',$UA)) {
    		$platform='AIX1';
	} elseif (preg_match('/AIX 2/',$UA)) {
	   	$platform='AIX2';
	} elseif (preg_match('/AIX 3/',$UA)) {
    		$platform='AIX3';
	} elseif (preg_match('/AIX 4/',$UA)) {
	   	$platform='AIX4';
	} elseif (preg_match('/AIX/',$UA)) {
    		$platform='AIX';
	} elseif (preg_match('/Amiga/',$UA)) {
	   	$platform='Amiga OS';
	} elseif (preg_match('/BSD/',$UA)) {
    		$platform='BSD';
	} elseif (preg_match('/Compaq/',$UA)) {
	   	$platform='Compaq';
	} elseif (preg_match('/CP\/M/',$UA)) {
    		$platform='CPM';
	} elseif (preg_match('/FreeBSD/',$UA)) {
	   	$platform='FreeBSD';
	} elseif (preg_match('/Geos /',$UA)) {
    		$platform='Geos';
	} elseif (preg_match('/HPUX/',$UA)) {
	   	$platform='HP-UX';
	} elseif (preg_match('/IRIX/',$UA)) {
    		$platform='IRIX';
	} elseif (preg_match('/Linux/',$UA)) {
	   	$platform='Linux';
	} elseif (preg_match('/OS\/2/',$UA)) {
    		$platform='OS/2';
	} elseif (preg_match('/SGI/',$UA)) {
	   	$platform='SGI';
	} elseif (preg_match('/Solaris/',$UA)) {
    		$platform='Solaris';
	} elseif (preg_match('/SunOS 4/',$UA)) {
	   	$platform='SunOS 4';
	} elseif (preg_match('/SunOS 5/',$UA)) {
    		$platform='SunOS5';
	} elseif (preg_match('/SunOS/',$UA)) {
	   	$platform='SunOS';
	} elseif (preg_match('/Web TV/',$UA)) {
    		$platform='WebTV';
	} elseif (preg_match('/WebTV/',$UA)) {
    		$platform='WebTV';
	} elseif (preg_match('/VAX/',$UA)) {
	   	$platform='VAX';
	} elseif (preg_match('/OpenVMS/',$UA)) {
    		$platform='OpenVMS';
	}
	return $platform;
}

// Browser functions

function get_version($UA,$match,$field) {
	// Returns the field $field that results from matching
	// the $match in the supplied user agent string $UA
	$result=array();
	preg_match($match,$UA,$result);
	if (empty($result[$field])) {
		$result[$field]="unknown";
	}
	return $result[$field];
}
	
?>
