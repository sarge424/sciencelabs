<?php
require_once '../db.php';
require_once '../checksession.php';

$id = $_GET['id'];
$q = $_GET['q'];
$name = $_GET['name'];
$exists = false;
$expid = 0;

$sql = 'select id, date_format(date_created, "%Y-%m-%d %H:%i:%s") as date from experiment where exp_name="' . $name . '";';
$result = $conn->query($sql);

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()) {
        $expid = $row['id'];
        $datetime2 = new DateTime();
        $datetime1 = new DateTime($row['date']);
        $interval = $datetime1->getTimestamp() - $datetime2->getTimestamp();
        echo $interval;
        if(abs($interval) <= 20000)
            $exists = true;
    }
}else{
    $sql = 'insert into experiment(exp_name) values ("'.$name.'");';
    $conn->query($sql);
    $sql = 'select id from experiment where exp_name = "'.$name.'";';
    $expid = $conn->query($sql)->fetch_assoc()['id'];
}

$sql = 'INSERT INTO experiment_item (exp_id, item_id, quantity) VALUES ("' . $expid . '", ' . $id . ', ' . $q . ');';
if (!$exists) {
    $conn->query($sql);
    echo 'done';
} else {
    echo 'exists';
}
