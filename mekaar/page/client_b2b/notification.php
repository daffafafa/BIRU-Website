<?php 
    if(has_permission('access_data_baru_mekaar')){
        $sql = 'SELECT COUNT(TRX_UUID) FROM tr0001 d ';
        if( ! empty($_SESSION['user_cabang_key'])){
            $sql .= ' JOIN ma1003 e ON d.CABANG_ID=e.LOKASI_ID AND d.PROD_ID=e.PROD_ID AND e.ID_KEY='.$_SESSION['user_cabang_key'];
        }
        $sql .= ' WHERE d.TRX_STATUS=0 ';
        $query = mysqli_query($conection,$sql);
        $nums = mysqli_fetch_array($query)[0];
?>
<li>
    <div class="with-margin">
        <span class="message">Produk Mekaar: <?=$nums?> Data Baru.</span>
        <!-- <span class="time">few seconds ago</span> -->
    </div>
</li>
<?php }?>
<!-- style-attr is here only for fading in this notification after a specific time. Remove this. -->
<!-- <li style="display: none;"> 
    <div class="col-left">
        <span class="label label-danger"><i class="icon-warning-sign"></i></span>
    </div>
    <div class="col-right with-margin">
        <span class="message">Terjadi Gempa di Kepulauan Halmahera.</span>
        <span class="time">few seconds ago</span>
    </div>
</li> -->
<!-- style-attr is here only for fading in this notification after a specific time. Remove this. -->
<!-- <li style="display: none;"> 
    <div class="col-left">
        <span class="label label-info"><i class="icon-envelope"></i></span>
    </div>
    <div class="col-right with-margin">
        <span class="message"><strong>Jane</strong> sent you a message</span>
        <span class="time">few second ago</span>
    </div>
</li>
<li style="display: none;">
    <div class="col-left">
        <span class="label label-success"><i class="icon-plus"></i></span>
    </div>
    <div class="col-right with-margin">
        <span class="message"><strong>Emma</strong>'s account was created</span>
        <span class="time">4 hours ago</span>
    </div>
</li> -->