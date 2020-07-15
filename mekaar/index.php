<?php
if (!isset($_SESSION)) {
    session_start();
}
//include_once "contact.php";
require_once "fungsi.php";
// var_dump(isLoggedIn());
if ( ! isLoggedIn()) {
	include "./page/client_b2b/login.php";
	exit();
}

if (isAdmin()) {
	header("location: ./page/biru/");
} else if (isB2B()) {
	header("location: ./page/client_b2b/");
} else if (isB2C()) {
	//jika user belum aktif
	if ($_SESSION['user_cli_status'] == 0) {
		die("Akun Anda Belum Aktif, Silakan lakukan aktivasi akun anda dengan mengakses link yang dikirimkan ke email anda!");
	}
	header("location: ./page/client_b2c/");
} else {
	include "./page/client_b2b/login.php";
}
exit();
?>
<?php
if (empty($_SESSION['namauser'])) {
    //exit();
    header("Location: login.php");
} else {

    $addr = $_SESSION['address'];
    $nama = $_SESSION['user_cli_name'];
    $nom = $_SESSION['no'];
}
?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<title>Dashboard | BiRU</title>

	<!--=== CSS ===-->

	<!-- Bootstrap -->
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

	<!-- jQuery UI -->
	<!--<link href="plugins/jquery-ui/jquery-ui-1.10.2.custom.css" rel="stylesheet" type="text/css" />-->
	<!--[if lt IE 9]>
		<link rel="stylesheet" type="text/css" href="plugins/jquery-ui/jquery.ui.1.10.2.ie.css"/>
	<![endif]-->

	<!-- Theme -->
	<link href="assets/css/main.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/icons.css" rel="stylesheet" type="text/css" />

	<link rel="stylesheet" href="assets/css/fontawesome/font-awesome.min.css">
	<!--[if IE 7]>
		<link rel="stylesheet" href="assets/css/fontawesome/font-awesome-ie7.min.css">
	<![endif]-->

	<!--[if IE 8]>
		<link href="assets/css/ie8.css" rel="stylesheet" type="text/css" />
	<![endif]-->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>

	<!--=== JavaScript ===-->

	<script type="text/javascript" src="assets/js/libs/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>

	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/libs/lodash.compat.min.js"></script>

	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
		<script src="assets/js/libs/html5shiv.js"></script>
	<![endif]-->

	<!-- Smartphone Touch Events -->
	<script type="text/javascript" src="plugins/touchpunch/jquery.ui.touch-punch.min.js"></script>
	<script type="text/javascript" src="plugins/event.swipe/jquery.event.move.js"></script>
	<script type="text/javascript" src="plugins/event.swipe/jquery.event.swipe.js"></script>

	<!-- General -->
	<script type="text/javascript" src="assets/js/libs/breakpoints.js"></script>
	<script type="text/javascript" src="plugins/respond/respond.min.js"></script> <!-- Polyfill for min/max-width CSS3 Media Queries (only for IE8) -->
	<script type="text/javascript" src="plugins/cookie/jquery.cookie.min.js"></script>
	<script type="text/javascript" src="plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script type="text/javascript" src="plugins/slimscroll/jquery.slimscroll.horizontal.min.js"></script>

	<!-- Page specific plugins -->
	<!-- Charts -->
	<!--[if lt IE 9]>
		<script type="text/javascript" src="plugins/flot/excanvas.min.js"></script>
	<![endif]-->
	<script type="text/javascript" src="plugins/sparkline/jquery.sparkline.min.js"></script>
	<script type="text/javascript" src="plugins/flot/jquery.flot.min.js"></script>
	<script type="text/javascript" src="plugins/flot/jquery.flot.tooltip.min.js"></script>
	<script type="text/javascript" src="plugins/flot/jquery.flot.resize.min.js"></script>
	<script type="text/javascript" src="plugins/flot/jquery.flot.time.min.js"></script>
	<script type="text/javascript" src="plugins/flot/jquery.flot.growraf.min.js"></script>
	<script type="text/javascript" src="plugins/easy-pie-chart/jquery.easy-pie-chart.min.js"></script>

	<script type="text/javascript" src="plugins/daterangepicker/moment.min.js"></script>
	<script type="text/javascript" src="plugins/daterangepicker/daterangepicker.js"></script>
	<script type="text/javascript" src="plugins/blockui/jquery.blockUI.min.js"></script>

	<script type="text/javascript" src="plugins/fullcalendar/fullcalendar.min.js"></script>

	<!-- Noty -->
	<script type="text/javascript" src="plugins/noty/jquery.noty.js"></script>
	<script type="text/javascript" src="plugins/noty/layouts/top.js"></script>
	<script type="text/javascript" src="plugins/noty/themes/default.js"></script>

	<!-- Forms -->
	<script type="text/javascript" src="plugins/uniform/jquery.uniform.min.js"></script>
	<script type="text/javascript" src="plugins/select2/js/select2.min.js"></script>

	<!-- App -->
	<script type="text/javascript" src="assets/js/app.js"></script>
	<script type="text/javascript" src="assets/js/plugins.js"></script>
	<script type="text/javascript" src="assets/js/plugins.form-components.js"></script>

	<script>
		$(document).ready(function(){
			"use strict";

		App.init(); // Init layout and core plugins
		Plugins.init(); // Init all plugins
		FormComponents.init(); // Init all form-specific plugins
	});
