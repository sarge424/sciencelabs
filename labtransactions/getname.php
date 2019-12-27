<?php
require_once '../db.php';
require_once '../checksession.php';

$itemname = $_GET['itemnm'];
$sql = 'SELECT id,quantity,item_name,specs FROM item where lab="' . $_SESSION['lab'] . '";';

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
		} else {
		}
	}
	if (strcmp($html, '') == 0) {
		echo 'No such items!';
	} else {
		echo $html;
	}
} else {
	echo 'Start typing to see items.';
}

function startsWith($haystack, $needle)
{
	$length = strlen($needle);
	return (substr($haystack, 0, $length) === $needle);
}
