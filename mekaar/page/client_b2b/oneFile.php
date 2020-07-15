<?php
session_start();
if (isset($_GET) && isset($_GET['p']) && $_GET['p'] == 'download') {
    if (isset($_GET['a']) && $_GET['a'] == 'file_rejected') {
        if (isset($_GET['nmF'])) {
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="Rejected_' . $_GET['nmF'] . '"');
            header('Cache-Control: max-age=0');
            require '../vendor/autoload.php';
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('../unggah/' . $_SESSION['user_id'] . '/Rejected_' . $_GET['nmF']);
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $writer->setPreCalculateFormulas(false);
            $writer->setOffice2003Compatibility(true);
            $writer->save('php://output');
            unlink('../unggah/' . $_SESSION['user_id'] . '/Rejected_' . $_GET['nmF']);
        }
    }
}
