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
                            <a href="#" title="">Produk <?=$produk[0]['PROD_NAMA']?></a>
                        </li>
                        <li class="current">
							<a href="#" title="">Ubah Data Peserta</a>
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
                <style>
                    h3{margin-top: 0;width: 100%;font-weight: 500;}
                    .hvr{border: 1px solid #ccc;}</style>
				<script type="text/javascript" src="<?=getUrlServer()?>/assets/template/ContactFrom_v5/vendor/select2/js/select2.min.js"></script>
				<script>
                    function getUrlVars() {
                        var vars = {};
                        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
                            vars[key] = value;
                        });
                        return vars;
                    }
                    function getUrlParam(parameter, defaultvalue){
                        var urlparameter = defaultvalue;
                        if(window.location.href.indexOf(parameter) > -1){
                            urlparameter = getUrlVars()[parameter];
                            }
                        return urlparameter;
                    }
					$(document).ready(function(){
                        $(".js-select2").each(function(){
							$(this).select2({
								minimumResultsForSearch: 2,
								dropdownParent: $(this).next('.dropDownSelect2')
							});
						});
					});
				</script>
                <div class="row" style="margin-bottom:20px;">
                    <form id="form" class="form-inline validate-form" method="post">
                        <input type="hidden" name="id" value="<?=$data['ID_KEY']?>">
                        <input type="hidden" id="ktp2" name="ktp2" value="<?=$data['TRX_KTP_ID']?>">
                        <div class="panel">
                            <div class="panel-body row-flex">
                                <?php $c=(count($produk)+1)/3==1?4:3;?>
                                <div class="col-<?=$c?>" >
                                    <label class="text-truncate col-12">No PKS</label>
                                    <input readonly type="text" class="form-control col-12" id="pks_mou" value="<?=$produk[0]['PROD_LEGAL']?>">
                                </div>
                                <?php foreach ($produk as $index => $subProd) {?>
                                <div class="col-<?=$c?>" >
                                    <label class="text-truncate col-12" title="Premi Dasar (%) <?=$subProd['PROD_NAMA_CHILD']?>">Premi Dasar (%) <?=$subProd['PROD_NAMA_CHILD']?></label>
                                    <input readonly type="text" class="form-control col-12 premiSubProd" value="<?=$subProd['PROD_PREMI']?>">
                                </div>
                                <?php }?>
                            </div>
                        </div>
                        <div class="panel">
                            <div class="panel-heading">
                               <h2>Data Peserta</h2>
                               Isikan data Peserta dengan lengkap dan benar
                            </div>
                            <div class="panel-body">
                                <div class="validate-input col-12 row-flex" data-validate="Silakan Masukkan KTP/Loan ID">
                                    <label for="ktp" class="col-lg-4 col-md-5 col-sm-5 col-xs-12 p-0">No KTP/Loan ID Peserta</label>
                                    <input type="text" id="ktp" name="ktp" placeholder="No KTP/LOAN ID Peserta" value="<?=$data['TRX_KTP_ID']?>" class="form-control col-lg-5 col-md-6 col-sm-7 col-xs-12" required>
                                </div>
                                <div class="mt-sm-4 validate-input col-12 row-flex" data-validate="Silakan Masukkan Nama">
                                    <label for="nama" class="col-lg-4 col-md-5 col-sm-5 col-xs-12 p-0">Nama Peserta
                                        <!-- <span>Isi nama lengkap Peserta sesuai dengan yang tertera di NO KTP / LOAD ID Peserta.</span> -->
                                    </label>
                                    <input type="text" id="nama" name="nama" placeholder="Nama Peserta" value="<?=$data['TRX_NAMA']?>" class="form-control col-lg-5 col-md-6 col-sm-7 col-xs-12" required>
                                </div>
                                <div class="mt-sm-4 input100-select col-12 row-flex">
                                    <label for="usaha" class="col-lg-4 col-md-5 col-sm-5 col-xs-12 p-0">Sektor Usaha Peserta</label>
                                    <div class="col-lg-5 col-md-6 col-sm-7 col-xs-12 p-0">
                                        <select required name="usaha" class="js-select2" id="usaha">
                                            <option value="" selected disabled>Pilih Sektor Usaha</option>
                                            <?php
        $perintah = 'SELECT * FROM ma9002 WHERE PROD_ID="'.$_GET['id'].'" AND ENTITY_ID="' . $_SESSION['user_cli_group'] . '" ORDER BY SUSA_NAMA ASC'; //';
        $query = mysqli_query($conection, $perintah);
        while ($row = mysqli_fetch_array($query)) {
            ?>
                                            <option <?=($data['SUSA_ID'] == $row['SUSA_ID']) ? 'selected' : null?> value="<?=$row['SUSA_ID']?>"><?=$row['SUSA_NAMA']?></option>
        <?php }?>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                                <div class="validate-input col-12 row-flex" data-validate="Silakan Masukkan Tanggal Lahir">
                                    <label for="lahir" class="col-lg-4 col-md-5 col-sm-5 col-xs-12 p-0">Tanggal Lahir Peserta</label>
                                    <input type="date" id="lahir" name="lahir" value="<?=$data['TRX_TGL_LAHIR']?>" class="form-control col-xl-2 col-lg-3 col-md-4 col-sm-4 col-xs-12" required value="">
                                </div>
                                <div class="mt-sm-4 validate-input col-12 row-flex mt-sm-4" data-validate = "Silakan Masukkan Alamat Anda">
                                    <label for="alamat" class="col-lg-4 col-md-5 col-xs-12 p-0">Alamat Peserta
                                        <!-- <span>Isi Nama Jalan, No Rumah, RT, RW, Kelurahan, Kecamatan, Provinsi.</span> -->
                                    </label>
                                    <textarea class="form-control col-lg-8 col-md-7 col-xs-12" name="alamat" id="alamat" placeholder="Alamat Peserta"><?=$data['TRX_ALAMAT']?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="panel">
                            <div class="panel-heading">
                               <h2>Data Peserta (Lanjutan)</h2>
                               Isikan data Peserta dengan lengkap dan benar
                            </div>
                            <div class="panel-body row-flex">
                                <div class="input100-select col-12 row-flex m-0">
                                    <label for="cabang" class="col-lg-3 col-md-5 col-sm-5 col-xs-12 p-0">Cabang</label>
                                    <div class="col-lg-4 col-sm-6 col-xs-12 p-0">
                                        <select required  id="cabang" name="cabang" class="js-select2">
                                            <option selected disabled>Pilih Cabang</option>
        <?php
        $perintah2 = ' SELECT LOKASI_ID,LOKASI_NAMA,nama,zonasi FROM ma1003 ' .
            ' LEFT JOIN daerah3 ON LOKASI_KELURAHAN=kode_wilayah_bps' .
            ' WHERE LOKASI_STATUS="0" AND ENTITY_ID="' . $_SESSION['user_cli_group'] . '"' .
            ' AND PROD_ID = "'.$_GET['id'].'" '.
            (empty($_SESSION['user_cabang_key']) ? null : " AND ID_KEY=$_SESSION[user_cabang_key]").
            ' GROUP BY LOKASI_ID ORDER BY zonasi DESC';
        $hasil2 = mysqli_query($conection, $perintah2);
        while ($row = mysqli_fetch_array($hasil2)) {
            if (is_null($row['zonasi'])) {?>
                                <option disabled <?=(empty($_SESSION['user_cabang_key']) ? null : "selected")?> ><?=$row['LOKASI_NAMA']?> berada di wilayah <?=$row['nama']?> dan wilayah ini belum terdaftar zona gempa, Silakan Hubungi Admin Biru</option>
            <?php } else {?>
                                <option zona="<?=$row['zonasi']?>" value="<?=$row['LOKASI_ID']?>" <?=(empty($_SESSION['user_cabang_key']) ? null : "selected")?> ><?=$row['LOKASI_NAMA']?></option>
            <?php }?>
        <?php }?>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                                <div class="validate-input col-12 row-flex m-0" data-validate = "Plafond Pembayaran">
                                    <label for="plafond" class="col-lg-3 col-md-5 col-sm-5 col-xs-12 p-0">Plafond Pembiayaan</label>
                                    <span class="align-self-center col-xs-1 p-0"><?=$produk[0]['PROD_CURR']?></span>
                                    <input name="plafond" id="plafond" type="text" value="<?=$data['TRX_PLAFOND']?>" required class="form-control col-lg-3 col-sm-5 col-xs-8" style="text-align:right" placeholder="0.00">
                                </div>
                                <div class="mt-sm-4 validate-input col-12 row-flex m-0" data-validate="Silahkan Masukkan Pencairan ID">
                                    <label for="pencairan" class="col-lg-3 col-md-5 col-sm-5 col-xs-12 p-0">Pencairan ID</label>
                                    <input class="form-control col-lg-4 col-sm-6 col-xs-12" id="pencairan" value="<?=$data['TRX_PENCAIRAN']?>" required type="text" name="pencairan" placeholder="Pencairan ID">
                                </div>
                                <div class="mt-sm-4 validate-input col-12 row-flex m-0" data-validate="Silahkan Masukkan Tanggal Pencariran">
                                    <label for="tanggal_pencairan" class="col-lg-3 col-md-5 col-sm-5 col-xs-12 p-0">Tanggal Pencairan</label>
                                    <input value="<?=$data['TRX_TGL_CAIR']?>"  class="form-control col-xl-2 col-lg-3 col-md-4 col-sm-4 col-xs-12" id="tanggal_pencairan" required type="date" name="tanggal_pencairan">
                                </div>
                                <div class="mt-sm-4 validate-input col-12 row-flex m-0" data-validate="Silahkan Masukkan Jumlah Minggu">
                                    <label for="minggu" class="col-lg-3 col-md-5 col-sm-5 col-xs-12 p-0">Jumlah Minggu</label>
                                    <input type="number" min="1" value="<?=$data['TRX_JML_MINGG']?>" required class="form-control col-xl-2 col-lg-3 col-md-4 col-sm-4 col-xs-12" name="minggu" id="minggu" placeholder="Jumlah Minggu">
                                </div>
                                <div class="mt-sm-4 validate-input col-12 row-flex m-0" style="margin-left:unset" data-validate="Silahkan Masukkan Tanggal Awal">
                                    <label for="awal_periode" class="col-lg-3 col-md-5 col-sm-5 col-xs-12 p-0">Awal Periode</label>
                                    <input class="form-control col-xl-2 col-lg-3 col-md-4 col-sm-4 col-xs-12" value="<?=$data['TRX_START_PRO']?>" id="awal_periode" required type="date" name="awal_periode">
                                </div>
                                <div class="mt-sm-4 validate-input col-12 row-flex m-0" data-validate="Silahkan Masukkan Tanggal Akhir">
                                    <label for="akhir_periode" class="col-lg-3 col-md-5 col-sm-5 col-xs-12 p-0">Akhir Periode</label>
                                    <input class="form-control col-xl-2 col-lg-3 col-md-4 col-sm-4 col-xs-12" value="<?=$data['TRX_END_PRO']?>" min="<?=$data['TRX_START_PRO']?>" id="akhir_periode" required type="date" name="akhir_periode">
                                </div>
                                <div class="mt-sm-4 validate-input col-12 row-flex m-0" data-validate="Silahkan Masukkan Nilai UK">
                                    <label for="uk" class="col-lg-3 col-md-5 col-sm-5 col-xs-12 p-0">Nilai UK</label>
                                    <input type="text" min="0" value="<?=$data['TRX_NILAI_UK']?>"  style="text-align:right" required class="form-control col-lg-4 col-sm-6 col-xs-12" name="uk" id="uk" placeholder="0.00">
                                </div>
                                <div class="col-12 mt-sm-4 row-flex m-0" >
                                    <label class="col-lg-3 col-md-5 col-sm-5 col-xs-12 p-0">Premi</label>
                                    <input type="text" style="text-align:right" readonly class="form-control col-lg-4 col-sm-6 col-xs-12 " value="<?=$data['TRX_PREMI']?>" name="premi_pinjam" id="premi_pinjam" placeholder="0.00">
                                </div>
                            </div>
                        </div>  
                        <div class="pull-right">
                            <a href="./?p=peserta&a=settlement&id=<?=$_GET['id']?>" class="btn btn-lg btn-warning ">Kembali</a>
                            <button value="SEND" type="submit" class="btn btn-lg btn-primary">
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
            $('#produk').on('change',function(x){
				var d=$($('#produk option:selected')[0]);
                $('#pks_mou').text(d.attr('pks_mou'));
                $('#premi').text(d.attr('premi'));
                $('#mata_uang').val(d.attr('curr'));
			});
			let produk=getUrlParam('id',false);
            $('#produk').val(produk).select2();
            $('#produk').trigger('change');
            $('#plafond,#uk').on('focusin',function(){
                $(this).val(formatNumber($(this).val()));
            });
            $('#plafond').val(formatMoney($('#plafond').val(), 2, ".", ","));
            $('#uk').val(formatMoney($('#uk').val(), 2, ".", ","));
            $('#premi_pinjam').val(formatMoney($('#premi_pinjam').val(), 2, ".", ","));
            $('#plafond,#uk').on('focusout',function(){
                $(this).val(formatMoney(formatNumber($(this).val()), 2, ".", ","));
            });

			$('#awal_periode').on('change',function(){
				$('#akhir_periode').val("");
				$('#akhir_periode').attr("min",this.value);
			});
			$('#cabang,#lahir').on('change',function(){
				hitungPremi();
			});
			$('#premi, #plafond').on('keyup ',function(){
				hitungPremi();
			});
            function hitungPremi(){
                $('#premi_pinjam').val('Menghitung ...');
                var zona=$($('#cabang option:selected')[0]).attr('zona'),
                    cabang=$('#cabang').val(),
                    lahir=$('#lahir').val(),
                    plafond=formatNumber($('#plafond').val());
                $.ajax({
                    url : "ambil_data.php?type=hitungpremi",
                    data: {kode:'<?=$_GET['id']?>',nilai:plafond,zona:zona,cabang:cabang,lahir:lahir},
                    type: "get",
                    dataType:"json",
                    success:function(result){
                        console.log(result);
                        if(result[0]==false){
                            $('#premi_pinjam').val(result.pesan);
                        }else{
                            let hasil=result.premi;
                            if( ! isNaN(hasil) )
                                $('#premi_pinjam').val(formatMoney(hasil, 2, ".", ","));
                        }
                    },
                    error: function(xhr, Status, err) {
                        $('#premi_pinjam').val('Gagal menghitung');
                        alert("Terjadi error : "+Status+" : ");
                    }
                });
            }
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
                                window.location = "./?p=peserta&a=settlement&id=<?=$_GET['id']?>";
                            }else{
                                alert(JSONObject.pesan);
                            }
                        }
                    }
                    ajaxRequest.open("POST", "./simpan.php", true);

                    var formElement = document.getElementById("form");
                    var formData = new FormData(formElement);
                    formData.set("type","peserta_ubah");
                    formData.set("produk","<?=$_GET['id']?>");
                    <?php
$token = (empty($_SESSION['token'])) ? $_SESSION['token'] = bin2hex(random_bytes(32)) : $_SESSION['token'];
?>
                    formData.set("token","<?=$token?>");

                    ajaxRequest.send(formData);
                }
            }
        });
	</script>
