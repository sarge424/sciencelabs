<?php
$file = $_GET['doc'];
rename("../reports/" . $file, "../approved-reports/" . $file);
header("Location: ../");
exit;
