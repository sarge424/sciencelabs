<?php require_once '../db.php'; ?>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
global $conn;

$specs = $_GET['specs'];
$item = $_GET['item'];
$quantity = $_GET['quantity'];
$user = $_SESSION['user'];

$sql = 'insert into purchase_request (teacher_id, item_name, quantity, specs, is_for, arrived) values (' . $user . ', "' . $item . '", ' . $quantity . ', "' . $specs . '", "p", 0)';

$conn->query($sql);

$conn->close();
?>