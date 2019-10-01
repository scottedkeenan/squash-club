<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Make booking</title>
</head>

<body>

<?php

include 'config.php';

// Create connection
$conn = mysqli_connect($servername, $username, $password,  $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$day = intval(strtotime(htmlspecialchars($_POST["day"])));
//$start_time = (60*60*intval(htmlspecialchars($_POST["start_time"])));
$start_time = htmlspecialchars($_POST["start_time"]);
$name = htmlspecialchars($_POST["name"]);
$phone = htmlspecialchars($_POST["phone"]);
$court = htmlspecialchars($_POST["court"]);

//$start_epoch = $start_day + $start_time;
//$end_epoch = $end_day + $end_time;

// prevent double booking
$sql = "SELECT * FROM $tablename WHERE court='$court' AND day='$day' AND start_time='$start_time' AND canceled=0";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    echo '<h3><font color="red">Unfortunately ' . $court . ' has already been booked for ' . $start_time . '</font></h3>';
    goto end;		
}

$sql = "INSERT INTO $tablename (name, phone, court, day, start_time, canceled)
    VALUES ('$name','$phone', '$court', $day, '$start_time', 0)";
if (mysqli_query($conn, $sql)) {
    echo "<h3>Booking successful.</h3>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

end:
mysqli_close($conn);
?>

<a href="index.php"><p>Back to the booking calendar</p></a>

</body>

</html>
