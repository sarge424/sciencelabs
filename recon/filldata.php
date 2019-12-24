<?php
require_once '../db.php';
require_once '../checksession.php';

$sql = "select * from item where lab='" . $_SESSION['lab'] . "';";
$result = $conn->query($sql);

$data = "";
$var = 0;
while ($row = $result->fetch_assoc()) {
    $date1 = $row['recon'];
    $date2 = date('y') . " " . date('m') . " " . date('d');
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
