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

        #studentname,
        #itemname {
            max-height: 150px;
            overflow-y: scroll;
        }
    </style>
</head>

<body>
    <?php include '../navbar.php'; ?>
    <?php include '../checksession.php'; ?>

    <div class="container-fluid">
        <br>
        <br>
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6 bg-white" align="center">
                <form action="transfer.php" method="POST">
                    <div align="center">
                        <div class="btn-group btn-large">
                            <h3>Lab Transfer</h3>
                        </div>
                    </div>
                    <div align="center">
                        <table class="table">
                            <tr>
                                <td>
                                    <label class="form-control input-sm text-primary" align="center"><b>Item Name</b></label>
                                <td>
                                    <input type="text" placeholder="e.g.-'Convex Lens'" id="inm" name="item" onkeyup="getDBStuff()" required class="form-control input-sm">
                                    <input type="text" id="itemid" name="itemid" hidden>
                                    <br>
                                    <div id="itemname" class="text-secondary">Start typing to see items.</div>
                            <tr>
                                <td>
                                    <label class="form-control input-sm text-primary" align="center"><b>Quantity</b></label>
                                <td>
                                    <input class="form-control" type="number" name="quantity" min="1" required />
                            <tr>
                                <td>
                                    <label class="form-control input-sm text-primary" align="center"><b>Lab To</b></label>
                                <td>
                                    <div align="right">
                                        <div class="form-check <?php echo ($_SESSION['lab'] == 'p')?'d-none':'' ?>">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="tolab" value="p">Physics Lab
                                            </label>
                                        </div>
                                        <div class="form-check <?php echo ($_SESSION['lab'] == 'c')?'d-none':'' ?>">
                                            <label class="form-check-label" for="radio2">
                                                <input type="radio" class="form-check-input" name="tolab" value="c">Chemistry Lab
                                            </label>
                                        </div>
                                        <div class="form-check <?php echo ($_SESSION['lab'] == 'b')?'d-none':'' ?>">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="tolab" value="b">Biology Lab
                                            </label>
                                        </div>
                            <tr>
                                <td colspan="2">
                                    <button class="btn btn-success btn-block" type="submit">Checkout</button>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script language="javascript" type="text/javascript">
        function getDBStuff() {
            var ajaxRequest;

            try {
                ajaxRequest = new XMLHttpRequest();
            } catch (e) {
                try {
                    ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                    try {
                        ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
                    } catch (e) {
                        alert("Oops! Something went wrong.");
                        return false;
                    }
                }
            }

            ajaxRequest.onreadystatechange = function() {
                if (ajaxRequest.readyState == 4) {
                    var itemDisplay = document.getElementById('itemname');
                    var itemId = document.getElementById('itemid');
                    itemDisplay.innerHTML = ajaxRequest.responseText;
                }
            }

            var itemnm = document.getElementById('inm').value;

            var queryString = "?itemnm=" + itemnm;
            ajaxRequest.open("GET", "getname.php" + queryString, true);
            ajaxRequest.send(null);
        }
    </script>
</body>

</html>