</script>

<!-- Demo JS -->
<script type="text/javascript" src="assets/js/custom.js"></script>
<script type="text/javascript" src="assets/js/demo/pages_calendar.js"></script>
<script type="text/javascript" src="assets/js/demo/charts/chart_filled_yellow.js"></script>
<script type="text/javascript" src="assets/js/demo/charts/chart_simple.js"></script>

<!-- DataTables -->
<script type="text/javascript" src="plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="plugins/datatables/tabletools/TableTools.min.js"></script> <!-- optional -->
<script type="text/javascript" src="plugins/datatables/colvis/ColVis.min.js"></script> <!-- optional -->
<script type="text/javascript" src="plugins/datatables/DT_bootstrap.js"></script>



<script>


var nama =['','','','',''];
 var nopl =['','','','',''];
 var bru =['','','','',''];

 var namag =['','','','',''];
 var noplg =['','','','',''];
 var brug =['','','','',''];
 var kor1 =['','','','',''];
 var kor2 =['','','','',''];
 var brumax =['','','','',''];
 var statuse =['','','','',''];

 var address=['','','','',''];
 var txhash=['','','','',''];
 var bruc =['','','','',''];
 var dari =['','','','',''];
 var policy   =['','','','',''];
 var namac =['','','','',''];
 var claim =['','','','',''];
 var claimt;
 claimt=0;
 var namag;
 var alag;

 var jumlah=['','','','',''];
 var status=['','','','',''];
 var rupiah =['','','','',''];
 var insu="";






//document.getElementById("bru").onload = function() {test()};
window.onload = function() {
 checktok("<?php echo ($addr); ?>");
 gg("<?php echo ($nama); ?>");
}

 function checktok(addr)
{

var addr = addr;

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

        xxx = ajaxRequest.responseText;
        //alert(xxx);
         var obj = JSON.parse(xxx);
         var txh = obj.hasil;
         var dt1, dt2, blt;
         dt1 = txh/1000000000000000000;
         dt2=1000-dt1;
          blt= dt1.toFixed(6);
        //document.getElementById("bru").innerHTML = "BRU "+blt/1000000000000000000;
          document.getElementById("bru").innerHTML = "BRU "+blt;
                             }


	}

    ajaxRequest.open("GET", "http://207.148.116.70:8801/prize8?reqid="+addr, true);
	ajaxRequest.send(null);


}



