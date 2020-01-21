<?php
require_once '../db.php';
require_once '../checkSession.php';

$missing_id = $_GET['missing_id'];

$sql = "update missing set accounted='Y' where id=" . $missing_id . ";";
$conn->query($sql);
$conn->close();
