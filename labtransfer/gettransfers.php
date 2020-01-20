<?php
require_once '../db.php';
require_once '../checksession.php';

if($_SESSION['level'] == 1){
    $sql = "select * from dept_transaction;";
} else {
    $sql = "select * from dept_transaction where from_lab='" . $_SESSION['lab'] . "';";
}
$result = $conn->query($sql);

$data = "";

if ($result->num_rows != 0) {
    while ($row = $result->fetch_assoc()) {
        $sql = "select item_name from item where id=" . $row['item_id'] . ";";
        $item = $conn->query($sql);
        $item_name = "";
        while ($id = $item->fetch_assoc()) {
            $item_name = $id['item_name'];
        }

        $data = $data .
            '<tr>' .
            '<td>' . strtoupper($row['from_lab']) .
            '<td>' . strtoupper($row['to_lab']) .
            '<td>' . $item_name .
            '<td>' . $row['quantity'] .
            '<td>' . $row['transfer_date'];
    }
}
echo $data;