function gg(nn)
{

insu = nn;
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
         var ii;
         var tb, tb2;
         tb="";
         ii=0;
        xxx = ajaxRequest.responseText;

        var JSONObject = JSON.parse(xxx);

                       nama[ii]='';
                       nopl[ii]= '';
                       bru[ii] = '';

         for (var key in JSONObject) {
                 if (JSONObject.hasOwnProperty(key)) {
                       console.log(JSONObject[key]["name"] + ", " + JSONObject[key]["nopolicy"]+", " + JSONObject[key]["bru"]  );
                       //ling = '"'+'bukaInfo('+'"'+JSONObject[ii]["name"]+'"'+','+JSONObject[ii]["nopolicy"]+','+JSONObject[ii]["bru"]+');'+'"';
                        ling = '"'+JSONObject[ii]["name"]+'"'+','+JSONObject[ii]["nopolicy"]+','+JSONObject[ii]["bru"];

                      nama[ii]=JSONObject[ii]["name"];
                      nopl[ii]= JSONObject[ii]["nopolicy"];
                      bru[ii] = JSONObject[ii]["bru"];

                      tb = tb+ '<tr><td>'+JSONObject[ii]["name"]+'</td><td>'+JSONObject[ii]["nopolicy"]+'</td><td>'+JSONObject[ii]["bru"]+'</td><td> <a href="#" onclick="bukaInfo('+ii+');"><i class="icon-cloud-download"></i>view</a> </td></tr>';
                       ii=ii+1;    }

                        tb2 =  '<thead><tr><th data-class="expand">Name</th><th>No Policy</th><th data-hide="phone">Premi BRU</th><th data-hide="phone,tablet">View</th></tr></thead>' ;
                                      }

          document.getElementById("ganti").innerHTML  ='<table class="table table-striped table-bordered table-hover table-responsive"><thead>'+tb2+'<tbody>'+tb+'</tbody></table>';
         // hapus();
                       }


	}

     ajaxRequest.open("GET", "policyin.php", true);
	ajaxRequest.send(null);
}

function gg2(nn)
{

insu = nn;
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
         var ii;
         var tb, tb2;
         tb="";
         ii=0;
        xxx = ajaxRequest.responseText;

        var JSONObject = JSON.parse(xxx);

                       nama[ii]='';
                       nopl[ii]= '';
                       bru[ii] = '';

         for (var key in JSONObject) {
                 if (JSONObject.hasOwnProperty(key)) {
                       console.log(JSONObject[key]["name"] + ", " + JSONObject[key]["nopolicy"]+", " + JSONObject[key]["bru"]  );
                       //ling = '"'+'bukaInfo('+'"'+JSONObject[ii]["name"]+'"'+','+JSONObject[ii]["nopolicy"]+','+JSONObject[ii]["bru"]+');'+'"';
                        ling = '"'+JSONObject[ii]["name"]+'"'+','+JSONObject[ii]["nopolicy"]+','+JSONObject[ii]["bru"];

                      nama[ii]=JSONObject[ii]["name"];
                      nopl[ii]= JSONObject[ii]["nopolicy"];
                      bru[ii] = JSONObject[ii]["bru"];

                      tb = tb+ '<tr><td>'+JSONObject[ii]["name"]+'</td><td>'+JSONObject[ii]["nopolicy"]+'</td><td>'+JSONObject[ii]["bru"]+'</td><td> <a href="#" onclick="bukaInfo('+ii+');"><i class="icon-cloud-download"></i>view</a> </td></tr>';
                       ii=ii+1;    }

                        tb2 =  '<thead><tr><th data-class="expand">Name</th><th>No Policy</th><th data-hide="phone">Premi BRU</th><th data-hide="phone,tablet">View</th></tr></thead>' ;
                                      }

          document.getElementById("isi").innerHTML  ='<table class="table table-striped table-bordered table-hover table-responsive"><thead>'+tb2+'<tbody>'+tb+'</tbody></table>';
          //document.getElementById("ganti").innerHTML='';
          document.getElementById("bawah").innerHTML='';
         // hapus();
                       }


	}

     ajaxRequest.open("GET", "policyin.php", true);
	ajaxRequest.send(null);
}





function konver(nnn){
          var br;
          br=nnn;
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

        xxx = ajaxRequest.responseText;

        //br = document.getElementById("biru").value;
        document.getElementById("rupiah").value =  xxx*br;

                             }


	}

    ajaxRequest.open("GET", "igrow2.php", true);
	ajaxRequest.send(null);
}

function beli2(){

namag = "<?php echo ($nama); ?>";
alag  = "<?php echo ($addr); ?>";
br = document.getElementById("biru").value;
rp = document.getElementById("rupiah").value;

      //hapus();
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

        xxx = ajaxRequest.responseText;
        //document.getElementById("sss").innerHTML = 'Proccess Success please  upload evidence of transfer';
        alert(xxx);
                             }


	}

    ajaxRequest.open("GET", "beli.php?nama="+namag+"&alamat="+alag+"&biru="+br+"&rupiah="+rp, true);
	ajaxRequest.send(null);
}


 function bukaInfo(nm)
{

                  nami = insu;      //nami= nama[nm];
                  plc = nopl[nm];
                  biru=  bru[nm];

         var x = screen.width/2 - 700/2;
         var y = screen.height/2 - 300/2;
         window.open('/biru2/notificationin.php?bru='+biru+"&nama="+nami+"&plc="+plc ,'popUpWindow','height=700,width=700,left=50,top='+y+',  left='+x+', resizable=yes,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no, title=no , status=no')


}




