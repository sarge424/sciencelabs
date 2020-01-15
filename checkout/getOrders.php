<?php
require_once '../db.php';
require_once '../checksession.php';

$sql = 'select * from student_checkout where lab="' . $_SESSION['lab'] . '" and returned="N";';
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $checkout_id = $row['id'];

        $sql = 'select * from student where id=' . $row['student_id'] . ';';
        $student = $conn->query($sql);
        $student = $student->fetch_assoc()['student_name'];

        $sql = 'select * from item where id=' . $row['item_id'] . ';';
        $item = $conn->query($sql);
        $item = $item->fetch_assoc()['item_name'];

        echo '<tr id="row' . $checkout_id . '">' .
            '<td id="' . $row['student_id'] . '">' . $student .
            '<td id="' . $row['item_id'] . '">' . $item .
            '<td>' . $row['quantity'] .
            '<td>' . $row['checkout_date'] .
            '<td><button class="btn btn-warning btn-sm" onclick="arrived(' . $checkout_id . ')">Returned</button>' .
            '<td><button class="btn btn-danger btn-sm" onclick="lost(' . $checkout_id . ')">Lost</button>';
    }
}
