<?php
require_once "../db.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$sql = "select * from purchase_request where arrived=1 and lab='" . $_SESSION["lab"] . "';";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $sql = "select teacher_name from teacher where id=" . $row['teacher_id'] . ";";
    $teacher = $conn->query($sql);
    echo "<tr>
            <td>" . $row['id'] . "
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
