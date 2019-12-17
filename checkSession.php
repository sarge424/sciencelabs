<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
if(!isset($_SESSION['user']) || !isset($_SESSION['level'])){
	echo '<script>alert("Invalid Credentials");document.location.href = "/sciencelabs/";</script>';
}