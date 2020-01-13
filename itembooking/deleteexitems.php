<?php
require_once '../db.php';
require_once '../checksession.php';

$name = $_GET['expname'];

$sql = 'select id from experiment where exp_name="' . $name . '" and lab="' . $_SESSION['lab'] . '";';
$expid = $conn->query($sql)->fetch_assoc()['id'];
echo $expid;

$sql = 'delete from experiment_item where exp_id=' . $expid . ';';
$conn->query($sql);
