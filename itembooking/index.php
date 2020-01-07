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
			<button class="btn btn-primary" onclick="document.location.href='addexp.php?bookingid=<?php echo $_GET['bookingid'] ?>';">New Experiment</button>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-3"></div>
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
									<input class="form-control" type="number" name="quantity" min="1" required>
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
		function setitemvalues(id, name) {
			document.getElementById('itemid').value = id;
			document.getElementById('inm').value = name;
		}

		function setexp(id, name) {
			document.getElementById('expid').value = id;
			document.getElementById('expnm').value = name;
		}

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
					var studentDisplay = document.getElementById('studentname');
					let res = ajaxRequest.responseText.split("###");
					studentDisplay.innerHTML = res[0];
				}
			}

			var rollno = document.getElementById('expnm').value;

			var queryString = "?expname=" + rollno;
			ajaxRequest.open("GET", "getname.php" + queryString, true);
			ajaxRequest.send(null);
		}
	</script>
</body>

</html>