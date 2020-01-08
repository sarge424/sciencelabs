<?php
require_once '../db.php';
require_once '../checkSession.php';

$exp = $_POST['expname'];
$quan = $_POST['quantity'];
$bookid = $_POST['bookingid'];

$sql = "select id from experiment where exp_name='" . $exp . "'";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $exp = $row['id'];
}

$sql = 'INSERT INTO item_booking (exp_id, quantity, labbooking_id) VALUES (' . $exp . ',' . $quan . ',' . $bookid . ');';
$conn->query($sql);
echo '<script>alert("Items Booked!");document.location.href = "../bookings/";</script>';
