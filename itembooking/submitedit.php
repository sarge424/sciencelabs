<?php
require_once '../db.php';
require_once '../checksession.php';

$itemid = $_GET['id'];
$quantity = $_GET['q'];
$expname = $_GET['name'];
$expid = 0;

$sql = 'select id from experiment where exp_name="' . $expname . '" and lab="' . $_SESSION['lab'] . '";';
$expid = $conn->query($sql)->fetch_assoc()['id'];

$conn->query('insert into experiment_item (exp_id, item_id, quantity) values (' . $expid . ',' . $itemid.',' . $quantity . ')');
$conn->close();
