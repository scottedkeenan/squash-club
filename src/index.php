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
    

    

body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
} 
    
</style>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Worksop Squash Club</title>
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

<h1>Worksop Squash Club</h1>

<!-- Trigger/Open The Modal -->
<button id="book-button">Make Booking</button>
<button id="cancel-button">Cancel Booking</button>

<!-- The Book Modal -->
<div id="bookModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span id="book-close" class="close">&times;</span>
    <p id="book-message">Please scan your fob now</p>
    <form id="booking_proceed_form" action="booking.php">
        <input id="proceed_to_book" hidden="" type="submit" value="Make Booking">
        <input id="book-username" name="username" type="hidden" value="none">
    </form>     
  </div>
</div>

<script>
// Get the modal
var bookModal = document.getElementById("bookModal");

// Get the button that opens the modal
var bookButton = document.getElementById("book-button");

// Get the span element that closes the modal
var bookCloseSpan = document.getElementById("book-close");

// When the user clicks the button, open the modal 
bookButton.onclick = function() {
  bookModal.style.display = "block";
    
  jQuery.ajax({
       type: "POST",
       url: "scan.php",
       success: function (msg) {
           $('#book-username').val(msg.trim());
           $('#book-message').text("Welcome, " + msg);
           $('#proceed_to_book').show();
       }
});
      
}

// When the user clicks anywhere outside of the modal, close it

</script>

<!-- The Cancel Modal -->
<div id="cancelModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <span id="cancel-close" class="close">&times;</span>
        <p id="cancel-message">Please scan your fob now</p>
        <form id="cancel_proceed_form" action="cancellation.php">
            <input id="cancel-username" name="username" type="hidden" value="none">
            <input id="proceed_to_cancel" hidden="" type="submit" value="Make a Cancellation">
        </form>
    </div>
</div>

<script>
// Get the modal
var cancelModal = document.getElementById("cancelModal");

// Get the button that opens the modal
var cancelButton = document.getElementById("cancel-button");

// Get the span element that closes the modal
var cancelCloseSpan = document.getElementById("cancel-close");

// When the user clicks the button, open the modal
cancelButton.onclick = function() {
    cancelModal.style.display = "block";

    jQuery.ajax({
        type: "POST",
        url: "scan.php",
        success: function (msg) {
            $('#cancel-username').val(msg.trim());
            $('#cancel-message').text("Welcome, " + msg.trim());
            $('#proceed_to_cancel').show();
        }
    });

}

// When the user clicks on <span> (x), close the modal
bookCloseSpan.onclick = function() {
    bookModal.style.display = "none";
    $('#modal_message').text("Please scan your fob now");
    $('#bookings-to-cancel').hide();
    $('#proceed_to_cancel').hide();
    $('#username').val(null);
}

// When the user clicks on <span> (x), close the modal
cancelCloseSpan.onclick = function() {
    cancelModal.style.display = "none";
    $('#modal_message').text("Please scan your fob now");
    $('#proceed_to_book').hide();
    $('#username').val(null);
}

// When the user clicks anywhere outside of the modal, close it
//todo: also reset the modal
window.onclick = function(event) {
    if (event.target == cancelModal) {
        cancelModal.style.display = "none";
        $('#modal_message').text("Please scan your fob now");
        $('#bookings-to-cancel').hide();
        $('#proceed_to_cancel').hide();
        $('#username').val(null);
    }
    if (event.target == bookModal) {
        bookModal.style.display = "none";
        $('#modal_message').text("Please scan your fob now");
        $('#proceed_to_book').hide();
        $('#username').val(null);
    }
}
</script>


<!-- ================================================ -->
    
<?php
/* draws a calendar */
function draw_calendar($month,$year){

	include 'config.php';

	// Create connection
	$conn = mysqli_connect($servername, $username, $password,  $dbname);

	// Check connection
	if (!$conn) {
    	die("Connection failed: " . mysqli_connect_error());
	}

	/* draw table */
	$calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

	/* table headings */
	$calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

	/* days and weeks vars now ... */
	$running_day = date('w',mktime(0,0,0,$month,1,$year));
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();

	/* row for week one */
	$calendar.= '<tr class="calendar-row">';

	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np"> </td>';
		$days_in_this_week++;
	endfor;

	/* keep going with days.... */
	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
		$calendar.= '<td class="calendar-day">';
			/* add in the day number */
			$calendar.= '<div class="day-number">'.$list_day.'</div>';

			/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
			$calendar.= str_repeat('<p> </p>',2);
			$current_epoch = mktime(0,0,0,$month,$list_day,$year);
			
			$sql = "SELECT * FROM $tablename WHERE $current_epoch BETWEEN day AND day";  
						
			$result = mysqli_query($conn, $sql);
    		
    		if (mysqli_num_rows($result) > 0) {
    			// output data of each row
    			while($row = mysqli_fetch_assoc($result)) {
					if($row["canceled"] == 1) $calendar .= "<font color=\"grey\"><s>";
    				$calendar .= "<b>" . $row["court"] . "</b><br>" . $row["name"] . "<br>";
//    				if($current_epoch == $row["day"] AND $current_epoch != $row["day"]) {
//    					$calendar .= "Booking starts: " . sprintf("%02d:%02d", $row["start_time"]/60/60, ($row["start_time"]%(60*60)/60)) . "<br><hr><br>";
//    					$calendar .= "Booking starts: " . sprintf("%02d:%02d", $row["start_time"]/60/60, ($row["start_time"]%(60*60)/60)) . "<br><hr><br>";
//    				}
    				if($current_epoch == $row["day"]) {
    					$calendar .= $row["start_time"] . "<br><br>";
    				}
					if($row["canceled"] == 1) $calendar .= "</s></font>";
    			}
			} else {
    			$calendar .= "No bookings";
			}
			
		$calendar.= '</td>';
		if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;
	endfor;

	/* finish the rest of the days in the week */
	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<td class="calendar-day-np"> </td>';
		endfor;
	endif;

	/* final row */
	$calendar.= '</tr>';

	/* end the table */
	$calendar.= '</table>';
	
	mysqli_close($conn);
	
	/* all done, return result */
	return $calendar;
}

include 'config.php';

$d = new DateTime(date("Y-m-d"));
echo '<h3>' . $months[$d->format('n')-1] . ' ' . $d->format('Y') . '</h3>';
echo draw_calendar($d->format('m'),$d->format('Y'));

$d->modify( 'first day of next month' );
echo '<h3>' . $months[$d->format('n')-1] . ' ' . $d->format('Y') . '</h3>';
echo draw_calendar($d->format('m'),$d->format('Y'));

?>

</body>

</html>
