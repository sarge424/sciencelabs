<?php
require_once '../db.php';
require_once '../checksession.php';

$id = $_GET['id'];
$q = $_GET['q'];
$name = $_GET['name'];
$exists = false;

$sql = 'select distinct date_format(date_created, "%Y %m %d %H %i") from experiment where exp_name="' . $name . '";';
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $exists = true;
}

$sql = 'INSERT INTO experiment (exp_name, item_id, quantity) VALUES ("' . $name . '", ' . $id . ', ' . $q . ');';
if (!$exists) {
    $conn->query($sql);
    echo 'done';
} else {
    echo 'exists';
}
