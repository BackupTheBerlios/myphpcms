<?php
	// Crude PHP library to append text messages to a file
	//
	// This is very simple and inefficient because it requires that the
	// file being written to is opened and closed each time a line is
	// written to it but by doing that it prevents the need to declare
	// the file pointer as a global variable.  And anyway, since we're
	// debugging speed won't really matter !
	
	// Public functions:
	//
	// debug_begin		- write header information to debugging file
	// debug_write		- write specified line of text to file
	// debug_end		- write closing information to debugging file
	// debug_delete		- delete debugging file
	//
	// Private functions
	//
	// open_debug_file	- open file for debugging, return file handle
	// close_debug_file	- close file associated with file handle supplied
	
	// Usage:
	// Access to the debugging functions require that lib_debugging be included
	// in the file being debugged.  This is done by using the command:
	//
	//	include ("lib_debugging.php");
	//
	// Then the debugging system must be started with a call to:
	//
	//	debug_begin("/tmp/template_debug.txt")
	//
	// if the debug file already exists then it should be delete first in 
	// order to avoid errors.  This can be done with the command:
	//
	// 	debug_delete("/tmp/template_debug.txt");
	//
	// Lines of debug information can then be written out to the file with
	// the command:
	//
	// 	debug_write("/tmp/template_debug.txt","Templating system started");
	
	// Public functions
	
	function debug_begin($filepathname) {
		// Open file to write to
		$fp=open_debug_file($filepathname);
		// Add header at start of file (76 chars wide)
		$start_date=date("H:i:s d/m/Y");
		// Write out to debug file
		fwrite($fp,'+--------------------------------------------------------------------------+' ."\n");
		fwrite($fp,'+ SIMPLE DEBUGGING SYSTEM                                                  +' ."\n");
		fwrite($fp,'+ -----------------------                                                  +' ."\n");
		fwrite($fp,'+                                                                          +' ."\n");
		fwrite($fp,"+ Started on $start_date                                           +" ."\n");
		fwrite($fp,'+                                                                          +' ."\n");
		fwrite($fp,'+--------------------------------------------------------------------------+' ."\n");
		fwrite($fp,' ' ."\n");
		// Close file
		close_debug_file($fp);
	}
		
	function debug_write($filepathname, $lineoftext) {
		//Open file to write to
		$fp=open_debug_file($filepathname);
		// Format time string
		$time_now=date("[H:i:s]");
		$output_text = $time_now . " " .$lineoftext;
		// Write out line of text
		fwrite($fp,$output_text);
		fwrite($fp, '' ."\n");
		// Close debug file
		close_debug_file($fp);
	}
	
	function debug_end($filepathname) {
		// Open file to write to
		$fp=open_debug_file($filepathname);
		// Add header at start of file (76 chars wide)
		$end_date=date("H:i:s d/m/Y");
		// Write out to debug file
		fwrite($fp,'+--------------------------------------------------------------------------+' ."\n");
		fwrite($fp,'+ SIMPLE DEBUGGING SYSTEM                                                  +' ."\n");
		fwrite($fp,'+ -----------------------                                                  +' ."\n");
		fwrite($fp,'+                                                                          +' ."\n");
		fwrite($fp,"+ Finished on $end_date                                          +" ."\n");
		fwrite($fp,'+                                                                          +' ."\n");
		fwrite($fp,'+--------------------------------------------------------------------------+' ."\n");
		fwrite($fp,' ' ."\n");
		// Close file
		close_debug_file($fp);
	}
	
	function debug_delete($filepathname) {
		unlink($filepathname);
	}
	
	// Private functions
	
	function open_debug_file($filenamepath) {
		$fp=fopen($filenamepath,"a+");
		return $fp;
	}
	
	function close_debug_file ($fp) {
		fclose($fp);	
	}
?>