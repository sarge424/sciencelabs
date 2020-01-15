<?php
require_once '../db.php';
require_once '../checksession.php';

$checkout_id = $_GET['checkout_id'];

$sql = "update student_checkout set returned='Y', returned_date=now() where id=" . $checkout_id . ";";
$conn->query($sql);
$conn->close();
