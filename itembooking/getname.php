<?php 
require_once '../db.php';
require_once '../checksession.php';

$expname = $_GET['expname'];
$sql = 'SELECT exp_name,id FROM experiment WHERE 1;';

require '../db.php';
$result = $conn->query($sql);

if (!empty($result) && !empty($expname)) {
	$html = '';
	while ($row = $result->fetch_assoc()) {
		if (startsWith(strtolower((string) $row['exp_name']), strtolower((string) $expname))) {
			$html = $html . '<div class="btn btn-block btn-light text-left" onclick="setexp('.$row['id'].',\''.$row['exp_name'].'\')"><b>EXP' . $row['id'] . '</b>  ' . $row['exp_name'] . '</div>';
		}
	}
	if (strcmp($html, '') == 0)
		echo 'No such experiment!';
	else
		echo $html;
} else {
	echo 'Start typing to see experiments.';
}

echo '###';

$itemname = $_GET['itemnm'];

$sql = 'SELECT id,quantity,item_name,specs FROM item where lab="'.$_SESSION['lab'].'";';

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

function startsWith($haystack, $needle)
{
	$length = strlen($needle);
	return (substr($haystack, 0, $length) === $needle);
}
