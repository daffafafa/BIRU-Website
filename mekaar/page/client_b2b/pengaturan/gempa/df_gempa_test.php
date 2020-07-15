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
							<a href="#" title="">Data</a>
                        </li>
                        <li>
							<a href="./?p=gempa" title="">Gempa >= 5 SR</a>
						</li>
						<li class="current">
							<a href="#" title="">Tambah Gempa</a>
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
                    #skala,#dalam{text-align:right}
                    </style>
				<script src="<?=getUrlServer()?>/assets/template/ContactFrom_v5/js/main.js"></script>
				<script type="text/javascript" src="<?=getUrlServer()?>/assets/template/ContactFrom_v5/vendor/select2/js/select2.min.js"></script>
                <script>
                    var obj,obj2;
					$(document).ready(function(){
                        var currentLatLng=[-6.186635429683865,106.8318271636963];
                        var osm = L.tileLayer("http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                            maxZoom: 20,
                            subdomains: ['a' , 'b' , 'c'],
                            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>" '
                        });
                        var map = L.map("map", {
                            zoom: 10,
                            center: currentLatLng,
                            layers: [osm],
                            zoomControl: true,
                            attributionControl: true
                        });
<?php
$sql = ' SELECT d.ENTITY_ID,d.LOKASI_ID,d.LOKASI_NAMA,d.lat,d.lng,COUNT(c.ID_KEY) JUMLAH ' .
    ' FROM tr0002_b2c a ' .
    ' JOIN ma2001 b ON b.PROD_ID=a.SUB_PROD_ID AND b.PROD_TYPE="dca eq" ' .
    ' JOIN tr0001 c ON c.TRX_UUID=a.TRX_SYSTEM_ID ' .
    ' JOIN ma1003 d ON d.LOKASI_ID=c.CABANG_ID ' .
    ' WHERE c.TRX_STATUS=1 AND a.EQ_SYSTEM_ID IS NULL ' .
    ' GROUP BY d.LOKASI_ID' .
    '  ';
$query = mysqli_query($conection, $sql);
if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_array($query)) {
        ?>
                        var <?=$row['ENTITY_ID']?> = L.marker([<?=$row['lat']?>,<?=$row['lng']?>])
                        .bindTooltip("<?=$row['LOKASI_NAMA'] . ' (' . $row['JUMLAH'] . ' Peserta)'?>").openTooltip()
                        .addTo(map);
<?php
}
}
?>
<?php
    $sql = 'SELECT c.SUB_PROD_ID,CONCAT(a.PROD_NAMA,"-",b.PROD_NAMA) PROD_NAMA,c.JARAK_TERDEKAT,c.JARAK_TERJAUH '.
    ' FROM ma2001 b '.
    ' JOIN ma2001 a ON b.PROD_ID_PARENT=a.PROD_ID '.
    ' JOIN dca001 c ON c.SUB_PROD_ID=b.PROD_ID '.
    ' WHERE a.PROD_LEVEL=0 AND b.PROD_LEVEL=1 AND b.PROD_TYPE="dca eq" '.
    ' GROUP BY c.JARAK_TERJAUH '.
    ' ORDER BY c.SUB_PROD_ID,c.JARAK_TERJAUH DESC '
    ;
    $query = mysqli_query($conection, $sql);
$radiusProd = array();
if (mysqli_num_rows($query) > 0) 
{
    while ($row = mysqli_fetch_array($query)) 
    {
        if( ! array_key_exists($row['SUB_PROD_ID'] ,$radiusProd))
        {
            $radiusProd[$row['SUB_PROD_ID']] = array(
                    'nama' => $row['PROD_NAMA'],
                    'jarak' => array(
                        array(
                            'terdekat' => $row['JARAK_TERDEKAT'],
                            'terjauh' => $row['JARAK_TERJAUH'],
                        )
                    )
            );
        }
        else
        {
            $radiusProd[$row['SUB_PROD_ID']]['jarak'][] = array(
                'terdekat' => $row['JARAK_TERDEKAT'],
                'terjauh' => $row['JARAK_TERJAUH'],
            );
        }
    }
}
                        $allGroupCircle = array();
                        foreach($radiusProd as $prod_id => $obj)
                        {
                            if( ! in_array("group$prod_id", $allGroupCircle) ){ $allGroupCircle[] = "group$prod_id";}
                            echo "var group$prod_id = L.featureGroup();";
                            foreach($obj['jarak'] as $key => $obj2)
                            {
                                echo "var ${prod_id}$key = L.circle(currentLatLng, {color: '#000',opacity: 1,fillOpacity: 0.01, radius: " . ($obj2['terjauh']*1000) . "}).addTo(group$prod_id);";
                                //.bindPopup('".$obj2['terjauh']." km')
                            }
                        }
                        echo "var allGroupCircle=[".implode(',',$allGroupCircle)."];";
                        
