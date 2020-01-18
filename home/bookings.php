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
    let months = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

    function addDays(increment) {
        let iframe1 = document.getElementById("iframe1");
        let iframe2 = document.getElementById("iframe2");
        let iframe3 = document.getElementById("iframe3");
        let iframe4 = document.getElementById("iframe4");

        let curr_date = substr(date, 8, 2);
        let curr_month = substr(date, 5, 2);
        let curr_year = substr(date, 0, 4);

        if (year % 4 == 0) {
            months[1] = 29;
        }
        curr_date += increment;
        if (curr_date > months[curr_month - 1]) {
            curr_date = 0;
            curr_month++;
            if (curr_month > 12) {
                curr_year++;
                curr_month = 1;
                if (curr_year % 4 == 0) {
                    curr_months[1] = 29;
                }
            }
        }

        if (curr_date < 1) {
            curr_month--;
            if (curr_month == 0) {
                curr_year--;
                curr_month = 12;
                if (curr_year % 4 == 0) {
                    months[1] = 29;
                }
            }
            curr_date = months[curr_month - 1];
        }

        date = curr_year + " " + curr_month + " " + curr_date;
        //add src to iframes
    }
</script>

<body>
    <div class="container-fluid">
        <br>
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <button class="btn btn-primary" onclick="addDays(-1)">Prev Day</button>
                <button class="btn btn-primary float-right" onclick="addDays(1)">Next Day</button>
            </div>
            <div class="col-sm-2"></div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-3 embed-responsive" style="height:650px;">
                <iframe id="iframe1" class="embed-responsive-item" style="height:650px; border-right: 2px dashed black;"
                    src="dispbookings.php?time=09:35 - 10:55&date=<?php echo date("Y m d"); ?>">Nope it didnt
                    work.</iframe>
            </div>
            <div class="col-lg-3 embed-responsive" style="height:650px;">
                <iframe id="iframe2" class="embed-responsive-item" style="height:650px; border-right: 2px dashed black;"
                    src="dispbookings.php?time=11:10 - 12:30&date=<?php echo date("Y m d"); ?>">Nope it didnt
                    work.</iframe>
            </div>
            <div class="col-lg-3 embed-responsive" style="height:650px;">
                <iframe id="iframe3" class="embed-responsive-item" style="height:650px; border-right: 2px dashed black;"
                    src="dispbookings.php?time=01:30 - 02:50&date=<?php echo date("Y m d"); ?>">Nope it didnt
                    work.</iframe>
            </div>
            <div class="col-lg-3 embed-responsive" style="height:650px;">
                <iframe id="iframe4" class="embed-responsive-item" style="height:650px;"
                    src="dispbookings.php?time=03:05 - 04:25&date=<?php echo date("Y m d"); ?>">Nope it didnt
                    work.</iframe>
            </div>
        </div>
    </div>
</body>

</html>