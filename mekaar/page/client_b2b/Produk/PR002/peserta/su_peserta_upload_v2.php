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
							<a href="#" title="">Upload Data Peserta</a>
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
                <div class="row" style="margin-bottom:20px;">
                    <form id="form" enctype="multipart/form-data" class="form-inline validate-form" method="post">
                        <div class="panel">
                            <div class="panel-body row-flex">
                                <?php $c=(count($produk)+1)/3==1?4:3;?>
                                <div class="col-<?=$c?>" >
                                    <label class="text-truncate col-12">No PKS</label>
                                    <input readonly type="text" class="form-control col-12" id="pks_mou" value="<?=$produk[0]['PROD_LEGAL']?>">
                                </div>
                                <?php foreach ($produk as $index => $subProd) {?>
                                <div class="col-<?=$c?>" >
                                    <label class="text-truncate col-12" title="Premi Dasar (%) <?=$subProd['PROD_NAMA_CHILD']?>">Premi Dasar (%) <?=$subProd['PROD_NAMA_CHILD']?></label>
                                    <input readonly type="text" class="form-control col-12 premiSubProd" value="<?=$subProd['PROD_PREMI']?>">
                                </div>
                                <?php }?>
                            </div>
                        </div>
                        <div class="panel">
                            <div class="panel-body">
                                <div class="validate-input col-12 row-flex">
                                    <label class="col-lg-5 col-md-6 col-sm-6 col-xs-12 p-0">Contoh/Template File Unggah Excel</label>
                                    <a href="./?p=download&a=template_upload">
                                        <button class="btn btn-primary" type="button">
                                            <i class="icon-download-alt"></i> Unduh File
                                        </button>
                                    </a>

                                </div>
                            </div>
                        </div>
                        <div class="panel">
                            <div class="panel-heading">
                               <h2>Form Upload Data Peserta</h2>
                               
                            </div>
                            <div class="panel-body">
                            <?php
$c = 8;
if( ! empty($_SESSION['user_cabang_key'])){
$perintah2 = ' SELECT LOKASI_NAMA FROM ma1003 ' .
    ' WHERE LOKASI_STATUS="0" AND ENTITY_ID="' . $_SESSION['user_cli_group'] . '"' .
    ' AND PROD_ID = "'.$_GET['id'].'" AND ID_KEY=' . $_SESSION['user_cabang_key'] .
    ' GROUP BY LOKASI_ID ';
$hasil2 = mysqli_query($conection, $perintah2);
if(mysqli_num_rows($query) > 0){
    $c = floor($c / ( 1 + mysqli_num_rows($query)));
    ?>
                                <div class="validate-input col-12 row-flex">
                                    <label class="col-lg-3 col-md-4 col-sm-4 col-xs-12 p-0">Khusus Cabang</label>
    <?php 
while ($row = mysqli_fetch_array($hasil2)) {?>
                                    <input readonly type="text" title="<?=$row['LOKASI_NAMA']?>" class="form-control col-lg-<?=$c?> col-md-<?=$c-1?>" id="premi" value="<?=$row['LOKASI_NAMA']?>">
<?php }?>
                                </div>
<?php }}?>
                                <div class="validate-input col-12 row-flex my-4 pr-0" data-validate = "Pilih File">
                                    <label class="col-lg-3 col-md-4 col-sm-4 col-xs-12 p-0">Unggah Data</label>
                                    <input required class="form-control col-lg-9 col-md-8 col-sm-8 col-xs-12 pr-0" name="fileSpreadsheet" id="fileSpreadsheet" type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                </div>
                                <button type="submit" class="pull-right btn btn-primary mr-4" id="simpan" style="margin-top:5px">
                                    Unggah <i class="icon-upload-alt"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

				<div class="row">
					<div class="col-md-12 p-2">
						<div class="widget box">
                            <div class="widget-header">
								<h3>Hasil Unggahan</h3>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<a href="./?p=peserta&a=settlement&id=<?=$_GET['id']?>" class="btn btn-xs btn-primary"><i class="icon-arrow-left"></i>Menuju ke Daftar Peserta Settlement</a>
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content">
								<table class="table table-striped table-bordered table-hover table-checkable table-responsive">
									<thead>
										<tr>
											<th class="checkbox-column">
												<input type="checkbox" class="uniform">
											</th>
											<th >Tanggal</th>
											<th data-hide="phone,tablet">Nama File</th>
											<th >Data Total</th>
											<th >Data Dihapus</th>
											<th >Data Diterima</th>
											<th >Data Ditolak</th>
                                            <th data-class="expand" colspan=2>Aksi</th>
										</tr>
									</thead>
									<tbody>
                                    <?php
