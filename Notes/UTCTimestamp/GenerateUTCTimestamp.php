<?php 

/*
Since PHP 5.1.0 (when the date/time functions were rewritten), every call to a date/time function 
will generate a E_NOTICE if the timezone isn't valid, and/or a E_WARNING message if using the system settings or the TZ environment variable.
So in order to get a UTC timestamp you should check what the current timezone is and work off of that or just use:
*/

/*
 * this will generate a UTC timestamp built off the timezone of the server
 * */

$utc_str = gmdate("M d Y H:i:s", time());
$utc = strtotime($utc_str);



?>