?>

                        var popup = L.popup();
                        var activeGroupCircle = <?=current($allGroupCircle)?>;
                        function removeGroupCircleLayer (){
                            <?php 
                                foreach($radiusProd as $prod_id => $obj)
                                {
                                    echo "map.removeLayer(group${prod_id});";
                                }
                            ?>
                        }
                        map.on("click", function(ev) {
                            removeGroupCircleLayer();
                            map.addLayer(activeGroupCircle);
                            popup
                                .setLatLng(ev.latlng)
                                .setContent("<div class='center'><button id='pilihkoor' type='button' class='btn btn-default'>Pilih</button></div>")
                                .openOn(map);
                            currentLatLng = [ev.latlng.lat , ev.latlng.lng];
                            $('#koord').val(currentLatLng);
                            <?php 
                                foreach($radiusProd as $prod_id => $obj)
                                {
                                    foreach($obj['jarak'] as $key => $obj2)
                                    {
                                        echo "${prod_id}$key.setLatLng(currentLatLng);";
                                    }
                                }
                            ?>
                            console.log(currentLatLng);
                        });
                        $('#radius').on('change',function(){
                            activeGroupCircle = allGroupCircle[this.value];
                        });
                        // $('#petaform').on('shown.bs.modal', function(){
                        //     if($('#koord').val() != "") {
                        //         let k = $('#koord').val().split(",");;
                        //         map.setView([k[0],k[1]], 10);
                        //         circle5km.setLatLng([k[0],k[1]]);
                        //         circle10km.setLatLng([k[0],k[1]]);
                        //         circle15km.setLatLng([k[0],k[1]]);
                        //         circle20km.setLatLng([k[0],k[1]]);
                        //         popup.setLatLng([k[0],k[1]])
                        //             .setContent("<div class='center'>Koordinat Terpilih : " + [k[0],k[1]].toString() + "</div>")
                        //             .openOn(map);
                        //     }
                        //     map.invalidateSize();
                        // });
                        $(document).on('click','#pilihkoor',function(){
                            $('#koord').val(currentLatLng);
                            $('#petaform').modal("hide");
                            popup._close();
                            scrollTo(0,0);
                        });

                        $(".js-select2").each(function(){
							$(this).select2({
								minimumResultsForSearch: 2,
								dropdownParent: $(this).next('.dropDownSelect2')
							});
						});
                        $('#skala,#dalam').on('keydown',function(e){
                            if(e.key.length==1)
                                if((isNaN(e.key) || e.key == " ") && e.key != ".")
                                    e.preventDefault();
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
                        function simpan(){
                            if(confirm("Tambah Gempa?")){
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
                                        }else{
                                            alert(JSONObject.pesan);
                                        }
                                    }
                                }
                                ajaxRequest.open("POST", "./proses_gempa.php", true);
                                

                                var formElement = document.getElementById("form");
                                var formData = new FormData(formElement);
                                formData.set("type","test");
                                <?php $token = (empty($_SESSION['token'])) ? $_SESSION['token'] = bin2hex(random_bytes(32)) : $_SESSION['token'];?>
                                formData.set("token","<?=$token?>");

                                ajaxRequest.send(formData);
                            }
                        }
                   });
				</script>

				<!--=== Page Content ===-->
				<div class="row" style="margin-bottom:20px;">
                    <form id="form" class="form-inline validate-form" method="post">
                        <div class="panel">
                            <div class="panel-body row-flex">
                                <div class="col-4 validate-input" data-validate="Silakan Masukkan Skala Gempa">
                                    <label class="text-truncate col-12">Skala Gempa (SR) :</label>
                                    <input required type="text" class="form-control col-12" id="skala" name="skala">
                                </div>
                                <div class="col-4 validate-input" data-validate="Silakan Masukkan Kedalaman Gempa">
                                    <label class="text-truncate col-12">Kedalaman (KM) :</label>
                                    <input required type="text" class="form-control col-12" id="dalam" name="dalam">
                                </div>
                                <div class="col-4 validate-input" data-validate="Silakan Pilih Koordinat">
                                    <label class="text-truncate col-12">Koordinat :</label>
                                    <input required type="text" class="form-control col-12" readonly id="koord" name="koord">
                                </div>
                                <div class="mt-sm-4 col-12">
                                    <div class="pull-right">
                                        <a href="./?p=gempa" class="btn btn-lg btn-warning ">Kembali</a>
                                        <button value="SEND" type="submit" class="btn btn-lg btn-primary">
                                            <span>
                                                Tambah Gempa
                                                <i class="icon-angle-right"></i>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                                <div class="row-flex mt-sm-4 ml-4 input100-select col-8">
                                    <label for="radius" class="col-lg-4 col-md-5 col-sm-5 col-xs-12 p-0">Radius Jangkauan Produk </label>
                                    <div class="col-lg-5 col-md-6 col-sm-7 col-xs-12 p-0">
                                        <select class="js-select2" id="radius" name="radius">
<?php
$i=0;
    foreach($radiusProd as $prod_id => $obj){
        echo "<option value='".($i++)."'>".$obj['nama']."</option>";
    }
?>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                                
                                <div class="col-12" >
                                    <div id="map" style="height:40em;"></div>
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