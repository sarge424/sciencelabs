<?php require_once '../db.php'; ?>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    global $conn;

    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];

    $sql = 'select * from teacher where teacher_name="' . $name . '";';

    $message = 'Please go to the link provided below: /n/n
                localhost/sciencelabs/pass/change.php';

    if ($email == $conn->query($sql)->fetch_assoc()['email']) {
        mail($email, "Change Your Physics Lab Password", $message);
    } else {
        echo '<script>alert("Username and Email Do Not Match);<script>';
    }
}

?>

<html>

<head>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.min.js"></script>
</head>

<body>
    <script>
        function back() {
            document.location.href = "../";
        }
    </script>

    <div class="container-fluid">
        <br>
        <br>
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <form action="<?php $_SERVER = ["PHP_SELF"] ?>" method="POST">
                    <table class="table">
                        <tr>
                            <div align="center">
                                <h2>Forgot Password</h2>
                            </div>
                        <tr>
                            <td>
                                <label class="form-control input-sm text-primary" align="center"><b>Username</b></label>
                            <td>
                                <input class="form-control input-sm" type="text" placeholder="Enter Username" name="name" autofocus required></input>
                        <tr>
                            <td>
                                <label class="form-control input-sm text-primary" align="center"><b>Email</b></label>
                            <td>
                                <input class="form-control input-sm" type="text" placeholder="Enter Email" name="email" autofocus required></input>
                        <tr>
                            <td colspan="2">
                                <button class="btn btn-warning btn-block" type="submit">Send Email</button>
                        <tr>
                            <td colspan="2">
                                <button class="btn btn-light btn-block" onclick="back()">Cancel</button>
                    </table>
                </form>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
</body>

</html>