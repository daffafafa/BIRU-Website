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
                        <span style="line-height: 50px;vertical-align: bottom;">BIRU </label>
                        <!-- <span style="font-size:10px;line-height: 40px;vertical-align: bottom;">(Client B2B)</label> -->
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
                        <span class="badge badge-danger"></label>
                    </label>
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
						<!--li>
							<i class="icon-home"></i>
							<a href="index.php">Dasbor</a>
						</li>
						<li>
							<a href="#" title="">...</a>
                        </li-->
                        <li>
                            <a href="#" title="">Pengaturan</a>
                        </li>
                        <li>
							<a href="./?p=company" title="">Perusahaan Management</a>
						</li>
						<li class="current">
							<a href="#" title="">Tambah</a>
						</li>
					</ul>

					<ul class="crumb-buttons">
						<!-- <li><a href="charts.html" title=""><i class="icon-signal"></i><span>Statistics</label></a></li> -->
						<?php include "crumb.php"; ?>
						<!-- <li class="range"><a href="#">
							<i class="icon-calendar"></i>
							<span></label>
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
                <link rel="stylesheet" type="text/css" href="<?=getUrlServer()?>/assets/template/ContactFrom_v5/vendor/select2/css/select2.min.css">
				<script type="text/javascript" src="<?=getUrlServer()?>/assets/template/ContactFrom_v5/vendor/select2/js/select2.min.js"></script>
				<script>
					$(document).ready(function(){
						$(".js-select2").each(function(){
							$(this).select2({
								minimumResultsForSearch: 2,
								dropdownParent: $(this).next('.dropDownSelect2')
							});
						});
					});
                </script>
                <div class="row">
                    <form id="form" class="form-inline validate-form" method="post">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="validate-input col-12 row-flex mt-sm-4" data-validate = "Silakan Masukkan Kode Perusahaan">
                                    <label for="kode" class="col-lg-4 col-md-5 col-sm-5 col-xs-12 p-0">Kode Perusahaan</label>
                                    <input type="text" id="kode" name="kode" class="form-control col-lg-5 col-md-6 col-sm-7 col-xs-12" required value="">
                                </div>
                                <div class="validate-input col-12 row-flex mt-sm-4" data-validate = "Silakan Masukkan Tanggal Join">
                                    <label for="join" class="col-lg-4 col-md-5 col-sm-5 col-xs-12 p-0">Tanggal Join</label>
                                    <input type="date" id="join" name="join" class="form-control col-lg-5 col-md-6 col-sm-7 col-xs-12" required value="<?=date('Y-m-d')?>">
                                </div>
                                <div class="row-flex mt-sm-4 validate-input col-12" data-validate = "Silakan Masukkan Tanggal Expiry">
                                    <label for="expiry" class="col-lg-4 col-md-5 col-sm-5 col-xs-12 p-0">Tanggal Expiry</label>
                                    <input type="date" id="expiry" name="expiry" class="form-control col-lg-5 col-md-6 col-sm-7 col-xs-12" required value="" min="<?=date('Y-m-d')?>">
                                </div>
                                <!-- <div class="row-flex mt-sm-4 input100-select col-12 ">
                                    <label for="entity_type" class="col-lg-4 col-md-5 col-sm-5 col-xs-12 p-0">Tipe Perusahaan</label>
                                    <div class="col-lg-5 col-md-6 col-sm-7 col-xs-12 p-0">
                                        <select class="js-select2" id="entity_type" name="entity_type">
                                            <option value="NULL" >Pilih Perusahaan</option>
                                            <option value="0" >Direct Broker</option>
                                            <option value="1" >Insurance</option>
                                            <option value="2" >Re Broker</option>
                                            <option value="3" >Re Insurance</option>
                                            <option value="4" >Client B2B</option>
                                            <option value="5" >3rd Party</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div> -->
                                <div class="row-flex mt-sm-4 validate-input col-12" data-validate = "Silakan Masukkan Nama">
                                    <label for="nama" class="col-lg-4 col-md-5 col-sm-5 col-xs-12 p-0">Nama</label>
                                    <input type="text" id="nama" name="nama" class="form-control col-lg-5 col-md-6 col-sm-7 col-xs-12" required value="">
                                </div>
                                <div class="row-flex mt-sm-4 validate-input col-12" data-validate = "Silakan Masukkan Email (e@a.x)">
                                    <label for="email" class="col-lg-4 col-md-5 col-sm-5 col-xs-12 p-0">Email *</label>
                                    <input class="form-control col-lg-5 col-md-6 col-sm-7 col-xs-12" type="text" id="email" name="email" required>
                                </div>
                                <div class="row-flex mt-sm-4 validate-input col-12" data-validate = "Silakan Masukkan Alamat">
                                    <label for="alamat" class="col-lg-4 col-md-5 col-sm-5 col-xs-12 p-0">Alamat</label>
                                    <textarea class="form-control col-lg-5 col-md-6 col-sm-7 col-xs-12" id="alamat" name="alamat" placeholder="isi alamat"></textarea>
                                </div>
                                <div class="row-flex mt-sm-4 validate-input col-12 " data-validate = "Silakan Masukkan PIC">
                                    <label for="pic" class="col-lg-4 col-md-5 col-sm-5 col-xs-12 p-0">PIC</label>
                                    <input type="text" id="pic" name="pic" class="form-control col-lg-5 col-md-6 col-sm-7 col-xs-12" required value="">
                                </div>
                                <div class="row-flex mt-sm-4 validate-input col-12 " data-validate = "Silakan Masukkan PIC Phone">
                                    <label for="phone" class="col-lg-4 col-md-5 col-sm-5 col-xs-12 p-0">PIC Phone</label>
                                    <input type="text" id="phone" name="phone" class="form-control col-lg-5 col-md-6 col-sm-7 col-xs-12" required value="">
                                </div>
                                <!-- <div class="row-flex mt-sm-4 validate-input col-12 " data-validate = "Silakan Masukkan Password">
                                    <label for="kode" class="col-lg-4 col-md-5 col-sm-5 col-xs-12 p-0">Password</label>
                                    <input type="password" id="pass" name="pass" class="form-control col-lg-5 col-md-6 col-sm-7 col-xs-12" required value="">
                                </div> -->
                                <div class="row-flex mt-sm-4 validate-input col-12" data-validate = "Silakan Masukkan NPWP">
                                    <label for="npwp" class="col-lg-4 col-md-5 col-sm-5 col-xs-12 p-0">NPWP</label>
                                    <input type="text" id="npwp" name="npwp" class="form-control col-lg-5 col-md-6 col-sm-7 col-xs-12" required value="">
                                </div>
                                <div class="row-flex mt-sm-4 validate-input col-12" data-validate = "Silakan Masukkan MOU">
                                    <label for="mou" class="col-lg-4 col-md-5 col-sm-5 col-xs-12 p-0">MOU</label>
                                    <input type="text" id="mou" name="mou" class="form-control col-lg-5 col-md-6 col-sm-7 col-xs-12" required value="">
                                </div>
                                <div class="row-flex mt-sm-4 input100-select col-12">
                                    <label for="status" class="col-lg-4 col-md-5 col-sm-5 col-xs-12 p-0">STATUS</label>
                                    <div class="col-lg-5 col-md-6 col-sm-7 col-xs-12 p-0">
                                        <select class="js-select2" id="status" name="status">
                                            <option selected value="0" >ACTIVE</option>
                                            <option value="1" >SUSPENDED</option>
                                            <option value="2" >CLOSED</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                                <div class="pull-right">
                                    <a href="./?p=company" class="btn btn-lg btn-warning ">Kembali</a>
                                    <button value="SEND" type="submit" class="btn btn-lg btn-primary">
                                        <span>
                                            Simpan
                                            <i class="icon-angle-right"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
				<?php include "footer.php";?>

				<!-- /Page Content -->
			</div>
		</div>
	</div>
    <script>
		$(document).ready(function(){
            $('#join').on('change',function(){
                $('#expiry').attr('min',this.value);
            });
            $('#expiry').on('change',function(){
                $('#join').attr('max',this.value);
            });
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
                //buatBlockchainAddress();
                simpan('','');
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
							$(thisAlert).append('<span class="glyphicon glyphicon-remove form-control-feedback btn-hide-validate"></label>')
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

            function simpan(addr,pvk){
                if(confirm("Simpan Data?")){
                    App.blockUI($("#content"));
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
                            App.unblockUI($("#content"));
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
                    
                    var formElement = document.getElementById("form");
                    var formData = new FormData(formElement);
                    formData.set("type","company_tambah");
                    formData.set("addr",addr);
                    formData.set("pvk",pvk);
                    <?php $token = (empty($_SESSION['token'])) ? $_SESSION['token'] = bin2hex(random_bytes(32)) : $_SESSION['token']; ?>
                    formData.set("token","<?=$token?>");

                    ajaxRequest.send(formData);
                }
            }
            function buatBlockchainAddress(){
                App.blockUI($("#content"));
                $.ajax({
                    url : "http://207.148.116.70:8801/prize2",
                    type: "get",
                    dataType:"json",
                    success:function(result){
                        console.log('Dengan Blockchain address')
			            simpan(result.err.address, result.err.privateKey);
                    },
                    error: function(xhr, Status, err) {
                        console.log('Tanpa Blockchain address')
			            simpan('', '');
                        // alert('Gagal meminta alamat blockchain!');
                        // App.unblockUI($("#content"));
                    }
                });
            }
        });
	</script>
