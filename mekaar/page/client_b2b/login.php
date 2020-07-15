<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<title>Login | BIRU</title>

	<!--=== CSS ===-->

	<!-- Bootstrap -->
	<link href="<?=getUrlServer()?>/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=getUrlServer()?>/bootstrap/css/v4-margin-padding-bootstrap.min.css" rel="stylesheet" type="text/css" />

	<!-- Theme -->
	<link href="<?=getUrlServer()?>/assets/css/main.css" rel="stylesheet" type="text/css" />
	<!-- <link href="<?=getUrlServer()?>/assets/css/plugins.css" rel="stylesheet" type="text/css" /> -->
	<!-- <link href="<?=getUrlServer()?>/assets/css/responsive.css" rel="stylesheet" type="text/css" /> -->
	<!-- <link href="<?=getUrlServer()?>/assets/css/icons.css" rel="stylesheet" type="text/css" /> -->

	<!-- Login -->
	<link href="<?=getUrlServer()?>/assets/css/login.css" rel="stylesheet" type="text/css" />

	<link rel="stylesheet" href="<?=getUrlServer()?>/assets/css/fontawesome/font-awesome.min.css">
	<!--[if IE 7]>
		<link rel="stylesheet" href="<?=getUrlServer()?>/assets/css/fontawesome/font-awesome-ie7.min.css">
	<![endif]-->

	<!--[if IE 8]>
		<link href="<?=getUrlServer()?>/assets/css/ie8.css" rel="stylesheet" type="text/css" />
	<![endif]-->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>

	<!--=== JavaScript ===-->

	<script type="text/javascript" src="<?=getUrlServer()?>/assets/js/libs/jquery-1.10.2.min.js"></script>

	<script type="text/javascript" src="<?=getUrlServer()?>/bootstrap/js/bootstrap.min.js"></script>
	<!-- <script type="text/javascript" src="<?=getUrlServer()?>/assets/js/libs/lodash.compat.min.js"></script> -->

	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
		<script src="<?=getUrlServer()?>/assets/js/libs/html5shiv.js"></script>
	<![endif]-->

	<!-- Beautiful Notify -->
	<script type="text/javascript" src="<?=getUrlServer()?>/plugins/noty/noty.min.js"></script>
	<link rel="stylesheet" href="<?=getUrlServer()?>/plugins/noty/noty.css">

	<!-- Beautiful Checkboxes -->
	<script type="text/javascript" src="<?=getUrlServer()?>/plugins/uniform/jquery.uniform.min.js"></script>

	<!-- Form Validation -->
	<script type="text/javascript" src="<?=getUrlServer()?>/plugins/validation/jquery.validate.min.js"></script>

	<!-- Slim Progress Bars -->
	<script type="text/javascript" src="<?=getUrlServer()?>/plugins/nprogress/nprogress.js"></script>
	<script type="text/javascript" src="<?=getUrlServer()?>/plugins/blockui/jquery.blockUI.min.js"></script>
	<script>
		$(document).ready(function(){
			"use strict";
			Noty.setMaxVisible(5) //global queue's max visible amount (default is 5)
    		Noty.setMaxVisible(5, 'bottomRight')

			Noty.overrideDefaults({
				layout: 'topRight',
				theme: 'nest',
				closeWith: ['click'],
				timeout: 10000,
				force: true,
				animation: {
			//        open: mojsOpenExample,
			//        close: mojsCloseExample
				}
			});
			// Click on "Forgot Password?" link
			$('.forgot-password-link').click(function (e)
			{
				e.preventDefault(); // Prevent redirect to #

				$('.forgot-password-form').slideToggle(200);
				$('.inner-box .close').fadeToggle(200);
			});

			// Click on close-button
			$('.inner-box .close').click(function ()
			{
				// Emulate click on forgot password link
				// to reduce redundancy
				$('.forgot-password-link').click();
			});
		});
		$(document).ready(function(){
			// Wrapper function to block elements (indicate loading)
			function blockUI(el, centerY)
			{
				var el = $(el);
				el.block({
					message: '<img src="<?=getUrlServer()?>/assets/img/loading.gif" alt="">',
					centerY: centerY != undefined ? centerY : true,
					css: {
						top: "10%",
						border: "none",
						padding: "2px",
						backgroundColor: "none"
					},
					overlayCSS: {
						backgroundColor: "#000",
						opacity: 0.05,
						cursor: "wait"
					}
				});
			}

			// Wrapper function to unblock elements (finish loading)
			function unblockUI(el)
			{
				$(el).unblock({
					onUnblock: function ()
					{
						$(el).removeAttr("style");
					}
				});
			}
			function resetPass(){
				blockUI($(".login"));
				let ajaxRequest;
				let email = document.getElementById("resetEmail").value;
				<?php $token = (empty($_SESSION['token_reset'])) ? $_SESSION['token_reset'] = bin2hex(random_bytes(32)) : $_SESSION['token_reset'];?>
				let formData = new FormData();
				formData.set("token","<?=$token?>");
				formData.set("email",email);
				formData.set("type","reset_password");
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
						unblockUI($(".login"));
						console.log(ajaxRequest.responseText);
						try{
							let JSONObject = JSON.parse(ajaxRequest.responseText);
							if(JSONObject[0] != false){
								new Noty({
									text   : JSONObject.pesan,
									type   : 'alert',
									timeout: 5000
								}).show();
							}else{
								if(JSONObject['err']==1){
									let ex=new Noty({
										text   : JSONObject.pesan,
										type   : 'error',
										timeout: false,
										buttons: [
											Noty.button(JSONObject.btnText, 'btn btn-success', function () {
												window.location = JSONObject.url
											}, {id: 'button1', 'data-status': 'ok'}),
											Noty.button('CLose', 'btn btn-error', function () {
												ex.close();
											})
										]
									}).show()
								}else{
									new Noty({
										text   : JSONObject.pesan,
										type   : 'error',
										timeout: 5000
									}).show();
								}
							}
						}catch(e){
							new Noty({
								text   : "Gagal, respon tidak sesuai",
								type   : 'alert',
								timeout: 2000
							}).show();
						}
					}
				}
				ajaxRequest.open("POST", "<?=getUrlServer()?>/auth.php", true);
				ajaxRequest.send(formData);
			};

			function masuk(){
				let email = document.getElementById("username").value;
				let pass = document.getElementById("password").value;
				blockUI($(".login"));
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
						unblockUI($(".login"));
						try{
							let JSONObject = JSON.parse(ajaxRequest.responseText);
							if(JSONObject[0] != false){
								new Noty({
									text   : JSONObject.pesan,
									type   : 'alert',
									timeout: 5000
								}).show();
								window.location = JSONObject.redirect;
							}else{
								new Noty({
									text   : JSONObject.pesan,
									type   : 'alert',
									timeout: 1000
								}).show();
							}
						}catch(e){
							console.log(ajaxRequest.responseText);
							new Noty({
								text   : "Gagal login, respon tidak sesuai",
								type   : 'error',
								timeout: 5000
							}).show();
						}
					}
				}
				<?php $token = (empty($_SESSION['token_login'])) ? $_SESSION['token_login'] = bin2hex(random_bytes(32)) : $_SESSION['token_login'];?>
				let formData = new FormData();
				formData.set("token","<?=$token?>");
				formData.set("email",email);
				formData.set("pass",pass);
				formData.set("type","login");
				if(document.getElementById("remember").checked){
					formData.set("remember",true);
				}
				ajaxRequest.open("POST", "<?=getUrlServer()?>/auth.php", true);
				ajaxRequest.send(formData);
			}

			$('.login-form').on('submit',function(e){
				e.preventDefault();
				masuk();
			})
			$('.forgot-password-form').on('submit',function(e){
				e.preventDefault();
				resetPass();
			})
		});
	</script>
