<?php
require_once '../db.php';
require_once '../checksession.php';

$item = $_GET['item'];
$specs = $_GET['specs'];
$quantity = $_GET['quantity'];

$sql = "update item set quantity=" . $quantity . ", recon=now() where item_name='" . $item . "' and specs='" . $specs . "';";
$conn->query($sql);
echo $sql;
