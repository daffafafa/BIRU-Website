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
							<a href="#" class="kembali" title="">Sektor Usaha</a>
						</li>
						<li class="current">
							<a href="#" title="">Ubah</a>
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
				<div class="row" style="margin-bottom:20px">
					<div class="col-md-12">
                        <form id="form">
                            <div class="widget box">
                                <div class="widget-header">
                                    <h4><i class="icon-reorder"></i> Ubah Data Perusahaan</h4>
                                    <div class="toolbar no-padding">
                                        <div class="btn-group">
                                            <button type="reset" class="btn btn-xs" id="form-reset"><i class="icon-reorder"></i>Reset Form</button>
                                            <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                                        </div>
                                    </div>
                                </div>
							    <div  class="widget-content ">
                                    <div class="form-group">
                                        <label for="kode"> KODE SEKTOR USAHA</label>
                                        <input type="text" readonly id="kode" name="kode" autocomplete="off"class="form-control disabled" required value="<?=($data['SUSA_ID'])?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">NAMA</label>
                                        <input type="text" id="nama" name="nama" class="form-control" required value="<?=($data['SUSA_NAMA'])?>">
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-warning kembali">Kembali</button>
                            <button type="submit" class="btn btn-primary" id="simpan">
                                Simpan <i class="icon-angle-right"></i>
                            </button>
                        </form>
					</div>
				</div>
				<?php include "footer.php";?>

				<!-- /Page Content -->
			</div>
		</div>
	</div>
    <script>
		$(document).ready(function(){
            $('.kembali').on('click',function(){
				history.back();
			});
            $('#form').on('submit',function(e){
                event.preventDefault()
                simpan();
            })
            function simpan(){
                if(confirm("Simpan Data?")){
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
                    
                    var formElement = document.getElementById("form");
                    var formData = new FormData(formElement);
                    formData.set("prod","<?=$_GET['id']?>");
                    formData.set("type","sektor_usaha_ubah");
                    <?php
$token = (empty($_SESSION['token'])) ? $_SESSION['token']=bin2hex(random_bytes(32)) : $_SESSION['token'];
?>
                    formData.set("token","<?=$token?>");

                    ajaxRequest.send(formData);
                }
            }
        });
	</script>
