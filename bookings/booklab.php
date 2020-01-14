<?php
require_once '../db.php';
require_once '../checksession.php';
?>

<script>
	function submit() {
		let date = document.getElementById('datepicker').value;
		let time = document.getElementsByName('time');
		let cls = document.getElementById('class').value;

		for (let x = 0; x < 4; x++) {
			if (time[x].checked) {
				time = time[x].value;
				break;
			}
		}

		let request;
		try {
			request = new XMLHttpRequest();
		} catch (e) {
			try {
				request = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				try {
					request = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {
					return false;
				}
			}
		}

		request.onreadystatechange = function() {
			if (request.readyState == 4) {
				alert(request.responseText);
				let check = request.responseText.split(" ");
				if(check[0] == "Lab"){
					document.location.reload();
				}
			}
		}

		let queryString = "?date=" + date + "&time=" + time + "&class=" + cls;
		request.open("GET", "submitbooking.php" + queryString, true);
		request.send(null);
	}
</script>
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
						<select class="custom-select input-sm" id="class" align="right" name="class" required>
							<?php
							$sql = 'select class_name from class;';
							$result = $conn->query($sql);
							while ($row = $result->fetch_assoc()) {
								echo '<option>' . $row['class_name'] . '</option>';
							}
							?>
						</select>
				<tr>
					<td colspan="2">
						<button class="btn btn-success btn-block" type="submit" onclick="submit()">Make Booking</button>
			</table>
		</div>
	</div>