<body>
	<!-- Header -->
	<header class="header navbar navbar-fixed-top" role="banner">
        <?php include 'header_v2.php';?>
	</header> <!-- /.header -->

	<div id="container">
		<div id="sidebar" class="sidebar-fixed">
			<div id="sidebar-content">

				<!-- Logo -->
                <div class="navbar-brand">
                    <a href="index.php">
                        <!-- <img src="<?=getUrlServer()?>/assets/img/logo.png" alt="logo" /> -->
                        <img src="<?=getUrlServer()?>/assets/img/logo_biru.png" alt="logo" />
                        <span style="line-height: 50px;vertical-align: bottom;">BIRU </span>
                        <!-- <span style="font-size:10px;line-height: 40px;vertical-align: bottom;">(Client B2B)</span> -->
                    </a>
                </div>
                <!-- /logo -->
				<!--=== Navigation ===-->

                <?php include 'navi3.php';?>

				<!-- /Navigation -->
				<div class="sidebar-title">
                    <span>
						<i class="icon-bell-alt"></i>
                        Notifications 
                        <span class="badge badge-danger"></span>
                    </span>
				</div>
				<ul class="notifications demo-slide-in"> <!-- .demo-slide-in is just for demonstration purposes. You can remove this. -->
					<?php include "notification.php";?>
				</ul>

				<div class="sidebar-widget align-center">
					<div class="btn-group" data-toggle="buttons" id="theme-switcher">
						<label class="btn active">
							<input type="radio" name="theme-switcher" data-theme="bright"><i class="icon-sun"></i> Bright
						</label>
						<label class="btn">
							<input type="radio" name="theme-switcher" data-theme="dark"><i class="icon-moon"></i> Dark
						</label>
					</div>
				</div>

			</div>
			<div id="divider" class="resizeable"></div>
		</div>
		<!-- /Sidebar -->

		<div id="content">
			<div class="container">
				<!-- Breadcrumbs line -->
				<div class="crumbs">
					<ul id="breadcrumbs" class="breadcrumb">
						<li>
							<i class="icon-home"></i>
							<a href="index.php">Dasbor</a>
						</li>
                        <li>
                            <a href="#" title="">Produk <?=$produk[0]['PROD_NAMA']?></a>
                        </li>
                        <li class="current">
							<a href="#" title="">Settlement</a>
						</li>
					</ul>

					<ul class="crumb-buttons">
						<!-- <li><a href="charts.html" title=""><i class="icon-signal"></i><span>Statistics</span></a></li> -->
						<?php include "crumb.php"; ?>
						<!-- <li class="range"><a href="#">
							<i class="icon-calendar"></i>
							<span></span>
							<i class="icon-angle-down"></i>
						</a></li> -->
					</ul>
				</div>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">

				</div>
				<!-- /Page Header -->
<?php
$perintah = ' SELECT a.TRX_UUID,a.PROD_ID,b.SUSA_NAMA,TRX_KTP_ID,TRX_NAMA,TRX_TGL_LAHIR' .
    ',TRX_ALAMAT,a.SUSA_ID,a.CABANG_ID,CURR_ID,TRX_PLAFOND' .
    ',TRX_PENCAIRAN,TRX_TGL_CAIR,TRX_JML_MINGG,TRX_START_PRO,TRX_END_PRO' .
    ',TRX_NILAI_UK,TRX_PREMI,LOKASI_NAMA,TRX_STATUS,a.ID_KEY,daerah3.zonasi,premi.rate ' .
	' FROM tr0001 a ';
if(empty($_SESSION['user_cabang_key'])){
	$perintah .= ' LEFT JOIN ma1003 d ON a.CABANG_ID=d.LOKASI_ID AND a.PROD_ID=d.PROD_ID';
}else{
	$perintah .= ' JOIN ma1003 d ON a.CABANG_ID=d.LOKASI_ID AND a.PROD_ID=d.PROD_ID AND d.ID_KEY='.$_SESSION['user_cabang_key'];
}
$perintah .= ' LEFT JOIN ma9002 b ON a.SUSA_ID=b.SUSA_ID AND a.PROD_ID=d.PROD_ID ' .
    ' LEFT JOIN ma2001 c ON a.PROD_ID=c.PROD_ID ' .
    ' LEFT JOIN daerah3 ON kode_wilayah_bps=LOKASI_KELURAHAN ' .
	' LEFT JOIN premi ON daerah3.zonasi=premi.zona ' .
	
	' WHERE a.PROD_ID = "' . $produk[0]['PROD_ID'] . '" AND TRX_STATUS=0 '.

	// ' AND a.ENTITY_ID="' . $_SESSION['user_cli_group'] . '"' .

	' GROUP BY a.ID_KEY';
	// echo $perintah;
