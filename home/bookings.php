<html>

<head>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <?php include '../navbar.php'; ?>
</head>

<script>
    let date = '<?php echo date("Y m d"); ?>';

    function addDays(increment) {
        let iframe1 = document.getElementById("iframe1");
        let iframe2 = document.getElementById("iframe2");
        let iframe3 = document.getElementById("iframe3");
        let iframe4 = document.getElementById("iframe4");

        if (increment > 0) {
            date = "<?php echo date("Y m d", time() + 86400) ?>";
        } else if (increment == 0) {
            date = "<?php echo date("Y m d") ?>";
        } else {
            date = "<?php echo date("Y m d", time() - 86400) ?>";
        }

        iframe1.src = "dispbookings.php?time=09:35 - 10:55&date=" + date;
        iframe2.src = "dispbookings.php?time=11:10 - 12:30&date=" + date;
        iframe3.src = "dispbookings.php?time=01:30 - 02:50&date=" + date;
        iframe4.src = "dispbookings.php?time=03:05 - 04:25&date=" + date;
    }
</script>

<body>
    <div class="container-fluid">
        <br>
        <div class="row">
            <div class="col-sm-4 text-center">
                <p class="btn btn-primary" onclick="addDays(-1)">Yesterday</p>
            </div>

            <div class="col-sm-4 text-center">
                <p class="btn btn-primary" onclick="addDays(0)">Today</p>
            </div>

            <div class="col-sm-4 text-center">
                <p class="btn btn-primary" onclick="addDays(1)">Tomorrow</p>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-3 embed-responsive" style="height:650px;">
                <iframe id="iframe1" class="embed-responsive-item" style="height:650px; border-right: 2px dashed black;" src="dispbookings.php?time=09:35 - 10:55&date=<?php echo date("Y m d"); ?>">Nope it didnt
                    work.</iframe>
            </div>
            <div class="col-lg-3 embed-responsive" style="height:650px;">
                <iframe id="iframe2" class="embed-responsive-item" style="height:650px; border-right: 2px dashed black;" src="dispbookings.php?time=11:10 - 12:30&date=<?php echo date("Y m d"); ?>">Nope it didnt
                    work.</iframe>
            </div>
            <div class="col-lg-3 embed-responsive" style="height:650px;">
                <iframe id="iframe3" class="embed-responsive-item" style="height:650px; border-right: 2px dashed black;" src="dispbookings.php?time=01:30 - 02:50&date=<?php echo date("Y m d"); ?>">Nope it didnt
                    work.</iframe>
            </div>
            <div class="col-lg-3 embed-responsive" style="height:650px;">
                <iframe id="iframe4" class="embed-responsive-item" style="height:650px;" src="dispbookings.php?time=03:05 - 04:25&date=<?php echo date("Y m d"); ?>">Nope it didnt
                    work.</iframe>
            </div>
        </div>
    </div>
</body>

</html>