<html>

<head>
    <link rel="stylesheet" href="../css\\bootstrap.min.css">
    <script src="../js\\bootstrap.min.js"></script>
    <script src="../js\\popper.min.js"></script>
    <script src="../js\\jquery-3.4.1.min.js"></script>
</head>

<body>
    <script>
        function initialise() {
            let url_string = window.location.href;
            let url = new URL(url_string);

            let item = url.searchParams.get("item");
            let specs = url.searchParams.get("specs");
            let quantity = url.searchParams.get("quantity");

            document.getElementById("item").value = item;
            document.getElementById("specs").value = specs;
            document.getElementById("quantity").value = quantity;

            document.getElementById("item_repeat").value = item;
            document.getElementById("specs_repeat").value = specs;
            document.getElementById("quan_repeat").value = quantity;
        }
    </script>
    <?php require '../navbar.php'; ?>
    <script>
        setActive('Requests');
    </script>
    
    <?php
    require_once '../db.php';
    require_once '../checksession.php';
    global $conn;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user = $_SESSION['user'];

        $item = $_REQUEST['item'];
        $specs = $_REQUEST['specs'];
        $quantity = $_REQUEST['quantity'];

        $prev_item = $_REQUEST['item_repeat'];
        $prev_quantity = $_REQUEST['quan_repeat'];
        $prev_specs = $_REQUEST['specs_repeat'];

        $sql = "update purchase_request set item_name = '" . $item . "', quantity_ordered = " . $quantity . ", specs = '" . $specs .
            "' where id = (select min(id) from purchase_request" .
            " where teacher_id = " . $user . " and item_name = '" . $prev_item . "' and specs = '" . $prev_specs . "' and quantity_ordered = " . $prev_quantity . " and arrived = 0);";
        $conn->query($sql);

        echo '<script>
            document.location.href = "../requests/vieworders.php";
        </script>';

        $conn->close();
    }
    ?>
    
    <div class="container">
        <br>
        <br>
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div align="center">
                    <form action="<?php $_SERVER = ["PHP_SELF"] ?>" method="POST">
                        <table class="table">
                            <h3>Edit Request</h3>
                            <br>
                            <tbody>
                                <tr>
                                    <td><label class="form-control input-sm text-primary" style="width: 125px;"><b>Item
                                                Name</b></label>
                                    <td><input class="form-control input-sm" type="text" placeholder="Enter Item Name" name="item" id="item" autofocus required></input>
                                <tr>
                                    <td><label class="form-control input-sm text-primary" style="width: 125px;"><b>Quantity</b></label>
                                    <td><input class="form-control input-sm" type="number" placeholder="Enter Quantity" name="quantity" id="quantity" required></input>
                                <tr>
                                    <td><label class="form-control input-sm text-primary" style="width: 125px;"><b>Specifications</b></label>
                                    <td><input class="form-control input-sm" type="text" placeholder="Enter Specifications (Not Required)" name="specs" id="specs"></input>
                                <tr>
                                    <td colspan="2"><button class="btn btn-warning float-right" type="submit">Submit
                                            Request</button>
                                <tr class="d-none">
                                    <td><input id="item_repeat" name="item_repeat" />
                                    <td><input id="specs_repeat" name="specs_repeat" />
                                    <td><input id="quan_repeat" name="quan_repeat" />
                        </table>
                        <script>
                            initialise();
                        </script>
                    </form>
                </div>
            </div>
        </div>
</body>

</html>