$hasil2 = mysqli_query($conection, $perintah);
$settlement = mysqli_fetch_all($hasil2, MYSQLI_ASSOC);
?>
				<!--=== Page Content ===-->
				<div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h3> Daftar Peserta Produk <?=$produk[0]['PROD_NAMA']?></h3>
								<div class="toolbar no-padding">
									<div class="btn-group">
									<?php if(has_permission_like('input_data_cabang_mekaar')){?>
										<button id="bayarTerpilih" class="btn btn-xs" disabled><i class="icon-check"></i>Bayar data terpilih</button>
									<?php }?>
									<?php if(has_permission_like('input_data_cabang_mekaar')){?>
										<button id="hapusTerpilih" class="btn btn-xs" disabled><i class="icon-remove"></i>Hapus data terpilih</button>
										<a href="./?p=peserta&a=upload&id=<?=$produk[0]['PROD_ID']?>" class="btn btn-xs" style="background:#7800fc;color:#fff"><i class="icon-upload"></i>Unggah Data</a>
										<a href="./?p=peserta&a=tambah&id=<?=$produk[0]['PROD_ID']?>" class="btn btn-xs btn-primary"><i class="icon-plus"></i>Tambah</a>
									<?php }?>
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div id ="ganti" class="widget-content no-padding">
								<table id="tabelTrans" data-money="9 10 12" class="table table-responsive display table-checkable table-striped table-bordered table-hover  ">
									<thead>
										<tr>
											<th class="checkbox-column">
												<input type="checkbox" class="uniform">
											</th>
											<th data-hide="always">SEKTOR USAHA</th>
											<th >KTP</th>
											<th data-hide="phone,tablet">NAMA</th>
											<th data-hide="always">TANGGAL LAHIR</th>
											<th data-hide="always">ALAMAT</th>
											<th >CABANG</th>
											<!-- th>Zona </!-->
											<!-- th>Zona Rate</!-->
											<th data-hide="always">PENCAIRAN ID</th>
											<th data-hide="always">TANGGAL CAIR</th>
											<th data-hide="phone,tablet">PLAFOND</th>
											<!-- th>IDR to BRU</!-->
											<th data-hide="phone,tablet">PREMI</th>
											<th >STATUS</th>
											<th >NILAI UK</th>
											<th data-class="expand">Detail</th>
											<th data-hide="always">JUMLAH MINGGU</th>
											<th data-hide="always">PERIODE</th>
					<?php if(has_permission_like('input_data_cabang_mekaar')){?>
											<th data-hide="always">Aksi</th>
					<?php }?>
										</tr>
									</thead>
									<tbody>
                                        <?php foreach ($settlement as $row) {?>
                                                <tr>
                                                    <td class="checkbox-column">
                                                        <input type="checkbox" class="uniform" value="<?=$row['TRX_UUID']?>">
                                                    </td>
                                                    <td><?=$row['SUSA_NAMA']?></td>
					<?php if(has_permission_like('input_data_cabang_mekaar')){?>
                                                    <td><a href="./?p=peserta&a=ubah&id=<?=$_GET['id']?>&kode=<?=$row['ID_KEY']?>" ><i class="icon-edit"></i><?=$row['TRX_KTP_ID']?></a></td>
					<?php }else{ ?>
													<td><?=$row['TRX_KTP_ID']?></td>
					<?php }?>
                                                    <td><?=$row['TRX_NAMA']?></td>
                                                    <td><?=$row['TRX_TGL_LAHIR']?></td>
                                                    <td><?=$row['TRX_ALAMAT']?></td>
													<td><?=$row['LOKASI_NAMA']?></td>
													<!-- td class="zona"><?=$row['zonasi']?></!-->
													<!-- td class="rate"><?=$row['rate']?></!-->

                                                    <td><?=$row['TRX_PENCAIRAN']?></td>
                                                    <td><?=$row['TRX_TGL_CAIR']?></td>
                                                    <td class="plafond"><?=$row['TRX_PLAFOND']?></td>
                                                    <!-- td><?=round($row['TRX_PLAFOND'] / $_SESSION['bru_to_idr'], 6)?></!-->
													<td class="premiobj"><?=$row['TRX_PREMI']//($row[22] / 100) * $row[9] * $row[21]?></td>

													<?php if (is_null($row['TRX_STATUS'])) {?>
                                                        <td>NULL</td>
													<?php } else if ($row['TRX_STATUS'] == 0) {?>
                                                        <td><span class="label label-primary">New</span></td>
                                                    <?php } elseif ($row['TRX_STATUS'] == 1) {?>
                                                        <td><span class="label label-warning">Paid</span></td>
                                                    <?php } elseif ($row['TRX_STATUS'] == 2) {?>
                                                        <td><span class="label label-success">Overdue</span></td>
                                                    <?php } elseif ($row['TRX_STATUS'] == 3) {?>
                                                        <td><span class="label label-default">Received</span></td>
                                                    <?php }?>
                                                    <td class="uk"><?=$row['TRX_NILAI_UK']?></td>
												    <td>&nbsp;</td>
                                                    <td><?=$row['TRX_JML_MINGG']?></td>
                                                    <td><?=$row['TRX_START_PRO'] . ' s.d ' . $row['TRX_END_PRO']?></td>
					<?php if(has_permission_like('input_data_cabang_mekaar')){?>
												    <td><a href="#" class="hapus" onclick="hapus('<?=$row['ID_KEY']?>')" ><i class="icon-remove"></i>Hapus</a></td>
					<?php }?>
                                                </tr>
                                            <?php }?>
									</tbody>
								</table>
					<!-- <?php if(has_permission_like('input_data_cabang_mekaar')){?>
                        <form id="form" class="form-inline">
							<div class="input-group col-12">
								<label for="premi" class="label">Premi</label>
								<input type="text" class="form-control" >
							</div>
						</form>
					<?php }?> -->
                            </div>
                        </div>
					</div>
					<?php if(has_permission_like('input_data_cabang_mekaar')){?>
					<style>.pembayaran td,.persen,.komisi,.resiko,.diterima,.resikoNilai,.komisiNilai,.plafond,.premiobj,.uk{text-align:right}</style>
					<div class="col-md-12 pembayaran">
						<div class="widget box">
							<div class="widget-header">
								<h3> Pembayaran <span class="terpilih" class="label label-primary">0</span> Peserta Terpilih</h3>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content">
								<center style="margin:20px 0">
								<img src='<?=getUrlServer()?>/assets/img/pay.svg'>
								<h3 class='agileinfo_sign'>Policy No: -</h3>
								<table border=0 >
									<tr>
										<td>Peserta Terpilih</td>
										<td>:</td>
										<td class="terpilih">0</td>
									</tr>
									<tr >
										<td>Amount Premium</td>
										<td>:</td>
										<td id="amount<?=strtolower($produk[0]['PROD_CURR'])?>">0</td>
									</tr>
								</table>
								<button type="button" class="m-4 btn btn-primary" id="bayarx">Konfirmasi</button>
								</center>
							</div>
						</div>
					</div>
					<?php }?>
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h3> Pihak Terlibat dalam Produk <?=$produk[0]['PROD_NAMA']?></h3>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div id ="ganti2" class="widget-content no-padding">
								<table id="tabelMain" data-persen="4" style="border-bottom:#ddd solid 1px" class="table table-striped table-bordered table-hover table-checkable table-responsive tabelMain">
									<thead>
										<tr>
											<th class="checkbox-column">
												<input type="checkbox" class="uniform">
											</th>
											<th>Main Produk</th>
                                            <th data-hide="phone,tablet">Main Produk CURR</th>
											<th data-class="expand">Sub Produk</th>
											<th data-hide="phone,tablet">Premi (%)</th>
											<th >Status</th>
											<th >Rules</th>
										</tr>
									</thead>
									<tbody>
                                        <?php
