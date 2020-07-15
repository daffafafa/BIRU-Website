<script type="text/javascript" src="<?=getUrlServer()?>/plugins/bootstrap-tabcollapse/bootstrap-tabcollapse.js"></script>
<style>
    .panel-title>a {font-size: 15px;padding: 8px 20px;display:block;color: #555555;}
    .panel-title>a:hover {text-decoration:none;color: #555555;}
    .panel-default>.panel-heading {background-color: #f9f9f9;}
    .panel-default {border-top: 3px solid #c9c9c9;}
    .tab-pane .row{margin:0;}
    .tab-pane h3{text-align:center;margin-bottom:30px;}
</style>
<script>
    $(document).ready(function(){
        $('.saldo').each(function(){$(this).text(formatMoney(formatNumber($(this).text()),2,',','.'));});
        $('.table').dataTable({'order': [[0, 'desc']]});
        $.extend($.scrollTo.defaults, {axis: 'y',interupt: true,duration:220});
        $('#myTab').tabCollapse({tabsClass: 'visible-lg',accordionClass: 'hidden-lg'});
        $('.tab_b').on('click',function(){
            window.location.hash=$(this)[0].hash;
        });
        $('.tab_a').on('click',function(){
            var w = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
            switch($(this).attr('aria-controls')){
                case 'profile':
                    document.getElementById("tab_profile").click();
                break;
                case 'info':
                    document.getElementById("tab_info").click();
                    break;
                case 'transaction_history':
                    document.getElementById("tab_transaction_history").click();
                    break;
                case 'change_password':
                    document.getElementById("tab_change_password").click();
                    break;
                case 'log_in_history':
                    document.getElementById("tab_log_in_history").click();
                    break;
            }
            document.getElementsByTagName('body')[0].style.height='0px';
        });
        $('#form-profile').on('submit',function(e){
            event.preventDefault()
            simpan('form-profile','ubah');
        })
        $('#form-change_password').on('submit',function(e){
            event.preventDefault()
            simpan('form-change_password','ganti_pass');
        })
        function simpan(obj,tipe){
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
                            window.location = "./?p=my_profile";
                        }else{
                            alert(JSONObject.pesan);
                        }
                    }
                }
                ajaxRequest.open("POST", "./simpan.php", true);
                    

                

                var formElement = document.getElementById(obj);
                var formData = new FormData(formElement);
                formData.set("type","my_profile_"+tipe);
                <?php $token = (empty($_SESSION['token'])) ? $_SESSION['token'] = bin2hex(random_bytes(32)) : $_SESSION['token'];?>
                formData.set("token","<?=$token?>");
                //Send the proper header information along with the request
                //ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                //ajaxRequest.setRequestHeader("Content-length", formData.length);
                //ajaxRequest.setRequestHeader("Connection", "close");

                ajaxRequest.send(formData);
            }
        }
        // checktok();
        // function checktok(){
        //     var ajaxRequest;
        //     try{
        //         ajaxRequest = new XMLHttpRequest();
        //     } catch (e){
        //         try{
        //             ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
        //         } catch (e) {
        //             try{
        //                 ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
        //             } catch (e){
        //                 alert("Your browser broke!");
        //                 return false;
        //             }
        //         }
        //     }

        //     ajaxRequest.onreadystatechange = function(){
        //         if(ajaxRequest.readyState == 4){
        //             xxx = ajaxRequest.responseText;
        //             var obj = JSON.parse(xxx);
        //             var txh = obj.hasil;
        //             var dt1, dt2, blt;
        //             dt1 = txh/1000000000000000000;
        //             dt2=1000-dt1;
        //             blt= dt1.toFixed(6);
        //             document.getElementById("saldo").innerHTML = formatMoney(blt,6,',','.');
        //         }
        //     }
        //     ajaxRequest.open("GET", "http://207.148.116.70:8801/prize8?reqid="+"", true);
        //     ajaxRequest.send(null);
        // }
    });

