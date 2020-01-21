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
$sheet->setCellValue('D1', 'Link');
$sheet->setCellValue('E1', 'Approx. Cost');
if ($_SESSION['level'] == 1) {
    $sheet->setCellValue('F1', 'Lab');
    $sheet->setCellValue('G1', 'Amount');
} else {
    $sheet->setCellValue('F1', 'Amount');
}

$sheet->getStyle("A1:F1")->getFont()->setBold(true);

if ($_SESSION['level'] == 1) {
    $sql = "select item_name, specs, quantity_ordered, link, cost, lab from purchase_request where arrived=0;";
} else {
    $sql = "select item_name, specs, quantity_ordered, link, cost from purchase_request where arrived=0 and lab='" . $_SESSION['lab'] . "';";
}

$result = $conn->query($sql);

$conn->close();

$row = "A";
$col = "2";

if ($result->num_rows != 0) {
    while ($info = $result->fetch_row()) {
        $sheet->setCellValue($row . $col, $info[0]);
        $row = chr(ord($row) + 1);
        $sheet->setCellValue($row . $col, $info[1]);
        $row = chr(ord($row) + 1);
        $sheet->setCellValue($row . $col, $info[2]);
        $row = chr(ord($row) + 1);
        $sheet->setCellValue($row . $col, $info[3]);
        $row = chr(ord($row) + 1);
        $sheet->setCellValue($row . $col, $info[4]);
        $row = chr(ord($row) + 1);
        if ($_SESSION['level'] == 1) {
            $sheet->setCellValue($row . $col, $info[5]);
            $row = chr(ord($row) + 1);
        }
        $sheet->setCellValue($row . $col, "=C" . $col . "*E" . $col);

        $row = "A";
        $col = (string) ((int) $col + 1);
    }
}

if ($_SESSION['level'] == 1) {
    $sheet->setCellValue("F" . $col, "Total Amount");
    $sheet->getStyle("F" . $col)->getFont()->setBold(true);
    $sheet->setCellValue("G" . $col, "=sum(G2:G" . ($col - 1) . ")");
} else {
    $sheet->setCellValue("E" . $col, "Total Amount");
    $sheet->getStyle("E" . $col)->getFont()->setBold(true);
    $sheet->setCellValue("F" . $col, "=sum(F2:F" . ($col - 1) . ")");
}

foreach (range('A', 'E') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

$writer = new Xlsx($spreadsheet);
$save_name;
if ($_SESSION['level'] == 1) {
    $save_name = "../excel/HOD Request " . date("Y m d") . '.xlsx';
} else {
    $save_name = "../excel/" . $_SESSION['labname'] . " Request " . date("Y m d") . '.xlsx';
}
$writer->save($save_name);
echo $save_name;
