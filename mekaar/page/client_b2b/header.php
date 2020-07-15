		<!-- Top Navigation Bar -->
		<div class="container">

			<!-- Only visible on smartphones, menu toggle -->
			<ul class="nav navbar-nav">
				<li class="nav-toggle"><a href="javascript:void(0);" title=""><i class="icon-reorder"></i></a></li>
			</ul>

			<!-- Logo -->
			<a class="navbar-brand" href="index.php">
				<!-- <img src="<?=getUrlServer()?>/assets/img/logo.png" alt="logo" /> -->
				<img src="<?=getUrlServer()?>/assets/img/logo_biru.png" alt="logo" />
				<span style="line-height: 50px;vertical-align: bottom;">BIRU </span>
				<!-- <span style="font-size:10px;line-height: 40px;vertical-align: bottom;">(Client B2B)</span> -->
			</a>
			<!-- /logo -->

			<!-- Sidebar Toggler -->
			<!--<a href="#" class="toggle-sidebar bs-tooltip" data-placement="bottom" data-original-title="Toggle navigation">
				<i class="icon-reorder"></i>
			</a>-->
			<!-- /Sidebar Toggler -->

			<!-- Top Left Menu -->
			<!--<ul class="nav navbar-nav navbar-left hidden-xs hidden-sm">
				<li>
					<a href="#">
						Ringkasan
					</a>
				</li>
				<li>
					<a href="#">
						Saldo
					</a>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						Alat
						<i class="icon-caret-down small"></i>
					</a>
					<ul class="dropdown-menu">
						<li><a href="#"><i class="icon-user"></i> Example #1</a></li>
						<li><a href="#"><i class="icon-calendar"></i> Example #2</a></li>
						<li class="divider"></li>
						<li><a href="#"><i class="icon-tasks"></i> Example #3</a></li>
					</ul>
				</li>
			</ul>-->
			<!-- /Top Left Menu -->

			<!-- Top Right Menu -->
			<ul class="nav navbar-nav navbar-right">
				<!-- Notifications -->
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
      1 BRU = Rp <span class="money"><?=getConversiBruToIdr()?></span>
					</a>
				</li>

				<!-- Pengaturan -->
				<!--li-- class="dropdown hidden-xs hidden-sm">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-cog"></i>
					</a>
					<ul class="dropdown-menu extended notification">
						<li class="title">
							<p>Pengaturan</p>
						</li>
						<li>
							<a href="pages_user_profile.php">
								Profil Anda
							</a>
						</li>
						<li>
							<a href="javascript:void(0);">
								Pengaturan Rekening
							</a>
						</li>

					</ul>
				</!--li-->
<?php
	$jumlah_notif = 0;
	//utang klaim untuk perusahaan penanggung resiko
	$sql = 'SELECT SUM(a.NILAI) nilai,d.PROD_CURR,d.PROD_ID,d.PROD_NAMA FROM tr0004_b2c a '.
		' JOIN tr0002_b2c b ON a.TRX_DETAIL_SYSTEM_ID=b.TRX_DETAIL_SYSTEM_ID '.
		' JOIN ma2001 c ON b.SUB_PROD_ID=c.PROD_ID '.
		' JOIN ma2001 d ON c.PROD_ID_PARENT=d.PROD_ID ';
	// if( ! empty($_SESSION['user_cabang_key'])){
	// 	$sql .= ' JOIN ma1003 e ON a.CABANG_ID=e.LOKASI_ID AND a.PROD_ID=e.PROD_ID AND e.ID_KEY='.$_SESSION['user_cabang_key'];
	// }
	$sql .=' WHERE a.KEWAJIBAN_STATUS=0 AND a.ENTITY_ID="' . $_SESSION['user_cli_group'] . '" GROUP BY d.PROD_ID';
	$query = mysqli_query($conection, $sql);
	$utang_dari_klaim = array();
	if(mysqli_num_rows($query) > 0){
		while($row=mysqli_fetch_array($query)){
			$utang_dari_klaim[$row['PROD_ID']] = array('nilai'=>$row['nilai'],'CURR_ID'=>$row['PROD_CURR'],'PROD_NAMA'=>$row['PROD_NAMA']);
			$jumlah_notif++;
		}
	}
	//utang input/upload data untuk perusahaan terlibat dan cabang dibawahnya
	$sql = 'SELECT SUM(a.TRX_PREMI) nilai,a.CURR_ID,a.PROD_ID,b.PROD_NAMA FROM tr0001 a '.
		' JOIN ma2001 b ON a.PROD_ID=b.PROD_ID ';
