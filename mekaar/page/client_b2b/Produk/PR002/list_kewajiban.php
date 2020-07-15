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
							<a href="#" title="">Daftar Kewajiban/Utang Produk <?=$produk[0]['PROD_NAMA']?></a>
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
                <style>
                    td{font-size:13px}
                    #tabelClaim th,#tabelClaim td{padding:5px}
                </style>
				<script>
						let  tabel=null;
						let rekening = "";
						let obj;
					$(document).ready(function(){
						let idTerpilih=[];    

						tabel = $('#tabel').DataTable(optionsInit($('#tabel')));
						function optionsInit(a){
							let  self = a;
							let  options = {'aoColumnDefs': [],};
							if(self.attr('data-money') != undefined){
								options.aoColumnDefs.push({
									'render': function(data,type,row){;return formatMoney(parseFloat(data),2,',','.')}
											,'aTargets': self.attr('data-money').split(' ').map(Number)
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
								let  responsiveHelper;
								let  breakpointDefinition = {
									tablet: 1024,
									phone: 480
								};

								// Preserve old function from $.extend above
								// to extend a function
								let  old_fnDrawCallback = $.fn.dataTable.defaults.fnDrawCallback;

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
							return options;
						}
						$('#bayarTerpilih').on('click',function(){
                            App.blockUI($("#content"));
							let ajaxRequest;
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
									let JSONObject = JSON.parse(ajaxRequest.responseText);
									if(JSONObject[0] != false)
									{
										alert(JSONObject.pesan);
                                        location.reload();
									}else{
                                        alert(JSONObject.pesan);
									}
									App.unblockUI($("#content"));
								}
							}
                            ajaxRequest.open("POST", "./simpan.php", true);

                            <?php $token = (empty($_SESSION['token'])) ? $_SESSION['token'] = bin2hex(random_bytes(32)) : $_SESSION['token'];?>
							let formData = new FormData();
							formData.set("type","dibayar_klaim");
							formData.set("kode",JSON.stringify(idTerpilih));
                            formData.set("token", "<?=$token?>");

							ajaxRequest.send(formData);
						});
						$('table tbody').on('click', 'tr,input[type=checkbox]', cekTerpilih);
						$('table').on('click', 'input[type=checkbox]', function(){
							setTimeout(function(){
								cekTerpilih();
							},100);
						});
						function cekTerpilih() {
							$(this).toggleClass('checked');
							//obj = ;
							if($(this).hasClass('checked')){
								$(this).find('span').addClass('checked');
								$(this).find('input[type=checkbox]').prop('checked',true);
							}else{
								$(this).find('span').removeClass('checked');
								$(this).find('input[type=checkbox]').prop('checked',false);
							}
							//$(this).find('input[type=checkbox]')
							//alert( tabel.rows('.selected').data().length +' row(s) selected' );
							//untuk semua checked pada data tabel
							idTerpilih=[];
							tabel.rows('.checked').data().each(function(el,index){
								if(index==0)
								{
									rekening = $(el[0]).find('input[type=checkbox]').data('rekening');
								}
								if(rekening == $(el[0]).find('input[type=checkbox]').data('rekening'))
								{
									console.log(index);
									idTerpilih.push($(el[0]).find('input[type=checkbox]').val());
								}
								else
								{
									console.log($(el[0]).find('span'));
									let r = $(el[0]).find('input[type=checkbox]').data('rekening');
									let tr = $("input[data-rekening='" + r + "']").parentsUntil('tr');
									$(tr).parent().removeClass('checked');
									$(tr).find('span').removeClass('checked');
									$(tr).find('input[type=checkbox]').prop('checked',false);
									new Noty({
										text   : "Rekening transfer tujuan tidak sama dengan data pertama",
										type   : 'alert',
										timeout: 2000
									}).show();
								}
							});
							//$(this).toggleClass('selected');
							if(idTerpilih.length>0){
								$('#bayarTerpilih').prop('disabled',false).css('background','#00c030').css('color','#fff').html('<i class="icon-check"></i>Bayar '+idTerpilih.length+' data terpilih')
							}else{
								$('#bayarTerpilih').prop('disabled',true).css('background','').css('color','').html('<i class="icon-check"></i>Bayar 0 data terpilih')
							}
							//hitungPinjamanSetlement(idTerpilih);
						}
                    });
                </script>
                <div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h3>Daftar Kewajiban/Utang Produk <?=$produk[0]['PROD_NAMA']?></h3>
								<div class="toolbar no-padding">
									<button id="bayarTerpilih" class="btn btn-xs" disabled><i class="icon-check"></i>Bayar data terpilih</button>
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content no-padding">
								<table class="table table-striped table-bordered table-hover table-checkable table-responsive" id="tabel">
									<thead>
										<tr>
											<th class="checkbox-column">
												<input type="checkbox" class="uniform">
											</th>
											<th>Produk</th>
											<!-- <th>Produk Klaim</th> -->
											<th>NO KTP/LOAN ID Peserta</th>
											<th>Nama Peserta</th>
											<th>Cabang</th>
											<th>Perusahaan</th>
											<th>Mata Uang</th>
											<th>Jumlah Klaim</th>
											<th>Transfer ke-</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$sql = 'SELECT a.KEWAJIBAN_SYSTEM_ID,a.NILAI,a.BANK_REKENING,a.NAMA_REKENING,a.NO_REKENING'.
											',b.TRX_CURR,b.CLAIM_DUE,b.CLAIM_TYPE,b.TRX_SYSTEM_ID,b.TRX_DETAIL_SYSTEM_ID '.
											',c.TRX_KTP_ID,c.TRX_NAMA '.
											',d.LOKASI_NAMA '.
											',e.PROD_NAMA,e.PROD_TYPE '.
											',f.ENTITY_NAMA'.
											' FROM tr0004_b2c a'.
											' JOIN tr0002_b2c b ON a.TRX_DETAIL_SYSTEM_ID=b.TRX_DETAIL_SYSTEM_ID '.
											' JOIN tr0001 c ON b.TRX_SYSTEM_ID=c.TRX_UUID '.
											' JOIN ma1003 d ON c.CABANG_ID=d.LOKASI_ID AND c.PROD_ID=d.PROD_ID';
										if( ! empty($_SESSION['user_cabang_key'])){
											$sql .= ' AND d.ID_KEY='.$_SESSION['user_cabang_key'];
										}
										$sql .= ' JOIN ma2001 e ON b.SUB_PROD_ID=e.PROD_ID '.
											' JOIN ma1001 f ON f.ENTITY_ID=c.ENTITY_ID '.
											' WHERE c.PROD_ID = "' . $produk[0]['PROD_ID'] . '" AND c.TRX_STATUS=1 AND b.CLAIM_STATUS=1 AND a.KEWAJIBAN_STATUS=0 AND a.ENTITY_ID="' . $_SESSION['user_cli_group'] . '"'.
											'';
											$query =mysqli_query($conection, $sql);
											$i=0;
											while($row = mysqli_fetch_array($query)){
										?>
											<tr>
												<td class="checkbox-column">
													<input type="checkbox" class="uniform" value="<?=$row['KEWAJIBAN_SYSTEM_ID']?>" data-rekening="<?=$row['NO_REKENING'].' '.$row['BANK_REKENING'].' a.n '.$row['NAMA_REKENING']?>">
												</td>
												<td><?=$row['PROD_NAMA']. '('.$row['PROD_TYPE'].')'?></td>
												<!-- <td><?=($row['CLAIM_TYPE']==0)?'Terikat':'Bebas'?></td> -->
												<td><?=$row['TRX_KTP_ID']?></td>
												<td><?=$row['TRX_NAMA']?></td>
												<td><?=$row['LOKASI_NAMA']?></td>
												<td><?=$row['ENTITY_NAMA']?></td>
												<td><?=$row['TRX_CURR']?></td>
												<td class="money"><?=$row['NILAI']?></td>
												<td><?=$row['NO_REKENING'].' '.$row['BANK_REKENING'].' a.n '.$row['NAMA_REKENING']//.($i++)?></td>
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
	