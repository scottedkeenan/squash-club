<?php
	include 'config.php';
	
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	
	// sql to create table
	$sql = "CREATE TABLE $tablename (
		id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		name VARCHAR(50) NOT NULL,
		phone VARCHAR(20) NOT NULL,
		court VARCHAR(20) NOT NULL,
		day INT(11),
		start_time VARCHAR(11),
		canceled INT(1)
	)";
	
	if (mysqli_query($conn, $sql)) {
		echo "Table " . $tablename . " created successfully";
	} else {
		echo "Error creating table: " . mysqli_error($conn);
	}
	
	mysqli_close($conn);
?>
