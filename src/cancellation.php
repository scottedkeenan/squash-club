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
      maxDate: +8,
      changeMonth: false,
      numberOfMonths: 2,
      onClose: function( selectedDate ) {
        $( "#to" ).datepicker( "option", "minDate", selectedDate );
      }
    });
  });  </script>
</head>

<body>

<?php
    include 'config.php';

    $memberName = $_GET["username"];

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,  $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>

<h1>Worksop Squash Club</h1>
<table border="1" cellpadding="5" width="800">
	<tr>
		<td valign="top">
		<form action="cancel.php" method="post">
			<h3>Cancel Booking</h3>
            <p><?php echo sprintf('Name: %s', $memberName)?></p>
            <select name="booking">
            <?php
            date_default_timezone_set('GMT');
            $d = strtotime('today midnight');
            print_r('|' . $d . '|');
            $sql = "SELECT * FROM $tablename WHERE `name`='$memberName' AND `day` >= $d";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($result)) {
                    echo sprintf(
                            '<option value="%s">%s %s %s</option>',
                            $row['id'],
                            $row['court'],
                            date('D j M',$row['day']),
                            $row['start_time']
                    );
                }
            }
            ?>
            </select>
			<input name="cancel" type="submit" value="Cancel" />
		</form>
		</td>
	</tr>
</table>

<a href="index.php"><p>Back to the booking calendar</p></a>

</body>

</html>
