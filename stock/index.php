<?php require_once '../db.php'; ?>
<html>

<head>
	<title>Stock - PhyLab</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<script src="../js/bootstrap.min.js"></script>
</head>

<body>

	<?php include '../navbar.php'; ?>
	<script>
		setActive('Stock');
	</script>

	<script>
		function editItem(itemid) {
			document.location.href = 'viewitems.php?item_id=' + itemid;
		}

		function delItem(itemid) {
			document.location.href = 'deleteitem.php?item_id=' + itemid;
		}

		function sort(orderby) {
			document.location.href = '<?php echo $_SERVER['PHP_SELF']; ?>?orderby=' + orderby;
		}
	</script>

	<br>
	<br>

	<div class="container">
		<h1 class="text-center">View Stock</h1>
		<table class="table table-hover">
			<thead class="thead thead-dark">
				<tr>
					<th onclick="sort('id')">ID</th>
					<th onclick="sort('item_name')">Name</th>
					<th onclick="sort('stock')">Stock</th>
					<th onclick="sort('lab_location')">Shelf No.</th>
					<th onclick="sort('specs')" colspan="1">Specifications</th>
					<th><button class="btn btn-success float-right" onclick="document.location.href = 'addnewitem.php'" <?php echo ($lev != 1) ? 'disabled' : ''; ?>">New Item</button></th>
				</tr>
			</thead>
			<tbody>
				<?php
				global $conn;

				$order_by = 'id';

				if (isset($_GET['orderby'])) {
					$order_by = $_GET['orderby'];
				}

				$sql = 'SELECT * from item ORDER BY ' . $order_by . ';';

				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						$item_id = $row['id'];
						$item_name = $row['item_name'];
						$item_stock = $row['quantity'];
						$item_loc = $row['lab_location'];
						$item_specs = $row['specs'];

						?>

						<tr>
							<td><?php echo $item_id ?></td>
							<td><?php echo $item_name ?></td>
							<td><?php echo $item_stock > 0 ? $item_stock : 'OUT OF STOCK'; ?></td>
							<td><?php echo $item_loc ?></td>
							<td><?php echo $item_specs ?>
							<td><button class="btn btn-danger btn-small float-right" onclick="delItem(<?php echo $item_id ?>)" <?php echo ($lev != 1) ? 'disabled' : ''; ?>">&times;</button>
								<p class="float-right px-1"> </p>
								<button class="btn btn-warning btn-small float-right" onclick="editItem(<?php echo $item_id ?>)" <?php echo ($lev != 0) ? 'disabled' : ''; ?>">Edit</button>
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