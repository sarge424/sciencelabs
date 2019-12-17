<?php
if(!empty($_POST['data'])){
$data = $_POST['data'];
$fname = mktime() . ".txt";//generates random name

$file = fopen("upload/" .$fname, 'w');//creates new file
fwrite($file, $data);
fclose($file);
}

$myfile = fopen("logs.txt", "wr") or die("Unable to open file!");
$txt = "user id date";
fwrite($myfile, $txt);
fclose($myfile);

 $txt = "user id date";
 $myfile = file_put_contents('logs.txt', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);