<?php
require_once '../db.php';
require_once '../checksession.php';

$teacher = $_GET['teacher'];
$item = $_GET['item'];
$quantity_ordered = $_GET['quantityo'];
$quantity_received = $_GET['quantityr'];
$specs = $_GET['specs'];
$comment = $_GET['comments'];
$bill = $_GET['bill'];
$id = $_GET['id'];

$sql = "update purchase_request set arrived=1, date_arrived=now(), comments='" . $comment . "', bill_code='" . $bill . "', quantity_received=" . $quantity_received . " where id=" . $id . ";";
$conn->query($sql);

$sql = "select * from item where item_name='" . $item . "' and specs='" . $specs . "' and lab='" . $_SESSION['lab'] . "';";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    $sql = "insert into item(item_name, quantity, specs, lab) values ('" . $item . "', " . $quantity_received . ", '" . $specs . "', '" . $_SESSION['lab'] . "');";
    $conn->query($sql);
} else {
    $sql = "update item set quantity=quantity+" . $quantity_received . " where item_name='" . $item . "' and specs='" . $specs . "' and lab='" . $_SESSION['lab'] . "';";
    $conn->query($sql);
}

if ($quantity_ordered > $quantity_received) {
    $sql = "select * from purchase_request where id=" . $id . ";";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $teacher = $row['teacher_id'];
    $item = $row['item_name'];
    $quantity_ordered = $quantity_ordered - $quantity_received;
    $specs = $row['specs'];
    $link = $row['link'];
    $cost = $row['cost'];
    $sql = "insert into purchase_request (teacher_id, item_name, quantity_ordered, specs, link, cost) values (" . $teacher . ", '" . $item . "', " . $quantity_ordered . ", '" . $specs . "', '" . $specs . "', " . $cost . ");";
    $conn->query($sql);
}

$conn->close();

header("Location: ../reviewrequest");
exit;
