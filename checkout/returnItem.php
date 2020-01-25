<?php
require_once '../db.php';
require_once '../checksession.php';

$checkout_id = $_GET['checkout_id'];
$ret_q = $_GET['ret_quantity'];

$taken_quant = $conn->query('select quantity from student_checkout where id='.$checkout_id.';')->fetch_assoc()['quantity'];
if($ret_q >= $taken_quant)
    $sql = "update student_checkout set returned='Y', returned_date=now() where id=" . $checkout_id . ";";
else
    $sql = "update student_checkout set quantity=quantity-".$ret_q." where id=" . $checkout_id . ";";
$conn->query($sql);
$conn->close();
