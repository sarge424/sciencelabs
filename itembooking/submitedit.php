<?php
require_once '../db.php';
require_once '../checksession.php';

$id = $_GET['id'];
$q = $_GET['q'];
$name = $_GET['name'];
$expid = 0;

$sql = 'select id, date_format(date_created, "%Y-%m-%d %H:%i:%s") as date from experiment where exp_name="' . $name . '";';
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
    $expid = $row['id'];
    $datetime2 = new DateTime();
    $datetime1 = new DateTime($row['date']);
    $interval = $datetime1->getTimestamp() - $datetime2->getTimestamp();
    echo $interval;
    if(abs($interval) <= 15000){
        $sql = 'delete from experiment_item where exp_id='.$expid.';';
        $conn->query($sql);
        echo 'deleted!';
    }
}
$conn->query('insert into experiment_item (exp_id, item_id, quantity) values ('.$expid.','.$id.','.$q.')');
$conn->query('update experiment set created_date=now() where id='.$expid.';');
echo ' whooohoo! ';