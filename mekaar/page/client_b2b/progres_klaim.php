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
							<a href="#" title="">Progres Klaim </a>
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
				
				<!--=== Page Content ===-->
                <div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h3>Progres Klaim</h3>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<a href="./?p=list_klaim&id=<?=$id?>" class="btn btn-xs btn-primary"><i class="icon-back"></i>Kembali</a>
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content no-padding">
								<table class="table table-striped table-bordered table-hover table-checkable table-responsive datatable">
									<thead>
										<tr>
											<th class="checkbox-column">
												<input type="checkbox" class="uniform">
											</th>
											<th>Perusahaan</th>
											<th>Jumlah Kewajiban</th>
											<th>Status</th>
											<th>Pembayaran ke Rekening</th>
											<th>ID Pembayaran</th>
										</tr>
									</thead>
									<tbody>
										<?php
											foreach($data as $row){
										?>
											<tr>
												<td class="checkbox-column">
													<input type="checkbox" class="uniform">
												</td>
												<td><?=$row['ENTITY_NAMA']?></td>
												<td class="money text-right"><?=$row['NILAI']?></td>
												<td>
												<?php if($row['KEWAJIBAN_STATUS']==0){?>
                                                    <span class="d-inline-block label label-warning">Belum Membayar</span>
                                                <?php }elseif($row['KEWAJIBAN_STATUS']==1){ ?>
                                                    <span class="d-inline-block label label-success">Sudah Membayar</span>
                                                <?php } ?>
												<?php if($row['is_from_reas']==1){?>
                                                    <span class="d-inline-block label label-default">Kewajiban dari Re Asuransi</span>
												<?php } ?>
												</td>
												<td><?=$row['NO_REKENING'].' '.$row['BANK_REKENING'].' a.n '.$row['NAMA_REKENING']?></td>
												<td><?=$row['PAYMENT_SYSTEM_ID']?></td>
											</tr>
										<?php }?>
									</tbody>
								</table>
                            </div>
						</div>
					</div>
				</div>
			<?php include "footer.php";?>
			</div>

		</div>
	</div>
	