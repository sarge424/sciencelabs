<?php
require_once '../db.php';
require_once '../checksession.php';

if($_SESSION['level'] == 1){
    $sql = 'select * from lab_borrow where item_status="PENDING";';
} else {
    $sql = 'select * from lab_borrow where from_lab="' . $_SESSION['lab'] . '" and item_status="PENDING";';
}
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $sql = 'select * from item where id=' . $row['item_id'] . ';';
        $item = $conn->query($sql);
        $item = $item->fetch_assoc()['item_name'];

        echo '<tr id="row' . $row['id'] . '">' .
            '<td id="' . $row['item_id'] . '">' . $item .
            '<td>' . $row['quantity'] .
            '<td>' . $row['transfer_date'] .
            '<td>' . $row['to_lab'] .
            '<td><button class="btn btn-warning btn-sm" onclick="arrived(' . $row['id'] . ')">Returned</button>' .
            '<td><button class="btn btn-danger btn-sm" onclick="lost(' . $row['id'] . ')">Lost</button>';
    }
}
