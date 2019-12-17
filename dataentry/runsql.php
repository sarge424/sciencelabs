<?php 
require_once '../db.php';
require_once '../checkSession.php';

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