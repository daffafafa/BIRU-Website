<ul id="nav">
	<li class="current open">
		<a href="index.php">
			<i class="icon-dashboard"></i>
			Dasbor
		</a>
    </li>
        <?php if(has_permission_array(array('access_perusahaan','access_right_management_user_perusahaan','access_right_management_user_b2c','access_zonasi','modifikasi_sub_produk_mekaar','access_gempa'))){ ?>
    <li>
        <a href="javascript:void(0);">
            <i class="icon-gear"></i>
            Pengaturan
        </a>
        <ul class="sub-menu">
            <?php if(has_permission('access_perusahaan')){?>
            <li><a href="./?p=company" >
                <!-- <i class="icon-angle-right"></i><i class="icon-building"></i>  -->
                Perusahaan</a></li>
            <?php }?>
            <!-- <li><a href="./?p=" ><i class="icon-angle-right"></i><i class="icon-gear"></i> Parameter</a></li> -->
            <?php if(has_permission_array(array('access_right_management_user_perusahaan','access_right_management_user_b2c'))){ ?>
                <li><a href="./?p=user_management" >
                <!-- <i class="icon-angle-right"></i><i class="icon-group"></i>  -->
                    User & Right Management</a></li>
            <?php }?>
            <?php if(has_permission('access_zonasi')){?>
                <li><a href="./?p=zona" >
                    <!-- <i class="icon-angle-right"></i><i class="icon-gear"></i>  -->
                    Zonasi</a></li>
            <?php }?>
            <?php if(has_permission('access_holiday_system')){?>
                <li><a href="./?p=holiday" >
                    <!-- <i class="icon-angle-right"></i><i class="icon-calendar"></i>  -->
                    Holiday</a></li>
            <?php }?>
            <?php if(has_permission_array(array('access_main_produk','access_sub_produk'))){ ?>
                <li>
                    <a href="javascript:void(0);">
                        <!-- <i class="icon-angle-right"></i><i class="icon-shopping-cart"></i>  -->
                        Produk</a>
                    <ul class="sub-menu">
                        <?php if(has_permission('create_main_produk')){?>
                            <li><a href="./?p=produk&a=tambah" >
                                <!-- <i class="icon-plus"></i>  -->
                                Tambah Produk</a></li>
                        <?php }?>
                        <?php if(has_permission('access_main_produk')){?>
                            <li><a href="./?p=produk" >
                                <!-- <i class="icon-list"></i>  -->
                                Daftar Main Produk</a></li>
                        <?php }?>
                        <?php if(has_permission('access_sub_produk')){?>
                            <li><a href="./?p=produk&type=sub" >
                                <!-- <i class="icon-list"></i>  -->
                                Daftar Sub Produk</a></li>
                        <?php }?>
                    </ul>
                </li>
            <?php }?>
            <?php if(has_permission('access_holiday_produk')){?>
                <li><a href="./?p=holiday_produk" >
                    <!-- <i class="icon-angle-right"></i><i class="icon-calendar"></i>  -->
                    Holiday Produk</a></li>
            <?php }?>
            <?php if(has_permission('access_gempa')){?>
                <li><a href="./?p=gempa" >
                    <!-- <i class="icon-angle-right"></i><i class="icon-map-marker"></i>  -->
                    EQ Data</a></li>
            <?php }?>
            <!-- <li>
                <a href="javascript:void(0);">
                <i class="icon-angle-right"></i><i class="icon-shopping-cart"></i>
                    Data Feed
                </a>
                <ul class="sub-menu">
                    <li><a href="./?p=" ><i class="icon-angle-right"></i><i class="icon-group"></i> Bank</a></li>
                    <li><a href="./?p=" ><i class="icon-angle-right"></i><i class="icon-group"></i> Gold Price</a></li>
                    <li><a href="./?p=" ><i class="icon-angle-right"></i><i class="icon-group"></i> Price Engine</a></li>
                </ul>
            </li> -->
        </ul>
    </li>
            <?php }?>
	<!-- <li>
        <a href="javascript:void(0);">
            <i class="icon-ok-circle"></i>
            Support
        </a>
        <ul class="sub-menu">
            <li><a target="_blank" href="<?=getUrlServer()?>/privasi.html" ><i class="icon-angle-right"></i><i class="icon-ok-circle"></i>Term of Service</a></li>
            <li><a href="./?p="><i class="icon-angle-right"></i><i class="icon-ok-circle"></i>Privacy Policy</a></li>
            <li><a href="./?p=" ><i class="icon-angle-right"></i><i class="icon-question-sign"></i>Help</a></li>
            <li><a href="./?p=" ><i class="icon-angle-right"></i><i class="icon-question-sign"></i>Q & A</a></li>
            <li><a href="./?p=client_profile#profile" class="tab_c" ><i class="icon-angle-right"></i><i class="icon-user"></i>Client Profile</a></li>
            <li><a href="./?p=client_profile#transaction_history" class="tab_c"><i class="icon-angle-right"></i><i class="icon-list"></i>Client Transaction</a></li>
            <li><a href="./?p=" ><i class="icon-angle-right"></i><i class="icon-info-sign"></i>Info Data</a></li>
            <li><a href="./?p=" ><i class="icon-angle-right"></i><i class="icon-ok-circle"></i>Claim Info & Approval</a></li>
            <li><a href="./?p=" ><i class="icon-angle-right"></i><i class="icon-question-sign"></i>Data hak dan kewajiban</a></li>
        </ul>
    </li> -->
    <li>
		<a href="javascript:void(0);">
			<i class="icon-shopping-cart"></i>
			Produk
		</a>
		<ul class="sub-menu">
    <?php
