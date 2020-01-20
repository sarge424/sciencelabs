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
    $sql = "insert into dept_transaction (from_lab, item_id, quantity, to_lab) values ('" . $_SESSION['lab'] . "', " . $id . ", " . $quan . ", '" . $tolab . "');";
    $conn->query($sql);

    $sql = "update item set quantity=" . ($quantity - $quan) . " where id=" . $id . " and lab='" . $_SESSION['lab'] . "';";
    $conn->query($sql);

    $sql = "select item_name, specs from item where id=" . $id . " and lab='" . $_SESSION['lab'] . "';";
    $item_name = $conn->query($sql)->fetch_assoc()['item_name'];
    $specs = $conn->query($sql)->fetch_assoc()['specs'];

    $sql = "select id from item where lab='" . $tolab . "' and item_name='" . $item_name . "' and specs='" . $specs . "';";
    echo $sql;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $id = $result->fetch_assoc()['id'];
        $sql = "update item set quantity=quantity+" . $quan . " where id=" . $id . ";";
    } else {
        $sql = "insert into item (item_name, specs, quantity, lab) values ('" . $item_name . "', '" . $specs . "', " . $quan . ", '" . $tolab . "');";
    }
    $conn->query($sql);

    echo "Item Transfered";
}
$conn->close();
