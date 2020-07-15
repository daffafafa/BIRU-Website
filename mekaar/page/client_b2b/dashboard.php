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
							<a href="#">Dasbor</a>
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
				<div class="page-header"></div>
				<!--=== Page Content ===-->
				<!-- /leaflet -->
                <!--link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
                <script-- src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script-->
                <link rel="stylesheet" href="<?=getUrlServer()?>/plugins/leaflet/leaflet.css" />
                <script src="<?=getUrlServer()?>/plugins/leaflet/leaflet.js"></script>
				<script>
					$(document).ready(function(){
                        var currentLatLng=[-1.0546279422758742,117.15820312500001];
                        var osm = L.tileLayer("http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                            maxZoom: 20,
                            subdomains: ['a' , 'b' , 'c'],
                            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>" '
                        });
                        var map = L.map("map", {
                            zoom: 5,
                            center: currentLatLng,
                            layers: [osm],
                            zoomControl: true,
                            attributionControl: true
                        });
<?php
$sql = ' SELECT a.SUB_PROD_ID,d.ENTITY_ID,d.LOKASI_ID,d.LOKASI_NAMA,a.KOOR_LAT lat,a.KOOR_LANG lng,COUNT(c.ID_KEY) JUMLAH ' .
    ' FROM tr0002_b2c a ' .
    ' JOIN ma2001 b ON b.PROD_ID=a.SUB_PROD_ID AND b.PROD_TYPE="dca eq" ' .
    ' JOIN tr0001 c ON c.TRX_UUID=a.TRX_SYSTEM_ID ' .
    ' JOIN ma1003 d ON d.LOKASI_ID=c.CABANG_ID ' .
    ' JOIN ma2003 e ON b.PROD_ID=e.PROD_ID AND e.SHA_ENTITY="' . $_SESSION['user_cli_group'] . '" ' .
    ' WHERE NOT c.TRX_STATUS=0 AND a.EQ_SYSTEM_ID IS NULL ' .
    ' GROUP BY d.LOKASI_ID,a.SUB_PROD_ID ';
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
                        map.on("click", function(ev) {
                            currentLatLng = [ev.latlng.lat , ev.latlng.lng];
                            //console.log(ev.latlng.lat+" "+ev.latlng.lng);
                            console.log(currentLatLng);
                        });
					});
				</script>

				<div class="row">
					<div class="col-md-12">
                        <div class="widget box">
							<div class="widget-header">
								<h3> Latest Earth Quake </h3>
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
                                        <h5>Sumber Data : BMKG (Badan Meteorologi, Klimatologi, dan Geofisika). <a target="_blank" href="https://www.bmkg.go.id/gempabumi/gempabumi-terkini.bmkg">Kunjungi Situs</a></h5>
									</div>
									<div class="col-md-9">
                                        <table class="table table-striped table-bordered table-hover table-checkable table-responsive">
                                            <thead>
                                                <tr>
                                                    <th class="checkbox-column" style="display:none">
                                                        <input type="checkbox" class="uniform">
                                                    </th>
                                                    <th >Waktu</th>
                                                    <th data-hide="always">Lintang</th>
                                                    <th data-hide="always">Bujur</th>
                                                    <th >Magnitude</th>
                                                    <th data-hide="always">Kedalaman</th>
                                                    <th >Wilayah</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
$xml = simplexml_load_file("http://data.bmkg.go.id/gempaterkini.xml");
//$xml = array();
$t = 5; //count($xml);
for ($i = 0; $i < $t; $i++) {
    ?>
                                                <tr>
                                                    <td class="checkbox-column" style="display:none">
                                                        <input type="checkbox" class="uniform">
                                                    </td>
                                                    <td><?=$xml->gempa[$i]->Tanggal . ' ' . $xml->gempa[$i]->Jam?></td>
                                                    <td><?=$xml->gempa[$i]->Lintang?></td>
                                                    <td><?=$xml->gempa[$i]->Bujur?></td>
                                                    <td><?=$xml->gempa[$i]->Magnitude?></td>
                                                    <td><?=$xml->gempa[$i]->Kedalaman?></td>
                                                    <td><?=$xml->gempa[$i]->Wilayah?></td>
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
					<div class="col-md-12">
                        <div class="widget box">
							<div class="widget-header">
								<h3> Persebaran Peserta </h3>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content">
								<div id="map" style="height: 40em;"></div>
							</div>
					    </div>
					</div>
				</div>
				<?php include "footer.php";?>

				<!-- /Page Content -->
			</div>
		</div>
	</div>
	<script>

	</script>
