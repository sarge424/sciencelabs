<html>

<head>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <?php include '../navbar.php'; ?>
    <script>
        setActive("Missing Items");
    </script>
</head>

<script>
    function markpaid(id) {
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
                alert("Paid!");
                document.location.reload();
            }
        }
        request.open("GET", "markpaid.php?id=" + id, true);
        request.send(null);
    }
</script>

<body>
    <div class="container-fluid">
        <br>
        <div align="center">
            <button class="btn btn-primary" onclick="document.location.href = '../missing/'">Main Page</button>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div align="center">
                    <h3>Paid Items</h3>
                </div>
                <table class="table">
                    <thead class="thead thead-dark">
                        <th>Item
                        <th>Quantity
                        <th>Comments
                        <th>Paid?
                    </thead>
                    <tbody>
                        <?php
                        require_once '../db.php';
                        require_once '../checkSession.php';

                        $sql = "select id, item_id, quantity, comments from missing where accounted='N';";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $item_name = $conn->query("select item_name from item where id=" . $row['id'] . ";")->fetch_assoc()['item_name'];
                        ?>
                                <tr id="tr<?php echo $row['id']; ?>">
                                    <td><?php echo $item_name; ?></td>
                                    <td><?php echo $row['quantity']; ?></td>
                                    <td><?php echo $row['comments']; ?></td>
                                    <td><button class="btn btn-warning" onclick="markpaid(<?php echo $row['id']; ?>)">Paid</button>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>