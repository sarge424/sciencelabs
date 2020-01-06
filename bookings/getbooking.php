<?php
require_once '../db.php';
require_once '../checksession.php';

$times = array("09:35 - 10:55", "11:10 - 12:30", "01:30 - 02:50", "03:05 - 04:25");
$date = $_GET['date'];
$time = $_GET['row'];

$time = $times[$time];
$sql = "select id from lab_booking where booked_time='" . $time . "' and date_format(booked_date, '%Y %m %d')='" . $date . "';";
$result = $conn->query($sql);

$id;
while ($row = $result->fetch_assoc()) {
    $id = $row['id'];
}

echo $id;