</head>
<body class="login row-flex m-0">
	<!-- Header -->
	<div class="col-md-6 col-12 login-left-box bg-blue row-flex m-0">
		<div class="blok">
		<h2 style="
    color: #fff;
    margin-bottom: 40px;
    text-align: center;padding: 0;
    font-size: 2.6em;
">DCA Earthquake</h2>
			<div class="panel">
				<div class="img">
					<img src="<?=getUrlServer()?>/assets/img/1_pkm_mekaar.png"/>
				</div>
				<h3 class="title">
					PNM Mekaar
					<!-- <p>Layanan pinjaman modal untuk perempuan prasejahtera pelaku usaha Ultra mikro</p> -->
				</h3>
			</div>
			<div class="panel">
				<div class="img">
				<img src="<?=getUrlServer()?>/assets/img/2_askrindo_syariah.png"/>
				</div>
				<h3 class="title">
					Askrindo Syariah
					<!-- <p>Perusahaan penjamin pembiayaan berbasis syariah</p> -->
				</h3>
			</div>
			<div class="panel">
				<div class="img">
				<img src="<?=getUrlServer()?>/assets/img/3_swiss-re-reinsurance.png"/>
				</div>
				<h3 class="title">
					Swiss Re Retakaful
				</h3>
			</div>
			<div class="panel">
				<div class="img">
				<img src="<?=getUrlServer()?>/assets/img/4_biru.png" width="35px"/>
				</div>
				<h3 class="title">
					Biru
				</h3>
			</div>
		</div>
		<div class="bg"></div>
	</div>
	<div class="col-md-6 col-12 login-right-box">
		<!-- Login Box -->
		<div class="box">
			<div class="content">
				<!-- Login Formular -->
				<form class="form-vertical login-form" action="#" method="post">
					<!-- Title -->
					<h3 class="form-title">Hi, Silahkan Login</h3>
					<!-- Error Message -->
					<div class="alert fade in alert-danger" style="display: none;">
						<i class="icon-remove close" data-dismiss="alert"></i>
						Masukkan username dan password.
					</div>
					<!-- Input Fields -->
					<div class="form-group">
						<label for="username">Email / No Hp / Username</label>
						<div class="input-icon">
							<i class="icon-user"></i>
							<input type="text" name="username" id ="username" class="form-control col-12" placeholder="Email / No Hp / Username" autofocus="autofocus" data-rule-required="true" data-msg-required="Please enter your Email / No Hp / Username." />
						</div>
					</div>
					<div class="form-group">
						<label for="password">Password:</label>
						<div class="input-icon">
							<i class="icon-lock"></i>
							<input type="password" name="password" id="password" class="form-control col-12" placeholder="Password" data-rule-required="true" data-msg-required="Please enter your password." />
						</div>
					</div>
					<!--<form class="form-horizontal row-border" action="#">
					<div class="form-group">
						<label class="control-label pull-left">Key File Security</label>
						<input type="file" data-style="fileinput">
					</div>-->
					<!-- /Input Fields -->
					<!-- Form Actions -->
					<div class="form-actions">
						<label class="checkbox pull-left"><input id="remember" type="checkbox" class="uniform" name="remember"> Remember me</label>
						<button type="submit" class="submit btn btn-primary pull-right">
							Sign In <i class="icon-angle-right"></i>
						</button>
					</div>
				</form>
				<!-- /Login Formular -->
			</div> <!-- /.content -->

			<!-- Forgot Password Form -->
			<div class="inner-box">
				<div class="content">
					<!-- Close Button -->
					<i class="icon-remove close hide-default"></i>

					<!-- Link as Toggle Button -->
					<a href="#" class="forgot-password-link">Lupa Password?</a>

					<!-- Forgot Password Formular action="login.html" -->
					<form class="form-vertical forgot-password-form hide-default"  method="post">
						<!-- Input Fields -->
						<div class="form-group">
							<!--<label for="email">Email:</label>-->
							<div class="input-icon">
								<i class="icon-envelope"></i>
								<input id="resetEmail" type="text" name="email" class="form-control col-12" placeholder="Enter email address" data-rule-required="true" data-rule-email="true" data-msg-required="Please enter your email." />
							</div>
						</div>
						<!-- /Input Fields -->

						<button type="submit" class="submit btn btn-default btn-block">
							Reset your Password
						</button>
					</form>
					<!-- /Forgot Password Formular -->

					<!-- Shows up if reset-button was clicked -->
					<div class="forgot-password-done hide-default">
						<i class="icon-ok success-icon"></i> <!-- Error-Alternative: <i class="icon-remove danger-icon"></i> -->
						<span>Bagus. Kami sudah kirimkan konfirmasi ke email anda.</span>
					</div>
				</div> <!-- /.content -->
			</div>
			<!-- /Forgot Password Form -->
		</div>
		<!-- /Login Box -->

		<!-- /Footer -->
	</div>