<html>

<?php
include '../navbar.php';
?>
<script>
    setActive('Reconciliation');
</script>

<head>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</head>

<script>
    function fillData() {
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
                let tbody = document.getElementById('data');
                tbody.innerHTML = request.responseText;
            }
        }

        request.open("GET", "filldata.php", true);
        request.send(null);
    }

    function submit() {
        let item = document.getElementsByClassName("item");
        let specs = document.getElementsByClassName("specs");
        let quantity = document.getElementsByClassName("quantity");

        let x = 0;
        while (x < item.length) {
            if (quantity[x].value != "") {
                enterRecon(item[x].innerHTML, specs[x].innerHTML, quantity[x].value);
            }
            x++;
        }
    }

    function enterRecon(item, specs, quantity) {
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
                document.location.href = "../recon/";
            }
        }

        let queryString = "?item=" + item + "&specs=" + specs + "&quantity=" + quantity;
        request.open("GET", "enterrecon.php" + queryString, true);
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
                    <div class="btn-group btn-group-lg">
                        <h2>Reconciliation</h2>
                    </div>
                </div>
                <table class="table">
                    <thead class="thead thead-dark">
                        <th>Item
                        <th>Specifications
                        <th>Required Quantity
                        <th>Quantity In Stock
                        <th><button class="btn btn-warning" onclick="submit()">Submit</button>
                    </thead>
                    <tbody id="data">
                        <script>
                            fillData();
                        </script>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>