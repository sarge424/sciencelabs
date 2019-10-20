<?php require_once '../db.php'; ?>
<?php
global $conn;

$date = $_GET['date'];
$sql = "select date_format(booked_date, '%Y %m %d') from lab_booking where date_format(booked_date, '%Y %m %d')='" . $date . "';";
$result = $conn->query($sql);

echo $result->num_rows;
?>