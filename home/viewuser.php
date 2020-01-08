<html>

<head>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</head>

<body>
    <?php
    require_once '../db.php';
    require_once '../checksession.php';

    $dbtime = $_GET['time'];

    $sql = "select * from lab_booking where lab='" . $_SESSION['lab'] . "'  and date_format(booked_date, '%Y %m %d')='" . date('Y m d') . "' and booked_time='" . $dbtime . "';";
    $result = $conn->query($sql);

    $teacher = "Not Booked";
    $exp = "None";
    $quantity = 0;
    if ($result->num_rows != 0) {
        while ($row = $result->fetch_assoc()) {
            $teacher = $row['teacher_id'];
            $exp = $row['id'];
        }
    }

    if ($exp != "None") {
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
            <div class="col-sm-12">
                <h2><?php echo $dbtime; ?></h2>
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