<?php
require_once '../db.php';
require_once '../checksession.php';
require_once '../PHPSpreadsheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Item Name');
$sheet->setCellValue('B1', 'Specifications');
$sheet->setCellValue('C1', 'Quantity');
$sheet->setCellValue('D1', 'Student');
$sheet->setCellValue('E1', 'Cost per Unit');
$sheet->setCellValue('F1', 'Amount');

$sheet->getStyle("A1:F1")->getFont()->setBold(true);

$sql = "select * from missing where comments not in ('Lost during reconciliation');";
$result = $conn->query($sql);

$row = "A";
$col = "2";

if ($result->num_rows != 0) {
    while ($info = $result->fetch_row()) {
        $sql = "select item_name, specs, price, lab from item where id=" . $info[1] . ";";
        $lab = $conn->query($sql)->fetch_assoc()['lab'];
        if ($lab == $_SESSION['lab']) {
            $item = $conn->query($sql)->fetch_assoc()['item_name'];
            $specs = $conn->query($sql)->fetch_assoc()['specs'];
            $unit_cost = $conn->query($sql)->fetch_assoc()['price'];

            $sheet->setCellValue($row . $col, $item);
            $row = chr(ord($row) + 1);
            $sheet->setCellValue($row . $col, $specs);
            $row = chr(ord($row) + 1);
            $sheet->setCellValue($row . $col, $info[2]);
            $row = chr(ord($row) + 1);
            $sheet->setCellValue($row . $col, substr($info[4], 8));
            $row = chr(ord($row) + 1);
            $sheet->setCellValue($row . $col, $unit_cost);
            $row = chr(ord($row) + 1);
            $sheet->setCellValue($row . $col, "=C" . $col . "*E" . $col);

            $row = "A";
            $col = (string) ((int) $col + 1);
        }
    }
}

$sheet->setCellValue("E" . $col, "Total Amount");
$sheet->getStyle("E" . $col)->getFont()->setBold(true);
$sheet->setCellValue("F" . $col, "=sum(F2:F" . ($col - 1) . ")");

foreach (range('A', 'E') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

$writer = new Xlsx($spreadsheet);
$writer->save("../excel/" . $_SESSION['labname'] . " Lost " . date("Y m d") . '.xlsx');
$conn->close();
