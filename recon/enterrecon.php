<?php
require_once '../db.php';
require_once '../checksession.php';

$item = $_GET['item'];
$specs = $_GET['specs'];
$quantity = $_GET['quantity'];
$req_quantity = 0;

$sql = "select quantity from item where item_name='" . $item . "' and specs='" . $specs . "';";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $req_quantity = $row['quantity'];
}

$quan_left = $req_quantity - $quantity;

if ($quan_left > 0) {
    $id = 0;
    $sql = "select id from item where item_name='" . $item . "' and specs='" . $specs . "'";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
    }

    $sql = "insert into missing (item_id, quantity, comments) values (" . $id . ", " . $quan_left . ", 'Lost during reconciliation');";
    $conn->query($sql);
}

$sql = "update item set quantity=" . $quantity . ", recon=now(), lost_quantity=" . $quan_left . " where item_name='" . $item . "' and specs='" . $specs . "';";
$conn->query($sql);

$conn->close();
