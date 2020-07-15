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
							<a href="#" title="">Main Produk</a>
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

								<div class="page-header"></div>

				<!-- /Page Header -->

				<!--div-- class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" style="font-size:32px !important" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>Warning!</strong> Better check yourself, you're not looking too good.
				</!--div-->

				<!--=== Page Content ===-->
				<div class="row">
					<div class="col-md-12">
						<div class="widget box" id="mainWidget">
							<div class="widget-header">
								<h3>Daftar Main Produk</h3>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<?php if(has_permission('create_main_produk')){?>
											<a href="./?p=produk&a=tambah&type=main" class="btn btn-xs btn-primary"><i class="icon-plus"></i>Tambah MAIN Produk</a>
										<?php }?>
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div id ="ganti" class="widget-content">
								<table class="table table-striped table-bordered table-checkable table-hover table-responsive datatable">
									<thead>
										<tr>
											<th class="checkbox-column">
												<input type="checkbox" class="uniform">
											</th>
											<th>Produk</th>
											<th data-hide="always" >Sub Produk</th>
											<th data-hide="phone,tablet">Pertanggungan</th>
											<th data-hide="phone,tablet">PKS/MOU</th>
											<th data-hide="phone,tablet">CURR</th>
											<th >Status</th>
											<th data-hide="always">Front Linier Produk</th>
											<th data-hide="always">VA Dana Masuk</th>
											<th data-hide="always">Aksi</th>
											<th data-class="expand">Detail</th>
										</tr>
									</thead>
									<tbody>
                                        <?php
$perintah = ' SELECT a.PROD_ID,IF(a.PROD_B2C=1,CONCAT(a.PROD_NAMA," (B2C)"),a.PROD_NAMA) PROD_NAMA' .
    ',a.PROD_LEGAL,a.PROD_STATUS,a.PROD_MIN_TSI,a.PROD_MAX_TSI,a.PROD_B2C,a.PROD_CURR' .
	',IFNULL(GROUP_CONCAT(b.PROD_NAMA),"") JSUB ' .
	',a.DANA_IN_VA_NAMA,a.DANA_IN_VA_NO,a.DANA_IN_VA_BANK '.
    ' FROM ma2001 a ' .
    ' LEFT JOIN ma2001 b ON a.PROD_ID=b.PROD_ID_PARENT ' .
    ' WHERE a.PROD_LEVEL =0 ' .
    ' GROUP BY a.PROD_ID,b.PROD_ID_PARENT ';
$hasil2 = mysqli_query($conection, $perintah);
while ($row = mysqli_fetch_array($hasil2)) {
    ?>
                                                <tr>
													<td class="checkbox-column">
                                                        <input type="checkbox" class="uniform">
                                                    </td>
                                                    <td>
														<?php if(has_permission('update_main_produk')){?>
															<a href="./?p=produk&a=ubah&kode=<?=$row['PROD_ID']?>"><i class="icon-edit"></i><?=$row['PROD_NAMA']?></a>
														<?php }else{ ?>
															<?=$row['PROD_NAMA']?>
														<?php }?>
													</td>
													<td><?=str_replace(',','<br>',$row['JSUB'])?></td>
													<td><?=sprintf('%.2F', $row['PROD_MIN_TSI'])?> s.d <?=sprintf('%.2F', $row['PROD_MAX_TSI'])?></td>

													<td><?=$row['PROD_LEGAL']?></td>
                                                    <td><?=$row['PROD_CURR']?></td>

                                                    <?php if ($row['PROD_STATUS'] == 0) { //active?>
                                                        <td><span class="label label-primary">Active</span></td>
                                                    <?php } elseif ($row['PROD_STATUS'] == 1) { //suspended?>
                                                        <td><span class="label label-danger">Suspended/Test</span></td>
                                                    <?php } elseif ($row['PROD_STATUS'] == 2) { //closed?>
                                                        <td><span class="label label-default">Closed/Discontinue</span></td>
													<?php }?>
                                                    <td><?=$row['DANA_IN_VA_NAMA']?></td>
                                                    <td><?=$row['DANA_IN_VA_BANK'].' '.$row['DANA_IN_VA_NO']?></td>
													<td class="text-right">
														<?php if(has_permission('update_main_produk')){?>
															<a href="./?p=produk&a=ubah&kode=<?=$row['PROD_ID']?>" ><i class="icon-edit"></i>Ubah</<span>
														<?php }?>
														<?php if(has_permission('delete_main_produk')){?>
															<a href="#" class="hapus" onclick="hapus('<?=$row['PROD_ID']?>')" ><i class="icon-remove"></i>Hapus</a>
														<?php }?>
														<?php if(has_permission('access_sub_produk')){?>
															<a href="./?p=produk&type=sub&kode=<?=$row['PROD_ID']?>" class="submain" data-kode="<?=$row['PROD_ID']?>"><i class="icon-gear"></i>Lihat Sub Produk</a>
														<?php }?>
													</td>
													<td>&nbsp;</td>
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
							window.location = "./?p=produk";
						}else{
							alert(JSONObject.pesan);
						}
					}
				}
				ajaxRequest.open("POST", "./simpan.php", true);
                    

				

				var formData = new FormData();
				formData.set("kode",id);
				formData.set("type","produk_hapus");
				<?php
$token = (empty($_SESSION['token'])) ? $_SESSION['token'] = bin2hex(random_bytes(32)) : $_SESSION['token'];
?>
				formData.set("token","<?=$token?>");

				ajaxRequest.send(formData);
			}
		}

	</script>

