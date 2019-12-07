<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<style>
html *
{
   font-family: Arial !important;
}
table.calendar {
	border-left: 1px solid #999;
}
tr.calendar-row {
}
td.calendar-day {
	min-height: 80px;
	font-size: 11px;
	position: relative;
	vertical-align: top;
}
* html div.calendar-day {
	height: 80px;
}
td.calendar-day:hover {
	background: #eceff5;
}
td.calendar-day-np {
	background: #eee;
	min-height: 80px;
}
* html div.calendar-day-np {
	height: 80px;
}
td.calendar-day-head {
	background: #ccc;
	font-weight: bold;
	text-align: center;
	width: 120px;
	padding: 5px;
	border-bottom: 1px solid #999;
	border-top: 1px solid #999;
	border-right: 1px solid #999;
}
div.day-number {
	background: #999;
	padding: 5px;
	color: #fff;
	font-weight: bold;
	float: right;
	margin: -5px -5px 0 0;
	width: 20px;
	text-align: center;
}
td.calendar-day, td.calendar-day-np {
	width: 120px;
	padding: 5px;
	border-bottom: 1px solid #999;
	border-right: 1px solid #999;
}
</style>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Worksop Squash Club</title>
<link href="jquery-ui.css" rel="stylesheet">
<script src="jquery-1.10.2.js"></script>
<script src="jquery-ui.js"></script>
<!--<script src="lang/datepicker-en-GB.js"></script>-->
<script>
    $(function() {
//	$.datepicker.setDefaults($.datepicker.regional['en-GB']);
    $( "#from" ).datepicker({
      minDate: 0,
      maxDate: +7,
      changeMonth: false,
      numberOfMonths: 1,
      onClose: function( selectedDate ) {
        $( "#to" ).datepicker( "option", "minDate", selectedDate );
      }
    });
  });  </script>
</head>

<body>

<?php 
    include 'config.php';
    
    // get the user id from python script
    $command = escapeshellcmd($pythonScriptName);
    $userName = shell_exec($command);
?>

<h1>Worksop Squash Club</h1>
<table border="1" cellpadding="5" width="800">
	<tr>
		<td valign="top">
		<form action="book.php" method="post">
			<h3>Make booking</h3>
			<p><input name="court" checked="checked" type="radio" value="court-one" />Court One 
			| <input name="court" type="radio" value="court-two" />Court Two
            <table style="width: 70%">
				<tr>
					<td>Name:</td>
					<td> <input maxlength="50" name="name" required="" readonly="true" type="text" value="<?php echo $userName ?>"/></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>Reservation date:</td>
					<td><input id="from" name="day" required="" type="text" /></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td> 
                    <select name="start_time">
                        
                        <?php
                        include 'config.php';
                        date_default_timezone_set('GMT');
                        $startTime = new DateTime($bookingSlotStartTime);
                        $endTime = new DateTime($bookingSlotEndTime);
                        $interval = DateInterval::createFromDateString($bookingSlotDuration);
                        $times    = new DatePeriod($startTime, $interval, $endTime);
                        
                        foreach ($times as $time) { ?>
                            <option><?php echo $time->format('H:i'), '-', $time->add($interval)->format('H:i')?></option>
                        <?php } ?>
			         </select>
                    </td>
				</tr>
			</table>
			<p>
			<input name="book" type="submit" value="Book" />
		</form>
		</td>
	</tr>
</table>

<a href="index.php"><p>Back to the booking calendar</p></a>

</body>

</html>