</script>


</head>

<body>

	<!-- Header -->
	<header class="header navbar navbar-fixed-top" role="banner">
		<!-- Top Navigation Bar -->
		<div class="container">

			<!-- Only visible on smartphones, menu toggle -->
			<ul class="nav navbar-nav">
				<li class="nav-toggle"><a href="javascript:void(0);" title=""><i class="icon-reorder"></i></a></li>
			</ul>

			<!-- Logo -->
			<a class="navbar-brand" href="http://birurisk.com/">
				<img src="assets/img/logo.png" alt="logo" />
				BIRU
			</a>
			<!-- /logo -->

			<!-- Sidebar Toggler -->
			<!--<a href="#" class="toggle-sidebar bs-tooltip" data-placement="bottom" data-original-title="Toggle navigation">
				<i class="icon-reorder"></i>
			</a>-->
			<!-- /Sidebar Toggler -->

			<!-- Top Left Menu -->
			<!--<ul class="nav navbar-nav navbar-left hidden-xs hidden-sm">
				<li>
					<a href="#">
						Ringkasan
					</a>
				</li>
				<li>
					<a href="#">
						Saldo
					</a>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						Alat
						<i class="icon-caret-down small"></i>
					</a>
					<ul class="dropdown-menu">
						<li><a href="#"><i class="icon-user"></i> Example #1</a></li>
						<li><a href="#"><i class="icon-calendar"></i> Example #2</a></li>
						<li class="divider"></li>
						<li><a href="#"><i class="icon-tasks"></i> Example #3</a></li>
					</ul>
				</li>
			</ul>-->
			<!-- /Top Left Menu -->

			<!-- Top Right Menu -->
			<ul class="nav navbar-nav navbar-right">
				<!-- Notifications -->
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
      <?php include 'igrow.php';?>
					</a>
				</li>

				<!-- Pengaturan -->
				<li class="dropdown hidden-xs hidden-sm">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-cog"></i>
					</a>
					<ul class="dropdown-menu extended notification">
						<li class="title">
							<p>Pengaturan</p>
						</li>
						<li>
							<a href="pages_user_profile.php">
								Profil Anda
							</a>
						</li>
						<li>
							<a href="javascript:void(0);">
								Pengaturan Rekening
							</a>
						</li>

					</ul>
				</li>

				<!-- Messages -->
				<li class="dropdown hidden-xs hidden-sm">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-envelope"></i>
						<span class="badge">1</span>
					</a>
					<ul class="dropdown-menu extended notification">
						<li class="title">
							<p>You have 3 new messages</p>
						</li>
						<li>
							<a href="javascript:void(0);">
								<span class="photo"><img src="assets/img/demo/avatar-1.jpg" alt="" /></span>
								<span class="subject">
									<span class="from">Bob Carter</span>
									<span class="time">Just Now</span>
								</span>
								<span class="text">
									Consetetur sadipscing elitr...
								</span>
							</a>
						</li>
						<li>
							<a href="javascript:void(0);">
								<span class="photo"><img src="assets/img/demo/avatar-2.jpg" alt="" /></span>
								<span class="subject">
									<span class="from">Jane Doe</span>
									<span class="time">45 mins</span>
								</span>
								<span class="text">
									Sed diam nonumy...
								</span>
							</a>
						</li>
						<li>
							<a href="javascript:void(0);">
								<span class="photo"><img src="assets/img/demo/avatar-3.jpg" alt="" /></span>
								<span class="subject">
									<span class="from">Patrick Nilson</span>
									<span class="time">6 hours</span>
								</span>
								<span class="text">
									No sea takimata sanctus...
								</span>
							</a>
						</li>
						<li class="footer">
							<a href="javascript:void(0);">View all messages</a>
						</li>
					</ul>
				</li>

				<!-- .row .row-bg Toggler -->
				<li>
					<a href="#" class="dropdown-toggle row-bg-toggle">
						<i class="icon-resize-vertical"></i>
					</a>
				</li>



				<!-- User Login Dropdown -->
				<li class="dropdown user">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<!--<img alt="" src="assets/img/avatar1_small.jpg" />-->
						<i class="icon-male"></i>
						<span class="username">


 <?php echo ($_SESSION['user_cli_name']); ?>



                        </span>
						<i class="icon-caret-down small"></i>
					</a>
					<ul class="dropdown-menu">
						<li><a href="pages_user_profile.php"><i class="icon-user"></i> My Profile</a></li>
						<li><a href="pages_calendar.html"><i class="icon-calendar"></i> My Calendar</a></li>
						<li><a href="#"><i class="icon-tasks"></i> My Tasks</a></li>
						<li class="divider"></li>
