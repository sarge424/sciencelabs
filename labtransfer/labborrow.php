<html>

<head>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>

    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        #itemname {
            max-height: 100px;
            overflow-y: scroll;
        }
    </style>
</head>

<script>
    function setItem(item, id) {
        document.getElementById('item').value = item;
        document.getElementById('id').innerHTML = id;
    }

    function borrow() {

        let tolab = document.getElementById("borrowedby").value;
        let item = document.getElementById("id").innerHTML;
        let quantity = document.getElementById("quantity").value;

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
                if (request.responseText != "") {
                    alert(request.responseText);
                }
                document.location.href = "../labtransfer/labborrow.php";
            }
        }


        let queryString = "?id=" + item + "&quantity=" + quantity + "&tolab=" + tolab;
        request.open("GET", "borrow.php" + queryString, true);
        request.send(null);
    }
</script>

<body>
    <?php include '../navbar.php'; ?>
    <script>
        setActive('Lab Transfers');
    </script>
    <?php require_once '../checksession.php'; ?>

    <div class="container-fluid">
        <br>
        <div class="text-center">
            <button class="btn btn-primary" onclick="document.location.href='showborrowed.php';">Borrowed Items</button>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6 bg-white" align="center">
                <div align="center">
                    <div class="btn-group btn-large">
                        <h3>Borrow Items</h3>
                    </div>
                </div>
                <div align="center">
                    <table class="table">
                        <tr>
                            <td>
                                <label class="form-control input-sm text-primary" align="center"><b>Item Name</b></label>
                            <td>
                                <input class="form-control input-sm" type="text" placeholder="e.g.-'Convex Lens'" id="item" onkeyup="getDBStuff()" required>
                                <br>
                                <div id="itemname" class="text-secondary">Start typing to see items. Please CLICK on item name.</div>
                                <div id="id" value="-1" hidden></div>
                        <tr>
                            <td>
                                <label class="form-control input-sm text-primary" align="center"><b>Quantity</b></label>
                            <td>
                                <input class="form-control" type="number" id="quantity" min="1" required />
                        <tr>
                            <td>
                                <label class="form-control input-sm text-primary" align="center"><b>Borrowed By</b></label>
                            <td>
                                <input class="form-control input-sm" type="text" placeholder="e.g.-'Invention Lab'" id="borrowedby" required>
                                <br>
                        <tr>
                            <td colspan="2">
                                <button class="btn btn-success btn-block" type="submit" onclick="borrow()">Borrow</button>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script language="javascript" type="text/javascript">
        function getDBStuff() {
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
                    let itemDisplay = document.getElementById('itemname');
                    itemDisplay.innerHTML = request.responseText;
                }
            }

            var itemnm = document.getElementById('item').value;

            var queryString = "?itemnm=" + itemnm;
            request.open("GET", "getname.php" + queryString, true);
            request.send(null);
        }
    </script>
</body>

</html>