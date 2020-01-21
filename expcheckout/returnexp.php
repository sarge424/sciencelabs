<?php
require_once '../db.php';
require_once '../checksession.php';

$checkout_id = $_GET['checkout_id'];

$sql = "update item_booking set returned='Y' where id=" . $checkout_id . ";";
$conn->query($sql);
$conn->close();