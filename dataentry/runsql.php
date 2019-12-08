<?php require_once '../db.php'; ?>
<?php
global $conn;

$sql = $_POST['sqlcode'];

$conn->query($sql);

$conn->close();
?>
<html>

<body>
	<script>
		document.location.href = '../dataentry/';
	</script>
</body>

</html>