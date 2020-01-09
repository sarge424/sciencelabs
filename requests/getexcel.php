<?php
require_once '../db.php';
require_once '../checksession.php';
?>
<html>

<head>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<script src="../js/jquery-3.4.1.min.js"></script>
	<script src="../js/popper.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
</head>

<body>

	<?php include '../navbar.php'; ?>
	<script>
		setActive('Stock');
	</script>

	<br>
	<br>

	<div class="container">
		<h1 class="text-center">Request Spreadsheets</h1>
		<table class="table table-hover">
			<thead class="thead thead-dark">
				<tr>
					<th>Filename</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$path = '../excel';
				$files = array_diff(scandir($path), array('.', '..'));
				$files = array_reverse($files);

				foreach ($files as $excel) {
				?>

					<tr onclick="window.open('<?php echo $path . '/' . $excel ?>');">
						<td><?php echo 'Purchase Request: ' . $excel; ?></td>
					</tr>

				<?php
				}

				$conn->close();
				?>
		</table>
	</div>
</body>

</html>