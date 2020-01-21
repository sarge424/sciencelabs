<?php
require_once '../db.php';
require_once '../checksession.php';

$checkout_id = $_GET['checkout_id'];

$sql = "update lab_borrow set item_status='RETURNED', return_date=now() where id=" . $checkout_id . ";";
$conn->query($sql);
$conn->close();