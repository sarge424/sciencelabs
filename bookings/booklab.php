<?php
require_once '../db.php';
require_once '../checksession.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$date = $_REQUEST['date'];
	$time = $_REQUEST['time'];
	$lab = $_SESSION['lab'];
	$class = strtoupper($_REQUEST['class']);

	$month = (int) date("m");
	$user_month = (int) substr($date, 0, 2);
	$next_month = $month + 1;
	if ($next_month == 13) {
		$next_month = 1;
	}
	$user_date = (int) substr($date, 3, 5);

	if (($user_month == $month && $user_date >= (int) date("d")) || $user_month == $next_month) {
		$classes = array('8A', '8B', '9A', '9B', '10A', '10B', '11', '12', '13', '8a', '8b', '9a', '9b', '10a', '10b');
		$user = $_SESSION['user'];

		$var = 0;
		$flag = 0;
		while ($var < count($classes)) {
			if (strcmp($classes[$var], $class) == 0) {
				$flag = 1;
			}
			$var += 1;
		}

		if ($flag == 1) {
			$sql = "select date_format(booked_date, '%m/%d/%Y') as booked_date, booked_time, lab from lab_booking where date_format(booked_date, '%m/%d/%Y')='" . $date . "'and booked_time='" . $time . "';";

			$result = $conn->query($sql);

			if ($result->num_rows > 0) { } else {
				$sql = 'select id from teacher where teacher_name="' . $user . '"';
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						$user = $row['id'];
					}
				}

				$sql = 'select id from class where class_name="' . $class . '"';
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						$class = $row['id'];
					}
				}

				$date = date_create($date);
				$date = date_format($date, 'Y-m-d');

				$sql = "insert into lab_booking (booked_date, booked_time, teacher_id, class_id, lab) values ('" . $date . "', '" . $time . "', " . $user . ", " . $class . ", '" . $_SESSION['lab'] . "');";
				$conn->query($sql);
				echo '<script>alert("Lab successfully booked on ' . $date . ' between ' . $time . '");</script>';

				echo '<script>document.location.reload();</script>';
			}
		} else {
			echo '<script>alert("Class not found!");</script>';
		}
	} else {
		echo '<script>alert("Date or Month Not Valid!");</script>';
	}
}
?>
<div class="container-fluid">
	<br>
	<br>
	<div class="row">
		<div class="col-sm-12 text-center">
			<h3>Lab Booking</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12" align="center">
			<form action="<?php $_SERVER = ["PHP_SELF"] ?>" method="POST">
				<table class="table">
					<tr>
						<td>
							<label class="form-control input-sm text-primary" align="center" style="width:125px"><b>Select Date</b></label>
						<td>


							<div align="right">
								<input id="datepicker" width="276" name="date" required readonly>
								<script>
									$('#datepicker').datepicker({
										uiLibrary: 'bootstrap4'
									});
								</script>
							</div>
					<tr>
						<td>
							<label class="form-control input-sm text-primary" align="center" style="width:125px"><b>Select Time</b></label>
						<td>
							<div align="right">
								<div class="form-check">
									<label class="form-check-label">
										<input type="radio" class="form-check-input" name="time" value="09:35 - 10:55" checked>09:35 - 10:55
									</label>
								</div>
								<div class="form-check">
									<label class="form-check-label" for="radio2">
										<input type="radio" class="form-check-input" name="time" value="11:10 - 12:30">11:10 - 12:30
									</label>
								</div>
								<div class="form-check">
									<label class="form-check-label">
										<input type="radio" class="form-check-input" name="time" value="01:30 - 02:50">01:30 - 02:50
									</label>
								</div>
								<div class="form-check">
									<label class="form-check-label">
										<input type="radio" class="form-check-input" name="time" value="03:05 - 04:25">03:05 - 04:25
									</label>
								</div>
							</div>
					<tr>
						<td>
							<label class="form-control input-sm text-primary" align="center" style="width:125px"><b>Select Class</b></label>
						<td>
							<input class="form-control input-sm" align="right" name="class" placeholder="e.g. 8b, 10A, 12" required>
					<tr>
						<td colspan="2">
							<button class="btn btn-success btn-block" type="submit">Make Booking</button>
				</table>
			</form>
		</div>
	</div>