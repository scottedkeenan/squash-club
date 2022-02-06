<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Cancel Booking</title>
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

$id = htmlspecialchars($_POST["booking"]);

$sql = sprintf("UPDATE $tablename SET canceled = 1 WHERE `id` = %s", $id);
if (mysqli_query($conn, $sql)) {
    echo "<h3>Cancellation successful.</h3>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

end:
mysqli_close($conn);
?>

<a href="index.php"><p>Back to the booking calendar</p></a>

</body>

</html>
