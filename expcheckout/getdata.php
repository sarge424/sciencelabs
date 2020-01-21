<?php
require_once '../db.php';
require_once '../checksession.php';

if ($_SESSION['level'] == 1) {
    $sql = 'select distinct i.id as real_id, i.labbooking_id, i.exp_id, i.quantity, i.returned, l.id, l.booked_date, l.teacher_id, l.class_id, t.id as t_id, t.teacher_name, c.id, c.class_name, e.id as e_id, e.exp_name'.
            ' from item_booking i, lab_booking l, teacher t, student s, class c, experiment e'.
            ' where i.returned="N" AND i.labbooking_id=l.id AND l.teacher_id=t.id AND l.class_id=c.id AND e.id=i.exp_id;';
} else {
    $sql = 'select distinct i.id as real_id, i.labbooking_id, i.exp_id, i.quantity, i.returned, l.id, l.booked_date, l.teacher_id, l.class_id, l.lab, t.id as t_id, t.teacher_name, c.id, c.class_name, e.id as e_id, e.exp_name'.
            ' from item_booking i, lab_booking l, teacher t, student s, class c, experiment e'.
            ' where i.returned="N" AND i.labbooking_id=l.id AND l.teacher_id=t.id AND l.class_id=c.id AND e.id=i.exp_id AND l.lab="'.$_SESSION['lab'].'";';
}
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<tr id="row' . $row['real_id'] . '">' .
            '<td id="' . $row['t_id'] . '">' . $row['teacher_name'] .
            '<td id="' . $row['e_id'] . '">' . $row['exp_name'] .
            '<td>' . $row['class_name'] .
            '<td>' . $row['quantity'] .
            '<td>' . $row['booked_date'] .
            '<td><button class="btn btn-warning btn-sm" onclick="arrived(' . $row['real_id'] . ')">Returned</button>' .
            '<td><button class="btn btn-danger btn-sm" onclick="lost(' . $row['real_id'] . ')">Lost</button>';
    }
}