<?php
if (!is_null($_SESSION['is_biru'])) {
    echo '<li><a href="./page/biru/"><i class="icon-arrow-right"></i> Admin View</a></li>';
    echo '<li class="divider"></li>';
}
?>
						<li><a href="logout.php"><i class="icon-key"></i> Log Out</a></li>
					</ul>
				</li>
				<!-- /user login dropdown -->
			</ul>
			<!-- /Top Right Menu -->
		</div>
		<!-- /top navigation bar -->

		<!--=== Project Switcher ===-->
		<div id="project-switcher" class="container project-switcher">
			<div id="scrollbar">
				<div class="handle"></div>
			</div>

			<div id="frame">
				<ul class="project-list">
					<li>
						<a href="javascript:void(0);">
							<span class="image"><i class="icon-desktop"></i></span>
							<span class="title">Lorem ipsum dolor</span>
						</a>
					</li>
					<li>
						<a href="javascript:void(0);">
							<span class="image"><i class="icon-compass"></i></span>
							<span class="title">Dolor sit invidunt</span>
						</a>
					</li>
					<li class="current">
						<a href="javascript:void(0);">
							<span class="image"><i class="icon-male"></i></span>
							<span class="title">Consetetur sadipscing elitr</span>
						</a>
					</li>
					<li>
						<a href="javascript:void(0);">
							<span class="image"><i class="icon-thumbs-up"></i></span>
							<span class="title">Sed diam nonumy</span>
						</a>
					</li>
					<li>
						<a href="javascript:void(0);">
							<span class="image"><i class="icon-female"></i></span>
							<span class="title">At vero eos et</span>
						</a>
					</li>
					<li>
						<a href="javascript:void(0);">
							<span class="image"><i class="icon-beaker"></i></span>
							<span class="title">Sed diam voluptua</span>
						</a>
					</li>
					<li>
						<a href="javascript:void(0);">
							<span class="image"><i class="icon-desktop"></i></span>
							<span class="title">Lorem ipsum dolor</span>
						</a>
					</li>
					<li>
						<a href="javascript:void(0);">
							<span class="image"><i class="icon-compass"></i></span>
							<span class="title">Dolor sit invidunt</span>
						</a>
					</li>
					<li>
						<a href="javascript:void(0);">
							<span class="image"><i class="icon-male"></i></span>
							<span class="title">Consetetur sadipscing elitr</span>
						</a>
					</li>
					<li>
						<a href="javascript:void(0);">
							<span class="image"><i class="icon-thumbs-up"></i></span>
							<span class="title">Sed diam nonumy</span>
						</a>
					</li>
					<li>
						<a href="javascript:void(0);">
							<span class="image"><i class="icon-female"></i></span>
							<span class="title">At vero eos et</span>
						</a>
					</li>
					<li>
						<a href="javascript:void(0);">
							<span class="image"><i class="icon-beaker"></i></span>
							<span class="title">Sed diam voluptua</span>
						</a>
					</li>
				</ul>
			</div> <!-- /#frame -->
		</div> <!-- /#project-switcher -->
	</header> <!-- /.header -->
	<div id="sidebar" class="sidebar-fixed">
		<div id="sidebar-content">

			<!-- Search Input -->
			<form class="sidebar-search">
				<div class="input-box">
					<button type="submit" class="submit">
						<i class="icon-search"></i>
					</button>
					<span>
						<input type="text" placeholder="Search...">
					</span>
				</div>
			</form>

			<!-- Search Results -->
			<div class="sidebar-search-results">

				<i class="icon-remove close"></i>
				<!-- Documents -->
				<div class="title">
					Documents
				</div>
				<ul class="notifications">
					<li>
						<a href="javascript:void(0);">
							<div class="col-left">
								<span class="label label-info"><i class="icon-file-text"></i></span>
							</div>
							<div class="col-right with-margin">
								<span class="message"><strong>Jane Doe</strong> received $1.527,32</span>
								<span class="time">finances.xls</span>
							</div>
						</a>
					</li>
					<li>
						<a href="javascript:void(0);">
							<div class="col-left">
								<span class="label label-success"><i class="icon-file-text"></i></span>
							</div>
							<div class="col-right with-margin">
								<span class="message">My name is <strong>Jane Doe</strong> ...</span>
								<span class="time">briefing.docx</span>
							</div>
						</a>
					</li>
				</ul>
				<!-- /Documents -->
				<!-- Persons -->
				<div class="title">
					Persons
				</div>
				<ul class="notifications">
					<li>
						<a href="javascript:void(0);">
							<div class="col-left">
								<span class="label label-danger"><i class="icon-female"></i></span>
							</div>
							<div class="col-right with-margin">
								<span class="message">Jane <strong>Doe</strong></span>
								<span class="time">21 years old</span>
							</div>
						</a>
					</li>
				</ul>
			</div> <!-- /.sidebar-search-results -->

			<!--=== Navigation ===-->
       <?php
