<html>

<head>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</head>

<?php include '../navbar.php'; ?>
<script>
    setActive('Bookings');
</script>

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
                tbody.innerHTML = request.responseText;
            }
        }

        request.open("GET", "getdata.php", true);
        request.send(null);
    }

    function arrived(row) {
        let tr = document.getElementById("row" + row);
        tr = tr.firstChild;
        let student_id = tr.id;
        tr = tr.nextSibling;
        let item_id = tr.id;
        tr = tr.nextSibling;
        let quantity = tr.innerHTML;

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
                alert("Item returned");
                document.location.reload();
            }
        }

        let queryString = "?checkout_id=" + row;
        request.open("GET", "returnexp.php" + queryString, true);
        request.send(null);
    }

    function lost(row) {
        var redirect = confirm('Please use the student checkout tab to mark items as lost and charge the respective student. Would you like to be redirected?');
        if(redirect){
            document.location.href = 'reportmissing.php?checkout_id='+row;
        }
    }
</script>

<body>
    <div class="container-fluid">
        <br>
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div align="center">
                    <h3>Pending Experiment Returns</h3>
                </div>
                <div align="center">
                    <table class="table">
                        <thead class="thead thead-dark">
                            <th>Teacher
                            <th>Experiment
                            <th>Quantity
                            <th>Class
                            <th>Date
                            <th class="text-center" colspan="2">Mark as
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
    </div>
</body>

</html>