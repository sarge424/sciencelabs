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
if ($lev == 0) {
	$level = 'Admin ';
} else if ($lev == 1) {
	$level = 'Lab Master ';
} else {
	$level = 'Teacher ';
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

<nav class="navbar sticky-top navbar-expand-md navbar-dark bg-<?php echo $lab; ?>">

	<div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item">
				<a class="nav-link" href="/sciencelabs/home">Home</a>
			<li class="nav-item">
				<a class="nav-link" href="/sciencelabs/stock">Stock</a>
			<li class="nav-item">
				<a class="nav-link" href="/sciencelabs/requests">Requests</a>
				<?php
				if ($_SESSION['level'] != 2)
					echo '<li class="nav-item">
					<a class="nav-link" href="/sciencelabs/checkout/">Checkout</a>';
				?>
				<?php
				if ($_SESSION['level'] != 2)
					echo '<li class="nav-item">
						<a class="nav-link" href="/sciencelabs/transactions/">Transactions</a>';
				?>
			<li class="nav-item">
				<a class="nav-link" href="/sciencelabs/bookings/">Bookings</a>
				<?php
				if ($_SESSION['level'] != 2) {
					echo '<li class="nav-item">
					<a class="nav-link" href="../recon/">Reconciliation</a>';
				}
				?>
				<?php
				if ($_SESSION['level'] == 0)
					echo '<li class="nav-item">
					<a class="nav-link" href="../dataentry/">Data Entry</a>';
				?>
		</ul>
	</div>

	<div class="mx-auto order-0">
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
	</div>

	<div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
		<ul class="navbar-nav ml-auto">
			<span class="navbar-text text-white">
				<?php echo $level . $uname; ?>
			</span>
			<?php
			if ($_SESSION['level'] != 2) {
				echo '<li class="nav-item"><a class="nav-link" href="/sciencelabs/labtransactions">Lab Transfers</a>';
			}
			?>
			<?php
			if ($_SESSION['level'] != 2) {
				echo '<li class="nav-item"><a class="nav-link" href="../reviewrequest/">Review Pending Orders</a>';
			}
			?>
			<li class="nav-item dropdown ml-auto">
				<a class="nav-link dropdown-toggle navbar-text text-white" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-gear fa-spin" style="font-size:20px"></i> </a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
					<a class="dropdown-item" href="../user/changepass.php">Change Password</a>
					<a class="dropdown-item" href="../">Logout</a>
				</div>
			</li>
		</ul>
	</div>
</nav>

<script>
	function setActive(pagename) {
		var buttons = document.getElementsByClassName('nav-link');
		Array.prototype.forEach.call(buttons, function foreach(item, index) {
			if (item.innerHTML === pagename) {
				item.classList.add('active');
				//item.classList.add('bg-light');
				//item.classList.add('text-<?php echo $lab; ?>');
			}
		});
	}
</script>