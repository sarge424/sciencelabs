<?php
require_once '../db.php';
require_once '../checksession.php';

$sql = $_GET['sql'];
$sql_frag = explode(" ", $sql);

if ($sql_frag[0] == "select") {
	$columns_messy = explode(",", $sql);

	$columns = array();
	array_push($columns, trim(substr($columns_messy[0], 7)));
	$var = 1;
	while ($var < count($columns_messy) - 1) {
		array_push($columns, trim($columns_messy[$var]));
		$var++;
	}
	$count = count($columns_messy);
	$last = explode(" ", trim($columns_messy[$count - 1]));
	array_push($columns, $last[0]);
	print_r($columns);

	$var = 0;
	while ($var < count($sql_frag)) {
		if ($sql_frag[$var] == "from") {
			$table = $sql_frag[++$var];
			break;
		}
		$var++;
	}
	$table = substr($table, 0, -1);

	echo '<thead>';
	$var = 0;
	while ($var < count($columns)) {
		echo '<th>' . $columns[$var];
	}
	echo '</thead><tbody>';

	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_array()) {
			$var = 0;
			echo '<tr>';
			while ($var < count($row)) {
				echo '<td>' . $row[$var];
			}
			echo '</tr>';
		}
	}
	echo '</tbody>';
} else {
	$conn->query($sql);
	$conn->close();
}
