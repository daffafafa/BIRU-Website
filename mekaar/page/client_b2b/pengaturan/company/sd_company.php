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
							<a href="#" title="">Perusahaan Management</a>
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
				<script>
					$(document).ready(function(){
						$('td').on('click','span.responsiveExpander',function(){
							let span=$(this).closest('tr').next().find('.addr');
							span.text('Loading...');
							$.ajax({
								url : "http://207.148.116.70:8801/prize8",
								type: "get",
								data: {reqid:span.data('addr')},
								dataType:"json",
								success:function(result){
									var txh = result.hasil;
									var dt1, dt2, blt;
									dt1 = txh/1000000000000000000;
									dt2=1000-dt1;
									blt= dt1.toFixed(6);
									span.text(blt);
								},error:function(xhr, Status, err) {
									span.text('Gagal mengambil data...');
								}
							})
						});
					});
				</script>
				<div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h3> Daftar Perusahaan</h3>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<a href="./?p=company&a=tambah" class="btn btn-xs btn-primary"><i class="icon-plus"></i>Tambah</a>
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
											<th >KODE</th>
											<th >NAMA</th>
											
											<th data-hide="always">Aksi</th>

											<th data-hide="always">ALAMAT</th>
											<th >PIC</th>
											<th >PIC PHONE</th>
											<th data-hide="phone,tablet">EMAIL</th>
											<th data-hide="always" data-name="TANGGAL JOIN">JOINT</th>
											<th data-hide="phone,tablet">EXPIRY</th>
											<th >STATUS</th>
											<th>Jumlah User</th>
											<th data-hide="always">MOU</th>
											<th data-hide="always">NPWP</th>
											<th data-class="expand">Detail</th>
										</tr>
									</thead>
									<tbody>
                                        <?php
$type = array('Direct Broker', 'Insurance', 'Re Broker', 'Re Insurance', 'Client B2B', '3rd Party', null => '<span class="label label-danger">Belum Diatur</span>');
$perintah = 'SELECT a.ENTITY_ID, a.ENTITY_NAMA, a.ENTITY_ALAMAT, a.ENTITY_PIC, a.ENTITY_PIC_PHONE, a.ENTITY_EMAIL, a.ENTITY_JOINT, a.ENTITY_EXPIRY, a.ENTITY_STATUS, a.ENTITY_MOU, a.ENTITY_NPWP, COUNT(b.CLI_USER_ID) jum '.
 ' FROM ma1001 a'.
 ' LEFT JOIN ma0001 b ON a.ENTITY_ID=b.CLI_GROUP '.
 ' GROUP BY a.ENTITY_ID'.
 ''
 ;

$hasil2 = mysqli_query($conection, $perintah);
while ($row = mysqli_fetch_array($hasil2)) {
    ?>
                                                <tr>
                                                    <td class="checkbox-column">
                                                        <input type="checkbox" class="uniform">
                                                    </td>
													<td>
														<?php if(has_permission('update_perusahaan')){?>
															<a href="./?p=company&a=ubah&kode=<?=$row['ENTITY_ID']?>" ><i class="icon-edit"></i><?=$row['ENTITY_ID']?></a>
														<?php }else{ ?>
															<?=$row['ENTITY_ID']?>
														<?php } ?>
													</td>
													<td><?=$row['ENTITY_NAMA']?></td>
													
													<td class="text-right">
														<a href="./?p=user_company&key=<?=$row['ENTITY_ID']?>" ><i class="icon-edit"></i>Lihat User Perusahaan</a>
														<?php if(has_permission('update_perusahaan')){?>
															<a href="./?p=company&a=ubah&kode=<?=$row['ENTITY_ID']?>" ><i class="icon-edit"></i>Ubah</a>
														<?php } ?>
														<?php if(has_permission('delete_perusahaan')){?>
															<a href="#" class="hapus" onclick="hapus('<?=$row['ENTITY_ID']?>')" ><i class="icon-remove"></i>Hapus</a>
														<?php } ?>
													</td>
													
													<td><?=$row['ENTITY_ALAMAT']?></td>
                                                    <td><?=$row['ENTITY_PIC']?></td>
                                                    <td><?=$row['ENTITY_PIC_PHONE']?></td>
                                                    <td><?=$row['ENTITY_EMAIL']?></td>
                                                    <td><?=$row['ENTITY_JOINT']?></td>
                                                    <td><?=$row['ENTITY_EXPIRY']?></td>

													<?php if ($row['ENTITY_STATUS'] == 0) { //active?>
                                                        <td><span class="label label-primary">Active</span></td>
                                                    <?php } elseif ($row['ENTITY_STATUS'] == 1) { //suspended?>
                                                        <td><span class="label label-danger">Suspended</span></td>
                                                    <?php } elseif ($row['ENTITY_STATUS'] == 2) { //closed?>
                                                        <td><span class="label label-default">Closed</span></td>
                                                    <?php }?>

												    <td><?=$row['jum']?></td>
												    <td><?=$row['ENTITY_MOU']?></td>
												    <td><?=$row['ENTITY_NPWP']?></td>
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
							window.location = "./?p=company";
						}else{
							alert(JSONObject.pesan);
						}
					}
				}
				ajaxRequest.open("POST", "./simpan.php", true);

				var formData = new FormData();
				formData.set("kode",id);
				formData.set("type","company_hapus");
				<?php
$token = (empty($_SESSION['token'])) ? $_SESSION['token'] = bin2hex(random_bytes(32)) : $_SESSION['token'];
?>
				formData.set("token","<?=$token?>");

				ajaxRequest.send(formData);
			}
		}

	</script>
