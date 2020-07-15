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
                        <li class="current">
							<a href="#" title="">Detail Transaksi</a>
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
				<script>
					$(document).ready(function(){
						$('.saldo').each(function(){$(this).text(formatMoney(formatNumber($(this).text()),2,',','.'));});
					})
    		   	</script>
				<style>.saldo,.right{text-align:right}</style>
				<!--=== Page Content ===-->
				<div class="row">
					<div class="col-md-12">
						<div class="widget box" >
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Detail Transaksi <?=($transaksi['TRX_PR_TYPE'] == 'PY' ? 'Payment' : 'Receiving') . ' ' . $transaksi['TRX_PR_DATE']?></h4>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<!--a href="./?p=peserta&a=upload" class="btn btn-xs" style="background:#7800fc;color:#fff"><i class="icon-upload"></i>Unggah Data</!--a>
										<a-- href="./?p=peserta&a=tambah" class="btn btn-xs btn-primary"><i class="icon-plus"></i>Tambah</a-->
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div id ="ganti" class="widget-content no-padding" >
<?php
$sql = 'SELECT a.PROD_ID,SUSA_NAMA,TRX_KTP_ID,TRX_NAMA,TRX_TGL_LAHIR' .
    ',TRX_ALAMAT,a.SUSA_ID,CABANG_ID,CURR_ID,TRX_PLAFOND' .
    ',TRX_PENCAIRAN,TRX_TGL_CAIR,TRX_JML_MINGG,TRX_START_PRO,TRX_END_PRO' .
    ',TRX_NILAI_UK,TRX_PREMI,LOKASI_NAMA,TRX_STATUS,a.ID_KEY,daerah3.zonasi,premi.rate ' .
    ' FROM tr0001 a ' .
    ' LEFT JOIN ma1003 ON CABANG_ID=LOKASI_ID ' .
    ' LEFT JOIN ma9002 b ON a.SUSA_ID=b.SUSA_ID ' .
    ' LEFT JOIN ma2001 c ON a.PROD_ID=c.PROD_ID ' .
    ' LEFT JOIN daerah3 ON kode_wilayah_bps=LOKASI_KELURAHAN ' .
    ' LEFT JOIN premi ON daerah3.zonasi=premi.zona ' .
    ' WHERE TRX_PAYMENT_ID="' . $transaksi['TRX_PR_ID'] . '" ' .
    ' GROUP BY a.ID_KEY';
$hasil2 = mysqli_query($conection, $sql);
$total = mysqli_num_rows($hasil2);
$aktif = mysqli_fetch_all($hasil2);
//$totalPremi = array_product(array_map(function ($x) {return $x['TRX_PLAFOND'];}, $aktif));
?>
							<center><h3 class='agileinfo_sign'>Policy No: <?=$transaksi['NOPOLICY']?></h3>
								<font size=3 color=blue>
									<table border=0 >
										<tr>
											<td>Peserta dari </td>
											<td width="10%">:</td>
											<td class="right"><?=$transaksi['ENTITY_NAMA']?></td>
										</tr>
										<tr>
											<td>Total Peserta</td>
											<td width="10%">:</td>
											<td class="right"><?=$total?></td>
										</tr>
										<tr>
											<td>Total Premium </td>
											<td>:</td>
											<td class="saldo"><?=$transaksi['TRX_PR_VALUE']?></td>
										</tr>
										<tr>
											<td>Menerima</td>
											<td>:</td>
											<td class="saldo">
<?php if (!is_null($transaksi['ENTITY_PR_VALUE'])) {
    echo $transaksi['ENTITY_PR_VALUE'];
}
?>
											</td>
										</tr>
									</table>
								</font>
								</center>
								<table id="tabel" class="table table-striped table-bordered table-hover table-checkable table-responsive datatable">
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
											<th data-hide="always">PENCAIRAN ID</th>
											<th data-hide="phone,tablet">PLAFOND</th>
											<th data-hide="phone,tablet">PREMI</th>
											<th >STATUS</th>
											<th >NILAI UK</th>
											<th data-class="expand">Detail</th>
											<th data-hide="always">JUMLAH MINGGU</th>
											<th data-hide="always">PERIODE</th>
										</tr>
									</thead>
									<tbody>
                                        <?php
foreach ($aktif as $row) {
    ?>
                                                <tr>
                                                    <td class="checkbox-column">
                                                        <input type="checkbox" class="uniform">
                                                    </td>
                                                    <td><?=$row[1]?></td>
                                                    <td><?=$row[2]?></td>
                                                    <td><?=$row[3]?></td>
                                                    <td><?=$row[4]?></td>
                                                    <td><?=$row[5]?></td>
                                                    <td><?=$row[17]?></td>
                                                    <td><?=$row[10]?></td>
                                                    <td class="saldo"><?=$row[9]?></td>
                                                    <td class="saldo"><?=$row[16]?></td>

													<?php if ($row[18] == 0) {?>
                                                        <td><span class="label label-primary">New</span></td>
                                                    <?php } elseif ($row[18] == 1) {?>
                                                        <td><span class="label label-warning">Paid</span></td>
                                                    <?php } elseif ($row[18] == 2) {?>
                                                        <td><span class="label label-success">Overdue</span></td>
                                                    <?php } elseif ($row[18] == 3) {?>
                                                        <td><span class="label label-default">Received</span></td>
                                                    <?php }?>
                                                    <td class="saldo"><?=$row[15]?></td>
												    <td>&nbsp;</td>
                                                    <td><?=$row[12]?></td>
                                                    <td><?=$row[13] . ' s.d ' . $row[14]?></td>
                                                </tr>
                                            <?php }?>
									</tbody>
								</table>
                            </div>
                        </div>
					</div>
				</div>
				<?php include "footer.php";?>

				<!-- /Page Content -->
			</div>
		</div>
	</div>