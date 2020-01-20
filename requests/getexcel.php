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
		setActive('Download Excel');
	</script>

	<br>
	<br>

	<div class="container">
		<h2 class="text-center">Request Spreadsheets</h3>
		<table class="table table-hover">
			<thead class="thead thead-dark">
				<tr>
					<th>Filename (click to Download)</th>
				</tr>
			</thead>
			<tbody>
				<?php
				function startsWith($haystack, $needle) {
					$length = strlen($needle);
					return (substr($haystack, 0, $length) === $needle);
				}

				$path = '../excel';
				$files = array_diff(scandir($path), array('.', '..'));
				$files = array_reverse($files);

				if($_SESSION['level'] != 1){
					foreach ($files as $excel) {
						if(startsWith($excel, $_SESSION['labname'])) {
				?>

					<tr onclick="window.open('<?php echo $path . '/' . $excel ?>');">
						<td><i class="fa fa-cloud-download"></i><?php echo $excel; ?></td>
					</tr>

				<?php
						}
					}
				} else {
					foreach ($files as $excel) {
				?>

					<tr onclick="window.open('<?php echo $path . '/' . $excel ?>');">
						<td><i class="fa fa-cloud-download"></i><?php echo $excel; ?></td>
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