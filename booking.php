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
<title>Booking calendar - DEMO</title>
<link href="jquery-ui.css" rel="stylesheet">
<script src="jquery-1.10.2.js"></script>
<script src="jquery-ui.js"></script>
<!--<script src="lang/datepicker-fi.js"></script>-->
<script>
    $(function() {
	<!--$.datepicker.setDefaults($.datepicker.regional['fi']);-->
    $( "#from" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 3,
      onClose: function( selectedDate ) {
        $( "#to" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#to" ).datepicker({
      defaultDate: "+1w",
	  regional: "fi",
      changeMonth: true,
      numberOfMonths: 3,
      onClose: function( selectedDate ) {
        $( "#from" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
  });  </script>
</head>

<body>

<h1>Booking calendar - DEMO</h1>
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
					<td> <input maxlength="50" name="name" required="" type="text" /></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>Phone:</td>
					<td>
			<input maxlength="20" name="phone" required="" type="text" /></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>Reservation time:</td>
					<td>
			<input id="from" name="day" required="" type="text" /></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td> <select name="start_time">
			<option selected="selected">08:00</option>
			<option>08:40</option>
			<option>09:20</option>
			<option>10:00</option>
			<option>10:40</option>
			<option>11:20</option>
			<option>12:00</option>
			<option>12:40</option>
			<option>13:20</option>
			<option>14:00</option>
			<option>14:40</option>
			<option>15:20</option>
			<option>16:00</option>
			<option>16:40</option>
			<option>17:20</option>
			<option>18:00</option>
			<option>18:40</option>
			<option>19:20</option>
			<option>20:00</option>
			<option>20:40</option>
			<option>21:20</option>
			<option>22:00</option>
			</select></td>
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
