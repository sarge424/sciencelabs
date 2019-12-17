<?php 
require_once '../db.php';
require_once '../checkSession.php';

$date = $_GET['date'];
$sql = "select date_format(booked_date, '%Y %m %d') from lab_booking where lab='" . $_SESSION['lab'] . "' and date_format(booked_date, '%Y %m %d')='" . $date . "';";
$result = $conn->query($sql);

echo $result->num_rows;
?>