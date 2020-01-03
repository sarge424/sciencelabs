<?php
    require_once '../db.php';
    require_once '../checkSession.php';

    $expid = $_POST['expid'];
    $quan = $_POST['quantity'];
    $bookid = $_POST['bookingid'];

    $sql = 'INSERT INTO item_booking (exp_id, quantity, labbooking_id) VALUES ('.$expid.','.$quan.','.$bookid.');';

    $conn->query($sql);

    echo '<script>alert("Items Booked!");document.location.href = "/bookings/";</script>';
?>