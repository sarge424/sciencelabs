<?php 
require_once '../db.php';
require_once '../checksession.php';

$item_name = ucwords(strtolower($_POST['itemname']));
$item_stock = 0;
$item_loc = $_POST['itemloc'];
$item_specs = $_POST['itemspecs'];

$sql = 'INSERT INTO item (item_name, quantity, lab_location, specs, lab) VALUES ("' . $item_name . '", ' . $item_stock . ', ' . $item_loc . ', "' . $item_specs . '", "' . $_SESSION['lab'] . '");';
$conn->query($sql);
echo '<script>alert("The item ' . $item_name . ' was succcessfully added.");</script>';

$conn->close();
?>
<html>

<body>
	<script>
		document.location.href = '../stock/';
	</script>
</body>

</html>