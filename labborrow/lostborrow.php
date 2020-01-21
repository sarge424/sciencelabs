<?php
require_once '../db.php';
require_once '../checksession.php';

$checkout_id = $_GET['checkout_id'];

$sql = "update lab_borrow set item_status='LOST', return_date=now() where id=" . $checkout_id . ";";
echo $sql;
$conn->query($sql);

$sql = "select * from lab_borrow where id=" . $checkout_id . ";";
$res = $conn->query($sql)->fetch_assoc();

$sql = "insert into missing (item_id, quantity, comments) values (" . $res['item_id'] . ", " . $res['quantity'] . ", 'Lost by " . $res['to_lab'] . "');";
$conn->query($sql);

$sql = "update item set lost_quantity=lost_quantity+" . $res['quantity'] . " where id=" . $res['item_id'] . ";";
$conn->query($sql);
$conn->close();