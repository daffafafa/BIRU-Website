<?php if(isB2B()){ ?>
    <?php if( ! empty($_SESSION['user_cabang_key']) && has_permission_like('input_data_cabang_mekaar')){
            $sql = ' SELECT LOKASI_NAMA FROM ma1003 WHERE PROD_ID="PR002" AND ID_KEY='.$_SESSION['user_cabang_key'];
            $query = mysqli_query($conection,$sql);
            if(mysqli_num_rows($query)>0){
                $cabang = mysqli_fetch_array($query)['LOKASI_NAMA'];
                ?>
    <li><a href="#" title="<?=$cabang?>"><i class="icon-group"></i><span><?=$cabang?></span></a></li>
    <?php }}?> 
    <li class="dropdown"><a href="#" title="<?=$_SESSION['user_entity_nama']?>" data-toggle="dropdown">
        <i class="icon-building"></i><span><?=$_SESSION['user_entity_nama']?></span><i class="icon-angle-down left-padding"></i></a>
        <ul class="dropdown-menu pull-right">
            <li><a href="./?p=my_profile#profile" aria-controls="profile" class="tab_a"><i class="icon-user"></i> Company Profile</a></li>
        </ul>
    </li>
<?php }?>