if( ! empty($_SESSION['user_cabang_key'])){
	$sql .= ' JOIN ma1003 d ON a.CABANG_ID=d.LOKASI_ID AND a.PROD_ID=d.PROD_ID AND d.ID_KEY='.$_SESSION['user_cabang_key'];
}
	$sql.= ' WHERE a.TRX_STATUS=0 AND a.ENTITY_ID="' . $_SESSION['user_cli_group'] . '"'.
	  	' GROUP BY a.PROD_ID';
	$query = mysqli_query($conection,$sql);
	$utang_dari_settlement = array();
	if(mysqli_num_rows($query) > 0){
		while($row=mysqli_fetch_array($query)){
			$utang_dari_settlement[$row['PROD_ID']] = array('nilai'=>$row['nilai'],'CURR_ID'=>$row['CURR_ID'],'PROD_NAMA'=>$row['PROD_NAMA']);
			$jumlah_notif++;
		}
	}
	//jumlah data baru untuk broker, broker re, asuransi, re assuransi, biru
	// $sql = 'SELECT SUM(a.TRX_PREMI) nilai,a.CURR_ID,a.PROD_ID,b.PROD_NAMA FROM tr0001 a '.
	// 	' JOIN ma2001 b ON a.PROD_ID=b.PROD_ID ';
	// $sql.= ' WHERE a.TRX_STATUS=0 AND a.ENTITY_ID="' . $_SESSION['user_cli_group'] . '"'.
	//   	' GROUP BY a.PROD_ID';