$perintah = 'SELECT * FROM up001 WHERE CREATED_BY="' . $_SESSION['user_cli_system_id'] . '"';
$query = mysqli_query($conection, $perintah);
while ($data = mysqli_fetch_array($query)) {

    ?>
                                        <tr>
                                            <td class="checkbox-column">
                                                <input type="checkbox" class="uniform">
                                            </td>
                                            <td><?=$data['TANGGAL']?></td>
                                            <td><?=$data['TRX_NMFILE']?></td>
                                            <td><?=$data['DATA_TOTAL']?></td>
                                            <td><?=$data['DATA_DELETED']?></td>
                                            <td><?=$data['DATA_SUCCESS']?></td>
                                            <td><?=$data['DATA_REJECTED']?></td>
                                            <td><a href="#" class="btn btn-danger" onclick="hapus('<?=$data['ID_KEY']?>')"><i class="icon-remove"></i> Hapus</a></!-->
                                            <td><a href="./?p=download&a=file_rejected&prod=<?=$_GET['id']?>&id=<?=$data['ID_KEY']?>" class="btn btn-warning"  target="_self"><i class="icon-download-alt"></i>  Download Rejected File</a></td>
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
							new Noty({
								text   : JSONObject.pesan,
								type   : 'alert',
								timeout: 5000
							}).show();
							window.location = "./?p=peserta&a=upload&id=<?=$_GET['id']?>";
						}else{
							new Noty({
								text   : JSONObject.pesan,
								type   : 'alert',
								timeout: 5000
							}).show();
						}
					}
				}
				ajaxRequest.open("POST", "./simpan.php", true);
                    


				var formData = new FormData();
				formData.set("id","<?=$_GET['id']?>");
				formData.set("kode",id);
				formData.set("type","peserta_hapus_file");
				<?php $token = (empty($_SESSION['token'])) ? $_SESSION['token'] = bin2hex(random_bytes(32)) : $_SESSION['token'];?>
				formData.set("token","<?=$token?>");

				ajaxRequest.send(formData);
			}
		}

		$(document).ready(function(){
            $('#form').on('submit',function(e){
                event.preventDefault();
                let input = $('.validate-input > input');
                let check = true;

                for(let i=0; i<input.length; i++) {
                    if(validate(input[i]) == false){
                        showValidate(input[i]);
                        check=false;
                    }
                }
                if(!check) return check;

                simpan();
            });
            /*==================================================================
						[ Validate after type ]*/
						$('.validate-input > input').each(function(){
							$(this).on('blur', function(){
								if(validate(this) == false){
									showValidate(this);
								}
								else {
									$(this).parent().addClass('true-validate');
								}
							})
						});
						/*==================================================================
						[ Validate ]*/
						$('.validate-form input').each(function(){
							$(this).focus(function(){
							hideValidate(this);
							$(this).parent().removeClass('true-validate');
							});
						});
						function validate (input) {
							if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
								if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
									return false;
								}
							}
							else if($(input).attr('name') == 'pbb'){
								var pattern=/^[0-9]{18}$/i;
								var m=$(input).val().trim().match(pattern);
								console.log($(input));
								if(m == null) {
									return false;
								}
							}
							else {
								if($(input).val().trim() == ''){
									return false;
								}
							}
						}
						function showValidate(input) {
							var thisAlert = $(input).parent();

							$(thisAlert).addClass('has-error has-feedback');
							$(thisAlert).append('<span class="glyphicon glyphicon-remove form-control-feedback btn-hide-validate"></span>')
							$('.btn-hide-validate').each(function(){
								$(this).on('click',function(){
								hideValidate(this);
								});
							});
						}
						function hideValidate(input) {
							var thisAlert = $(input).parent();
							$(thisAlert).removeClass('has-error has-feedback');
							$(thisAlert).find('.btn-hide-validate').remove();
						}

            function simpan(){
                if(confirm("Simpan Data?")){
					App.blockUI('#content');
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
                                window.location = "./?p=peserta&a=upload&id=<?=$_GET['id']?>";
                            }else{
								if(JSONObject.newWindow != undefined){
									window.open(JSONObject.newWindow,'_blank');
								}
                                alert(JSONObject.pesan);
                            }
							App.unblockUI('#content');
                        }
                    }
                    ajaxRequest.open("POST", "./simpan.php", true);
                    


                    var formElement = document.getElementById("form");
                    var formData = new FormData(formElement);
                    formData.set("type","peserta_unggah");
                    formData.set("produk","<?=$_GET['id']?>");
                    <?php
$token = (empty($_SESSION['token'])) ? $_SESSION['token'] = bin2hex(random_bytes(32)) : $_SESSION['token'];
?>
                    formData.set("token","<?=$token?>");

                    ajaxRequest.send(formData);
                }
            }
        });
	</script>
