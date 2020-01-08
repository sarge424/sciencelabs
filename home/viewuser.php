<html>

<head>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <?php include '../navbar.php'; ?>
</head>

<body>
    <?php
    require_once '../db.php';
    require_once '../checksession.php';
    date_default_timezone_set("Asia/Calcutta");

    $var = 0;
    $times = array("09:35 - 10:55", "11:10 - 12:30", "01:30 - 02:50", "03:05 - 04:25");
    $times_split = array("00:00 am", "10:00 am", "10:00 am", "12:30 pm", "12:30 pm", "02:00 pm", "02:00 pm", "04:25 pm");
    while ($var < 8) {
        $times_split[$var] = DateTime::createFromFormat('h:i a', $times_split[$var]);
        $var++;
    }

    $curr = DateTime::createFromFormat('h:i a', date('h:i a'));

    $dbtime = "";
    $var = 0;
    while ($var < 8) {
        if ($times_split[$var] < $curr && $curr < $times_split[$var + 1]) {
            $dbtime = $times[$var / 2];
        }
        $var = $var + 2;
    }

    $sql = "select * from lab_booking where lab='" . $_SESSION['lab'] . "'  and date_format(booked_date, '%Y %m %d')='" . date('Y m d') . "' and booked_time='" . $dbtime . "';";
    $result = $conn->query($sql);

    $teacher = -1;
    $exp = -1;
    $quantity = -1;
    if ($result->num_rows != 0) {
        while ($row = $result->fetch_assoc()) {
            $teacher = $row['teacher_id'];
            $exp = $row['id'];
        }
    }

    $sql = "select exp_id, quantity from item_booking where labbooking_id=" . $exp . ";";
    $result = $conn->query($sql);
    if ($result->num_rows != 0) {
        while ($row = $result->fetch_assoc()) {
            $exp = $row['exp_id'];
            $quantity = $row['quantity'];
        }
    }

    $sql = "select teacher_name from teacher where id=" . $teacher . ";";
    $result = $conn->query($sql);
    if ($result->num_rows != 0) {
        while ($row = $result->fetch_assoc()) {
            $teacher = $row['teacher_name'];
        }
    }

    $sql = "select exp_name from experiment where id=" . $exp . ";";
    $result = $conn->query($sql);
    if ($result->num_rows != 0) {
        while ($row = $result->fetch_assoc()) {
            $exp = $row['exp_name'];
        }
    }

    global $exp;
    global $teacher;
    global $quantity;
    global $conn;
    ?>
    <div class="container">
        <br>
        <br>
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <h2>Lab booked by: <?php echo $teacher; ?></h2>
                <br>
                <div align="center">
                    <table class="table">
                        <thead>
                            <th>Item
                            <th>Quantity
                        </thead>
                        <tbody>
                            <?php
                            $sql = "select item_id, quantity from experiment where exp_name='" . $exp . "';";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                $sql = "select item_name from item where id=" . $row['item_id'] . ";";
                                $res = $conn->query($sql);
                                while ($item = $res->fetch_assoc()) {
                                    echo '<tr>
                                            <td>' . $item['item_name'];
                                }
                                echo '<td>' . (int) ($row['quantity'] * $quantity);
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>