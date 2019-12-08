<?php
require_once '../db.php';

$table = $_GET['table'];
$row = $_GET['row'];
$sql = 'select * from ' . $table . ';';
$result = $conn->query($sql);

$var = -1;
$id = 0;
if ($result->num_rows > 0) {
    while ($data = $result->fetch_assoc()) {
        if ($var == $row)
            break;
        $id = $data['id'];
        $var++;
    }
}

$sql = "select column_name, data_type from information_schema.columns where table_schema='labs' and table_name='" . $table . "';";
$columns = $conn->query($sql);

$print = "update " . $table . " set ";
$var = 0;
while ($data = $columns->fetch_assoc()) {
    $print = $print . $data['column_name'];
    if ($data['data_type'] == "int") {
        $print = $print . "=[input" . $var . "], ";
    } else {
        $print = $print . "='[input" . $var . "]', ";
    }
    $var++;
}
$print = substr($print, 0, strlen($print) - 2);
$print = $print . " where id=" . $id . ";";
echo $print;