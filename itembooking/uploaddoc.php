<?php
require_once '../db.php';
require_once '../checkSession.php';
?>
<html>

<head>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <?php include '../navbar.php' ?>
    <script>
        setActive("Bookings");
    </script>
</head>

<body>
    <div class="container-fluid">
        <br>
        <br>
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div align="center">
                    <h3>Upload Report Document</h3>
                </div>
                <br>
                <div align="center">
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        Select Word Document to upload:
                        <input type="file" name="uploadfile" id="uploadfile">
                        <input name="exp_id" value="<?php echo $_GET['exp_id'] ?>" hidden>
                        <input name="booking_id" value="<?php echo $_GET['booking_id'] ?>" hidden>
                        <input class="btn btn-warning" type="submit" value="Upload Document" name="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>