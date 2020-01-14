<?php
require_once '../db.php';
require_once '../checkSession.php';

$exp = $_POST['expname'];
$quan = $_POST['quantity'];
$bookid = $_POST['bookingid'];
$has_enough_stock = true;
$low_stock_itemname = 0;

$sql = "delete from item_booking where labbooking_id='" . $bookid . "';";
$conn->query($sql);

$sql = "select id from experiment where exp_name='" . $exp . "'";
$exp = $conn->query($sql)->fetch_assoc()['id'];

//make sure items are in stock
$sql = 'select item_id, quantity from experiment_item where exp_id='.$exp.';';
$result = $conn->query($sql);
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $sql = 'select quantity, item_name from item where id='.$row['item_id'].';';
        $in_stock = $conn->query($sql)->fetch_assoc()['quantity'];
        $itemname = $conn->query($sql)->fetch_assoc()['item_name'];
        if($in_stock < $row['quantity']*$quan){
            $has_enough_stock = false;
            $low_stock_itemname = $itemname;
        }
    }

    $sql = 'INSERT INTO item_booking (exp_id, quantity, labbooking_id) VALUES (' . $exp . ',' . $quan . ',' . $bookid . ');';
    if($has_enough_stock){
        $conn->query($sql);
        echo '<script>alert("Items Booked!");document.location.href = "../bookings/";</script>';
    }else{
        echo '<script>alert("Not enough stock for '.$low_stock_itemname.'");window.history.back();</script>';
    }
}else{
    echo '<script>alert("Experiment does not exist!");window.history.back();</script>';
}