$subprodukid = array();

$perintah = ' SELECT a.PROD_ID,a.PROD_NAMA,a.PROD_LEGAL,a.PROD_STATUS, ' .
    ' COUNT(d.SHA_ENTITY) ENTITY,a.PROD_PREMI,' .
    ' b.PROD_NAMA AS PARENT_NAMA,b.PROD_CURR as PARENT_CURR ' .
    ' FROM ma2001 a ' .
    ' LEFT JOIN ma2003 d ON a.PROD_ID=d.PROD_ID ' .
    ' LEFT JOIN ma2001 b ON a.PROD_ID_PARENT=b.PROD_ID ' .
    ' WHERE a.PROD_ID_PARENT = "' . $produk[0]['PROD_ID'] . '" AND a.PROD_LEVEL=1 ' .
    ' GROUP BY a.PROD_ID ';
$hasil2 = mysqli_query($conection, $perintah);
while ($row = mysqli_fetch_array($hasil2)) {
    $subprodukid[] = $row['PROD_ID'];
    ?>
                                                <tr>
                                                    <td class="checkbox-column">
                                                        <input type="checkbox" class="uniform">
                                                    </td>
													<td><?=$row['PARENT_NAMA']?></td>
													<td><?=$row['PARENT_CURR']?></td>
													<td><?=$row['PROD_NAMA']?></td>
													<td class="persen"><?=$row['PROD_PREMI']?></td>
                                                    <?php if ($row['PROD_STATUS'] == 0) {?>
                                                        <td><span class="label label-primary">Active</span></td>
                                                    <?php } elseif ($row['PROD_STATUS'] == 1) {?>
                                                        <td><span class="label label-danger">Suspended/Test</span></td>
                                                    <?php } elseif ($row['PROD_STATUS'] == 2) {?>
                                                        <td><span class="label label-default">Closed/Discontinue</span></td>
													<?php }?>
													<td><?=$row['ENTITY']?></td>
                                                </tr>
<?php }?>
									</tbody>
								</table>
								<h5 style="margin:5px">Keterangan : PPN rate = 10,00000 % <span style="margin:10px">&nbsp;</span>PPH 23 rate = 2,00000 %</h5>
								<?php
//ambil nama perusahaan
$sql = 'SELECT ENTITY_ID,ENTITY_NAMA FROM ma1001';
$query = mysqli_query($conection, $sql);
$entity = array();
while($row = mysqli_fetch_array($query)){
	$entity[$row['ENTITY_ID']] = $row['ENTITY_NAMA'];
}
$SHA_SYSTEM_ID = array();
//KOMISI untuk FORM
$data = array();

