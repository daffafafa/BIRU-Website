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
							<a href="./?p=produk" title="">Produk</a>
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


                <!--=== Page Content ===-->
                <link rel="stylesheet" type="text/css" href="<?=getUrlServer()?>/assets/template/ContactFrom_v5/vendor/select2/css/select2.min.css">
				<link rel="stylesheet" type="text/css" href="<?=getUrlServer()?>/assets/template/ContactFrom_v5/fonts/iconic/css/material-design-iconic-font.min.css">
				<link rel="stylesheet" type="text/css" href="<?=getUrlServer()?>/assets/template/ContactFrom_v5/css/util.css">
				<link rel="stylesheet" type="text/css" href="<?=getUrlServer()?>/assets/template/ContactFrom_v5/css/main.css">
                <style>
                    h3{margin-top: 0;width: 100%;font-weight: 500;}
                    #premi1,#premi2,#premi3,#premi4,#premi5{text-align:right}
                    .pbb0{display:block;font-size:24px}
                    .pbb3{width:calc(20% - 20px)}.pbb4{width:calc(80% - 30px)}
                    .pbb{display:inline;height:40px;font-size:18px !important;color:#555555;font-weight:bold}
                    .hvr{border: 1px solid #ccc;}
                    .usiakecil,.usiabesar{border: 1px #ccc solid;}
                    .tambah-fixed{position:fixed;top:20%;right:20px;z-index:1030;}
                </style>
				<script src="<?=getUrlServer()?>/assets/template/ContactFrom_v5/js/main.js"></script>
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
                    var mainLoaded=false;
					$(document).ready(function(){
                        $.ajax({
                            async: true,
                            url: './ambil_data.php?type=produkmain',
                            type: 'get',
                            dataType:"json",
                            success: function(response){
                                console.log(response);
                                if(response.length==0){
                                    $('#parent').select2({placeholder:{id:'',text:'Data Tidak Ditemukan'}});
                                }else{
                                    mainLoaded = true;
                                    $('#parent').select2({data: response, placeholder:{id:'',text:'Pilih Main Produk'}});
                                }
                            },
                            error: function(jqXHR,textStatus,errorThrown){
                                console.log(textStatus)
                            }
                        });
                        $(document).on('keydown','.usiakecil,.usiabesar,.usiapremi,.text-right,#dana_out_no,#dana_in_no',function(e){
                            if(e.key.length==1)
                                if((isNaN(e.key) || e.key == " ") && e.key != ".")
                                    e.preventDefault();
                        });
                        $('#minp,#maxp,#kelipatan').on('focusout',function(){
                            $(this).val(formatMoney(formatNumber($(this).val()), 2, ".", ","));
                        });
                        $(document).on('focusout','.usiapremi,#premi,#premi1,#premi2,#premi3,#premi4,#premi5',function(){
                            $(this).val(formatMoney(formatNumber($(this).val()), 5, ".", ","));
                        });
						$(".js-select2").each(function(){
							$(this).select2({
								minimumResultsForSearch: 2,
								dropdownParent: $(this).next('.dropDownSelect2')
							});
						});
                        let usiaDivAwal = $('.usiaDiv').html();
                        $(document).on('click','.tambahUsia',function(e){
                            e.preventDefault();
                            if($('.usiaDiv').length==0){
                                $('#usiaDivParent').append('<div class="usiaDiv row">'+usiaDivAwal+'</div>');
                            }else{
                                $('.usiaDiv:last').after('<div class="usiaDiv row">'+usiaDivAwal+'</div>');
                            }
                            $('.usiakecil:last').on('change',function(e){

                            });
                        });
                        $(document).on('click','.hapusUsia',function(e){
                            e.preventDefault();
                            let parent = $(this).parent().parent().parent();
                            parent.remove();
                        });
                        $(window).scroll(function() {
                            let ff=$('#topUsia').offset().top - $(window).scrollTop();
                            if(ff <= 66){
                                $('.tambahUsia').addClass('tambah-fixed').html('<i class="icon-plus"></i>');
                            }else{
                                $('.tambahUsia').removeClass('tambah-fixed').html('Tambah Rate Usia');
                            }
                            //console.log(ff);
                        });
                        $('#tipe').on('select2:close', function (e){
                            if($(this).val() == 'dca eq') {
                                //buka
                                $('.js-show-gempa').slideDown();
                                $('#premi1,#premi2,#premi3,#premi4,#premi5').attr('required','required').parent().addClass('validate-input');
                                //tutup
                                $('.js-show-kematian').slideUp();
                                $('.usiakecil,.usiabesar,.usiapremi').removeAttr('required').parent().removeClass('validate-input');
                            }else if($(this).val() == 'kematian') {
                                //buka
                                $('.js-show-kematian').slideDown();
                                $('.usiakecil,.usiabesar,.usiapremi').attr('required','required').parent().addClass('validate-input');
                                //tutup
                                $('.js-show-gempa').slideUp();
                                $('#premi1,#premi2,#premi3,#premi4,#premi5').removeAttr('required').parent().removeClass('validate-input');
                            }else{
                                //tutup
                                $('.js-show-gempa').slideUp();
                                $('#premi1,#premi2,#premi3,#premi4,#premi5').removeAttr('required').parent().removeClass('validate-input');
                                $('.js-show-kematian').slideUp();
                                $('.usiakecil,.usiabesar,.usiapremi').removeAttr('required').parent().removeClass('validate-input');
                            }
                        });
                        $('#b2c').on('select2:close', function (e){
                            if($(this).val() == 1) {//ya
                                $('.js-show-b2c').slideDown();
                                $('#maxp,#minp,#kelipatan').attr('required','required').parent().addClass('validate-input');
                            }else if($(this).val() == 0){//tidak
                                $('.js-show-b2c').slideUp();
                                $('#maxp,#minp,#kelipatan').removeAttr('required').parent().removeClass('validate-input');
                            }
                        });
                        $('#tingkat').on('select2:close', function (e){
                            if($(this).val() == 0) {//main produk
                                $('#mata_uang,#dana_in_no').attr('required','required').parent().addClass('validate-input');
                                $('#dana_in_nama,#dana_in_bank').attr('required','required').parent().parent().addClass('validate-input');
                                
                                $('#premi,#dana_out_no').removeAttr('required').parent().removeClass('validate-input');
                                $('#parent,#tipe,#dana_out_nama,#dana_out_bank').removeAttr('required').parent().parent().removeClass('validate-input');
                                
                                $('#parent').prop('disabled',true);
                                $('.js-show-tingkat').slideDown();
                                $('.js-show-main').slideUp();
                            } else if($(this).val() == 1) { //sub produk
                                $('#mata_uang,#dana_in_no').removeAttr('required').parent().removeClass('validate-input');
                                $('#dana_in_nama,#dana_in_bank').removeAttr('required','required').parent().parent().removeClass('validate-input');
                                
                                $('#premi,#dana_out_no').attr('required','required').parent().addClass('validate-input');
                                $('#parent,#tipe,#dana_out_nama,#dana_out_bank').attr('required','required').parent().parent().addClass('validate-input');
                                
                                $('#parent').prop('disabled',false);
                                $('.js-show-tingkat').slideUp();
                                $('.js-show-main').slideDown();
                            }
                        });
                        if(getUrlParam('type',false)=='sub'){
                            $('#tingkat').val(1).select2();
                            $('#tingkat').trigger('select2:close');
                            // $('#kembali').attr('href','./?p=produk&type=sub&kode='+getUrlParam('id',false));
                            var myInterval=setInterval(() => {
                                if(mainLoaded){
                                    $('#parent').val(getUrlParam('id',false)).select2();
                                    clearInterval(myInterval);
                                }
                            }, 200);
                        }else  if(getUrlParam('type',false)=='main'){
                            $('#tingkat').val(0).select2();
                            $('#tingkat').trigger('select2:close');
                        }
					});
				</script>
				<div class="row">
                    <form id="form" method="POST" class="contact100-form form-horizontal validate-form" novalidate>
                        <div class="wrap-input100 validate-input bg1 rs3-wrap-input100 " data-validate="Silakan Masukkan Kode Produk">
                            <span class="label-input100">Kode Produk</span>
                            <input type="text" id="kode" name="kode" placeholder="isi kode produk" class="input100" required>
                        </div>
                        <div class="wrap-input100 validate-input bg1 rs34-wrap-input100" data-validate="Silakan Masukkan Nama Produk">
                            <span class="label-input100">Nama Produk</span>
                            <input type="text" id="nama" name="nama" placeholder="isi nama produk" class="input100" required>
                        </div>
                        <div class="wrap-input100 validate-input bg1 rs1-wrap-input100 rs1-offset" data-validate="Silakan Masukkan PKS/MOU">
                            <span class="label-input100">PKS/MOU</span>
                            <input type="text" id="mou" name="mou" placeholder="isi pks/mou" class="input100" required>
                        </div>
                        <div class="wrap-input100 input100-select bg1 rs2-wrap-input100 validate-input" data-validate="Silakan Pilih Tingkat Produk">
                            <span class="label-input100">Tingkat Produk</span>
                            <div>
                                <select class="js-select2"  id="tingkat" name="tingkat">
                                    <option value="-1" disabled selected>Pilih Tingkat Produk</option>
                                    <option value="0" >MAIN</option>
                                    <option value="1" >SUB MAIN</option>
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>
                        </div>
                        <div class="wrap-input100 input100-select bg1 rs2-wrap-input100 rs2-offset">
                            <span class="label-input100">STATUS PRODUK</span>
                            <div>
                                <select class="js-select2" id="status" name="status">
                                    <option selected value="0" >ACTIVE</option>
                                    <option value="1" >SUSPENDED</option>
                                    <option value="2" >CLOSED</option>
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>
                        </div>
                        <!-- -----------------------Tingkat Main produk start------------------------ -->
                        <div class="w-full dis-none js-show-tingkat">
                            <div class="contact100-form" style="margin:0">
                                <div class="wrap-input100 input100-select bg1 rs2-wrap-input100">
                                    <span class="label-input100"> Apakah Produk B2C?</span>
                                    <div>
                                        <select class="js-select2" id="b2c" name="b2c">
                                            <option value="0">Tidak</option>
                                            <option value="1">Ya</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                                <div class="wrap-input100 bg1 rs2-wrap-input100 rs2-offset" data-validate="Silakan Masukkan Mata Uang">
                                    <span class="label-input100">Mata Uang</span>
                                    <input type="text" id="mata_uang" name="mata_uang" placeholder="isi mata uang" class="input100">
                                </div>
                            <?php 
                                $query = mysqli_query($conection, 'SELECT ENTITY_ID,ENTITY_NAMA FROM ma1001'); 
                                $dataEntity = mysqli_fetch_all($query, MYSQLI_ASSOC);
                            ?>                              
                                <div class="wrap-input100 input100-select bg1 rs2-wrap-input100" data-validate="Silakan Pilih Nama VA Dana Masuk">
                                    <span class="label-input100">Front Linier Produk</span>
                                    <div>
                                        <select class="js-select2" multiple id="dana_in_nama" name="dana_in_nama[]" placeholder="<?=((count($dataEntity) > 0)?'Pilih Nama Dana Masuk':'Tidak ada data perusahaan')?>">
                                            <?php foreach($dataEntity as $row) {?>
                                                <option value="<?=$row['ENTITY_NAMA']?>"><?=$row['ENTITY_NAMA']?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                                <div class="wrap-input100 input100-select bg1 rs3-wrap-input100" data-validate="Silakan Pilih Bank VA Dana Masuk">
                                    <span class="label-input100">Bank VA Dana Masuk</span>
                                    <div>
                                        <select reqs  id="dana_in_bank" name="dana_in_bank" class="js-select2">
                                            <option value="BNI">BNI</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                                <div class="wrap-input100 bg1 rs2-wrap-input100 rs233-wrap-input100" data-validate="Silakan Masukkan No VA Dana Masuk">
                                    <span class="label-input100">No VA Dana Masuk</span>
                                    <input type="text" id="dana_in_no" name="dana_in_no" placeholder="isi va penerima dana" class="input100">
                                </div>
                                <!-- -----------------------B2C start------------------------ -->
                                <div class="w-full dis-none js-show-b2c">
                                    <div class="contact100-form" style="margin:0">
                                        <div class="wrap-input100 bg1 rs2-wrap-input100" data-validate="Silakan Masukkan Min Pertanggungan">
                                            <span class="label-input100">Min Pertanggungan</span>
                                            <input type="text" min="0" step="0.01" id="minp" name="minp" placeholder="isi min" class="input100 text-right">
                                        </div>
                                        <div class="wrap-input100 bg1 rs2-wrap-input100" data-validate="Silakan Masukkan Max Pertanggungan">
                                            <span class="label-input100">MAX Pertanggungan</span>
                                            <input type="text" min="0" step="0.01" id="maxp" name="maxp" placeholder="isi max" class="input100 text-right">
                                        </div>
                                        <div class="wrap-input100 bg1 rs2-wrap-input100" data-validate="Silakan Masukkan Kelipatan Pertanggungan">
                                            <span class="label-input100">Kelipatan Pertanggungan</span>
                                            <input type="text" min="0" step="0.01" id="kelipatan" name="kelipatan" placeholder="isi kelipatan" class="input100 text-right">
                                        </div>
                                    </div>
                                </div>
                                <!-- -----------------------B2C end------------------------ -->
                            </div>
                        </div>
                        <!-- -----------------------Tingkat Main produk end------------------------ -->
                        <!-- -----------------------Tingkat Sub produk start------------------------ -->
                        <div class="w-full dis-none js-show-main">
                            <div class="contact100-form" style="margin:0">
                                <div class="wrap-input100 input100-select bg1 rs3-wrap-input100" data-validate="Silahkan Pilih Bank VA Dana Keluar">
                                    <span class="label-input100">Bank VA Dana Keluar</span>
                                    <div>
                                        <select reqs  id="dana_out_bank" name="dana_out_bank" class="js-select2">
                                            <option value="BNI">BNI</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                                <div class="wrap-input100 bg1 rs2-wrap-input100 rs233-wrap-input100" data-validate="Silakan Masukkan No VA Dana Keluar">
                                    <span class="label-input100">No VA Dana Keluar</span>
                                    <input type="text" id="dana_out_no" name="dana_out_no" placeholder="isi no va dana keluar" class="input100">
                                </div>
                                <div class="wrap-input100 input100-select bg1 rs2-wrap-input100">
                                    <span class="label-input100">MAIN PRODUK</span>
                                    <div>
                                        <select class="" id="parent" name="parent">
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                                <div class="wrap-input100 input100-select bg1 rs2-wrap-input100">
                                    <span class="label-input100">TIPE PRODUK</span>
                                    <div>
                                        <select class="js-select2" id="tipe" name="tipe">
                                            <option value="normal">Normal</option>
                                            <option value="dca eq">DCA EQ</option>
                                            <option value="kematian">Kematian</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                                <div class="wrap-input100 input100-select bg1 rs2-wrap-input100">
                                    <span class="label-input100">TIPE CLAIM SUB PRODUK</span>
                                    <div>
                                        <select class="js-select2" id="claim" name="claim">
                                            <option value="0">Terikat</option>
                                            <option value="1">Bebas <h1><span class="badge badge-info">(Menjadikan Sub Produk lain tidak bisa diklaim)</span></h1></option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                                <div class="wrap-input100 bg1 rs2-wrap-input100" data-validate="Silakan Masukkan Premi">
                                    <span class="label-input100">Premi Dasar (%)</span>
                                    <input type="text" id="premi" min="0" max="100" step="0.01000" name="premi" placeholder="isi premi" class="input100 text-right">
                                </div>
                                <div class="w-full dis-none js-show-gempa">
                                    <div class="contact100-form" style="margin:0">
                                        <div class="wrap-input100 bg1 rs4-wrap-input100" data-validate="Silakan Masukkan Risk Rate">
                                            <span class="label-input100">Risk Rate Zona 1 (%)</span>
                                            <input type="text" id="premi1" min="0" max="100" step="0.01000" name="premi1" placeholder="isi Risk Rate" class="input100 text-right">
                                        </div>
                                        <div class="wrap-input100 bg1 rs4-wrap-input100" data-validate="Silakan Masukkan Risk Rate">
                                            <span class="label-input100">Risk Rate Zona 2 (%)</span>
                                            <input type="text" id="premi2" min="0" max="100" step="0.01000" name="premi2" placeholder="isi Risk Rate" class="input100 text-right">
                                        </div>
                                        <div class="wrap-input100 bg1 rs4-wrap-input100" data-validate="Silakan Masukkan Risk Rate">
                                            <span class="label-input100">Risk Rate Zona 3 (%)</span>
                                            <input type="text" id="premi3" min="0" max="100" step="0.01000" name="premi3" placeholder="isi Risk Rate" class="input100 text-right">
                                        </div>
                                        <div class="wrap-input100 bg1 rs4-wrap-input100" data-validate="Silakan Masukkan Risk Rate">
                                            <span class="label-input100">Risk Rate Zona 4 (%)</span>
                                            <input type="text" id="premi4" min="0" max="100" step="0.01000" name="premi4" placeholder="isi Risk Rate" class="input100 text-right">
                                        </div>
                                        <div class="wrap-input100 bg1 rs4-wrap-input100" data-validate="Silakan Masukkan Risk Rate">
                                            <span class="label-input100">Risk Rate Zona 5 (%)</span>
                                            <input type="text" id="premi5" min="0" max="100" step="0.01000" name="premi5" placeholder="isi Risk Rate" class="input100 text-right">
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full dis-none js-show-kematian">
                                    <div class="contact100-form" style="margin:0">
                                        <h3 id="topUsia">Rate Risk Usia <a href="#" title="Tambah Rate Usia" class="btn btn-sm btn-primary tambahUsia">Tambah Rate Usia</a></h3>
                                        <div class="wrap-input100 bg1" id="usiaDivParent">
                                            <div class="col-sm-6 hidden-xs">Rentang Usia</div>
                                            <div class="col-sm-4 hidden-xs">Risk Rate (%)</div>
                                            <div class="col-sm-2 hidden-xs">Aksi</div>
                                            <div class="usiaDiv row">
                                                <div class="hidden-sm hidden-md hidden-lg col-xs-4">Rentang Usia</div>
                                                <div class="col-sm-6 col-xs-7">
                                                    <input type="text" name="usiakecil[]" placeholder="isi rentang usia terkecil" class="col-xs-5 usiakecil text-right">
                                                    <span class="col-xs-2 text-center">s.d</span>
                                                    <input type="text" name="usiabesar[]" placeholder="isi rentang usia terbesar" class="col-xs-5 usiabesar text-right">
                                                </div>
                                                <div class="hidden-sm hidden-md hidden-lg col-xs-4">Risk Rate (%)</div>
                                                <div class="col-sm-4 col-xs-7">
                                                    <input type="text" name="usiapremi[]" placeholder="isi risk rate" class="input100 usiapremi text-right">
                                                </div>
                                                <div class="hidden-sm hidden-md hidden-lg col-xs-4">Aksi</div>
                                                <div class="col-sm-2 col-xs-7">
                                                    <div class="hidden-xs">
                                                        <a href="#" title="Hapus" class="btn btn-sm hapusUsia" style="margin-top:5px"><i class="icon-remove"></i></a>
                                                    </div>
                                                    <div class="hidden-sm hidden-md hidden-lg">
                                                        <a href="#" class="btn btn-sm btn-danger hapusUsia">Hapus</a>
                                                        <hr>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- -----------------------Tingkat Sub produk end------------------------ -->
                        <div class="container-contact100-form-btn">
                            <button type="button" id="kembali" class="contact100-form-btn">Kembali</button>
                            <button type="submit" class="contact100-form-btn" id="simpan">
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
            $('#kembali').on('click',function(){
                history.back();
            });
            $('#form').on('submit',function(e){
                e.preventDefault();
                let input = $('.validate-input > input');
                let select = $('.validate-input select');
                let check = true;
				let err = null;
                let usia1 = $('.usiakecil');
                let usia2 = $('.usiabesar');
                let arrUsia = [];
                for(let i=usia1.length-1; i>=0; i--) {
                    for(let j = usia1[i].value; j <= usia2[i].value; j++){
				        if(arrUsia.indexOf(parseInt(j)) == -1){
                            arrUsia.push(parseInt(j));
                        }else{
                            check=false;
                            err="Rentang Usia tidak boleh beririsan, usia "+j+" beririsan dengan rentang "+usia1[i].value+" s.d "+usia2[i].value;
                            break;
                        }
                    }
                }
                console.log(arrUsia);
                for(let i=input.length-1; i>=0; i--) {
                    if(validate(input[i]) == false){
                        showValidate(input[i]);
						check=false;
						err=input[i].parentElement.dataset.validate;
                        break;
                    }
				}
				for(let i=select.length-1; i>=0; i--) {
					if( select[i].value == -1){
						obj=select[i];
                        showValidate(select[i]);
						check=false;
						err=select[i].parentElement.parentElement.dataset.validate;
                        break;
                    }
				}
				//console.log(input[i]);
				if(err != null) new Noty({
								text   : 'Gagal : '+err,
								type   : 'alert',
								timeout: 5000
							}).show();
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
                            let thisAlert;
                            if(input.type == "search"){
                                thisAlert = $(input).parentsUntil('.validate-input').last();
                            }else{
                                thisAlert = $(input).parent();
                            }
							$(thisAlert).addClass('has-error has-feedback');
							$(thisAlert).append('<span class="glyphicon glyphicon-remove form-control-feedback btn-hide-validate"></span>')
							$('.btn-hide-validate').each(function(){
								$(this).on('click',function(){
								hideValidate(this);
								});
							});
						}
						function hideValidate(input) {
							let thisAlert;
                            if(input.type == "search"){
                                thisAlert = $(input).parentsUntil('.validate-input').last();
                            }else{
                                thisAlert = $(input).parent();
                            }
							$(thisAlert).removeClass('has-error has-feedback');
							$(thisAlert).find('.btn-hide-validate').remove();
						}
            function simpan(){
                if(confirm("Simpan Data?")){
                    App.blockUI('#content');
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
                                new Noty({
                                    text   : JSONObject.pesan,
                                    type   : 'alert',
                                    timeout: 5000
                                }).show();
                                App.unblockUI('#content');
                                history.back();
                            }else{
                                App.unblockUI('#content');
                                new Noty({
                                    text   : JSONObject.pesan,
                                    type   : 'alert',
                                    timeout: 5000
                                }).show();
                            }
                        }
                    }
                    ajaxRequest.open("POST", "./simpan.php", true);

                    var formElement = document.getElementById("form");
                    var formData = new FormData(formElement);
					if($('#tingkat').val()==0) formData.set("tingkat",0);
                    formData.set("type","produk_tambah");
                    <?php
$token = (empty($_SESSION['token'])) ? $_SESSION['token'] = bin2hex(random_bytes(32)) : $_SESSION['token'];
?>
                    formData.set("token","<?=$token?>");

                    ajaxRequest.send(formData);
                }
            }
        });
	</script>
