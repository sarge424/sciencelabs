<html>

<head>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</head>

<?php include '../navbar.php'; ?>
<script>
    setActive('Pending Orders');
</script>

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
                let tbody = document.getElementById("ajaxDiv");
                tbody.innerHTML = request.responseText;
            }
        }

        request.open("GET", "getpurchases.php", true);
        request.send(null);
    }
</script>

<body>
    <div class="container-fluid">
        <br>
        <div align="center">
            <button class="btn btn-primary" onclick="document.location.href='../reviewrequest/';">Check Current Orders</button>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <div align="center">
                    <h3><i class="fa fa-truck" aria-hidden="true"></i> Older Shipments</h3>
                </div>
                <table class="table">
                    <thead class="thead thead-dark">
                        <th>Teacher
                        <th>Item
                        <th>Quantity Ordered
                        <th>Quantity Received
                        <th>Specifications
                        <th>Date Ordered
                        <th>Date Received
                        <th>Comments
                        <th>Bill Code
                    </thead>
                    <tbody id="ajaxDiv">
                        <script>
                            fillData();
                        </script>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-sm-2"></div>
    </div>
</body>

</html>