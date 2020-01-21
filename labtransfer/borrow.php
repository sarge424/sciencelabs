<?php
require_once '../db.php';
require_once '../checksession.php';

$tolab = $_GET['tolab'];
$quan = $_GET['quantity'];
$id = $_GET['id'];

$sql = "select quantity from item where id=" . $id . " and lab='" . $_SESSION['lab'] . "';";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $quantity = $row['quantity'];
}

if ($quantity < $quan) {
    echo "Not enough stock";
} else {
    $sql = "insert into lab_borrow (from_lab, item_id, quantity, to_lab) values ('" . $_SESSION['lab'] . "', " . $id . ", " . $quan . ", '" . $tolab . "');";
    $conn->query($sql);

    $sql = "update item set quantity=" . ($quantity - $quan) . " where id=" . $id . " and lab='" . $_SESSION['lab'] . "';";
    $conn->query($sql);

    echo "Item Transfered";
}
$conn->close();
