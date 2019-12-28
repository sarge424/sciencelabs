<?php
require_once '../db.php';
require_once '../checksession.php';

$tolab = $_POST['tolab'];
$quan = $_POST['quantity'];
$itemspecs = $_POST['item'];

$item = explode(" (", $itemspecs);
$item = $item[0];
$specs = explode(")", $itemspecs);
if ($specs[1] != "") {
    $specs = trim($specs[1]);
} else {
    $specs = "";
}

$sql = "select id from item where item_name='" . $item . "' and specs='" . $specs . "' and lab='" . $_SESSION['lab'] . "';";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $item = $row['id'];
}

$sql = "insert into dept_transaction (from_lab, item_id, quantity, to_lab) values ('" . $_SESSION['lab'] . "', " . $item . ", " . $quan . ", '" . $tolab . "');";
$conn->query($sql);
