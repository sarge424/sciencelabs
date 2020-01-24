<?php
require_once '../db.php';
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

<script>
    window.open("../reports/<?php echo $_GET['doc']; ?>");
</script>

<body>
    <div class="container-fluid">
        <br>
        <br>
        <div class="row">
            <div class="col-sm-12">
                <div align="center">
                    <h3>Edit Report Document</h3>
                </div>
                <br>
                <div align="center">
                    <form action="hodupload.php" method="post" enctype="multipart/form-data">
                        Select Word Document to upload:
                        <input type="file" name="uploadfile" id="uploadfile" accept=".doc, .docx">
                        <input class="btn btn-warning" type="submit" value="Upload Document" name="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>