<?php 
require_once '../db.php';
require_once '../checkSession.php';

if ($_SESSION['level'] < 2 && isset($_SESSION['level'])) {
	$item_id = $_GET['item_id'];
	$sql = 'DELETE FROM `item` WHERE `id` = ' . $item_id . ';';
	$conn->query($sql);
} else {
	echo '<script>alert("You do not have access to perform this action.");</script>';
}
echo '<script>document.location.href = "../stock/";</script>';
$conn->close();
?>