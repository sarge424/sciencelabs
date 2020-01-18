<html>

<head>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<script src="../js/jquery-3.4.1.min.js"></script>
	<script src="../js/popper.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
</head>

<body>
	<?php require_once '../checksession.php'; ?>
	<?php include '../navbar.php';
	$lab = $_SESSION['lab'];
	if ($lab == 'b') {
		$lab = 'success';
	} else if ($lab == 'c') {
		$lab = 'danger';
	} else {
		$lab = 'primary';
	}
	?>
	<script>
		setActive('Home');
	</script>

	<div class="container-fluid">
		<div class="col-sm-1"></div>
		<div class="display-1">Welcome to <?php echo $_SESSION["labname"]; ?>Lab!</div>

		<button class="btn btn-lg btn-<?php echo $lab ?>" onclick="document.location.href = 'bookings.php'">
			View bookings and items required for today
		</button>
		<br><br><br>
		<h1>Overview</h1>
		<div class="lead">
			<p>The <button class="btn btn-<?php echo $lab?>" disabled><i class="fa fa-bar-chart"></i> Stock</button> tab contains all the items currently available in the lab. Also, admin users can add new items, and edit older ones.</p>
			<p>The <button class="btn btn-<?php echo $lab?>" disabled><i class="fa fa-comments"></i> Requests</button> tab allow all users to create purchase requests for their classes. Admin users can compile and download these as an excel spreadsheet.</p>
			<p>The <button class="btn btn-<?php echo $lab?>" disabled><i class="fa fa-shopping-cart"></i> Checkouts</button> tab allows admin users to keep track of items taken out of the lab by students.</p>
			<p>The <button class="btn btn-<?php echo $lab?>" disabled><i class="fa fa-shopping-basket"></i> Transactions</button> tab shows all the recent shipments that have arrived in the lab.</p>
			<p>The <button class="btn btn-<?php echo $lab?>" disabled><i class="fa fa-calendar-check-o"></i> Bookings</button> tab allows users to book the lab for specific times and also checkout experiments for their class.</p>
			<strong><b>The <button class="btn btn-<?php echo $lab?>" disabled><i class="fa fa-flask"></i> <b>Lab</b></button> is very important! Make sure you're using the right one!</b></strong>
		</div>
	</div>

	<script>
		function ajaxLabs(labname) {
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
					location.reload();
				}
			}

			var queryString = "?newlab=" + labname;
			request.open("GET", "changelab.php" + queryString, true);
			request.send(null);
		}
	</script>

</body>

</html>