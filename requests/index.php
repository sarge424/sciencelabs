<html>

<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 40% !important;
        top: 20% !important;
        width: 20% !important;
        height: 23% !important;
        overflow: auto;
        box-shadow: 5px 10px 8px 1000px rgba(0, 0, 0, 0.5);
    }

    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }
</style>

<div id="confirm" class="modal">
    <div class="modal-content">
        <table class="table">
            <tr>
                <td colspan="2">
                    <b>Are you sure you want to delete this order?</b>
            <tr>
                <td>
                    <button class="btn btn-danger" onclick="del()">Yes</button>
                <td>
                    <button class="btn btn-success float-right" onclick="back()">No</button>
        </table>
    </div>
</div>

<head>
    <link rel="stylesheet" href="../css\\bootstrap.min.css">
    <script src="../js\\bootstrap.min.js"></script>
</head>

<body>
    <?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    ?>
    <script>
        let item;

        function editRow(row) {
            let item = document.getElementById("item" + row);
            item = item.innerHTML.trim();
            let specs = document.getElementById("specs" + row);
            specs = specs.innerHTML.trim();
            let quantity = document.getElementById("quantity" + row);
            quantity = quantity.innerHTML.trim();

            document.location.href = "editorder.php?item=" + item + "&specs=" + specs + "&quantity=" + quantity;
        }

        function del() {
            let element = document.getElementById("item" + item);
            document.location.href = "deleteorder.php?item=" + element.innerHTML.trim() + "&specs=" + element.nextSibling.innerHTML.trim() + "&quantity=" + element.nextSibling.nextSibling.innerHTML.trim();
        }

        function deleteRow(row) {
            item = row;
            let modal = document.getElementById("confirm");
            modal.style.display = "block";
        }

        function back() {
            let modal = document.getElementById("confirm");
            modal.style.display = "none";
        }

        function redirect() {
            document.location.href = "requestpurchase.php";
        }

        function showButton() {
            document.getElementById("btn-hidden").classList.toggle("d-none");
        }

        function adminButtonClick() {
            let button = document.getElementById("btn-hidden");
            let num = 1;
            if (<?php echo $_SESSION['level']; ?> < 2) {
                if (button.innerHTML == "View All Orders") {
                    document.getElementById("heading").innerHTML = "All Pending Orders";
                    document.getElementById("btn-hidden").innerHTML = "View Your Orders";
                    num = 0;
                } else {
                    document.getElementById("heading").innerHTML = "Your Pending Orders";
                    document.getElementById("btn-hidden").innerHTML = "View All Orders";
                    num = 1;
                }
            } else {
                num = 1;
            }

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
                    let display = document.getElementById('tbody');
                    display.innerHTML = request.responseText;
                }
            }

            let queryString = "?num=" + num;
            request.open("GET", "getrequests.php" + queryString, true);
            request.send(null);
        }
    </script>
    <?php include '../navbar.php'; ?>
    <script>
        setActive('Requests');
    </script>
    <div class="container-fluid">
        <br>
        <br>
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div align="center">
                    <h2 id="heading">Your Pending Orders</h2>
                </div>
                <div style="height: 400px !important; overflow-y: auto !important;">
                    <table class="table">
                        <thead class="thead thead-dark">
                            <th>Item
                            <th>Specifications
                            <th colspan="3">Quantity
                        </thead>
                        <tbody id="tbody"></tbody>
                    </table>
                </div>
                <br>
                <button class="btn btn-primary float-left" onclick="redirect()">Order More</button>
                <div class="pull-right">
                    <button class="btn btn-success float-right d-none" id="btn-hidden" onclick="adminButtonClick()">View
                        All Orders</button>
                </div>
                <script>
                    adminButtonClick();
                </script>
                <?php
                $level = $_SESSION['level'];

                if ($level < 2) {
                    echo '<script>showButton();</script>';
                }
                ?>
                <div class="col-sm-3"></div>
            </div>
        </div>
    </div>
</body>

</html>