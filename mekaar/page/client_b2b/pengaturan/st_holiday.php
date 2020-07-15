<script src="<?=getUrlServer()?>/plugins/jquery-touchswipe/jquery.touchSwipe.min.js"></script>
<script src="<?=getUrlServer()?>/plugins/jquery-calendar/jquery-calendar.js"></script>
<link rel="stylesheet" href="<?=getUrlServer()?>/plugins/jquery-calendar/jquery-calendar.min.css">
<style>.calendar-month-events-day>span{color:#000}</style>
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
                        <li class="current">
							<a href="#" title="">Holiday</a>
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
				<div class="page-header" style="margin-bottom:0">
					<!-- /Page Stats -->
				</div>
				<!-- /Page Header -->

				<!--div-- class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" style="font-size:32px !important" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>Warning!</strong> Better check yourself, you're not looking too good.
				</!--div-->


				<!--=== Page Content ===-->
                <div class="widget box">
                    <div class="widget-header">
                        <h4> Legend</h4>
                        <div class="toolbar no-padding">
                            <div class="btn-group">
                                <button id="cek_hari" class="btn btn-xs btn-primary"><i class="icon-gear"></i>Atur Tanggal Libur</button>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content">
				        <div id="calendar"></div>
                    </div>
                </div>
                <div class="modal" tabindex="-1" id="myModal" aria-labelledby="myModalLabel" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title">Atur Hari/Tambah Tanggal Libur</h4>
                        </div>
                        <div class="modal-body">
                            <fieldset>
                                <legend>Atur Hari Libur</legend>
                                <form id="form-hari" class="form-inline">
                                    <label class="col-md-3">
                                        <input type="checkbox" name="hari[0]" id="inlineCheckbox1" value="SENIN"> Senin
                                    </label>
                                    <label class="col-md-3">
                                        <input type="checkbox" name="hari[1]" id="inlineCheckbox2" value="SELASA"> Selasa
                                    </label>
                                    <label class="col-md-3">
                                        <input type="checkbox" name="hari[2]" id="inlineCheckbox3" value="RABU"> Rabu
                                    </label>
                                    <label class="col-md-3">
                                        <input type="checkbox" name="hari[3]" id="inlineCheckbox4" value="KAMIS"> Kamis
                                    </label>
                                    <label class="col-md-3">
                                        <input type="checkbox" name="hari[4]" id="inlineCheckbox5" value="JUMAT"> Jumat
                                    </label>
                                    <label class="col-md-3">
                                        <input type="checkbox" name="hari[5]" id="inlineCheckbox6" value="SABTU"> Sabtu
                                    </label>
                                    <label class="col-md-3">
                                        <input type="checkbox" name="hari[6]" id="inlineCheckbox7" value="MINGGU"> Minggu
                                    </label>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>&nbsp;
                            </fieldset>
                            <fieldset style="margin-top:20px">
                                <legend >Tambah Tanggal Libur</legend>
                                <form id="form-tanggal" class="form-horizontal">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="tgl">Tanggal</label>
                                            <input type="date" id="tgl" name="tgl" class="form-control" required value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="ket">Keterangan</label>
                                            <textarea type="text" id="ket" name="ket" class="form-control col-12" required></textarea>
                                        </div>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </fieldset>
                        </div>
                        <div class="modal-footer">
                            <!--button-- type="button" class="btn btn-primary">Save changes</!--button-->
                        </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

                <?php include "footer.php";?>

				<!-- /Page Content -->
			</div>
		</div>
	</div>

<script>
<?php $token = (empty($_SESSION['token'])) ? $_SESSION['token'] = bin2hex(random_bytes(32)) : $_SESSION['token'];?>
var newToken = '<?=$token?>';

$(document).ready(function(){
    $(document).on('click', ".hapus", function(e) {
        //console.log(e);
        hapus($(e.target).attr('data'));
    });
    $('#form-hari').on('submit',function(e){
       e.preventDefault();
       simpan('form-hari','hari');
    });
    $('#form-tanggal').on('submit',function(e){
       e.preventDefault();
       simpan('form-tanggal','tanggal_tambah');
    });
    $('#cek_hari').on('click',function(){
        App.blockUI($("#content"));
        $.ajax({
           url : "ambil_data.php?type=libur_hari",
           type: "post",
           dataType:"json",
           success:function(result){
			console.log(result);
			if(result.status){
                (result.hari.find(function (value, index, array){return value=='SENIN';}) != undefined)?$('#inlineCheckbox1').prop('checked',true):$('#inlineCheckbox1').prop('checked',false);
                (result.hari.find(function (value, index, array){return value=='SELASA';}) != undefined)?$('#inlineCheckbox2').prop('checked',true):$('#inlineCheckbox2').prop('checked',false);
                (result.hari.find(function (value, index, array){return value=='RABU';}) != undefined)?$('#inlineCheckbox3').prop('checked',true):$('#inlineCheckbox3').prop('checked',false);
                (result.hari.find(function (value, index, array){return value=='KAMIS';}) != undefined)?$('#inlineCheckbox4').prop('checked',true):$('#inlineCheckbox4').prop('checked',false);
                (result.hari.find(function (value, index, array){return value=='JUMAT';}) != undefined)?$('#inlineCheckbox5').prop('checked',true):$('#inlineCheckbox5').prop('checked',false);
                (result.hari.find(function (value, index, array){return value=='SABTU';}) != undefined)?$('#inlineCheckbox6').prop('checked',true):$('#inlineCheckbox6').prop('checked',false);
                (result.hari.find(function (value, index, array){return value=='MINGGU';}) != undefined)?$('#inlineCheckbox7').prop('checked',true):$('#inlineCheckbox7').prop('checked',false);
                setTimeout(function ()
                {
                    App.unblockUI($("#content"));
                    $('#myModal').modal();
				}, 300);
			}else{
                App.unblockUI($("#content"));
                alert("Gagal mengambil data hari libur, Silakan Hubungi Administrator!");
            }
           },
           error: function(xhr, Status, err) {
                App.unblockUI($("#content"));
                alert("Terjadi error : "+Status+" : ");
           }

         });
    });
    function callAjax(r,calendare){
        $.ajax({
           url : "ambil_data.php?type=libur_kalender",
           type: "post",
           data: {unix:r},
           dataType:"json",
           success:function(result){
			console.log(result);
			if(result.status){
				calendare.setEvents(result.tgl);
				calendare.init();
				//console.log();
			}else{
				console.log("Kalender eror");
				//window.location="'.site_url('Sys').'/kalender";
			}
           },
           error: function(xhr, Status, err) {
             $("Terjadi error : "+Status+" : ");
           }

         });
    }
    var lastCurrent=[null,null];

    var now= moment();
    var calendar=$('#calendar').Calendar({
		// language
		  locale: 'id',

		  // 'day', 'week', 'month'
		  view: 'week',

		  // enable keyboard navigation
		  enableKeyboard: true,

		  // custom colors
		  colors: {
			random: true
          },
          /*
          events: [{
			start: now.startOf('day').format('X'),
			end: now.endOf('day').format('X'),
			title: '1',
			content: 'Hello World! <br> <p>Foo Bar</p>'+
            '<button class="btn btn-danger" onclick="hapus(\'<?=''?>\')" ><i class="icon-remove"></i> Hapus</button>',
			category:'Professionnal s'
		  },{
			start: now.add(4, 'd').startOf('day').format('X'),
			end: now.endOf('day').format('X'),
			title: '2',
			content: 'Hello World! <br> <p>Foo Bar</p>',
			category:'Professionnal'
        }]
        */
    });
    $('#calendar').on('Calendar.init', function(event, instance, before, current, after){
	  //console.log(event);     // jQuery event
	  //console.log(instance);  // Equals to var calendar above
	  //console.log(before);    // Array of the past view interval [unixTimestampFrom, unixTimestampTo]
	  console.log(current);   // Array of the current view interval [unixTimestampFrom, unixTimestampTo]
	  //console.log(after);     // Array of the next view interval [unixTimestampFrom, unixTimestampTo]

	  //current {0:unixTimestampFrom,1:unixTimestampTo}
	  if(lastCurrent[0] == current[0]){
	  }else{
		lastCurrent = current;
		callAjax(current, calendar);
      }
	});
    calendar.init();

    function simpan(obj,str){
        var que=(str=='hari')?"Simpan Hari Libur?":"Tambah Tanggal Libur?";
        if(confirm(que)){
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
                $('#'+obj).prop('disabled',false);
                if(ajaxRequest.readyState == 4){
                    console.log(ajaxRequest.responseText);
                    var JSONObject = JSON.parse(ajaxRequest.responseText);
                    if(JSONObject[0] != false)
                    {
                        alert(JSONObject.pesan);
                        newToken=JSONObject.tk;
                        $('#myModal').modal('hide');
                        callAjax(lastCurrent, calendar);
                    }else{
                        alert(JSONObject.pesan);
                    }
                }
            }
            ajaxRequest.open("POST", "./simpan.php", true);
                    

            

            var formElement = document.getElementById(obj);
            $('#'+obj).prop('disabled',true);
            var formData = new FormData(formElement);
            formData.set("type","holiday_"+str);

            formData.set("token", newToken);
            ajaxRequest.send(formData);
        }
    }
    function hapus(id){
        if(confirm("Hapus Tanggal?")){
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
                        newToken=JSONObject.tk;
                        $('.modal').modal('hide');
                        callAjax(lastCurrent, calendar);
                    }else{
                        alert(JSONObject.pesan);
                    }
                }
            }
            ajaxRequest.open("POST", "./simpan.php", true);
                    

            

            var formData = new FormData();
            formData.set("kode",id);
            formData.set("type","holiday_tanggal_hapus");
            formData.set("token", newToken);

            ajaxRequest.send(formData);
        }
    }
});

</script>