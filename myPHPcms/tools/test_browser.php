<?php
	// Script to test the lib_browser.php code

	include("../admin/config.php");
	include("$site_root/libs/lib_db.php");
	include("$site_root/libs/lib_browser.php");
	// Connect to database
	$dbhost="192.168.7.24";
	$dbusername="root";
	$dbuserpassword="";
	$link_id=db_connect("mtbwales");
	
	echo "Setting up list of Netscape browsers<BR>";
	// Define Netscape browsers
	
	$netscape=array(
	"[Mozilla/3.0 (http engine)*]",
	"[Mozilla/4.0b1 (Win95; I)*]",
	"[Mozilla/4.0b1 (WinNT; I)*]",
	"[Mozilla/4.0b2 (Win95; I)*]",
	"[Mozilla/4.0b2 (WinNT; I)*]",
	"[Mozilla/4.0 * (WinNT; I)]",
	"[Mozilla/4.0 * (WinNT; U)]",
	"[Mozilla/4.0 * (Win95; I)]",
	"[Mozilla/4.0 * (Win95; U)]",
	"[Mozilla/4.01 * (WinNT; I)]",
	"[Mozilla/4.01 * (WinNT; U)]",
	"[Mozilla/4.01 * (Win95; I)]",
	"[Mozilla/4.01 * (Win95; U)]",
	"[Mozilla/4.01 (Macintosh; I; 68K)*]",
	"[Mozilla/4.01 * (Macintosh; I; 68K)]",
	"[Mozilla/4.01 (Macintosh; I; MacPPC)*]",
	"[Mozilla/4.01 * (Macintosh; I; MacPPC)]",
	"[Mozilla/4.01a (Macintosh; I; 68K)*]",
	"[Mozilla/4.01a * (Macintosh; I; 68K)]",
	"[Mozilla/4.01a (Macintosh; I; MacPPC)*]",
	"[Mozilla/4.01a * (Macintosh; I; MacPPC)]",
	"[Mozilla/4.01a (Macintosh; I; PPC)*]",
	"[Mozilla/4.01a * (Macintosh; I; PPC)]",
	"[Mozilla/4.01 * (Win16; I)]",
	"[Mozilla/4.01 * (Win16; U)]",
	"[Mozilla/4.0 * (Macintosh; I; PPC)]",
	"[Mozilla/4.01 * (Macintosh; I; PPC)]",
	"[Mozilla/4.0 (WinNT; I)*]",
	"[Mozilla/4.0 (WinNT; U)*]",
	"[Mozilla/4.0 (Win95; I)*]",
	"[Mozilla/4.0 (Win95; U)*]",
	"[Mozilla/4.0 (Win95)*]",
	"[Mozilla/4.01 (WinNT; I)*]",
	"[Mozilla/4.01 (WinNT; U)*]",
	"[Mozilla/4.01 (Win95; I)*]",
	"[Mozilla/4.01 (Win95; U)*]",
	"[Mozilla/4.01 (Win16; I)*]",
	"[Mozilla/4.01 (Win16; U)*]",
	"[Mozilla/4.0 (Macintosh; I; PPC)*]",
	"[Mozilla/4.01 (Macintosh; I; PPC)*]",
	"[Mozilla/4.02 * (WinNT; I)]",
	"[Mozilla/4.02 * (WinNT; U)]",
	"[Mozilla/4.02 * (Win95; I)]",
	"[Mozilla/4.02 * (Win95; U)]",
	"[Mozilla/4.02 (Macintosh; I; 68K)*]",
	"[Mozilla/4.02 * (Macintosh; I; 68K)]",
	"[Mozilla/4.02 (Macintosh; I; MacPPC)*]",
	"[Mozilla/4.02 * (Macintosh; I; MacPPC)]",
	"[Mozilla/4.02 * (Win16; I)]",
	"[Mozilla/4.02 * (Win16; U)]",
	"[Mozilla/4.02 * (Macintosh; I; PPC)]",
	"[Mozilla/4.02 (WinNT; I)*]",
	"[Mozilla/4.02 (WinNT; U)*]",
	"[Mozilla/4.02 (Win95; I)*]",
	"[Mozilla/4.02 (Win95; U)*]",
	"[Mozilla/4.02 (Win16; I)*]",
	"[Mozilla/4.02 (Win16; U)*]",
	"[Mozilla/4.02 * (WinNT; I ;Nav)]",
	"[Mozilla/4.02 * (WinNT; U ;Nav)]",
	"[Mozilla/4.02 * (Win95; I ;Nav)]",
	"[Mozilla/4.02 * (Win95; U ;Nav)]",
	"[Mozilla/4.02 (Macintosh; I ;Nav; 68K)*]",
	"[Mozilla/4.02 * (Macintosh; I ;Nav; 68K)]",
	"[Mozilla/4.02 (Macintosh; I ;Nav; MacPPC)*]",
	"[Mozilla/4.02 * (Macintosh; I ;Nav; MacPPC)]",
	"[Mozilla/4.02 * (Win16; I ;Nav)]",
	"[Mozilla/4.02 * (Win16; U ;Nav)]",
	"[Mozilla/4.02 * (Macintosh; I ;Nav; PPC)]",
	"[Mozilla/4.02 (WinNT; I ;Nav)*]",
	"[Mozilla/4.02 (WinNT; U ;Nav)*]",
	"[Mozilla/4.02 (Win95; I ;Nav)*]",
	"[Mozilla/4.02 (Win95; U ;Nav)*]",
	"[Mozilla/4.02 (Win16; I ;Nav)*]",
	"[Mozilla/4.02 (Win16; U ;Nav)*]",
	"[Mozilla/4.02 * (X11; I; IRIX64 6.2 IP21)]",
	"[Mozilla/4.02 * (X11; U; SunOS 5.5.1 sun4u)]",
	"[Mozilla/4.03 * (WinNT; I)]",
	"[Mozilla/4.03 * (WinNT; U)]",
	"[Mozilla/4.03 * (Win95; I)]",
	"[Mozilla/4.03 * (Win95; U)]",
	"[Mozilla/4.03 (Macintosh; I; 68K)*]",
	"[Mozilla/4.03 * (Macintosh; I; 68K)]",
	"[Mozilla/4.03 (Macintosh; I; MacPPC)*]",
	"[Mozilla/4.03 * (Macintosh; I; MacPPC)]",
	"[Mozilla/4.03 (Macintosh; I; PPC)]",
	"[Mozilla/4.03 * (Macintosh; I; PPC)]",
	"[Mozilla/4.03 (Macintosh; I; PPC, Nav)*]",
	"[Mozilla/4.03 * (Win16; I)]",
	"[Mozilla/4.03 * (Win16; U)]",
	"[Mozilla/4.03 (WinNT; I)*]",
	"[Mozilla/4.03 (WinNT; U)*]",
	"[Mozilla/4.03 (Win95; I)*]",
	"[Mozilla/4.03 (Win95; U)*]",
	"[Mozilla/4.03 (Win16; I)*]",
	"[Mozilla/4.03 (Win16; U)*]",
	"[Mozilla/4.03 * (WinNT; I ;Nav)]",
	"[Mozilla/4.03 * (WinNT; U ;Nav)]",
	"[Mozilla/4.03 * (Win95; I ;Nav)]",
	"[Mozilla/4.03 * (Win95; U ;Nav)]",
	"[Mozilla/4.03 (Macintosh; I ;Nav; 68K)*]",
	"[Mozilla/4.03 * (Macintosh; I ;Nav; 68K)]",
	"[Mozilla/4.03 (Macintosh; I ;Nav; MacPPC)*]",
	"[Mozilla/4.03 * (Macintosh; I ;Nav; MacPPC)]",
	"[Mozilla/4.03 * (Win16; I ;Nav)]",
	"[Mozilla/4.03 * (Win16; U ;Nav)]",
	"[Mozilla/4.03 * (Macintosh; I ;Nav; PPC)]",
	"[Mozilla/4.03 (WinNT; I ;Nav)*]",
	"[Mozilla/4.03 (WinNT; U ;Nav)*]",
	"[Mozilla/4.03 (Win95; I ;Nav)*]",
	"[Mozilla/4.03 (Win95; U ;Nav)*]",
	"[Mozilla/4.03 (Win16; I ;Nav)*]",
	"[Mozilla/4.03 (Win16; U ;Nav)*]",
	"[Mozilla/4.04 * (WinNT; I)]",
	"[Mozilla/4.04 * (WinNT; U)]",
	"[Mozilla/4.04 * (Win95; I)]",
	"[Mozilla/4.04 * (Win95; U)]",
	"[Mozilla/4.04 (Macintosh; I; 68K)*]",
	"[Mozilla/4.04 * (Macintosh; I; 68K)]",
	"[Mozilla/4.04 (Macintosh; I; MacPPC)*]",
	"[Mozilla/4.04 * (Macintosh; I; MacPPC)]",
	"[Mozilla/4.04 (Macintosh; I; PPC)]",
	"[Mozilla/4.04 * (Macintosh; I; PPC)]",
	"[Mozilla/4.04 (Macintosh; I; PPC, Nav)*]",
	"[Mozilla/4.04 * (Win16; I)]",
	"[Mozilla/4.04 * (Win16; U)]",
	"[Mozilla/4.04 (WinNT; I)*]",
	"[Mozilla/4.04 (WinNT; U)*]",
	"[Mozilla/4.04 (Win95; I)*]",
	"[Mozilla/4.04 (Win95; U)*]",
	"[Mozilla/4.04 (Win16; I)*]",
	"[Mozilla/4.04 (Win16; U)*]",
	"[Mozilla/4.04 * (WinNT; I ;Nav)]",
	"[Mozilla/4.04 * (WinNT; U ;Nav)]",
	"[Mozilla/4.04 * (Win95; I ;Nav)]",
	"[Mozilla/4.04 * (Win95; U ;Nav)]",
	"[Mozilla/4.04 (Macintosh; I ;Nav; 68K)*]",
	"[Mozilla/4.04 * (Macintosh; I ;Nav; 68K)]",
	"[Mozilla/4.04 (Macintosh; I ;Nav; MacPPC)*]",
	"[Mozilla/4.04 * (Macintosh; I ;Nav; MacPPC)]",
	"[Mozilla/4.04 * (Win16; I ;Nav)]",
	"[Mozilla/4.04 * (Win16; U ;Nav)]",
	"[Mozilla/4.04 * (Macintosh; I ;Nav; PPC)]",
	"[Mozilla/4.04 (WinNT; I ;Nav)*]",
	"[Mozilla/4.04 (WinNT; U ;Nav)*]",
	"[Mozilla/4.04 (Win95; I ;Nav)*]",
	"[Mozilla/4.04 (Win95; U ;Nav)*]",
	"[Mozilla/4.04 (Win16; I ;Nav)*]",
	"[Mozilla/4.04 (Win16; U ;Nav)*]",
	"[Mozilla/4.04b9 * (WinNT; I)]",
	"[Mozilla/4.04b9 * (WinNT; U)]",
	"[Mozilla/4.04b9 * (Win95; I)]",
	"[Mozilla/4.04b9 * (Win95; U)]",
	"[Mozilla/4.05 * (WinNT; I)]",
	"[Mozilla/4.05 * (WinNT; U)]",
	"[Mozilla/4.05 * (Win95; I)]",
	"[Mozilla/4.05 * (Win95; U)]",
	"[Mozilla/4.05 (Macintosh; I; 68K)*]",
	"[Mozilla/4.05 * (Macintosh; I; 68K)]",
	"[Mozilla/4.05 (Macintosh; I; MacPPC)*]",
	"[Mozilla/4.05 * (Macintosh; I; MacPPC)]",
	"[Mozilla/4.05 (Macintosh; I; PPC)]",
	"[Mozilla/4.05 * (Macintosh; I; PPC)]",
	"[Mozilla/4.05 (Macintosh; I; PPC, Nav)*]",
	"[Mozilla/4.05 * (Win16; I)]",
	"[Mozilla/4.05 * (Win16; U)]",
	"[Mozilla/4.05 (WinNT; I)*]",
	"[Mozilla/4.05 (WinNT; U)*]",
	"[Mozilla/4.05 (Win95; I)*]",
	"[Mozilla/4.05 (Win95; U)*]",
	"[Mozilla/4.05 (Win16; I)*]",
	"[Mozilla/4.05 (Win16; U)*]",
	"[Mozilla/4.06 * (WinNT; I)]",
	"[Mozilla/4.06 * (WinNT; U)]",
	"[Mozilla/4.06 * (Win95; I)]",
	"[Mozilla/4.06 * (Win95; U)]",
	"[Mozilla/4.06 (Macintosh; I; 68K)*]",
	"[Mozilla/4.06 * (Macintosh; I; 68K)]",
	"[Mozilla/4.06 (Macintosh; I; MacPPC)*]",
	"[Mozilla/4.06 * (Macintosh; I; MacPPC)]",
	"[Mozilla/4.06 (Macintosh; I; PPC)]",
	"[Mozilla/4.06 * (Macintosh; I; PPC)]",
	"[Mozilla/4.06 (Macintosh; I; PPC, Nav)*]",
	"[Mozilla/4.06 * (Win16; I)]",
	"[Mozilla/4.06 * (Win16; U)]",
	"[Mozilla/4.06 (WinNT; I)*]",
	"[Mozilla/4.06 (WinNT; U)*]",
	"[Mozilla/4.06 (Win95; I)*]",
	"[Mozilla/4.06 (Win95; U)*]",
	"[Mozilla/4.06 (Win16; I)*]",
	"[Mozilla/4.06 (Win16; U)*]",
	"[Mozilla/4.06 [en] (WinNT; I)]",
	"[Mozilla/4.07 * (WinNT; I)]",
	"[Mozilla/4.07 * (WinNT; U)]",
	"[Mozilla/4.07 * (Win95; I)]",
	"[Mozilla/4.07 * (Win95; U)]",
	"[Mozilla/4.07 (Macintosh; I; 68K)*]",
	"[Mozilla/4.07 * (Macintosh; I; 68K)]",
	"[Mozilla/4.07 (Macintosh; I; MacPPC)*]",
	"[Mozilla/4.07 * (Macintosh; I; MacPPC)]",
	"[Mozilla/4.07 (Macintosh; I; PPC)]",
	"[Mozilla/4.07 * (Macintosh; I; PPC)]",
	"[Mozilla/4.07 (Macintosh; I; PPC, Nav)*]",
	"[Mozilla/4.07 * (Win16; I)]",
	"[Mozilla/4.07 * (Win16; U)]",
	"[Mozilla/4.07 (WinNT; I)*]",
	"[Mozilla/4.07 (WinNT; U)*]",
	"[Mozilla/4.07 (Win95; I)*]",
	"[Mozilla/4.07 (Win95; U)*]",
	"[Mozilla/4.07 (Win16; I)*]",
	"[Mozilla/4.07 (Win16; U)*]",
	"[Mozilla/4.08 [en]C-CCK-MCD   (Win98; I ;Nav)]",
	"[Mozilla/4.08 [en]C-CCK-MCD {The Environment Agency}  (Win95; I ;Nav)]",
	"[Mozilla/4.5 * (WinNT; U)]",
	"[Mozilla/4.5 * (WinNT; I)]",
	"[Mozilla/4.5 (WinNT; U)*]",
	"[Mozilla/4.5 (WinNT; I)*]",
	"[Mozilla/4.5 * (Win95; U)]",
	"[Mozilla/4.5 * (Win95; I)]",
	"[Mozilla/4.5 (Win95; U)*]",
	"[Mozilla/4.5 (Win95; I)*]",
	"[Mozilla/4.5 * (Win98; U)]",
	"[Mozilla/4.5 * (Win98; I)]",
	"[Mozilla/4.5 (Win98; U)*]",
	"[Mozilla/4.5 (Win98; I)*]",
	"[Mozilla/4.5 (Macintosh; I; PPC)*]",
	"[Mozilla/4.5 (Macintosh; I; 68K)*]",
	"[Mozilla/4.5 * (Macintosh; I; PPC)]",
	"[Mozilla/4.5 * (Macintosh; I; 68K)]",
	"[Mozilla/4.5 * (Win16; U)]",
	"[Mozilla/4.5 * (Win16; I)]",
	"[Mozilla/4.5 (Win16; U)*]",
	"[Mozilla/4.5 (Win16; I)*]",
	"[Mozilla/4.6 * (WinNT; U)]",
	"[Mozilla/4.6 * (WinNT; I)]",
	"[Mozilla/4.6 (WinNT; U)*]",
	"[Mozilla/4.6 (WinNT; I)*]",
	"[Mozilla/4.6 * (Win95; U)]",
	"[Mozilla/4.6 * (Win95; I)]",
	"[Mozilla/4.6 (Win95; U)*]",
	"[Mozilla/4.6 (Win95; I)*]",
	"[Mozilla/4.6 * (Win98; U)]",
	"[Mozilla/4.6 * (Win98; I)]",
	"[Mozilla/4.6 (Win98; U)*]",
	"[Mozilla/4.6 (Win98; I)*]",
	"[Mozilla/4.6 (Macintosh; I; PPC)*]",
	"[Mozilla/4.6 (Macintosh; I; 68K)*]",
	"[Mozilla/4.6 * (Macintosh; I; PPC)]",
	"[Mozilla/4.6 * (Macintosh; I; 68K)]",
	"[Mozilla/4.6 * (Win16; U)]",
	"[Mozilla/4.6 * (Win16; I)]",
	"[Mozilla/4.6 (Win16; U)*]",
	"[Mozilla/4.6 (Win16; I)*]",
	"[Mozilla/4.6 [en-gb]C-CCK-MCD NetscapeOnline.co.uk  (Win98; I)]",
	"[Mozilla/4.61 (Macintosh; I; PPC)]",
	"[Mozilla/4.7 [en-gb]C-CCK-MCD   (Win98; U)]",
	"[Mozilla/4.76 [en] (X11; U; SunOS 5.7 sun4u)]",
	"[Mozilla/5.0 (Windows; U; Windows NT 5.0; en-GB; rv:0.9.2) Gecko/20010726 Netscape6/6.1]",
	"[Mozilla/4.7 * (WinNT; U)]",
	"[Mozilla/4.7 * (WinNT; I)]",
	"[Mozilla/4.7 (WinNT; U)*]",
	"[Mozilla/4.7 (WinNT; I)*]",
	"[Mozilla/4.7 * (Win95; U)]",
	"[Mozilla/4.7 * (Win95; I)]",
	"[Mozilla/4.7 (Win95; U)*]",
	"[Mozilla/4.7 (Win95; I)*]",
	"[Mozilla/4.7 * (Win98; U)]",
	"[Mozilla/4.7 * (Win98; I)]",
	"[Mozilla/4.7 (Win98; U)*]",
	"[Mozilla/4.7 (Win98; I)*]",
	"[Mozilla/4.7 (Macintosh; I; PPC)*]",
	"[Mozilla/4.7 (Macintosh; I; 68K)*]",
	"[Mozilla/4.7 * (Macintosh; I; PPC)]",
	"[Mozilla/4.7 * (Macintosh; I; 68K)]",
	"[Mozilla/4.7 * (Win16; U)]",
	"[Mozilla/4.7 * (Win16; I)]",
	"[Mozilla/4.7 (Win16; U)*]",
	"[Mozilla/4.7 (Win16; I)*]",
	"[Mozilla/4.71 * (WinNT; U)]",
	"[Mozilla/4.71 * (WinNT; I)]",
	"[Mozilla/4.71 (WinNT; U)*]",
	"[Mozilla/4.71 (WinNT; I)*]",
	"[Mozilla/4.71 * (Win95; U)]",
	"[Mozilla/4.71 * (Win95; I)]",
	"[Mozilla/4.71 (Win95; U)*]",
	"[Mozilla/4.71 (Win95; I)*]",
	"[Mozilla/4.71 * (Win98; U)]",
	"[Mozilla/4.71 * (Win98; I)]",
	"[Mozilla/4.71 (Win98; U)*]",
	"[Mozilla/4.71 (Win98; I)*]",
	"[Mozilla/4.71 (Macintosh; I; PPC)*]",
	"[Mozilla/4.71 (Macintosh; I; 68K)*]",
	"[Mozilla/4.71 * (Macintosh; I; PPC)]",
	"[Mozilla/4.71 * (Macintosh; I; 68K)]",
	"[Mozilla/4.71 * (Win16; U)]",
	"[Mozilla/4.71 * (Win16; I)]",
	"[Mozilla/4.71 (Win16; U)*]",
	"[Mozilla/4.71 (Win16; I)*]",
	"[Mozilla/4.5b1 * (WinNT; U)]",
	"[Mozilla/4.5b1 * (WinNT; I)]",
	"[Mozilla/4.5b1 (WinNT; U)*]",
	"[Mozilla/4.5b1 (WinNT; I)*]",
	"[Mozilla/4.5b1 * (Win95; U)]",
	"[Mozilla/4.5b1 * (Win95; I)]",
	"[Mozilla/4.5b1 (Win95; U)*]",
	"[Mozilla/4.5b1 (Win95; I)*]",
	"[Mozilla/4.5b1 * (Win98; U)]",
	"[Mozilla/4.5b1 * (Win98; I)]",
	"[Mozilla/4.5b1 (Win98; U)*]",
	"[Mozilla/4.5b1 (Win98; I)*]",
	"[Mozilla/4.5b1 (Macintosh; I; PPC)*]",
	"[Mozilla/4.5b1 (Macintosh; I; 68K)*]",
	"[Mozilla/4.5b1 * (Macintosh; I; PPC)]",
	"[Mozilla/4.5b1 * (Macintosh; I; 68K)]",
	"[Mozilla/4.5b1 * (Win16; U)]",
	"[Mozilla/4.5b1 * (Win16; I)]",
	"[Mozilla/4.5b1 (Win16; U)*]",
	"[Mozilla/4.5b1 (Win16; I)*]",
	"[Mozilla/4.5b2 * (WinNT; U)]",
	"[Mozilla/4.5b2 * (WinNT; I)]",
	"[Mozilla/4.5b2 (WinNT; U)*]",
	"[Mozilla/4.5b2 (WinNT; I)*]",
	"[Mozilla/4.5b2 * (Win95; U)]",
	"[Mozilla/4.5b2 * (Win95; I)]",
	"[Mozilla/4.5b2 (Win95; U)*]",
	"[Mozilla/4.5b2 (Win95; I)*]",
	"[Mozilla/4.5b2 * (Win98; U)]",
	"[Mozilla/4.5b2 * (Win98; I)]",
	"[Mozilla/4.5b2 (Win98; U)*]",
	"[Mozilla/4.5b2 (Win98; I)*]",
	"[Mozilla/4.5b2 (Macintosh; I; PPC)*]",
	"[Mozilla/4.5b2 (Macintosh; I; 68K)*]",
	"[Mozilla/4.5b2 * (Macintosh; I; PPC)]",
	"[Mozilla/4.5b2 * (Macintosh; I; 68K)]",
	"[Mozilla/4.5b2 * (Win16; U)]",
	"[Mozilla/4.5b2 * (Win16; I)]",
	"[Mozilla/4.5b2 (Win16; U)*]",
	"[Mozilla/4.5b2 (Win16; I)*]",
	"[Mozilla/4.0b3 * (WinNT; I)]",
	"[Mozilla/4.0b3 * (WinNT; U)]",
	"[Mozilla/4.0b3 * (Win95; I)]",
	"[Mozilla/4.0b3 * (Win95; U)]",
	"[Mozilla/4.0b3 * (Macintosh; I; PPC)]",
	"[Mozilla/4.03 * (X11; I; AIX 4.1)]",
	"[Mozilla/4.03 * (X11; I; Linux 2.0.29 i586)]",
	"[Mozilla/4.03 * (X11; I; SunOS 5.5 sun4m)]",
	"[Mozilla/4.0b4 * (WinNT; I)]",
	"[Mozilla/4.0b4 * (WinNT; U)]",
	"[Mozilla/4.0b4 * (Win95; I)]",
	"[Mozilla/4.0b4 * (Win95; U)]",
	"[Mozilla/4.0b4 (Macintosh; I; PPC)]",
	"[Mozilla/4.0b5 * (WinNT; I)]",
	"[Mozilla/4.0b5 * (WinNT; U)]",
	"[Mozilla/4.0b5 * (Win95; I)]",
	"[Mozilla/4.0b5 * (Win95; U)]",
	"[Mozilla/4.0b5 (Macintosh; I; PPC)*]",
	"[Mozilla/3.0 (compatible; Indy Library)]",
	"[Mozilla/3.01Gold * (Win95; I; 16bit)]",
	"[Mozilla/3.01Gold * (Win95; I)]",
	"[Mozilla/3.01Gold * (Win95; U)]",
	"[Mozilla/3.01Gold * (WinNT; I)]",
	"[Mozilla/3.01Gold * (WinNT; U)]",
	"[Mozilla/3.01Gold * (Win16; I)]",
	"[Mozilla/3.01Gold * (Win16; U)]",
	"[Mozilla/3.01Gold * (Macintosh; I; 68K)]",
	"[Mozilla/3.01Gold * (Macintosh; U; 68K)]",
	"[Mozilla/3.01Gold * (Macintosh; I; PPC)]",
	"[Mozilla/3.01Gold * (Macintosh; U; PPC)]",
	"[Mozilla/3.01Gold (X11; I; SunOS *)]",
	"[Mozilla/3.01Gold (X11; I; AIX 1)*]",
	"[Mozilla/3.02Gold * (Win95; I; 16bit)]",
	"[Mozilla/3.02Gold (Win95; I)*]",
	"[Mozilla/3.02Gold * (Win95; I)]",
	"[Mozilla/3.02Gold * (Win95; U)]",
	"[Mozilla/3.02Gold * (WinNT; I)]",
	"[Mozilla/3.02Gold * (WinNT; U)]",
	"[Mozilla/3.02Gold (WinNT; I)*]",
	"[Mozilla/3.02Gold (WinNT; U)*]",
	"[Mozilla/3.02Gold * (Win16; I)]",
	"[Mozilla/3.02Gold * (Win16; U)]",
	"[Mozilla/3.02Gold * (Macintosh; I; 68K)]",
	"[Mozilla/3.02Gold * (Macintosh; U; 68K)]",
	"[Mozilla/3.02Gold * (Macintosh; I; PPC)]",
	"[Mozilla/3.02Gold * (Macintosh; U; PPC)]",
	"[Mozilla/3.03Gold * (Win95; I; 16bit)]",
	"[Mozilla/3.03Gold * (Win95; I)]",
	"[Mozilla/3.03Gold * (Win95; U)]",
	"[Mozilla/3.03Gold * (WinNT; I)]",
	"[Mozilla/3.03Gold * (WinNT; U)]",
	"[Mozilla/3.03Gold (WinNT; I)*]",
	"[Mozilla/3.03Gold (WinNT; U)*]",
	"[Mozilla/3.03Gold (Win95; I)*]",
	"[Mozilla/3.03Gold (Win95; U)*]",
	"[Mozilla/3.03Gold * (Win16; I)]",
	"[Mozilla/3.03Gold * (Win16; U)]",
	"[Mozilla/3.03Gold * (Macintosh; I; 68K)]",
	"[Mozilla/3.03Gold * (Macintosh; U; 68K)]",
	"[Mozilla/3.03Gold * (Macintosh; I; PPC)]",
	"[Mozilla/3.03Gold * (Macintosh; U; PPC)]",
	"[Mozilla/3.04Gold * (Win95; I; 16bit)]",
	"[Mozilla/3.04Gold * (Win95; I)]",
	"[Mozilla/3.04Gold * (Win95; U)]",
	"[Mozilla/3.04Gold * (WinNT; I)]",
	"[Mozilla/3.04Gold * (WinNT; U)]",
	"[Mozilla/3.04Gold (WinNT; I)*]",
	"[Mozilla/3.04Gold (WinNT; U)*]",
	"[Mozilla/3.04Gold (Win95; I)*]",
	"[Mozilla/3.04Gold (Win95; U)*]",
	"[Mozilla/3.04Gold * (Win16; I)]",
	"[Mozilla/3.04Gold * (Win16; U)]",
	"[Mozilla/3.04Gold * (Macintosh; I; 68K)]",
	"[Mozilla/3.04Gold * (Macintosh; U; 68K)]",
	"[Mozilla/3.04Gold * (Macintosh; I; PPC)]",
	"[Mozilla/3.04Gold * (Macintosh; U; PPC)]",
	"[Mozilla/3.01GoldC-HWY1SE (Win95; I)*]",
	"[Mozilla/3.01GoldC-PBWF (Win95; I)*]",
	"[Mozilla/3.01b1Gold * (Win95; I)]",
	"[Mozilla/3.01b1Gold * (Win95; U)]",
	"[Mozilla/3.01b1Gold * (WinNT; I)]",
	"[Mozilla/3.01b1Gold * (WinNT; U)]",
	"[Mozilla/3.01b1Gold * (Win16; I)]",
	"[Mozilla/3.01b1Gold * (Win16; U)]",
	"[Mozilla/3.01b1Gold * (Macintosh; I; 68K)]",
	"[Mozilla/3.01b1Gold * (Macintosh; U; 68K)]",
	"[Mozilla/3.01b1Gold * (Macintosh; I; PPC)]",
	"[Mozilla/3.01b1Gold * (Macintosh; U; PPC)]",
	"[Mozilla/3.01 * (Win95; I; 16bit)]",
	"[Mozilla/3.01 * (Win95; I)]",
	"[Mozilla/3.01 * (Win95; U)]",
	"[Mozilla/3.01 * (WinNT; I)]",
	"[Mozilla/3.01 * (WinNT; U)]",
	"[Mozilla/3.01 * (Win16; I)]",
	"[Mozilla/3.01 * (Win16; U)]",
	"[Mozilla/3.01 * (Macintosh; I; 68K)]",
	"[Mozilla/3.01 * (Macintosh; U; 68K)]",
	"[Mozilla/3.01 * (Macintosh; I; PPC)]",
	"[Mozilla/3.01 * (Macintosh; U; PPC)]",
	"[Mozilla/3.02 (WinNT; I)*]",
	"[Mozilla/3.02 (WinNT; U)*]",
	"[Mozilla/3.02 (Win95; I)*]",
	"[Mozilla/3.02 (Win95; U)*]",
	"[Mozilla/3.02 (Macintosh; I; PPC)*]",
	"[Mozilla/3.02 (Macintosh; U; PPC)*]",
	"[Mozilla/3.02 (Macintosh; I; 68k)*]",
	"[Mozilla/3.02 (Macintosh; U; 68k)*]",
	"[Mozilla/3.02 * (WinNT; I)]",
	"[Mozilla/3.02 * (WinNT; U)]",
	"[Mozilla/3.02 * (Win95; I)]",
	"[Mozilla/3.02 * (Win95; U)]",
	"[Mozilla/3.02 * (Macintosh; I; PPC)]",
	"[Mozilla/3.02 * (Macintosh; U; PPC)]",
	"[Mozilla/3.02 * (Macintosh; I; 68k)]",
	"[Mozilla/3.02 * (Macintosh; U; 68k)]",
	"[Mozilla/3.03 * (Win16; I)]",
	"[Mozilla/3.03 * (Win16; U)]",
	"[Mozilla/3.03 * (Win95; I; 16bit)]",
	"[Mozilla/3.03 * (Win95; I)]",
	"[Mozilla/3.03 * (Win95; U)]",
	"[Mozilla/3.03 * (WinNT; I)]",
	"[Mozilla/3.03 * (WinNT; U)]",
	"[Mozilla/3.03 * (Macintosh; I; 68K)]",
	"[Mozilla/3.03 * (Macintosh; U; 68K)]",
	"[Mozilla/3.03 * (Macintosh; I; PPC)]",
	"[Mozilla/3.03 * (Macintosh; U; PPC)]",
	"[Mozilla/3.03 (Win16; I)*]",
	"[Mozilla/3.03 (Win16; U)*]",
	"[Mozilla/3.03 (Win95; I; 16bit)*]",
	"[Mozilla/3.03 (Win95; I)*]",
	"[Mozilla/3.03 (Win95; U)*]",
	"[Mozilla/3.03 (WinNT; I)*]",
	"[Mozilla/3.03 (WinNT; U)*]",
	"[Mozilla/3.03 (Macintosh; I; 68K)*]",
	"[Mozilla/3.03 (Macintosh; U; 68K)*]",
	"[Mozilla/3.03 (Macintosh; I; PPC)*]",
	"[Mozilla/3.03 (Macintosh; U; PPC)*]",
	"[Mozilla/3.04 * (Win95; I; 16bit)]",
	"[Mozilla/3.04 * (Win95; I)]",
	"[Mozilla/3.04 * (Win95; U)]",
	"[Mozilla/3.04 * (WinNT; I)]",
	"[Mozilla/3.04 * (WinNT; U)]",
	"[Mozilla/3.04 * (Win16; I)]",
	"[Mozilla/3.04 * (Win16; U)]",
	"[Mozilla/3.04 * (Macintosh; I; 68K)]",
	"[Mozilla/3.04 * (Macintosh; U; 68K)]",
	"[Mozilla/3.04 * (Macintosh; I; PPC)]",
	"[Mozilla/3.04 * (Macintosh; U; PPC)]",
	"[Mozilla/3.04 (Win95; I; 16bit)*]",
	"[Mozilla/3.04 (Win95; I)*]",
	"[Mozilla/3.04 (Win95; U)*]",
	"[Mozilla/3.04 (WinNT; I)*]",
	"[Mozilla/3.04 (WinNT; U)*]",
	"[Mozilla/3.04 (Win16; I)*]",
	"[Mozilla/3.04 (Win16; U)*]",
	"[Mozilla/3.04 (Macintosh; I; 68K)*]",
	"[Mozilla/3.04 (Macintosh; U; 68K)*]",
	"[Mozilla/3.04 (Macintosh; I; PPC)*]",
	"[Mozilla/3.04 (Macintosh; U; PPC)*]",
	"[Mozilla/3.01Gold (Win95; I; 16bit)*]",
	"[Mozilla/3.01Gold (Win95; I)*]",
	"[Mozilla/3.01Gold (Win95; U)*]",
	"[Mozilla/3.01Gold (WinNT; I)*]",
	"[Mozilla/3.01Gold (WinNT; U)*]",
	"[Mozilla/3.01Gold (Win16; I)*]",
	"[Mozilla/3.01Gold (Win16; U)*]",
	"[Mozilla/3.01Gold (Macintosh; I; 68K)*]",
	"[Mozilla/3.01Gold (Macintosh; U; 68K)*]",
	"[Mozilla/3.01Gold (Macintosh; I; PPC)*]",
	"[Mozilla/3.01Gold (Macintosh; U; PPC)*]",
	"[Mozilla/3.01b1Gold (Win95; I)*]",
	"[Mozilla/3.01b1Gold (Win95; U)*]",
	"[Mozilla/3.01b1Gold (WinNT; I)*]",
	"[Mozilla/3.01b1Gold (WinNT; U)*]",
	"[Mozilla/3.01b1Gold (Win16; I)*]",
	"[Mozilla/3.01b1Gold (Win16; U)*]",
	"[Mozilla/3.01b1Gold (Macintosh; I; 68K)*]",
	"[Mozilla/3.01b1Gold (Macintosh; U; 68K)*]",
	"[Mozilla/3.01b1Gold (Macintosh; I; PPC)*]",
	"[Mozilla/3.01b1Gold (Macintosh; U; PPC)*]",
	"[Mozilla/3.01 (Win95; I; 16bit)*]",
	"[Mozilla/3.01 (Win95; I)*]",
	"[Mozilla/3.01 (Win95; U)*]",
	"[Mozilla/3.01 (WinNT; I)*]",
	"[Mozilla/3.01 (WinNT; U)*]",
	"[Mozilla/3.01 (Win16; I)*]",
	"[Mozilla/3.01 (Win16; U)*]",
	"[Mozilla/3.01 (Macintosh; I; 68K)*]",
	"[Mozilla/3.01 (Macintosh; U; 68K)*]",
	"[Mozilla/3.01 (Macintosh; I; PPC)*]",
	"[Mozilla/3.01C* (Win95; U)]",
	"[Mozilla/3.01C* (Win95; I)]",
	"[Mozilla/3.01C* (Win16; I)]",
	"[Mozilla/3.01C* (Win16; U)]",
	"[Mozilla/3.01C* (WinNT; I)]",
	"[Mozilla/3.01C* (WinNT; U)]",
	"[Mozilla/3.01-C-MACOS8 (Macintosh; I; PPC)]",
	"[Mozilla/3.01-C-MACOS8 (Macintosh; I; 68K)*]",
	"[Mozilla/3.01-C-NSCP (Macintosh; U; PPC)]",
	"[Mozilla/3.01 (Macintosh; U; PPC)*]",
	"[Mozilla/3.01 (X11; I; SunOS *)]",
	"[Mozilla/3.01 (X11; U; SunOS *)]",
	"[Mozilla/3.01 (X11; I; IRIX *)]",
	"[Mozilla/3.01 (X11; U; IRIX *)]",
	"[Mozilla/3.01 (X11; I; Linux *)]",
	"[Mozilla/3.01 (X11; I; HP-UX *)]",
	"[Mozilla/3.01b1 (Win95; I)*]",
	"[Mozilla/3.01b1 (WinNT; I)*]",
	"[Mozilla/3.01b1 (Win16; I)*]",
	"[Mozilla/3.01b1 (Macintosh; I; 68K)*]",
	"[Mozilla/3.01b1 (Macintosh; I; PPC)*]",
	"[Mozilla/3.0Gold (Macintosh; I; 68K)*]",
	"[Mozilla/3.0Gold (Macintosh; I; PPC)*]",
	"[Mozilla/3.0Gold (Macintosh; U; 68K)*]",
	"[Mozilla/3.0Gold (Macintosh; U; PPC)*]",
	"[Mozilla/3.0Gold (X11; I; *)]",
	"[Mozilla/3.0Gold (Win16; I)*]",
	"[Mozilla/3.0Gold (Win16; U)*]",
	"[Mozilla/3.0Gold (Win95; I)*]",
	"[Mozilla/3.0Gold (Win95; I; 16bit)*]",
	"[Mozilla/3.0Gold (Win95; U)*]",
	"[Mozilla/3.0Gold (Win95; U; 16bit)*]",
	"[Mozilla/3.0Gold (WinNT; I)*]",
	"[Mozilla/3.0Gold (WinNT; U)*]",
	"[Mozilla/3.0 (Macintosh; I; 68K)*]",
	"[Mozilla/3.0 (Macintosh; I; PPC)*]",
	"[Mozilla/3.0 (Macintosh; U; 68K)*]",
	"[Mozilla/3.0-C-NC320 (Macintosh; U; 68K)*]",
	"[Mozilla/3.0 (Macintosh; U; PPC)*]",
	"[Mozilla/3.0 (X11; I; SCO_SV *)]",
	"[Mozilla/3.0 (X11; I; SunOS *)]",
	"[Mozilla/3.0 (X11; I; FreeBSD *)]",
	"[Mozilla/3.0 * (Win16; I)]",
	"[Mozilla/3.0 * (Win16; U)]",
	"[Mozilla/3.0 * (Win95; I)]",
	"[Mozilla/3.0 * (Win95; I; 16bit)]",
	"[Mozilla/3.0 * (Win95; U)]",
	"[Mozilla/3.0 * (Win95; U; 16bit)]",
	"[Mozilla/3.0 * (WinNT; I)]",
	"[Mozilla/3.0 * (WinNT; U)]",
	"[Mozilla/3.0 * (OS/2; I)]",
	"[Mozilla/3.0C* (Win95; U)]",
	"[Mozilla/3.0C* (Win95; I)]",
	"[Mozilla/3.0C* (Win16; I)]",
	"[Mozilla/3.0C* (Win16; U)]",
	"[Mozilla/3.0C* (WinNT; I)]",
	"[Mozilla/3.0C* (WinNT; U)]",
	"[Mozilla/3.0C* (Win95; I; 16bit)]",
	"[Mozilla/3.0C-USG * (X11; U; SunOS 4.1.4 sun4c)]",
	"[Mozilla/3.0C-AOL (Win95; I; 16bit)*]",
	"[Mozilla/3.0 (Win16; I)*]",
	"[Mozilla/3.0 (Win16; U)*]",
	"[Mozilla/3.0 (Win95; I)*]",
	"[Mozilla/3.0 (Win95; I; 16bit)*]",
	"[Mozilla/3.0 (Win95; U)*]",
	"[Mozilla/3.0 (Win95; U; 16bit)*]",
	"[Mozilla/3.0 (WinNT; I)*]",
	"[Mozilla/3.0 (WinNT; U)*]",
	"[Mozilla/3.0 (OS/2; I)*]",
	"[Mozilla/3.0 (X11; I; BSD/OS *)]",
	"[Mozilla/3.0 (X11; I; Linux *)]",
	"[Mozilla/3.0 (X11; I; HP-UX *)]",
	"[Mozilla/3.0b3 (Win16; I)*]",
	"[Mozilla/3.0b3 (Win95; I)*]",
	"[Mozilla/3.0b3 (WinNT; I)*]",
	"[Mozilla/3.0b3Gold (Win95; I)*]",
	"[Mozilla/3.0b4 (Macintosh; I; PPC)*]",
	"[Mozilla/3.0b4 (Win16; I)*]",
	"[Mozilla/3.0b4 (Win95; I)*]",
	"[Mozilla/3.0b4 (Win95; I; 16bit)*]",
	"[Mozilla/3.0b4 (WinNT; I)*]",
	"[Mozilla/3.0b4Gold (Macintosh; I; 68K)*]",
	"[Mozilla/3.0b4Gold (Macintosh; I; PPC)*]",
	"[Mozilla/3.0b4Gold (Win16; I)*]",
	"[Mozilla/3.0b4Gold (Win95; I)*]",
	"[Mozilla/3.0b4Gold (Win95; I; 16bit)*]",
	"[Mozilla/3.0b4Gold (WinNT; I)*]",
	"[Mozilla/3.0b5 (Macintosh; I; 68K)*]",
	"[Mozilla/3.0b5 (Macintosh; I; PPC)*]",
	"[Mozilla/3.0b5 (Win16; I)*]",
	"[Mozilla/3.0b5 (Win16; U)*]",
	"[Mozilla/3.0b5 (Win95; I)*]",
	"[Mozilla/3.0b5 (Win95; U)*]",
	"[Mozilla/3.0b5 (WinNT; I)*]",
	"[Mozilla/3.0b5 (WinNT; U)*]",
	"[Mozilla/3.0b5Gold (Macintosh; I; 68K)*]",
	"[Mozilla/3.0b5Gold (Macintosh; I; PPC)*]",
	"[Mozilla/3.0b5Gold (Win16; I)*]",
	"[Mozilla/3.0b5Gold (Win95; I)*]",
	"[Mozilla/3.0b5Gold (Win95; I; 16bit)*]",
	"[Mozilla/3.0b5Gold (WinNT; I)*]",
	"[Mozilla/3.0b5a (Win16; I)*]",
	"[Mozilla/3.0b5a (Win95; I)*]",
	"[Mozilla/3.0b5a (Win95; I; 16bit)*]",
	"[Mozilla/3.0b5a (WinNT; I)*]",
	"[Mozilla/3.0b5aGold (Win16; I)*]",
	"[Mozilla/3.0b5aGold (Win95; I)*]",
	"[Mozilla/3.0b5aGold (Win95; I; 16bit)*]",
	"[Mozilla/3.0b5aGold (WinNT; I)*]",
	"[Mozilla/3.0b6 (Macintosh; I; PPC)*]",
	"[Mozilla/3.0b6 (Win16; I)*]",
	"[Mozilla/3.0b6 (Win95; I)*]",
	"[Mozilla/3.0b6 (Win95; I; 16bit)*]",
	"[Mozilla/3.0b6 (Win95; U)*]",
	"[Mozilla/3.0b6 (WinNT; I)*]",
	"[Mozilla/3.0b6Gold (Win16; I)*]",
	"[Mozilla/3.0b6Gold (Win95; I)*]",
	"[Mozilla/3.0b6Gold (Win95; I; 16bit)*]",
	"[Mozilla/3.0b6Gold (WinNT; I)*]",
	"[Mozilla/3.0b6a (Macintosh; I; 68K)*]",
	"[Mozilla/3.0b6a (Macintosh; I; PPC)*]",
	"[Mozilla/3.0b6aGold (Macintosh; I; 68K)*]",
	"[Mozilla/3.0b6aGold (Macintosh; I; PPC)*]",
	"[Mozilla/3.0b7 (Macintosh; I; 68K)*]",
	"[Mozilla/3.0b7 (Macintosh; I; PPC)*]",
	"[Mozilla/3.0b7 (Win16; I)*]",
	"[Mozilla/3.0b7 (Win95; I)*]",
	"[Mozilla/3.0b7 (Win95; I; 16bit)*]",
	"[Mozilla/3.0b7 (WinNT; I)*]",
	"[Mozilla/3.0b7Gold (Macintosh; I; 68K)*]",
	"[Mozilla/3.0b7Gold (Macintosh; I; PPC)*]",
	"[Mozilla/3.0b7Gold (Win16; I)*]",
	"[Mozilla/3.0b7Gold (Win95; I)*]",
	"[Mozilla/3.0b7Gold (Win95; I; 16bit)*]",
	"[Mozilla/3.0b7Gold (Win95; U)*]",
	"[Mozilla/3.0b7Gold (WinNT; I)*]",
	"[Mozilla/3.0b7a (Win95; I)*]",
	"[Mozilla/3.0b7a (WinNT; I)*]",
	"[Mozilla/3.0b8Gold (Macintosh; I; 68K)*]",
	"[Mozilla/3.0b8Gold (Macintosh; I; PPC)*]",
	"[Mozilla/3.0b8Gold (Win16; I)*]",
	"[Mozilla/3.0b8Gold (Win16; U)*]",
	"[Mozilla/3.0b8Gold (Win95; I)*]",
	"[Mozilla/3.0b8Gold (Win95; I; 16bit)*]",
	"[Mozilla/3.0b8Gold (Win95; U)*]",
	"[Mozilla/3.0b8Gold (WinNT; I)*]",
	"[Mozilla/2.0 (Macintosh; I; 68K)*]",
	"[Mozilla/2.0 (Macintosh; I; PPC)*]",
	"[Mozilla/2.0 (Macintosh; U; 68K)*]",
	"[Mozilla/2.0 (Macintosh; U; PPC)*]",
	"[Mozilla/2.0 (16bit; I)*]",
	"[Mozilla/2.0 (16bit; U)*]",
	"[Mozilla/2.0 (Win95; I)*]",
	"[Mozilla/2.0 (Win95; I; 16bit)*]",
	"[Mozilla/2.0 (Win95; U)*]",
	"[Mozilla/2.0 (Win95; U; 16bit)*]",
	"[Mozilla/2.0 (WinNT; I)*]",
	"[Mozilla/2.0 (WinNT; U)*]",
	"[Mozilla/2.0 (Windows; I; 32bit)*]",
	"[Mozilla/2.01 (Macintosh; I; 68K)*]",
	"[Mozilla/2.01 (Macintosh; I; PPC)*]",
	"[Mozilla/2.01 (Macintosh; U; 68K)*]",
	"[Mozilla/2.01 (Macintosh; U; PPC)*]",
	"[Mozilla/2.01 (16bit; I)*]",
	"[Mozilla/2.01 (Win16; U)*]",
	"[Mozilla/2.01 (Win16; I)*]",
	"[Mozilla/2.01 (16bit; U)*]",
	"[Mozilla/2.01 (Win95; I)*]",
	"[Mozilla/2.01 (Win95; I; 16bit)*]",
	"[Mozilla/2.01DT * (Win95; I; 16bit)]",
	"[Mozilla/2.01 (Win95; U)*]",
	"[Mozilla/2.01 (Win95; U; 16bit)*]",
	"[Mozilla/2.01KIT (Win95; U)*]",
	"[Mozilla/2.01KIT (Win95; I)*]",
	"[Mozilla/2.01KIT (WinNT; I)*]",
	"[Mozilla/2.01KIT (WinNT; U)*]",
	"[Mozilla/2.01KIT (Win16; I)*]",
	"[Mozilla/2.01KIT (Win16; U)*]",
	"[Mozilla/2.01 (WinNT; I)*]",
	"[Mozilla/2.01 (WinNT; U)*]",
	"[Mozilla/2.01 (X11; I; SunOS *)]",
	"[Mozilla/2.01E -NOV (Win16; I)*]",
	"[Mozilla/2.01E -NOV -NOV (Win16; I)*]",
	"[Mozilla/2.01E -NOV-NOV  (Win16; I)*]",
	"[Mozilla/2.01E-GTE  (Win95; U)*]",
	"[Mozilla/2.01E-GTE (Win95; U)*]",
	"[Mozilla/2.01E-GTE (Win95; I)*]",
	"[Mozilla/2.01E-compaq (Win95; I)*]",
	"[Mozilla/2.01E-compaq  (Win95; I)*]",
	"[Mozilla/2.01E-compaq (WinNT; I)*]",
	"[Mozilla/2.01E-NC250 (Win95; U; 16bit)*]",
	"[Mozilla/2.01E-NC250 (Win95; I; 16bit)*]",
	"[Mozilla/2.01E-CIS  (Win95; I; 16bit)*]",
	"[Mozilla/2.01E (Win16; I)*]",
	"[Mozilla/2.01E (Win95; U)*]",
	"[Mozilla/2.01Gold (Win95; I)*]",
	"[Mozilla/2.01Gold (Win95; U)*]",
	"[Mozilla/2.01Gold (WinNT; I)*]",
	"[Mozilla/2.01Gold (WinNT; U)*]",
	"[Mozilla/2.01GoldA1 (Macintosh; I; 68K)*]",
	"[Mozilla/2.01I (16bit; I)*]",
	"[Mozilla/2.01I (Win95; I)*]",
	"[Mozilla/2.01I (WinNT; I)*]",
	"[Mozilla/2.01I-Sun(X11; I; SunOS *)]",
	"[Mozilla/2.02 (Macintosh; I; 68K)*]",
	"[Mozilla/2.02 (Macintosh; I; PPC)*]",
	"[Mozilla/2.02 (Macintosh; U; 68K)*]",
	"[Mozilla/2.02 (Macintosh; U; PPC)*]",
	"[Mozilla/2.02 (16bit; I)*]",
	"[Mozilla/2.02 (OS/2; I)*]",
	"[Mozilla/2.02 (OS/2; U)*]",
	"[Mozilla/2.02 (Win16; I)*]",
	"[Mozilla/2.02 * (OS/2; U)]",
	"[Mozilla/2.02 * (Win16; I)]",
	"[Mozilla/2.02 * (16bit; U)]",
	"[Mozilla/2.02 * (Win16; U)]",
	"[Mozilla/2.02 (Win95; I)*]",
	"[Mozilla/2.02 * (Win95; I)]",
	"[Mozilla/2.02E (Win95; I)*]",
	"[Mozilla/2.02E (Win95; U)*]",
	"[Mozilla/2.02E-VN005  (Win95; I)*]",
	"[Mozilla/2.02E-VN003  (Win95; I)*]",
	"[Mozilla/2.02E (Macintosh; I; 68K)*]",
	"[Mozilla/2.02E (Macintosh; U; PPC)*]",
	"[Mozilla/2.02E (OS/2; I)*]",
	"[Mozilla/2.02E (OS/2; U)*]",
	"[Mozilla/2.02 (Win95; I; 16bit)*]",
	"[Mozilla/2.02 (Win95; U)*]",
	"[Mozilla/2.02 (X11; I; SunOS *)]",
	"[Mozilla/2.02 (X11; I; Linux *)]",
	"[Mozilla/2.02 (X11; I; IRIX *)]",
	"[Mozilla/2.02APPLE (Macintosh; I; PPC)*]",
	"[Mozilla/2.02E-KIT (Win16; U)*]",
	"[Mozilla/2.02E-KIT  (Win95; I)*]",
	"[Mozilla/2.02E-SNET2 (Win16; U)*]",
	"[Mozilla/2.02E-SNET2 (Win95; U; 16bit)*]",
	"[Mozilla/2.02E-KIT (Win95; I)*]",
	"[Mozilla/2.02E-KIT (Win95; U)*]",
	"[Mozilla/2.02E-KIT  (Win95; U)*]",
	"[Mozilla/2.02 (Win95; U; 16bit)*]",
	"[Mozilla/2.02 (WinNT; I)*]",
	"[Mozilla/2.02 (WinNT; U)*]",
	"[Mozilla/2.02E-KIT (Win16; I)*]",
	"[Mozilla/2.02Gold (Win95; I)*]",
	"[Mozilla/2.02Gold (Win95; U)*]",
	"[Mozilla/2.02Gold (WinNT; I)*]",
	"[Mozilla/2.02Gold (WinNT; U)*]",
	"[Mozilla/1.22 (Windows; I; 32bit)*]",
	"[Mozilla/1.22 (Windows; I; 16bit)*]",
	"[Mozilla/1.22 (Windows; U; 16bit)*]",
	"[Mozilla/1.22ATT (Windows; U; 16bit)*]",
	"[Mozilla/1.1N (Windows; I; 16bit)*]",
	"[Mozilla/1.0 (Windows; I; 16bit)*]",
	"[Mozilla/1.0N (Windows)*]",
	"[Mozilla/2.0 (Win16; I)*]",
	"[Mozilla/2.0 (X11; I; SunOS *)]",
	"[Mozilla/1.12(Macintosh; I; 68K)*]");

	$total=count($netscape);
	$pass=0;
	echo "<hr>";
	echo "<h2>Netscape Tests</h2>";
	foreach ($netscape as $key=>$value) {
		$fred=detect_browser($link_id,$netscape[$key]);
		echo "<table width='100%' cellpadding='0' cellspacing='0' border='1'>";
		echo "<tr colspan='3'>";
		echo "<td>$netscape[$key]</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='50%'>$fred[1]</td><td width='25%'>$fred[2]</td><td width='25%'>$fred[0]</td>";
		echo "</tr>";
		echo "</tr>";
		echo "</table><BR>";
		
		if ($fred[0]!='unknown' && $fred[1]!='unknown' && $fred[2]!='unknown') $pass++;
	}
	echo "Total tests:  $total<BR>";
	echo "Passed tests: $pass<BR><BR>";


	// Define Internet Explorer browsers
	echo "Setting up list of Internet Explorer browsers<BR>";
	
	$ie=array(
	"[Microsoft Internet Explorer/4.40.210beta (Windows 95)*]",
	"[Microsoft Internet Explorer/4.40.214beta (Windows 95)*]",
	"[Microsoft Internet Explorer/4.40.300beta (Windows 95)*]",
	"[Microsoft Internet Explorer/4.40.304beta (Windows 95)*]",
	"[Microsoft Internet Explorer/4.40.305beta (Windows 95)*]",
	"[Microsoft Internet Explorer/4.40.308 (Windows 95)*]",
	"[Microsoft Internet Explorer/4.40.425 (Windows 95)*]",
	"[Microsoft Internet Explorer/4.40.426 (Windows 95)*]",
	"[Microsoft Internet Explorer/4.40.474beta (Windows 95)*]",
	"[Microsoft Internet Explorer/4.0b1 (Windows 95)*]",
	"[Mozilla/1.22 (compatible; MSIE 1.5; Windows)*]",
	"[Mozilla/1.22 (compatible; MSIE 1.5; Windows NT)*]",
	"[Mozilla/1.22 (compatible; MSIE 1.5; Windows 95)*]",
	"[Mozilla/1.22 (compatible; MSIE 2.0; Windows 95)*]",
	"[Mozilla/1.22 (compatible; MSIE 2.0; Mac_68000)*]",
	"[Mozilla/1.22 (compatible; MSIE 2.0; Mac_PowerPC)*]",
	"[Mozilla/1.22 (compatible; MSIE 2.0B; Mac_68000)*]",
	"[Mozilla/1.22 (compatible; MSIE 2.0B; Mac_PowerPC)*]",
	"[Mozilla/1.22 (compatible; MSIE 2.0; Windows 3.1)*]",
	"[Mozilla/2.0 (compatible; MSIE 2.0; Mac_68000)*]",
	"[Mozilla/2.0 (compatible; MSIE 2.0; Mac_PowerPC)*]",
	"[Mozilla/2.0 (compatible; MSIE 2.0B; Mac_68000)*]",
	"[Mozilla/2.0 (compatible; MSIE 2.0B; Mac_PowerPC)*]",
	"[Mozilla/2.0 (compatible; MSIE 2.1; Windows 3.1)*]",
	"[Mozilla/2.0 (compatible; MSIE 2.1; AOL 3.0; Windows 3.1)*]",
	"[Mozilla/2.0 (compatible; MSIE 2.1; AOL 3.0; Mac_68K)*]",
	"[Mozilla/2.0 (compatible; MSIE 2.1; Mac_68000)*]",
	"[Mozilla/2.0 (compatible; MSIE 2.1; Mac_PowerPC)*]",
	"[Mozilla/2.0 (compatible; AOL 3.0; Mac_PowerPC)*]",
	"[Mozilla/2.0 (compatible; MSIE 2.1; AOL 3.0; Mac_PPC)*]",
	"[Mozilla/2.0 (compatible; MSIE 2.5;  Windows 3.1)*]",
	"[Mozilla/2.0 (compatible; MSIE 2.5b;  Windows 3.1)*]",
	"[Mozilla/1.22 (compatible; MSIE 2.0c; Windows 95)*]",
	"[Mozilla/1.22 (compatible; MSIE 2.01; Windows NT)*]",
	"[Mozilla/1.22 (compatible; MSIE 2.0d; Windows NT)*]",
	"[Mozilla/2.0 (compatible; NEWT ActiveX; Win32)]",
	"[Mozilla/2.0 (compatible; MSIE 3.0; AK; Windows 95)*]",
	"[Mozilla/2.0 (compatible; MSIE 3.0; MSN 2.5; SK; Windows 95)*]",
	"[Mozilla/2.0 (compatible; MSIE 3.0; AK; Windows NT)*]",
	"[Mozilla/2.0 (compatible; MSIE 3.0; AOL 3.0; Windows 3.1)*]",
	"[Mozilla/2.0 (compatible; MSIE 3.0; AOL 3.0; Windows 95)*]",
	"[Mozilla/2.0 (compatible; MSIE 3.0b1; Mac_68000)*]",
	"[Mozilla/2.0 (compatible; MSIE 3.0B; Windows 3.1)*]",
	"[Mozilla/2.0 (compatible; MSIE 3.01; AK; Update B; Windows 95)*]",
	"[Mozilla/2.0 (compatible; MSIE 3.02; AOL 3.0; Windows 95)*]",
	"[Mozilla/2.0 (compatible; MSIE 3.02; Update a; AOL 3.0; Windows 95)*]",
	"[Mozilla/2.0 (compatible; MSIE 3.02; Update a; AK; AOL 3.0; Windows 95)*]",
	"[Mozilla/2.0 (compatible; MSIE 3.02; Update a; AOL 3.0; Windows NT)*]",
	"[Mozilla/2.0 (compatible; MSIE 3.02; Update a; Windows NT)*]",
	"[Mozilla/2.0 (compatible; MSIE 3.02; Update a; MSN 2.0; Windows 95)*]",
	"[Mozilla/3.0 (compatible; MSIE 3.0)*]",
	"[Mozilla/2.0 (compatible; MSIE 3.0; Mac_PowerPC)*]",
	"[Mozilla/2.0 (compatible; MSIE 3.0; SK; Windows 95)*]",
	"[Mozilla/2.0 (compatible; MSIE 3.0; SK; Windows NT)*]",
	"[Mozilla/2.0 (compatible; MSIE 3.0; Win 32)*]",
	"[Mozilla/2.0 (compatible; MSIE 3.0; Windows 95)*]",
	"[Mozilla/2.0 (compatible; MS FrontPage 2.0)*]",
	"[Mozilla/2.0 (compatible; MS FrontPage 3.0)*]",
	"[Mozilla/2.0 (compatible; MSIE 3.0; Windows 3.1)*]",
	"[Mozilla/2.0 (compatible; MSIE 3.0; Update a; Windows 95)*]",
	"[Mozilla/2.0 (compatible; MSIE 3.0; Update a; SK; Windows 95)*]",
	"[Mozilla/2.0 (compatible; MSIE 3.0; Update B; Windows 95)*]",
	"[Mozilla/2.0 (compatible; MSIE 3.0; Update a; Windows NT)*]",
	"[Mozilla/2.0 (compatible; MSIE 3.0; Windows 95) Modified]",
	"[Mozilla/2.0 (compatible; MSIE 3.0; Windows 95; *)]",
	"[Mozilla/2.0 (compatible; MSIE 3.0; Windows NT)*]",
	"[Mozilla/2.0 (compatible; MSIE 3.0A; Windows 95)*]",
	"[Mozilla/2.0 (compatible; MSIE 3.0a; Windows 3.1)*]",
	"[Mozilla/2.0 (compatible; MSIE 3.0B3; Windows 95)*]",
	"[Mozilla/2.0 (compatible; MSIE 3.0B3; Windows NT)*]",
	"[Mozilla/2.0 (compatible; MSIE 3.0B; Win32)*]",
	"[Mozilla/2.0 (compatible; MSIE 3.0B; Windows 95)*]",
	"[Mozilla/2.0 (compatible; MSIE 3.0B; Windows 95;*)]",
	"[Mozilla/2.0 (compatible; MSIE 3.0B; Windows 95; *)]",
	"[Mozilla/2.0 (compatible; MSIE 3.0B; Windows NT)*]",
	"[Mozilla/2.0 (compatible; MSIE 3.0B; Windows NT;*)]",
	"[Mozilla/2.0 (compatible; MSIE 3.1; Windows NT)*]",
	"[Mozilla/2.0 (compatible; MSIE 3.01; Windows 95)*]",
	"[Mozilla/2.0 (compatible; MSIE 3.01*; Windows 95)]",
	"[Mozilla/2.0 (compatible; MSIE 3.01; Update B; Windows 95)*]",
	"[Mozilla/2.0 (compatible; MSIE 3.01*; Windows NT)]",
	"[Mozilla/2.0 (compatible; MSIE 3.01*; Windows 3.1)]",
	"[Mozilla/2.0 (compatible; MSIE 3.01*; Mac_PowerPC)]",
	"[Mozilla/3.0 (compatible; MSIE 3.01; Mac_PowerPC)*]",
	"[Mozilla/3.0 (compatible; MSIE 3.01; Mac_68000)*]",
	"[Mozilla/3.0 (compatible; MSIE 3.01*; Mac_PowerPC)]",
	"[Mozilla/3.0 (compatible; MSIE 3.0.1; Mac_PowerPC)]",
	"[Mozilla/2.0 (compatible; MSIE 3.01*; Mac_68000)]",
	"[Mozilla/2.0 (compatible; MSIE 3.03*; Windows 3.1)]",
	"[Mozilla/4.0 (compatible; MSIE 4.01; Windows NT)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.01; Windows NT; *)]",
	"[Mozilla/4.0 (compatible; MSIE 4.01; Windows 95)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.01; Windows 95; *)]",
	"[Mozilla/4.0 (compatible; MSIE 4.01; Windows 98)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.01; Windows 98; *)]",
	"[Mozilla/4.0 (compatible; MSIE 4.01; MSN 2.5; Windows 95)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.01; MSN 2.5; Windows NT)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.01; Mac_PowerPC; E412367VMIE3.1)]",
	"[Mozilla/3.0 (compatible; MSIE 4.0p1; Mac_PowerPC)]",
	"[Mozilla/4.0 (compatible; MSIE 4.0; Windows NT)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.0; Windows 95)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.0; Mac_PowerPC)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.0; MSIECrawler; Windows NT)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.0; MSIECrawler; Windows 95)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.0; Windows NT; Snap.home.1)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.0; Windows 95; Snap.home.1)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.0; Windows NT; ITG)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.0; Windows 95; ITG)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.0; MSN 2.5; Windows 95)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.0; MSN 2.5; Windows NT)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.0; Windows NT; ICONZ 4.0.0.18)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.0; Windows 95; ICONZ 4.0.0.18)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.0; Windows 95; interscope)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.0; Windows NT; interscope)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.0; Windows 95; digitalie40)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.0; Windows NT; digitalie40)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.0; Windows 95; BPH01)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.0; Windows NT; BPH01)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.0; Windows 95; DIL0001001)*]",
	"[Mozilla/4.0 (compatible; MSIE 5.0; Windows 95; DigExt)]",
	"[Mozilla/4.0 (compatible; MSIE 4.0; Windows NT; DIL0001001)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.0; Windows 95; TUCOWS USER)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.5; Mac_PowerPC)]",
	"[Mozilla/4.0 (compatible; MSIE 4.0; Windows NT; TUCOWS USER)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.0; Windows 95; *)]",
	"[Mozilla/4.0 (compatible; MSIE 4.0; Windows NT; *)]",
	"[Mozilla/4.0 (compatible; MSIE 4.0; Windows 98; *)]",
	"[Mozilla/4.0 (compatible; MSIE 4.0b2; MSN 2.0; Windows 95)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.0b2; MSN 2.5; Windows 95)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.0b2; AOL 3.0; Windows 95)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.0b1; Windows 95)*]",
	"[Mozilla/2.0 (compatible; MSIE 4.0b1; Windows 3.1)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.0b1; Update *; Windows 95)]",
	"[Mozilla/4.0 (compatible; MSIE 4.0b1; Windows NT)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.0b1; Update *; Windows NT)]",
	"[Mozilla/2.0 (compatible; MSIE 4.0aSept; Windows 95)*]",
	"[Mozilla/2.0 (compatible; MSIE 4.0aSept; Windows NT)*]",
	"[Mozilla/4.0 (compatible; MSIE 5.0; AOL 6.0; Windows 98; DigExt; Virgo Genie V 1.0)]",
	"[Mozilla/4.0 (compatible; MSIE 5.0; Mac_PowerPC)]",
	"[Mozilla/4.0 (compatible; MSIE 5.0; MSN 2.5; Windows 98; DigExt)]",
	"[Mozilla/4.0 (compatible; MSIE 5.0b1; Windows 95)*]",
	"[Mozilla/4.0 (compatible; MSIE 5.0b1; MSIECrawler; Windows 95)*]",
	"[Mozilla/4.0 (compatible; MSIE 5.0b1; Windows 98)*]",
	"[Mozilla/4.0 (compatible; MSIE 5.0b1; MSIECrawler; Windows 98)*]",
	"[Mozilla/4.0 (compatible; MSIE 5.0b1; Windows NT)*]",
	"[Mozilla/4.0 (compatible; MSIE 5.0b1; MSIECrawler; Windows NT)*]",
	"[Mozilla/4.0 (compatible; MSIE 5.0b1; Windows NT 5.0)*]",
	"[Mozilla/4.0 (compatible; MSIE 5.0b2; Windows 95)*]",
	"[Mozilla/4.0 (compatible; MSIE 5.0b2; MSIECrawler; Windows 95)*]",
	"[Mozilla/4.0 (compatible; MSIE 5.0b2; Windows 98)*]",
	"[Mozilla/4.0 (compatible; MSIE 5.0b2; MSIECrawler; Windows 98)*]",
	"[Mozilla/4.0 (compatible; MSIE 5.0b2; Windows NT)*]",
	"[Mozilla/4.0 (compatible; MSIE 5.0b2; MSIECrawler; Windows NT)*]",
	"[Mozilla/4.0 (compatible; MSIE 5.0b2; Windows NT 5.0)*]",
	"[Mozilla/4.0 (compatible; MSIE 5.0; Windows 95)*]",
	"[Mozilla/4.0 (compatible; MSIE 5.0; MSIECrawler; Windows 95)*]",
	"[Mozilla/4.0 (compatible; MSIE 5.0; Windows 98)*]",
	"[Mozilla/4.0 (compatible; MSIE 5.0; Windows 98; DigExt)*]",
	"[Mozilla/4.0 (compatible; MSIE 5.0; Windows NT; DigExt)*]",
	"[Mozilla/4.0 (compatible; MSIE 5.0; MSIECrawler; Windows 98)*]",
	"[Mozilla/4.0 (compatible; MSIE 5.0; Windows NT)*]",
	"[Mozilla/4.0 (compatible; MSIE 5.0; MSIECrawler; Windows NT)*]",
	"[Mozilla/4.0 (compatible; MSIE 5.0; Windows NT 5.0)*]",
	"[Mozilla/4.0 (compatible; MSIE 5.01; Windows 95)*]",
	"[Mozilla/4.0 (compatible; MSIE 5.01; MSIECrawler; Windows 95)*]",
	"[Mozilla/4.0 (compatible; MSIE 5.01; Windows 98)*]",
	"[Mozilla/4.0 (compatible; MSIE 5.0; Windows 98; DigExt)*]",
	"[Mozilla/4.0 (compatible; MSIE 5.0; Windows NT; DigExt)*]",
	"[Mozilla/4.0 (compatible; MSIE 5.0; MSIECrawler; Windows 98)*]",
	"[Mozilla/4.0 (compatible; MSIE 5.0; Windows NT)*]",
	"[Mozilla/4.0 (compatible; MSIE 5.0; MSIECrawler; Windows NT)*]",
	"[Mozilla/4.0 (compatible; MSIE 5.0; Windows NT 5.0)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.0b1 Crawler; Windows 95)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.0b1 Crawler; Windows NT)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.0b2; Windows 95)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.0b2; Windows NT)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.0b2; Update a; Windows 95)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.0b2; Update a; Windows NT)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.0b2 Crawler; Windows 95)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.0b2; MSIECrawler; Windows 95)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.0b2 MSIECrawler; Windows 95)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.0b2 Crawler; Windows NT)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.0b2; MSIECrawler; Windows NT)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.0b2 MSIECrawler; Windows NT)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.0b3; Windows 95)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.0b3; Windows NT)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.0b3 Crawler; Windows 95)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.0b3 Crawler; Windows NT)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.0 Crawler; Windows 95)*]",
	"[Mozilla/4.0 (compatible; MSIE 4.0 Crawler; Windows NT)*]",
	"[Mozilla/3.02 (compatible; MSIE 3.02)*]",
	"[Mozilla/2.0 (compatible; MSIE 3.02; Windows 95)*]",
	"[Mozilla/2.0 (compatible; Thai MSIE 3.02; Windows 95)*]",
	"[Mozilla/2.0 (compatible; MSIE 3.02; Windows 3.1)*]",
	"[Mozilla/2.0 (compatible; MSIE 3.02*; Windows 3.1)]",
	"[Mozilla/2.0 (compatible; MSIE 3.02; Update a; Windows 95)*]",
	"[Mozilla/2.0 (compatible; MSIE 3.02; MSN 2.0; Update a; Windows 95)*]",
	"[Mozilla/2.0 (compatible; MSIE 3.02; MSN 2.5; Update a; Windows 95)*]",
	"[Mozilla/2.0 (compatible; MSIE 3.02; AK; Windows 95)*]",
	"[Mozilla/2.0 (compatible; MSIE 3.02; Update a; AK; Windows 95)*]",
	"[Mozilla/2.0 (compatible; MSIE 3.02; Win32)*]",
	"[Mozilla/2.0 (compatible; MSIE 3.02*; Win32)]",
	"[Mozilla/2.0 (compatible; MSIE 3.02; Windows NT)*]",
	"[Mozilla/2.0 (compatible; MSIE 3.02*; Windows NT)]",
    	"[Microsoft Pocket Internet Explorer/0.6]",
	"[Mozilla/4.0 (compatible; MSIE 5.0; Windows 98; DigExt)",
	"[Mozilla/4.0 (compatible; MSIE 5.0; Windows 98; DigExt; sureseeker.com)",
	"[Mozilla/4.0 (compatible; MSIE 5.0; Windows 98; DigExt; VNIE5 RefIE5)",
	"[Mozilla/4.0 (compatible; MSIE 5.0; Windows 98; DigExt; ZON)",
	"[Mozilla/4.0 (compatible; MSIE 5.0; Windows 98; FREESERVE_IE5)",
	"[Mozilla/4.0 (compatible; MSIE 5.0; Windows NT)",
	"[Mozilla/4.0 (compatible; MSIE 5.0; Windows NT; DigExt)",
	"[Mozilla/4.0 (compatible; MSIE 5.01; AOL 6.0; Windows 98; LineOne PCFormat2000)",
	"[Mozilla/4.0 (compatible; MSIE 5.01; Windows 95; Coca Cola Enterprises Europe Inc - GB)",
	"[Mozilla/4.0 (compatible; MSIE 5.01; Windows 95; Guidant IE5 03052000 Distribution)",
	"[Mozilla/4.0 (compatible; MSIE 5.01; Windows 98)",
	"[Mozilla/4.0 (compatible; MSIE 5.01; Windows 98; ntl)",
	"[Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)",
	"[Mozilla/4.0 (compatible; MSIE 5.01; Windows NT)",
	"[Mozilla/4.0 (compatible; MSIE 5.01; Windows NT; ntl)",
	"[Mozilla/4.0 (compatible; MSIE 5.5; AOL 5.0; Windows 95)",
	"[Mozilla/4.0 (compatible; MSIE 5.5; AOL 6.0; Windows 95)",
	"[Mozilla/4.0 (compatible; MSIE 5.5; AOL 6.0; Windows 98)",
	"[Mozilla/4.0 (compatible; MSIE 5.5; AOL 6.0; Windows 98; Win 9x 4.90)",
	"[Mozilla/4.0 (compatible; MSIE 5.5; MSN 2.5; Windows 98; BTinternet V8.4)",
	"[Mozilla/4.0 (compatible; MSIE 5.5; Windows 95)",
	"[Mozilla/4.0 (compatible; MSIE 5.5; Windows 98)",
	"[Mozilla/4.0 (compatible; MSIE 5.5; Windows 98; L1 IE5.5 December 2000)",
	"[Mozilla/4.0 (compatible; MSIE 5.5; Windows 98; Win 9x 4.90)",
	"[Mozilla/4.0 (compatible; MSIE 5.5; Windows 98; Win 9x 4.90; BTinternet CD v7.0)",
	"[Mozilla/4.0 (compatible; MSIE 5.5; Windows 98; Win 9x 4.90; BTinternet V8.4)",
	"[Mozilla/4.0 (compatible; MSIE 5.5; Windows 98; Win 9x 4.90; BTinternet V8.4)",
	"[Mozilla/4.0 (compatible; MSIE 5.5; Windows 98; Win 9x 4.90; fs_ie5_04_2000_preload)",
	"[Mozilla/4.0 (compatible; MSIE 5.5; Windows 98; Win 9x 4.90; VNIE5 RefIE5)",
	"[Mozilla/4.0 (compatible; MSIE 5.5; Windows NT 4.0)",
	"[Mozilla/4.0 (compatible; MSIE 6.0; Windows 98)",
	"[Mozilla/4.0 (compatible; MSIE 6.0; Windows 98; sureseeker.com)",
	"[Mozilla/4.0 (compatible; MSIE 6.0; Windows 98; UUNET)",
	"[Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)",
	"[Mozilla/4.0 (compatible; MSIE 6.0b; Windows NT 5.0))",
	"[Mozilla/1.1 (compatible; MSPIE 1.1; Windows CE)]",
	"[Mozilla/1.1 (compatible; MSPIE 2.0; Windows CE)]");
	
	$total=count($ie);
	$pass=0;
	echo "<hr>";
	echo "<h2>Internet Explorer Tests</h2>";
	foreach ($ie as $key=>$value) {
		$fred=detect_browser($link_id,$ie[$key]);
		echo "<table width='100%' cellpadding='0' cellspacing='0' border='1'>";
		echo "<tr colspan='3'>";
		echo "<td>$ie[$key]</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='50%'>$fred[1]</td><td width='25%'>$fred[2]</td><td width='25%'>$fred[0]</td>";
		echo "</tr>";
		echo "</tr>";
		echo "</table><BR>";
		
		if ($fred[0]!='unknown' && $fred[1]!='unknown' && $fred[2]!='unknown') $pass++;
	}
	echo "Total tests:  $total<BR>";
	echo "Passed tests: $pass<BR><BR>";

	// Define older AOL (non-Internet Explorer) browsers
	echo "Setting up list of old AOL browsers<BR>";
	
	$aol=array(
    	"[aolbrowser/1.1 InterCon-Web-Library/1.2 (Macintosh; 68K)*]",
	"[Mozilla/2.0 (Compatible; AOL-IWENG 3.0; Win16)*]",
	"[Mozilla/2.0 (Compatible; AOL-IWENG 3.1; Win16)*]");

	$total=count($aol);
	$pass=0;
	echo "<hr>";
	echo "<h2>Old AOL browser Tests</h2>";
	foreach ($aol as $key=>$value) {
		$fred=detect_browser($link_id,$aol[$key]);
		echo "<table width='100%' cellpadding='0' cellspacing='0' border='1'>";
		echo "<tr colspan='3'>";
		echo "<td>$lynx[$key]</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='50%'>$fred[1]</td><td width='25%'>$fred[2]</td><td width='25%'>$fred[0]</td>";
		echo "</tr>";
		echo "</tr>";
		echo "</table><BR>";
		
		if ($fred[0]!='unknown' && $fred[1]!='unknown' && $fred[2]!='unknown') $pass++;
	}
	echo "Total tests:  $total<BR>";
	echo "Passed tests: $pass<BR><BR>";

	// Define Lynx based browsers
	echo "Setting up list of Lynx browsers<BR>";
	
	$lynx=array(
	"[Lynx/2.6  libwww-FM/2.14*]",
	"[Lynx/2.7.1 libwww-FM/2.14*]",
	"[libwww-perl/5.06]",
	"[libwww-perl/5.03]",
	"[libwww-perl/5.07]");

	$total=count($lynx);
	$pass=0;
	echo "<hr>";
	echo "<h2>Lynx Tests</h2>";
	foreach ($lynx as $key=>$value) {
		$fred=detect_browser($link_id,$lynx[$key]);
		echo "<table width='100%' cellpadding='0' cellspacing='0' border='1'>";
		echo "<tr colspan='3'>";
		echo "<td>$lynx[$key]</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='50%'>$fred[1]</td><td width='25%'>$fred[2]</td><td width='25%'>$fred[0]</td>";
		echo "</tr>";
		echo "</tr>";
		echo "</table><BR>";
		
		if ($fred[0]!='unknown' && $fred[1]!='unknown' && $fred[2]!='unknown') $pass++;
	}
	echo "Total tests:  $total<BR>";
	echo "Passed tests: $pass<BR><BR>";

	// Define NCSA Mosaic based browsers
	echo "Setting up list of Mosaic browsers<BR>";
	
	$mosaic=array(
	"[NCSA Mosaic/3.0.0 (Windows x86)*]",
	"[NCSA Mosaic/2.1.1 (Windows x86)*]");

	$total=count($mosaic);
	$pass=0;
	echo "<hr>";
	echo "<h2>Mosaic Tests</h2>";
	foreach ($mosaic as $key=>$value) {
		$fred=detect_browser($link_id,$mosaic[$key]);
		echo "<table width='100%' cellpadding='0' cellspacing='0' border='1'>";
		echo "<tr colspan='3'>";
		echo "<td>$mosaic[$key]</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='50%'>$fred[1]</td><td width='25%'>$fred[2]</td><td width='25%'>$fred[0]</td>";
		echo "</tr>";
		echo "</tr>";
		echo "</table><BR>";
		
		if ($fred[0]!='unknown' && $fred[1]!='unknown' && $fred[2]!='unknown') $pass++;
	}
	echo "Total tests:  $total<BR>";
	echo "Passed tests: $pass<BR><BR>";

	// Define Prodigy browsers
	echo "Setting up list of Prodigy browsers<BR>";
	
	$prodigy=array(
	"[PRODIGY-WB/3.2b*]",
	"[PRODIGY-WB/3.2d*]");

	$total=count($prodigy);
	$pass=0;
	echo "<hr>";
	echo "<h2>Prodigy Tests</h2>";
	foreach ($prodigy as $key=>$value) {
		$fred=detect_browser($link_id,$prodigy[$key]);
		echo "<table width='100%' cellpadding='0' cellspacing='0' border='1'>";
		echo "<tr colspan='3'>";
		echo "<td>$prodigy[$key]</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='50%'>$fred[1]</td><td width='25%'>$fred[2]</td><td width='25%'>$fred[0]</td>";
		echo "</tr>";
		echo "</tr>";
		echo "</table><BR>";
		
		if ($fred[0]!='unknown' && $fred[1]!='unknown' && $fred[2]!='unknown') $pass++;
	}
	echo "Total tests:  $total<BR>";
	echo "Passed tests: $pass<BR><BR>";

	// Define HotJava browsers
	echo "Setting up list of HotJava browsers<BR>";
	
	$hotjava=array(
	"[HotJava/1.0p1/JRE1.1.1*]");

	$total=count($hotjava);
	$pass=0;
	echo "<hr>";
	echo "<h2>HotJava Tests</h2>";
	foreach ($hotjava as $key=>$value) {
		$fred=detect_browser($link_id,$hotjava[$key]);
		echo "<table width='100%' cellpadding='0' cellspacing='0' border='1'>";
		echo "<tr colspan='3'>";
		echo "<td>$hotjava[$key]</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='50%'>$fred[1]</td><td width='25%'>$fred[2]</td><td width='25%'>$fred[0]</td>";
		echo "</tr>";
		echo "</tr>";
		echo "</table><BR>";
		
		if ($fred[0]!='unknown' && $fred[1]!='unknown' && $fred[2]!='unknown') $pass++;
	}
	echo "Total tests:  $total<BR>";
	echo "Passed tests: $pass<BR><BR>";

	// Define Opera browsers
	echo "Setting up list of Opera browsers<BR>";
	
	$opera=array(
	"[Mozilla/3.0 (compatible; Opera/3.0; windows 3.1)*]",
	"[Mozilla/3.0 (compatible; Opera/3.0; Windows 95/NT)*]",
	"[Mozilla/3.0 (compatible; Opera/3.0b8; Windows 95/NT)*]");
	
	$total=count($opera);
	$pass=0;
	echo "<hr>";
	echo "<h2>Opera Tests</h2>";
	foreach ($opera as $key=>$value) {
		$fred=detect_browser($link_id,$opera[$key]);
		echo "<table width='100%' cellpadding='0' cellspacing='0' border='1'>";
		echo "<tr colspan='3'>";
		echo "<td>$opera[$key]</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='50%'>$fred[1]</td><td width='25%'>$fred[2]</td><td width='25%'>$fred[0]</td>";
		echo "</tr>";
		echo "</tr>";
		echo "</table><BR>";
		
		if ($fred[0]!='unknown' && $fred[1]!='unknown' && $fred[2]!='unknown') $pass++;
	}
	echo "Total tests:  $total<BR>";
	echo "Passed tests: $pass<BR><BR>";

    	// Define WebTV browsers
	echo "Setting up list of WebTV browsers<BR>";
	
	$webtv=array(
	"[Mozilla/3.0 WebTV/1.2 (compatible; MSIE 2.0)*]",
	"[Mozilla/1.22 WebTV/1.0 (compatible; MSIE 2.0)*]");
	
	$total=count($webtv);
	$pass=0;
	echo "<hr>";
	echo "<h2>WebTV Tests</h2>";
	foreach ($webtv as $key=>$value) {
		$fred=detect_browser($link_id,$webtv[$key]);
		echo "<table width='100%' cellpadding='0' cellspacing='0' border='1'>";
		echo "<tr colspan='3'>";
		echo "<td>$webtv[$key]</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='50%'>$fred[1]</td><td width='25%'>$fred[2]</td><td width='25%'>$fred[0]</td>";
		echo "</tr>";
		echo "</tr>";
		echo "</table><BR>";
		
		if ($fred[0]!='unknown' && $fred[1]!='unknown' && $fred[2]!='unknown') $pass++;
	}
	echo "Total tests:  $total<BR>";
	echo "Passed tests: $pass<BR><BR>";
	
	// Define WebTV browsers
	echo "Setting up list of Netbox browsers<BR>";
	$netbox=array(
	"[Mozilla/3.01 (compatible; Netbox/3.5 R93rc3; Linux 2.2)]");

	$total=count($netbox);
	$pass=0;
	echo "<hr>";
	echo "<h2>Netbox Tests</h2>";
	foreach ($netbox as $key=>$value) {
		$fred=detect_browser($link_id,$netbox[$key]);
		echo "<table width='100%' cellpadding='0' cellspacing='0' border='1'>";
		echo "<tr colspan='3'>";
		echo "<td>$netbox[$key]</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='50%'>$fred[1]</td><td width='25%'>$fred[2]</td><td width='25%'>$fred[0]</td>";
		echo "</tr>";
		echo "</tr>";
		echo "</table><BR>";
		
		if ($fred[0]!='unknown' && $fred[1]!='unknown' && $fred[2]!='unknown') $pass++;
	}
	echo "Total tests:  $total<BR>";
	echo "Passed tests: $pass<BR><BR>";

?>