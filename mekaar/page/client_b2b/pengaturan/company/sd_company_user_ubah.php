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

                <!-- /style form -->
                <link rel="stylesheet" type="text/css" href="<?=getUrlServer()?>/assets/template/ContactFrom_v5/vendor/select2/css/select2.min.css">
				<script type="text/javascript" src="<?=getUrlServer()?>/assets/template/ContactFrom_v5/vendor/select2/js/select2.min.js"></script>

				<!--=== Page Content ===-->
                <div class="row" style="margin-bottom:20px;">
                    <form id="form2" class="form-inline validate-form" method="post">
                        <div class="panel">
                            <div class="panel-heading">
                               <h2>Form Ubah Password</h2>
                            </div>
                            <div class="panel-body row-flex align-items-end">
                                <div class="col-4 validate-input" data-validate="Silakan Masukkan Password">
                                    <label class="col-12">Password Baru</label>
                                    <input required type="password" class="form-control col-12" id="password" name="password" >
                                </div>
                                <div class="col-4 validate-input" data-validate="Silakan Masukkan Password" >
                                    <label class="col-12">Tulis Ulang Password Baru</label>
                                    <input required type="password" class="form-control col-12" id="password2" name="password2" >
                                </div>
                                <div class="">
                                    <a href="./?p=company" class="btn btn-lg btn-warning ">Kembali</a>
                                    <button value="SEND" type="submit" class="btn btn-lg btn-primary">
                                        <span>
                                            Simpan
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form id="form" class="form-inline validate-form" method="post">
                        <div class="panel">
                            <div class="panel-heading">
                               <h2>Form Ubah Data</h2>
                            </div>
                            <div class="panel-body row-flex">
                                <div class="validate-input col-4" data-validate="Silakan Masukkan Username">
                                    <label class="col-12">Username</label>
                                    <input type="text" id="username" name="username" placeholder="Username" class="form-control col-12" value="<?=$user['CLI_USER_ID']?>" disabled>
                                </div>
                                <div class="validate-input col-4" data-validate="Silakan Masukkan Email (e@a.x)">
                                    <label class="col-12">Email</label>
                                    <input type="email" id="email" name="email" placeholder="Email" class="form-control col-12" value="<?=$user['CLI_EMAIL']?>" required>
                                </div>
                                <?php 
                                if(has_permission('update_right_management_user_perusahaan')){
                                    $query = mysqli_query($conection, 'SELECT id,title FROM permissions WHERE id NOT IN (16,17,18,19) AND dinamis != 1 '); 
                                    $dataPermissions = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                    $user_permission = explode(',',$user['permission_id']);
                                    $selected_permission = count($user_permission) <= 1 ? array($user['permission_id']) : $user_permission;
                                ?> 
                                <div class="row-flex mt-sm-4 input100-select col-12" data-validate="Silakan Pilih Permission">
                                    <label class="col-12">Permission</label>
                                    <div class="col-12">
                                        <select class="js-select2" require multiple id="permission" name="permission[]" placeholder="<?=((count($dataPermissions) > 0)?'Pilih Permission':'Tidak ada data permission')?>">
                                            <?php foreach($dataPermissions as $row) {?>
                                                <option value="<?=$row['id']?>" <?=in_array($row['id'], $selected_permission)?'selected':''?> ><?=$row['title']?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                                <?php }?>
                                <div class="mt-sm-4 col-12">
                                    <button type="button" class="kembali btn btn-lg btn-warning ">Kembali</button>
                                    <button value="SEND" type="submit" class="btn btn-lg btn-primary">
                                        <span>
                                            Simpan
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
        var obj;
        $(document).ready(function(){
            $('.kembali').on('click',function(){
                history.back();
            });
            $(".js-select2").each(function(){
                $(this).select2({
                    minimumResultsForSearch: 2,
                    dropdownParent: $(this).next('.dropDownSelect2')
                });
            });
            $('#form2').on('submit',function(e){
                event.preventDefault();
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
                simpan('form2','ubah_pass');
            });
            $('#form').on('submit',function(e){
                event.preventDefault();
                let input = $('#form').find('.validate-input > input');
                console.log(input);
                let check = true;

                for(let i=0; i<input.length; i++) {
                    if(validate(input[i]) == false){
                        showValidate(input[i]);
                        check=false;
                    }
                }
                if(!check) return check;
                
                simpan('form','ubah');
            });
            function simpan(form,tipe){
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
                    
                    var formElement = document.getElementById(form);
                    var formData = new FormData(formElement);
				    formData.set("company","<?=$_GET['key']?>");
                    formData.set("type","company_user_" + tipe);
				    formData.set("id2","<?=$_GET['id2']?>");
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
