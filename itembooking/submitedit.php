<?php
require_once '../db.php';
require_once '../checksession.php';

$id = $_GET['id'];
$q = $_GET['q'];
$name = $_GET['name'];
$expid = 0;

$sql = 'select id from experiment where exp_name="' . $name . '" and lab="' . $_SESSION['lab'] . '";';
$expid = $conn->query($sql)->fetch_assoc()['id'];

$conn->query('insert into experiment_item (exp_id, item_id, quantity) values (' . $expid . ',' . $id.',' . $q . ')');
$conn->close();
