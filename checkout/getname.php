<?php 
require_once '../db.php';
require_once '../checksession.php';

$rollno = $_GET['rollno'];
$sql = 'select student_name,id from student where 1;';

require '../db.php';
$result = $conn->query($sql);

if (!empty($result) && !empty($rollno)) {
	$html = '';
	while ($row = $result->fetch_assoc()) {
		if (startsWith((string) $row['id'], (string) $rollno)) {
			$html = $html . '<div class="btn btn-block btn-light text-left" onclick="setroll('.$row['id'].')"><b>' . $row['id'] . '</b>  ' . $row['student_name'] . '</div>';
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
$sql = 'select id,quantity,item_name,specs from item where lab="'.$_SESSION['lab'].'";';

$result = $conn->query($sql);

if (!empty($result) && !empty($itemname)) {
	$html = '';
	$rows = 0;
	$lastid = 0;
	while ($row = $result->fetch_assoc()) {
		if (startsWith(strtolower($row['item_name']), strtolower($itemname))) {
			$html = $html . '<div class="btn btn-block btn-light text-left" onclick="setitemvalues('.$row['id'].',\''.$row['item_name'].'\');"><b>' . $row['item_name'] . '  (' . $row['quantity'] . ')</b>   ' . $row['specs'] . '</div>';
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

function startsWith($haystack, $needle) {
	$length = strlen($needle);
	return (substr($haystack, 0, $length) === $needle);
}
