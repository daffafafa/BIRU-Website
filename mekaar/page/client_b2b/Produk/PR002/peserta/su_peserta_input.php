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
							<a href="#" title="">Entry Data Peserta</a>
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
				<link rel="stylesheet" type="text/css" href="<?=getUrlServer()?>/assets/template/ContactFrom_v5/fonts/iconic/css/material-design-iconic-font.min.css">
				<link rel="stylesheet" type="text/css" href="<?=getUrlServer()?>/assets/template/ContactFrom_v5/css/util.css">
				<link rel="stylesheet" type="text/css" href="<?=getUrlServer()?>/assets/template/ContactFrom_v5/css/main.css">
                <style>
                    h3{margin-top: 0;width: 100%;font-weight: 500;}
                    .pbb0{display:block;font-size:24px}
                    .pbb3{width:calc(20% - 20px)}.pbb4{width:calc(80% - 30px)}
                    .pbb{height:30px;font-size:13px !important;color:#555555;font-weight:bold}
                    .hvr{border: 1px solid #ccc;}</style>
				<script src="<?=getUrlServer()?>/assets/template/ContactFrom_v5/js/main.js"></script>
				<script type="text/javascript" src="<?=getUrlServer()?>/assets/template/ContactFrom_v5/vendor/select2/js/select2.min.js"></script>
				<script>
                    function getUrllets() {
                        let lets = {};
                        let parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
                            lets[key] = value;
                        });
                        return lets;
                    }
                    function getUrlParam(parameter, defaultvalue){
                        let urlparameter = defaultvalue;
                        if(window.location.href.indexOf(parameter) > -1){
                            urlparameter = getUrllets()[parameter];
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
                    <form id="form" class="contact100-form form-horizontal validate-form" method="post">
                        <div class="wrap-input100 bg1 rs2-wrap-input100" >
                            <span class="label-input100">No PKS</span>
                            <input readonly type="text" class="input100" id="pks_mou" value="<?=$produk[0]['PROD_LEGAL']?>">
                        </div>
                        <?php foreach ($produk as $index => $subProd) {?>
                        <div class="wrap-input100 bg1 rs2-wrap-input100" >
                            <span class="label-input100">Premi Dasar (%) <?=$subProd['PROD_NAMA_CHILD']?></span>
                            <input readonly type="text" class="input100" id="premi" value="<?=$subProd['PROD_PREMI']?>">
                        </div>
                        <?php }?>
                        <h3>--- Data Peserta ---</h3>
                        <div class="wrap-input100 validate-input bg1 rs1-wrap-input100" data-validate="Silakan Masukkan KTP/Loan ID">
                            <span class="label-input100">No KTP/Loan ID Peserta</span>
                            <input type="text" id="ktp" name="ktp" placeholder="isi ktp/loan id" class="input100" required>
                        </div>
                        <div class="wrap-input100 validate-input bg1 rs1-wrap-input100" data-validate="Silakan Masukkan Nama">
                            <span class="label-input100">Nama Peserta</span>
                            <input type="text" id="nama" name="nama" placeholder="isi nama" class="input100" required>
                        </div>
                        <div class="wrap-input100 input100-select bg1 rs1-wrap-input100 ">
                            <span class="label-input100">Sektor Usaha Peserta</span>
                            <div>
                                <select required name="usaha" class="js-select2" id="usaha">
                                    <option value="" selected disabled>Pilih Sektor Usaha</option>
                                    <?php
$perintah = 'SELECT * FROM ma9002 WHERE PROD_ID="'.$_GET['id'].'" AND ENTITY_ID="' . $_SESSION['user_cli_group'] . '" ORDER BY SUSA_NAMA ASC'; //';
$query = mysqli_query($conection, $perintah);
while ($data = mysqli_fetch_array($query)) {
    ?>
                                    <option value="<?=$data['SUSA_ID']?>"><?=$data['SUSA_NAMA']?></option>
<?php }?>
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>
                        </div>
                        <div class="wrap-input100 validate-input bg1 rs1-wrap-input100" data-validate="Silakan Masukkan Tanggal Lahir">
                            <span class="label-input100">Tanggal Lahir Peserta</span>
                            <input type="date" id="lahir" name="lahir" class="input100" required value="">
                        </div>
                        <div class="wrap-input100 validate-input bg1 rs1-has-error has-feedback" data-validate = "Silakan Masukkan Alamat Anda">
                            <span class="label-input100">Alamat Peserta</span>
                            <textarea class="input100" name="alamat" placeholder="isi alamat"></textarea>
                        </div>
                        <h3>--- Data Peserta ---</h3>
                        <div class="wrap-input100 input100-select bg1 rs2-wrap-input100 ">
                            <span class="label-input100">Cabang</span>
                            <div>
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
                        <div class="wrap-input100 validate-input bg1 rs23-wrap-input100" data-validate = "Plafond Pembayaran">
							<span class="label-input100">Plafond Pembiayaan</span>
							<div class="pbb0">
                                <input readonly class="pbb pbb3" name="mata_uang" id="mata_uang" value="<?=$produk[0]['PROD_CURR']?>">
								&nbsp;&nbsp;&nbsp;&nbsp;
                                <input name="plafond" id="plafond" type="text" required class="pbb hvr pbb4" style="text-align:right" paceholder="isi pembayaran">
                            </div>
                        </div>
                        <div class="wrap-input100 validate-input bg1 rs2-wrap-input100" data-validate="Silahkan Masukkan Pencairan ID">
                            <span class="label-input100">Pencairan ID</span>
                            <input class="input100" id="pencairan" required type="text" name="pencairan" placeholder="isi pencairan id">
                        </div>
                        <div class="wrap-input100 validate-input bg1 rs2-wrap-input100" data-validate="Silahkan Masukkan Tanggal Pencariran">
                            <span class="label-input100">Tanggal Pencairan</span>
                            <input value="<?=date('Y-m-d')?>" class="input100" id="tanggal_pencairan" required type="date" name="tanggal_pencairan">
                        </div>
                        <div class="wrap-input100 validate-input bg1 rs2-wrap-input100" data-validate="Silahkan Masukkan Jumlah Minggu">
                            <span class="label-input100">Jumlah Minggu</span>
                            <input type="number" min="1" required class="input100" name="minggu" id="minggu" placeholder="isi jumlah minggu">
                        </div>
                        <div class="wrap-input100 validate-input bg1 rs1-wrap-input100" data-validate="Silahkan Masukkan Tanggal Awal">
                            <span class="label-input100">Awal Periode</span>
                            <input class="input100" value="<?=date('Y-m-d')?>" id="awal_periode" required type="date" name="awal_periode">
                        </div>
                        <div class="wrap-input100 validate-input bg1 rs1-wrap-input100" data-validate="Silahkan Masukkan Tanggal Akhir">
                            <span class="label-input100">Akhir Periode</span>
                            <input class="input100" value="<?=date('Y-m-d')?>" min="<?=date('Y-m-d')?>" id="akhir_periode" required type="date" name="akhir_periode">
                        </div>
                        <div class="wrap-input100 validate-input bg1 rs1-wrap-input100" data-validate="Silahkan Masukkan Nilai UK">
                            <span class="label-input100">Nilai UK</span>
                            <input type="text" min="0" style="text-align:right" required class="input100" name="uk" id="uk">
                        </div>
                        <div class="wrap-input100 bg1 rs1-wrap-input100" >
                            <span class="label-input100">Premi</span>
                            <input type="text" style="text-align:right" readonly class="input100 " name="premi_pinjam" id="premi_pinjam">
                        </div>
                        <div class="container-contact100-form-btn">
                            <a href="./?p=peserta&a=settlement&id=<?=$_GET['id']?>" class="contact100-form-btn btn btn-warning ">Kembali</a>
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
		$(document).ready(function(){
            let produk=getUrlParam('id',false);
            $('#produk').val(produk).select2();
            $('#produk').trigger('change');
            $('#plafond,#uk').on('focusin',function(){
                $(this).val(formatNumber($(this).val()));
            });
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
			$('#plafond').on('keyup ',function(){
				hitungPremi();
			});

            function hitungPremi(){
                $('#premi_pinjam').val('Menghitung ...');
                let zona=$($('#cabang option:selected')[0]).attr('zona'),
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
                /*
                let rate=$($('#cabang option:selected')[0]).attr('rate'),
                    premiDCA=$('#premi').val(),


                */
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
								let pattern=/^[0-9]{18}$/i;
								let m=$(input).val().trim().match(pattern);
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
							let thisAlert = $(input).parent();

							$(thisAlert).addClass('has-error has-feedback');
							$(thisAlert).append('<span class="glyphicon glyphicon-remove form-control-feedback btn-hide-validate"></span>')
							$('.btn-hide-validate').each(function(){
								$(this).on('click',function(){
								hideValidate(this);
								});
							});
						}
						function hideValidate(input) {
							let thisAlert = $(input).parent();
							$(thisAlert).removeClass('has-error has-feedback');
							$(thisAlert).find('.btn-hide-validate').remove();
						}

            function simpan(){
                if(confirm("Simpan Data?")){
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
                            console.log(ajaxRequest.responseText);
                            let JSONObject = JSON.parse(ajaxRequest.responseText);
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
                    

                    let formElement = document.getElementById("form");
                    let formData = new FormData(formElement);
                    formData.set("type","peserta_tambah");
                    formData.set("produk","<?=$_GET['id']?>");
                    <?php $token = (empty($_SESSION['token'])) ? $_SESSION['token'] = bin2hex(random_bytes(32)) : $_SESSION['token'];?>
                    formData.set("token","<?=$token?>");

                    ajaxRequest.send(formData);
                }
            }
        });
	</script>
</body>
</html>