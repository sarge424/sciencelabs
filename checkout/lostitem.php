<?php
require_once '../db.php';
require_once '../checksession.php';

$student_id = $_GET['student'];
$item = $_GET['item'];
$quantity = $_GET['quantity'];
$lost_quantity = $_GET['lost_q'];
$checkout_id = $_GET['checkout_id'];

$lost_quantity = ($lost_quantity > $quantity)? $quantity:$lost_quantity;

if($lost_quantity >= $quantity)
    $sql = "update student_checkout set lost='Y', returned='N', returned_date=now() where id=" . $checkout_id . ";";
else
    $sql = "update student_checkout set quantity=". ($quantity-$lost_quantity) ." where id=" . $checkout_id . ";";
$conn->query($sql);

$sql = "select student_name from student where id=" . $student_id . ";";
$student = $conn->query($sql)->fetch_assoc()['student_name'];

if($lost_quantity >= $quantity)
    $sql = "insert into missing (item_id, quantity, comments, checkout_id) values (" . $item . ", " . $quantity . ", 'Lost by " . $student . "', " . $checkout_id . ");";
else
    $sql = "insert into missing (item_id, quantity, comments, checkout_id) values (" . $item . ", " . $lost_quantity . ", 'Lost by " . $student . "', " . $checkout_id . ");";
$conn->query($sql);

$sql = "update item set lost_quantity=" . $lost_quantity . " where id=" . $item . ";";
$conn->query($sql);
$conn->close();
