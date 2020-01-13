<?php
require_once '../db.php';
require_once '../checksession.php';

$sql = 'select id from experiment where exp_name="' . $name . '" and lab="' . $_SESSION['lab'] . '";';
$expid = $conn->query($sql)->fetch_assoc()['id'];

$sql = 'delete from experiment_item where exp_id=' . $expid . ';';
$conn->query($sql);
