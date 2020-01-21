<?php 
require_once '../db.php';
require_once '../checksession.php';

$sql = 'select * from item where id=' . $_POST['itemid'];
$uniqueitem = $conn->query($sql)->num_rows;
if ($uniqueitem != 1) {
	echo '<script>alert("Select one single item.<' . $itemid . '>");document.location.href="index.php";</script>';
}
$sql = 'select * from student where id=' . $_POST['rollno'];
$uniqueitem = $conn->query($sql)->num_rows;
if ($uniqueitem != 1) {
	echo '<script>alert("Select one single person.");document.location.href="index.php";</script>';
}

$sql = 'select * from item where id=' . $_POST['itemid'];
$uniqueitem = $conn->query($sql)->fetch_assoc()['quantity'];
if ($uniqueitem < $_POST['quantity']) {
	echo '<script>alert("Not enough stock.");document.location.href="index.php";</script>';
} else {
	$sql = 'insert into student_checkout (student_id, item_id, quantity, returned, lost, returned_date, lab) values (' .
		$_POST['rollno'] . ', ' .
		$_POST['itemid'] . ', ' .
		$_POST['quantity'] . ', ' .
		'"N", "Y", now(),"' .
		$_SESSION['lab'] . '");';

	$conn->query($sql);

	$sql = 'select * from student where id=' . $_POST['rollno'] . ';';
	$student = $conn->query($sql)->fetch_assoc()['student_name'];
	$item = $_POST['itemname'];

	$sql = "insert into missing (item_id, quantity, comments) values (" . $_POST['itemid'] . ", " . $_POST['quantity'] . ", 'Lost by " . $student . "');";
	echo $sql;
	$conn->query($sql);

	$sql = "update item set lost_quantity=" . $_POST['quantity'] . " where id=" . $_POST['itemid'] . ";";
	$conn->query($sql);

	echo '<script>
		alert("Recorded ' . $_POST['quantity'] . ' ' . $item . ' lost by ' . $student . '");
		
	</script>';
}
?>