include 'navi3.php';
?>
			<!-- /Navigation -->
			<div class="sidebar-title">
				<span>Notifications</span>
			</div>
			<ul class="notifications demo-slide-in"> <!-- .demo-slide-in is just for demonstration purposes. You can remove this. -->
				<li style="display: none;"> <!-- style-attr is here only for fading in this notification after a specific time. Remove this. -->
					<div class="col-left">
						<span class="label label-danger"><i class="icon-warning-sign"></i></span>
					</div>
					<div class="col-right with-margin">
						<span class="message">Terjadi Gempa di Kepulauan Halmahera.</span>
						<span class="time">few seconds ago</span>
					</div>
				</li>
				<li style="display: none;"> <!-- style-attr is here only for fading in this notification after a specific time. Remove this. -->
					<div class="col-left">
						<span class="label label-info"><i class="icon-envelope"></i></span>
					</div>
					<div class="col-right with-margin">
						<span class="message"><strong>Jane</strong> sent you a message</span>
						<span class="time">few second ago</span>
					</div>
				</li>
				<li>
					<div class="col-left">
						<span class="label label-success"><i class="icon-plus"></i></span>
					</div>
					<div class="col-right with-margin">
						<span class="message"><strong>Emma</strong>'s account was created</span>
						<span class="time">4 hours ago</span>
					</div>
				</li>
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
	<div id="container">


		<div id="content">
			<div class="container">
				<!-- Breadcrumbs line -->
				<div class="crumbs">
					<ul id="breadcrumbs" class="breadcrumb">
						<li class="current">
							<i class="icon-home"></i>
							<a href="index.html">Dashboard</a>
						</li>
					</ul>

					<ul class="crumb-buttons">
						<li><a href="charts.html" title=""><i class="icon-signal"></i><span>Statistics</span></a></li>
						<li class="dropdown"><a href="#" title="" data-toggle="dropdown"><i class="icon-tasks"></i><span>Users <strong>(+3)</strong></span><i class="icon-angle-down left-padding"></i></a>
							<ul class="dropdown-menu pull-right">
								<li><a href="form_components.html" title=""><i class="icon-plus"></i>Add new User</a></li>
								<li><a href="tables_dynamic.html" title=""><i class="icon-reorder"></i>Overview</a></li>
							</ul>
						</li>
						<li class="range"><a href="#">
							<i class="icon-calendar"></i>
							<span></span>
							<i class="icon-angle-down"></i>
						</a></li>
					</ul>
				</div>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
						<h3>Dashboard</h3>
						<span>Hello.., <?php echo ($_SESSION['user_cli_name']); ?>!</span>
					</div>

		<?php
