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
                        <span style="line-height: 50px;vertical-align: bottom;">BIRU </label>
                        <!-- <span style="font-size:10px;line-height: 40px;vertical-align: bottom;">(Client B2B)</label> -->
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
                        <span class="badge badge-danger"></label>
                    </label>
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
						<!-- <li><a href="charts.html" title=""><i class="icon-signal"></i><span>Statistics</label></a></li> -->
						<?php include "crumb.php"; ?>
						<!-- <li class="range"><a href="#">
							<i class="icon-calendar"></i>
							<span></label>
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
                    #premi1,#premi2,#premi3,#premi4,#premi5{text-align:right}
                    .hvr{border: 1px solid #ccc;}
                    .usiakecil,.usiabesar{border: 1px #ccc solid;}
                    .tambah-fixed{position:fixed;top:20%;right:20px;z-index:1030;}
                </style>
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
                        let kematianOpened = false;
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
                                $('#usiaDivParent').append('<div class="usiaDiv col-12 row-flex p-0 m-0">'+usiaDivAwal+'</div>');
                            }else{
                                $('.usiaDiv:last').after('<div class="usiaDiv col-12 row-flex p-0 m-0">'+usiaDivAwal+'</div>');
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
                            if(kematianOpened){
                                let ff=$('#topUsia').offset().top - $(window).scrollTop();
                                console.log(ff);
                                if(ff >= 66 && ff!=0){
                                    $('.tambahUsia').removeClass('tambah-fixed').html('Tambah Rate Usia');
                                }else{
                                    $('.tambahUsia').addClass('tambah-fixed').html('<i class="icon-plus"></i>');
                                }
                            }
                            //console.log(ff);
                        });
                        $('#tipe').on('select2:close', function (e){
                            kematianOpened = false;
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
                                kematianOpened = true;
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
                    <form id="form" class="form-inline validate-form" method="post" novalidate>
                        <div class="panel">
                            <div class="panel-body">
                                <div class="col-12 row-flex validate-input" data-validate="Silakan Masukkan Kode Produk">
                                    <label class="col-lg-3 col-md-3 col-sm-5 col-xs-12 p-0">Kode Produk</label>
                                    <input type="text" id="kode" name="kode" placeholder="Kode Produk" class="form-control col-lg-5 col-md-6 col-sm-7 col-xs-12" required>
                                </div>
                                <div class="col-12 row-flex validate-input mt-sm-4" data-validate="Silakan Masukkan Nama Produk">
                                    <label class="col-lg-3 col-md-3 col-sm-5 col-xs-12 p-0">Nama Produk</label>
                                    <input type="text" id="nama" name="nama" placeholder="Nama Produk" class="form-control col-lg-5 col-md-6 col-sm-7 col-xs-12" required>
                                </div>
                                <div class="col-12 row-flex validate-input mt-sm-4" data-validate="Silakan Masukkan PKS/MOU">
                                    <label class="col-lg-3 col-md-3 col-sm-5 col-xs-12 p-0">PKS/MOU</label>
                                    <input type="text" id="mou" name="mou" placeholder="PKS/MOU" class="form-control col-lg-5 col-md-6 col-sm-7 col-xs-12" required>
                                </div>
                                <div class="col-12 row-flex input100-select validate-input mt-sm-4" data-validate="Silakan Pilih Tingkat Produk">
                                    <label class="col-lg-3 col-md-3 col-sm-5 col-xs-12 p-0 my-1">Tingkat Produk</label>
                                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 p-0">
                                        <select class="js-select2"  id="tingkat" name="tingkat">
                                            <option value="-1" disabled selected>Pilih Tingkat Produk</option>
                                            <option value="0" >MAIN</option>
                                            <option value="1" >SUB MAIN</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                                <div class="col-12 row-flex input100-select mt-sm-4">
                                    <label class="col-lg-3 col-md-3 col-sm-5 col-xs-12 p-0">Status Produk</label>
                                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 p-0 my-1">
                                        <select class="js-select2" id="status" name="status">
                                            <option selected value="0" >ACTIVE</option>
                                            <option value="1" >SUSPENDED</option>
                                            <option value="2" >CLOSED</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- -----------------------Tingkat Main produk start------------------------ -->
                        <div class="w-full dis-none js-show-tingkat panel">
                            <div class="panel-heading">
                               <h2 style="margin:0">Pengaturan Main Produk</h2>
                            </div>
                            <div class="panel-body">
                                <div class="col-12 row-flex input100-select ">
                                    <label class="col-lg-4 col-md-5 col-sm-5 col-xs-12 p-0"> Apakah Produk B2C?</label>
                                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 p-0 my-1">
                                        <select class="js-select2" id="b2c" name="b2c">
                                            <option value="0">Tidak</option>
                                            <option value="1">Ya</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                                <div class="col-12 row-flex mt-sm-4" data-validate="Silakan Masukkan Mata Uang">
                                    <label class="col-lg-4 col-md-5 col-sm-5 col-xs-12 p-0">Mata Uang</label>
                                    <input type="text" id="mata_uang" name="mata_uang" placeholder="" class="form-control col-lg-2 col-md-2 col-sm-3 col-xs-12" required>
                                </div>
                                <?php 
                                    $query = mysqli_query($conection, 'SELECT ENTITY_ID,ENTITY_NAMA FROM ma1001'); 
                                    $dataEntity = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                ?>                              
                                <div class="col-12 row-flex input100-select mt-sm-4" data-validate="Silakan Pilih Nama Rekening Penerima Dana">
                                    <label class="col-lg-4 col-md-5 col-sm-5 col-xs-12 p-0">Nama Rekening Penerima Dana</label>
                                    <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12 p-0 my-1">
                                        <select class="js-select2" multiple id="dana_in_nama" name="dana_in_nama[]" placeholder="<?=((count($dataEntity) > 0)?'Pilih Nama Rekening Penerima Dana':'Tidak ada data perusahaan')?>">
                                            <?php foreach($dataEntity as $row) {?>
                                                <option value="<?=$row['ENTITY_NAMA']?>"><?=$row['ENTITY_NAMA']?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                                <div class="col-12 row-flex input100-select mt-sm-4" data-validate="Silakan Pilih Bank Rekening Penerima Dana">
                                    <label class="col-lg-4 col-md-5 col-sm-5 col-xs-12 p-0">Bank Rekening Penerima Dana</label>
                                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 p-0 my-1">
                                        <select reqs  id="dana_in_bank" name="dana_in_bank" class="js-select2">
                                            <option value="BNI">BNI</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                                <div class="col-12 row-flex mt-sm-4" data-validate="Silakan Masukkan No Rekening Penerima Dana">
                                    <label class="col-lg-4 col-md-5 col-sm-5 col-xs-12 p-0">No Rekening Penerima Dana</label>
                                    <input type="text" id="dana_in_no" name="dana_in_no" placeholder="No Rekening" class="form-control col-lg-5 col-md-6 col-sm-7 col-xs-12" required>
                                </div>
                            </div>
                            <!-- -----------------------B2C start------------------------ -->
                            <div class="w-full dis-none js-show-b2c panel">
                                <div class="panel-heading mt-4">
                                    <h2 style="margin:0">Pengaturan Batas Pembelian</h2>
                                </div>
                                <div class="panel-body p-0">
                                    <div class="col-12 row-flex" data-validate="Silakan Masukkan Min Pertanggungan">
                                        <label class="col-lg-4 col-md-5 col-sm-5 col-xs-12 p-0">Min Pertanggungan</label>
                                        <input type="text" min="0" step="0.01" id="minp" name="minp" placeholder="isi min" class="form-control col-lg-5 col-md-6 col-sm-7 col-xs-12 text-right">
                                    </div>
                                    <div class="col-12 row-flex mt-sm-4" data-validate="Silakan Masukkan Max Pertanggungan">
                                        <label class="col-lg-4 col-md-5 col-sm-5 col-xs-12 p-0">MAX Pertanggungan</label>
                                        <input type="text" min="0" step="0.01" id="maxp" name="maxp" placeholder="isi max" class="form-control col-lg-5 col-md-6 col-sm-7 col-xs-12 text-right">
                                    </div>
                                    <div class="col-12 row-flex mt-sm-4" data-validate="Silakan Masukkan Kelipatan Pertanggungan">
                                        <label class="col-lg-4 col-md-5 col-sm-5 col-xs-12 p-0">Kelipatan Pertanggungan</label>
                                        <input type="text" min="0" step="0.01" id="kelipatan" name="kelipatan" placeholder="isi kelipatan" class="form-control col-lg-5 col-md-6 col-sm-7 col-xs-12 text-right">
                                    </div>
                                </div>
                            </div>
                            <!-- -----------------------B2C end------------------------ -->
                        </div>
                        <!-- -----------------------Tingkat Main produk end------------------------ -->
                        <!-- -----------------------Tingkat Sub produk start------------------------ -->
                        <div class="w-full dis-none js-show-main panel">
                            <div class="panel-heading">
                               <h2 style="margin:0">Pengaturan Sub Produk</h2>
                            </div>
                            <div class="panel-body">
                                <div class="col-12 row-flex input100-select d-none" data-validate="Silahkan Pilih Bank Rekening">
                                    <label class="col-lg-4 col-md-5 col-sm-5 col-xs-12 p-0">Bank Rekening</label>
                                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 p-0 my-1">
                                        <select reqs  id="dana_out_bank" name="dana_out_bank" class="js-select2">
                                            <option selected value="BNI">BNI</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                                <div class="col-12 row-flex mt-sm-3 d-none" data-validate="Silakan Masukkan No Rekening">
                                    <label class="col-lg-4 col-md-5 col-sm-5 col-xs-12 p-0">No Rekening</label>
                                    <input type="text" id="dana_out_no" name="dana_out_no" value="test" class="form-control col-lg-5 col-md-6 col-sm-7 col-xs-12">
                                </div>
                                <div class="col-12 row-flex input100-select mt-sm-4">
                                    <label class="col-lg-4 col-md-5 col-sm-5 col-xs-12 p-0">MAIN PRODUK</label>
                                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 p-0 my-1">
                                        <select class="" id="parent" name="parent">
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                                <div class="col-12 row-flex input100-select mt-sm-3">
                                    <label class="col-lg-4 col-md-5 col-sm-5 col-xs-12 p-0">Tipe Sub Produk</label>
                                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 p-0 my-1">
                                        <select class="js-select2" id="tipe" name="tipe">
                                            <option value="normal">Normal</option>
                                            <option value="dca eq">DCA EQ</option>
                                            <option value="kematian">Kematian</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                                <div class="col-12 row-flex input100-select mt-sm-3">
                                    <label class="col-lg-4 col-md-5 col-sm-5 col-xs-12 p-0">TIPE CLAIM SUB PRODUK</label>
                                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 p-0 my-1">
                                        <select class="js-select2" id="claim" name="claim">
                                            <option value="0">Terikat</option>
                                            <option value="1">Bebas <h1><span class="badge badge-info">(Menjadikan Sub Produk lain tidak bisa diklaim)</label></h1></option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                                <div class="col-12 row-flex mt-sm-3" data-validate="Silakan Masukkan Premi">
                                    <label class="col-lg-4 col-md-5 col-sm-5 col-xs-12 p-0">Premi Dasar (%)</label>
                                    <input type="text" id="premi" min="0" max="100" step="0.01000" name="premi" placeholder="0.000000" class="form-control col-lg-3 col-md-4 col-sm-4 col-xs-12 text-right">
                                </div>
                                <div class="w-full dis-none js-show-gempa panel mt-sm-4">
                                    <div class="panel-heading">
                                        <h2 style="margin:0">Pengaturan Risk Rate Gempa</h2>
                                    </div>
                                    <div class="panel-body p-0">
                                        <div class="col-12 row-flex" data-validate="Silakan Masukkan Risk Rate">
                                            <label class="col-lg-4 col-md-5 col-sm-5 col-xs-12 p-0 ">Risk Rate Gempa Zona 1 (%)</label>
                                            <input type="text" id="premi1" min="0" max="100" step="0.01000" name="premi1" placeholder="0.000000" class="form-control col-lg-3 col-md-4 col-sm-4 col-xs-12 text-right">
                                        </div>
                                        <div class="col-12 row-flex  " data-validate="Silakan Masukkan Risk Rate">
                                            <label class="col-lg-4 col-md-5 col-sm-5 col-xs-12 p-0">Risk Rate Gempa Zona 2 (%)</label>
                                            <input type="text" id="premi2" min="0" max="100" step="0.01000" name="premi2" placeholder="0.000000" class="form-control col-lg-3 col-md-4 col-sm-4 col-xs-12 text-right">
                                        </div>
                                        <div class="col-12 row-flex  " data-validate="Silakan Masukkan Risk Rate">
                                            <label class="col-lg-4 col-md-5 col-sm-5 col-xs-12 p-0">Risk Rate Gempa Zona 3 (%)</label>
                                            <input type="text" id="premi3" min="0" max="100" step="0.01000" name="premi3" placeholder="0.000000" class="form-control col-lg-3 col-md-4 col-sm-4 col-xs-12 text-right">
                                        </div>
                                        <div class="col-12 row-flex  " data-validate="Silakan Masukkan Risk Rate">
                                            <label class="col-lg-4 col-md-5 col-sm-5 col-xs-12 p-0">Risk Rate Gempa Zona 4 (%)</label>
                                            <input type="text" id="premi4" min="0" max="100" step="0.01000" name="premi4" placeholder="0.000000" class="form-control col-lg-3 col-md-4 col-sm-4 col-xs-12 text-right">
                                        </div>
                                        <div class="col-12 row-flex  " data-validate="Silakan Masukkan Risk Rate">
                                            <label class="col-lg-4 col-md-5 col-sm-5 col-xs-12 p-0">Risk Rate Gempa Zona 5 (%)</label>
                                            <input type="text" id="premi5" min="0" max="100" step="0.01000" name="premi5" placeholder="0.000000" class="form-control col-lg-3 col-md-4 col-sm-4 col-xs-12 text-right">
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full dis-none js-show-kematian panel mt-sm-4">
                                    <div class="panel-heading px-0 py-4 d-flex">
                                        <h2 id="topUsia" class="pull-left col-md-9 col-7 p-0 m-0" style="margin:0">Pengaturan Risk Rate Kematian</h2>
                                        <a href="#" title="Tambah Rate Usia"style="place-self:center" class="btn btn-sm btn-primary tambahUsia">Tambah Rate Usia</a>
                                    </div>
                                    <div class="panel-body p-0">
                                        <div class="col-12 row-flex p-0 m-0" id="usiaDivParent">
                                            <div class="d-sm-inline text-center font-weight-bold col-sm-7 d-none p-0 mt-4">Rentang Usia</div>
                                            <div class="d-sm-inline text-center font-weight-bold col-sm-4 d-none p-0 mt-4">Risk Rate (%)</div>
                                            <div class="d-sm-inline text-center font-weight-bold col-sm-1 d-none p-0 mt-4">Aksi</div>
                                            <div class="usiaDiv col-12 row-flex p-0 m-0">
                                                <div class="d-sm-none d-md-none d-lg-none d-flex col-xs-4 mt-4">Rentang Usia</div>
                                                <div class="col-sm-7 col-xs-7 p-0 pr-sm-4 mt-4">
                                                    <input type="text" name="usiakecil[]" placeholder="0" class="form-control col-xs-5 usiakecil text-right">
                                                    <span class="col-xs-2 text-center p-0">s.d</span>
                                                    <input type="text" name="usiabesar[]" placeholder="120" class="form-control col-xs-5 usiabesar text-right">
                                                </div>
                                                <div class="d-sm-none d-md-none d-lg-none d-flex col-xs-4 mt-4">Risk Rate (%)</div>
                                                <div class="col-sm-4 col-xs-7 p-0 mt-4">
                                                    <input type="text" name="usiapremi[]" placeholder="0.000000" class="form-control col-12 usiapremi text-right">
                                                </div>
                                                <div class="d-sm-none d-md-none d-lg-none d-flex col-xs-4 mt-4">Aksi</div>
                                                <div class="col-sm-1 col-xs-7 p-0 text-center mt-4">
                                                    <div class="d-block d-sm-none">
                                                        <a href="#" class="btn btn-sm btn-danger hapusUsia">Hapus</a>
                                                    </div>
                                                    <div class="d-sm-inline d-none">
                                                        <a href="#" title="Hapus" class="btn btn-sm btn-danger hapusUsia" style="margin-top:5px"><i class="icon-remove"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- -----------------------Tingkat Sub produk end------------------------ -->
                        <div class="pull-right">
                            <button type="button" id="kembali" class="btn btn-lg btn-warning">Kembali</button>
                            <button type="submit" class="btn btn-lg btn-primary" id="simpan">Simpan</button>
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
                for(let i=select.length-1; i>=0; i--) {
					if( select[i].selectedIndex == -1){
						obj=select[i];
                        showValidate(select[i]);
						check=false;
						err=select[i].parentElement.parentElement.dataset.validate;
                        break;
                    }
				}
                if(err != null) new Noty({
								text  : 'Gagal : '+err,
								type   : 'alert',
								timeout: 5000
							}).show();
                if(!check) return check;
                for(let i=input.length-1; i>=0; i--) {
                    if(validate(input[i]) == false){
                        console.log(input[i]);
                        showValidate(input[i]);
						check=false;
						err=input[i].parentElement.dataset.validate;
                        break;
                    }
				}
				
				//console.log(input[i]);
				if(err != null) new Noty({
								text  : 'Gagal : '+err,
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
                                thisAlert = $(input).parentsUntil('.validate-input').last().parent();
                            }else{
                                thisAlert = $(input).parent();
                            }
							$(thisAlert).addClass('has-error has-feedback');
							$(thisAlert).append('<span class="glyphicon glyphicon-remove form-control-feedback btn-hide-validate"></label>')
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
                            App.unblockUI('#content');
                            var JSONObject = JSON.parse(ajaxRequest.responseText);
                            if(JSONObject[0] != false)
                            {
                                alert(JSONObject.pesan);
                                history.back();
                            }else{
                                new Noty({
                                    text  : JSONObject.pesan,
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
