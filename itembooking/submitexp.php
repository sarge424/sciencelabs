<?php 
require_once '../db.php';
require_once '../checksession.php';

$id = $_GET['id'];
$q = $_GET['q'];
$name = $_GET['name'];

$sql = 'INSERT INTO experiment (exp_name, item_id, quantity) VALUES ("'.$name.'", '.$id.', '.$q.');';
$conn->query($sql);
echo $sql;
?>