//hitung jumlah risk yg bisa ditambahkan supaya total tidak melebihi 100
$sql = 'SELECT (a.SHA_SYSTEM_ID) SHA_SYSTEM_ID_TAKE,a.SHA_RISK '.
',a.PROD_ID,c.PROD_NAMA,a.SHA_ENTITY,b.KOMISI_NUM,a.SHA_STATUS '.
',b.SHA_SYSTEM_ID_GIVE,b.KOMISI_TAX,b.KOMISI_WITH '.
' FROM ma2003 a '.
' LEFT JOIN ma2004 b ON b.SHA_SYSTEM_ID_TAKE = a.SHA_SYSTEM_ID '.
' LEFT JOIN ma2001 c ON a.PROD_ID = c.PROD_ID '.
' WHERE (a.PROD_ID IN ("' . implode('","', $subprodukid) . '") AND (a.SHA_STATUS=0))'.
' GROUP By a.PROD_ID,a.SHA_SYSTEM_ID,SHA_SYSTEM_ID_GIVE';
$query = mysqli_query($conection, $sql);
while($row = mysqli_fetch_array($query)){
	if(!array_key_exists($row['PROD_ID'],$data)){
		$data[$row['PROD_ID']] = array('nama'=> $row['PROD_NAMA'], 
			'obj' => array('KOMISI_NUM'=>0
				,'KOMISI'=>array(),'KOMISI2'=>array(),'RESIKO'=>array()
				,'MENERIMA_KOMISI'=>array(),'MEMBERI_KOMISI'=>array()));
		$SHA_SYSTEM_ID[$row['PROD_ID']] = array();
	}
	//jika id baru hitung total num dan gabung group level
	if(!array_key_exists($row['SHA_SYSTEM_ID_TAKE'],$SHA_SYSTEM_ID)){
		$SHA_SYSTEM_ID[$row['PROD_ID']][$row['SHA_SYSTEM_ID_TAKE']] = $row['SHA_ENTITY'];
		$data[$row['PROD_ID']]['obj']['SHA_ENTITY_NAMA'][$row['SHA_ENTITY']] = $entity[$row['SHA_ENTITY']];
		$data[$row['PROD_ID']]['obj']['KOMISI_NUM'] += $row['KOMISI_NUM'];
		$data[$row['PROD_ID']]['obj']['RESIKO'][$row['SHA_ENTITY']] = $row['SHA_RISK'];
	}
	//jika ada row komisi
	if(!is_null($row['SHA_SYSTEM_ID_GIVE'])){
		//menerima komisi
		if( ! array_key_exists($row['SHA_SYSTEM_ID_TAKE'],$data[$row['PROD_ID']]['obj']['KOMISI'])){
			$data[$row['PROD_ID']]['obj']['KOMISI'][$row['SHA_SYSTEM_ID_TAKE']] = array();
		}
		$data[$row['PROD_ID']]['obj']['KOMISI'][$row['SHA_SYSTEM_ID_TAKE']][] = array(
			'SHA_SYSTEM_ID_GIVE' => $row['SHA_SYSTEM_ID_GIVE'],
			'KOMISI_NUM' => $row['KOMISI_NUM'],
			'KOMISI_TAX' => $row['KOMISI_TAX'],
			'KOMISI_WITH' => $row['KOMISI_WITH'],
		);
		//memberi komisi
		if( ! array_key_exists($row['SHA_SYSTEM_ID_GIVE'],$data[$row['PROD_ID']]['obj']['KOMISI2'])){
			$data[$row['PROD_ID']]['obj']['KOMISI2'][$row['SHA_SYSTEM_ID_GIVE']] = array();
		}
		$data[$row['PROD_ID']]['obj']['KOMISI2'][$row['SHA_SYSTEM_ID_GIVE']][] = array(
			'SHA_SYSTEM_ID_TAKE' => $row['SHA_SYSTEM_ID_TAKE'],
			'KOMISI_NUM' => $row['KOMISI_NUM'],
			'KOMISI_TAX' => $row['KOMISI_TAX'],
			'KOMISI_WITH' => $row['KOMISI_WITH'],
		);
		//total menerima komisi
		if( ! array_key_exists($row['SHA_SYSTEM_ID_TAKE'], $data[$row['PROD_ID']]['obj']['MENERIMA_KOMISI'])){
			$data[$row['PROD_ID']]['obj']['MENERIMA_KOMISI'][$row['SHA_SYSTEM_ID_TAKE']] = 0;
		}
		$data[$row['PROD_ID']]['obj']['MENERIMA_KOMISI'][$row['SHA_SYSTEM_ID_TAKE']] += $row['KOMISI_NUM'];
		//total memberi komisi
		if( ! array_key_exists($row['SHA_SYSTEM_ID_GIVE'],$data[$row['PROD_ID']]['obj']['MEMBERI_KOMISI'])){
			$data[$row['PROD_ID']]['obj']['MEMBERI_KOMISI'][$row['SHA_SYSTEM_ID_GIVE']] = 0;
		}
		$data[$row['PROD_ID']]['obj']['MEMBERI_KOMISI'][$row['SHA_SYSTEM_ID_GIVE']] += $row['KOMISI_NUM'];
	}
}
//start sub prod
foreach($data as $prod_id => $arr){
	$prod_nama = $arr['nama'];
?>
								<table data-persen="3 4 5" data-tabel="7 8" style="border:#ddd solid 1px" class="table table-striped table-bordered table-hover table-checkable table-responsive tabelSub">
									<thead>
										<tr>
											<th class="checkbox-column">
												<input type="checkbox" class="uniform">
											</th>
											<th>Sub Produk</th>
											<th data-class="expand">Partner</th>
											<th>Resiko (%)</th>
											<th>Menerima Komisi (%)</th>
											<th>Memberi Komisi (%)</th>
											<th>Diterima</th>
											<th data-hide="always" style="display:none">Menerima Komisi</th>
											<th data-hide="always" style="display:none">Memberi Komisi</th>
											<th data-class="expand">Detail</th>
											<!-- th>Status</!-->
										</tr>
									</thead>
									<tbody>
<?php 
foreach($SHA_SYSTEM_ID[$prod_id] as $system_id=>$e_id){
	$obj2=$arr['obj'];
?>
										<tr class="PROD_<?=$prod_id?> ID_<?=$e_id?>" <?='' //$id_tertanggung?>>
											<td class="checkbox-column"><input type="checkbox" class="uniform"></td>
											<td><?=$prod_nama?></td>
											<td><?=$obj2['SHA_ENTITY_NAMA'][$e_id]?></td>
											<td class="text-right"><?=$obj2['RESIKO'][$e_id]?></td>
											
											<td class="text-right"><?=isset($obj2['MENERIMA_KOMISI'][$system_id])?$obj2['MENERIMA_KOMISI'][$system_id]:0 ?></td>
											<td class="text-right"><?=isset($obj2['MEMBERI_KOMISI'][$system_id])?$obj2['MEMBERI_KOMISI'][$system_id]:0 ?></td>
											<td class="diterima"></td>
											
											<td style="display:none">
												<?php 
												$d = '<table style="margin-bottom:10px!important"><tr><td>Komisi (%)</td><td>Penanggung</td><td>PPn</td><td>PPh 23</td></tr>';
												if(isset($obj2['KOMISI'][$system_id])){
													foreach($obj2['KOMISI'][$system_id] as $index=>$row) {
														$d .= '<tr>'.
															'<td class="text-right">'.formatMoney($row['KOMISI_NUM'],6,'.',',').'</td>'.
															'<td>'.$entity[$SHA_SYSTEM_ID[$prod_id][$row['SHA_SYSTEM_ID_GIVE']]].'</td>'.
															'<td>'.($row['KOMISI_TAX'] == 'y' ? 'Yes' : 'No').'</td>'.
															'<td>'.($row['KOMISI_WITH'] == 'y' ? 'Yes' : 'No').'</td>'.
															'</tr>';
													}
												}
												echo $d = htmlspecialchars($d . '</table>');
												?>
											</td>
											<td style="display:none">
												<?php 
												$d = '<table style="margin-bottom:10px!important"><tr><td>Komisi (%)</td><td>Penerima</td><td>PPn</td><td>PPh 23</td></tr>';
												if(isset($obj2['KOMISI2'][$system_id])){
													foreach($obj2['KOMISI2'][$system_id] as $index=>$row) {
														$d .= '<tr>'.
															'<td class="text-right">'.formatMoney($row['KOMISI_NUM'],6,'.',',').'</td>'.
															'<td>'.$entity[$SHA_SYSTEM_ID[$prod_id][$row['SHA_SYSTEM_ID_TAKE']]].'</td>'.
															'<td>'.($row['KOMISI_TAX'] == 'y' ? 'Yes' : 'No').'</td>'.
															'<td>'.($row['KOMISI_WITH'] == 'y' ? 'Yes' : 'No').'</td>'.
															'</tr>';
													}
												}
												echo $d = htmlspecialchars($d . '</table>');
												?>
											</td>
											<td>&nbsp;</td>


											<!-- ?php if ($row[5] == 0) { //active?>
												<td><span class="label label-success">Active</span></td>
											< ?php } elseif ($row[5] == 1) { //suspended?>
												<td><span class="label label-warning">Suspended</span></td>
											< ?php }?-->
										</tr>
<?php
	}
?>
									</tbody>
								</table>
<?php
	}//end sub prod