</script>

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
							<a href="#">Profil</a>
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
				<div class="row">
					<div class="col-md-12">

                        <div class="tabbable tabbable-custom tabbable-full-width">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li role="presentation"><a class="tab_b" id="tab_info" href="#info" aria-controls="info" role="tab" data-toggle="tab">Profil Saya</a></li>
                                <li role="presentation" class="active">
                                    <a class="tab_b" id="tab_profile" href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Company Profile</a>
                                </li>
                                <li role="presentation"><a class="tab_b" id="tab_transaction_history" href="#transaction_history" aria-controls="transaction_history" role="tab" data-toggle="tab">Transaction History</a></li>
                                <li role="presentation"><a class="tab_b" id="tab_change_password" href="#change_password" aria-controls="change_password" role="tab" data-toggle="tab">Change Password</a></li>
                                <li role="presentation"><a class="tab_b" id="tab_log_in_history" href="#log_in_history" aria-controls="log_in_history" role="tab" data-toggle="tab">Log In History</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="myprofile">
                                </div>
                                <div role="tabpanel" class="tab-pane active" id="profile">
                                    <h3 >Company Profile</h3>
                                    <div class="col-lg-12">
                                        <form class="form-horizontal" id="form-profile">
                                            <div class="row-flex m-0 mt-sm-4">
                                                <label for="name" class="col-lg-3 col-md-5 col-sm-5 col-xs-12 p-0"> Kode</label>
                                                <input type="text" class="form-control col-xl-2 col-lg-3 col-md-4 col-sm-4 col-xs-12" disabled value="<?=($company['ENTITY_ID'])?>">
                                            </div>
                                            <div class="row-flex m-0 mt-sm-4">
                                                <label for="name" class="col-lg-3 col-md-5 col-sm-5 col-xs-12 p-0"> Nama</label>
                                                <input type="text" id="name" name="name" class="form-control col-lg-4 col-sm-6 col-xs-12" required value="<?=($company['ENTITY_NAMA'])?>">
                                            </div>
                                            <div class="row-flex m-0 mt-sm-4">
                                                <label for="email" class="col-lg-3 col-md-5 col-sm-5 col-xs-12 p-0"> Email</label>
                                                <input type="email" id="email" name="email" class="form-control col-lg-4 col-sm-6 col-xs-12" required value="<?=($company['ENTITY_EMAIL'])?>">
                                            </div>
                                            <div class="row-flex m-0 mt-sm-4">
                                                <label for="alamat" class="col-lg-3 col-md-5 col-sm-5 col-xs-12 p-0"> Alamat</label>
                                                <textarea id="alamat" name="alamat" class="form-control col-lg-8 col-md-7 col-xs-12" required><?=$company['ENTITY_ALAMAT']?></textarea>
                                            </div>
                                            <div class="row-flex m-0 mt-sm-4">
                                                <label for="pic" class="col-lg-3 col-md-5 col-sm-5 col-xs-12 p-0"> PIC</label>
                                                <input type="text" id="pic" name="pic" class="form-control col-lg-4 col-sm-6 col-xs-12" required value="<?=($company['ENTITY_PIC'])?>">
                                            </div>
                                            <div class="row-flex m-0 mt-sm-4">
                                                <label for="telp" class="col-lg-3 col-md-5 col-sm-5 col-xs-12 p-0"> No. Telp PIC</label>
                                                <input type="text" id="telp" name="telp" class="form-control col-xl-2 col-lg-3 col-md-4 col-sm-4 col-xs-12" required value="<?=($company['ENTITY_PIC_PHONE'])?>">
                                            </div>
                                            <div class="row-flex m-0 mt-sm-4">
                                                <label for="joint" class="col-lg-3 col-md-5 col-sm-5 col-xs-12 p-0"> Tanggal Bergabung</label>
                                                <input type="date" id="joint" name="joint" disabled class="form-control col-xl-2 col-lg-3 col-md-4 col-sm-4 col-xs-12" required value="<?=($company['ENTITY_JOINT'])?>">
                                            </div>
                                            <div class="row-flex m-0 mt-sm-4">
                                                <label for="expiry" class="col-lg-3 col-md-5 col-sm-5 col-xs-12 p-0"> Tanggal Kadaluarsa</label>
                                                <input type="date" id="expiry" name="expiry" disabled class="form-control col-xl-2 col-lg-3 col-md-4 col-sm-4 col-xs-12" required value="<?=($company['ENTITY_EXPIRY'])?>">
                                            </div>
                                            <div class="row-flex m-0 mt-sm-4">
                                                <label for="mou" class="col-lg-3 col-md-5 col-sm-5 col-xs-12 p-0"> MOU</label>
                                                <input type="text" id="mou" name="mou" class="form-control col-lg-4 col-sm-6 col-xs-12" required value="<?=($company['ENTITY_MOU'])?>">
                                            </div>
                                            <div class="row-flex m-0 mt-sm-4">
                                                <label for="npwp" class="col-lg-3 col-md-5 col-sm-5 col-xs-12 p-0"> NPWP</label>
                                                <input type="text" id="npwp" name="npwp" class="form-control col-lg-4 col-sm-6 col-xs-12" required value="<?=($company['ENTITY_NPWP'])?>">
                                            </div>
                                            <button type="submit" class="btn btn-primary" id="simpan">
                                                Save Changes
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="transaction_history">
                                    <h3 >Transaction History </h3>
                                    <div class="col-lg-12">
                                        <table class="table table-striped table-bordered table-hover table-checkable table-responsive ">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Kode Transaksi</th>
                                                    <th>Tipe Transaksi</th>
                                                    <th>Mata Uang</th>
                                                    <th>Total</th>
                                                    <th>Detail</th>
                                                </tr>
                                            </thead>
                                            <tbody>
