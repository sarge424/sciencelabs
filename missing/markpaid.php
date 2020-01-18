<?php
require_once '../db.php';
require_once '../checksession.php';

$missing_id = $_GET['id'];

$sql = "update missing set accounted='Y' where id=" . $missing_id . ";";
$conn->query($sql);
$conn->close();
