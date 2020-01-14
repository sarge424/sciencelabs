<?php
require_once '../db.php';
require_once '../checksession.php';

$date = $_GET['date'];
$time = $_GET['time'];
$lab = $_SESSION['lab'];
$class = $_GET['class'];

$month = (int) date("m");
$user_month = (int) substr($date, 0, 2);
$next_month = $month + 1;
if ($next_month == 13) {
    $next_month = 1;
}
$user_date = (int) substr($date, 3, 5);

if (($user_month == $month && $user_date >= (int) date("d")) || $user_month == $next_month) {
    $user = $_SESSION['user'];

    $sql = "select date_format(booked_date, '%m/%d/%Y') as booked_date, booked_time, lab from lab_booking where date_format(booked_date, '%m/%d/%Y')='" . $date . "'and booked_time='" . $time . "';";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo 'Time already taken!';
    } else {
        $sql = 'select id from class where class_name="' . $class . '"';
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $class = $row['id'];
            }
        }
        $date = date_create($date);
        $date = date_format($date, 'Y-m-d');
        $sql = "insert into lab_booking (booked_date, booked_time, teacher_id, class_id, lab) values ('" . $date . "', '" . $time . "', " . $user . ", " . $class . ", '" . $_SESSION['lab'] . "');";
        $conn->query($sql);
        echo 'Lab successfully booked on ' . $date . ' between ' . $time;
    }
} else {
    echo 'Date or Month not valid!';
}
