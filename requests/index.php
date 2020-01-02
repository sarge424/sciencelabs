<html>

<head>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</head>

<body>
    <script>
        let count = 1;

        function addRow() {
            let tbody = document.getElementById('tbody2');
            let tr = document.getElementById('tr0');

            let new_tr = tr.cloneNode(true);
            new_tr.id = 'tr' + count;
            new_tr.classList.toggle('d-none');

            let del = new_tr.lastChild.firstChild;
            del.id = 'del' + count;
            console.log(del);

            let x = count;
            del.onclick = function() {
                deleteRowReq(x);
            };

            tbody.appendChild(new_tr);
            count++;
        }

        function deleteRowReq(index) {
            let tbody = document.getElementById("tbody2");
            let row = document.getElementById("tr" + index);
            tbody.removeChild(row);
        }

        function order() {
            let x = 1;
            while (x < count) {
                let child;
                try {
                    child = document.getElementById('tr' + x).children;

                    if (child.length > 0) {
                        let item, quantity, specs, link, cost;

                        item = child[0].firstChild.value;
                        quantity = child[1].firstChild.value;
                        specs = child[2].firstChild.value;
                        link = child[3].firstChild.value;
                        cost = child[4].firstChild.value;

                        if (item.length > 0 && quantity.length > 0) {
                            connectAjax(item, quantity, specs, link, cost, x);
                        }
                    }
                } catch (e) {}
                x++;
            }
        }

        function connectAjax(item, quantity, specs, link, cost, index) {
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
                    alert("Items Ordered");
                }
            }

            let queryString = "?specs=" + specs + "&item=" + item + "&quantity=" + quantity + "&link=" + link + "&cost=" + cost;
            request.open("GET", "requestitems.php" + queryString, true);
            request.send(null);
        }

        function redirect() {
            document.location.href = "../requests/";
        }
    </script>

    <?php include '../navbar.php'; ?>
    <script>
        setActive('Requests');
    </script>
    <div class="container-fluid">
        <br>
        <div class="text-center">
            <button class="btn btn-primary" onclick="document.location.href='vieworders.php';">Pending Checkouts</button>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <div align="center">
                    <div class="btn-group btn-group-lg">
                        <h3>Purchase Request</h3>
                    </div>

                </div>
                <div style="height: 400px !important; overflow-y: auto !important;">
                    <table class="table">
                        <thead class="thead thead-dark">
                            <th>Item
                            <th>Quantity
                            <th>Specifications
                            <th>Link
                            <th colspan="2">Approx. Cost
                        <tbody id="tbody2">
                            <tr id="tr0" class='d-none'>
                                <td><input class="form-control input-sm" required>
                                <td><input class="form-control input-sm" type="number" min="0" required>
                                <td><input class="form-control input-sm" required>
                                <td><input class="form-control input-sm" required>
                                <td><input class="form-control input-sm" type="number" min="0">
                                <td><button class="btn btn-danger" id="del0">Delete</button>
                    </table>
                </div>
                <br>
                <div class="pull-right">
                    <button class="btn btn-primary btn-md float-right" onclick="order()" style="margin: 5px">&#10004; Place Order</button>
                    <button class="btn btn-success float-right" onclick="addRow()" style="margin: 5px">&plus; Add Order</button>
                </div>

            </div>
            <div class="col-sm-1"></div>
            <div class="col-sm-4">

            </div>
            <div class="col-sm-1"></div>
        </div>
    </div>
</body>

</html>