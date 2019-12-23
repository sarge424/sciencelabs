<?php
require_once '../db.php';
require_once '../checksession.php';

$student = $_GET['student'];
$item = $_GET['item'];
$quantity = $_GET['quantity'];

$sql = "update student_checkout set returned=1 where student_id=" . $student . " and item_id=" . $item . " and quantity=" . $quantity . " and lab='" . $_SESSION['lab'] . "';";
$conn->query($sql);