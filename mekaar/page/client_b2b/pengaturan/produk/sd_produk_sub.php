<body>
<?php
$perintah = ' SELECT a.PROD_ID,a.PROD_NAMA,a.PROD_LEGAL,a.PROD_STATUS, ' .
	' a.PROD_MIN_TSI,a.PROD_MAX_TSI,a.PROD_B2C,a.PROD_CURR,a.DANA_IN_VA_NAMA, ' .
	' a.DANA_IN_VA_BANK,a.DANA_IN_VA_NO ' .
    ' FROM ma2001 a ' .
    ' WHERE a.PROD_LEVEL =0 ';
$hasil2 = mysqli_query($conection, $perintah);
$main_produk = mysqli_fetch_all($hasil2, MYSQLI_ASSOC);
?>
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
                            <a href="#" title="">Sub Produk</a>
                        </li>
                        <li class="current">
							<a href="#" class="titleMain">Main Produk ??</a>
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

				<style>.submain,.rules{cursor:pointer}.submain:hover,.rules:hover{background-color:#9cb0fb!important}.rules:hover a{color:#000}</style>
				<script>

				var subMainWidgetChildren=null;
				var tableSub=null,obj=null;
				$(document).ready(function(){
					function optionsInit(a){
						var options = {};
						var self = a;
						// Checkable Tables
						if (self.hasClass('table-checkable'))
						{
							$.extend(true, options, {
								'aoColumnDefs': [
									{ 'bSortable': false, 'aTargets': [0] }
								], 'order': [[2, 'asc']]
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
											self.attr('data-tabel').split(' ').map(Number).forEach(function(val){
												let d=htmlDecode(obj._aFilterData[val]);
												$('td', obj.nTr).eq(val).html(d);
											});
										})
									};
									// Extending function
									old_fnDrawCallback.apply(this, oSettings);

									responsiveHelper.respond();
								}
							});
						}
					$.extend(true, options, { "destroy": true, /* "iDisplayLength": 1, */});
						return options;
					}
					subMainWidgetChildren=$("#subMainWidget");
					$("#subMainWidget").remove();
					$(document).on('click','.rules',function(){window.location='./?p=business_rules_detail&id='+$(this).data('kode')});
					$(document).on('change','#submain',function(){
						$("#subMainWidget").find('tbody').empty();
						$("#subMainWidget").remove();
						$("#mainWidget").after("<img id='imgloading' src='<?=getUrlServer()?>/assets/img/loading.gif' style='width:100px;height:100px;'>");
						if(tableSub!=null){tableSub.fnClearTable();tableSub.fnDestroy(false);tableSub=null;}
       					   //submain
						let main=$(this);
						let status=main[0].selectedOptions[0].dataset['status'];
						var produk=main.val();
						$('.titleMain').text('Main Produk ' + main[0].selectedOptions[0].innerHTML);
						$('#ubahMain').attr('href','./?p=produk&a=ubah&kode='+main.val());
						$('#main1').text(main[0].selectedOptions[0].dataset['pks']);
						$('#main2').text(main[0].selectedOptions[0].dataset['curr']);
						if(status==0){
							$('#main3').text('Aktif');
						}else if(status==1){
							$('#main3').text('Suspended');
						}else if(status==2){
							$('#main3').text('Closed');
						}
						$('#main4').text(main[0].selectedOptions[0].dataset['b2c']==1?"Ya":"Tidak");
						$('#main5').text(main[0].selectedOptions[0].dataset['min']+' s.d '+main[0].selectedOptions[0].dataset['max']);
						$('#main6').text(main[0].selectedOptions[0].dataset['front']);
						$('#main7').text(main[0].selectedOptions[0].dataset['rekening']);
						//console.log(produk);
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
								$('#imgloading').remove();
								let result = JSON.parse(ajaxRequest.responseText);
								if(result[0]==false){
									alert('Permintaan Sub Produk Gagal!');
								}else{
									let dats = result.data;
									$("#mainWidget").after(subMainWidgetChildren);
									let submain=$("#subMainWidget");
									submain.find("#tambahSub").attr('href','./?p=produk&a=tambah&type=sub&kode='+produk);
									dats.forEach(function(row){
										//console.log(row);
										submain.find('tbody').append('<tr></tr>');
										let tr=submain.find('tr').last();
										tr.append('<td><input type="checkbox" class="uniform"></td>');
										tr.append('<td style="width:180px" data-kode="'+row.id+'">'+row.prt+'</td>');
										tr.append('<td>'+
										<?php if(has_permission('update_sub_produk')){?>
											'<a href="./?p=produk&a=ubah&kode='+row.id+'"><i class="icon-edit"></i>'+row.nm+'</a>'+
										<?php }else{?>
											row.nm+
										<?php }?>
										'</td>');
										tr.append('<td>'+row.risk+'</td>');

										<?php if(has_permission('update_sub_produk')){?>
											let	pengaturan_santunan='';
											if(row.typ=="dca eq"){
												pengaturan_santunan='<a href="./?p=parametrik&a=gempa&id='+row.id+'"><i class="icon-gear"></i>Pengaturan Santunan</a>';
											}
										<?php }?>
										tr.append('<td class="text-right">'+
											
											<?php if(has_permission('delete_sub_produk')){?>
												'<a href="#" class="hapus" onclick="hapus(\''+row.id+'\')" ><i class="icon-remove"></i>Hapus</a>'+
											<?php }?>
											
											<?php if(has_permission('update_sub_produk')){?>
												'<a href="./?p=produk&a=ubah&kode='+row.id+'" ><i class="icon-edit"></i>Ubah</<span>'+
												pengaturan_santunan +
											<?php }?>
												'<a href="./?p=business_rules_detail&id='+row.id+'"><i class="icon-gear"></i>Lihat Rules</a>'+
											
										'</td>');
										tr.append('<td>'+row.leg+'</td>');
										tr.append('<td>'+row.prm+'</td>');
										tr.append('<td class="">'+row.prz+'</td>');
                						if (row.sts == 0) { //active
											tr.append('<td><span class="label label-primary">Active</span></td>');
										}else if (row.sts == 1) { //suspended
											tr.append('<td><span class="label label-danger">Suspended/Test</span></td>');
										}else if (row.sts == 2) { //closed
											tr.append('<td><span class="label label-default">Closed/Discontinue</span></td>');
										}
										// tr.append('<td>'+row.dana+'</td>');
										if (row.claim == 0) { //terikat
											tr.append('<td>Terikat</td>');
										}else if (row.claim == 1) { //bebas
											tr.append('<td>Bebas <sup>(Ketika sub produk ini di claim, maka sub produk lain tidak bisa diklaim)</sup></td>');
										}
										tr.append('<td>'+row.typ+'</td>');
										tr.append('<td>'+row.santunan+'</td>');
										tr.append('<td>&nbsp;</td>');
									});
									tableSub=submain.find('table');
									tableSub.dataTable(optionsInit(tableSub));
								}
								$.scrollTo($("#subMainWidget"),{duration: 400,interrupt:true,offset:{top:-100},});
							}
						}
						ajaxRequest.open("GET", "./ambil_data.php?type=submain&kode="+produk, true);
						ajaxRequest.send(null);
					});
					//$('#submain').trigger('change');
				})
				</script>
				<!--=== Page Content ===-->
				<div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h3> Main Produk
									<select class="" name="" id="submain">
											<option disabled selected>Pilih Main Produk</option>
										<?php if(has_permission('update_main_produk')){?>
											<?php 
												foreach ($main_produk as $row) {
											?>
											<option value="<?=$row['PROD_ID']?>" data-pks="<?=$row['PROD_LEGAL']?>" data-curr="<?=$row['PROD_CURR']?>" data-min="<?=$row['PROD_MIN_TSI']?>" data-max="<?=$row['PROD_MAX_TSI']?>" data-b2c="<?=$row['PROD_B2C']?>" data-status="<?=$row['PROD_STATUS']?>" 
											<?php 
												if(isset($_GET['kode']) && $row['PROD_ID'] == $_GET['kode'])
												{
													echo 'selected="selected"';
												}
												
											?> 
											data-front="<?=$row['DANA_IN_VA_NAMA']?>" data-rekening="<?=$row['DANA_IN_VA_BANK'].' '.$row['DANA_IN_VA_NO']?>">
												<?=$row['PROD_NAMA']?>
											</option>
											<?php }?>
										<?php 
											}else{
												if(isset($_GET['kode'])){
													$selected = array_filter($main_produk, function ($x) {return $x['PROD_ID'] == $_GET['kode'];});
												}
												if(!isset($selected) || count($selected)==0){
													$selected = array($main_produk[0]);
												}
												$selected = array_shift($selected);
											?>
											<option value="<?=$selected['PROD_ID']?>" data-pks="<?=$selected['PROD_LEGAL']?>" data-curr="<?=$selected['PROD_CURR']?>" data-min="<?=$selected['PROD_MIN_TSI']?>" data-max="<?=$selected['PROD_MAX_TSI']?>" data-b2c="<?=$selected['PROD_B2C']?>" data-status="<?=$selected['PROD_STATUS']?>" data-front="<?=$selected['DANA_IN_VA_NAMA']?>" data-rekening="<?=$selected['DANA_IN_VA_BANK'].' '.$selected['DANA_IN_VA_NO']?>">
												<?=$selected['PROD_NAMA']?>
											</option>
										<?php }?>
									</select>
								</h3>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<?php if(has_permission('update_main_produk')){?>
											<a href="#" id="ubahMain" class="btn btn-xs btn-primary"><i class="icon-edit"></i> Ubah Main Produk</a>
										<?php }?>
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content" >
								<table class="table table-striped">
									<tr>
										<th width="30%">PKS / MOU</th>
										<th width="1%">:</th>
										<th id="main1"></th>
									</tr>
									<tr>
										<th>CURR</th>
										<th>:</th>
										<th id="main2"></th>
									</tr>
									<tr>
										<th>Status</th>
										<th>:</th>
										<th id="main3"></th>
									</tr>
									<tr>
										<th>B2C</th>
										<th>:</th>
										<th id="main4"></th>
									</tr>
									<tr>
										<th>Rentang TSI</th>
										<th>:</th>
										<th id="main5"></th>
									</tr>
									<tr>
										<th>Front Linier Produk</th>
										<th>:</th>
										<th id="main6"></th>
									</tr>
									<tr>
										<th>Rekening Penerima Dana</th>
										<th>:</th>
										<th id="main7"></th>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="" id="mainWidget">

						</div>
						<div class="widget box" id="subMainWidget">
							<div class="widget-header">
								<h3>Daftar SUB Produk </h3>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<?php if(has_permission('create_sub_produk')){?>
											<a id="tambahSub" class="btn btn-xs btn-primary"><i class="icon-plus"></i>Tambah SUB Produk</a>
										<?php }?>
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content no-padding">
								<table data-tabel="11" class="table table-striped table-bordered table-hover table-checkable table-responsive">
									<thead>
										<tr>
											<th class="checkbox-column uniform"></th>
											<th >Rules</th>
											<th >Sub Produk</th>
											<th >Resiko (%)</th>
											<th data-hide="always">Aksi</th>
                                            <th data-hide="phone,tablet">PKS/MOU</th>
											<th data-hide="phone,tablet">Premi (%)</th>
											<th data-hide="phone,tablet">Rate Risk (%)</th>
											<th >Status</th>
											<!-- <th data-hide="">VA Dana Keluar</th> -->
											<th data-hide="always">Tipe Claim</th>
											<th data-hide="always">Tipe Sub Produk</th>
											<th data-hide="always">Santunan</th>
											<th data-class="expand">Detail</th>
										</tr>
									</thead>
									<tbody>

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
							window.location = "./?p=produk&type=sub&kode=<?=isset($_GET['kode'])?$_GET['kode']:null?>";
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

