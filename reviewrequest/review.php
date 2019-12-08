<?php
require_once '../db.php';

$item = $_GET['item'];
$quantity = $_GET['quantity'];
$specs = $_GET['specs'];
$comment = $_GET['comments'];
$bill = $_GET['bill'];

$sql = "update purchase_request set arrived=1, date_arrived=now(), comments='" . $comment . "', bill_code='" . $bill . "' where item_name='" . $item . "' and quantity=" . $quantity . " and specs='" . $specs . "';";
$conn->query($sql);

$sql = "select * from item where item_name='" . $item . "' and specs='" . $specs . "';";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    $sql = "insert into item(item_name, quantity, specs) values ('" . $item . "', " . $quantity . ", '" . $specs . "');";
    $conn->query($sql);
} else {
    $sql = "update item set quantity=quantity+" . $quantity . " where item_name='" . $item . "' and specs='" . $specs . "';";
    $conn->query($sql);
}

$conn->close();

header("Location: ../reviewrequest");
exit;
