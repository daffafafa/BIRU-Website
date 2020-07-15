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
							<a href="./?p=zona" >Zona</a>
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
                <link rel="stylesheet" type="text/css" href="<?=getUrlServer()?>/assets/template/ContactFrom_v5/vendor/select2/css/select2.min.css">
				<link rel="stylesheet" type="text/css" href="<?=getUrlServer()?>/assets/template/ContactFrom_v5/fonts/iconic/css/material-design-iconic-font.min.css">
				<link rel="stylesheet" type="text/css" href="<?=getUrlServer()?>/assets/template/ContactFrom_v5/css/util.css">
				<link rel="stylesheet" type="text/css" href="<?=getUrlServer()?>/assets/template/ContactFrom_v5/css/main.css">
                <style>
                    h3{margin-top: 0;width: 100%;font-weight: 500;}
                    .pbb0{display:block;font-size:24px}
                    .pbb3{width:calc(20% - 20px)}.pbb4{width:calc(80% - 30px)}
                    .pbb{display:inline;height:40px;font-size:18px !important;color:#555555;font-weight:bold}
                    .hvr{border: 1px solid #ccc;}</style>
				<script src="<?=getUrlServer()?>/assets/template/ContactFrom_v5/js/main.js"></script>
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
                    <form id="form" class="contact100-form form-horizontal validate-form">
                    <div class="wrap-input100 validate-input input100-select bg1 rs1-wrap-input100 " data-validate="Silakan Pilih Provinsi">
                            <span class="label-input100">Provinsi</span>
                            <div>
                                <select required  id="provinsi" name="provinsi" class="js-select2">
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>
                        </div>
                        <div class="wrap-input100 validate-input input100-select bg1 rs1-wrap-input100 " data-validate="Silakan Pilih Kabupaten/Kota">
                            <span class="label-input100">Kabupaten/Kota</span>
                            <div>
                                <select id="kabupaten" name="kabupaten" class="js-select2">
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>
                        </div>
                        <div class="wrap-input100 validate-input input100-select bg1 rs1-wrap-input100 " data-validate="Silakan Pilih Kecamatan">
                            <span class="label-input100">Kecamatan</span>
                            <div>
                                <select id="kecamatan" name="kecamatan" class="js-select2">
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>
                        </div>
                        <div class="wrap-input100 validate-input input100-select bg1 rs1-wrap-input100 " data-validate="Silakan Pilih Kelurahan/Desa">
                            <span class="label-input100">Kelurahan/Desa</span>
                            <div>
                                <select id="kelurahan" name="kelurahan" class="js-select2">
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>
                        </div>
                        <div class="wrap-input100 bg1 rs1-wrap-input100" data-validate="Silakan Masukkan Resiko Gempa">
                            <span class="label-input100">Resiko Gempa</span>
                            <input type="text" id="resiko" name="resiko" value="<?=$data['zonasi']?>" placeholder="isi resiko gempa" class="input100" required>
                        </div>
                        <div class="wrap-input100 bg1 rs1-wrap-input100" data-validate="Silakan Masukkan Kode Pos Lokasi">
                            <span class="label-input100">Kode Pos</span>
                            <input type="text" id="pos" name="pos" value="<?=$data['pos']?>" placeholder="isi kode pos" class="input100">
                        </div>
                        <div class="container-contact100-form-btn">
                            <a href="./?p=zona" class="contact100-form-btn">Kembali</a>
                            <button type="submit" class="contact100-form-btn" id="simpan">
                                <span>
                                    Simpan
                                    <i class="icon-angle-right"></i>
                                </span>
                            </button>
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
            ambilData2('#provinsi','<?=$data['Prov']?>',1);
            ambilData2('#kabupaten','<?=$data['Kab']?>',2);
            ambilData2('#kecamatan','<?=$data['Kec']?>',3);
            ambilData2('#kelurahan','<?=$data['Kel']?>',4);
            $('#provinsi').on('change',function(){
                $('#kabupaten').children().remove();
                $('#kecamatan').children().remove();
                $('#kelurahan').children().remove();
                ambilData('#kabupaten',$(this).val());
            });
            $('#kabupaten').on('change',function(){
                $('#kecamatan').children().remove();
                $('#kelurahan').children().remove();
                ambilData('#kecamatan',$(this).val());
            });
            $('#kecamatan').on('change',function(){
                $('#kelurahan').children().remove();
                ambilData('#kelurahan',$(this).val());
            });
            $('#kelurahan').on('change',function(d){
                $('#resiko').val($(this)[0].selectedOptions[0].attributes.zona.value);
            });
            $('#form').on('submit',function(e){
                event.preventDefault();
                let input = $('.validate-input .input100');
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
            function ambilData(obj,id=''){
                let a=obj.replace('#','');
                $(obj).children().remove();
                $(obj).append('<option selected disabled>Loading...</option>');
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
                        //console.log(ajaxRequest.responseText);
                        $(obj).children().remove();
                        let JSONObject = JSON.parse(ajaxRequest.responseText);
                        if(JSONObject != false)
                        {
                            if(a=='kelurahan'|| a=='kecamatan'||a=='kabupaten'){
                                $(obj).append('<option selected  value="all">Semua '+a+'</option>');
                            }else{
                                $(obj).append('<option selected disabled>Pilih '+a+'</option>');
                            }
                            JSONObject.forEach(function(data){
                                let text,str='';
                                if(a=='kelurahan'|| a=='kecamatan'||a=='kabupaten'){
                                    str = str + '" zona="'+data.zona+'" pos="'+data.pos+'"';
                                    text = data.nama + '(' + data.zona + ')'
                                }else{
                                    text = data.nama ;
                                }
                                $(obj).append('<option value="'+data.id+'" '+ str +' >'+text+'</option>')
                            });
                        }else{
                            $(obj).append('<option selected disabled>Tidak ada '+a+'</option>');
                        }
                    }
                }
                if(id==''){
                    ajaxRequest.open("GET", "./ambil_data.php?type=provinsi", true);
                }else{
                    ajaxRequest.open("GET", "./ambil_data.php?type="+a+"&id="+id, true);
                }
                ajaxRequest.send(null);
            }
            function ambilData2(obj,id,lvl){
                let a=obj.replace('#','');
                $(obj).children().remove();
                $(obj).append('<option selected disabled>Loading...</option>');
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
                        var JSONObject = JSON.parse(ajaxRequest.responseText);
                        $(obj).children().remove();
                        if(JSONObject != false)
                        {
                            if(a=='kelurahan'|| a=='kecamatan'||a=='kabupaten'){
                                $(obj).append('<option selected value="all">Semua '+a+'</option>');
                            }else{
                                $(obj).append('<option selected disabled>Pilih '+a+'</option>');
                            }
                            JSONObject.forEach(function(data){
                                let text,str='';
                                if(a=='kelurahan'|| a=='kecamatan'||a=='kabupaten'){
                                    str = str + '" zona="'+data.zona+'" pos="'+data.pos+'"';
                                    text = data.nama + '(' + data.zona + ')'
                                }else{
                                    text = data.nama ;
                                }
                                $(obj).append('<option '+(data.id==id?'selected':null)+' value="'+data.id+'" '+ str +' >'+text+'</option>')
                            });
                        }else{
                            $(obj).append('<option selected disabled>Tidak ada '+a+'</option>');
                        }
                    }
                }
                if(id != ''){
                    ajaxRequest.open("GET", "./ambil_data.php?lvl="+lvl+"&type=get_"+a+"&id="+id, true);
                }
                ajaxRequest.send(null);
            }

            /*==================================================================
						[ Validate after type ]*/
						$('.validate-input .input100').each(function(){
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
						$('.validate-form .input100').each(function(){
							$(this).focus(function(){
							hideValidate(this);
							$(this).parent().removeClass('true-validate');
							});
						});
						function validate (input) {
							if($(input).val().trim() == ''){
                                return false;
                            }
						}
						function showValidate(input) {
							var thisAlert = $(input).parent();

							$(thisAlert).addClass('has-error has-feedback');
							$(thisAlert).append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>')
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
                            console.log(ajaxRequest.responseText);
                            var JSONObject = JSON.parse(ajaxRequest.responseText);
                            if(JSONObject[0] != false)
                            {
                                alert(JSONObject.pesan);
                                window.location = "./?p=zona";
                            }else{
                                alert(JSONObject.pesan);
                            }
                        }
                        App.unblockUI($("#content"));
                    }
                    ajaxRequest.open("POST", "./simpan.php", true);
                    

                    

                    var formElement = document.getElementById("form");
                    var formData = new FormData(formElement);
                    formData.set("type","zona_tambah");
                    <?php $token = (empty($_SESSION['token'])) ? $_SESSION['token'] = bin2hex(random_bytes(32)) : $_SESSION['token'];?>
                    formData.set("token","<?=$token?>");

                    ajaxRequest.send(formData);
                }
            }
        });
	</script>
