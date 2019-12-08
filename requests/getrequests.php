<?php require_once '../db.php'; ?>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
global $conn;

$num = $_GET['num'];

$user = $_SESSION['user'];
$sql = "";
if ($num == 1) {
    $sql = "select * from purchase_request where teacher_id=" . $user . " and arrived=0 and lab='" . $_SESSION['lab'] . "';";
} else {
    $sql = "select * from purchase_request where arrived=0 and lab='" . $_SESSION['lab'] . "';";
}
$result = $conn->query($sql);

$var = 0;
if ($result != null) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $item = $row['item_name'];
            $specs = $row['specs'];
            $quantity = $row['quantity'];

            echo '
                    <tr>
                        <td id="item' . $var . '">' . $item . '
                        <td id="specs' . $var . '">' . $specs . '
                        <td id="quantity' . $var . '">' . $quantity . '
                        <td><div class="btn btn-warning btn-sm" id="edit' . $var . '" onclick="editRow(' . $var . ')">Edit</div>
                        <td><div class="btn btn-danger btn-sm" id="delete' . $var . '" onclick="deleteRow(' . $var . ')">Delete</div>';
            $var++;
        }
    }
} else {
    echo '
            <tr>
                <td colspan="3"><h4>No pending orders</h4>
        ';
}
