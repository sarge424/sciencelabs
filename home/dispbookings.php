<html>

<head>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</head>

<script>
	let count = 1;
	function cloneRow(item, quantity){
		let tbody = document.getElementById("tbody");
		let tr0 = document.getElementById("row0");
		let new_tr = tr0.cloneNode(true);
		
		new_tr.id = "tr"+count;
		
		
		count++;
	}
</script>

<body>
    <div class="container-fluid">
		<div class="row">
			<h3 id="teacher">Not Booked</h3>
		</div>
        <div class="row">
            <h3 id="experiment">No Exp</h3>
            <table class="table" id="items">
                <thead class="thead thead-dark">
                    <th>Item
                    <th>Quantity
                </thead>
                <tbody id="tbody">
                    <tr id="row0">
                        <td>No items booked</td>
						<td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</body>

<?php
require_once '../db.php';
require_once '../checksession.php';

$time = $_GET['time'];
$date = $_GET['date'];

$booking_id = "None";
$teacher_name = "None";
$exp_name = "None";
$quantity = 0;

$sql = 'select id, date_format(booked_date, "%Y %m %d") as booked_date, teacher_id from lab_booking where date_format(booked_date, "%Y %m %d")="' . $date . '" and booked_time="' . $time . '" and lab="' . $_SESSION['lab'] . '";';
$result = $conn->query($sql);
if($result->num_rows == 1){
	$row = $result->fetch_assoc();
    $booking_id = $row['id'];
    $teacher_id = $row['teacher_id'];

    $sql = "select teacher_name from teacher where id=" . $teacher_id . ";";
    $teacher_name = $conn->query($sql)->fetch_assoc()['teacher_name'];
?>

<script>
    document.getElementById('teacher').innerHTML = "<?php echo $teacher_name; ?>";
</script>

<?php
    $sql = "select exp_id, quantity from item_booking where labbooking_id=" . $booking_id . ";";
    $result = $conn->query($sql);
    if($result->num_rows == 1){
		$row = $result->fetch_assoc();
        $exp_id = $row['exp_id'];
        $quantity = $row['quantity'];
        $sql = "select item_id, quantity from experiment_item where exp_id=" . $exp_id . ";";
        $result = $conn->query($sql);
        while($item = $result->fetch_assoc()){
            $sql = "select item_name from item where id=" . $item['item_id'] . ";";
            $item_name = $conn->query($sql)->fetch_assoc()['item_name'];
			$quan = $quantity * $item['quantity'];
?>
	<script>
		cloneRow("<?php echo $item_name; ?>", <?php echo $quan; ?>);
	</script>
<?php
        }
        $sql = "select exp_name from experiment where id=" . $exp_id . ";";
        $exp_name = $conn->query($sql)->fetch_assoc()['exp_name'];
?>
    <script>
        document.getElementById("experiment").innerHTML = "<?php echo $exp_name; ?>";
    </script>
<?php
    }
}
?>

<html>