<html>

<head>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.min.js"></script>
</head>

<script>
    function getData() {
        let tbody = document.getElementById("tbody");
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
                tbody.innerHTML = request.responsText;
            }
        }

        request.open("GET", "getOrders.php", true);
        request.send(null);
    }
</script>

<body>
    <div class="container">
        <br>
        <br>
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div align="center">
                    <h3>Pending Student Returns</h3>
                </div>
                <div align="center">
                    <table class="table">
                        <thead class="thead thead-dark">
                            <th>Student
                            <th>Item
                            <th>Quantity
                            <th>Checkout Date
                        </thead>
                        <tbody id="tbody">
                            <script>
                                getData();
                            </script>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-3"></div>
    </div>
</body>

</html>