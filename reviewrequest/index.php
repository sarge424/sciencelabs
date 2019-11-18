<?php include '../navbar.php'; ?>

<html>

<head>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.min.js"></script>
</head>

<style>
    /* The container */
    .container {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 22px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    /* Hide the browser's default checkbox */
    .container input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    /* Create a custom checkbox */
    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 25px;
        width: 25px;
        background-color: #eee;
    }

    /* On mouse-over, add a grey background color */
    .container:hover input~.checkmark {
        background-color: #ccc;
    }

    /* When the checkbox is checked, add a blue background */
    .container input:checked~.checkmark {
        background-color: #2196F3;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the checkmark when checked */
    .container input:checked~.checkmark:after {
        display: block;
    }

    /* Style the checkmark/indicator */
    .container .checkmark:after {
        left: 9px;
        top: 5px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }
</style>

<script>
    function checkAll() {
        let input = document.getElementsByClassName("chk");
        let btn = document.getElementById("btn");
        if (btn.innerHTML == "Check All")
            btn.innerHTML = "Uncheck All";
        else
            btn.innerHTML = "Check All";

        let flag = false;
        let x = 0;

        while (x < input.length)
            if (!input[x++].checked) {
                flag = false;
                break;
            } else
                flag = true;
        x = 0;
        if (flag)
            while (x < input.length)
                input[x++].checked = false;
        else
            while (x < input.length)
                input[x++].checked = true;
    }

    function submit() {
        let item = document.getElementsByClassName("item");
        let quantity = document.getElementsByClassName("quan");
        let specs = document.getElementsByClassName("specs");
        let check = document.getElementsByClassName("chk");
        let x = 0;
        while (x < item.length) {
            if (check[x].checked) {
                let queryString = "?item=" + item[x].innerHTML + "&quantity=" + quantity[x].innerHTML + "&specs=" + specs[x].innerHTML;
                document.location.href = "review.php" + queryString;
            }
            x++;
        }
    }
</script>

<body>
    <div class="container-fluid">
        <br>
        <br>
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <div align="center">
                    <div class="btn-group btn-group-lg">
                        <h2>Review Arrived Order</h2>
                    </div>
                </div>
                <table class="table">
                    <thead class="thead thead-dark">
                        <th>Name
                        <th>Quantity
                        <th>Specifications
                        <th>Arrived?
                    </thead>
                    <tbody>
                        <?php
                        include_once '../db.php';

                        $sql = "select * from purchase_request where is_for='p' and arrived=0;";
                        $result = $conn->query($sql);

                        $var = 0;
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<tr><td class="item">' . $row['item_name'] .
                                    '<td class="quan">' . $row['quantity'] .
                                    '<td class="specs">' . $row['specs'] .
                                    '<td><label class="container">
                                                <input id="chk' . $var . '" name="chk' . $var . '" type="checkbox" class="chk">
                                                <span class="checkmark"></span>
                                            </label>';
                                $var++;
                            }
                        }
                        ?>
                        <tr>
                            <td colspan="2">
                            <td><button class="btn btn-success" onclick="submit()">Submit</button>
                            <td><button class="btn btn-warning" onclick="checkAll()" id="btn">Check All</button>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>