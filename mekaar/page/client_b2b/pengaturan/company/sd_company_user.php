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
						<li>
							<a href="./?p=company" title="">Perusahaan <?=$perusahaan['ENTITY_NAMA']?></a>
						</li>
                        <li class="current">
							<a href="#" title="">Daftar User</a>
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
								<h3>Daftar User Perusahaan <?=$perusahaan['ENTITY_NAMA']?></h3>
								<div class="toolbar no-padding">
									<div class="btn-group">
									<a href="./?p=company" class="btn btn-xs"><i class="icon-angle-left"></i>Kembali</a>
									<?php if(has_permission('create_user_perusahaan')){ ?>
										<a href="./?p=user_company&a=tambah&key=<?=$_GET['key']?>" class="btn btn-xs btn-primary"><i class="icon-plus"></i>Tambah</a>
									<?php }?>
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content no-padding">
								<table id="tabel_user" data-permission="3" class="table table-striped table-bordered table-hover table-checkable table-responsive">
									<thead>
										<tr>
											<th class="checkbox-column">
												<input type="checkbox" class="uniform">
											</th>
											<th >Username</th>
											<th >Email</th>
											<!-- <th >Phone</th> -->
											<th>Permission</th>
										<?php if(has_permission_array(['create_user_perusahaan','update_user_perusahaan','delete_user_perusahaan'])){ ?>
											<th >Aksi</th>
                                        <?php }?>
										</tr>
									</thead>
									<tbody>
                                        <?php
$perintah = ' SELECT a.CLI_SYSTEM_ID, a.CLI_USER_ID, a.CLI_PHONE, a.CABANG_KEY, a.CLI_EMAIL, GROUP_CONCAT(" ",c.title) perm '.
	' FROM `ma0001` a '.
	' LEFT JOIN users_permissions b ON a.CLI_SYSTEM_ID=b.user_id '.
	' LEFT JOIN permissions c ON b.permission_id=c.id '.
	' WHERE a.CLI_GROUP="'.$perusahaan['ENTITY_ID'].'" '.
	' GROUP BY a.CLI_SYSTEM_ID ';
	
	$hasil2 = mysqli_query($conection, $perintah);
while ($row = mysqli_fetch_array($hasil2)) {
    ?>
                                                <tr>
                                                    <td class="checkbox-column">
                                                        <input type="checkbox" class="uniform">
                                                    </td>
                                                    <td>
												<?php if(has_permission('update_user_perusahaan') && is_null($row['CABANG_KEY'])){ ?>
                                                        <a href="./?p=user_company&a=ubah&key=<?=$_GET['key']?>&id2=<?=$row['CLI_SYSTEM_ID']?>"><i class="icon-edit"></i><?=$row['CLI_USER_ID']?></a>
                                                <?php }else{?>
                                                        <?=$row['CLI_USER_ID']?>
									            <?php }?>
                                                    </td>
                                                    <td><?=$row['CLI_EMAIL']?></td>
                                                    <!-- <td><?=$row['CLI_PHONE']?></td> -->
                                                    <td class="convert_badge"><?=$row['perm']?></td>
                                                <?php if(has_permission_array(['create_user_perusahaan','update_user_perusahaan','delete_user_perusahaan'])){ ?>
													<td>
									            		<?php if(has_permission('update_user_perusahaan') && is_null($row['CABANG_KEY'])){ ?>
														<a class="btn btn-sm btn-warning" href="./?p=user_company&a=ubah&key=<?=$_GET['key']?>&id2=<?=$row['CLI_SYSTEM_ID']?>" ><i class="icon-edit"></i>Ubah</a>
														<?php }?>
									            		<?php if(has_permission('delete_user_perusahaan') && is_null($row['CABANG_KEY'])){ ?>
														<a href="#" class="btn btn-sm btn-danger hapus" onclick="hapus('<?=$row['CLI_SYSTEM_ID']?>')" ><i class="icon-remove"></i>Hapus</a>
														<?php }?>
													</td>
									            <?php }?>
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
        $(document).ready(function(){
			function optionsInit(a){
				var self = a;
				var options = {'aoColumnDefs': []};
				if(self.attr('data-permission') != undefined){
					options.aoColumnDefs.push({
						'render': function(data,type,row){
							let s = data.replace(/,/g, function(x){
									return '</span>,<span class="badge badge-info">';
								});
								s = '<span class="badge badge-info">' + s + '</span>';
							return s;
						},
						'aTargets': self.attr('data-permission').split(' ').map(Number)
					});
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
			$('#tabel_user').DataTable(optionsInit($('#tabel_user')));
		});
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
							window.location = "./?p=user_perusahaan&key=<?=$_GET['key']?>";
						}else{
							alert(JSONObject.pesan);
						}
					}
				}
				ajaxRequest.open("POST", "./simpan.php", true);

				var formData = new FormData();
				formData.set("type","company_user_hapus");
				formData.set("id2", id);
				formData.set("company","<?=$_GET['key']?>");
				<?php $token = (empty($_SESSION['token'])) ? $_SESSION['token'] = bin2hex(random_bytes(32)) : $_SESSION['token']; ?>
				formData.set("token","<?=$token?>");

				ajaxRequest.send(formData);
			}
		}

	</script>