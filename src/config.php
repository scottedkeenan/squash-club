<?php
	$servername = 'squash-club_devmysql_1';
	//$username = 'clubadmin';
	//$password = 'aZKAoXzGFVDlPGxz';
	//$servername = 'localhost';
	$username = 'newuser';
	$password = 'password';
	$dbname = 'squash_club';
	$tablename = 'bookingcalendar';

    $pythonScriptName = './test.py';

	// translate these
	$months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
	$headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
    
    $bookingSlotStartTime = '9:00';
    $bookingSlotEndTime = '22:00';
    $bookingSlotDuration = '40 min';
?>