?>

							</div>
                        </div>
					</div>
				</div>
				<?php include "footer.php";?>

				<!-- /Page Content -->
			</div>
		</div>
	</div>
	<script>
		var obj;
		var plafond=0,premi=0,saldo=0;
		var attrA=[];
		$(document).ready(function(){
			function optionsInit(a){
				var self = a;
				var options = {'aoColumnDefs': []};
				if(self.attr('data-money') != undefined){
					options.aoColumnDefs.push({
						'render': function(data,type,row){;return formatMoney(parseFloat(data),2,',','.')}
								,'aTargets': self.attr('data-money').split(' ').map(Number)
					});
				}
				if(self.attr('data-persen') != undefined){
					options.aoColumnDefs.push({
						'render': function(data,type,row){return formatMoney(parseFloat(data),6,',','.')}
								,'aTargets': self.attr('data-persen').split(' ').map(Number)
					});
				}
				if(self.hasClass('tabelSub')){
					$.extend(true, options, {"info":false,"paging":false,"searching":false});
				}
				if(self.hasClass('tabelMain')){
					$.extend(true, options, {"info":false,"paging":false,"searching":false});
				}
				// Checkable Tables
				if (self.hasClass('table-checkable'))
				{
					//console.log('as');
					options.aoColumnDefs.push({
					 	'bSortable': false, 'aTargets': [0]
					});
					$.extend(true, options, {
						'order': [[1, 'desc']]
					});
				}
				// Responsive Tables
				if (self.hasClass('table-responsive'))
				{
					var responsiveHelper;
					var breakpointDefinition = {
						tablet: 1024,
						phone: 480
					};

					// Preserve old function from $.extend above
					// to extend a function
					var old_fnDrawCallback = $.fn.dataTable.defaults.fnDrawCallback;

					$.extend(true, options, {
						autoWidth: false,
						preDrawCallback: function ()
						{
							// Initialize the responsive datatables helper once.
							if (!responsiveHelper)
							{
								responsiveHelper = new ResponsiveDatatablesHelper(this, breakpointDefinition);
							}
						},
						rowCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull)
						{
							responsiveHelper.createExpandIcon(nRow);
						},
						drawCallback: function (oSettings)
						{
							if(self.attr('data-tabel') != undefined){
								oSettings.aoData.forEach(function(obj,index){
									let ds=[];
									let tds=[];
									console.log(obj);
									self.attr('data-tabel').split(' ').map(Number).forEach(function(val){
										ds.push(htmlDecode(obj._aData[val]));
										tds.push($('td', obj.nTr).eq(val));
									});
									tds.forEach(function(td,index){
										td.html(ds[index]);
									});
								})
							};
							// Extending function
							old_fnDrawCallback.apply(this, oSettings);

							responsiveHelper.respond();
						}
					});
				}
				$.extend(true, options, { "destroy": true, });
				if(self.hasClass('tabelSub')){
					$.extend(true, options, { "lengthMenu": [[-1], ["All"]] });
				}
				return options;
			}
			var tabelTrans=null;
			var tabelSub=tabelMain=[];
			var idTerpilih=[];
			tabelTrans = $('#tabelTrans')
				.DataTable(optionsInit($('#tabelTrans')));
			tabelMain = $('#tabelMain').DataTable(optionsInit($('#tabelMain')));
			$('.tabelSub').each(function(){
				tabelSub.push($(this).DataTable(optionsInit($(this))));
			});
			setTimeout(function(){
				$('.dataTables_wrapper:gt(1)').each(function(){
					$(this).find('.row').remove();
				});
			},1000);
				//console.log($(this));
			function cekTerpilih() {
				$(this).toggleClass('checked');
				//obj = ;
				if($(this).hasClass('checked')){
					$(this).find('input').prop('checked',true);
					$(this).find('span').addClass('checked');
				}else{
					$(this).find('input').prop('checked',false);
					$(this).find('span').removeClass('checked');
				}
				//$(this).find('input[type=checkbox]')
				//alert( tabelTrans.rows('.selected').data().length +' row(s) selected' );
				premi=0;
				idTerpilih=[];
				tabelTrans.rows('.checked').data().each(function(el,index){
					idTerpilih.push($(el[0]).find('input[type=checkbox]').val());
					premi += (parseFloat(el[10]));
				});
				//$(this).toggleClass('selected');
				if(idTerpilih.length>0){
					$('#hapusTerpilih').prop('disabled',false).css('background','#ff0000').css('color','#fff').html('<i class="icon-remove"></i>Hapus '+idTerpilih.length+' data terpilih')
					$('#bayarTerpilih').prop('disabled',false).css('background','#00c030').css('color','#fff').html('<i class="icon-check"></i>Bayar '+idTerpilih.length+' data terpilih')
				}else{
					$('#hapusTerpilih').prop('disabled',true).css('background','').css('color','').html('<i class="icon-remove"></i>Hapus 0 data terpilih')
					$('#bayarTerpilih').prop('disabled',true).css('background','').css('color','').html('<i class="icon-check"></i>Bayar 0 data terpilih')
				}
				<?php if(has_permission_like('input_data_cabang_mekaar')){?>
						$('.widget-content #tfdulu').remove();
						if(saldo < premi){
							//rumus jaga2
							//saldo < premi/bru_to_idr
							//premi-saldo*bru_to_idr
							if($('.widget-content #tfdulu').length==0){
								$('.widget-content').eq(1).prepend('<center style="color:blue;margin:5% 0;border-bottom:5px solid #eee;padding-bottom:5%" id="tfdulu"><h3>Silahkan Lakukan Tranfer ke </h3><h4><?=$produk[0]['DANA_IN_VA_NO']?> BANK <?=$produk[0]['DANA_IN_VA_BANK']?><br><?=$produk[0]['DANA_IN_VA_NAMA']?></h4><h3>Sejumlah Rp.'+formatMoney((premi-saldo),2,',','.')+'</h3></center>');
							}else{
								$('.widget-content').eq(1).prepend('<center style="color:blue;margin:5% 0;border-bottom:5px solid #eee;padding-bottom:5%" id="tfdulu"><h3>Silahkan Lakukan Tranfer ke </h3><h4><?=$produk[0]['DANA_IN_VA_NO']?> BANK <?=$produk[0]['DANA_IN_VA_BANK']?><br><?=$produk[0]['DANA_IN_VA_NAMA']?></h4><h3>Sejumlah Rp.'+formatMoney((premi-saldo),2,',','.')+'</h3></center>');
							}
						}
				<?php }?>
		
				$('.terpilih').text(idTerpilih.length);
				$('#amountidr').text(formatMoney(premi, 2, ".", ","));
				console.log(idTerpilih);
				hitungPesertaSetlement(idTerpilih);
			}
			$('#tabelTrans tbody').on('click', 'tr,input[type=checkbox]', cekTerpilih);
			$('#tabelTrans').on('click', 'input[type=checkbox]', function(){
				setTimeout(function(){
					cekTerpilih();
				},100);
			});
			/* $('.agileinfo_sign').text('Policy No: <?=sprintf("%'.04d", $_SESSION['user_key'])?>'+Date.now());
			*/
			//$('.persen').each((index,el) => el.innerHTML = formatMoney(el.innerHTML,5,".",",")+"%");
			saldo=$('#saldo<?=strtolower($produk[0]['PROD_CURR'])?>').text();
			$('#saldo<?=strtolower($produk[0]['PROD_CURR'])?>').text(formatMoney(saldo, 2, ".", ","));
			/*
			function checktok(){
            	var ajaxRequest;
				try{
					ajaxRequest = new XMLHttpRequest();
				} catch (e){
					try{
						ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
					} catch (e) {
						try{
							ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
						} catch (e){
							alert("Your browser broke!");
							return false;
						}
					}
				}

				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4){
						xxx = ajaxRequest.responseText;
						var obj = JSON.parse(xxx);
						var txh = obj.hasil;
						var dt1, dt2, blt;
						dt1 = txh/1000000000000000000;
						dt2=1000-dt1;
						blt= dt1.toFixed(6);
						saldo = dt1;
						document.getElementById("tokenbru").innerHTML = blt;
					}
				}
				ajaxRequest.open("GET", "http://207.148.116.70:8801/prize8?reqid="+"<?=$_SESSION['address']?>", true);
				ajaxRequest.send(null);
			}
			checktok();*/
			function hitungPesertaSetlement(_idTerpilih){
				try{
					ajaxRequest = new XMLHttpRequest();
				} catch (e){
					try{
						ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
					} catch (e) {
						try{
							ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
						} catch (e){
							alert("Your browser broke!");
							return false;
						}
					}
				}
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4){
						xxx = ajaxRequest.responseText;
						console.log('Log hitung setlement : ' + xxx);
						var JSONObject = JSON.parse(ajaxRequest.responseText);
						if(JSONObject[0] != false)
						{
							//alert(JSONObject.pesan);
							var arr=JSONObject.data;
							obj = JSONObject;
							console.log(JSONObject);
							//untuk setiap row tabelSub
							$('#ganti2 .tabelSub tbody tr').each(
								function(index,row){
									//cari data proses yg sama dengan row
									arr.some(function(hasil,index){
										let rowSekarang=$(row);
										if(rowSekarang.hasClass('PROD_'+hasil.prod)
										&& rowSekarang.hasClass('ID_'+hasil.entity) ){
											let td = rowSekarang.find('td');
											$(td[6]).text(formatMoney(hasil.diterima,2,',','.'));
											arr.splice(index,1);
											return true;
										}
									}
								);
							//	break;
							});
						}else{
							//alert(JSONObject.pesan);
						}
					}
				}
				ajaxRequest.open("POST", "./ambil_data.php", true);
				var formData = new FormData();
				formData.set("kode",JSON.stringify(_idTerpilih));
				formData.set("type","hitung_peserta_setlement");
				formData.set("prod","<?=$_GET['id']?>");
				ajaxRequest.send(formData);
            }
			$('#bayarTerpilih').on('click',function(){
				$('.widget:not(.widget:eq(1))').each(function(){
					if( ! $(this).hasClass('widget-closed')){
						//$(this).find('.widget-collapse').trigger('click');
						//setTimeout(function(){
							$.scrollTo($('.widget:eq(1)'),{duration:400,offset:{top:-64}});
						//},400);
					}
				})
			});
			$('#bayarx').on('click',function() {
				if(idTerpilih.length==0){
					alert('Tidak ada data terpilih');
					return;
				}
				var r = confirm("Apakah anda yakin akan membayar "+ idTerpilih.length +" data terpilih!");
				// var r = confirm("Apakah anda yakin akan membayar "+ idTerpilih.length +" data terpilih dan akan didebit dari saldo didompet anda!");
				if (r == true) {
					$('.widget-content:eq(1)').children().hide();
					$('.widget-content').eq(1).append("<center id='prosesgif'><img src='<?=getUrlServer()?>/assets/img/processing.gif' style='width:100px;height:100px;' ></center>");
					$('a').each(function(){
						let attr=$(this).hasClass('target');
						if(typeof attr !== typeof undefined && attr !== false){
						}else{
							attrA.push($(this));
							$(this).attr('target','_blank');
						}
					});
					bayarpremi(idTerpilih);
					return;
					/*
					if(saldo < premi/bru_to_idr){
						alert('Saldo didompet anda kurang jika untuk membayar '+terpilih+' data yang terpilih')
						return;
					}
					//bayar2x();
					let addrdr = "<?=$_SESSION['address']?>",
						addr = "0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45",
						bayar2 = (premi / bru_to_idr * 1000000000000000000),
						pvkey = "<?=$_SESSION['prkey']?>",
						pvkey1 = pvkey.substring(pvkey.length - 64, pvkey.length),
					 	ajaxRequest;
					try{
						ajaxRequest = new XMLHttpRequest();
					} catch (e){
						try{
							ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
						} catch (e) {
							try{
								ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
							} catch (e){
								alert("Your browser broke!");
								return false;
							}
						}
					}
					ajaxRequest.onreadystatechange = function(){
						if(ajaxRequest.readyState == 4){
							xxx = ajaxRequest.responseText;
							console.log('Log bayar : ' + xxx);
							var obj = JSON.parse(xxx);
							var txh = obj.err;
								txh2=""+txh+"";
							window.setTimeout(cek(txh2,addrdr,addr,premi), 1000);
						}
					}
					z1 = bayar2+"&addr="+addrdr+"&addrdr="+addr+"&pkey="+pvkey1;
					ajaxRequest.open("GET", "http://207.148.116.70:8801/prize?reqid="+z1, true);
					ajaxRequest.send(null);
					*/
				}
			});
			function bayarpremi(_idTerpilih){
				App.blockUI('.widget:not(.widget:eq(1))');
				try{
					ajaxRequest = new XMLHttpRequest();
				} catch (e){
					try{
						ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
					} catch (e) {
						try{
							ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
						} catch (e){
							alert("Your browser broke!");
							return false;
						}
					}
				}
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4){
						xxx = ajaxRequest.responseText;
						console.log('Log bayar premi : ' + xxx);
						var JSONObject = JSON.parse(ajaxRequest.responseText);
						alert(JSONObject.pesan);
						window.location = "./?p=peserta&a=settlement&id=<?=$_GET['id']?>";
						App.unblockUI('.widget:not(.widget:eq(1))');
					}
				}
				ajaxRequest.open("POST", "./bayar.php", true);
				var formData = new FormData();
				<?php $token = (empty($_SESSION['token'])) ? $_SESSION['token'] = bin2hex(random_bytes(32)) : $_SESSION['token'];?>
				formData.set("token","<?=$token?>");
				formData.set("kode",JSON.stringify(_idTerpilih));
				formData.set("prod","<?=$_GET['id']?>");
				formData.set("type","premi");
				ajaxRequest.send(formData);
			}
			function cek(txh2,addrdr,addr,premi){
                var ajaxRequest;
				try{
					ajaxRequest = new XMLHttpRequest();
				} catch (e){
					try{
						ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
					} catch (e) {
						try{
							ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
						} catch (e){
							alert("Your browser broke!");
							return false;
						}
					}
				}
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4){
						xxx = ajaxRequest.responseText;
						console.log('Log cek : ' + xxx);
       					if(xxx=='{}') {
							window.setTimeout(cek(txh2), 1000);
						}else{
							var obj = JSON.parse(xxx);
							var objn =  obj.salah.status;
							var x3 =  parseInt(obj.salah.status);
							x5 = x3;
							if(x5==1) {
								$('.widget-content').eq(1).append("<center>Pembayaran berhasil dan akan diproses ... <br> TxHash : "+"<a target='_blank' href='https://rinkeby.etherscan.io/tx/"+txh2+"'>"+txh2+"</a></center>");
								masukpol(premi, addr, addrdr, txh2);
							}else{
								console.log("TRANSACTION FAIL");
							}
							logging_result(obj);
                        }
		            }
				}
				ajaxRequest.open("GET", "http://207.148.116.70:8801/cek?reqid="+txh2, true);
				ajaxRequest.send(null);
			}
			function masukpol(premi, addr, addrdr, txh2){
				var ajaxRequest;
				try{
					ajaxRequest = new XMLHttpRequest();
				} catch (e){
					try{
						ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
					} catch (e) {
						try{
							ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
						} catch (e){
							alert("Your browser broke!");
							return false;
						}
					}
				}
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4){
						console.log('Log simpan trans : '+ajaxRequest.responseText);
						$('#ganti tbody tr').filter('.checked').each(function(index,el){
							$(this).remove();
						});
						attrA.forEach(function(){
							$(this).removeAttr('target');
						});
						App.unblockUI('.widget:not(.widget:eq(1))');
						$('#prosesgif').remove();

						var JSONObject = JSON.parse(ajaxRequest.responseText);
						if(JSONObject[0] != false)
						{
							alert(JSONObject.pesan);
						}else{
							alert(JSONObject.pesan);
						}
					}
				}
				ajaxRequest.open("POST", "./simpan.php", true);
                    

				var formData = new FormData();
				formData.set("harga_emas",bru_to_idr);
				formData.set("bru",(premi/bru_to_idr));
				formData.set("premi",premi);
				formData.set("addr",addr);
				formData.set("adddr",addrdr);
				formData.set("txh2",txh2);
				formData.set("kode",JSON.stringify(idTerpilih));
				formData.set("id","<?=$produk[0]['PROD_ID']?>");
				formData.set("type","peserta_bayar_terpilih");
				<?php $token = (empty($_SESSION['tokenBayar'])) ? $_SESSION['tokenBayar'] = bin2hex(random_bytes(32)) : $_SESSION['tokenBayar'];?>
				formData.set("token","<?=$token?>");

				ajaxRequest.send(formData);
			}
			function prosesHapusTerpilih(force=0){
				var ajaxRequest;
				try{
					ajaxRequest = new XMLHttpRequest();
				} catch (e){
					try{
						ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
					} catch (e) {
						try{
							ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
						} catch (e){
							alert("Your browser broke!");
							return false;
						}
					}
				}
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4){
						console.log(ajaxRequest.responseText);
						var JSONObject = JSON.parse(ajaxRequest.responseText);
						if(JSONObject[0] != false)
						{
							new Noty({
								text   : JSONObject.pesan,
								type   : 'alert',
								timeout: 5000
							}).show();
							window.location = "./?p=peserta&a=settlement&id=<?=$_GET['id']?>";
						}else{
							if(JSONObject.force != undefined){
								let ex=new Noty({
									text   : JSONObject.pesan,
									type   : 'error',
									closeWith: ['backdrop'],
									timeout: false,
									buttons: [
										Noty.button('Hapus', 'btn btn-success', function () {
											prosesHapusTerpilih(1);
										}, {id: 'button1', 'data-status': 'ok'}),
										Noty.button('Batal', 'btn btn-error', function () {
											ex.close();
										})
									]
								}).show()
							}else{
								new Noty({
										text   : JSONObject.pesan,
										type   : 'alert',
										timeout: 5000
									}).show();
							}
						}
					}
				}
				ajaxRequest.open("POST", "./simpan.php", true);
                    

				var formData = new FormData();
				formData.set("id","<?=$_GET['id']?>");
				formData.set("kode",JSON.stringify(idTerpilih));
				formData.set("force",force);
				formData.set("type","peserta_hapus_terpilih");
				<?php $token = (empty($_SESSION['token'])) ? $_SESSION['token'] = bin2hex(random_bytes(32)) : $_SESSION['token'];?>
				formData.set("token","<?=$token?>");

				ajaxRequest.send(formData);
				}
			$('#hapusTerpilih').on('click',function(){
				let ex=new Noty({
					text: "Hapus "+idTerpilih.length+" Data?",
					type: 'alert',
					layout: 'center',
					closeWith: ['backdrop','click'],
					modal: true,
					timeout: 10000,
					buttons: [
							Noty.button('Ya', 'btn btn-success', function () {
								prosesHapusTerpilih()
								ex.close();
							}, {id: 'button1', 'data-status': 'ok'}),
							Noty.button('Batal', 'btn btn-error', function () {
								ex.close();
							})
						]
				}).show()
			});
		});
		function hapus(id,force=0){
			let ex=new Noty({
				text: 'Apakah anda yakin ingin menghapus data ini?',
				type: 'alert',
				layout: 'center',
				closeWith: ['backdrop'],
				modal: true,
				timeout: 10000,
				buttons: [
						Noty.button('Ya', 'btn btn-success', function () {
							prosesHapus(id,force);
							ex.close();
						}, {id: 'button1', 'data-status': 'ok'}),
						Noty.button('Batal', 'btn btn-error', function () {
							ex.close();
						})
					]
			}).show()
		}
		function prosesHapus(id,force){
			var ajaxRequest;
			try{
					ajaxRequest = new XMLHttpRequest();
			} catch (e){
				try{
					ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						alert("Your browser broke!");
						return false;
					}
				}
			}
			ajaxRequest.onreadystatechange = function(){
				if(ajaxRequest.readyState == 4){
					console.log(ajaxRequest.responseText);
					var JSONObject = JSON.parse(ajaxRequest.responseText);
					if(JSONObject[0] != false)
					{
						new Noty({
								text   : JSONObject.pesan,
								type   : 'alert',
								timeout: 5000
							}).show();
						window.location = "./?p=peserta&a=settlement&id=<?=$_GET['id']?>";
					}else{
						if(JSONObject.force != undefined){
							let ex=new Noty({
								text   : JSONObject.pesan,
								type   : 'error',
								closeWith: ['backdrop'],
								timeout: false,
								buttons: [
									Noty.button('Hapus', 'btn btn-success', function () {
										prosesHapus(id,1);
									}, {id: 'button1', 'data-status': 'ok'}),
									Noty.button('Batal', 'btn btn-error', function () {
										ex.close();
									})
								]
							}).show()
						}else{
							new Noty({
									text   : JSONObject.pesan,
									type   : 'alert',
									timeout: 5000
								}).show();
						}
					}
				}
			}
			ajaxRequest.open("POST", "./simpan.php", true);
                    


			var formData = new FormData();
			formData.set("id","<?=$_GET['id']?>");
			formData.set("force",force);
			formData.set("kode",id);
			formData.set("type","peserta_hapus");
			<?php $token = (empty($_SESSION['token'])) ? $_SESSION['token'] = bin2hex(random_bytes(32)) : $_SESSION['token'];?>
			formData.set("token","<?=$token?>");

			ajaxRequest.send(formData);
		}

	</script>
