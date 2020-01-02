<?php
require_once '../db.php';
require_once '../checksession.php';

$specs = $_GET['specs'];
$item = $_GET['item'];
$quantity = $_GET['quantity'];
$link = $_GET['link'];
$cost = $_GET['cost'];
$user = $_SESSION['user'];

$sql = 'insert into purchase_request (teacher_id, item_name, quantity_ordered, specs, link, cost, arrived, lab) values (' . $user . ', "' . $item . '", ' . $quantity . ', "' . $specs . '", "' . $link . '", "' . $cost . '", 0, "' . $_SESSION['lab'] . '");';

$conn->query($sql);

$conn->close();
