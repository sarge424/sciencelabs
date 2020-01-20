<html>

<head>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</head>

<?php
require_once '../checksession.php';
include_once '../navbar.php';
?>

<script>
    setActive('Requests');
</script>

<script>
    let item;

    function editRow(row) {
        let item = document.getElementById("item" + row);
        item = item.innerHTML.trim();
        let specs = document.getElementById("specs" + row);
        specs = specs.innerHTML.trim();
        let quantity = document.getElementById("quantity" + row);
        quantity = quantity.innerHTML.trim();
        let link = document.getElementById("link" + row);
        link = link.innerHTML.trim();
        let cost = document.getElementById("cost" + row);
        cost = cost.innerHTML.trim();

        document.location.href = "editorder.php?item=" + item + "&specs=" + specs + "&quantity=" + quantity + "&link=" + link + "&cost=" + cost;
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

    function adminButtonClick() {
        button = document.getElementById("switch");

        if (button.innerHTML == "View All Orders") {
            document.getElementById("heading").innerHTML = "All Pending Orders";
            button.innerHTML = "View Your Orders";
            num = 0;
        } else {
            document.getElementById("heading").innerHTML = "Your Pending Orders";
            button.innerHTML = "View All Orders";
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

    function createExcel() {
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
                window.open('../excel/<?php echo $_SESSION['labname'] . " Request " . date("Y m d"); ?>.xlsx');
            }
        }

        request.open("GET", "genexcel.php", true);
        request.send(null);
    }
</script>

<body>
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
    <div class="container-fluid">
        <br>
        <div class="text-center">
            <button class="btn btn-primary" onclick="document.location.href='../requests/';">New Order</button>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <div align="center">
                    <h3 id="heading">Your Pending Orders</h3>
                </div>
                <div style="height: 300px !important; overflow-y: auto !important;">
                    <table class="table">
                        <thead class="thead thead-dark">
                            <th>Item
                            <th>Specifications
                            <?php echo ($_SESSION['level'] == 1)?'<th>Lab</th>':'' ?>
                            <th>Quantity
                            <th>Link
                            <th colspan="3">Cost
                        </thead>
                        <tbody id="tbody"></tbody>
                    </table>
                </div>
                <br>
                <div class="pull-right">
                    <button class="btn btn-success float-right" id="switch" style="margin: 5px" onclick="adminButtonClick()" <?php echo ($_SESSION['level'] < 3) ? '' : 'hidden' ?>>View All Orders</button>
                    <button class="btn btn-primary float-right" style="margin: 5px" id="genxl" onclick="createExcel()" <?php echo ($_SESSION['level'] < 3) ? '' : 'hidden' ?>>Generate Excel</button>
                </div>
                <script>
                    adminButtonClick();
                </script>
            </div>
        </div>
    </div>
</body>

</html>