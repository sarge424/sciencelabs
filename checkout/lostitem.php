<?php
require_once '../db.php';
require_once '../checksession.php';

$student = $_GET['student'];
$item = $_GET['item'];
$quantity = $_GET['quantity'];
$checkout_id = $_GET['checkout_id'];

$sql = "update student_checkout set lost='Y', returned='Y', returned_date=now() where id=" . $checkout_id . ";";
echo $sql;
$conn->query($sql);

$sql = "select student_name from student where id=" . $student . ";";
$student = $conn->query($sql)->fetch_assoc()['student_name'];

$sql = "insert into missing (item_id, quantity, comments) values (" . $item . ", " . $quantity . ", 'Lost by " . $student . "');";
$conn->query($sql);

$sql = "update item set lost_quantity=" . $quantity . " where id=" . $item . ";";
$conn->query($sql);
$conn->close();
