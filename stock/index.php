<?php
require_once '../db.php';
require_once '../checksession.php';
?>
<html>

<style>
	.modal {
		display: none;
		position: fixed;
		z-index: 1;
		left: 40% !important;
		top: 20% !important;
		width: 20% !important;
		height: 23% !important;
		overflow: auto;
		box-shadow: 5px 10px 8px 1000px rgba(0, 0, 0, 0.5);
	}

	.modal-content {
		background-color: #fefefe;
		margin: auto;
		padding: 20px;
		border: 1px solid #888;
		width: 80%;
	}
</style>

<div id="confirm" class="modal">
	<div class="modal-content">
		<table class="table">
			<tr>
				<td colspan="2">
					<b>Are you sure you want to delete this item?</b>
			<tr>
				<td>
					<button class="btn btn-danger" onclick="del()">Yes</button>
				<td>
					<button class="btn btn-success float-right" onclick="back()">No</button>
		</table>
	</div>
</div>

<head>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<script src="../js/jquery-3.4.1.min.js"></script>
	<script src="../js/popper.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="/sciencelabs/css/font-awesome.min.css">
</head>

<body>

	<?php
	include '../navbar.php';
	$sql = 'select min_quantity, quantity from item where min_quantity > quantity and lab="'.$_SESSION['lab'].'";';
	$alert = ($conn->query($sql)->num_rows == 0 || $lev == 3) ? 'd-none' : '';
	$darknav = ($lev == 1) ? 'setDarkMode();' : '';
	?>
	<script>
		setActive('Stock');
		<?php echo $darknav?>
	</script>

	<script>
		let item;

		function editItem(itemid) {
			document.location.href = 'viewitems.php?item_id=' + itemid;
		}

		function delItem(itemid) {
			item = itemid;
			let modal = document.getElementById("confirm");
			modal.style.display = "block";
		}

		function del() {
			document.location.href = 'deleteitem.php?item_id=' + item;
		}

		function back() {
			let modal = document.getElementById("confirm");
			modal.style.display = "none";
		}

		function sort(orderby) {
			document.location.href = '<?php echo $_SERVER['PHP_SELF']; ?>?orderby=' + orderby;
		}

		function genReport() {
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
					window.open(request.responseText);
				}
			}

			request.open("GET", "genreport.php", true);
			request.send(null);
		}
	</script>

	<div class="container">
		<br>
		<div align="center">
			<button class="btn btn-primary" onclick="document.location.href = '../missing/'">Missing Items</button>
		</div>
		<br>
		<div class="alert alert-danger text-center <?php echo $alert; ?>">
			<strong>Warning!</strong> Item(s) are lower than their required stock(s).
			<button class="btn btn-danger btn-sm mx-0" onclick="genReport()">Generate Report</button>
		</div>
		<h3 class="text-center">View Stock</h3>
		<table class="table table-hover">
			<thead class="thead thead-dark">
				<tr>
					<th onclick="sort('item_name')">Name</th>
					<th onclick="sort('min_quantity')">Min. Quantity</th>
					<th onclick="sort('quantity')">Stock</th>
					<th onclick="sort('lab_location')">Shelf</th>
					<th onclick="sort('specs')" colspan="1">Specifications</th>
					<th onclick="sort('lost_quantity')">Lost Quantity</th>
					<?php echo ($_SESSION['level'] == 1) ? '<th>Lab</th>' : '' ?>
					<th><button class="btn btn-success float-right d-none" onclick="document.location.href = 'addnewitem.php'" <?php echo ($lev == 2) ? 'disabled' : ''; ?>>New Item</button></th>
				</tr>
			</thead>
			<tbody>
				<?php
				global $conn;

				$order_by = 'id';

				if (isset($_GET['orderby'])) {
					$order_by = $_GET['orderby'];
				}

				if ($_SESSION['level'] == 1) {
					$sql = 'select * from item ORDER BY ' . $order_by . ';';
				} else {
					$sql = 'select * from item where lab="' . $_SESSION['lab'] . '" ORDER BY ' . $order_by . ';';
				}

				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						$item_id = $row['id'];
						$item_name = $row['item_name'];
						$item_stock = $row['quantity'];
						$item_min = $row['min_quantity'];
						$item_loc = $row['lab_location'];
						$item_specs = $row['specs'];
						$item_lost = $row['lost_quantity'];
						$lab = strtoupper($row['lab']);
						$icon = '';
						if ($item_stock < $item_min)
							$icon = '<i class="fa fa-exclamation-triangle text-danger"></i>';

				?>

						<tr>
							<td><?php echo $icon . ' ' . $item_name ?></td>
							<td><?php echo $item_min; ?></td>
							<td><?php echo $item_stock > 0 ? $item_stock : 'OUT OF STOCK'; ?></td>
							<td><?php echo $item_loc ?></td>
							<td><?php echo $item_specs ?></td>
							<td><?php echo $item_lost; ?></td>
							<?php echo ($_SESSION['level'] == 1) ? '<td>' . $lab . '</td>' : '' ?>
							<td>
								<button class="btn btn-warning btn-small float-right" onclick="editItem(<?php echo $item_id ?>)" <?php echo ($lev == 2) ? 'disabled' : ''; ?>>Edit</button>
							</td>
						</tr>

				<?php
					}
				}

				$conn->close();
				?>
		</table>
	</div>
</body>

</html>