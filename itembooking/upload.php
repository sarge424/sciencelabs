<?php
require_once '../db.php';
require_once '../checkSession.php';
require_once '../maildetails.php';

$file = basename($_FILES["uploadfile"]["name"]);
$path = "../reports/";

$flag = false;
$sql = "select exp_name from experiment where id=" . $_POST['exp_id'] . ";";
$rename = $conn->query($sql)->fetch_assoc()['exp_name'];

if (substr($file, -5) == ".docx") {
    $rename = $rename . ".docx";
    $flag = true;
}

if (substr($file, -4) == ".doc") {
    $rename = $rename . ".doc";
    $flag = true;
}
if ($flag) {
    if (move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $path . $rename)) {
        echo '<script>alert("File uploaded.");</script>';
    } else {
        echo '<script>alert("File not able to upload.");</script>';
    }
} else {
    echo '<script>alert("Please put Word Document.");</script>';
}

$sql = "select teacher_name, email from teacher where levels=1";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $email = $row['email'];
    $name = $row['teacher_name'];

    $mail->AddAddress($email, $name);
    $mail->SetFrom($email_from, $name_from);
    $mail->Subject = "Approve Experiment Document for " . $rename;
    $mail->Body = "To download the document click <html> <a href='10.0.3.117/sciencelabs/reports/" . $rename . "'>here</a>.<br><br>" .
        "To approve the document click <a href='10.0.3.117/sciencelabs/reports/submit.php?doc=" . $rename . "'>here</a>.<br><br>" .
        "To edit the document click <a href='10.0.3.117/sciencelabs/itembooking/editdoc.php?doc=" . $rename . "'>here</a>";
    $mail->IsHTML(true);

    try {
        $mail->Send();
        echo "<script>alert('Mail sent successfully!');document.location.href='../'</script>";
    } catch (Exception $e) {
        echo '<script>alert("' . $e . '");';
        echo "<script>alert('Something went wrong. Try again later.');document.location.href='../'</script>";
    }
}

header("Location: ../itembooking/index.php?bookingid=" . $_POST['booking_id']);
exit;
