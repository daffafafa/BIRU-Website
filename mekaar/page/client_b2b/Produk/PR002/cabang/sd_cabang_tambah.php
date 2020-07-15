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
							<a href="./?p=cabang&id=<?=$_GET['id']?>" title="">Cabang</a>
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

                <!-- /leaflet -->
                <!--link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
                <script-- src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script-->
                <link rel="stylesheet" href="<?=getUrlServer()?>/plugins/leaflet/leaflet.css" />
                <script src="<?=getUrlServer()?>/plugins/leaflet/leaflet.js"></script>

                <!-- /style form -->
                <link rel="stylesheet" type="text/css" href="<?=getUrlServer()?>/assets/template/ContactFrom_v5/vendor/select2/css/select2.min.css">
                <style>
                    h3{margin-top: 0;width: 100%;font-weight: 500;}
                    .pbb0{display:block;font-size:24px}
                    .pbb3{width:calc(20% - 20px)}.pbb4{width:calc(80% - 30px)}
                    .pbb{height:40px;font-size:18px !important;color:#555555;font-weight:bold}
                    .hvr{border: 1px solid #ccc;}</style>
				<script type="text/javascript" src="<?=getUrlServer()?>/assets/template/ContactFrom_v5/vendor/select2/js/select2.min.js"></script>
                <script>
					$(document).ready(function(){
                        var currentLatLng=[-6.186635429683865,106.8318271636963];
                        var osm = L.tileLayer("http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                            maxZoom: 20,
                            subdomains: ['a' , 'b' , 'c'],
                            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>" '
                        });
                        var map = L.map("map", {
                            zoom: 14,
                            center: currentLatLng,
                            layers: [osm],
                            zoomControl: true,
                            attributionControl: true
                        });
                        //var markerForm = L.marker(currentLatLng).addTo(map);
                        /*var circle = L.circle(currentLatLng, {
                            color: '#fff',
                            colorOpacity: 0.4,
                            fillColor: '#f03',
                            fillOpacity: 0.4,
                            radius: 500
                        }).addTo(map);
                        */
                        var popup = L.popup();
                        map.on("click", function(ev) {
                            popup
                                .setLatLng(ev.latlng)
                                .setContent("<div class='center'>" + ev.latlng.toString() + "<button id='pilihkoor' class='btn btn-default'>Pilih</button></div>")
                                .openOn(map);
                                currentLatLng = [ev.latlng.lat , ev.latlng.lng];
                            //console.log(ev.latlng.lat+" "+ev.latlng.lng);
                            console.log(currentLatLng);
                        });
                        $('#petaform').on('shown.bs.modal', function(){
                            if($('#koord').val() != "") {
                                let k = $('#koord').val().split(",");;
                                map.setView([k[0],k[1]], 17);
                                popup.setLatLng([k[0],k[1]])
                                    .setContent("<div class='center'>Koordinat Terpilih : " + [k[0],k[1]].toString() + "</div>")
                                    .openOn(map);

                            }
                            map.invalidateSize();
                        });
                        $(document).on('click','#pilihkoor', function(){
                            $('#koord').val(currentLatLng);
                            $('#petaform').modal('hide');
                        })
                        
					});
				</script>

				<!--=== Page Content ===-->
				<div class="row" style="margin-bottom:20px;">
                    <form id="form" class="form-inline validate-form" method="post">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="validate-input col-12 row-flex  " data-validate="Silakan Masukkan Kode Cabang/Lokasi">
                                    <label class="col-lg-3 col-md-4 col-sm-5 col-xs-12 p-0">Kode Cabang/Lokasi</label>
                                    <input type="text" id="kode" name="kode" class="form-control col-lg-5 col-md-6 col-sm-7 col-xs-12" required>
                                </div>
                                <div class="validate-input col-12 row-flex mt-4 " data-validate="Silakan Masukkan Nama Cabang/Lokasi">
                                    <label class="col-lg-3 col-md-4 col-sm-5 col-xs-12 p-0">Nama Cabang/Lokasi</label>
                                    <input type="text" id="nama" name="nama" class="form-control col-lg-5 col-md-6 col-sm-7 col-xs-12" required>
                                </div>
                                <div class="validate-input col-12 row-flex input100-select pt-4 " data-validate="Silakan Pilih Status">
                                    <label class="col-lg-3 col-md-4 col-sm-5 col-xs-12 p-0">Status</label>
                                    <div class="col-lg-2 col-md-3 col-sm-5 col-xs-12 p-0">
                                        <select class="js-select2" name="status" required id="status">
                                            <option value="0">ACTIVE</option>
                                            <option value="1" >SUSPENDED</option>
                                            <option value="2" >CLOSED</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                                <div class="validate-input col-12 row-flex input100-select   " data-validate="Silakan Pilih Provinsi">
                                    <label class="col-lg-3 col-md-4 col-sm-5 col-xs-12 p-0">Provinsi</label>
                                    <div class="col-lg-4 col-md-6 col-sm-7 col-xs-12 p-0">
                                        <select required  id="provinsi" name="provinsi" class="js-select2">
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                                <div class="validate-input col-12 row-flex input100-select   " data-validate="Silakan Pilih Kabupaten/Kota">
                                    <label class="col-lg-3 col-md-4 col-sm-5 col-xs-12 p-0">Kabupaten/Kota</label>
                                    <div class="col-lg-4 col-md-6 col-sm-7 col-xs-12 p-0">
                                        <select required  id="kabupaten" name="kabupaten" class="js-select2">
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                                <div class="validate-input col-12 row-flex input100-select   " data-validate="Silakan Pilih Kecamatan">
                                    <label class="col-lg-3 col-md-4 col-sm-5 col-xs-12 p-0">Kecamatan</label>
                                    <div class="col-lg-4 col-md-6 col-sm-7 col-xs-12 p-0">
                                        <select required  id="kecamatan" name="kecamatan" class="js-select2">
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                                <div class="validate-input col-12 row-flex input100-select   " data-validate="Silakan Pilih Kelurahan/Desa">
                                    <label class="col-lg-3 col-md-4 col-sm-5 col-xs-12 p-0">Kelurahan/Desa</label>
                                    <div class="col-lg-4 col-md-6 col-sm-7 col-xs-12 p-0">
                                        <select required  id="kelurahan" name="kelurahan" class="js-select2">
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                                <div class="col-12 row-flex input100-select mt-sm-4" data-validate="Silakan Pilih Bank Rekening">
                                    <label class="col-lg-3 col-md-4 col-sm-5 col-xs-12 p-0">Bank Rekening</label>
                                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 p-0 my-1">
                                        <select reqs  id="bank_rekening" name="bank_rekening" class="js-select2">
                                            <option value="BNI">BNI</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                                <div class="validate-input col-12 row-flex mt-4 " data-validate="Silakan Masukkan No Rekening">
                                    <label class="col-lg-3 col-md-4 col-sm-5 col-xs-12 p-0">No Rekening</label>
                                    <input type="text" id="no_rekening" name="no_rekening" class="form-control col-lg-5 col-md-6 col-sm-7 col-xs-12" required>
                                </div>
                                <div class="validate-input col-12 row-flex mt-4 " data-validate="Silakan Masukkan Nama Rekening">
                                    <label class="col-lg-3 col-md-4 col-sm-5 col-xs-12 p-0">Nama Rekening</label>
                                    <input type="text" id="nama_rekening" name="nama_rekening" class="form-control col-lg-5 col-md-6 col-sm-7 col-xs-12" required>
                                </div>
                                
                                <div class="col-12 row-flex mt-4 mt-sm-0">
                                    <label class="col-lg-3 col-md-4 col-sm-5 col-xs-6 p-0">Zona Lokasi</label>
                                    <input type="text" id="zona" name="zona" class="col-lg-1 col-md-2 col-sm-3 col-xs-6 p-0" readonly required>
                                </div>
                                <div class="validate-input col-12 row-flex mt-0 mt-sm-3" data-validate="Silakan Pilih Koordinat">
                                    <label class="col-lg-3 col-md-4 col-sm-5 col-xs-12 p-0">Koordinat : </label>
                                    <input type="text" id="koord" name="koord" class="col-lg-5 col-md-6 col-sm-7 col-xs-12 p-0" readonly required>
                                    <a href="#petaform" data-toggle="modal" class="btn btn-lg btn-primary ml-0 ml-lg-4">Sesuaikan Koordinat</a>
                                </div>

                                <div class="pull-left">
                                    <a href="./?p=cabang&id=<?=$_GET['id']?>" class="btn btn-lg btn-warning">Kembali</a>
                                    <button value="SEND" type="submit" class="btn btn-lg btn-primary">
                                            Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="petaform" class="modal" role="dialog">
                    <div class="modal-dialog">
                        <div class="panel panel-primary">
                            <div class="panel-heading">Pilih Koordinat Peta</div>
                            <div class="panel-body">
                                <div id="map" style="height: 30em;"></div>
                            </div>
                            <div class="panel-footer">
                                <button class="btn btn-primary" data-dismiss="modal">Selesai</button>
                            </div>
                        </div>
                    </div>
                </div>

				<?php include "footer.php";?>

				<!-- /Page Content -->
			</div>
		</div>
	</div>
    <script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASgarQtmTLeY_1Um2g02DK6mql-tB5maU&call&callback=initMap"></script>
    <script>
        var obj;
        $(document).ready(function(){
            ambilData('#provinsi');
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
                let koor=$(this)[0].selectedOptions[0].attributes.koor;
                let zona=$(this)[0].selectedOptions[0].attributes.zona;
                if(koor.value != ""){
                    $('#koord').val(koor.value);
                }else{
                    $('#koord').val('');
                    var geocoder = new google.maps.Geocoder();
                    let alamat = $('#kecamatan')[0].selectedOptions[0].text + ", " + $('#kelurahan')[0].selectedOptions[0].text;
                    let a={'region':'id','address': alamat};
                    geocoder.geocode(a, function(results, status) {
                        if (status === 'OK') {
                            results[0]['kode_bps']=($('#kelurahan').val());
                            logging_result(results);
                            var cc = results[0].geometry.location
                            $('#koord').val(cc.lat() + ',' + cc.lng());
                            //koor(name, prof, kab, kec, desa, cc.lat(), cc.lng(), zona, mak, gambar );
                        } else {
                            console.log('Geocode was not successful for the following reason: ' + status);
                        }
                    });
                }
                if(typeof zona !== "undefined"){
                    $('#zona').val(zona.value);
                }else{
                    $('#zona').val('');
                }
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
                            $(obj).append('<option selected disabled>Pilih '+a+'</option>');
                            JSONObject.forEach(function(data){
                                if(a=='kelurahan')console.log(data);
                                $(obj).append('<option value="'+data.id+'" ' +
                                (a=='kelurahan'?(typeof data.koor !== "undefined"?'koor="'+data.koor+'"':'koor'):'koor') +
                                ' zona="'+data.zona+'" pos="'+data.pos+'">'+data.nama+'</option>');
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
                                window.location = "./?p=cabang&id=<?=$_GET['id']?>";
                            }else{
                                alert(JSONObject.pesan);
                            }
                        }
                    }
                    ajaxRequest.open("POST", "./simpan.php", true);
                    


                    var formElement = document.getElementById("form");
                    var formData = new FormData(formElement);
				    formData.set("prod","<?=$_GET['id']?>");
                    formData.set("type","cabang_tambah");
                    <?php
$token = (empty($_SESSION['token'])) ? $_SESSION['token'] = bin2hex(random_bytes(32)) : $_SESSION['token'];?>
                    formData.set("token","<?=$token?>");

                    ajaxRequest.send(formData);
                }
            }
            $(".js-select2").each(function(){
                $(this).select2({
                    minimumResultsForSearch: 2,
                    dropdownParent: $(this).next('.dropDownSelect2')
                });
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
                    if($(input).val().trim() == ''){
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
