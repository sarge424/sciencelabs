<?php
$servername = 'localhost';
$username = 'labs_user';
$password = 'hello_world';
$dbname = 'labs';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
