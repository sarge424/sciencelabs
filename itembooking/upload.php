<?php
require_once '../db.php';
require_once '../checkSession.php';

$file = basename($_FILES["uploadfile"]["name"]);
$path = "../reports/";

$flag = false;
$sql = "select exp_name from experiment where id=" . $_POST['exp_id'] . ";";
$rename = $conn->query($sql)->fetch_assoc()['exp_name'];

if (substr($file, -5) == ".docx") {
    $rename = $rename . ".docx";
    $flag = true;
}

if (substr($file, -4) == ".doc") {
    $rename = $rename . ".doc";
    $flag = true;
}
if ($flag) {
    if (move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $path . $rename)) {
        echo '<script>alert("File uploaded.");</script>';
    } else {
        echo '<script>alert("File not able to upload.");</script>';
    }
} else {
    echo '<script>alert("Please put Word Document.");</script>';
}

header("Location: ../itembooking/index.php?bookingid=" . $_POST['booking_id']);
exit;
