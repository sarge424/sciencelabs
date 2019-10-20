<?php require_once '../db.php'; ?>
<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
global $conn;

if ($_SESSION['level'] < 2 && isset($_SESSION['level'])) {
	$item_id = $_GET['item_id'];
	$sql = 'DELETE FROM `item` WHERE `id` = ' . $item_id . ';';
	$conn->query($sql);
} else {
	echo '<script>alert("You do not have access to perform this action.");</script>';
}
echo '<script>document.location.href = "index.php";</script>';
$conn->close();
?>