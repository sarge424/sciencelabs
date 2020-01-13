<?php
require_once '../db.php';
require_once '../checksession.php';

$name = $_GET['name'];

$sql = 'select distinct id from experiment where exp_name="' . $name . '" and lab="' . $_SESSION['lab'] . '";';
$result = $conn->query($sql);

if($result->num_rows < 1){
	$sql = 'insert into experiment(exp_name, lab) values ("' . $name . '", "' . $_SESSION['lab'] . '");';
	$conn->query($sql);
	echo 'done';
} else {
	echo 'exists';
}
$conn->close();
