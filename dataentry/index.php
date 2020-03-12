<html>

<head>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<script src="../js/jquery-3.4.1.min.js"></script>
	<script src="../js/popper.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
</head>

<body>
    <?php require "../navbar.php";?>

    <p>Click on the "Choose File" button to upload a CSV file:</p>

    <form action="/action_page.php">
        <input accept=".xlsx" type="file" id="myFile" name="filename">
        <input type="submit">
    </form>
</body>
</html>