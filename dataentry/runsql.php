<?php
require_once '../db.php';
require_once '../checksession.php';

$sql = $_GET['sql'];
$sql_frag = explode(" ", $sql);

if ($sql_frag[0] == "select") {
	$var = 0;

	echo '<tbody>';

	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_row()) {
			$var = 0;
			echo '<tr>';
			while ($var < count($row)) {
				echo '<td>' . $row[$var];
				$var++;
			}
			echo '</tr>';
		}
	}
	echo '</tbody>';
	$conn->close();
} else {
	$conn->query($sql);
	$conn->close();
}
