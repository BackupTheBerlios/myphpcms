Browser idnetification system for use with dynamic websites
+---------------------------------------------------------+

README
------

Version 0.2 05 November 2001 - Philip Lee

Files:  $SITE_ROOT/libs/lib_browser.php
       
Tables: none
        
Introduction
+----------+

Since the major browser producers have chosen not to stick rigidly to the
HTML standard but have developed their own interpretations it can be vitally
important to detect the browser version so as to generate the correct HTML to
make a page appear correctly.  Even if this requirement is not important, it
can still be usefult to determine not only the browser commonly used to view 
the site but also whether any crawlers have visited.

Browsers use a User Agent String to identify themselves to web servers.  Sadly
the format of this string is not completely rigid as an examination of the
following sections will suggest !  However, all is not lost as there are fairly
foolproof ways to identify the browser in question.

The browser detection library uses the following methodology to identify the 
browsers platform:

	1) check for some indication that we're using windows (Win, 16bit, 95, 4.9)
	2) otherwise check for Mac (Mac, apple, 68)
	3) otherwise check for *nix (to many too list)
	4) failing that say that it's unknown !
	
We then check for the browser itself:

	1) does the user agent string contain the word 'Mozilla' ?
	2) if not, does it contain the word 'lynx' ?
	3) if not it must be some kind of robot
	
	otherwise
			
	4) does it contain MSIE ?  If yes, then a flavour of IE
	5) does it contain Opera ?  If yes, then some flavour of the Opera browser

Browsers identified
+-----------------+

