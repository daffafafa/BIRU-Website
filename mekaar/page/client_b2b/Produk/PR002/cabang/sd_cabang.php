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
                            <a href="#" title="">Pengaturan</a>
                        </li>
                        <li class="current">
							<a href="#" title="">Daftar Cabang</a>
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
								<h3>Daftar Cabang </h3>
								<div class="toolbar no-padding">
									<div class="btn-group">
									<?php if(has_permission('create_cabang_mekaar')){ ?>
										<a href="./?p=cabang&a=tambah&id=<?=$_GET['id']?>" class="btn btn-xs btn-primary"><i class="icon-plus"></i>Tambah</a>
									<?php }?>
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
											<th >LOKASI ID</th>
											<th >LOKASI NAMA</th>
											<th >STATUS</th>
											<th >KOORDINAT</th>
											<th data-hide="phone,tablet">LOKASI KELURAHAN</th>
											<th>Jumlah User</th>
											<th data-class="expand">Detail</th>
											<th data-hide="always">Aksi</th>
											<th data-hide="always">BANK Rekening</th>
											<th data-hide="always">No Rekening</th>
											<th data-hide="always">Nama Rekening</th>
											<th data-hide="always">LOKASI PROVINSI, KABUPATEN, KECAMATAN</th>
										</tr>
									</thead>
									<tbody>
                                        <?php
$perintah = ' SELECT e.ID_KEY,e.LOKASI_ID, d.nama PROVINSI,c.nama KABUPATEN,b.nama KECAMATAN' .
    ', a.nama KELURAHAN,e.LOKASI_NAMA,e.LOKASI_STATUS,e.lat,e.lng,a.zonasi,COUNT(f.CABANG_KEY) jum_user ' .
    ', e.BANK_REKENING, e.NAMA_REKENING, e.NO_REKENING ' .
    ' FROM ma1003 e ' .
    ' LEFT JOIN `daerah3` a ON a.kode_wilayah_bps=e.LOKASI_KELURAHAN ' .
    ' LEFT JOIN `daerah3` b ON b.kode_wilayah_bps=a.mst_kode_wilayah_bps ' .
    ' LEFT JOIN `daerah3` c ON c.kode_wilayah_bps=b.mst_kode_wilayah_bps ' .
	' LEFT JOIN `daerah3` d ON d.kode_wilayah_bps=c.mst_kode_wilayah_bps ' .
		' LEFT JOIN `ma0001` f ON e.ENTITY_ID=f.CLI_GROUP AND f.CABANG_KEY=e.ID_KEY '.
    ' WHERE e.ENTITY_ID="' . $_SESSION['user_cli_group'] . '" AND e.PROD_ID="'.$_GET['id'].'"'.
		' GROUP BY LOKASI_ID';
$hasil2 = mysqli_query($conection, $perintah);
while ($row = mysqli_fetch_array($hasil2)) {
    ?>
                                                <tr>
                                                    <td class="checkbox-column">
                                                        <input type="checkbox" class="uniform">
                                                    </td>
                                                    <td><?=$row['LOKASI_ID']?></td>
                                                    <td><a href="./?p=cabang&a=ubah&id=<?=$_GET['id']?>&id2=<?=$row['LOKASI_ID']?>"><i class="icon-edit"></i><?=$row['LOKASI_NAMA']?></a></td>

													<?php if (is_null($row['zonasi'])) {?>
														<td><span style="white-space:normal;display: inline-grid;" class="label label-danger">Zona Kelurahan Belum Diatur, Silakan hubungi admin biru</span></td>
													<?php } elseif ($row['LOKASI_STATUS'] == 0) { //active?>
                                                        <td><span class="label label-primary">Active</span></td>
                                                    <?php } elseif ($row['LOKASI_STATUS'] == 1) { //suspended?>
                                                        <td><span class="label label-danger">Suspended</span></td>
                                                    <?php } elseif ($row['LOKASI_STATUS'] == 2) { //closed?>
                                                        <td><span class="label label-default">Closed</span></td>
                                                    <?php }?>

                                                    <td><?=sprintf('%.7F', $row['lat']) . ', ' . sprintf('%.7F', $row['lng'])?></td>
                                                    <td><?=$row['KELURAHAN']?></td>
                                                    <td><?=$row['jum_user']?></td>
													<td>&nbsp;</td>
													<td class="text-right">
														<a href="./?p=user_cabang&id=<?=$_GET['id']?>&key=<?=$row['ID_KEY']?>" ><i class="icon-edit"></i>Lihat User Cabang</a>
														<a href="./?p=cabang&a=ubah&id=<?=$_GET['id']?>&id2=<?=$row['LOKASI_ID']?>" ><i class="icon-edit"></i>Ubah</a>
														<a href="#" class="hapus" onclick="hapus('<?=$row['LOKASI_ID']?>')" ><i class="icon-remove"></i>Hapus</a>
													</td>
													<td><?=$row['BANK_REKENING']?></td>
													<td><?=$row['NO_REKENING']?></td>
													<td><?=$row['NAMA_REKENING']?></td>
                                                    <td><?=$row['PROVINSI']?>, <?=$row['KABUPATEN']?>, <?=$row['KECAMATAN']?></td>
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
		function hapus(id){
			if(confirm("Hapus Data?")){
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
							alert(JSONObject.pesan);
							window.location = "./?p=cabang&id=<?=$_GET['id']?>";
						}else{
							alert(JSONObject.pesan);
						}
					}
				}
				ajaxRequest.open("POST", "./simpan.php", true);
                    


				var formData = new FormData();
				formData.set("kode",id);
				formData.set("type","cabang_hapus");
				formData.set("prod","<?=$_GET['id']?>");
				<?php
$token = (empty($_SESSION['token'])) ? $_SESSION['token'] = bin2hex(random_bytes(32)) : $_SESSION['token'];?>
				formData.set("token","<?=$token?>");

				ajaxRequest.send(formData);
			}
		}

	</script>

