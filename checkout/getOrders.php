<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../db.php';

$sql = 'select * from student_checkout where lab="' . $_SESSION['lab'] . '" and returned=0;';
$result = $conn->query($sql);
echo $sql;

/*
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $sql = 'select * from student where id=' . $row['student_id'] . ';';
        $student = $conn->query($sql);

        //$student = $student->fetch_assoc()['student_name'];

    }
}