<?php
$perintah = 'SELECT NOPOLICY,TRX_PR_CLIENT_ID,TRX_PR_ID,TRX_PR_DATE,"OUT" D,TRX_PR_TYPE' .
    ',TRX_PR_CURR_ID,TRX_PR_VALUE ' .
    ' FROM py0001 ' .
    ' WHERE (TRX_PR_CLIENT_ID="' . $_SESSION['user_id'] . '" ) ' .
    ' UNION ' .
    ' SELECT NOPOLICY,TRX_PR_CLIENT_ID,TRX_PR_ID,TRX_PR_DATE,"IN" D,TRX_PR_TYPE,TRX_PR_CURR_ID,ENTITY_PR_VALUE ' .
    ' FROM py0002 LEFT JOIN py0001 ON TRX_PR_ID=TRX_PR_ID_PARENT ' .
    ' WHERE SHA_ENTITY="' . $_SESSION['user_id'] . '" ' .
    ' ORDER BY NOPOLICY,D desc';
$query = mysqli_query($conection, $perintah);
while ($row = mysqli_fetch_array($query)) {
    ?>
    <tr>
        <td><?=$row['TRX_PR_DATE']?></td>
        <td><?=$row['NOPOLICY']?></td>
        <td><?=($row['D'] == 'OUT' ? 'Payment' : 'Received');?></td>
        <td><?=$row['TRX_PR_CURR_ID']?></td>
        <td><span class="saldo"><?=$row['TRX_PR_VALUE']?></span></td>
        <td>
            <?php if ($row['TRX_PR_TYPE'] == 'Buy Product') {?>
            <a href="./?p=detailTrans&id=<?=$row['TRX_PR_ID']?>">Lihat</a>
            <?php } else {?>
            <?php }?>
        </td>
    </tr>
<?php
}

?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="change_password">
                                    <div class="col-lg-12">

                                        <form class="form-horizontal" id="form-change_password">
                                            <div class="form-group">
                                                <label for="pw" class="col-sm-2"> New Password</label>
                                                <div class="col-sm-10">
                                                    <input type="password" id="pw" name="pw" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="pw2" class="col-sm-2"> Confirm Password</label>
                                                <div class="col-sm-10">
                                                    <input type="password" id="pw2" name="pw2" class="form-control" required>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary" id="simpan">
                                                Save Changes <i class="icon-angle-right"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="log_in_history">
                                    <h3 >Login History </h3>
                                    <div class="col-lg-12">
                                        <table class="table table-striped table-bordered table-hover table-checkable table-responsive ">
                                            <thead>
                                                <tr>
                                                    <th >No</th>
                                                    <th >Timestamp</th>
                                                    <th >From</th>
                                                </tr>
                                            </thead>
                                            <tbody>
<?php
{
    //admin perusahaan
    $perintah = 'SELECT ID_KEY_ma1001,`HTTP_USER_AGENT`,`TIMESTAMP` FROM login_history where ID_KEY_ma1001 = "' . $profil['ID_KEY'] . '" ORDER BY `TIMESTAMP` DESC';
}
$query = mysqli_query($conection, $perintah);
$i = 1;
while ($row = mysqli_fetch_array($query)) {
    ?>
    <tr>
        <td><?=$i++?></td>

        <td><?=$row['TIMESTAMP']?></td>
        <td><?=$row['HTTP_USER_AGENT']?></td>
    </tr>
<?php
}
?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
				<?php include "footer.php";?>

				<!-- /Page Content -->
			</div>
		</div>
	</div>
