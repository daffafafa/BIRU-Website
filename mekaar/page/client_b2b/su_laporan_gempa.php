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
                            <a href="#" title="">Laporan Gempa >= 5 SR </a>
                        </li>
                        <li class="current">
							<a href="#" title="">Produk <?=$produk[0]['PROD_NAMA']?></a>
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

				<!--div-- class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" style="font-size:32px !important" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>Warning!</strong> Better check yourself, you're not looking too good.
				</!--div-->


				<!--=== Page Content ===-->
				<div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h3> Daftar Gempa Skala >= 5 SR, Produk <?=$produk[0]['PROD_NAMA']?></h4>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div id ="ganti" class="widget-content no-padding">
								<table class="table table-striped table-bordered table-hover table-checkable table-responsive datatable">
									<thead>
										<tr>
											<th class="checkbox-column">
												<input type="checkbox" class="uniform">
											</th>
											<th data-class="expand">Waktu</th>
											<th >Koordinat</th>
											<th >Skala</th>
											<th data-hide="phone,tablet">Kedalaman</th>
											<th data-hide="phone,tablet">Wilayah</th>
                                            <th >Status</th>
                                            <th >Peserta Terdampak</th>
										</tr>
									</thead>
									<tbody>
                                        <?php
$id = mysqli_escape_string($conection, trim($_GET['id']));
$perintah = ' SELECT a.`no`,a.koor1,a.koor2,a.eks,a.skala,a.wilayah,a.waktu,a.kedalaman,COUNT(b.EQ_SYSTEM_ID) jum '.
	' FROM gempa2 a '.
	' LEFT JOIN tr0002_b2c b ON a.`no`=b.EQ_SYSTEM_ID '.
	' LEFT JOIN ma2001 c ON b.SUB_PROD_ID=c.PROD_ID AND c.PROD_ID_PARENT = "' . $id . '" ' .
	' GROUP BY a.`no` '.
	' ORDER BY waktu DESC';
$hasil2 = mysqli_query($conection, $perintah);
while ($row = mysqli_fetch_array($hasil2)) {
    ?>
                                                <tr>
                                                    <td class="checkbox-column">
                                                        <input type="checkbox" class="uniform">
                                                    </td>
                                                    <td><?=$row['waktu']?></td>
                                                    <td><?=$row['koor1'] . ', ' . $row['koor2']?></td>
                                                    <td><?=$row['skala']?></td>
                                                    <td><?=$row['kedalaman']?></td>
                                                    <td><?=$row['wilayah']?></td>
                                                    <?php if ($row['eks'] == 1) {?>
                                                        <td><span class="label label-success">Sudah diproses</span></td>
                                                    <?php } elseif ($row['eks'] == 0) {?>
                                                        <td><span class="label label-warning">Belum diproses</span></td>
                                                    <?php }?>
                                                    <td><?=$row['jum']?></td>
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
	<script>
		

	</script>

