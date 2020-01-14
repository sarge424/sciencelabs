<?php
require_once '../db.php';
require_once '../checksession.php';

$item_id = $_POST['itemid'];
$item_name = ucwords(strtolower($_POST['itemname']));
$item_stock = $_POST['itemstock'];
$item_loc = strtoupper($_POST['itemloc']);
$item_specs = $_POST['itemspecs'];
$item_price = $_POST['itemprice'];

$sql = 'UPDATE item' .
	' SET item_name="' . $item_name . '", quantity="' . $item_stock . '", lab_location="' . $item_loc . '", specs="' . $item_specs . '", price=' . $item_price .
	' where id=' . $item_id . ';';

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