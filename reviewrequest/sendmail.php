<?php
require_once '../db.php';
require_once '../checkSession.php';
require_once '..\PHPMailer\third_party\phpmailer\PHPMailerAutoload.php';

$teacher = array();
$item = array();
$file = fopen("people.txt", "r");
while (!feof($file)) {
    $line = fgets($file, 1024);
    $line = trim($line);
    $line = explode(" ", $line);
    array_push($teacher, $line[0]);
    $line = isset($line[1]) ? $line[1] : null;
    array_push($item, $line);
}
fclose($file);

$sql = "select * from teacher;";
$id = $conn->query($sql);
array_multisort($teacher, $item);

$count = 0;
$copcount = 0;
$mail_body = "";
while ($row = $id->fetch_assoc()) {
    while ($count < count($teacher)) {
        if ($row['id'] == $teacher[$count]) {
            $mail_body = $mail_body . "The item you ordered: " . $item[$count] . ", has arrived at the respective lab.<br><br>";
            $count++;
            echo $mail_body;
            continue;
        } else {
            break;
        }
    }
    if ($copcount != $count) {
        echo $mail_body;

        $mail = new PHPMailer(true);

        $mail->IsSMTP(); // telling the class to use SMTP
        $mail->SMTPAuth = true; // enable SMTP authentication
        $mail->SMTPSecure = "ssl"; // sets the prefix to the server
        $mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
        $mail->Port = 465; // set the SMTP port for the GMAIL server
        $mail->Username = "abhinav@ishahomeschool.org"; // GMAIL username
        $mail->Password = "9738421573"; // GMAIL password

        //Senders information
        $email_from = "abhinav@ishahomeschool";
        $name_from = "Abhinav Srivatsa";

        //Typical mail data
        $mail->AddAddress($row['email'], $row['teacher_name']);
        $mail->SetFrom($email_from, $name_from);
        $mail->Subject = "Change Science Labs Password";
        $mail->Body = $mail_body;
        $mail->IsHTML(true);

        try {
            $mail->Send();
        } catch (Exception $e) {
        }
    }
    $copcount = $count;
}
