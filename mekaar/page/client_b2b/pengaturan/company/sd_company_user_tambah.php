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
                        <li >
							<a href="./?p=user_company&key=<?=$_GET['key']?>" title="">Daftar User</a>
						</li>
						<li class="current">
							<a href="#" title="">Tambah</a>
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

                <!-- /style form -->
                <link rel="stylesheet" type="text/css" href="<?=getUrlServer()?>/assets/template/ContactFrom_v5/vendor/select2/css/select2.min.css">
				<link rel="stylesheet" type="text/css" href="<?=getUrlServer()?>/assets/template/ContactFrom_v5/fonts/iconic/css/material-design-iconic-font.min.css">
				<link rel="stylesheet" type="text/css" href="<?=getUrlServer()?>/assets/template/ContactFrom_v5/css/util.css">
				<link rel="stylesheet" type="text/css" href="<?=getUrlServer()?>/assets/template/ContactFrom_v5/css/main.css">
               
				<script src="<?=getUrlServer()?>/assets/template/ContactFrom_v5/js/main.js"></script>
				<script type="text/javascript" src="<?=getUrlServer()?>/assets/template/ContactFrom_v5/vendor/select2/js/select2.min.js"></script>

				<!--=== Page Content ===-->
				<div class="row" style="margin-bottom:20px;">
                    <form id="form" class="contact100-form form-horizontal validate-form">
                        <div class="wrap-input100 validate-input bg1 rs2-wrap-input100" data-validate="Silakan Masukkan Username">
                            <span class="label-input100">Username</span>
                            <input type="text" id="username" name="username" placeholder="isi username" class="input100" required>
                        </div>
                        <div class="wrap-input100 validate-input bg1 rs2-wrap-input100 rs2-offset" data-validate="Silakan Masukkan Email">
                            <span class="label-input100">Email</span>
                            <input type="email" id="email" name="email" placeholder="isi email" class="input100" required>
                        </div>
                        <div class="wrap-input100 validate-input bg1 rs2-wrap-input100" data-validate="Silakan Masukkan Password">
                            <span class="label-input100">Password</span>
                            <input type="password" id="password" name="password" placeholder="isi password" class="input100" required>
                        </div>
                        <div class="wrap-input100 validate-input bg1 rs2-wrap-input100 rs2-offset" data-validate="Silakan Masukkan Confirm Password">
                            <span class="label-input100">Confirm Password</span>
                            <input type="password" id="password2" name="password2" placeholder="isi ulang password" class="input100" required>
                        </div>
                        <?php 
                        if(has_permission('update_right_management_user_perusahaan')){
                            $query = mysqli_query($conection, 'SELECT id,title FROM permissions WHERE id NOT IN (16,17,18,19) AND dinamis != 1 '); 
                            $dataPermissions = mysqli_fetch_all($query, MYSQLI_ASSOC);
                        ?> 
                            <div class="wrap-input100 validate-input input100-select bg1" data-validate="Silakan Pilih Permission">
                                <span class="label-input100">Permission</span>
                                <div>
                                    <select class="js-select2" require multiple id="permission" name="permission[]" placeholder="<?=((count($dataPermissions) > 0)?'Pilih Permission':'Tidak ada data permission')?>">
                                        <?php foreach($dataPermissions as $row) {?>
                                            <option value="<?=$row['id']?>"><?=$row['title']?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>
                            </div>
                        <?php }?>
                        <div class="container-contact100-form-btn">
                            <a href="./?p=user_company&key=<?=$_GET['key']?>" class="contact100-form-btn btn btn-warning ">Kembali</a>
                            <button value="SEND" type="submit" class="contact100-form-btn">
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
        var obj;
        $(document).ready(function(){
            $(".js-select2").each(function(){
                $(this).select2({
                    minimumResultsForSearch: 2,
                    dropdownParent: $(this).next('.dropDownSelect2')
                });
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
                let pas1 = document.getElementById("password").value;
                let pas2 = document.getElementById("password2").value;
                if(pas1 != pas2){
                    new Noty({
                        text   : "Password dengan confirm password tidak sama",
                        type   : 'alert',
                        timeout: 2000
                    }).show();
                    return false;
                }
                
                simpan();
            });
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
                                window.location = "./?p=user_company&key=<?=$_GET['key']?>";
                            }else{
                                alert(JSONObject.pesan);
                            }
                        }
                    }
                    ajaxRequest.open("POST", "./simpan.php", true);
                    
                    var formElement = document.getElementById("form");
                    var formData = new FormData(formElement);
				    formData.set("company","<?=$_GET['key']?>");
                    formData.set("type","company_user_tambah");
                    <?php $token = (empty($_SESSION['token'])) ? $_SESSION['token'] = bin2hex(random_bytes(32)) : $_SESSION['token']; ?>
                    formData.set("token","<?=$token?>");

                    ajaxRequest.send(formData);
                }
            }
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
                var input = $('.validate-input > input');

                $('.validate-form').on('submit',function(){
                    var check = true;

                    for(var i=0; i<input.length; i++) {
                        if(validate(input[i]) == false){
                            showValidate(input[i]);
                            check=false;
                        }
                    }
                    return check;
                });
                $('.validate-form input').each(function(){
                    $(this).focus(function(){
                    hideValidate(this);
                    $(this).parent().removeClass('true-validate');
                    });
                });
                function validate (input) {
                    if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') 
                    {
                        if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) 
                        {
                            return false;
                        }
                    
                    }
                    else if($(input).val().trim() == '')
                    {
                        return false;
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
        });
	</script>
