<?php
require 'config.php';
require 'PHPExcel/PHPExcel.php';

$condition = "where 1=1 ";
$condition .= !empty($_GET['first_name']) ? "and sus_name like '%{$_GET['first_name']}%' " : "";
$condition .= !empty($_GET['last_name']) ? "and sus_surename like '%{$_GET['last_name']}%' " : "";
$condition .= !empty($_GET['age']) ? "and sus_age like '%{$_GET['age']}%' " : "";
$condition .= !empty($_GET['place']) ? "and sus_addr_tumbol like '%{$_GET['place']}%' " : "";
$sql = "select * from tb_case22 ";
$sql = $sql . $condition;

$query = $connect->query($sql);

// set excel
$excel = new PHPExcel();

// set header excel
$excel->setActiveSheetIndex(0)
    ->setCellValue('a1', 'ลำดับ')
    ->setCellValue('b1', 'ชื่อ')
    ->setCellValue('c1', 'นามสกุล')
    ->setCellValue('d1', 'เพศ')
    ->setCellValue('e1', 'อายุ')
    ->setCellValue('f1', 'สถานที่');

// set data excel
$row = 2;
while ($result = $query->fetch_object()) {
    $excel->setActiveSheetIndex(0)
    ->setCellValue('a'.$row, ($row-1))
    ->setCellValue('b'.$row, $result->sus_name)
    ->setCellValue('c'.$row, $result->sus_surename)
    ->setCellValue('d'.$row, $result->sus_sex)
    ->setCellValue('e'.$row, $result->sus_age)
    ->setCellValue('f'.$row, $result->sus_addr_tumbol);
    $row++;
}

// set worksheet excel
$excel->getActiveSheet()->setTitle('Data');
$excel->setActiveSheetIndex(0);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="export_data.xlsx"');
header('Cache-Control: max-age=0');

// // set filename
// $filename = 'export_data';

// // save file excel
// $writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
// $objFile = $filename . '.xlsx';
// $writer->save($objFile);

$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$objWriter->save('php://output');
exit;