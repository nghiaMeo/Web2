<?php
DEFINE('DB_USER','root');
DEFINE('DB_PASSWORD','');
DEFINE('DB_HOST','localhost');
DEFINE('DB_NAME','plane');

$dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME)
OR die('Could not connect to MySQL:' .
	mysqli_connect_error());

	function createDBConnection() {
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "plane";
	
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
	
		return $conn;
	}
