<?php require_once '../db.php'; ?>
<?php
global $conn;

$rollno = $_GET['rollno'];
$sql = 'SELECT student_name,id FROM student WHERE 1;';

require '../db.php';
$result = $conn->query($sql);

if (!empty($result) && !empty($rollno)) {
	$row = $result->fetch_assoc();
	$html = '';
	while ($row = $result->fetch_assoc()) {
		if (startsWith((string) $row['id'], (string) $rollno)) {
			$html = $html . '<b>' . $row['id'] . '</b>  ' . $row['student_name'] . '<br>';
		}
	}
	if (strcmp($html, '') == 0)
		echo 'No students with this roll number!';
	else
		echo $html;
} else {
	echo 'Start typing to see names.';
}

echo '###';

$itemname = $_GET['itemnm'];
$sql = 'SELECT id,quantity,item_name,specs FROM item';

$result = $conn->query($sql);

if (!empty($result) && !empty($itemname)) {
	$html = '';
	$rows = 0;
	$lastid = 0;
	while ($row = $result->fetch_assoc()) {
		if (startsWith(strtolower($row['item_name']), strtolower($itemname))) {
			$html = $html . '<b>' . $row['item_name'] . '  (' . $row['quantity'] . ')</b>   ' . $row['specs'] . '<br>';
			$rows += 1;
			$lastid = $row['id'];
		}else{
			
		}
	}
	if (strcmp($html, '') == 0) {
		echo 'No such items!';
	} else {
		echo $html;
	}

	if ($rows == 1) {
		echo '###' . $lastid;
	}
} else {
	echo 'Start typing to see items.';
}

function startsWith($haystack, $needle)
{
	$length = strlen($needle);
	return (substr($haystack, 0, $length) === $needle);
}