$xml = @simplexml_load_file("http://data.bmkg.go.id/autogempa.xml") or die("Error: Cannot create object");
?>

				</div>
				<!-- /Page Header -->

				<!--=== Page Content ===-->
				<div id="isi" class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h3><i class="icon-reorder"></i> Latest Earth Quake</h3>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content">
								<div class="row">
									<div class="col-md-3">
										<img src="http://data.bmkg.go.id/eqmap.gif" alt="">
									</div>
									<div class="col-md-9">
										<div class="row">
											<div class="col-md-12">
												<h3>Info Lokasi Gempa Terbaru</h3>
												<div class="section-profile-wrapper">
													<!-- Info Akun BRU -->
													<div class="info-akun-wrapper">
														<div class="row section-profile-row-low">
															<div class="section-profile">
																<div class="col-md-10">
																	<div class="col-md-4 section-profile-title">
																		Peringatan
																	</div>
																	<div class="col-md-8 section-profil-content warning-notif">
																		<h3> <?php echo $xml->gempa->Potensi . "<br>"; ?>   </h3>
																	</div>
																</div>
																<div class="col-md-2 section-action">

																</div>
															</div>
														</div>
													</div>
													<!-- /Info akun wrapper -->

													<!-- Info -->
													<div class="row section-profile-row-low">
														<div class="section-profile">
															<div class="col-md-10">
																<div class="col-md-4 section-profile-title">
																	Lintang
																</div>
																<div class="col-md-8 section-profil-content">
                                                              <?php echo $xml->gempa->Lintang ?>
																</div>
															</div>
															<div class="col-md-2 section-action">

															</div>
														</div>
													</div>
													<div class="row section-profile-row-low">
														<div class="section-profile">
															<div class="col-md-10">
																<div class="col-md-4 section-profile-title">
																	Bujur
																</div>
																<div class="col-md-8 section-profil-content">
                                                                  <?php echo $xml->gempa->Bujur ?>
																</div>
															</div>
															<div class="col-md-2 section-action">

															</div>
														</div>
													</div>
													<div class="row section-profile-row-low">
														<div class="section-profile">
															<div class="col-md-10">
																<div class="col-md-4 section-profile-title">
																	Magnitude
																</div>
																<div class="col-md-8 section-profil-content">
                                                                   <?php echo $xml->gempa->Magnitude ?>
																</div>
															</div>
															<div class="col-md-2 section-action">

															</div>
														</div>
													</div>
													<div class="row section-profile-row-low">
														<div class="section-profile">
															<div class="col-md-10">
																<div class="col-md-4 section-profile-title">
																	Kedalaman
																</div>
																<div class="col-md-8 section-profil-content">
                                                                    <?php echo $xml->gempa->Kedalaman ?>
																</div>
															</div>
															<div class="col-md-2 section-action">

															</div>
														</div>
													</div>
													<div class="row section-profile-row-low">
														<div class="section-profile">
															<div class="col-md-10">
																<div class="col-md-4 section-profile-title">
																	Tanggal
																</div>
																<div class="col-md-8 section-profil-content">
                                                                    <?php echo $xml->gempa->Tanggal ?>
																</div>
															</div>
															<div class="col-md-2 section-action">

															</div>
														</div>
													</div>
													<div class="row section-profile-row-low">
														<div class="section-profile">
															<div class="col-md-10">
																<div class="col-md-4 section-profile-title">
																	Jam
																</div>
																<div class="col-md-8 section-profil-content">
                                                                    <?php echo $xml->gempa->Jam ?>
																</div>
															</div>
															<div class="col-md-2 section-action">

															</div>
														</div>
													</div>
												</div>

											</div>

										</div> <!-- /.row -->
									</div> <!-- /.col-md-9 -->
								</div>
							</div>


						</div>
					</div> <!-- /.col-md-12 -->
				</div> <!-- /.row -->

				<div id="bawah" class="row margin-bottom-20">



					<div class="col-md-4">
						<div class="widget-box">
							<div class="widget-title-small">
								<h2>Saldo</h2>
							</div>

							<div      class="widget-content">
								<small>Available</small>
								<h1 id = "bru"  >BRU 1000</h1>
							</div>



							<div class="widget-small-link">
								<ul>
									<li><a href="page_check_token.php">Info selengkapnya</a></li>
									<li><a href="page-bru-credit.php">Claim</a></li>
									<li><a href="">Redeemed</a></li>
								</ul>
							</div>
						</div>
						<div class="widget-box quick-buy">
							<div class="row">
								<div class="form-group">

									<div class="col-md-12">
										<div class="widget-title-small">
											<h3>Beli Token Cara Cepat</h3>
										</div>
										<label class="control-label">Amounts:</label>
										<div class="row">
											<div class="col-md-12">

												<div class="input-group">
													<span class="input-group-addon">BRU</span>
													<input type="text" id="biru" class="form-control" placeholder="dalam satuan BRU"   onchange="konver(this.value)" >
												</div>
												<span class="help-block">Masukkan nilai BRU yang akan dibeli</span>

											</div>




										</div>
										<div class="row">

											<div class="col-md-12">

												<div class="input-group">
													<span class="input-group-addon">Rp</span>
													<input type="text" id="rupiah" class="form-control" placeholder="konversi ke Rupiah">
												</div>
												<span class="help-block"></span>

											</div>



										</div>
										<div class="row">

											<div class="col-md-12">

												<button type="button" onClick="beli2();"  class="btn btn-primary-rounded-small" data-dismiss="modal">Beli</button>

											</div>


										</div>

									</div>
								</div>
							</div>
						</div>
					</div>

					<div id="bawah" class="col-md-8">
						<div class="widget-box">
							<div class="widget-title-small">
								<h2>Policy Notification</h2>
							</div>

							<div class="widget-content no-padding">
        <div id="ganti">
								<table class="table table-striped table-bordered table-hover table-responsive">
									<thead>
										<tr>

											<th data-class="expand">Name</th>
											<th>No Policy</th>
											<th data-hide="phone">Premi BRU</th>
											<th data-hide="phone,tablet">View</th>
										</tr>
									</thead>
									<tbody>
										<tr>

											<td>Hamka Fauzan</td>
											<td>1925257</td>
											<td>0.044</td>
											<td><a href=""> <i class="icon-cloud-download"></i> Lihat Polis</a></td>
										</tr>
										<tr>

											<td>Hamka Fauzan</td>
											<td>1925257</td>
											<td>0.044</td>
											<td><a href=""> <i class="icon-cloud-download"></i> Lihat Polis</a></td>
										</tr>
										<tr>

											<td>Hamka Fauzan</td>
											<td>1925257</td>
											<td>0.044</td>
											<td><a href=""> <i class="icon-cloud-download"></i> Lihat Polis</a></td>
										</tr>
										<tr>

											<td>Hamka Fauzan</td>
											<td>1925257</td>
											<td>0.044</td>
											<td><a href=""> <i class="icon-cloud-download"></i> Lihat Polis</a></td>
										</tr>
										<tr>

											<td>Hamka Fauzan</td>
											<td>1925257</td>
											<td>0.044</td>
											<td><a href=""> <i class="icon-cloud-download"></i> Lihat Polis</a></td>
										</tr>
										<tr>

											<td>Hamka Fauzan</td>
											<td>1925257</td>
											<td>0.044</td>
											<td><a href=""> <i class="icon-cloud-download"></i> Lihat Polis</a></td>
										</tr>

									</tbody>
								</table>
			<div>
								<div class="widget-small-link">
									<ul>
										<li><a href="">Info selengkapnya</a></li>
									</ul>

								</div>
							</div>
						</div>
					</div>


				</div>























				<footer>
					<div class="footer-content">
						<div class="footer-menu">
							<ul>
								<li><a href="">Bantuan & hubungi</a></li>
								<li><a href="">Peta Situs</a></li>
								<li><a href="">Keamanan</a></li>
								<li><a href="">Tentang BiRU</a></li>
							</ul>

						</div>
						<div class="footer-copy">
							<div class="col-md-6 copyright no-pad">
								<small><p>BiRU v1.0 - © 2018 PT. Berbagi Resiko Universal</p></small>
							</div>
							<div class="col-md-6 footer-menu no-pad">
								<ul>
									<li><a href="">Kebijakan Privasi</a></li>
									<li><a href="">Ketentuan Hukum</a></li>
									<li><a href="">Pembaruan Kebijakan</a></li>
								</ul>
							</div>

						</div>
					</div>
				</footer>

				<!-- /Page Content -->
			</div>
			<!-- /.container -->

		</div>

	</div>

</body>
</html>
