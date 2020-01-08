<html>

<head>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<script src="../js/jquery-3.4.1.min.js"></script>
	<script src="../js/popper.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
</head>

<body>
	<?php require_once '../checksession.php'; ?>
	<?php include '../navbar.php'; ?>
	<script>
		setActive('Home');
	</script>

	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<div class="display-1 text-center">Welcome to <?php echo $_SESSION["labname"]; ?>Lab!</div>
			<div class="float-right rounded img-thumbnail"><img src="../img/mad-scientist.svg" alt="Icon"></div>
		</div>
		<div class="col-sm-2"></div>
	</div>

	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-sm-6 text-center">
			<input class='mx-auto' type="image" src="../img/atom.svg" onclick="ajaxLabs('p')" title="Physics Lab" width="150" height="150">
			<input class='mx-auto' type="image" src="../img/flask.svg" onclick="ajaxLabs('c')" title="Chemistry Lab" width="150" height="150">
			<input class='mx-auto' type="image" src="../img/cells.svg" onclick="ajaxLabs('b')" title="Biology Lab" width="150" height="150">
			<br>
			<br>
			<a href="viewuser.php">
				<h4>View current booking and items required</h4>
			</a>
		</div>
		<div class="col-sm-3"></div>
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