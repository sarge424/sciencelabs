<?php
require_once "../db.php";

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

$sql = "select * from purchase_request where arrived=1 and lab='".$_SESSION["lab"]."';";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){
    echo "<tr>
            <td>" . $row['id'] . "
            <td>" . $row['teacher_id'] . "
            <td>" . $row['item_name'] . "
            <td>" . $row['quantity'] . "
            <td>" . $row['specs'] . "
            <td>" . $row['date_ordered'] . "
            <td>" . $row['date_arrived'] . "
            <td>" . $row['comments'] . "
            <td>" . $row['bill_code'];
}
?>