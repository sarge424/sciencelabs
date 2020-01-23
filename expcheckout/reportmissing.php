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
	<script>
		setActive('Bookings');
	</script>

	<div class="container-fluid">
		<br>
		<div class="text-center">
			<button class="btn btn-primary" onclick="window.history.back();">Back</button>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-3"></div>
			<div class="col-sm-6 bg-white" align="center">
				<form action="lostitemdb.php" method="POST">
					<div align="center">
						<div class="btn-group btn-large">
							<h3>Charge Missing Items to Students</h3>
						</div>
					</div>
					<div align="center">
						<table class="table">
							<tr>
								<td>
									<label class="form-control input-sm text-primary" align="center"><b>Roll No.</b></label>
								<td>
									<select class="custom-select input-sm" id="rno" align="right" name="rollno" required>
										<?php
										$ch_id = $_GET['checkout_id'];
										$sql = 'select distinct i.labbooking_id, l.class_id, s.id as rollno, s.student_name, s.class_id '.
										'from item_booking i, lab_booking l, student s '.
										'where i.labbooking_id = l.id AND l.class_id = s.class_id';
										$result = $conn->query($sql);
										while ($row = $result->fetch_assoc()) {
											echo '<option value="'.$row['rollno'].'">' . $row['student_name'] . '</option>';
										}
										?>
									</select>
							<tr>
								<td>
									<label class="form-control input-sm text-primary" align="center"><b>Item Name</b></label>
								<td>
									<select class="custom-select input-sm" id="itemid" align="right" name="itemid" required>
										<?php
										$ch_id = $_GET['checkout_id'];
										$sql = 'select distinct b.exp_id, e.exp_id, e.item_id, i.id as itemid, i.item_name as itemname '.
										'from item_booking b, experiment_item e, item i '.
										'where b.exp_id=e.exp_id and e.item_id=i.id';
										$result = $conn->query($sql);
										while ($row = $result->fetch_assoc()) {
											echo '<option value="'.$row['itemid'].'">' . $row['itemname'] . '</option>';
										}
										?>
									</select>
							<tr>
								<td>
									<label class="form-control input-sm text-primary" align="center"><b>Quantity</b></label>
								<td>
									<input class="form-control" type="number" name="quantity" min="1" required></input>
							<tr>
								<td colspan="2">
									<button class="btn btn-danger btn-block" type="submit">Mark as Lost</button>
						</table>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script language="javascript" type="text/javascript">
		function setitemvalues (id, name) {
			document.getElementById('itemid').value = id;
			document.getElementById('inm').value = name;
		}

		function setroll (id) {
			document.getElementById('rno').value = id;
		}
	</script>
</body>

</html>