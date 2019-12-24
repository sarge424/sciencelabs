<?php
require_once '../db.php';
require_once '../checksession.php';

$sql = "select * from item where lab='" . $_SESSION['lab'] . "';";
$result = $conn->query($sql);

$data = "";
$var = 0;
while ($row = $result->fetch_assoc()) {
    $date1 = $row['recon'];
    $time = strtotime($date1);
    $date1 = date('Y-m-d', $time);
    $date2 = date("Y-m-d");

    $date1 = DateTime::createFromFormat("Y-m-d", $date1);
    $date2 = DateTime::createFromFormat("Y-m-d", $date2);

    $diff = date_diff($date1, $date2);
    $diff = (int) $diff->format("%a");

    if ($diff > 90) {
        $data = $data .
            "<tr>" .
            "<td class='item' id='item" . $var . "'>" . $row['item_name'] .
            "<td class='specs' id='specs" . $var . "'>" . $row['specs'] .
            "<td>" . $row['quantity'] .
            "<td><input class='quantity form-control input-sm' type='number'/>";
    }
    $var++;
}
echo $data;
