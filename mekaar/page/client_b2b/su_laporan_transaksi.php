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
                            <a href="#" title="">Produk <?=$produk[0]['PROD_NAMA']?></a>
                        </li>
						<li class="current">
							<a href="#" title="">Laporan Produksi</a>
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
				<!-- script>
					$(document).ready(function(){
						console.log('a');
						$('#tabel').dataTable({
							"processing": true,
							"serverSide": true,
							"ajax": {
								"url": "./coba.php",
								"type": "POST",
								"data": function ( d ) {
									d.x = "myValue";

									// d.custom = $('#myInput').val();
									// etc
								}
							},
							"columns": [
								{ "data": "first_name" },
								{ "data": "last_name" },
								{ "data": "position" },
								{ "data": "office" },
								{ "data": "start_date" },
								{ "data": "salary" },
								{ "data": "salary" },
								{ "data": "salary" },
								{ "data": "salary" },
								{ "data": "salary" },
								{ "data": "salary" },
								{ "data": "salary" },
								{ "data": "salary" },
								{ "data": "salary" },
								{ "data": "salary" }
							]
						});
					});
				</!-->
				<script>
                	let api;
					let tabel1=tabel2=null;
					$(document).ready(function(){
						function optionsInit(a){
							let groupColumn = 0;
							let self = a;
							let options = {'aoColumnDefs': []};
							console.log(a.id);
							if(self.attr('data-money') != undefined){
								options.aoColumnDefs.push({
									'render': function(data,type,row){
										return formatMoney(parseFloat(data),2,',','.')
									},'aTargets': self.attr('data-money').split(' ').map(Number)
								});
							}
							if(self.attr('data-persen') != undefined){
								options.aoColumnDefs.push({
									'render': function(data,type,row){return formatMoney(parseFloat(data),6,',','.')}
											,'aTargets': self.attr('data-persen').split(' ').map(Number)
								});
                            }
                            function groupBy(objectArray, property) {
                                return objectArray.reduce( function(acc, obj){
                                        let key = obj[0];
                                        if (!acc[key]) {
                                            acc[key] = obj[property]
                                            acc['sum'] += obj[property]
                                        }
                                        return acc
                                    },{'sum':0}).sum;
							}
							if(self.attr('id')=="tabel2"){
								$.extend(true, options, {
									"footerCallback": function ( row, data, start, end, display ) {
										api = this.api(), data;
										//console.log(data);
										// Remove the formatting to get integer data for summation
										let intVal = function ( i ) {
											return typeof i === 'string' ?
												i.replace(/[\$,]/g, '')*1 :
												typeof i === 'number' ?
													i : 0;
										};
	
										// Total over all pages
										total = api.rows().data().reduce( function(acc, obj){
											acc['sumDiterima'] += parseFloat(obj[4]);
											return acc
										},{'sumDiterima':0});
										// Total over this page
										// page = api.rows({ page: 'current'}).data().reduce( function(acc, obj){
										// 	let key = obj[0];
										// 	if (!acc[key]) {
										// 		acc[key] = obj[2];
										// 		acc['sumPlafond'] += parseFloat(obj[3]);
										// 		acc['sumPremi'] += parseFloat(obj[4]);
										// 		acc['sumDiterima'] += parseFloat(obj[5]);
										// 	}
										// 	return acc
										// },{'sumPlafond':0,'sumPremi':0,'sumDiterima':0});
										// console.log(page)
										// Update footer
										$( api.column( 4 ).footer() ).html(
											formatMoney(parseFloat(total.sumDiterima),2,',','.')
										);
									}
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
										if(self.attr('data-money') != undefined){
											self.attr('data-money').split(' ').map(Number).forEach(function(val){
												$('td', nRow).eq(val).addClass('text-right');
											})
										}
										if(self.attr('data-persen') != undefined){
											self.attr('data-persen').split(' ').map(Number).forEach(function(val){
												$('td', nRow).eq(val).addClass('text-right');
											})
										}
									},
									drawCallback: function (oSettings)
									{
										// Extending function
										old_fnDrawCallback.apply(this, oSettings);

										responsiveHelper.respond();
									}
								});
							}
							$.extend(true, options, {  });
							return options;
						}
						tabel1 = $('#tabel1')
							.DataTable(optionsInit($('#tabel1')));
							tabel1.on( 'draw', function () {
								console.log( 'Table redrawn' );
							} );
						tabel2 = $('#tabel2').DataTable(optionsInit($('#tabel2')));
						$('#cari').on('click',function(){
							if($('#awal').val() == '' || $('#akhir').val() == '' ){
								alert('Tanggal periode harap diisi!');
								return;
							}
							$('#excel').attr('href','./cetak.php?p=laporan&a=transaksi&id=<?=$_GET['id']?>&awal='+$('#awal').val()+'&akhir='+$('#akhir').val());
							//App.blockUI($("#content"));
							//setTimeout(function ()
							//{
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
									tabel1.clear().draw();
									tabel2.clear().draw();
									if(JSONObject[0] != false)
									{
										//tabel1.fnClearTable();
										JSONObject.data.forEach(function(val){
											tabel1.row.add(val).draw();
										})
										let total=null;
										total=tabel1.rows().data().reduce( function(acc, obj){
											let key = obj[0];
											//jika beda tgl
											if (!acc[key]) {
												acc[key] = obj[0];
												acc['sumPlafond'] += parseFloat(obj[3]);
												acc['sumPremi'] += parseFloat(obj[4]);
												acc['curr'] = obj[2];
											}
											//jika partner ada totalDiterima tambahkan
											if(acc['partner'].indexOf(obj[1]) != -1){
												acc['partnerDiterima'][acc['partner'].indexOf(obj[1])] += parseFloat(obj[5]);
											}else{
												acc['partner'].push(obj[1]);
												acc['partnerDiterima'].push(parseFloat(obj[5]));
											}
											return acc
										},{'curr':'','sumPlafond':0,'sumPremi':0,'sumDiterima':0,'partnerDiterima':[],'partner':[]});
										total.partner.forEach(function(el,ind){
											tabel2.row.add([el,total.curr,total.sumPlafond,total.sumPremi,total.partnerDiterima[ind]]).draw();
											console.log(ind);
										})
										$.scrollTo('#ganti',{duration:600,offset:{top:-80}});
										//$.scrollTo('#ganti',400);
										//alert(JSONObject.pesan);
									}else{
										//alert(JSONObject.pesan);
									}
									App.unblockUI($("#content"));
								}
							}
							ajaxRequest.open("POST", "./ambil_data.php", true);

							let formData = new FormData();
							formData.set("type","laporan_transaksi");
							formData.set("kode","<?=$_GET['id']?>");
							formData.set("awal",$('#awal').val());
							formData.set("akhir",$('#akhir').val());

							ajaxRequest.send(formData);
						});
						$('#awal').on('change',function(){
							$('#akhir').attr('min',this.value);
						});
						$('#akhir').on('change',function(){
							$('#awal').attr('max',this.value);
						});
						<?php 
						$tgl_lalu = (new DateTime())->modify('- 10 day');
						$tgl_sekarang = new DateTime();
						?>
						$('#awal').val("<?=$tgl_lalu->format('Y-m-d')?>").change();
						$('#akhir').val("<?=$tgl_sekarang->format('Y-m-d')?>").change();
						$('#cari').trigger('click');
					})
    		   	</script>
				<style> .flex{display:flex} .flex span,#form button{margin:auto 20px}.flex input{width:40%}</style>
				<div class="row">
					<div class="col-md-12 pembayaran">
						<div class="widget box">
							<div class="widget-content" >
								<div style="text-align:center;cursor:default;margin: auto;width: fit-content;">
									<h3 class='agileinfo_sign'>Laporan Produksi</h3><br>
									<form id="form" class="contact100-form ">
										<div class="wrap-input100 bg1 flex" >
											<span class="label-input100">Periode: </span>
											<input type="date" id="awal" class="input100">
											<span>-</span>
											<input type="date" id="akhir" class="input100">
										</div><br>
										<button id="cari" type="button" class="btn btn-success">Cari</button>
									</form>
								</div>
								<br>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="widget box" id ="ganti">
							<div class="widget-header">
								<h3>Pihak Terlibat dalam Produk <?=$produk[0]['PROD_NAMA']?></h4>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<!--a-- href="./?p=peserta&a=upload" class="btn btn-xs" style="background:#7800fc;color:#fff"><i class="icon-upload"></i>Unggah Data</!--a-->
										<!-- <a href="#" id="excel" class="btn btn-xs btn-success"><i class="icon-download"></i>Excel</a> -->
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content no-padding">
								<table id="tabel1" data-money="3 4 5" class="table table-striped table-bordered table-hover table-responsive">
									<thead>
										<tr>
											<th >Tanggal</th>
											<th >Partner</th>
											<th >Mata Uang</th>
											<th >Total Plafond</th>
											<th >Total Premi</th>
											<th >Total Diterima</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
								<table id="tabel2" data-money="2 3 4" class="table table-striped table-bordered table-hover table-responsive">
									<thead>
										<tr>
											<th >Partner</th>
											<th >Mata Uang</th>
											<th >Total Plafond</th>
											<th >Total Premi</th>
											<th >Total Diterima</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4" class="text-right">Total:</th>
                                            <th class="text-right"></th>
                                        </tr>
                                    </tfoot>
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