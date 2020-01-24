<?php
require_once '../db.php';
require_once '../checkSession.php';

$file = basename($_FILES["uploadfile"]["name"]);
$path = "../reports/";

$ext = explode(".", basename($_FILES["uploadfile"]["name"]));
$ext = "." . $ext[1];

$file = explode("(", $file);
$file = trim($file[0]) . $ext;

if (move_uploaded_file($_FILES["uploadfile"]["tmp_name"], "../approved-reports/" . $file)) {
    echo '<script>alert("File uploaded.");</script>';
    unlink("../reports/" . $file);
} else {
    echo '<script>alert("File not able to upload.");</script>';
}

header("Location: ../");
exit;
