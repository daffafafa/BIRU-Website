<?php
if (!isset($_SESSION)) {
    session_start();
}
include "../../contact.php";
include "../../fungsi.php";
if (!isLoggedIn() || !isB2B()) {
    die(json_encode(array(false, 'pesan' => 'Unauthorized')));
}
switch (@$_GET["p"]) {
    case "peserta":
        switch (@$_GET["a"]) {
            case "aktif":
                //load vendor
                require '../vendor/autoload.php';
                if (!isset($_GET['id'])) {
                    die('Error 1, Produk tidak ditemukan');
                }
                $id = mysqli_escape_string($conection, trim($_GET['id']));
                $dt1 = date('Y-m-d', strtotime(mysqli_escape_string($conection, $_GET["awal"])));
                $dt2 = date('Y-m-d', strtotime(mysqli_escape_string($conection, $_GET["akhir"]) . " +1 day"));
                $perintah = 'SELECT a.PROD_ID,b.PROD_ID PROD_ID_CHILD,a.PROD_NAMA,a.PROD_STATUS,a.PROD_LEGAL' .
                    ',a.PROD_CURR FROM ma2001 a' .
                    ' LEFT JOIN ma2001 b ON b.PROD_ID_PARENT=a.PROD_ID' .
                    ' WHERE a.PROD_STATUS=0 AND (a.PROD_LEVEL=0 OR b.PROD_LEVEL=1) ' .
                    ' AND a.PROD_ID = "' . $id . '"' .
                    ' ORDER BY a.PROD_NAMA ASC';
                $query = mysqli_query($conection, $perintah);
                if (mysqli_num_rows($query) == 0) {
                    die('Error 2, Produk tidak ditemukan');
                }
                $produk = mysqli_fetch_array($query);
                switch($id){
                    case "PR002":
                        try {
                            $perintah = ' SELECT a.PROD_ID,SUSA_NAMA,TRX_KTP_ID,TRX_NAMA,a.CREATED_ON' .
                                ',TRX_ALAMAT,a.SUSA_ID,CABANG_ID,CURR_ID,TRX_PLAFOND' .
                                ',TRX_PENCAIRAN,TRX_TGL_CAIR,TRX_JML_MINGG,TRX_START_PRO,TRX_END_PRO' .
                                ',TRX_NILAI_UK,TRX_PREMI,LOKASI_NAMA,TRX_STATUS,a.ID_KEY ' .
                                ',a.TRX_TGL_LAHIR,d.PROD_ID PROD_PARENT,e.SHA_RISK';
                            $perintah .= ' FROM tr0001 a '.
                                ' JOIN ma9002 b ON a.SUSA_ID=b.SUSA_ID ';
                            if(empty($_SESSION['user_cabang_key'])){
                                $perintah .= ' LEFT JOIN ma1003 c ON a.CABANG_ID=c.LOKASI_ID AND a.PROD_ID=c.PROD_ID';
                            }else{
                                $perintah .= ' JOIN ma1003 c ON a.CABANG_ID=c.LOKASI_ID AND a.PROD_ID=c.PROD_ID AND c.ID_KEY='.$_SESSION['user_cabang_key'];
                            }
                            $perintah .= ' JOIN ma2001 d ON d.PROD_ID_PARENT=a.PROD_ID ' .
                                // left karena perusahaan ini belum tentu mendapat premi
                                ' LEFT JOIN ma2003 e ON d.PROD_ID=e.PROD_ID AND e.SHA_ENTITY="' . $_SESSION['user_cli_group'] . '" ' .
                                ' JOIN py0001_b2c f ON a.PAYMENT_SYSTEM_ID=f.PAYMENT_SYSTEM_ID '.
                                ' WHERE a.PROD_ID = "' . $produk['PROD_ID'] . '" AND TRX_STATUS=1 ' .
                                ' AND PAYMENT_DATE BETWEEN "' . $dt1 . '" AND "' . $dt2 . '" '.
                                ' GROUP BY a.TRX_UUID ';
                            $hasil2 = mysqli_query($conection, $perintah);
                            $rowTerdampak = mysqli_fetch_all($hasil2, MYSQLI_ASSOC);
        
                            //Load template
                            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('../unggah/templatePesertaAktif.xlsx');
                            \PhpOffice\PhpSpreadsheet\Shared\StringHelper::setDecimalSeparator('.');
                            \PhpOffice\PhpSpreadsheet\Shared\StringHelper::setThousandsSeparator(',');
                            $worksheet = $spreadsheet->getActiveSheet();
                            $indexRow = 9;
        
                            $dt1Arr = explode('-', $dt1);
                            $dt2Arr = explode('-', date('Y-m-d', strtotime(mysqli_escape_string($conection, $_GET["akhir"]))));
                            $periode = $dt1Arr[2] . ' ' . strtoupper(bulanindo($dt1Arr[1])) . ' ' . $dt1Arr[0] . '-';
                            $periode .= $dt2Arr[2] . ' ' . strtoupper(bulanindo($dt2Arr[1])) . ' ' . $dt2Arr[0];
                            $worksheet->getCell('AR5')->setValue($periode);
        
                            $worksheet->getCell('AR4')->setValue($produk['PROD_NAMA']);
                            foreach ($rowTerdampak as $no => $row) {
                                $worksheet->getCell('B' . $indexRow)->setValue($no + 1);
                                $worksheet->mergeCells('B' . $indexRow . ":" . 'C' . $indexRow);
                                $worksheet->getCell('D' . $indexRow)->setValue($row['CREATED_ON']);
                                $worksheet->mergeCells('D' . $indexRow . ":" . 'F' . $indexRow);
                                $worksheet->getCell('G' . $indexRow)->setValue($produk['PROD_NAMA']);
                                $worksheet->mergeCells('G' . $indexRow . ":" . 'L' . $indexRow);
                                $worksheet->getCell('M' . $indexRow)->setValue($row['LOKASI_NAMA']);
                                $worksheet->mergeCells('M' . $indexRow . ":" . 'T' . $indexRow);
                                $worksheet->getCell('U' . $indexRow)->setValue($row['TRX_KTP_ID']);
                                $worksheet->mergeCells('U' . $indexRow . ":" . 'AA' . $indexRow);
                                $worksheet->getCell('AB' . $indexRow)->setValue($row['TRX_NAMA']);
                                $worksheet->mergeCells('AB' . $indexRow . ":" . 'AN' . $indexRow);
                                $worksheet->getCell('AO' . $indexRow)->setValue($row['TRX_TGL_LAHIR']);
                                $worksheet->mergeCells('AO' . $indexRow . ":" . 'AS' . $indexRow);
                                $worksheet->getCell('AT' . $indexRow)->setValue($row['TRX_PENCAIRAN']);
                                $worksheet->mergeCells('AT' . $indexRow . ":" . 'AX' . $indexRow);
                                $worksheet->getCell('AY' . $indexRow)->setValue($row['TRX_TGL_CAIR']);
                                $worksheet->mergeCells('AY' . $indexRow . ":" . 'BC' . $indexRow);
                                $worksheet->getCell('BD' . $indexRow)->setValue($row['TRX_PLAFOND']);
                                $worksheet->mergeCells('BD' . $indexRow . ":" . 'BI' . $indexRow);
                                $worksheet->getCell('BJ' . $indexRow)->setValue($row['TRX_START_PRO']);
                                $worksheet->mergeCells('BJ' . $indexRow . ":" . 'BM' . $indexRow);
                                $worksheet->getCell('BN' . $indexRow)->setValue($row['TRX_END_PRO']);
                                $worksheet->mergeCells('BN' . $indexRow . ":" . 'BQ' . $indexRow);
                                $worksheet->getCell('BR' . $indexRow)->setValue($row['TRX_JML_MINGG']);
                                $worksheet->mergeCells('BR' . $indexRow . ":" . 'BS' . $indexRow);
                                $worksheet->getCell('BT' . $indexRow)->setValue($row['SUSA_NAMA']);
                                $worksheet->mergeCells('BT' . $indexRow . ":" . 'BX' . $indexRow);
                                $worksheet->getCell('BY' . $indexRow)->setValue($row['TRX_NILAI_UK']);
                                $worksheet->mergeCells('BY' . $indexRow . ":" . 'CC' . $indexRow);
                                $worksheet->getCell('CD' . $indexRow)->setValue($row['TRX_PREMI']);
                                $worksheet->mergeCells('CD' . $indexRow . ":" . 'CH' . $indexRow);
                                $worksheet->getCell('CI' . $indexRow)->setValue($row['SHA_RISK']);
                                $worksheet->mergeCells('CI' . $indexRow . ":" . 'CL' . $indexRow);
                                $worksheet->getCell('CM' . $indexRow)->setValue($row['TRX_PREMI'] * $row['SHA_RISK'] / 100);
                                $worksheet->mergeCells('CM' . $indexRow . ":" . 'CQ' . $indexRow);
                                $indexRow++;
                            }
                            $worksheet->getStyle('B' . $indexRow . ':CQ' . $indexRow)->getBorders()->applyFromArray(array(
                                'bottom' => array(
                                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                    'color' => array('rgb' => '000000'),
                                ),
                                'font' => array('bold' => true),
                            ));
                            $indexRow += 2;
                            $worksheet->getCell('BA' . $indexRow)->setValue('TOTAL');
                            $worksheet->getCell('BD' . $indexRow)->setValue('=SUM(BD9:BI' . ($indexRow - 2) . ')');
                            $worksheet->mergeCells('BD' . $indexRow . ":" . 'BI' . $indexRow);
                            $worksheet->getCell('CD' . $indexRow)->setValue('=SUM(CD9:CH' . ($indexRow - 2) . ')');
                            $worksheet->mergeCells('CD' . $indexRow . ":" . 'CH' . $indexRow);
                            $worksheet->getStyle('BA' . $indexRow . ':CH' . $indexRow)->applyFromArray(array(
                                'font' => array('bold' => true),
                            ));
                            // redirect output to client browser
                            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                            header('Content-Disposition: attachment;filename="Laporan Peserta Aktif ' . $produk['PROD_NAMA'] . ' (' . $periode . ').xlsx"');
                            header('Cache-Control: max-age=0');
                            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
                            $writer->setPreCalculateFormulas(false);
                            $writer->setOffice2003Compatibility(true);
                            $writer->save('php://output');
                            //Clearing a Workbook from memory
                            $spreadsheet->disconnectWorksheets();
                            unset($spreadsheet);
                        } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
                            die(json_encode(array(false, 'pesan' => 'Error : ' . $e->getMessage())));
                        } // end try catch
                        break;
                    case "PR123":
                        break;
                }
                break;
            case "terdampak":
                //load vendor
                require '../vendor/autoload.php';
                if (!isset($_GET['id'])) {
                    die('Error 1, Produk tidak ditemukan');
                }
                $id = mysqli_escape_string($conection, trim($_GET['id']));
                $dt1 = date('Y-m-d', strtotime(mysqli_escape_string($conection, $_GET["awal"])));
                $dt2 = date('Y-m-d', strtotime(mysqli_escape_string($conection, $_GET["akhir"]) . " +1 day"));
                $perintah = 'SELECT a.PROD_ID,b.PROD_ID PROD_ID_CHILD,a.PROD_NAMA,a.PROD_STATUS,a.PROD_LEGAL' .
                    ',a.PROD_CURR FROM ma2001 a' .
                    ' LEFT JOIN ma2001 b ON b.PROD_ID_PARENT=a.PROD_ID' .
                    ' WHERE a.PROD_STATUS=0 AND (a.PROD_LEVEL=0 OR b.PROD_LEVEL=1) ' .
                    ' AND a.PROD_ID = "' . $id . '"' .
                    ' ORDER BY a.PROD_NAMA ASC';
                $query = mysqli_query($conection, $perintah);
                if (mysqli_num_rows($query) == 0) {
                    die('Error 2, Produk tidak ditemukan');
                }
                $produk = mysqli_fetch_array($query);
                switch($id){
                    case "PR002":
                        try {
                            $perintah = ' SELECT f.waktu,f.skala,e.LOKASI_NAMA,d.TRX_NAMA,a.EQ_JARAK' .
                                ',d.TRX_PLAFOND,a.CLAIM_NILAI,(a.CLAIM_NILAI * c.SHA_RISK / 100) KEWAJIBAN,NULL' .
                                ',f.koor1 LINTANG1,f.koor2 BUJUR1,f.kedalaman,d.TRX_KTP_ID,e.lat LINTANG2,e.lng BUJUR2' .
                                ',a.EQ_RESIKO,c.SHA_RISK' .
                                ' FROM tr0002_b2c a ' .
                                ' JOIN ma2001 b ON a.SUB_PROD_ID=b.PROD_ID' .
                                ' LEFT JOIN ma2003 c ON b.PROD_ID=c.PROD_ID AND c.SHA_ENTITY="' . $_SESSION['user_cli_group'] . '" ' .
                                ' JOIN tr0001 d ON a.TRX_SYSTEM_ID=d.TRX_UUID' ;
                            if(empty($_SESSION['user_cabang_key'])){
                                $perintah .= ' LEFT JOIN ma1003 e ON d.CABANG_ID=e.LOKASI_ID AND d.PROD_ID=e.PROD_ID';
                            }else{
                                $perintah .= ' JOIN ma1003 e ON d.CABANG_ID=e.LOKASI_ID AND d.PROD_ID=e.PROD_ID AND e.ID_KEY='.$_SESSION['user_cabang_key'];
                            }
                            $perintah .= ' JOIN gempa2 f ON a.EQ_SYSTEM_ID=f.no ' .
                                ' WHERE b.PROD_ID_PARENT="' . $produk['PROD_ID'] . '" AND b.PROD_TYPE="dca eq" ' .
                                ' AND f.waktu BETWEEN "' . $dt1 . '" AND "' . $dt2 . '" ';
                            $hasil2 = mysqli_query($conection, $perintah);
                            $rowTerdampak = mysqli_fetch_all($hasil2, MYSQLI_ASSOC);

                            //Load template
                            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('../unggah/templatePesertaTerdampak.xlsx');
                            \PhpOffice\PhpSpreadsheet\Shared\StringHelper::setDecimalSeparator('.');
                            \PhpOffice\PhpSpreadsheet\Shared\StringHelper::setThousandsSeparator(',');
                            $worksheet = $spreadsheet->getActiveSheet();
                            $indexRow = 9;

                            $dt1Arr = explode('-', $dt1);
                            $dt2Arr = explode('-', date('Y-m-d', strtotime(mysqli_escape_string($conection, $_GET["akhir"]))));
                            $periode = $dt1Arr[2] . ' ' . strtoupper(bulanindo($dt1Arr[1])) . ' ' . $dt1Arr[0] . '-';
                            $periode .= $dt2Arr[2] . ' ' . strtoupper(bulanindo($dt2Arr[1])) . ' ' . $dt2Arr[0];
                            $worksheet->getCell('AN5')->setValue($periode);

                            $worksheet->getCell('AN4')->setValue($produk['PROD_NAMA']);
                            foreach ($rowTerdampak as $no => $row) {
                                $worksheet->getCell('B' . $indexRow)->setValue($no + 1);
                                $worksheet->mergeCells('B' . $indexRow . ":" . 'C' . $indexRow);
                                $worksheet->getCell('D' . $indexRow)->setValue($row['waktu']);
                                $worksheet->mergeCells('D' . $indexRow . ":" . 'I' . $indexRow);
                                $worksheet->getCell('J' . $indexRow)->setValue($row['LINTANG1']);
                                $worksheet->mergeCells('J' . $indexRow . ":" . 'L' . $indexRow);
                                $worksheet->getCell('M' . $indexRow)->setValue($row['BUJUR1']);
                                $worksheet->mergeCells('M' . $indexRow . ":" . 'O' . $indexRow);
                                $worksheet->getCell('P' . $indexRow)->setValue($row['skala']);
                                $worksheet->mergeCells('P' . $indexRow . ":" . 'R' . $indexRow);
                                $worksheet->getCell('S' . $indexRow)->setValue($row['kedalaman']);
                                $worksheet->mergeCells('S' . $indexRow . ":" . 'U' . $indexRow);
                                $worksheet->getCell('V' . $indexRow)->setValue($produk['PROD_NAMA']);
                                $worksheet->mergeCells('V' . $indexRow . ":" . 'Y' . $indexRow);
                                $worksheet->getCell('Z' . $indexRow)->setValue($row['LOKASI_NAMA']);
                                $worksheet->mergeCells('Z' . $indexRow . ":" . 'AD' . $indexRow);
                                $worksheet->getCell('AE' . $indexRow)->setValue($row['TRX_NAMA']);
                                $worksheet->mergeCells('AE' . $indexRow . ":" . 'AL' . $indexRow);
                                $worksheet->getCell('AM' . $indexRow)->setValue($row['LINTANG2']);
                                $worksheet->mergeCells('AM' . $indexRow . ":" . 'AO' . $indexRow);
                                $worksheet->getCell('AP' . $indexRow)->setValue($row['BUJUR2']);
                                $worksheet->mergeCells('AP' . $indexRow . ":" . 'AR' . $indexRow);
                                $worksheet->getCell('AS' . $indexRow)->setValue($row['EQ_JARAK']);
                                $worksheet->mergeCells('AS' . $indexRow . ":" . 'AU' . $indexRow);
                                $worksheet->getCell('AV' . $indexRow)->setValue($row['TRX_PLAFOND']);
                                $worksheet->mergeCells('AV' . $indexRow . ":" . 'AY' . $indexRow);
                                $worksheet->getCell('AZ' . $indexRow)->setValue($row['EQ_RESIKO']);
                                $worksheet->mergeCells('AZ' . $indexRow . ":" . 'BA' . $indexRow);
                                $worksheet->getCell('BB' . $indexRow)->setValue($row['CLAIM_NILAI']);
                                $worksheet->mergeCells('BB' . $indexRow . ":" . 'BE' . $indexRow);
                                $worksheet->getCell('BF' . $indexRow)->setValue($row['SHA_RISK']);
                                $worksheet->mergeCells('BF' . $indexRow . ":" . 'BI' . $indexRow);
                                $worksheet->getCell('BJ' . $indexRow)->setValue($row['KEWAJIBAN']);
                                $worksheet->mergeCells('BJ' . $indexRow . ":" . 'BM' . $indexRow);
                                $indexRow++;
                            }
                            $worksheet->getStyle('B' . $indexRow . ':BM' . $indexRow)->getBorders()->applyFromArray(array(
                                'bottom' => array(
                                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                    'color' => array('rgb' => '000000'),
                                ),
                                'font' => array('bold' => true),
                            ));
                            $indexRow += 2;
                            $worksheet->getCell('AT' . $indexRow)->setValue('TOTAL');
                            $worksheet->getCell('AV' . $indexRow)->setValue('=SUM(AV9:AV' . ($indexRow - 2) . ')');
                            $worksheet->mergeCells('AV' . $indexRow . ":" . 'AY' . $indexRow);
                            $worksheet->getCell('BB' . $indexRow)->setValue('=SUM(BB9:BB' . ($indexRow - 2) . ')');
                            $worksheet->mergeCells('BB' . $indexRow . ":" . 'BE' . $indexRow);
                            $worksheet->getCell('BJ' . $indexRow)->setValue('=SUM(BJ9:BJ' . ($indexRow - 2) . ')');
                            $worksheet->mergeCells('BJ' . $indexRow . ":" . 'BM' . $indexRow);
                            $worksheet->getStyle('AT' . $indexRow . ':BM' . $indexRow)->applyFromArray(array(
                                'font' => array('bold' => true),
                            ));
                            // redirect output to client browser
                            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                            header('Content-Disposition: attachment;filename="Laporan Peserta Terdampak Gempa ' . $produk['PROD_NAMA'] . ' (' . $periode . ').xlsx"');
                            header('Cache-Control: max-age=0');
                            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
                            $writer->setPreCalculateFormulas(false);
                            $writer->setOffice2003Compatibility(true);
                            $writer->save('php://output');
                            //Clearing a Workbook from memory
                            $spreadsheet->disconnectWorksheets();
                            unset($spreadsheet);
                        } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
                            die(json_encode(array(false, 'pesan' => 'Error : ' . $e->getMessage())));
                        } // end try catch
                        break;
                    case "PR123":
                        break;
                }
                break;
            default:
        }
        break;
    default:
}
