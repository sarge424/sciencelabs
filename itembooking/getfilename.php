<?php
require_once '../db.php';
require_once '../checkSession.php';

function startsWith($haystack, $needle)
{
    $length = strlen($needle);
    return (substr($haystack, 0, $length) === $needle);
}

$sql = "select exp_name from experiment where id=" . $_GET['exp_id'] . ";";
$file = $conn->query($sql)->fetch_assoc()['exp_name'];
$conn->close();

$path = '../reports/';
$files = array_diff(scandir($path), array('.', '..'));
$files = array_reverse($files);

foreach ($files as $doc) {
    if (startsWith($doc, $file)) {
        echo "../reports/" . $doc;
        break;
    }
}
