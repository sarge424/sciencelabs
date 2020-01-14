<html>

<head>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <?php include '../navbar.php'; ?>
    <script>
        setActive("Missing");
    </script>
</head>

<script>
    function found(id) {
        let request;
        try {
            request = new XMLHttpRequest();
        } catch (e) {
            try {
                request = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                try {
                    request = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (e) {
                    alert("Oops! Something went wrong.");
                    return false;
                }
            }
        }

        request.onreadystatechange = function() {
            if (request.readyState == 4) {
                alert("Item marked as found.");
            }
        }

        let queryString = "?id=" + id;
        request.open("GET", "markfound.php" + queryString, true);
        request.send(null);
    }

    function createexcel() {
        let request;
        try {
            request = new XMLHttpRequest();
        } catch (e) {
            try {
                request = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                try {
                    request = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (e) {
                    alert("Oops! Something went wrong.");
                    return false;
                }
            }
        }

        request.onreadystatechange = function() {
            if (request.readyState == 4) {
                window.open("../excel/<?php echo $_SESSION['labname'] . " Lost " . date("Y m d"); ?>.xlsx");
            }
        }
        request.open("GET", "genexcel.php", true);
        request.send(null);
    }
</script>

<body>
    <div class="container-fluid">
        <br>
        <br>
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div align="center">
                    <h3>Missing Items</h3>
                </div>
                <div style="height: 300px !important; overflow-y: auto !important;">
                    <table class="table">
                        <thead class="thead thead-dark">
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Entry Date</th>
                            <th>Comments</th>
                            <th>Found?</th>
                        </thead>
                        <tbody>
                            <?php
                            require_once '../db.php';
                            require_once '../checksession.php';

                            $sql = "select * from missing where paid='N' and comments not in ('Lost during reconciliation');";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $sql = "select item_name from item where id=" . $row['item_id'] . ";";
                                    $item = $conn->query($sql)->fetch_assoc()['item_name'];
                                    $quantity = $row['quantity'];
                                    $date = $row['entry_date'];
                                    $comments = $row['comments'];
                            ?>
                                    <tr>
                                        <td><?php echo $item; ?></td>
                                        <td><?php echo $quantity; ?></td>
                                        <td><?php echo $date; ?></td>
                                        <td><?php echo $comments; ?></td>
                                        <td><button class="btn btn-sm btn-warning" onclick="found(<?php echo $row['id']; ?>)">Found</button></td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <br>
                <button class="btn btn-success float-right" onclick="createexcel()">Generate Excel</button>
            </div>
        </div>
    </div>
</body>

</html>