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
function startsWith($haystack, $needle)
{
	$length = strlen($needle);
	return (substr($haystack, 0, $length) === $needle);
}
