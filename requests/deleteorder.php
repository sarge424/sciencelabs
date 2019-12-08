<?php require_once '../db.php'; ?>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
global $conn;

$user = $_SESSION['user'];

$item = $_GET['item'];
$specs = $_GET['specs'];
$quantity = $_GET['quantity'];

$sql = "delete from purchase_request where lab='" . $_SESSION['lab'] . "' and id = (select min(id) from purchase_request" .
    " where item_name = '" . $item . "' and teacher_id = '" . $user . "' and specs = '" . $specs . "' and quantity = " . $quantity . ");";

$conn->query($sql);

$conn->close();

header('Location: ../requests/');
exit;
?>