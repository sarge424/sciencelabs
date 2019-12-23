<html>

<head>
<link rel="stylesheet" href="../css/bootstrap.min.css">
	<script src="../js/jquery-3.4.1.min.js"></script>
	<script src="../js/popper.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
</head>

<?php include '../navbar.php'; ?>
<script>
    setActive('Transactions');
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

        request.onreadystatechange = function () {
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
        <br>
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <div align="center">
                    <h3>Transactions</h3>
                </div>
                <table class="table">
                    <thead class="thead thead-dark">
                        <th>ID
                        <th>From Lab
                        <th>Item
                        <th>Quantity Received
                        <th>Specifications
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