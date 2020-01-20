<html>

<?php include '../navbar.php'; ?>
<script>
    setActive('Lab Transfers');
</script>

<head>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</head>

<script>
    function fillData() {
        let tbody = document.getElementById('tbody');
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
                tbody.innerHTML = request.responseText;
            }
        }

        request.open("GET", "gettransfers.php", true);
        request.send(null);
    }
</script>

<body>
    <div class="container-fluid">
        <br>
        <div class="text-center">
            <button class="btn btn-primary" onclick="document.location.href='../labtransactions/';">Transfer More</button>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6 bg-white" align="center">
                <div align="center">
                    <div class="btn-group btn-large">
                        <h3>Previous Transfers</h3>
                    </div>
                </div>
                <table class="table">
                    <thead class="thead thead-dark">
                        <th>Sender
                        <th>Receiver
                        <th>Item
                        <th>Quantity
                        <th>Date
                    </thead>
                    <tbody id="tbody">
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