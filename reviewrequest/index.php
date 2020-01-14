<?php include '../navbar.php'; ?>
<script>
    setActive('Pending Orders');
</script>

<html>

<head>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="checkbox.css">
</head>

<script>
    function checkAll() {
        let input = document.getElementsByClassName("chk");
        let btn = document.getElementById("btn");
        if (btn.innerHTML == "Check All")
            btn.innerHTML = "Uncheck All";
        else
            btn.innerHTML = "Check All";

        let flag = false;
        let x = 0;

        while (x < input.length)
            if (!input[x++].checked) {
                flag = false;
                break;
            } else
                flag = true;
        x = 0;
        if (flag)
            while (x < input.length)
                input[x++].checked = false;
        else
            while (x < input.length)
                input[x++].checked = true;
    }

    function submit() {
        let teacher = document.getElementsByClassName("teacher");
        let item = document.getElementsByClassName("item");
        let quantity_ordered = document.getElementsByClassName("quano");
        let quantity_received = document.getElementsByClassName("quanr");
        let specs = document.getElementsByClassName("specs");
        let check = document.getElementsByClassName("chk");
        let comments = document.getElementsByClassName("comments");
        let bill = document.getElementById("bill");
        let x = 0;

        while (x < item.length) {
            if (check[x].checked && bill.value != "") {
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
                            return false;
                        }
                    }
                }

                request.onreadystatechange = function() {
                    if (request.readyState == 4) {
                        document.location.href = "../reviewrequest/";
                    }
                }

                let queryString = "?teacher=" + teacher[x].id + "&item=" + item[x].innerHTML + "&quantityo=" + quantity_ordered[x].innerHTML + "&quantityr=" + quantity_received[x].value + "&specs=" + specs[x].innerHTML + "&comments=" + comments[x].value + "&bill=" + bill.value;
                request.open("GET", "review.php" + queryString, true);
                request.send(null);
            }
            x++;
        }
    }
</script>

<body>
    <div class="container-fluid">
        <br>
        <div align="center">
            <button class="btn btn-primary" onclick="document.location.href='../transactions/';">View Older Orders</button>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <div align="center">
                    <div class="btn-group btn-group-lg">
                        <h3>Review Arrived Order</h3>
                    </div>
                </div>
                <table class="table">
                    <thead class="thead thead-dark">
                        <th>Teacher
                        <th>Name
                        <th>Quantity Ordered
                        <th>Quantity Received
                        <th>Specifications
                        <th>Arrived?
                        <th>Comments
                    </thead>
                    <tbody id="tbody">
                        <?php
                        require_once '../db.php';
                        require_once '../checksession.php';

                        $sql = "select * from purchase_request where lab='" . $_SESSION['lab'] . "' and arrived=0;";
                        $result = $conn->query($sql);

                        $var = 0;
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $sql = "select * from teacher where id=" . $row['teacher_id'] . ";";
                                $teacher = $conn->query($sql);
                                $teacher = $teacher->fetch_assoc();
                                echo '<tr><td class="teacher" id="' . $teacher['id'] . '">' . $teacher['teacher_name'] .
                                    '<td class="item">' . $row['item_name'] .
                                    '<td class="quano">' . $row['quantity_ordered'] .
                                    '<td><input class="quanr form-control input-sm" type="number" min=0 required />' .
                                    '<td class="specs">' . $row['specs'] .
                                    '<td><label class="container">
                                                <input id="chk' . $var . '" name="chk' . $var . '" type="checkbox" class="chk">
                                                <span class="checkmark"></span>
                                            </label>
                                    <td><input class="comments form-control input-sm"/>';
                                $var++;
                            }
                        }
                        ?>
                        <tr>
                            <td>
                            <td colspan="4"><button class="btn btn-warning float-right" onclick="checkAll()" id="btn">Check All</button>
                            <td><button class="btn btn-success" onclick="submit()">Submit</button>
                            <td><input id="bill" class="form-control input-sm" placeholder="Enter Bill Code" />
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>