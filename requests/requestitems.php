<?php 
require_once '../db.php';
require_once '../checkSession.php';

$specs = $_GET['specs'];
$item = $_GET['item'];
$quantity = $_GET['quantity'];
$user = $_SESSION['user'];

$sql = 'insert into purchase_request (teacher_id, item_name, quantity_ordered, specs, arrived, lab) values (' . $user . ', "' . $item . '", ' . $quantity . ', "' . $specs . '", 0, "' . $_SESSION['lab'] . '");';

$conn->query($sql);

$conn->close();
?>