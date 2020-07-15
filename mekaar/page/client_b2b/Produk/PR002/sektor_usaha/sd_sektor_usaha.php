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
							<a href="#" title="">Sektor Usaha</a>
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
								<h4><i class="icon-reorder"></i> Daftar Sektor Usaha</h4>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<a href="./?p=sektor_usaha&a=tambah&id=<?=$_GET['id']?>" class="btn btn-xs btn-primary"><i class="icon-plus"></i>Tambah</a>
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
											<th data-class="expand">KODE</th>
											<th >NAMA</th>
											<th >PERUSAHAAN</th>
											<th >Aksi</th>
										</tr>
									</thead>
									<tbody>
                                        <?php
$perintah = ' SELECT b.ENTITY_ID,b.ENTITY_NAMA,a.SUSA_ID,a.SUSA_NAMA '.
	 ' FROM ma9002 a '.
	 ' JOIN ma1001 b ON b.ENTITY_ID=a.ENTITY_ID '.
	 ' WHERE a.ENTITY_ID="' . $_SESSION['user_cli_group'] . '" AND a.PROD_ID="'.$_GET['id'].'"';
$hasil2 = mysqli_query($conection, $perintah);
while ($row = mysqli_fetch_row($hasil2)) {
    ?>
                                                <tr>
                                                    <td class="checkbox-column">
                                                        <input type="checkbox" class="uniform">
                                                    </td>
                                                    <td><a href=".?p=sektor_usaha&a=ubah&id=<?=$_GET['id']?>&kode=<?=$row[2]?>" ><i class="icon-edit"></i><?=$row[2]?></a></td>
                                                    <td><?=$row[3]?></td>
                                                    <td><?=$row[1]?></td>
                                                    <td>
														<a href="./?p=sektor_usaha&a=ubah&id=<?=$_GET['id']?>&kode=<?=$row[2]?>" ><i class="icon-edit"></i>Ubah</a>
														<a href="#" class="hapus" onclick="hapus('<?=$row[2]?>')" ><i class="icon-remove"></i>Hapus</a>
													</td>
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
							window.location = "./?p=sektor_usaha&id=<?=$_GET['id']?>";
						}else{
							alert(JSONObject.pesan);
						}
					}
				}
				ajaxRequest.open("POST", "./simpan.php", true);
                    


				var formData = new FormData();
				formData.set("kode",id);
				formData.set("type","sektor_usaha_hapus");
				formData.set("prod","<?=$_GET['id']?>");
				<?php
$token = (empty($_SESSION['token'])) ? $_SESSION['token']=bin2hex(random_bytes(32)) : $_SESSION['token'];
?>
				formData.set("token","<?=$token?>");

				ajaxRequest.send(formData);
			}
		}

	</script>
