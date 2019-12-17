<?php
require_once '../db.php';
require_once '../checkSession.php';

$teacher = $_GET['teacher'];
$item = $_GET['item'];
$quantity_ordered = $_GET['quantityo'];
$quantity_received = $_GET['quantityr'];
$specs = $_GET['specs'];
$comment = $_GET['comments'];
$bill = $_GET['bill'];

$fname = "people.txt";

$file = fopen($fname, 'a');
fwrite($file, $teacher . " " . $item . "\r\n");
fclose($file);

$sql = "update purchase_request set arrived=1, date_arrived=now(), comments='" . $comment . "', bill_code='" . $bill . "', quantity_received=" . $quantity_received . " where item_name='" . $item . "' and quantity_ordered=" . $quantity_ordered . " and specs='" . $specs . "' and lab='" . $_SESSION['lab'] . "';";
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

$conn->close();

header("Location: ../reviewrequest");
exit;
