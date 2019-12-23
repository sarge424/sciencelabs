<?php
require_once '../db.php';
require_once '../checksession.php';

$sql = "select * from item where lab='" . $_SESSION['lab'] . "';";
$result = $conn->query($sql);

$data = "";
while ($row = $result->fetch_assoc()) {
    $data = $data .
        "<tr>" .
        "<td>" . $row['item_name'] .
        "<td>" . $row['specs'] .
        "<td>" . $row['quantity'] .
        "<td><input class='form-control input-sm' type='number'/>";
}
echo $data;