?>
				<!-- Messages -->
				<li class="dropdown ">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-envelope"></i>
						<?php if($jumlah_notif>0){?>
						<span class="badge"><?=$jumlah_notif?></span>
						<?php }?>
					</a>
					<ul class="dropdown-menu extended notification">
						<li class="title">
							<p>Kamu punya <?=$jumlah_notif?> notifikasi</p>
						</li>
						<li>
							<?php 
								if(count($utang_dari_klaim)>0){
									foreach($utang_dari_klaim as $kode=>$row){
							?>
									<a href="?p=list_kewajiban&id=<?=$kode?>">
										<span class="subject">
											<span class="from">Total Kewajiban/Utang Klaim <br> Produk <?=$row['PROD_NAMA']?></span>
											<span class="time">Just Now</span>
										</span>
										<span class="text">
											<?=$row['CURR_ID']?> <span class="money"><?=$row['nilai']?></span>
										</span>
									</a>
							<?php }}?>
							<?php 
								if(count($utang_dari_settlement)>0){
									foreach($utang_dari_settlement as $kode=>$row){
							?>
									<a href="?p=peserta&id=<?=$kode?>&a=settlement">
										<span class="subject">
											<span class="from">Total Utang Settlement <br> Produk <?=$row['PROD_NAMA']?></span>
											<span class="time">Just Now</span>
										</span>
										<span class="text">
											<?=$row['CURR_ID']?> <span class="money"><?=$row['nilai']?></span>
										</span>
									</a>
							<?php }}?>
							<!--a-- href="javascript:void(0);">
								<span class="photo"><img src="<?=getUrlServer()?>/assets/img/demo/avatar-1.jpg" alt="" /></span>
								<span class="subject">
									<span class="from">Bob Carter</span>
									<span class="time">Just Now</span>
								</span>
								<span class="text">
									Consetetur sadipscing elitr...
								</span>
							</!--a-->
						</li>
						<li class="footer">
							<a href="javascript:void(0);">Lihat semua notifikasi</a>
						</li>
					</ul>
				</li>

				<!-- .row .row-bg Toggler -->
				<li>
					<a href="#" class="dropdown-toggle row-bg-toggle">
						<i class="icon-resize-vertical"></i>
					</a>
				</li>



				<!-- User Login Dropdown -->
				<li class="dropdown user">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<!--<img alt="" src="assets/img/avatar1_small.jpg" />-->
						<i class="icon-male"></i>
						<span class="username">
		<?php 
		if(isB2C()){
			echo ($_SESSION['user_cli_name']); 
		}else if(isB2B()){
			echo $_SESSION['user_id'];
		}
		?>
                        </span>
						<i class="icon-caret-down small"></i>
					</a>
					<ul class="dropdown-menu">
						<li><a href="./?p=my_profile#profile" aria-controls="profile" class="tab_a"><i class="icon-user"></i> My Profile</a></li>
						<li><a href="./?p=my_profile#info" aria-controls="info" class="tab_a"><i class="icon-info-sign"></i> My Info</a></li>
						<li><a href="./?p=my_profile#transaction_history" aria-controls="transaction_history" class="tab_a"><i class="icon-list"></i> Transaction History</a></li>
						<li><a href="./?p=my_profile#change_password" aria-controls="change_password" class="tab_a"><i class="icon-key"></i> Change Password</a></li>
						<li><a href="./?p=my_profile#log_in_history" aria-controls="log_in_history" class="tab_a"><i class="icon-lock"></i> Log In History</a></li>
						<li class="divider"></li>
						<li><a href="<?=getUrlServer()?>/logout.php"><i class="icon-off"></i> Log Out</a></li>
					</ul>
				</li>
				<!-- /user login dropdown -->
			</ul>
			<!-- /Top Right Menu -->
		</div>
		<!-- /top navigation bar -->

		<!--=== Project Switcher ===-->
		<div id="project-switcher" class="container project-switcher">
			<div id="scrollbar">
				<div class="handle"></div>
			</div>

			<div id="frame">
				<ul class="project-list">
					<li>
						<a href="javascript:void(0);">
							<span class="image"><i class="icon-desktop"></i></span>
							<span class="title">Lorem ipsum dolor</span>
						</a>
					</li>
					<li>
						<a href="javascript:void(0);">
							<span class="image"><i class="icon-compass"></i></span>
							<span class="title">Dolor sit invidunt</span>
						</a>
					</li>
					<li class="current">
						<a href="javascript:void(0);">
							<span class="image"><i class="icon-male"></i></span>
							<span class="title">Consetetur sadipscing elitr</span>
						</a>
					</li>
					<li>
						<a href="javascript:void(0);">
							<span class="image"><i class="icon-thumbs-up"></i></span>
							<span class="title">Sed diam nonumy</span>
						</a>
					</li>
					<li>
						<a href="javascript:void(0);">
							<span class="image"><i class="icon-female"></i></span>
							<span class="title">At vero eos et</span>
						</a>
					</li>
					<li>
						<a href="javascript:void(0);">
							<span class="image"><i class="icon-beaker"></i></span>
							<span class="title">Sed diam voluptua</span>
						</a>
					</li>
					<li>
						<a href="javascript:void(0);">
							<span class="image"><i class="icon-desktop"></i></span>
							<span class="title">Lorem ipsum dolor</span>
						</a>
					</li>
					<li>
						<a href="javascript:void(0);">
							<span class="image"><i class="icon-compass"></i></span>
							<span class="title">Dolor sit invidunt</span>
						</a>
					</li>
					<li>
						<a href="javascript:void(0);">
							<span class="image"><i class="icon-male"></i></span>
							<span class="title">Consetetur sadipscing elitr</span>
						</a>
					</li>
					<li>
						<a href="javascript:void(0);">
							<span class="image"><i class="icon-thumbs-up"></i></span>
							<span class="title">Sed diam nonumy</span>
						</a>
					</li>
					<li>
						<a href="javascript:void(0);">
							<span class="image"><i class="icon-female"></i></span>
							<span class="title">At vero eos et</span>
						</a>
					</li>
					<li>
						<a href="javascript:void(0);">
							<span class="image"><i class="icon-beaker"></i></span>
							<span class="title">Sed diam voluptua</span>
						</a>
					</li>
				</ul>
			</div> <!-- /#frame -->
		</div> <!-- /#project-switcher -->
