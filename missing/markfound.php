<?php
require_once '../db.php';
require_once '../checkSession.php';

$missing_id = $_GET['id'];
$item_id;
$quantity;

$sql = "select * from missing where id=" . $missing_id . ";";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $item_id = $row['item_id'];
    $quantity = $row['quantity'];
}

$sql = "update item set quantity=quantity+" . $quantity . " where id=" . $item_id . ";";
$conn->query($sql);

$sql = "delete from missing where id=" . $missing_id . ";";
$conn->query($sql);

$sql = "update student_checkout set lost='N', returned_date=now(),  ;";
$conn->query($sql);
$conn->close();
