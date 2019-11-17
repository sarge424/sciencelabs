<?php
require_once '../db.php';

$item = $_GET['item'];
$quantity = $_GET['quantity'];
$specs = $_GET['specs'];

$sql = "update purchase_request set arrived=1 where item_name='".$item."' and quantity=".$quantity." and specs='".$specs."';";

$conn->query($sql);
$conn->close();

header("Location: ../reviewrequest");
exit;