$p = 'SELECT a.PROD_ID,a.PROD_NAMA,a.PROD_STATUS,a.PROD_LEVEL' .
    ',CONCAT(' .
    '   IFNULL(GROUP_CONCAT(c.PROD_TYPE),""), "," ,' .
    '   IFNULL(GROUP_CONCAT(d.PROD_TYPE),"")' .
    ' ) PROD_TYPE ' .
    ' FROM ma2001 c ' .
    ' LEFT JOIN ma2001 a ON a.PROD_ID=c.PROD_ID_PARENT ' .
    ' LEFT JOIN ma2001 d ON d.PROD_ID_PARENT=a.PROD_ID AND  d.PROD_ID NOT LIKE c.PROD_ID ' .
    ' WHERE '.
    ' a.PROD_STATUS=0' .
    ' GROUP BY a.PROD_ID ORDER BY a.PROD_NAMA';
$query = mysqli_query($conection, $p);
while ($menuProduk = mysqli_fetch_array($query)) 
{?>
<!-- if main prod mekaar start -->
        <?php if($menuProduk['PROD_ID'] == "PR002" && has_permission('access_produk_mekaar')){?>
            <li>
                <a href="javascript:void(0);">
                    <!-- <i class="icon-angle-right"></i> -->
                    <?=$menuProduk['PROD_NAMA']?>
                </a>
                <ul class="sub-menu">
    <!-- belum selesai can create cabang&sektor usaha start -->
                        <?php if(has_permission('access_cabang_mekaar')){?>
                        <li>
                            <a href="javascript:void(0);">
                                <!-- <i class="icon-gear"></i> -->
                                Pengaturan
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="./?p=cabang&id=<?=$menuProduk['PROD_ID']?>" >
                                    <!-- <i class="icon-list-alt"></i>  -->
                                    Daftar Cabang </a></li>
                                <li>
                                    <a href="./?p=sektor_usaha&id=<?=$menuProduk['PROD_ID']?>" >
                                    <!-- <i class="icon-list-alt"></i>  -->
                                    Daftar Sektor Usaha</a></li>
                            </ul>
                        <li>
                        <?php }?>
    <!-- belum selesai can create cabang&sektor usaha end -->
                        
                        <?php if(has_permission_like('input_data_cabang_mekaar')){ ?>
                            <li>
                                <a href="./?p=peserta&a=tambah&id=<?=$menuProduk['PROD_ID']?>" >
                                <!-- <i class="icon-plus"></i>  -->
                                Entry Data Peserta</a></li>
                            <li>
                                <a href="./?p=peserta&a=upload&id=<?=$menuProduk['PROD_ID']?>" >
                                <!-- <i class="icon-upload"></i>  -->
                                Upload Data Peserta</a></li>
                        <?php } ?>
                        <?php if(has_permission('access_bussiness_rules_mekaar')){?>
                            <li>
                                <a href="./?p=produk&type=sub&kode=<?=$menuProduk['PROD_ID']?>" >
                                <!-- <i class="icon-cogs"></i>  -->
                                Bussiness Rules</a></li>
                        <?php }?>
                            
                        <!-- Laporan peserta (belum bayar,sudah bayar) start -->
                        <li>
                            <a href="javascript:void(0);">
                                <!-- <i class="icon-list"></i> -->
                                Laporan Peserta
                            </a>
                            <ul class="sub-menu">
                                <?php if(has_permission('access_data_baru_mekaar')){?>
                                    <li><a href="./?p=peserta&a=baru&id=<?=$menuProduk['PROD_ID']?>" >
                                        <!-- <i class="icon-group"></i>  -->
                                        Baru/Belum Bayar</a></li>
                                <?php }?>
                                <?php if(has_permission('access_data_aktif_mekaar')){?>
                                    <li><a href="./?p=peserta&a=aktif&id=<?=$menuProduk['PROD_ID']?>" > 
                                        <!-- <i class="icon-group"></i>  -->
                                        Aktif</a></li>
                                <?php }?>
                                <?php if(in_array('dca eq',explode(',', $menuProduk['PROD_TYPE']))){ ?>
                                    <li><a href="./?p=peserta&a=terdampak&id=<?=$menuProduk['PROD_ID']?>" >
                                        <!-- <i class="icon-group"></i> -->
                                        Terdampak Gempa</a></li>
                                <?php }?>

                            </ul>
                        <li>
                        <!-- Laporan peserta (belum bayar,sudah bayar) end -->
                        <?php if(has_permission_like('paid_data_cabang_mekaar_')){?>
                            <li><a href="./?p=peserta&a=settlement&id=<?=$menuProduk['PROD_ID']?>" >
                                <!-- <i class="icon-exchange"></i> -->
                                Settlement</a></li>
                        <?php }?>

                        <li><a href="./?p=laporan&a=transaksi&id=<?=$menuProduk['PROD_ID']?>" >
                            <!-- <i class="icon-list"></i>  -->
                            Laporan Produksi</a></li>

                        <?php if(in_array('dca eq',explode(',', $menuProduk['PROD_TYPE']))){ ?>
                            <li><a href="./?p=laporan&a=gempa&id=<?=$menuProduk['PROD_ID']?>" >
                                <!-- <i class="icon-list"></i> -->
                                Laporan Gempa</a></li>
                        <?php }?>

                        <li><a href="./?p=list_kewajiban&id=<?=$menuProduk['PROD_ID']?>" >
                            <!-- <i class="icon-check"></i>  -->
                            Daftar Kewajiban/Utang</a></li>
    <!-- can claim start -->
                        <!-- <li><a href="./?p=" ><i class="icon-check"></i> Klaim</a></li> -->
    <!-- can claim end -->
                        <li><a href="./?p=list_klaim&id=<?=$menuProduk['PROD_ID']?>" >
                            <!-- <i class="icon-list"></i> -->
                            Daftar Klaim</a></li>
<!-- if main prod mekaar end -->
                </ul>
            </li>
<!-- if other main prod start -->
        <?php } ?>
        <?php if($menuProduk['PROD_ID'] != "PR002" && has_permission('access_produk_dca')){?>
            <li>
                <a href="javascript:void(0);">
                    <i class="icon-angle-right"></i>
                    <?=$menuProduk['PROD_NAMA']?>
                </a>
                <ul class="sub-menu">
                        <li><a href="./?p=peserta&id=<?=$menuProduk['PROD_ID']?>" ><i class="icon-list"></i> Produksi</a></li>
                        <li><a href="./?p=laporan&a=transaksi&id=<?=$menuProduk['PROD_ID']?>" ><i class="icon-list"></i> Laporan Produksi</a></li>

                        <?php if(in_array('dca eq',explode(',', $menuProduk['PROD_TYPE']))){ ?>
                            <li><a href="./?p=laporan&a=gempa&id=<?=$menuProduk['PROD_ID']?>" ><i class="icon-list"></i> Laporan Gempa</a></li>
                            <li><a href="./?p=peserta&a=terdampak&id=<?=$menuProduk['PROD_ID']?>" ><i class="icon-list"></i> Terdampak Gempa</a></li>
                        <?php }?>

                        <li><a href="./?p=list_kewajiban&id=<?=$menuProduk['PROD_ID']?>" ><i class="icon-check"></i> Daftar Kewajiban/Utang</a></li>
    <!-- can claim start -->
                        <li><a href="./?p=" ><i class="icon-check"></i> Klaim</a></li>
    <!-- can claim end -->
                        <li><a href="./?p=list_klaim&id=<?=$menuProduk['PROD_ID']?>" ><i class="icon-list"></i> Daftar Klaim</a></li>
                </ul>
            </li>
        <?php } ?>
<!-- if other main prod end -->
<?php }?>
        </ul>
	</li>
    <!-- li>
		<a href="javascript:void(0);">
			<i class="icon-shopping-cart"></i>
			Data Feed
		</a>
        <ul class="sub-menu">
            <li><a href="./?p=" ><i class="icon-angle-right"></i><i class="icon-group"></i> Bank</a></li>
            <li><a href="./?p=" ><i class="icon-angle-right"></i><i class="icon-group"></i> Gold Price</a></li>
            <li><a href="./?p=" ><i class="icon-angle-right"></i><i class="icon-group"></i> EQ Data</a></li>
            <li><a href="./?p=" ><i class="icon-angle-right"></i><i class="icon-group"></i> Price Engine</a></li>
        </ul>
    </!-->
</ul>
