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

		<button class="btn btn-lg btn-<?php echo $lab?>" href="bookings.php">
			View bookings and items required for today
		</button>
		<br><br><br>
		<div class="display-2">Overview</div>
	</div>

	<script>
		function ajaxLabs(labname) {
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
					location.reload();
				}
			}

			var queryString = "?newlab=" + labname;
			ajaxRequest.open("GET", "changelab.php" + queryString, true);
			ajaxRequest.send(null);
		}
	</script>

</body>

</html>