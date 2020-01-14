<?php
require_once '../db.php';
require_once '../checksession.php';

$sql = "select * from purchase_request where arrived=1 and lab='" . $_SESSION["lab"] . "';";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $sql = "select teacher_name from teacher where id=" . $row['teacher_id'] . ";";
    $teacher = $conn->query($sql);
    echo "<tr>
            <td>" . $teacher->fetch_assoc()['teacher_name'] . "
            <td>" . $row['item_name'] . " 
            <td>" . $row['quantity_ordered'] . "
            <td>" . $row['quantity_received'] . "
            <td>" . $row['specs'] . "
            <td>" . $row['date_ordered'] . "
            <td>" . $row['date_arrived'] . "
            <td>" . $row['comments'] . "
            <td>" . $row['bill_code'];
}