List 'borrowed' from the latest version of BrowserHawk from
http://www.cyscape.com/browserhawk/ updated: 22/10/2001

    Netscape
    --------
    Netscape v1:                Mozilla/1.*
    Netscape v2:                Mozilla/2.*
    Netscape v3:                Mozilla/3.*
    Netscape v4:                Mozilla/4.*
    Netscape v4.06-v4.09:       Mozilla/4.0[6-9]*
    Netscape v4.10->    :       Mozilla/4.[1-9]*
    Netscape v5:                Mozilla/[56].*
    Netscape v6:                Mozilla*/WinNT*[345]*Netscape[6-9]/*

    User agent strings from browscap.ini (not totally up to date) plus STM
    logging system:

	[Mozilla/4.0b1 (Win95; I)*]
	[Mozilla/4.0b1 (WinNT; I)*]
	[Mozilla/4.0b2 (Win95; I)*]
	[Mozilla/4.0b2 (WinNT; I)*]
	[Mozilla/4.0 * (WinNT; I)]
	[Mozilla/4.0 * (WinNT; U)]
	[Mozilla/4.0 * (Win95; I)]
	[Mozilla/4.0 * (Win95; U)]
	[Mozilla/4.01 * (WinNT; I)]
	[Mozilla/4.01 * (WinNT; U)]
	[Mozilla/4.01 * (Win95; I)]
	[Mozilla/4.01 * (Win95; U)]
	[Mozilla/4.01 (Macintosh; I; 68K)*]
	[Mozilla/4.01 * (Macintosh; I; 68K)]
	[Mozilla/4.01 (Macintosh; I; MacPPC)*]
	[Mozilla/4.01 * (Macintosh; I; MacPPC)]
	[Mozilla/4.01a (Macintosh; I; 68K)*]
	[Mozilla/4.01a * (Macintosh; I; 68K)]
	[Mozilla/4.01a (Macintosh; I; MacPPC)*]
	[Mozilla/4.01a * (Macintosh; I; MacPPC)]
	[Mozilla/4.01a (Macintosh; I; PPC)*]
	[Mozilla/4.01a * (Macintosh; I; PPC)]
	[Mozilla/4.01 * (Win16; I)]
	[Mozilla/4.01 * (Win16; U)]
	[Mozilla/4.0 * (Macintosh; I; PPC)]
	[Mozilla/4.01 * (Macintosh; I; PPC)]
	[Mozilla/4.0 (WinNT; I)*]
	[Mozilla/4.0 (WinNT; U)*]
	[Mozilla/4.0 (Win95; I)*]
	[Mozilla/4.0 (Win95; U)*]
	[Mozilla/4.0 (Win95)*]
	[Mozilla/4.01 (WinNT; I)*]
	[Mozilla/4.01 (WinNT; U)*]
	[Mozilla/4.01 (Win95; I)*]
	[Mozilla/4.01 (Win95; U)*]
	[Mozilla/4.01 (Win16; I)*]
	[Mozilla/4.01 (Win16; U)*]
	[Mozilla/4.0 (Macintosh; I; PPC)*]
	[Mozilla/4.01 (Macintosh; I; PPC)*]
	[Mozilla/4.02 * (WinNT; I)]
	[Mozilla/4.02 * (WinNT; U)]
	[Mozilla/4.02 * (Win95; I)]
	[Mozilla/4.02 * (Win95; U)]
	[Mozilla/4.02 (Macintosh; I; 68K)*]
	[Mozilla/4.02 * (Macintosh; I; 68K)]
	[Mozilla/4.02 (Macintosh; I; MacPPC)*]
	[Mozilla/4.02 * (Macintosh; I; MacPPC)]
	[Mozilla/4.02 * (Win16; I)]
	[Mozilla/4.02 * (Win16; U)]
	[Mozilla/4.02 * (Macintosh; I; PPC)]
	[Mozilla/4.02 (WinNT; I)*]
	[Mozilla/4.02 (WinNT; U)*]
	[Mozilla/4.02 (Win95; I)*]
	[Mozilla/4.02 (Win95; U)*]
	[Mozilla/4.02 (Win16; I)*]
	[Mozilla/4.02 (Win16; U)*]
	[Mozilla/4.02 * (WinNT; I ;Nav)]
	[Mozilla/4.02 * (WinNT; U ;Nav)]
	[[Mozilla/4.02 * (Win95; I ;Nav)]
	[Mozilla/4.02 * (Win95; U ;Nav)]
	[Mozilla/4.02 (Macintosh; I ;Nav; 68K)*]
	[Mozilla/4.02 * (Macintosh; I ;Nav; 68K)]
	[Mozilla/4.02 (Macintosh; I ;Nav; MacPPC)*]
	[Mozilla/4.02 * (Macintosh; I ;Nav; MacPPC)]
	[Mozilla/4.02 * (Win16; I ;Nav)]
	[Mozilla/4.02 * (Win16; U ;Nav)]
	[Mozilla/4.02 * (Macintosh; I ;Nav; PPC)]
	[Mozilla/4.02 (WinNT; I ;Nav)*]
	[Mozilla/4.02 (WinNT; U ;Nav)*]
	[Mozilla/4.02 (Win95; I ;Nav)*]
	[Mozilla/4.02 (Win95; U ;Nav)*]
	[Mozilla/4.02 (Win16; I ;Nav)*]
	[Mozilla/4.02 (Win16; U ;Nav)*]
	[Mozilla/4.02 * (X11; I; IRIX64 6.2 IP21)]
	[Mozilla/4.02 * (X11; U; SunOS 5.5.1 sun4u)]
	[Mozilla/4.03 * (WinNT; I)]
	[Mozilla/4.03 * (WinNT; U)]
	[Mozilla/4.03 * (Win95; I)]
	[Mozilla/4.03 * (Win95; U)]
	[Mozilla/4.03 (Macintosh; I; 68K)*]
	[Mozilla/4.03 * (Macintosh; I; 68K)]
	[Mozilla/4.03 (Macintosh; I; MacPPC)*]
	[Mozilla/4.03 * (Macintosh; I; MacPPC)]
	[Mozilla/4.03 (Macintosh; I; PPC)]
	[Mozilla/4.03 * (Macintosh; I; PPC)]
	[Mozilla/4.03 (Macintosh; I; PPC, Nav)*]
	[Mozilla/4.03 * (Win16; I)]
	[Mozilla/4.03 * (Win16; U)]
	[Mozilla/4.03 (WinNT; I)*]
	[Mozilla/4.03 (WinNT; U)*]
	[Mozilla/4.03 (Win95; I)*]
	[Mozilla/4.03 (Win95; U)*]
	[Mozilla/4.03 (Win16; I)*]
	[Mozilla/4.03 (Win16; U)*]
	[Mozilla/4.03 * (WinNT; I ;Nav)]
	[Mozilla/4.03 * (WinNT; U ;Nav)]
	[Mozilla/4.03 * (Win95; I ;Nav)]
	[Mozilla/4.03 * (Win95; U ;Nav)]
	[Mozilla/4.03 (Macintosh; I ;Nav; 68K)*]
	[Mozilla/4.03 * (Macintosh; I ;Nav; 68K)]
	[Mozilla/4.03 (Macintosh; I ;Nav; MacPPC)*]
	[Mozilla/4.03 * (Macintosh; I ;Nav; MacPPC)]
	[Mozilla/4.03 * (Win16; I ;Nav)]
	[Mozilla/4.03 * (Win16; U ;Nav)]
	[Mozilla/4.03 * (Macintosh; I ;Nav; PPC)]
	[Mozilla/4.03 (WinNT; I ;Nav)*]
	[Mozilla/4.03 (WinNT; U ;Nav)*]
	[Mozilla/4.03 (Win95; I ;Nav)*]
	[Mozilla/4.03 (Win95; U ;Nav)*]
	[Mozilla/4.03 (Win16; I ;Nav)*]
	[Mozilla/4.03 (Win16; U ;Nav)*]
	[Mozilla/4.04 * (WinNT; I)]
	[Mozilla/4.04 * (WinNT; U)]
	[Mozilla/4.04 * (Win95; I)]
	[Mozilla/4.04 * (Win95; U)]
	[Mozilla/4.04 (Macintosh; I; 68K)*]
	[Mozilla/4.04 * (Macintosh; I; 68K)]
	[Mozilla/4.04 (Macintosh; I; MacPPC)*]
	[Mozilla/4.04 * (Macintosh; I; MacPPC)]
	[Mozilla/4.04 (Macintosh; I; PPC)]
	[Mozilla/4.04 * (Macintosh; I; PPC)]
	[Mozilla/4.04 (Macintosh; I; PPC, Nav)*]
	[Mozilla/4.04 * (Win16; I)]
	[Mozilla/4.04 * (Win16; U)]
	[Mozilla/4.04 (WinNT; I)*]
	[Mozilla/4.04 (WinNT; U)*]
	[Mozilla/4.04 (Win95; I)*]
	[Mozilla/4.04 (Win95; U)*]
	[Mozilla/4.04 (Win16; I)*]
	[Mozilla/4.04 (Win16; U)*]
	[Mozilla/4.04 * (WinNT; I ;Nav)]
	[Mozilla/4.04 * (WinNT; U ;Nav)]
	[Mozilla/4.04 * (Win95; I ;Nav)]
	[Mozilla/4.04 * (Win95; U ;Nav)]
	[Mozilla/4.04 (Macintosh; I ;Nav; 68K)*]
	[Mozilla/4.04 * (Macintosh; I ;Nav; 68K)]
	[Mozilla/4.04 (Macintosh; I ;Nav; MacPPC)*]
	[Mozilla/4.04 * (Macintosh; I ;Nav; MacPPC)]
	[Mozilla/4.04 * (Win16; I ;Nav)]
	[Mozilla/4.04 * (Win16; U ;Nav)]
	[Mozilla/4.04 * (Macintosh; I ;Nav; PPC)]
	[Mozilla/4.04 (WinNT; I ;Nav)*]
	[Mozilla/4.04 (WinNT; U ;Nav)*]
	[Mozilla/4.04 (Win95; I ;Nav)*]
	[Mozilla/4.04 (Win95; U ;Nav)*]
	[Mozilla/4.04 (Win16; I ;Nav)*]
	[Mozilla/4.04 (Win16; U ;Nav)*]
	[Mozilla/4.04b9 * (WinNT; I)]
	[Mozilla/4.04b9 * (WinNT; U)]
	[Mozilla/4.04b9 * (Win95; I)]
	[Mozilla/4.04b9 * (Win95; U)]
	[Mozilla/4.05 * (WinNT; I)]
	[Mozilla/4.05 * (WinNT; U)]
	[Mozilla/4.05 * (Win95; I)]
	[Mozilla/4.05 * (Win95; U)]
	[Mozilla/4.05 (Macintosh; I; 68K)*]
	[Mozilla/4.05 * (Macintosh; I; 68K)]
	[Mozilla/4.05 (Macintosh; I; MacPPC)*]
	[Mozilla/4.05 * (Macintosh; I; MacPPC)]
	[Mozilla/4.05 (Macintosh; I; PPC)]
	[Mozilla/4.05 * (Macintosh; I; PPC)]
	[Mozilla/4.05 (Macintosh; I; PPC, Nav)*]
	[Mozilla/4.05 * (Win16; I)]
	[Mozilla/4.05 * (Win16; U)]
	[Mozilla/4.05 (WinNT; I)*]
	[Mozilla/4.05 (WinNT; U)*]
	[Mozilla/4.05 (Win95; I)*]
	[Mozilla/4.05 (Win95; U)*]
	[Mozilla/4.05 (Win16; I)*]
	[Mozilla/4.05 (Win16; U)*]
	[Mozilla/4.06 * (WinNT; I)]
	[Mozilla/4.06 * (WinNT; U)]
	[Mozilla/4.06 * (Win95; I)]
	[Mozilla/4.06 * (Win95; U)]
	[Mozilla/4.06 (Macintosh; I; 68K)*]
	[Mozilla/4.06 * (Macintosh; I; 68K)]
	[Mozilla/4.06 (Macintosh; I; MacPPC)*]
	[Mozilla/4.06 * (Macintosh; I; MacPPC)]
	[Mozilla/4.06 (Macintosh; I; PPC)]
	[Mozilla/4.06 * (Macintosh; I; PPC)]
	[Mozilla/4.06 (Macintosh; I; PPC, Nav)*]
	[Mozilla/4.06 * (Win16; I)]
	[Mozilla/4.06 * (Win16; U)]
	[Mozilla/4.06 (WinNT; I)*]
	[Mozilla/4.06 (WinNT; U)*]
	[Mozilla/4.06 (Win95; I)*]
	[Mozilla/4.06 (Win95; U)*]
	[Mozilla/4.06 (Win16; I)*]
	[Mozilla/4.06 (Win16; U)*]
	[Mozilla/4.07 * (WinNT; I)]
	[Mozilla/4.07 * (WinNT; U)]
	[Mozilla/4.07 * (Win95; I)]
	[Mozilla/4.07 * (Win95; U)]
	[Mozilla/4.07 (Macintosh; I; 68K)*]
	[Mozilla/4.07 * (Macintosh; I; 68K)]
	[Mozilla/4.07 (Macintosh; I; MacPPC)*]
	[Mozilla/4.07 * (Macintosh; I; MacPPC)]
	[Mozilla/4.07 (Macintosh; I; PPC)]
	[Mozilla/4.07 * (Macintosh; I; PPC)]
	[Mozilla/4.07 (Macintosh; I; PPC, Nav)*]
	[Mozilla/4.07 * (Win16; I)]
	[Mozilla/4.07 * (Win16; U)]
	[Mozilla/4.07 (WinNT; I)*]
	[Mozilla/4.07 (WinNT; U)*]
	[Mozilla/4.07 (Win95; I)*]
	[Mozilla/4.07 (Win95; U)*]
	[Mozilla/4.07 (Win16; I)*]
	[Mozilla/4.07 (Win16; U)*]
	[Mozilla/4.5 * (WinNT; U)]
	[Mozilla/4.5 * (WinNT; I)]
	[Mozilla/4.5 (WinNT; U)*]
	[Mozilla/4.5 (WinNT; I)*]
	[Mozilla/4.5 * (Win95; U)]
	[Mozilla/4.5 * (Win95; I)]
	[Mozilla/4.5 (Win95; U)*]
	[Mozilla/4.5 (Win95; I)*]
	[Mozilla/4.5 * (Win98; U)]
	[Mozilla/4.5 * (Win98; I)]
	[Mozilla/4.5 (Win98; U)*]
	[Mozilla/4.5 (Win98; I)*]
	[Mozilla/4.5 (Macintosh; I; PPC)*]
	[Mozilla/4.5 (Macintosh; I; 68K)*]
	[Mozilla/4.5 * (Macintosh; I; PPC)]
	[Mozilla/4.5 * (Macintosh; I; 68K)]
	[Mozilla/4.5 * (Win16; U)]
	[Mozilla/4.5 * (Win16; I)]
	[Mozilla/4.5 (Win16; U)*]
	[Mozilla/4.5 (Win16; I)*]
	[Mozilla/4.6 * (WinNT; U)]
	[Mozilla/4.6 * (WinNT; I)]
	[Mozilla/4.6 (WinNT; U)*]
	[Mozilla/4.6 (WinNT; I)*]
	[Mozilla/4.6 * (Win95; U)]
	[Mozilla/4.6 * (Win95; I)]
	[Mozilla/4.6 (Win95; U)*]
	[Mozilla/4.6 (Win95; I)*]
	[Mozilla/4.6 * (Win98; U)]
	[Mozilla/4.6 * (Win98; I)]
	[Mozilla/4.6 (Win98; U)*]
	[Mozilla/4.6 (Win98; I)*]
	[Mozilla/4.6 (Macintosh; I; PPC)*]
	[Mozilla/4.6 (Macintosh; I; 68K)*]
	[Mozilla/4.6 * (Macintosh; I; PPC)]
	[Mozilla/4.6 * (Macintosh; I; 68K)]
	[Mozilla/4.6 * (Win16; U)]
	[Mozilla/4.6 * (Win16; I)]
	[Mozilla/4.6 (Win16; U)*]
	[Mozilla/4.6 (Win16; I)*]
	[Mozilla/4.7 * (WinNT; U)]
	[Mozilla/4.7 * (WinNT; I)]
	[Mozilla/4.7 (WinNT; U)*]
	[Mozilla/4.7 (WinNT; I)*]
	[Mozilla/4.7 * (Win95; U)]
	[Mozilla/4.7 * (Win95; I)]
	[Mozilla/4.7 (Win95; U)*]
	[Mozilla/4.7 (Win95; I)*]
	[Mozilla/4.7 * (Win98; U)]
	[Mozilla/4.7 * (Win98; I)]
	[Mozilla/4.7 (Win98; U)*]
	[Mozilla/4.7 (Win98; I)*]
	[Mozilla/4.7 (Macintosh; I; PPC)*]
	[Mozilla/4.7 (Macintosh; I; 68K)*]
	[Mozilla/4.7 * (Macintosh; I; PPC)]
	[Mozilla/4.7 * (Macintosh; I; 68K)]
	[Mozilla/4.7 * (Win16; U)]
	[Mozilla/4.7 * (Win16; I)]
	[Mozilla/4.7 (Win16; U)*]
	[Mozilla/4.7 (Win16; I)*]
	[Mozilla/4.71 * (WinNT; U)]
	[Mozilla/4.71 * (WinNT; I)]
	[Mozilla/4.71 (WinNT; U)*]
	[Mozilla/4.71 (WinNT; I)*]
	[Mozilla/4.71 * (Win95; U)]
	[Mozilla/4.71 * (Win95; I)]
	[Mozilla/4.71 (Win95; U)*]
	[Mozilla/4.71 (Win95; I)*]
	[Mozilla/4.71 * (Win98; U)]
	[Mozilla/4.71 * (Win98; I)]
	[Mozilla/4.71 (Win98; U)*]
	[Mozilla/4.71 (Win98; I)*]
	[Mozilla/4.71 (Macintosh; I; PPC)*]
	[Mozilla/4.71 (Macintosh; I; 68K)*]
	[Mozilla/4.71 * (Macintosh; I; PPC)]
	[Mozilla/4.71 * (Macintosh; I; 68K)]
	[Mozilla/4.71 * (Win16; U)]
	[Mozilla/4.71 * (Win16; I)]
	[Mozilla/4.71 (Win16; U)*]
	[Mozilla/4.71 (Win16; I)*]
	[Mozilla/4.5b1 * (WinNT; U)]
	[Mozilla/4.5b1 * (WinNT; I)]
	[Mozilla/4.5b1 (WinNT; U)*]
	[Mozilla/4.5b1 (WinNT; I)*]
	[Mozilla/4.5b1 * (Win95; U)]
	[Mozilla/4.5b1 * (Win95; I)]
	[Mozilla/4.5b1 (Win95; U)*]
	[Mozilla/4.5b1 (Win95; I)*]
	[Mozilla/4.5b1 * (Win98; U)]
	[Mozilla/4.5b1 * (Win98; I)]
	[Mozilla/4.5b1 (Win98; U)*]
	[Mozilla/4.5b1 (Win98; I)*]
	[Mozilla/4.5b1 (Macintosh; I; PPC)*]
	[Mozilla/4.5b1 (Macintosh; I; 68K)*]
	[Mozilla/4.5b1 * (Macintosh; I; PPC)]
	[Mozilla/4.5b1 * (Macintosh; I; 68K)]
	[Mozilla/4.5b1 * (Win16; U)]
	[Mozilla/4.5b1 * (Win16; I)]
	[Mozilla/4.5b1 (Win16; U)*]
	[Mozilla/4.5b1 (Win16; I)*]
	[Mozilla/4.5b2 * (WinNT; U)]
	[Mozilla/4.5b2 * (WinNT; I)]
	[Mozilla/4.5b2 (WinNT; U)*]
	[Mozilla/4.5b2 (WinNT; I)*]
	[Mozilla/4.5b2 * (Win95; U)]
	[Mozilla/4.5b2 * (Win95; I)]
	[Mozilla/4.5b2 (Win95; U)*]
	[Mozilla/4.5b2 (Win95; I)*]
	[Mozilla/4.5b2 * (Win98; U)]
	[Mozilla/4.5b2 * (Win98; I)]
	[Mozilla/4.5b2 (Win98; U)*]
	[Mozilla/4.5b2 (Win98; I)*]
	[Mozilla/4.5b2 (Macintosh; I; PPC)*]
	[Mozilla/4.5b2 (Macintosh; I; 68K)*]
	[Mozilla/4.5b2 * (Macintosh; I; PPC)]
	[Mozilla/4.5b2 * (Macintosh; I; 68K)]
	[Mozilla/4.5b2 * (Win16; U)]
	[Mozilla/4.5b2 * (Win16; I)]
	[Mozilla/4.5b2 (Win16; U)*]
	[Mozilla/4.5b2 (Win16; I)*]
	[Mozilla/4.0b3 * (WinNT; I)]
	[Mozilla/4.0b3 * (WinNT; U)]
	[Mozilla/4.0b3 * (Win95; I)]
	[Mozilla/4.0b3 * (Win95; U)]
	[Mozilla/4.0b3 * (Macintosh; I; PPC)]
	[Mozilla/4.03 * (X11; I; AIX 4.1)]
	[Mozilla/4.03 * (X11; I; Linux 2.0.29 i586)]
	[Mozilla/4.03 * (X11; I; SunOS 5.5 sun4m)]
	[Mozilla/4.0b4 * (WinNT; I)]
	[Mozilla/4.0b4 * (WinNT; U)]
	[Mozilla/4.0b4 * (Win95; I)]
	[Mozilla/4.0b4 * (Win95; U)]
	[Mozilla/4.0b4 (Macintosh; I; PPC)]
	[Mozilla/4.0b5 * (WinNT; I)]
	[Mozilla/4.0b5 * (WinNT; U)]
	[Mozilla/4.0b5 * (Win95; I)]
	[Mozilla/4.0b5 * (Win95; U)]
	[Mozilla/4.0b5 (Macintosh; I; PPC)*]
	[Mozilla/3.01Gold * (Win95; I; 16bit)]
	[Mozilla/3.01Gold * (Win95; I)]
	[Mozilla/3.01Gold * (Win95; U)]
	[Mozilla/3.01Gold * (WinNT; I)]
	[Mozilla/3.01Gold * (WinNT; U)]
	[Mozilla/3.01Gold * (Win16; I)]
	[Mozilla/3.01Gold * (Win16; U)]
	[Mozilla/3.01Gold * (Macintosh; I; 68K)]
	[Mozilla/3.01Gold * (Macintosh; U; 68K)]
	[Mozilla/3.01Gold * (Macintosh; I; PPC)]
	[Mozilla/3.01Gold * (Macintosh; U; PPC)]
	[Mozilla/3.01Gold (X11; I; SunOS *)]
	[Mozilla/3.01Gold (X11; I; AIX 1)*]
	[Mozilla/3.02Gold * (Win95; I; 16bit)]
	[Mozilla/3.02Gold (Win95; I)*]
	[Mozilla/3.02Gold * (Win95; I)]
	[Mozilla/3.02Gold * (Win95; U)]
	[Mozilla/3.02Gold * (WinNT; I)]
	[Mozilla/3.02Gold * (WinNT; U)]
	[Mozilla/3.02Gold (WinNT; I)*]
	[Mozilla/3.02Gold (WinNT; U)*]
	[Mozilla/3.02Gold * (Win16; I)]
	[Mozilla/3.02Gold * (Win16; U)]
	[Mozilla/3.02Gold * (Macintosh; I; 68K)]
	[Mozilla/3.02Gold * (Macintosh; U; 68K)]
	[Mozilla/3.02Gold * (Macintosh; I; PPC)]
	[Mozilla/3.02Gold * (Macintosh; U; PPC)]
	[Mozilla/3.03Gold * (Win95; I; 16bit)]
	[Mozilla/3.03Gold * (Win95; I)]
	[Mozilla/3.03Gold * (Win95; U)]
	[Mozilla/3.03Gold * (WinNT; I)]
	[Mozilla/3.03Gold * (WinNT; U)]
	[Mozilla/3.03Gold (WinNT; I)*]
	[Mozilla/3.03Gold (WinNT; U)*]
	[Mozilla/3.03Gold (Win95; I)*]
	[Mozilla/3.03Gold (Win95; U)*]
	[Mozilla/3.03Gold * (Win16; I)]
	[Mozilla/3.03Gold * (Win16; U)]
	[Mozilla/3.03Gold * (Macintosh; I; 68K)]
	[Mozilla/3.03Gold * (Macintosh; U; 68K)]
	[Mozilla/3.03Gold * (Macintosh; I; PPC)]
	[Mozilla/3.03Gold * (Macintosh; U; PPC)]
	[Mozilla/3.04Gold * (Win95; I; 16bit)]
	[Mozilla/3.04Gold * (Win95; I)]
	[Mozilla/3.04Gold * (Win95; U)]
	[Mozilla/3.04Gold * (WinNT; I)]
	[Mozilla/3.04Gold * (WinNT; U)]
	[Mozilla/3.04Gold (WinNT; I)*]
	[Mozilla/3.04Gold (WinNT; U)*]
	[Mozilla/3.04Gold (Win95; I)*]
	[Mozilla/3.04Gold (Win95; U)*]
	[Mozilla/3.04Gold * (Win16; I)]
	[Mozilla/3.04Gold * (Win16; U)]
	[Mozilla/3.04Gold * (Macintosh; I; 68K)]
	[Mozilla/3.04Gold * (Macintosh; U; 68K)]
	[Mozilla/3.04Gold * (Macintosh; I; PPC)]
	[Mozilla/3.04Gold * (Macintosh; U; PPC)]
	[Mozilla/3.01GoldC-HWY1SE (Win95; I)*]
	[Mozilla/3.01GoldC-PBWF (Win95; I)*]
	[Mozilla/3.01b1Gold * (Win95; I)]
	[Mozilla/3.01b1Gold * (Win95; U)]
	[Mozilla/3.01b1Gold * (WinNT; I)]
	[Mozilla/3.01b1Gold * (WinNT; U)]
	[Mozilla/3.01b1Gold * (Win16; I)]
	[Mozilla/3.01b1Gold * (Win16; U)]
	[Mozilla/3.01b1Gold * (Macintosh; I; 68K)]
	[Mozilla/3.01b1Gold * (Macintosh; U; 68K)]
	[Mozilla/3.01b1Gold * (Macintosh; I; PPC)]
	[Mozilla/3.01b1Gold * (Macintosh; U; PPC)]
	[Mozilla/3.01 * (Win95; I; 16bit)]
	[Mozilla/3.01 * (Win95; I)]
	[Mozilla/3.01 * (Win95; U)]
	[Mozilla/3.01 * (WinNT; I)]
	[Mozilla/3.01 * (WinNT; U)]
	[Mozilla/3.01 * (Win16; I)]
	[Mozilla/3.01 * (Win16; U)]
	[Mozilla/3.01 * (Macintosh; I; 68K)]
	[Mozilla/3.01 * (Macintosh; U; 68K)]
	[Mozilla/3.01 * (Macintosh; I; PPC)]
	[Mozilla/3.01 * (Macintosh; U; PPC)]
	[Mozilla/3.02 (WinNT; I)*]
	[Mozilla/3.02 (WinNT; U)*]
	[Mozilla/3.02 (Win95; I)*]
	[Mozilla/3.02 (Win95; U)*]
	[Mozilla/3.02 (Macintosh; I; PPC)*]
	[Mozilla/3.02 (Macintosh; U; PPC)*]
	[Mozilla/3.02 (Macintosh; I; 68k)*]
	[Mozilla/3.02 (Macintosh; U; 68k)*]
	[Mozilla/3.02 * (WinNT; I)]
	[Mozilla/3.02 * (WinNT; U)]
	[Mozilla/3.02 * (Win95; I)]
	[Mozilla/3.02 * (Win95; U)]
	[Mozilla/3.02 * (Macintosh; I; PPC)]
	[Mozilla/3.02 * (Macintosh; U; PPC)]
	[Mozilla/3.02 * (Macintosh; I; 68k)]
	[Mozilla/3.02 * (Macintosh; U; 68k)]
	[Mozilla/3.03 * (Win16; I)]
	[Mozilla/3.03 * (Win16; U)]
	[Mozilla/3.03 * (Win95; I; 16bit)]
	[Mozilla/3.03 * (Win95; I)]
	[Mozilla/3.03 * (Win95; U)]
	[Mozilla/3.03 * (WinNT; I)]
	[Mozilla/3.03 * (WinNT; U)]
	[Mozilla/3.03 * (Macintosh; I; 68K)]
	[Mozilla/3.03 * (Macintosh; U; 68K)]
	[Mozilla/3.03 * (Macintosh; I; PPC)]
	[Mozilla/3.03 * (Macintosh; U; PPC)]
	[Mozilla/3.03 (Win16; I)*]
	[Mozilla/3.03 (Win16; U)*]
	[Mozilla/3.03 (Win95; I; 16bit)*]
	[Mozilla/3.03 (Win95; I)*]
	[Mozilla/3.03 (Win95; U)*]
	[Mozilla/3.03 (WinNT; I)*]
	[Mozilla/3.03 (WinNT; U)*]
	[Mozilla/3.03 (Macintosh; I; 68K)*]
	[Mozilla/3.03 (Macintosh; U; 68K)*]
	[Mozilla/3.03 (Macintosh; I; PPC)*]
	[Mozilla/3.03 (Macintosh; U; PPC)*]
	[Mozilla/3.04 * (Win95; I; 16bit)]
	[Mozilla/3.04 * (Win95; I)]
	[Mozilla/3.04 * (Win95; U)]
	[Mozilla/3.04 * (WinNT; I)]
	[Mozilla/3.04 * (WinNT; U)]
	[Mozilla/3.04 * (Win16; I)]
	[Mozilla/3.04 * (Win16; U)]
	[Mozilla/3.04 * (Macintosh; I; 68K)]
	[Mozilla/3.04 * (Macintosh; U; 68K)]
	[Mozilla/3.04 * (Macintosh; I; PPC)]
	[Mozilla/3.04 * (Macintosh; U; PPC)]
	[Mozilla/3.04 (Win95; I; 16bit)*]
	[Mozilla/3.04 (Win95; I)*]
	[Mozilla/3.04 (Win95; U)*]
	[Mozilla/3.04 (WinNT; I)*]
	[Mozilla/3.04 (WinNT; U)*]
	[Mozilla/3.04 (Win16; I)*]
	[Mozilla/3.04 (Win16; U)*]
	[Mozilla/3.04 (Macintosh; I; 68K)*]
	[Mozilla/3.04 (Macintosh; U; 68K)*]
	[Mozilla/3.04 (Macintosh; I; PPC)*]
	[Mozilla/3.04 (Macintosh; U; PPC)*]
	[Mozilla/3.01Gold (Win95; I; 16bit)*]
	[Mozilla/3.01Gold (Win95; I)*]
	[Mozilla/3.01Gold (Win95; U)*]
	[Mozilla/3.01Gold (WinNT; I)*]
	[Mozilla/3.01Gold (WinNT; U)*]
	[Mozilla/3.01Gold (Win16; I)*]
	[Mozilla/3.01Gold (Win16; U)*]
	[Mozilla/3.01Gold (Macintosh; I; 68K)*]
	[Mozilla/3.01Gold (Macintosh; U; 68K)*]
	[Mozilla/3.01Gold (Macintosh; I; PPC)*]
	[Mozilla/3.01Gold (Macintosh; U; PPC)*]
	[Mozilla/3.01b1Gold (Win95; I)*]
	[Mozilla/3.01b1Gold (Win95; U)*]
	[Mozilla/3.01b1Gold (WinNT; I)*]
	[Mozilla/3.01b1Gold (WinNT; U)*]
	[Mozilla/3.01b1Gold (Win16; I)*]
	[Mozilla/3.01b1Gold (Win16; U)*]
	[Mozilla/3.01b1Gold (Macintosh; I; 68K)*]
	[Mozilla/3.01b1Gold (Macintosh; U; 68K)*]
	[Mozilla/3.01b1Gold (Macintosh; I; PPC)*]
	[Mozilla/3.01b1Gold (Macintosh; U; PPC)*]
	[Mozilla/3.01 (Win95; I; 16bit)*]
	[Mozilla/3.01 (Win95; I)*]
	[Mozilla/3.01 (Win95; U)*]
	[Mozilla/3.01 (WinNT; I)*]
	[Mozilla/3.01 (WinNT; U)*]
	[Mozilla/3.01 (Win16; I)*]
	[Mozilla/3.01 (Win16; U)*]
	[Mozilla/3.01 (Macintosh; I; 68K)*]
	[Mozilla/3.01 (Macintosh; U; 68K)*]
	[Mozilla/3.01 (Macintosh; I; PPC)*]
	[Mozilla/3.01C* (Win95; U)]
	[Mozilla/3.01C* (Win95; I)]
	[Mozilla/3.01C* (Win16; I)]
	[Mozilla/3.01C* (Win16; U)]
	[Mozilla/3.01C* (WinNT; I)]
	[Mozilla/3.01C* (WinNT; U)]
	[Mozilla/3.01-C-MACOS8 (Macintosh; I; PPC)]
	[Mozilla/3.01-C-MACOS8 (Macintosh; I; 68K)*]
	[Mozilla/3.01-C-NSCP (Macintosh; U; PPC)]
	[Mozilla/3.01 (Macintosh; U; PPC)*]
	[Mozilla/3.01 (X11; I; SunOS *)]
	[Mozilla/3.01 (X11; U; SunOS *)]
	[Mozilla/3.01 (X11; I; IRIX *)]
	[Mozilla/3.01 (X11; U; IRIX *)]
	[Mozilla/3.01 (X11; I; Linux *)]
	[Mozilla/3.01 (X11; I; HP-UX *)]
	[Mozilla/3.01b1 (Win95; I)*]
	[Mozilla/3.01b1 (WinNT; I)*]
	[Mozilla/3.01b1 (Win16; I)*]
	[Mozilla/3.01b1 (Macintosh; I; 68K)*]
	[Mozilla/3.01b1 (Macintosh; I; PPC)*]
	[Mozilla/3.0Gold (Macintosh; I; 68K)*]
	[Mozilla/3.0Gold (Macintosh; I; PPC)*]
	[Mozilla/3.0Gold (Macintosh; U; 68K)*]
	[Mozilla/3.0Gold (Macintosh; U; PPC)*]
	[Mozilla/3.0Gold (X11; I; *)]
	[Mozilla/3.0Gold (Win16; I)*]
	[Mozilla/3.0Gold (Win16; U)*]
	[Mozilla/3.0Gold (Win95; I)*]
	[Mozilla/3.0Gold (Win95; I; 16bit)*]
	[Mozilla/3.0Gold (Win95; U)*]
	[Mozilla/3.0Gold (Win95; U; 16bit)*]
	[Mozilla/3.0Gold (WinNT; I)*]
	[Mozilla/3.0Gold (WinNT; U)*]
	[Mozilla/3.0 (Macintosh; I; 68K)*]
	[Mozilla/3.0 (Macintosh; I; PPC)*]
	[Mozilla/3.0 (Macintosh; U; 68K)*]
	[Mozilla/3.0-C-NC320 (Macintosh; U; 68K)*]
	[Mozilla/3.0 (Macintosh; U; PPC)*]
	[Mozilla/3.0 (X11; I; SCO_SV *)]
	[Mozilla/3.0 (X11; I; SunOS *)]
	[Mozilla/3.0 (X11; I; FreeBSD *)]
	[Mozilla/3.0 * (Win16; I)]
	[Mozilla/3.0 * (Win16; U)]
	[Mozilla/3.0 * (Win95; I)]
	[Mozilla/3.0 * (Win95; I; 16bit)]
	[Mozilla/3.0 * (Win95; U)]
	[Mozilla/3.0 * (Win95; U; 16bit)]
	[Mozilla/3.0 * (WinNT; I)]
	[Mozilla/3.0 * (WinNT; U)]
	[Mozilla/3.0 * (OS/2; I)]
	[Mozilla/3.0C* (Win95; U)]
	[Mozilla/3.0C* (Win95; I)]
	[Mozilla/3.0C* (Win16; I)]
	[Mozilla/3.0C* (Win16; U)]
	[Mozilla/3.0C* (WinNT; I)]
	[Mozilla/3.0C* (WinNT; U)]
	[Mozilla/3.0C* (Win95; I; 16bit)]
	[Mozilla/3.0C-USG * (X11; U; SunOS 4.1.4 sun4c)]
	[Mozilla/3.0C-AOL (Win95; I; 16bit)*]
	[Mozilla/3.0 (Win16; I)*]
	[Mozilla/3.0 (Win16; U)*]
	[Mozilla/3.0 (Win95; I)*]
	[Mozilla/3.0 (Win95; I; 16bit)*]
	[Mozilla/3.0 (Win95; U)*]
	[Mozilla/3.0 (Win95; U; 16bit)*]
	[Mozilla/3.0 (WinNT; I)*]
	[Mozilla/3.0 (WinNT; U)*]
	[Mozilla/3.0 (OS/2; I)*]
	[Mozilla/3.0 (X11; I; BSD/OS *)]
	[Mozilla/3.0 (X11; I; Linux *)]
	[Mozilla/3.0 (X11; I; HP-UX *)]
	[Mozilla/3.0b3 (Win16; I)*]
	[Mozilla/3.0b3 (Win95; I)*]
	[Mozilla/3.0b3 (WinNT; I)*]
	[Mozilla/3.0b3Gold (Win95; I)*]
	[Mozilla/3.0b4 (Macintosh; I; PPC)*]
	[Mozilla/3.0b4 (Win16; I)*]
	[Mozilla/3.0b4 (Win95; I)*]
	[Mozilla/3.0b4 (Win95; I; 16bit)*]
	[Mozilla/3.0b4 (WinNT; I)*]
	[Mozilla/3.0b4Gold (Macintosh; I; 68K)*]
	[Mozilla/3.0b4Gold (Macintosh; I; PPC)*]
	[Mozilla/3.0b4Gold (Win16; I)*]
	[Mozilla/3.0b4Gold (Win95; I)*]
	[Mozilla/3.0b4Gold (Win95; I; 16bit)*]
	[Mozilla/3.0b4Gold (WinNT; I)*]
	[Mozilla/3.0b5 (Macintosh; I; 68K)*]
	[Mozilla/3.0b5 (Macintosh; I; PPC)*]
	[Mozilla/3.0b5 (Win16; I)*]
	[Mozilla/3.0b5 (Win16; U)*]
	[Mozilla/3.0b5 (Win95; I)*]
	[Mozilla/3.0b5 (Win95; U)*]
	[Mozilla/3.0b5 (WinNT; I)*]
	[Mozilla/3.0b5 (WinNT; U)*]
	[Mozilla/3.0b5Gold (Macintosh; I; 68K)*]
	[Mozilla/3.0b5Gold (Macintosh; I; PPC)*]
	[Mozilla/3.0b5Gold (Win16; I)*]
	[Mozilla/3.0b5Gold (Win95; I)*]
	[Mozilla/3.0b5Gold (Win95; I; 16bit)*]
	[Mozilla/3.0b5Gold (WinNT; I)*]
	[Mozilla/3.0b5a (Win16; I)*]
	[Mozilla/3.0b5a (Win95; I)*]
	[Mozilla/3.0b5a (Win95; I; 16bit)*]
	[Mozilla/3.0b5a (WinNT; I)*]
	[Mozilla/3.0b5aGold (Win16; I)*]
	[Mozilla/3.0b5aGold (Win95; I)*]
	[Mozilla/3.0b5aGold (Win95; I; 16bit)*]
	[Mozilla/3.0b5aGold (WinNT; I)*]
	[Mozilla/3.0b6 (Macintosh; I; PPC)*]
	[Mozilla/3.0b6 (Win16; I)*]
	[Mozilla/3.0b6 (Win95; I)*]
	[Mozilla/3.0b6 (Win95; I; 16bit)*]
	[Mozilla/3.0b6 (Win95; U)*]
	[Mozilla/3.0b6 (WinNT; I)*]
	[Mozilla/3.0b6Gold (Win16; I)*]
	[Mozilla/3.0b6Gold (Win95; I)*]
	[Mozilla/3.0b6Gold (Win95; I; 16bit)*]
	[Mozilla/3.0b6Gold (WinNT; I)*]
	[Mozilla/3.0b6a (Macintosh; I; 68K)*]
	[Mozilla/3.0b6a (Macintosh; I; PPC)*]
	[Mozilla/3.0b6aGold (Macintosh; I; 68K)*]
	[Mozilla/3.0b6aGold (Macintosh; I; PPC)*]
	[Mozilla/3.0b7 (Macintosh; I; 68K)*]
	[Mozilla/3.0b7 (Macintosh; I; PPC)*]
	[Mozilla/3.0b7 (Win16; I)*]
	[Mozilla/3.0b7 (Win95; I)*]
	[Mozilla/3.0b7 (Win95; I; 16bit)*]
	[Mozilla/3.0b7 (WinNT; I)*]
	[Mozilla/3.0b7Gold (Macintosh; I; 68K)*]
	[Mozilla/3.0b7Gold (Macintosh; I; PPC)*]
	[Mozilla/3.0b7Gold (Win16; I)*]
	[Mozilla/3.0b7Gold (Win95; I)*]
	[Mozilla/3.0b7Gold (Win95; I; 16bit)*]
	[Mozilla/3.0b7Gold (Win95; U)*]
	[Mozilla/3.0b7Gold (WinNT; I)*]
	[Mozilla/3.0b7a (Win95; I)*]
	[Mozilla/3.0b7a (WinNT; I)*]
	[Mozilla/3.0b8Gold (Macintosh; I; 68K)*]
	[Mozilla/3.0b8Gold (Macintosh; I; PPC)*]
	[Mozilla/3.0b8Gold (Win16; I)*]
	[Mozilla/3.0b8Gold (Win16; U)*]
	[Mozilla/3.0b8Gold (Win95; I)*]
	[Mozilla/3.0b8Gold (Win95; I; 16bit)*]
	[Mozilla/3.0b8Gold (Win95; U)*]
	[Mozilla/3.0b8Gold (WinNT; I)*]
	[Mozilla/2.0 (Macintosh; I; 68K)*]
	[Mozilla/2.0 (Macintosh; I; PPC)*]
	[Mozilla/2.0 (Macintosh; U; 68K)*]
	[Mozilla/2.0 (Macintosh; U; PPC)*]
	[Mozilla/2.0 (16bit; I)*]
	[Mozilla/2.0 (16bit; U)*]
	[Mozilla/2.0 (Win95; I)*]
	[Mozilla/2.0 (Win95; I; 16bit)*]
	[Mozilla/2.0 (Win95; U)*]
	[Mozilla/2.0 (Win95; U; 16bit)*]
	[Mozilla/2.0 (WinNT; I)*]
	[Mozilla/2.0 (WinNT; U)*]
	[Mozilla/2.0 (Windows; I; 32bit)*]
	[Mozilla/2.01 (Macintosh; I; 68K)*]
	[Mozilla/2.01 (Macintosh; I; PPC)*]
	[Mozilla/2.01 (Macintosh; U; 68K)*]
	[Mozilla/2.01 (Macintosh; U; PPC)*]
	[Mozilla/2.01 (16bit; I)*]
	[Mozilla/2.01 (Win16; U)*]
	[Mozilla/2.01 (Win16; I)*]
	[Mozilla/2.01 (16bit; U)*]
	[Mozilla/2.01 (Win95; I)*]
	[Mozilla/2.01 (Win95; I; 16bit)*]
	[Mozilla/2.01DT * (Win95; I; 16bit)]
	[Mozilla/2.01 (Win95; U)*]
	[Mozilla/2.01 (Win95; U; 16bit)*]
	[Mozilla/2.01KIT (Win95; U)*]
	[Mozilla/2.01KIT (Win95; I)*]
	[Mozilla/2.01KIT (WinNT; I)*]
	[Mozilla/2.01KIT (WinNT; U)*]
	[Mozilla/2.01KIT (Win16; I)*]
	[Mozilla/2.01KIT (Win16; U)*]
	[Mozilla/2.01 (WinNT; I)*]
	[Mozilla/2.01 (WinNT; U)*]
	[Mozilla/2.01 (X11; I; SunOS *)]
	[Mozilla/2.01E -NOV (Win16; I)*]
	[Mozilla/2.01E -NOV -NOV (Win16; I)*]
	[Mozilla/2.01E -NOV-NOV  (Win16; I)*]
	[Mozilla/2.01E-GTE  (Win95; U)*]
	[Mozilla/2.01E-GTE (Win95; U)*]
	[Mozilla/2.01E-GTE (Win95; I)*]
	[Mozilla/2.01E-compaq (Win95; I)*]
	[Mozilla/2.01E-compaq  (Win95; I)*]
	[Mozilla/2.01E-compaq (WinNT; I)*]
	[Mozilla/2.01E-NC250 (Win95; U; 16bit)*]
	[Mozilla/2.01E-NC250 (Win95; I; 16bit)*]
	[Mozilla/2.01E-CIS  (Win95; I; 16bit)*]
	[Mozilla/2.01E (Win16; I)*]
	[Mozilla/2.01E (Win95; U)*]
	[Mozilla/2.01Gold (Win95; I)*]
	[Mozilla/2.01Gold (Win95; U)*]
	[Mozilla/2.01Gold (WinNT; I)*]
	[Mozilla/2.01Gold (WinNT; U)*]
	[Mozilla/2.01GoldA1 (Macintosh; I; 68K)*]
	[Mozilla/2.01I (16bit; I)*]
	[Mozilla/2.01I (Win95; I)*]
	[Mozilla/2.01I (WinNT; I)*]
	[Mozilla/2.01I-Sun(X11; I; SunOS *)]
	[Mozilla/2.02 (Macintosh; I; 68K)*]
	[Mozilla/2.02 (Macintosh; I; PPC)*]
	[Mozilla/2.02 (Macintosh; U; 68K)*]
	[Mozilla/2.02 (Macintosh; U; PPC)*]
	[Mozilla/2.02 (16bit; I)*]
	[Mozilla/2.02 (OS/2; I)*]
	[Mozilla/2.02 (OS/2; U)*]
	[Mozilla/2.02 (Win16; I)*]
	[Mozilla/2.02 * (OS/2; U)]
	[Mozilla/2.02 * (Win16; I)]
	[Mozilla/2.02 * (16bit; U)]
	[Mozilla/2.02 * (Win16; U)]
	[Mozilla/2.02 (Win95; I)*]
	[Mozilla/2.02 * (Win95; I)]
	[Mozilla/2.02E (Win95; I)*]
	[Mozilla/2.02E (Win95; U)*]
	[Mozilla/2.02E-VN005  (Win95; I)*]
	[Mozilla/2.02E-VN003  (Win95; I)*]
	[Mozilla/2.02E (Macintosh; I; 68K)*]
	[Mozilla/2.02E (Macintosh; U; PPC)*]
	[Mozilla/2.02E (OS/2; I)*]
	[Mozilla/2.02E (OS/2; U)*]
	[Mozilla/2.02 (Win95; I; 16bit)*]
	[Mozilla/2.02 (Win95; U)*]
	[Mozilla/2.02 (X11; I; SunOS *)]
	[Mozilla/2.02 (X11; I; Linux *)]
	[Mozilla/2.02 (X11; I; IRIX *)]
	[Mozilla/2.02APPLE (Macintosh; I; PPC)*]
	[Mozilla/2.02E-KIT (Win16; U)*]
	[Mozilla/2.02E-KIT  (Win95; I)*]
	[Mozilla/2.02E-SNET2 (Win16; U)*]
	[Mozilla/2.02E-SNET2 (Win95; U; 16bit)*]
	[Mozilla/2.02E-KIT (Win95; I)*]
	[Mozilla/2.02E-KIT (Win95; U)*]
	[Mozilla/2.02E-KIT  (Win95; U)*]
	[Mozilla/2.02 (Win95; U; 16bit)*]
	[Mozilla/2.02 (WinNT; I)*]
	[Mozilla/2.02 (WinNT; U)*]
	[Mozilla/2.02E-KIT (Win16; I)*]
	[Mozilla/2.02Gold (Win95; I)*]
	[Mozilla/2.02Gold (Win95; U)*]
	[Mozilla/2.02Gold (WinNT; I)*]
	[Mozilla/2.02Gold (WinNT; U)*]
	[Mozilla/1.22 (Windows; I; 32bit)*]
	[Mozilla/1.22 (Windows; I; 16bit)*]
	[Mozilla/1.22 (Windows; U; 16bit)*]
	[Mozilla/1.22ATT (Windows; U; 16bit)*]
	[Mozilla/1.1N (Windows; I; 16bit)*]
	[Mozilla/1.0 (Windows; I; 16bit)*]
	[Mozilla/1.0N (Windows)*]
	[Mozilla/1.12(Macintosh; I; 68K)*]

    Internet Explorer
    -----------------
    Internet Explorer v1:       Mozilla/*MSIE 1.*
    Internet Explorer v1.5:     Mozilla/*MSIE 1.5*
    Internet Explorer v1.0:     Microsoft Internet Explorer/4.40.*
    Internet Explorer v2:       Mozilla/*MSIE 2.*
    Internet Explorer v2:       Mozilla/*MSIE 2.[1-9]*
    Internet Explorer v3:       Mozilla/*MSIE 3.*
    Internet Explorer v3:       Mozilla/*MSIE 3.*Windows 3.1*
    Internet Explorer v3:       Mozilla/*Frontpage*
    Internet Explorer v3:       Mozilla/*MSIE 3.* Mac*
    Internet Explorer v3:       Mozilla/*MSIE 3.*[2-9]* Mac*
    Internet Explorer v3:       Mozilla/*MSIE 3.02*
    Internet Explorer v3:       Mozilla/*MSIE 3.0[3-9]*
    Internet Explorer v4:       Mozilla/*MSIE 4.*
    Pocket IE (orig):           Microsoft Pocket Internet Explorer/0*
    Pocket IE v1:               Mozilla/*MSPIE 1*
    Pocket IE v2:               Mozilla/*MSPIE 2*
    Internet Explorer v5:       Mozilla/*MSIE 5.*
    Internet Explorer v6:       Mozilla/*MSIE 6.*
    Internet Explorer (future): Mozilla/*MSIE [7-9].*

    User agent strings from browscap.ini (not totally up to date) plus
    STM logging system:

	[Microsoft Internet Explorer/4.40.210beta (Windows 95)*]
	[Microsoft Internet Explorer/4.40.214beta (Windows 95)*]
	[Microsoft Internet Explorer/4.40.300beta (Windows 95)*]
	[Microsoft Internet Explorer/4.40.304beta (Windows 95)*]
	[Microsoft Internet Explorer/4.40.305beta (Windows 95)*]
	[Microsoft Internet Explorer/4.40.308 (Windows 95)*]
	[Microsoft Internet Explorer/4.40.425 (Windows 95)*]
	[Microsoft Internet Explorer/4.40.426 (Windows 95)*]
	[Microsoft Internet Explorer/4.40.474beta (Windows 95)*]
	[Microsoft Internet Explorer/4.0b1 (Windows 95)*]
	[Mozilla/1.22 (compatible; MSIE 1.5; Windows)*]
	[Mozilla/1.22 (compatible; MSIE 1.5; Windows NT)*]
	[Mozilla/1.22 (compatible; MSIE 1.5; Windows 95)*]
	[Mozilla/1.22 (compatible; MSIE 2.0; Windows 95)*]
	[Mozilla/1.22 (compatible; MSIE 2.0; Mac_68000)*]
	[Mozilla/1.22 (compatible; MSIE 2.0; Mac_PowerPC)*]
	[Mozilla/1.22 (compatible; MSIE 2.0B; Mac_68000)*]
	[Mozilla/1.22 (compatible; MSIE 2.0B; Mac_PowerPC)*]
	[Mozilla/1.22 (compatible; MSIE 2.0; Windows 3.1)*]
	[Mozilla/2.0 (Win16; I)*]
	[Mozilla/2.0 (X11; I; SunOS *)]
	[Mozilla/2.0 (compatible; MSIE 2.0; Mac_68000)*]
	[Mozilla/2.0 (compatible; MSIE 2.0; Mac_PowerPC)*]
	[Mozilla/2.0 (compatible; MSIE 2.0B; Mac_68000)*]
	[Mozilla/2.0 (compatible; MSIE 2.0B; Mac_PowerPC)*]
	[Mozilla/2.0 (compatible; MSIE 2.1; Windows 3.1)*]
	[Mozilla/2.0 (compatible; MSIE 2.1; AOL 3.0; Windows 3.1)*]
	[Mozilla/2.0 (compatible; MSIE 2.1; AOL 3.0; Mac_68K)*]
	[Mozilla/2.0 (compatible; MSIE 2.1; Mac_68000)*]
	[Mozilla/2.0 (compatible; MSIE 2.1; Mac_PowerPC)*]
	[Mozilla/2.0 (compatible; AOL 3.0; Mac_PowerPC)*]
	[Mozilla/2.0 (compatible; MSIE 2.1; AOL 3.0; Mac_PPC)*]
	[Mozilla/2.0 (compatible; MSIE 2.5;  Windows 3.1)*]
	[Mozilla/2.0 (compatible; MSIE 2.5b;  Windows 3.1)*]
	[Mozilla/1.22 (compatible; MSIE 2.0c; Windows 95)*]
	[Mozilla/1.22 (compatible; MSIE 2.01; Windows NT)*]
	[Mozilla/1.22 (compatible; MSIE 2.0d; Windows NT)*]
	[Mozilla/2.0 (compatible; NEWT ActiveX; Win32)]
	[Mozilla/2.0 (compatible; MSIE 3.0; AK; Windows 95)*]
	[Mozilla/2.0 (compatible; MSIE 3.0; MSN 2.5; SK; Windows 95)*]
	[Mozilla/2.0 (compatible; MSIE 3.0; AK; Windows NT)*]
	[Mozilla/2.0 (compatible; MSIE 3.0; AOL 3.0; Windows 3.1)*]
	[Mozilla/2.0 (compatible; MSIE 3.0; AOL 3.0; Windows 95)*]
	[Mozilla/2.0 (compatible; MSIE 3.0b1; Mac_68000)*]
	[Mozilla/2.0 (compatible; MSIE 3.0B; Windows 3.1)*]
	[Mozilla/2.0 (compatible; MSIE 3.01; AK; Update B; Windows 95)*]
	[Mozilla/2.0 (compatible; MSIE 3.02; AOL 3.0; Windows 95)*]
	[Mozilla/2.0 (compatible; MSIE 3.02; Update a; AOL 3.0; Windows 95)*]
	[Mozilla/2.0 (compatible; MSIE 3.02; Update a; AK; AOL 3.0; Windows 95)*]
	[Mozilla/2.0 (compatible; MSIE 3.02; Update a; AOL 3.0; Windows NT)*]
	[Mozilla/2.0 (compatible; MSIE 3.02; Update a; Windows NT)*]
	[Mozilla/2.0 (compatible; MSIE 3.02; Update a; MSN 2.0; Windows 95)*]
	[Mozilla/3.0 (compatible; MSIE 3.0)*]
	[Mozilla/3.0 (http engine)*]
	[Mozilla/2.0 (compatible; MSIE 3.0; Mac_PowerPC)*]
	[Mozilla/2.0 (compatible; MSIE 3.0; SK; Windows 95)*]
	[Mozilla/2.0 (compatible; MSIE 3.0; SK; Windows NT)*]
	[Mozilla/2.0 (compatible; MSIE 3.0; Win 32)*]
	[Mozilla/2.0 (compatible; MSIE 3.0; Windows 95)*]
	[Mozilla/2.0 (compatible; MS FrontPage 2.0)*]
	[Mozilla/2.0 (compatible; MS FrontPage 3.0)*]
	[Mozilla/2.0 (compatible; MSIE 3.0; Windows 3.1)*]
	[Mozilla/2.0 (compatible; MSIE 3.0; Update a; Windows 95)*]
	[Mozilla/2.0 (compatible; MSIE 3.0; Update a; SK; Windows 95)*]
	[Mozilla/2.0 (compatible; MSIE 3.0; Update B; Windows 95)*]
	[Mozilla/2.0 (compatible; MSIE 3.0; Update a; Windows NT)*]
	[Mozilla/2.0 (compatible; MSIE 3.0; Windows 95) Modified]
	[Mozilla/2.0 (compatible; MSIE 3.0; Windows 95; *)]
	[Mozilla/2.0 (compatible; MSIE 3.0; Windows NT)*]
	[Mozilla/2.0 (compatible; MSIE 3.0A; Windows 95)*]
	[Mozilla/2.0 (compatible; MSIE 3.0a; Windows 3.1)*]
	[Mozilla/2.0 (compatible; MSIE 3.0B3; Windows 95)*]
	[Mozilla/2.0 (compatible; MSIE 3.0B3; Windows NT)*]
	[Mozilla/2.0 (compatible; MSIE 3.0B; Win32)*]
	[Mozilla/2.0 (compatible; MSIE 3.0B; Windows 95)*]
	[Mozilla/2.0 (compatible; MSIE 3.0B; Windows 95;*)]
	[Mozilla/2.0 (compatible; MSIE 3.0B; Windows 95; *)]
	[Mozilla/2.0 (compatible; MSIE 3.0B; Windows NT)*]
	[Mozilla/2.0 (compatible; MSIE 3.0B; Windows NT;*)]
	[Mozilla/2.0 (compatible; MSIE 3.1; Windows NT)*]
	[Mozilla/2.0 (compatible; MSIE 3.01; Windows 95)*]
	[Mozilla/2.0 (compatible; MSIE 3.01*; Windows 95)]
	[Mozilla/2.0 (compatible; MSIE 3.01; Update B; Windows 95)*]
	[Mozilla/2.0 (compatible; MSIE 3.01*; Windows NT)]
	[Mozilla/2.0 (compatible; MSIE 3.01*; Windows 3.1)]
	[Mozilla/2.0 (compatible; MSIE 3.01*; Mac_PowerPC)]
	[Mozilla/3.0 (compatible; MSIE 3.01; Mac_PowerPC)*]
	[Mozilla/3.0 (compatible; MSIE 3.01; Mac_68000)*]
	[Mozilla/3.0 (compatible; MSIE 3.01*; Mac_PowerPC)]
	[Mozilla/3.0 (compatible; MSIE 3.0.1; Mac_PowerPC)]
	[Mozilla/2.0 (compatible; MSIE 3.01*; Mac_68000)]
	[Mozilla/2.0 (compatible; MSIE 3.03*; Windows 3.1)]
	[Mozilla/4.0 (compatible; MSIE 4.01; Windows NT)*]
	[Mozilla/4.0 (compatible; MSIE 4.01; Windows NT; *)]
	[Mozilla/4.0 (compatible; MSIE 4.01; Windows 95)*]
	[Mozilla/4.0 (compatible; MSIE 4.01; Windows 95; *)]
	[Mozilla/4.0 (compatible; MSIE 4.01; Windows 98)*]
	[Mozilla/4.0 (compatible; MSIE 4.01; Windows 98; *)]
	[Mozilla/4.0 (compatible; MSIE 4.01; MSN 2.5; Windows 95)*]
	[Mozilla/4.0 (compatible; MSIE 4.01; MSN 2.5; Windows NT)*]
	[Mozilla/3.0 (compatible; MSIE 4.0p1; Mac_PowerPC)]
	[Mozilla/4.0 (compatible; MSIE 4.0; Windows NT)*]
	[Mozilla/4.0 (compatible; MSIE 4.0; Windows 95)*]
	[Mozilla/4.0 (compatible; MSIE 4.0; Mac_PowerPC)*]
	[Mozilla/4.0 (compatible; MSIE 4.0; MSIECrawler; Windows NT)*]
	[Mozilla/4.0 (compatible; MSIE 4.0; MSIECrawler; Windows 95)*]
	[Mozilla/4.0 (compatible; MSIE 4.0; Windows NT; Snap.home.1)*]
	[Mozilla/4.0 (compatible; MSIE 4.0; Windows 95; Snap.home.1)*]
	[Mozilla/4.0 (compatible; MSIE 4.0; Windows NT; ITG)*]
	[Mozilla/4.0 (compatible; MSIE 4.0; Windows 95; ITG)*]
	[Mozilla/4.0 (compatible; MSIE 4.0; MSN 2.5; Windows 95)*]
	[Mozilla/4.0 (compatible; MSIE 4.0; MSN 2.5; Windows NT)*]
	[Mozilla/4.0 (compatible; MSIE 4.0; Windows NT; ICONZ 4.0.0.18)*]
	[Mozilla/4.0 (compatible; MSIE 4.0; Windows 95; ICONZ 4.0.0.18)*]
	[Mozilla/4.0 (compatible; MSIE 4.0; Windows 95; interscope)*]
	[Mozilla/4.0 (compatible; MSIE 4.0; Windows NT; interscope)*]
	[Mozilla/4.0 (compatible; MSIE 4.0; Windows 95; digitalie40)*]
	[Mozilla/4.0 (compatible; MSIE 4.0; Windows NT; digitalie40)*]
	[Mozilla/4.0 (compatible; MSIE 4.0; Windows 95; BPH01)*]
	[Mozilla/4.0 (compatible; MSIE 4.0; Windows NT; BPH01)*]
	[Mozilla/4.0 (compatible; MSIE 4.0; Windows 95; DIL0001001)*]
	[Mozilla/4.0 (compatible; MSIE 4.0; Windows NT; DIL0001001)*]
	[Mozilla/4.0 (compatible; MSIE 4.0; Windows 95; TUCOWS USER)*]
	[Mozilla/4.0 (compatible; MSIE 4.0; Windows NT; TUCOWS USER)*]
	[Mozilla/4.0 (compatible; MSIE 4.0; Windows 95; *)]
	[Mozilla/4.0 (compatible; MSIE 4.0; Windows NT; *)]
	[Mozilla/4.0 (compatible; MSIE 4.0; Windows 98; *)]
	[Mozilla/4.0 (compatible; MSIE 4.0b2; MSN 2.0; Windows 95)*]
	[Mozilla/4.0 (compatible; MSIE 4.0b2; MSN 2.5; Windows 95)*]
	[Mozilla/4.0 (compatible; MSIE 4.0b2; AOL 3.0; Windows 95)*]
	[Mozilla/4.0 (compatible; MSIE 4.0b1; Windows 95)*]
	[Mozilla/2.0 (compatible; MSIE 4.0b1; Windows 3.1)*]
	[Mozilla/4.0 (compatible; MSIE 4.0b1; Update *; Windows 95)]
	[Mozilla/4.0 (compatible; MSIE 4.0b1; Windows NT)*]
	[Mozilla/4.0 (compatible; MSIE 4.0b1; Update *; Windows NT)]
	[Mozilla/2.0 (compatible; MSIE 4.0aSept; Windows 95)*]
	[Mozilla/2.0 (compatible; MSIE 4.0aSept; Windows NT)*]
	[Mozilla/4.0 (compatible; MSIE 5.0b1; Windows 95)*]
	[Mozilla/4.0 (compatible; MSIE 5.0b1; MSIECrawler; Windows 95)*]
	[Mozilla/4.0 (compatible; MSIE 5.0b1; Windows 98)*]
	[Mozilla/4.0 (compatible; MSIE 5.0b1; MSIECrawler; Windows 98)*]
	[Mozilla/4.0 (compatible; MSIE 5.0b1; Windows NT)*]
	[Mozilla/4.0 (compatible; MSIE 5.0b1; MSIECrawler; Windows NT)*]
	[Mozilla/4.0 (compatible; MSIE 5.0b1; Windows NT 5.0)*]
	[Mozilla/4.0 (compatible; MSIE 5.0b2; Windows 95)*]
	[Mozilla/4.0 (compatible; MSIE 5.0b2; MSIECrawler; Windows 95)*]
	[Mozilla/4.0 (compatible; MSIE 5.0b2; Windows 98)*]
	[Mozilla/4.0 (compatible; MSIE 5.0b2; MSIECrawler; Windows 98)*]
	[Mozilla/4.0 (compatible; MSIE 5.0b2; Windows NT)*]
	[Mozilla/4.0 (compatible; MSIE 5.0b2; MSIECrawler; Windows NT)*]
	[Mozilla/4.0 (compatible; MSIE 5.0b2; Windows NT 5.0)*]
	[Mozilla/4.0 (compatible; MSIE 5.0; Windows 95)*]
	[Mozilla/4.0 (compatible; MSIE 5.0; MSIECrawler; Windows 95)*]
	[Mozilla/4.0 (compatible; MSIE 5.0; Windows 98)*]
	[Mozilla/4.0 (compatible; MSIE 5.0; Windows 98; DigExt)*]
	[Mozilla/4.0 (compatible; MSIE 5.0; Windows NT; DigExt)*]
	[Mozilla/4.0 (compatible; MSIE 5.0; MSIECrawler; Windows 98)*]
	[Mozilla/4.0 (compatible; MSIE 5.0; Windows NT)*]
	[Mozilla/4.0 (compatible; MSIE 5.0; MSIECrawler; Windows NT)*]
	[Mozilla/4.0 (compatible; MSIE 5.0; Windows NT 5.0)*]
	[Mozilla/4.0 (compatible; MSIE 5.01; Windows 95)*]
	[Mozilla/4.0 (compatible; MSIE 5.01; MSIECrawler; Windows 95)*]
	[Mozilla/4.0 (compatible; MSIE 5.01; Windows 98)*]
	[Mozilla/4.0 (compatible; MSIE 5.0; Windows 98; DigExt)*]
	[Mozilla/4.0 (compatible; MSIE 5.0; Windows NT; DigExt)*]
	[Mozilla/4.0 (compatible; MSIE 5.0; MSIECrawler; Windows 98)*]
	[Mozilla/4.0 (compatible; MSIE 5.0; Windows NT)*]
	[Mozilla/4.0 (compatible; MSIE 5.0; MSIECrawler; Windows NT)*]
	[Mozilla/4.0 (compatible; MSIE 5.0; Windows NT 5.0)*]
	[Mozilla/4.0 (compatible; MSIE 4.0b1 Crawler; Windows 95)*]
	[Mozilla/4.0 (compatible; MSIE 4.0b1 Crawler; Windows NT)*]
	[Mozilla/4.0 (compatible; MSIE 4.0b2; Windows 95)*]
	[Mozilla/4.0 (compatible; MSIE 4.0b2; Windows NT)*]
	[Mozilla/4.0 (compatible; MSIE 4.0b2; Update a; Windows 95)*]
	[Mozilla/4.0 (compatible; MSIE 4.0b2; Update a; Windows NT)*]
	[Mozilla/4.0 (compatible; MSIE 4.0b2 Crawler; Windows 95)*]
	[Mozilla/4.0 (compatible; MSIE 4.0b2; MSIECrawler; Windows 95)*]
	[Mozilla/4.0 (compatible; MSIE 4.0b2 MSIECrawler; Windows 95)*]
	[Mozilla/4.0 (compatible; MSIE 4.0b2 Crawler; Windows NT)*]
	[Mozilla/4.0 (compatible; MSIE 4.0b2; MSIECrawler; Windows NT)*]
	[Mozilla/4.0 (compatible; MSIE 4.0b2 MSIECrawler; Windows NT)*]
	[Mozilla/4.0 (compatible; MSIE 4.0b3; Windows 95)*]
	[Mozilla/4.0 (compatible; MSIE 4.0b3; Windows NT)*]
	[Mozilla/4.0 (compatible; MSIE 4.0b3 Crawler; Windows 95)*]
	[Mozilla/4.0 (compatible; MSIE 4.0b3 Crawler; Windows NT)*]
	[Mozilla/4.0 (compatible; MSIE 4.0 Crawler; Windows 95)*]
	[Mozilla/4.0 (compatible; MSIE 4.0 Crawler; Windows NT)*]
	[Mozilla/3.02 (compatible; MSIE 3.02)*]
	[Mozilla/2.0 (compatible; MSIE 3.02; Windows 95)*]
	[Mozilla/2.0 (compatible; Thai MSIE 3.02; Windows 95)*]
	[Mozilla/2.0 (compatible; MSIE 3.02; Windows 3.1)*]
	[Mozilla/2.0 (compatible; MSIE 3.02*; Windows 3.1)]
	[Mozilla/2.0 (compatible; MSIE 3.02; Update a; Windows 95)*]
	[Mozilla/2.0 (compatible; MSIE 3.02; MSN 2.0; Update a; Windows 95)*]
	[Mozilla/2.0 (compatible; MSIE 3.02; MSN 2.5; Update a; Windows 95)*]
	[Mozilla/2.0 (compatible; MSIE 3.02; AK; Windows 95)*]
	[Mozilla/2.0 (compatible; MSIE 3.02; Update a; AK; Windows 95)*]
	[Mozilla/2.0 (compatible; MSIE 3.02; Win32)*]
	[Mozilla/2.0 (compatible; MSIE 3.02*; Win32)]
	[Mozilla/2.0 (compatible; MSIE 3.02; Windows NT)*]
	[Mozilla/2.0 (compatible; MSIE 3.02*; Windows NT)]

    Pocket Internet Explorer

	[Microsoft Pocket Internet Explorer/0.6]
	[Mozilla/1.1 (compatible; MSPIE 1.1; Windows CE)]
	[Mozilla/1.1 (compatible; MSPIE 2.0; Windows CE)]

    
    AOL (older, non IE)
    -------------------
    AOL16:                IWENG/*
    AOL InterCon Library: aolbrowser/1*
    IWENG v3:             Mozilla/*IWENG 3*

    User agent strings from browscap.ini (not totally up to date):

	[aolbrowser/1.1 InterCon-Web-Library/1.2 (Macintosh; 68K)*]
	[Mozilla/2.0 (Compatible; AOL-IWENG 3.0; Win16)*]
	[Mozilla/2.0 (Compatible; AOL-IWENG 3.1; Win16)*]

    Oracle Browsers
    ---------------
    Oracle v1: Mozilla*Oracle(tm) PowerBrowser*

    User agent strings from browscap.ini (not totally up to date):

    Lynx
    ----
    Lynx (all versions):    Lynx*
    Lynx (libwww):         libwww*
    Lynx (libwww generic): */*libwww-perl*
    LWP:                   LWP*

    User agent strings from browscap.ini (not totally up to date):

	[Lynx/2.6  libwww-FM/2.14*]
	[Lynx/2.7.1 libwww-FM/2.14*]
	[libwww-perl/5.06]
	[libwww-perl/5.03]
	[libwww-perl/5.07]

    NCSA Mosiac
    -----------
    NCSA Mosiac v1 & v2: NCSA Mosiac/[12]*
    NCSA Mosiac v3:      NCSA Mosiac/3*

    User agent strings from browscap.ini (not totally up to date):

	[NCSA Mosaic/3.0.0 (Windows x86)*]
	[NCSA Mosaic/2.1.1 (Windows x86)*]

    Prodigy
    -------
    Prodigy Classic v3: PRODIGY-WB/3*

    User agent strings from browscap.ini (not totally up to date):

	[PRODIGY-WB/3.2b*]
	[PRODIGY-WB/3.2d*]

    HotJava
    -------
    HotJava v1: HotJava/*

    User agent strings from browscap.ini (not totally up to date):

	[HotJava/1.0p1/JRE1.1.1*]

    IBrowse
    -------
    IBrowse v1.0:  IBrowse/1.*
    IBrowse v1.1:  IBrowse/1.1*
    IBrowse v1.12: IBrowse/1.12*
    IBrowse v1.16: IBrowse/1.16*
    IBrowse v1.2:  IBrowse/1.[2-0]*
    IBrowse v2:    IBrowse/2*

    User agent strings from browscap.ini (not totally up to date):

    IBM-WebExplorer
    ---------------
    WebExplorer v1.0:        IBM*WebExplorer*DLL/v1.0*
    WebExplorer v1.03:       IBM-WebExplorer-DLL/v1.03*
    WebExplorer v1.1 and up: IBM*WebExplorer*DLL/v1.[1-9]*

    User agent strings from browscap.ini (not totally up to date):

    MacWeb
    ------
    MacWeb v1: MacWeb/1*
    MacWeb v2: MacWeb/2*

    User agent strings from browscap.ini (not totally up to date):

    Cyberdog
    --------
    Cyberdog v1: Cyberdog/1*
    Cyberdog v2: Cyberdog/2*

    User agent strings from browscap.ini (not totally up to date):

    Opera
    -----
    Opera v3:                Mozilla/*Opera/3*
    Opera v3 (win 3.1):      Mozilla/*Opera/3*Windows 3.1*
    Opera v3 (win 3.1) ua2:  Mozilla/*Opera/3*Windows 3.1*)*.*
    Opera v3 (win 3.1) ua3:  Mozilla/*Opera/3*Windows 3.1*)*via*.*
    Opera v3 (win 3.1) ua4:  Mozilla/*Opera/3*Windows 3.1*)*.*via*.*
    Opera v3 (ua2):          Mozilla/*Opera/3*)*.*
    Opera v3 (ua3):          Mozilla/*Opera/3*)*via*.*
    Opera v3 (ua4):          Mozilla/*Opera/3*)*.*via*.*
    Opera v3.5:              Mozilla/*Opera/3*Windows [3-5]*)*3.[5-9]*
    Opera v3.5 (ua2):        Mozilla/*Opera/3*Windows*[3N]*[1-9]*)*3.[5-9]*
    Opera v2:                Mozilla/*Opera/2*
    Opera v3.6 and up:       Mozilla/*Windows 9*Opera 3.[6-9]*
    Opera v3.6 and up (ua2): Mozilla/*Windows [34N]*Opera 3.[6-9]*
    Opera v4:                Mozilla/*Windows [345N]*Opera 4*
    Opera v4 (ua2):          Mozilla/*Opera 4*
    Opera v4 (ua3):          Mozilla/*compatible*MSIE*Opera 4*
    Opera v4 (ua4):          Mozilla/*compatible*MSIE*Opera 4*
    Opera v4 (ua5):          Opera/4*
    Opera v5:                Mozilla/*Windows [345N]*Opera 5*
    Opera v5 (ua2):          Mozilla/*Opera 5*
    Opera v5 (ua3):          Mozilla/*compatible*MSIE*Opera 5*
    Opera v5 (ua4):          Mozilla/*compatible*MSIE*Windows [345N]*Opera 5*
    Opera v5 (ua5):          Opera/5*

    User agent strings from browscap.ini (not totally up to date):

	[Mozilla/3.0 (compatible; Opera/3.0; windows 3.1)*]
	[Mozilla/3.0 (compatible; Opera/3.0; Windows 95/NT)*]
	[Mozilla/3.0 (compatible; Opera/3.0b8; Windows 95/NT)*]

    Amiga Voyager
    -------------
    AmigaVoyager: AmigaVoyager/2*
    Amiga AWeb v2: Amiga-AWeb/2*
    Amiga AWeb v3: Amiga-AWeb/3*

    User agent strings from browscap.ini (not totally up to date):

    ANT Fresco
    ----------
    ANT Fresco v1: ANT Fresco/1.*

    User agent strings from browscap.ini (not totally up to date):

    Chimera
    -------
    Chimera v1: Chimera/1*
    Chimera v2: Chimera/2*

    User agent strings from browscap.ini (not totally up to date):

    Oracle
    ------
    Oracle PowerBrowser v1.5: Mozilla/2.01 (Compatible) Oracle(tm) PowerBrowser(tm)/1.0a*

    User agent strings from browscap.ini (not totally up to date):

    WebTV
    -----
    WebTV v1:       Mozilla/*WebTV*1.* MSIE*
    WebTV v1.2-1.9: Mozilla/*WebTV*1.[2-9]* MSIE*
    WebTV v2:       Mozilla/*WebTV*2.* MSIE*

    User agent strings from browscap.ini (not totally up to date):

    [Mozilla/3.0 WebTV/1.2 (compatible; MSIE 2.0)*]
    [Mozilla/1.22 WebTV/1.0 (compatible; MSIE 2.0)*]

    Dreamcast
    ---------
    Dreamcast v1: Mozilla/*Planetweb*Dreamcast*

    User agent strings from browscap.ini (not totally up to date):

    PDA devices
    -----------
    Psion Revo: EPOC32-WTL/*RVGA*
    Palm III:   Mozilla/*Elaine/*
    iPAQ:       Mozilla/2.0 (*MSIE 3.02; Windows CE; 240x320*

    User agent strings from browscap.ini (not totally up to date):

    iCAB
    ----
    iCab v2:       iCab*
    iCab v2 (ua2): Mozilla/*Compat*iCab*

    User agent strings from browscap.ini (not totally up to date):

    Web2U
    -----
    Web2U v2: Mozilla/*CJPENNYCATE 2*

    User agent strings from browscap.ini (not totally up to date):

    Bush Internet
    -------------
    Bush settop box v1:        Mozilla/*(compatible;*NC*Browser*ANTFresco*
    Bush settop box v2 and up: Mozilla/3*compatible; NC*Browser/[2-9]*ANTFresco*

    User agent strings from browscap.ini (not totally up to date):

    Multiphone
    ----------
    Multiphone v1: Mozilla/*BT Multiph*

    User agent strings from browscap.ini (not totally up to date):

    Konqueror
    ---------
    Konqueror v2: Mozilla/*Konqueror/*

    User agent strings from browscap.ini (not totally up to date):

    Blazer
    ------
    Blazer v1: UP*Blazer*

    User agent strings from browscap.ini (not totally up to date):

    AOLTV
    -----
    AOLTV v1: Mozilla/*AOLTV*

    User agent strings from browscap.ini (not totally up to date):

    Netgem
    ------
    Netbox: Mozilla*Netbox*

    User agent strings from browscap.ini (not totally up to date):

    List 'borrowed' from the latest version of BrowserHawk from
    http://www.cyscape.com/browserhawk/

Agents supported
+--------------+

NetAttache:                          NetAttache
Webview:                             Webview
WebTrends:                           WebTrends*

[WebTrends/3.0]
[WebTrends/3.0 (WinNT)*]
[WebTrends/3.0 (Win95)*]

Freeloader:                          www.freeloader.com*
Agents using Microsoft URL controls: Microsoft URL Control*

List 'borrowed' from the latest version of BrowserHawk from
http://www.cyscape.com/browserhawk/

Crawlers supported
+----------------+
AltaVista:           Scooter/*
AltaVista:           Altavista*
Excite:              ArchtextSpider*
Lycos:               Lycos*
Slurp:               Slurp*
Wise-Wire Widow:     Wise-Wire Widow*
Crescent:            Crescent*
CheckBot:            Checkbot/*
SwissSearch:         SwissSearch/*
Eule-Robot:          Eule-Robot*
ia_archiver:         ia_archiver/*
Generic spider:      *Sp[iy]der*
Generic Bot:         *[a-z]Bot*
Generic Bot:         *[a-z]Bot[ /0-9]*
EINET:               EI*Net*
Merritt:             Merritt*
StatFetcher:         StatFetcher*
TeacherSoft:         TeacherSoft*
WWW Collector:       WWW Collector*
wobot:               wobot*
Libertech-Rover:     Libertech-Rover*
WhoWhere Robot:      WhoWhere Robot*
ITI Spider:          ITI Spider*
W3Index:             w3index*
Generic Crawler:     *Crawl*
LinkLooker:          linklooker*
Wget:                wget/*
CheckUrl:            CheckUrl*
LinkLint:            LinkLint*
CheckWeb:            CheckWeb*
BackRub:             BackRub*
Fetch:               Fetch/*
Emacs:               Emacs*
UP.Browser2:         Weblayers/*
Scanner:             Scanner *
Phoaks:              Phoaks*
Anzwers:             Anzwers*
Arachnoidea:         Arachnoidea*
Fireball:            KIT_Fireball*
Search4Free:         lwp-trivial*
EZResults:           *EZResult*
EuroFerret:          MuscatFerret*
Kolibri:             Kolibri gnc*
Cherry Picker:       CherryPicker*
EmailCollector:      EmailCollector*
Sonic:               EmailSiphon*
EmailWolf:           EmailWolf*
GomezAgent:          GomezAgent*
InfoSeek Sidewinder: InfoSeek*
Alexa:               ia_archive*
PlanetSearch:        fido/*
NorthernLight:       Gulliver*
Thunderstone:        *T-H-U-N*
Informant:           The Inform*
WebCrawler:          WebCrawler*
URL Access:          URL*
Google:              Googlebot/*Google/*
Atomz:               Atomz*
Teleport:            Teleport*
WebStripper:         Webstripper*

Platforms:

AIX:     *AIX*
AIX1:    *AIX 1*
AIX2:    *AIX 2*
AIX3:    *AIX 3*
AIX4:    *AIX 4*
Amiga:   *Amiga*
AmigaOS: *Amiga*
BSD:     *BSD*
Compaq:  *Compaq*
CP/M:    *CP/M*
FreeBSD: *FreeBSD*
Geos:    *Geos *
HP-UX:   *HPUX*
IRIX:    *IRIX*
Linux:   *Linux*
Mac:     *Mac*
Mac:     *apple*
MacOS8:  *MacOS8*
MacPPC:  *Mac_PowerPC*
Mac68k:  *68000*
Mac68k:  *68k*
OS/2:    *OS/2*
SGI:     *SGI*
Solaris: *Solaris*
SunOS:   *SunOS*
SunOS4:  *SunOS 4*
SunOS5:  *SunOS 5*
WebTV:   *Web TV*
Win16:   *Win3*1*
Win16:   *16bit*
Win16:   *Windows 3*1*
Win16:   *Win16*
Win31:   *16bit*
Win32:   *95/NT*
Win95:   *Win95*
Win95:   *Windows 95*
Win98:   *Win98*
Win98:   *Windows 98*
Win2000: *Windows NT 5.0*
Win2000: *Win2000*
Win2000: *Windows 4.10*
Win2000: *Windows 2000*
WinCE:   *Windows CE*
WinME:   *9x 4.90*
WinNT:   *Windows NT*
WinNT:   *WinNT*
WinXP:   *Windows NT 5.[1-9]*
VMS:     *VAX*
VMS:     *OpenVMS*