<?php
require_once '../db.php';
require_once '../checkSession.php';

$missing_id = $_GET['id'];
$item_id;
$quantity;

$sql = "select * from missing where id=" . $id . ";";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $item_id = $row['item_id'];
    $quantity = $row['quantity'];
}

$sql = "update item set quantity=quantity+" . $quantity . " where id=" . $item_id . ";";
$conn->query($sql);
$conn->close();
