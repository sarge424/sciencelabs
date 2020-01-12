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
    <?php
    require_once '../checksession.php';
    ?>

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

            let itemid = new_tr.firstChild.nextSibling.firstChild;
            itemid.id = 'id' + count;
            itemid.innerHTML = document.getElementById('itemid').value;
            document.getElementById('itemid').value = '';

            let itemnm = new_tr.firstChild.nextSibling.nextSibling.firstChild;
            itemnm.id = 'name' + count;
            itemnm.innerHTML = document.getElementById('inm').value;
            document.getElementById('inm').value = '';
            document.getElementById('itemname').innerHTML = 'Start typing to see items.';

            new_tr.firstChild.nextSibling.nextSibling.nextSibling.firstChild.id = 'quantity' + count;

            let x = count;
            del.onclick = function() {
                deleteRowReq(x);
            };

            tbody.appendChild(new_tr);
            count++;
        }

        function init(itid, name, quant) {
            let tbody = document.getElementById('tbody2');
            let tr = document.getElementById('tr0');

            console.log(tr);

            let new_tr = tr.cloneNode(true);
            new_tr.id = 'tr' + count;
            new_tr.classList.toggle('d-none');

            let del = new_tr.lastChild.firstChild;
            del.id = 'del' + count;

            let itemid = new_tr.firstChild.nextSibling.firstChild;
            itemid.id = 'id' + count;
            itemid.innerHTML = itid;

            let itemnm = new_tr.firstChild.nextSibling.nextSibling.firstChild;
            itemnm.id = 'name' + count;
            itemnm.innerHTML = name;
            
            new_tr.firstChild.nextSibling.nextSibling.nextSibling.firstChild.id = 'quantity' + count;
            new_tr.firstChild.nextSibling.nextSibling.nextSibling.firstChild.value = quant;

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

        function setitemvalues (id, name) {
			document.getElementById('itemid').value = id;
			document.getElementById('inm').value = name;
		}

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
                    let res = request.responseText.split("###");
                    document.getElementById('itemname').innerHTML = res[1];
                }
            }

            let queryString = "?itemnm=" + document.getElementById('inm').value;
            request.open("GET", "getname.php" + queryString, true);
            request.send(null);
        }

        function handle(res){
            if(res === 'exists'){
                alert('This experiment already exists!');
                document.getElementById('exn').value = '';
            }
            if(res === 'done'){
                document.getElementById('exn').value = '';
                for(let x=1; x < count; x++){
                    if(document.getElementById('del'+x)!==null){
                        document.getElementById('del'+x).click();
                    }
                }

            }
            alert(res);
        }

        function submitAjax(id, q, nm) {
            let request;
            alert('boo');
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
                    handle(request.responseText);
                }
            }

            let queryString = "?id=" + id + '&q=' + q + '&name=' + nm;
            request.open("GET", "submitedit.php" + queryString, true);
            request.send(null);
        }

        function submitExp () {
            for(let x=1; x < count; x++){
                if(document.getElementById('tr'+x)!==null){
                    alert('init');
                    submitAjax(document.getElementById('id'+x).innerHTML, document.getElementById('quantity'+x).value, document.getElementById('exn').value);
                }
            }
        }
    </script>

    <?php include '../navbar.php';?>
    <script>
        setActive('Bookings');
    </script>
    <div class="container-fluid">
        <br>
        <div class="text-center">
			<button class="btn btn-primary" onclick="document.location.href='index.php?bookingid=<?php echo $_GET['bookingid']?>';">Back to Booking</button>
		</div>
        <br>
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <div align="center">
                    <div class="btn-group btn-group-lg">
                        <h3>Edit Experiment <?php echo $_GET['expname']?></h3>
                    </div>

                </div>
                <div style="height: 400px !important; overflow-y: auto !important;">
                    <table class="table">
                        <thead class="thead thead-dark">
                            <th>ID
                            <th>Item
                            <th>Quantity
                            <th>
                        <tbody id="tbody2">
                            <tr id="tr0" class='d-none'>
                                <td><div id="id0" class="form-control input-sm" type="number" readonly></div>
                                <td><div id="name0" class="form-control input-sm" readonly></div>
                                <td><input id="quantity0" class="form-control input-sm" type="number">
                                <td><button class="btn btn-danger" id="del0">Delete</button>
                    </table>
                </div>
                <br>
                <div class="pull-right form-inline">
                    <input type="text" placeholder="e.g.-'Convex Lens'" id="inm" name="itemname" onkeyup="getDBStuff()" class="form-control input-sm">&emsp;
					<input type="text" id="itemid" name="itemid" hidden>
                    <button class="btn btn-success" onclick="if(document.getElementById('itemid').value !== ''){addRow()}">&plus; Add Item</button>
                </div>
                <div class="form-inline">
                    <input type="text" placeholder="'Simple Pendulum'" id="exn" name="expname" class="form-control input-sm" value="<?php echo $_GET['expname'];?>" readonly>&emsp;
                    <button class="btn btn-primary btn-md" onclick="submitExp()">&#10004; Confirm Experiment</button>
                </div>
                <br>
                <div id="itemname" class="text-secondary pull-right">Start typing to see items.</div>

            </div>
            <div class="col-sm-2"></div>
        </div>
    </div>
    <?php
        include_once '../db.php';
        $sql = 'select * from experiment where exp_name="'.$_GET['expname'].'";';
        $result=$conn->query($sql);
        echo '<script>';
        while($row=$result->fetch_assoc()){
            $itemname = $conn->query('select item_name from item where id='.$row['item_id'].';')->fetch_assoc()['item_name'];
            echo 'init('.$row['item_id'].', "'.$itemname.'",'.$row['quantity'].');';
        }
        echo '</script>';
    ?>
</body>

</html>