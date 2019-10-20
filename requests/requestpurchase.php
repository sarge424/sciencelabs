<html>

<head>
    <link rel="stylesheet" href="../css\\bootstrap.min.css">
    <script src="../js\\bootstrap.min.js"></script>
    <script src="../js\\popper.min.js"></script>
    <script src="../js\\jquery-3.4.1.min.js"></script>
</head>

<body>
    <script>
        let count = 1;

        function addRow() {
            let tbody = document.getElementById('tbody');
            let tr = document.getElementById('tr0');

            let new_tr = tr.cloneNode(true);
            new_tr.id = 'tr' + count;
            new_tr.classList.toggle('d-none');

            let del = new_tr.lastChild.previousSibling.firstChild;
            del.id = 'del' + count;

            let stat = new_tr.lastChild.firstChild;
            stat.id = 'status' + count;

            let x = count;
            del.onclick = function() {
                deleteRow(x);
            };

            tbody.appendChild(new_tr);
            count++;
        }

        function deleteRow(index) {
            let tbody = document.getElementById("tbody");
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
                        let item, quantity, specs, cost;

                        item = child[0].firstChild.value;
                        quantity = child[1].firstChild.value;
                        specs = child[2].firstChild.value;

                        if (item.length > 0 && quantity.length > 0) {
                            connectAjax(item, quantity, specs, x);
                        }
                    }
                } catch (e) {}
                x++;
            }
        }

        function connectAjax(item, quantity, specs, index) {
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
                    let status = document.getElementById("status" + index);
                    status.classList.remove("text-secondary");
                    status.classList.add("text-success");
                    status.firstChild.innerHTML = "Success!";
                }
            }

            let queryString = "?specs=" + specs + "&item=" + item + "&quantity=" + quantity;
            request.open("GET", "requestitems.php" + queryString, true);
            request.send(null);
        }

        function redirect() {
            document.location.href = "index.php";
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
                    <div class="btn-group btn-group-lg">
                        <h2>Purchase Request</h2>
                    </div>
                    <button class="btn btn-primary btn-md float-right" onclick="order()">Place Order</button>
                </div>
                <div style="height: 400px !important; overflow-y: auto !important;">
                    <table class="table">
                        <thead class="thead thead-dark">
                            <th>Item
                            <th>Quantity
                            <th colspan="2">Specifications
                            <th>Status
                        <tbody id="tbody">
                            <tr id="tr0" class='d-none'>
                                <td><input class="form-control input-sm" required>
                                <td><input class="form-control input-sm" type="number" style="width: 100px;" required>
                                <td><input class="form-control input-sm">
                                <td><button class="btn btn-danger" id="del0">Delete</button>
                                <td><label class="form-control text-secondary" id="status0" style="text-align: center;"><b>Pending...</b></label>
                    </table>
                </div>
                <br>
                <button class="btn btn-primary float-left" onclick="redirect()">View Orders</button>
                <div class="pull-right">
                    <button class="btn btn-success float-right" onclick="addRow()">Add Order</button>
                </div>
                <div class="col-sm-3"></div>
            </div>
        </div>
    </div>
</body>

</html>