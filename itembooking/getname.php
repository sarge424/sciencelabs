<?php
require_once '../db.php';
require_once '../checksession.php';

$expname = $_GET['expname'];
$sql = 'select distinct exp_name from experiment where lab="' . $_SESSION['lab'] . '";';

require '../db.php';
$result = $conn->query($sql);

if (!empty($result) && !empty($expname)) {
	$html = '';
	while ($row = $result->fetch_assoc()) {
		if (startsWith(strtolower((string) $row['exp_name']), strtolower((string) $expname))) {
			$getIDsql = 'select id from experiment where exp_name = "' . $row['exp_name'] . '";';
			$id = $conn->query($getIDsql)->fetch_assoc()['id'];
			$html = $html . '<div class="btn btn-block btn-light text-left" onclick="setexp(' . $id . ',\'' . $row['exp_name'] . '\')">' .
				'<kbd>EXP</kbd>' .
				'<b>  ' . $row['exp_name'] . '</b>' .
				stringres('select a.exp_name, a.id, b.exp_id, i.id, i.item_name as item_name from experiment a, experiment_item b, item i where a.exp_name = "' . $row['exp_name'] . '" AND a.id=b.exp_id AND b.item_id = i.id;', 'item_name') . '</div>';
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
$sql = 'select id, quantity, item_name, specs from item where lab="' . $_SESSION['lab'] . '";';

$result = $conn->query($sql);

if (!empty($result) && !empty($itemname)) {
	$html = '';
	$rows = 0;
	$lastid = 0;
	while ($row = $result->fetch_assoc()) {
		if (startsWith(strtolower($row['item_name']), strtolower($itemname))) {
			$html = $html . '<div class="btn btn-block btn-light text-left" onclick="setitemvalues(' . $row['id'] . ',\'' . $row['item_name'] . '\');"><b>' . $row['item_name'] . '  (' . $row['quantity'] . ')</b>   ' . $row['specs'] . '</div>';
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

function stringres($sql, $attr)
{
	include '../db.php';
	$res = $conn->query($sql);
	$ret = '  (';
	while ($row = $res->fetch_assoc()) {
		$ret .= $row[$attr] . ', ';
	}
	$ret = rtrim($ret, ', ') . ')';
	return $ret;
}
