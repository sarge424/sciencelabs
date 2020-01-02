<?php require_once '../db.php'; ?>
<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
global $conn;

$uname = $_SESSION['user'];

$sql = 'select * from teacher where id = ' . $uname . ';';
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$uname = $row['teacher_name'];
}

$lev = $_SESSION['level'];
$level = "";
$icon = "";
if ($lev == 0) {
	$level = 'Admin ';
	$icon = '<i class="fa fa-hand-spock-o" aria-hidden="true"></i>';
} else if ($lev == 1) {
	$level = 'Lab Master ';
	$icon = '<i class="fa fa-graduation-cap" aria-hidden="true"></i>';
} else {
	$level = 'Teacher ';
	$icon = '<i class="fa fa-user" aria-hidden="true"></i>';
}

$lab = $_SESSION['lab'];
$img = '';
if ($lab == 'b') {
	$lab = 'success';
	$img = '<img src="../img/cells.svg" width="30" height="30">';
} else if ($lab == 'c') {
	$lab = 'danger';
	$img = '<img src="../img/flask.svg" width="30" height="30">';
} else {
	$lab = 'primary';
	$img = '<img src="../img/atom.svg" width="30" height="30">';
}
?>

<head>
	<link rel="icon" href="settings.svg" type="image/gif" sizes="16x16">
</head>

<script src="../js/popper.min.js"></script>
<link rel="stylesheet" href="../css/font-awesome.min.css">
<link rel="stylesheet" href="../nav.css">

<nav class="navbar sticky-top navbar-icon-top navbar-expand-lg navbar-dark bg-<?php echo $lab;?>">
 	<div class="collapse navbar-collapse" id="navbarSupportedContent">
	 	<li class="nav-item navbar-brand dropdown">
		 <div class="dropdown">
				<button class="btn btn-dark navbar-brand dropdown-toggle" style="background:rgba(41, 43, 44, 0.5);border:none;" type="button" data-toggle="dropdown"><?php echo $img . ' ' . $_SESSION['labname']; ?>Lab
					<span class="caret"></span></button>
				<ul class="dropdown-menu">
					<li><a class="dropdown-item" onclick="document.location.href='../changelab.php?labname=p';">
							<img src="../img/atom.svg" width="30" height="30"> Physics Lab
						</a></li>
					<li><a class="dropdown-item" onclick="document.location.href='../changelab.php?labname=c';">
							<img src="../img/flask.svg" width="30" height="30"> Chemistry Lab
						</a></li>
					<li><a class="dropdown-item" onclick="document.location.href='../changelab.php?labname=b';">
							<img src="../img/cells.svg" width="30" height="30"> Biology Lab
						</a></li>
				</ul>
			</div>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
				<span class="navbar-toggler-icon"></span>
			</button>
		</li>

		<ul class="navbar-nav mr-auto">
			<li class="nav-item active">
				<a class="nav-link" href="/sciencelabs/home">
				<i class="fa fa-home"></i>Home</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="/sciencelabs/stock">
				<i class="fa fa-bar-chart"></i>Stock</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="/sciencelabs/requests/">
				<i class="fa fa-comments"></i>Requests</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="/sciencelabs/checkout/">
				<i class="fa fa-shopping-cart"></i>Checkouts</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="/sciencelabs/transactions/">
				<i class="fa fa-shopping-basket"></i>Transactions</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="/sciencelabs/bookings/">
				<i class="fa fa-calendar-check-o"></i>Bookings</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="/sciencelabs/recon">
				<i class="fa fa-minus-square"></i>Reconciliation</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="/sciencelabs/dataentry">
				<i class="fa fa-database"></i>Data Entry</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="/sciencelabs/itembooking">
				<i class="fa fa-folder-open"></i>Item Booking</a>
			</li>
		</ul>

		<ul class="navbar-nav ">
		<li class="nav-item">
			<a class="nav-link" href="/sciencelabs/labtransactions">
			<i class="fa fa-exchange"></i>Lab Transfers</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="/sciencelabs/reviewrequest">
			<i class="fa fa-list-alt"></i>Pending Orders</a>
		</li>
		<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<?php echo $icon.$level.$uname?>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#"><i class="fa fa-key" aria-hidden="true"></i> Change Password</a>
          <a class="dropdown-item" href="#"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
        </div>
      </li>
		</ul>
  	</div>
</nav>

<script>
	function setActive(pagename) {
		var buttons = document.getElementsByClassName('nav-item');
		for(let x = 0; x<buttons.length; x++){
			if(buttons[x].classList.contains('active'))
				buttons[x].classList.toggle('active');
		}

		buttons = document.getElementsByClassName('nav-link');
		for(let x = 0; x<buttons.length; x++){
			let name = buttons[x].innerHTML.substring(buttons[x].innerHTML.indexOf('</i>') + 4);
			if(name===pagename)
				buttons[x].parentElement.classList.toggle('active');
		}
	}
</script>