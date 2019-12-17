<?php 
require_once '../db.php';
require_once '../checkSession.php';

$item_id = $_POST['itemid'];
$item_name = ucwords(strtolower($_POST['itemname']));
$item_stock = $_POST['itemstock'];
$item_loc = $_POST['itemloc'];
$item_specs = $_POST['itemspecs'];

$sql = 'UPDATE item' .
	' SET item_name="' . $item_name . '", quantity="' . $item_stock . '", lab_location="' . $item_loc . '", specs="' . $item_specs . '"' .
	' WHERE id=' . $item_id . ';';

$conn->query($sql);

$conn->close();
?>
<html>

<body>
	<script>
		alert('The item \'<?php echo $item_name ?>\' was updated.');
		document.location.href = '../stock/';
	</script>
</body>

</html>