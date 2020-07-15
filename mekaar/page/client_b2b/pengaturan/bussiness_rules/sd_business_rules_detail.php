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
                        <li >
							<a href="#" class="kembali">Sub Produk</a>
						</li>
                        <li class="current">
							<a href="#" title="">Business Rules</a>
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
						<div class="widget box" id="widget">
							<div class="widget-header">
								<h3>Detail Business Rules Sub Produk <?=$produk['PROD_NAMA']?></h3>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<a href="?p=produk&type=sub" class="kembali btn btn-xs"><i class="icon-angle-left"></i>Kembali</a>
										<?php if(has_permission('create_sub_produk')){ ?>
											<a href="./?p=business_rules_detail&a=tambah&id=<?=$_GET['id']?>" class="btn btn-xs btn-primary"><i class="icon-plus"></i>Tambah</a>
										<?php }?>
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content no-padding">
								<table id="tabel1" data-persen="2 3 4" data-tabel="9 10" class="table table-striped table-bordered table-hover table-checkable table-responsive">
									<thead>
										<tr>
											<th class="checkbox-column uniform"></th>
											<th>Partner</th>
											<th>Resiko (%)</th>
											<th>Menerima Komisi (%)</th>
											<th>Memberi Komisi (%)</th>
											<th data-hide="phone,tablet">Rekening</th>
											<th>Status</th>
											<th>Level</th>
											<th data-hide="always">Aksi</th>
											<th data-hide="always" style="display:none">Menerima Komisi</th>
											<th data-hide="always" style="display:none">Memberi Komisi</th>
											<th data-class="expand">Detail</th>
										</tr>
									</thead>
									<tbody>
									<?php $type = array('Pemilik/Lead', null => '-');foreach($SHA_SYSTEM_ID as $system_id=>$e_id){?>
										<tr>
											<td><input type="checkbox" class="uniform"></td>
											<td>
												<?php if(has_permission('update_sub_produk')){ ?>
													<a href="./?p=business_rules_detail&a=ubah&id=<?=$produk['PROD_ID']?>&id2=<?=$e_id?>"><?=$data['SHA_ENTITY_NAMA'][$e_id]?></a>
												<?php }else{ ?>
													<?=$data['SHA_ENTITY_NAMA'][$e_id]?>
												<?php } ?>
											</td>
											<td class="text-right"><?=$data['RESIKO'][$e_id]?></td>
											
											<td class="text-right"><?=isset($data['MENERIMA_KOMISI'][$system_id])?$data['MENERIMA_KOMISI'][$system_id]:0 ?></td>
											<td class="text-right"><?=isset($data['MEMBERI_KOMISI'][$system_id])?$data['MEMBERI_KOMISI'][$system_id]:0 ?></td>
											<td class="text-right">
												<?=$data['BANK'][$e_id]['no'].' '.$data['BANK'][$e_id]['bank'].' a.n '.$data['BANK'][$e_id]['nama']?>
											</td>
											<?php if ($data['STATUS'][$e_id] == 0) { //active ?>
												<td><span class="label label-primary">Active</span></td>
											<?php }else if ($data['STATUS'][$e_id] == 1) { //suspended ?>
												<td><span class="label label-danger">Suspended/Test</span></td>
											<?php }else{?>
												<td><span class="label label-danger">-</span></td>
											<?php } ?>

											<?php if (is_null($data['SHA_ENTITY_LEVEL'][$e_id])) { ?>
												<td>-</td>
											<?php }else if ($data['SHA_ENTITY_LEVEL'][$e_id] == 0) { ?>
												<td>Asuransi</td>
											<?php }else if ($data['SHA_ENTITY_LEVEL'][$e_id] == 1) { ?>
												<td>Re Asuransi</td>
											<?php }else{?>
												<td>-</td>
											<?php } ?>
											
											<td class="text-right">
												<?php if(has_permission('update_sub_produk')){ ?>
													<a href="./?p=business_rules_detail&a=ubah&id=<?=$produk['PROD_ID']?>&id2=<?=$e_id?>" ><i class="icon-edit"></i>Ubah</a>
												<?php } ?>
												<?php if(has_permission('delete_sub_produk')){ ?>
													<a href="#" class="hapus" onclick="hapus('<?= $produk['PROD_ID']?>','<?=$e_id?>')" ><i class="icon-remove"></i>Hapus</a>
												<?php } ?>
											</td>
											<td style="display:none">
												<?php 
												$d = '<table style="margin-bottom:10px!important"><tr><td>Komisi (%)</td><td>Penanggung</td><td>PPn</td><td>PPh 23</td></tr>';
												if(isset($data['KOMISI'][$system_id])){
													foreach($data['KOMISI'][$system_id] as $index=>$row) {
														$d .= '<tr>'.
															'<td class="text-right">'.formatMoney($row['KOMISI_NUM'],6,'.',',').'</td>'.
															'<td>'.$entity[$SHA_SYSTEM_ID[$row['SHA_SYSTEM_ID_GIVE']]].'</td>'.
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
												if(isset($data['KOMISI2'][$system_id])){
													foreach($data['KOMISI2'][$system_id] as $index=>$row) {
														$d .= '<tr>'.
															'<td class="text-right">'.formatMoney($row['KOMISI_NUM'],6,'.',',').'</td>'.
															'<td>'.$entity[$SHA_SYSTEM_ID[$row['SHA_SYSTEM_ID_TAKE']]].'</td>'.
															'<td>'.($row['KOMISI_TAX'] == 'y' ? 'Yes' : 'No').'</td>'.
															'<td>'.($row['KOMISI_WITH'] == 'y' ? 'Yes' : 'No').'</td>'.
															'</tr>';
													}
												}
												echo $d = htmlspecialchars($d . '</table>');
												?>
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
		var tableSub=null,obj=null;
		$(document).ready(function(){
			$('.kembali').on('click',function(){
				history.back();
			});
			if(tableSub!=null){tableSub.fnClearTable();tableSub.fnDestroy(false);tableSub=null;}
			function optionsInit(a){
				let self = a;
				let options = {'aoColumnDefs': []};
				if(self.attr('data-money') != undefined){
					options.aoColumnDefs.push({
						'render': function(data,type,row){
							return formatMoney(parseFloat(data),2,',','.')
						},'aTargets': self.attr('data-money').split(' ').map(Number)
					});
				}
				if(self.attr('data-gambar') != undefined){
					options.aoColumnDefs.push({
						'render': function(data,type,row){
							return '<a href="./?p=download&'+data+'" target="_blank">Buka</a>'
						},'aTargets': self.attr('data-gambar').split(' ').map(Number)
					});
				}
				if(self.attr('data-persen') != undefined){
					options.aoColumnDefs.push({
						'render': function(data,type,row){return formatMoney(parseFloat(data),6,',','.')}
								,'aTargets': self.attr('data-persen').split(' ').map(Number)
					});
				}
				// Checkable Tables
				if (self.hasClass('table-checkable'))
				{
					//console.log('as');
					options.aoColumnDefs.push({
						'bSortable': false, 'aTargets': [0]//,1,2,3,4,5,6,7,8,9
					});
					$.extend(true, options, {
						'order': [[1, 'desc']]
					});
				}
				// Responsive Tables
				if (self.hasClass('table-responsive'))
				{
					let responsiveHelper;
					let breakpointDefinition = {
						tablet: 1024,
						phone: 480
					};

					// Preserve old function from $.extend above
					// to extend a function
					let old_fnDrawCallback = $.fn.dataTable.defaults.fnDrawCallback;

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
				$.extend(true, options, { "lengthMenu": [[-1], ["All"]] });
				return options;
			}
			let submain=$("#widget");
			tableSub=submain.find('table');
			tableSub.DataTable(optionsInit(tableSub));
		});
	</script>
	<script>
		function hapus(id,kode){
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
							window.location = "./?p=business_rules_detail&id=<?=$_GET['id']?>";
						}else{
							alert(JSONObject.pesan);
						}
					}
				}
				ajaxRequest.open("POST", "./simpan.php", true);
                    

				

				var formData = new FormData();
				formData.set("id",id);
				formData.set("kode",kode);
				formData.set("type","business_rules_detail_hapus");
				<?php
$token = (empty($_SESSION['token'])) ? $_SESSION['token'] = bin2hex(random_bytes(32)) : $_SESSION['token'];
?>
				formData.set("token","<?=$token?>");

				ajaxRequest.send(formData);
			}
		}

	</script>

