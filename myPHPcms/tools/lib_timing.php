<?php

// Libary to aid in the timing of the execution of scripts
//
// Usage: include("lib_timing.php");
//        timing_start('identifier');
//
//              Some PHP code to time
//
//        timing_stop(('identifier');
//        echo "Script took: " . timing_current(('identifier') . " seconds to run";
//

function timing_start ($name = 'default') {
	global $timing_start_times;
	$timing_start_times[$name] = explode(' ', microtime());
}

function timing_stop ($name = 'default') {
	global $timing_stop_times;
	$timing_stop_times[$name] = explode(' ', microtime());
}

function timing_current ($name = 'default') {
	global $timing_start_times, $timing_stop_times;
	if (!isset($timing_start_times[$name])) {
		return 0;
	}
	if (!isset($timing_stop_times[$name])) {
		$stop_time = explode(' ', microtime());
	}
	else {
		$stop_time = $timing_stop_times[$name];
	}
	// do the big numbers first so the small ones aren't lost
	$current = $stop_time[1] - $timing_start_times[$name][1];
	$current += $stop_time[0] - $timing_start_times[$name][0];
	return $current;
}
    
?>