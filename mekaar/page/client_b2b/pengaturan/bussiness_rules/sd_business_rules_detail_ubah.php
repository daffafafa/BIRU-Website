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
							<a href="./?p=produk&type=sub&kode=<?=$produk['PROD_ID_PARENT']?>" >Sub Produk</a>
						</li>
                        <li >
							<a href="./?p=business_rules_detail&id=<?=$_GET['id']?>" title="">Business Rules</a>
						</li>
						<li class="current">
							<a href="#" title="">Ubah</a>
						</li>
					</ul>

					<ul class="crumb-buttons hidden-xs hidden-sm hidden-md">
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
                    #porsi,.komisi,.komisi2{text-align:right}
                    h3{margin-top: 0;width: 100%;font-weight: 500;}
                    .pbb0{display:block;font-size:24px}
                    .pbb3{width:calc(20% - 20px)}.pbb4{width:calc(80% - 30px)}
                    .pbb{display:inline;height:40px;font-size:18px !important;color:#555555;font-weight:bold}
                    .hvr{border: 1px solid #ccc;}
                    .col-xs-4{height:40px;padding-top:5px}
                    .col-xs-7{height:40px}
                    .tambah-fixed{position:fixed;top:20%;right:20px;z-index:1030;}
                    .tambah-fixed2{position:fixed;top:25%;right:20px;z-index:1030;}
                </style>
				<script src="<?=getUrlServer()?>/assets/template/ContactFrom_v5/js/main.js"></script>
				<script type="text/javascript" src="<?=getUrlServer()?>/assets/template/ContactFrom_v5/vendor/select2/js/select2.min.js"></script>
				<script>
					$(document).ready(function(){
                        $('#komisiDivParent .hidden-xs, #komisiDivParent .col-xs-4,#komisiDivParent2 > .hidden-xs,#komisiDivParent2 > .col-xs-4').wrap('<span class="label-input100">');
                        let komisiDivAwal = $('.komisiDiv').html();
                        let komisiDivAwal2 = $('.komisiDiv2').html();
                        $(".komisiDiv,.komisiDiv2").remove();
                        let dataPenanggung = [<?php 
                            $d='';
                            foreach($entity as $e_id => $e_nama) {
                                $d .= '{id:"'.$e_id.'",text:"'.$e_nama.'"},';
                            }
                            echo substr($d,0,-1);
                        ?>];
                        <?php 
                            $d=$e=$f=$g='';
                            //key(array_intersect($SHA_SYSTEM_ID,
                            $system_id=key(array_intersect($SHA_SYSTEM_ID,array($_GET['id2'])));
                            if(isset($data['KOMISI'][$system_id])){
                                $e .= 'let dataPenanggungTerpilih = [';
                                foreach($data['KOMISI'][$system_id] as $index=>$row) {
                                    $d .= '"'.$SHA_SYSTEM_ID[$row['SHA_SYSTEM_ID_GIVE']].'",';
                                    $e .= '{entity:"'.$SHA_SYSTEM_ID[$row['SHA_SYSTEM_ID_GIVE']].'"'.
                                          ',num:"'.$row['KOMISI_NUM'].'"'.
                                          ',pph23:"'.$row['KOMISI_TAX'].'"'.
                                          ',ppn:"'.$row['KOMISI_WITH'].'"'.
                                          '},';
                                }
                                $e = substr($e,0,-1).'];';
                            }
                            echo 'let idPenanggungTerpilih = ['.substr($d,0,-1).'];';
                            echo $e."\n";
                            
                            if(isset($data['KOMISI2'][$system_id])){
                                $g .= 'let dataPenanggungTerpilih2 = [';
                                foreach($data['KOMISI2'][$system_id] as $index=>$row) {
                                    $f .= '"'.$SHA_SYSTEM_ID[$row['SHA_SYSTEM_ID_TAKE']].'",';
                                    $g .= '{entity:"'.$SHA_SYSTEM_ID[$row['SHA_SYSTEM_ID_TAKE']].'"'.
                                          ',num:"'.$row['KOMISI_NUM'].'"'.
                                          ',pph23:"'.$row['KOMISI_TAX'].'"'.
                                          ',ppn:"'.$row['KOMISI_WITH'].'"'.
                                          '},';
                                }
                                $g = substr($g,0,-1).'];';
                            }
                            echo 'let idPenanggungTerpilih2 = ['.substr($f,0,-1).'];';
                            echo $g."\n";
                        ?>
                        //jika ada
                        let arr=[(typeof dataPenanggungTerpilih !== 'undefined')?dataPenanggungTerpilih:null
                                ,(typeof dataPenanggungTerpilih2 !== 'undefined')?dataPenanggungTerpilih2:null
                            ];
                        arr.forEach(function(objA,indexA){
                            //jika tidak null
                            if(objA){
                                objA.forEach(function(value,index){
                                    let vars=['',komisiDivAwal,idPenanggungTerpilih];
                                    if(indexA != 0){
                                        vars=['2',komisiDivAwal2,idPenanggungTerpilih2];
                                    }
                                    if($('.komisiDiv'+vars[0]).length==0){
                                        $('#komisiDivParent'+vars[0]).append('<div class="komisiDiv'+vars[0]+' row">'+vars[1]+'</div>');
                                    }else{
                                        $('.komisiDiv'+vars[0]+':last').after('<div class="komisiDiv'+vars[0]+' row">'+vars[1]+'</div>');
                                    }
                                    $('.komisi'+vars[0]+':last').val(formatMoney(value.num, 5, ".", ","));
                                    $('.penanggung'+vars[0]+':last').select2({
                                        data:dataPenanggung,
                                        minimumResultsForSearch: 2,
                                        dropdownParent: $('.penanggung'+vars[0]+':last').next('.dropDownSelect2'),
                                        placeholder: {
                                            id: '-1', // the value of the option
                                            text: 'Pilih Perusahaan'
                                        },
                                    }).val(value.entity)
                                    .trigger('change')
                                    .on('select2:selecting',function(el){
                                        if(vars[2].indexOf(el.params.args.data.id) > -1){
                                            new Noty({
                                                text   : 'Sudah terpilih',
                                                type   : 'alert',
                                                timeout: 5000
                                            }).show();
                                            el.preventDefault();
                                            return false;
                                        }else{
                                            if(el.target.value == -1 || el.target.value == ''){
                                                //add
                                                vars[2].push(el.params.args.data.id);
                                            }else{
                                                //replace
                                                vars[2][vars[2].indexOf(el.target.value)] = el.params.args.data.id;
                                            }
                                        }
                                    });
                                    $('.ppn'+vars[0]+':last').select2({
                                        minimumResultsForSearch: 2,
                                        dropdownParent: $('.ppn'+vars[0]+':last').next('.dropDownSelect2'),
                                    }).val(value.ppn).trigger('change');
                                    $('.pph23'+vars[0]+':last').select2({
                                        minimumResultsForSearch: 2,
                                        dropdownParent: $('.pph23'+vars[0]+':last').next('.dropDownSelect2'),
                                    }).val(value.pph23).trigger('change');
                                });
                            }
                        });

                        $(document).on('click','.tambahKomisi,.tambahKomisi2',function(e){
                            e.preventDefault();
                            let vars=['',komisiDivAwal,idPenanggungTerpilih];
                            if( ! $(this).hasClass('tambahKomisi')){
                                vars=['2',komisiDivAwal2,idPenanggungTerpilih2];
                            }
                            if($('.komisiDiv'+vars[0]).length==0){
                                $('#komisiDivParent'+vars[0]).append('<div class="komisiDiv'+vars[0]+' row">'+vars[1]+'</div>');
                            }else{
                                $('.komisiDiv'+vars[0]+':last').after('<div class="komisiDiv'+vars[0]+' row">'+vars[1]+'</div>');
                            }

                            $('.penanggung'+vars[0]).each(function(index,el){
                                if( ! $(el).hasClass("select2-hidden-accessible")){
                                    $(el).select2({
                                        minimumResultsForSearch: 2,
                                        data: dataPenanggung,
                                        dropdownParent: $(el).next('.dropDownSelect2'),
                                        placeholder: {
                                            id: '-1', // the value of the option
                                            text: 'Pilih Perusahaan'
                                        },
                                    }).val(null).trigger('change')
                                    .on('select2:selecting',function(el){
                                        if(vars[2].indexOf(el.params.args.data.id) > -1){
                                            new Noty({
                                                text   : 'Sudah terpilih',
                                                type   : 'alert',
                                                timeout: 5000
                                            }).show();
                                            el.preventDefault();
                                            return false;
                                        }else{
                                            if(el.target.value == -1 || el.target.value == ''){
                                                //add
                                                vars[2].push(el.params.args.data.id);
                                            }else{
                                                //replace
                                                vars[2][vars[2].indexOf(el.target.value)] = el.params.args.data.id;
                                            }
                                        }
                                    });
                                }
                            })
                            $('.ppn'+vars[0]+':last').select2({
                                minimumResultsForSearch: 2,
                                dropdownParent: $('.ppn'+vars[0]+':last').next('.dropDownSelect2'),
                            });
                            $('.pph23'+vars[0]+':last').select2({
                                minimumResultsForSearch: 2,
                                dropdownParent: $('.pph23'+vars[0]+':last').next('.dropDownSelect2'),
                            });
                        });
                        
                        $(document).on('click','.hapusKomisi,.hapusKomisi2',function(e){
                            e.preventDefault();
                            let vars=['.penanggung',idPenanggungTerpilih];
                            if( ! $(this).hasClass('hapusKomisi')){
                                vars=['.penanggung2',idPenanggungTerpilih2];
                            }
                            let parent = $(this).parent().parent().parent();
                            if(vars[1].indexOf(parent.find(vars[0]).val()) > -1){
                                vars[1].splice(vars[1].indexOf(parent.find(vars[0]).val()),1);
                            }
                            parent.remove();
                        });
                        
                        $(window).scroll(function() {
                            let ff=$('#topKomisi').offset().top - $(window).scrollTop();
                            if(ff <= 66){
                                $('.tambahKomisi').addClass('tambah-fixed').html('<i class="icon-plus"></i>');
                                $('.tambahKomis2').addClass('tambah-fixed2').html('<i class="icon-plus"></i>');
                            }else{
                                $('.tambahKomisi').removeClass('tambah-fixed').html('Tambah Menerima Komisi');
                                $('.tambahKomisi2').removeClass('tambah-fixed2').html('Tambah Memberi Komisi');
                            }
                            //console.log(ff);
                        });
                        $(document).on('focusout','#porsi,.komisi,.komisi2',function(){
                            $(this).val(formatMoney(formatNumber($(this).val()), 5, ".", ","));
                        });
                        $(document).on('keydown','.komisi,.komisi2,#porsi,#dana_in_no',function(e){
                            if(e.key.length==1)
                                if((isNaN(e.key) || e.key == " ") && e.key != ".")
                                    e.preventDefault();
                        });
                        $(".js-select2").each(function(){
							$(this).select2({
								minimumResultsForSearch: 2,
								dropdownParent: $(this).next('.dropDownSelect2')
							});
                        });
                        $('#jenis').on('select2:close', function (e){
                            if($(this).val() == 0) {
                                $('.js-show-jenis').slideDown();
                                $('#maxp,#minp').attr('required','required').parent().addClass('validate-input');
                                $('.js-show-main').slideUp();
                            } else {
                                $('#maxp,#minp').removeAttr('required').parent().removeClass('validate-input');
                                $('.js-show-jenis').slideUp();
                                $('.js-show-main').slideDown();
                            }
                        });
					});
				</script>
				<div class="row">
                    <form id="form" class="form-inline validate-form" method="post">
                        <div class="panel">
                            <div class="panel-body">
                                <input type="hidden" name="id" required value="<?=$_GET['id']?>">
                                <input type="hidden" name="id2" required value="<?=$_GET['id2']?>">

                                <div class="col-12 row-flex" >
                                    <label class="col-lg-4 col-md-5 col-sm-5 col-xs-12 p-0">Kode Produk</label>
                                    <input type="text" disabled id="kode" name="kode" class="form-control col-lg-5 col-md-6 col-sm-7 col-xs-12" value="<?=$produk['PROD_NAMA']?>">
                                </div>
                                <div class="col-12 row-flex">
                                    <label class="col-lg-4 col-md-5 col-sm-5 col-xs-12 p-0">Partner</label>
                                    <div class="col-lg-5 col-md-6 col-sm-7 col-xs-12 p-0">
                                        <select name="partner" class="js-select2" id="partner" readonly>
                                            <option value="<?=$partner['ENTITY_ID']?>" selected><?=$partner['ENTITY_NAMA']?></option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                                <div class="col-12 row-flex validate-input" data-validate="Silakan Pilih Level Partner">
                                    <label class="col-lg-4 col-md-5 col-sm-5 col-xs-12 p-0">Level Partner</label>
                                    <div class="col-lg-5 col-md-6 col-sm-7 col-xs-12 p-0">
                                        <select required name="level" class="js-select2" id="level">
											<option value="-1" <?=(is_null($data['SHA_ENTITY_LEVEL'][$_GET['id2']]))?'selected':null ?> >&nbsp;</option>
											<option value="0" <?=($data['SHA_ENTITY_LEVEL'][$_GET['id2']] === 0)?'selected':null ?> >Asuransi</option>
											<option value="1" <?=($data['SHA_ENTITY_LEVEL'][$_GET['id2']] === 1)?'selected':null ?> >Re Asuransi</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                                <div class="col-12 row-flex" data-validate="Silakan Pilih Bank Rekening">
                                    <label class="col-lg-4 col-md-5 col-sm-5 col-xs-12 p-0">Bank Rekening</label>
                                    <div class="col-lg-5 col-md-6 col-sm-7 col-xs-12 p-0">
                                        <select reqs  id="dana_in_bank" name="dana_in_bank" class="js-select2">
                                            <option <?=($data['BANK'][$_GET['id2']]['bank']=="BNI"?'selected':null)?> value="BNI">BNI</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                                <div class="col-12 row-flex validate-input" data-validate="Silakan Masukkan No Rekening">
                                    <label class="col-lg-4 col-md-5 col-sm-5 col-xs-12 p-0">No Rekening</label>
                                    <input type="text" value="<?=$data['BANK'][$_GET['id2']]['no']?>" id="dana_in_no" name="dana_in_no" class="form-control col-lg-5 col-md-6 col-sm-7 col-xs-12">
                                </div>
                                <div class="col-12 row-flex validate-input" data-validate="Silakan Masukkan Nama Rekening">
                                    <label class="col-lg-4 col-md-5 col-sm-5 col-xs-12 p-0">Nama Rekening</label>
                                    <input type="text" value="<?=$data['BANK'][$_GET['id2']]['nama']?>" id="dana_in_nama" name="dana_in_nama" class="form-control col-lg-5 col-md-6 col-sm-7 col-xs-12">
                                </div>
                                <div class="col-12 row-flex validate-input" data-validate="Silakan Masukkan Porsi Resiko">
                                    <label class="col-lg-4 col-md-5 col-sm-5 col-xs-12 p-0">PORSI RESIKO (Maksimal <?=(100 - $totalResiko)?>) %</label>
                                    <input type="text" value="<?=formatMoney($data['RESIKO'][$_GET['id2']], 5, ".", ",")?>" max="<?=(100 - $totalResiko)?>" step=".01" id="porsi" name="porsi" class="form-control col-lg-5 col-md-6 col-sm-7 col-xs-12" required>
                                </div>
                                <div class="col-12 row-flex">
                                    <label class="col-lg-4 col-md-5 col-sm-5 col-xs-12 p-0">STATUS</label>
                                    <div class="col-lg-5 col-md-6 col-sm-7 col-xs-12 p-0">
                                        <select class="js-select2" id="status" name="status">
                                            <option <?=(($data['STATUS'][$_GET['id2']] == "0") ? 'selected' : '')?> value="0" >ACTIVE</option>
                                            <option <?=(($data['STATUS'][$_GET['id2']] == "1") ? 'selected' : '')?> value="1" >SUSPENDED</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h3 id="topKomisi2">Memberi Komisi  <a href="#" title="Tambah Form Memberi Komisi" class="btn btn-sm btn-primary tambahKomisi2">Tambah Memberi Komisi</a></h3>
                        <div class="wrap-input100 bg1" id="komisiDivParent2">
                            <div class="col-sm-4 hidden-xs">Kepada</div>
                            <div class="col-sm-3 hidden-xs">Porsi Komisi (%)</div>
                            <div class="col-sm-2 hidden-xs">PPN</div>
                            <div class="col-sm-2 hidden-xs">PPH 23</div>
                            <div class="col-sm-1 hidden-xs">Aksi</div>
                            
                            <div class="komisiDiv2 row">
                                <div class="hidden-sm hidden-md hidden-lg col-xs-4">Memberi Kepada</div>
                                <div class="col-sm-4 col-xs-7">
                                    <div>
                                        <select name="penanggung2[]" class="penanggung2">
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                                <div class="hidden-sm hidden-md hidden-lg col-xs-4">Porsi Komisi (%)</div>
                                <div class="col-sm-3 col-xs-7">
                                    <input type="text" name="komisi2[]" placeholder="isi porsi komisi" class="input100 komisi2">
                                </div>
                                <div class="hidden-sm hidden-md hidden-lg col-xs-4">PPN</div>
                                <div class="col-sm-2 col-xs-7">
                                    <div>
                                        <select required class="ppn2" name="ppn2[]">
                                            <option value="y" >Ya</option>
                                            <option value="n" >Tidak</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                                <div class="hidden-sm hidden-md hidden-lg col-xs-4">PPH 23</div>
                                <div class="col-sm-2 col-xs-7">
                                    <div>
                                        <select required class="pph232" name="pph232[]">
                                            <option value="y" >Ya</option>
                                            <option value="n" >Tidak</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                                <div class="hidden-sm hidden-md hidden-lg col-xs-4">Aksi</div>
                                <div class="col-sm-1 col-xs-7">
                                    <div class="hidden-xs">
                                        <a href="#" title="Hapus" class="btn btn-sm hapusKomisi2" style="margin-top:5px"><i class="icon-remove"></i></a>
                                    </div>
                                    <div class="hidden-sm hidden-md hidden-lg">
                                        <a href="#" class="btn btn-sm btn-danger hapusKomisi2">Hapus</a>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                            <!-- end div.komisi-->
                        </div>
                        <h3 id="topKomisi">Menerima Komisi  <a href="#" title="Tambah Komisi" class="btn btn-sm btn-primary tambahKomisi">Tambah Komisi</a></h3>
                        <div class="wrap-input100 bg1" id="komisiDivParent">
                            <div class="col-sm-3 hidden-xs">Porsi Komisi (%)</div>
                            <div class="col-sm-4 hidden-xs">Penanggung</div>
                            <div class="col-sm-2 hidden-xs">PPN</div>
                            <div class="col-sm-2 hidden-xs">PPH 23</div>
                            <div class="col-sm-1 hidden-xs">Aksi</div>
                            
                            <div class="komisiDiv row">
                                <div class="hidden-sm hidden-md hidden-lg col-xs-4">Porsi Komisi (%)</div>
                                <div class="col-sm-3 col-xs-7">
                                    <input type="text" name="komisi[]" placeholder="isi porsi komisi" class="input100 komisi">
                                </div>
                                <div class="hidden-sm hidden-md hidden-lg col-xs-4">Penanggung</div>
                                <div class="col-sm-4 col-xs-7">
                                    <div>
                                        <select name="penanggung[]" class="penanggung">
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                                <div class="hidden-sm hidden-md hidden-lg col-xs-4">PPN</div>
                                <div class="col-sm-2 col-xs-7">
                                    <div>
                                        <select required class="ppn" name="ppn[]">
                                            <option selected value="y" >Ya</option>
                                            <option value="n" >Tidak</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                                <div class="hidden-sm hidden-md hidden-lg col-xs-4">PPH 23</div>
                                <div class="col-sm-2 col-xs-7">
                                    <div>
                                        <select required class="pph23" name="pph23[]">
                                            <option selected value="y" >Ya</option>
                                            <option value="n" >Tidak</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                                <div class="hidden-sm hidden-md hidden-lg col-xs-4">Aksi</div>
                                <div class="col-sm-1 col-xs-7">
                                    <div class="hidden-xs">
                                        <a href="#" title="Hapus" class="btn btn-sm hapusKomisi" style="margin-top:5px"><i class="icon-remove"></i></a>
                                    </div>
                                    <div class="hidden-sm hidden-md hidden-lg">
                                        <a href="#" class="btn btn-sm btn-danger hapusKomisi">Hapus</a>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                            <!-- end div.komisi-->
                        </div>
                        <div class="container-contact100-form-btn">
                            <a href="./?p=business_rules_detail&id=<?=$_GET['id']?>" class="contact100-form-btn">Kembali</a>
                            <button type="submit" class="contact100-form-btn" id="simpan">
                                <span>
                                    Simpan
                                    <i class="icon-angle-right"></i>
                                </span>
                            </button>
                        </div>
                    </form>

					</div>
				</div>
				<?php include "footer.php";?>

				<!-- /Page Content -->
			</div>
		</div>
	</div>
    <script>
		$(document).ready(function(){
            $('#form').on('submit',function(e){
                e.preventDefault();
                let input = $('.validate-input > input');
                let check = true;
				let err = null;

                for(let i=0; i<input.length; i++) {
                    if(validate(input[i]) == false){
                        showValidate(input[i]);
                        check=false;
						err=input[i].parentElement.dataset.validate;
                    }
                }
                $('.komisi,.komisi2').each(function(index,el){
                    let vars=[''];
                    if( ! $(this).hasClass('komisi')){
                        vars=['2'];
                    }
                    let parent = $(el).parent().parent();
                    if(parent.find('.penanggung'+vars[0])[0].selectedIndex != -1 && $(this).val()==''){
                        check=false;
                        err="Silakan isi komisi "+parent.find('.penanggung'+vars[0])[0].selectedOptions[0].text;
                    }else if(parent.find('.penanggung'+vars[0])[0].selectedIndex == -1){
                        parent.find('.hapusKomisi'+vars[0]).trigger('click');
                    }else if(parent.find('.penanggung'+vars[0]).val()==$('#partner').val()){
                        parent.find('.hapusKomisi'+vars[0]).trigger('click');
                    }
                });
                if(err != null) new Noty({
                        text   : 'Gagal : '+err,
                        type   : 'alert',
                        timeout: 5000
                    }).show();
                if(!check) return check;

                if(!check) return check;
                let ex=new Noty({
                    text: 'Simpan data?',
                    type: 'alert',
                    layout: 'center',
                    closeWith: ['backdrop'],
                    modal: true,
                    timeout: 10000,
                    buttons: [
                            Noty.button('Ya', 'btn btn-success', function () {
                                simpan();
                                ex.close();
                                App.blockUI('#content');
                            }, {id: 'button1', 'data-status': 'ok'}),
                            Noty.button('Batal', 'btn btn-error', function () {
                                ex.close();
                            })
                        ]
                }).show()
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
                            App.unblockUI('#content');
                            console.log(ajaxRequest.responseText);
                            var JSONObject = JSON.parse(ajaxRequest.responseText);
                            if(JSONObject[0] != false)
                            {
                                new Noty({
                                    text   : JSONObject.pesan,
                                    type   : 'alert',
                                    timeout: 5000
                                }).show();
                                window.location = "./?p=business_rules_detail&id=<?=$_GET['id']?>";
                            }else{
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
                    formData.set("type","business_rules_detail_ubah");
                    <?php $token = (empty($_SESSION['token'])) ? $_SESSION['token'] = bin2hex(random_bytes(32)) : $_SESSION['token'];?>
                    formData.set("token","<?=$token?>");

                    ajaxRequest.send(formData);
            }
        });
	</script>
