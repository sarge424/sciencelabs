<html>

<head>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/bootstrap.min.js"></script>
</head>

<body>
	<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	?>
	<script>
		function forgotpass() {
			document.location.href = 'pass/forgotpass.php';
		}
	</script>

	<div class="container-fluid">
		<br>
		<br>
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4 bg-white" align="center">
				<form action="user/validateuser.php" method="POST">
					<div align="center">
						<div class="btn-group btn-group-lg">
							<h3>Login</h3>
						</div>
						<div class="float-right"><img src="img/mad-scientist.svg" height="50" width="50" align="center" border="0" alt="Icon"></div>
					</div>
					<div align="center">
						<table class="table">
							<tbody>
								<tr>
									<td>
										<label class="form-control input-sm text-primary"><b>Username</b></label>
									<td>
										<input class="form-control input-sm" type="text" placeholder="Enter Username" name="user" autofocus required></input>
								<tr>
									<td>
										<label class="form-control input-sm text-primary"><b>Password</b></label>
									<td>
										<input class="form-control input-sm" type="password" placeholder="Enter Password" name="pass" required></input>
										<tr>
									<td colspan="2">
										<button class="btn btn-success btn-block">Login</button>
										<tr>
									<td colspan="2">
										<button class="btn btn-warning btn-block" onclick="forgotpass()">Forgot Password?</button>
							</tbody>
						</table>
						
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

</html>