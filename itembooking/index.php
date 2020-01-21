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

<script>
	function redirectedit(expname, bookingid) {
		let queryString = "?expname=" + expname + "&bookingid=" + bookingid;
		document.location.href = "editexp.php" + queryString;
	}

	function initialise() {
		<?php
		require_once '../db.php';
		require_once '../checksession.php';

		$book_id = $_GET['bookingid'];
		$sql = "select exp_id, quantity from item_booking where labbooking_id=" . $book_id . ";";
		$exp_id = $conn->query($sql)->fetch_assoc()['exp_id'];
		if ($exp_id == "") {
			$exp_id = 0;
		}
		$quantity = $conn->query($sql)->fetch_assoc()['quantity'];
		$sql = "select exp_name from experiment where id=" . $exp_id . ";";
		$exp_name = $conn->query($sql)->fetch_assoc()['exp_name'];
		?>
		document.getElementById("expnm").value = "<?php echo $exp_name; ?>";
		<?php
		if ($quantity != "") {
		?>
			document.getElementById("quan").value = <?php echo $quantity; ?>;
		<?php
		}
		?>
	}

	function view(exp_id) {

	}

	function create(exp_id) {
		document.location.href = "uploaddoc.php?exp_id=" + exp_id + "&booking_id=" + <?php echo $_GET['bookingid'] ?>;
	}

	function edit(exp_id) {
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
				alert(request.responseText);
				window.open(request.responseText);
				create(exp_id);
			}
		}
		let queryString = "?exp_id=" + exp_id;
		request.open("GET", "getfilename.php" + queryString, true);
		request.send(null);
	}
</script>

<body>
	<?php include '../navbar.php'; ?>
	<script>
		setActive('Bookings');
	</script>

	<div class="container-fluid">
		<br>
		<div class="text-center">
			<button class="btn btn-primary" onclick="document.location.href='addexp.php?bookingid=<?php echo $_GET['bookingid']; ?>'">New Experiment</button>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-6 bg-white" align="center">
				<form action="checkoutitems.php" method="POST">
					<div align="center">
						<div class="btn-group btn-large">
							<h3>Checkout Items (For Experiments)</h3>
						</div>
					</div>
					<div align="center">
						<table class="table">
							<tr>
								<td>
									<label class="form-control input-sm text-primary" align="center"><b>Experiment Name</b></label>
								<td>
									<input type="text" placeholder="e.g.-'Simple Pendulum'" id="expnm" name="expname" onkeyup="getDBStuff()" class="form-control input-sm">
									<input type="number" id="bookid" name="bookingid" value="<?php echo $_GET['bookingid']; ?>" hidden>
									<br>
									<div id="studentname" class="text-secondary">Start typing to see experiments.</div>
							<tr>
								<td>
									<label class="form-control input-sm text-primary" align="center"><b>No. of Students</b></label>
								<td>
									<input class="form-control" id="quan" type="number" name="quantity" min="1" required>
							<tr>
								<td colspan="2">
									<button class="btn btn-success btn-block" type="submit">Checkout</button>
						</table>
						<script>
							initialise();
						</script>
					</div>
				</form>
			</div>
			<div class="col-sm-6 bg-white">
				<div align="center">
					<div class="btn-group btn-large">
						<h3>All Experiments</h3>
					</div>
					<table class="table table-hover">
						<thead class="thead thead-dark">
							<tr>
								<th>Experiment</th>
								<th>Items</th>
								<th>Report</th>
								<th>Edit Report</th>
								<th>Edit Experiment</th>
							</tr><br>
						</thead>
						<tbody>
							<?php
							function stringres($sql, $attr)
							{
								include '../db.php';
								$res = $conn->query($sql);
								$ret = '  (';
								while ($row = $res->fetch_assoc()) {
									$ret .= $row[$attr] . ', ';
								}
								$ret = rtrim($ret, ', ') . ')';
								return $ret;
							}

							function checkfile($name)
							{
								$path = '../reports/';
								$files = array_diff(scandir($path), array('.', '..'));
								$files = array_reverse($files);

								$flag = false;
								foreach ($files as $doc) {
									if (startswith($doc, $name)) {
										$flag = true;
									}
								}

								return $flag;
							}

							function startsWith($haystack, $needle)
							{
								$length = strlen($needle);
								return (substr($haystack, 0, $length) === $needle);
							}

							global $conn;

							$sql = 'select id, exp_name from experiment;';

							$result = $conn->query($sql);

							if ($result->num_rows > 0) {
								while ($row = $result->fetch_assoc()) {
									$sql = 'select a.exp_name, a.id, b.exp_id, i.id, i.item_name as item_name from experiment a, experiment_item b, item i where a.exp_name = "' . $row['exp_name'] . '" AND a.id=b.exp_id AND b.item_id = i.id;';
									$itemswithb = stringres($sql, 'item_name');
									$items = substr($itemswithb, 3, strlen($itemswithb) - 4);
									$message = "Create";
									if (checkfile($row['exp_name'])) {
										$message = "View";
									}
							?>

									<tr>
										<td><?php echo $row['exp_name']; ?></td>
										<td><?php echo $items; ?></td>
										<td><button class="btn btn-success" id="report<?php echo $row['id']; ?>" onclick="<?php echo strtolower($message) . "(" . $row['id'] . ")"; ?>"><?php echo $message; ?></button></td>
										<td><button class="btn btn-warning" id="editreport<?php echo $row['id']; ?>" onclick="edit(<?php echo $row['id']; ?>)">Edit</button></td>
										<td><button class="btn btn-danger" onclick="redirectedit('<?php echo $row['exp_name']; ?>', <?php echo $_GET['bookingid']; ?>)">Edit</button></td>
									</tr>

							<?php
								}
							}

							$conn->close();
							?>
					</table>
				</div>
			</div>
			<script language="javascript" type="text/javascript">
				function setitemvalues(id, name) {
					document.getElementById('itemid').value = id;
					document.getElementById('inm').value = name;
				}

				function setexp(id, name) {
					document.getElementById('expnm').value = name;
				}

				function getDBStuff() {
					var request;

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
							var studentDisplay = document.getElementById('studentname');
							let res = request.responseText.split("###");
							studentDisplay.innerHTML = res[0];
						}
					}

					var rollno = document.getElementById('expnm').value;

					var queryString = "?expname=" + rollno;
					request.open("GET", "getname.php" + queryString, true);
					request.send(null);
				}
			</script>
</body>

</html>