<?php
include_once ("../../common.php");
include_once (G5_LIB_PATH."/thumbnail.lib.php");
$wr_id = $member;
$wr_subject = "상점관리";
$back_url=G5_URL."/page/shop/index.php";
include_once ("../../head.php");
//내상점 불러오기
$store_r= sql_query("select * from `g5_write_main` where mb_id = '{$member["mb_id"]}' and wr_email='{$member["mb_email"]}' ");
while($row = sql_fetch_array($store_r)){
    $list[] = $row;
}
//등롣대기 상점
$count = sql_query("select * from `store_temp` where mb_id = '{$member["mb_id"]}' and status = 0 ");
while($row = sql_fetch_array($count)){
    $temp[] = $row;
}

?>
<style>
    .section01_content.no_list{text-align: center;margin:0 auto;padding:20px 0;}
</style>
<div class="width-fixed border-top">
    <?php
    for($i=0;$i<count($list);$i++){
        $thumb = get_list_thumbnail("main", $list[$i]['wr_id'],"800","530");
        if($thumb['src']) {
            $img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'">';
        }
    ?>
    <section class="section01" id="store_view">
        <div class="section01_header store_title">
            <div><h2><?php echo $list[$i]["wr_subject"];?></h2></div>
            <div class="store_edit">
                <a href="<?php echo G5_URL;?>/page/shop/my_store_detail_form.php?w=cu&wr_id=<?=$list[$i]["wr_id"]?>"><i></i></a>
            </div>
            <div class="store_del">
                <a href="<?php echo G5_URL;?>/page/shop/my_store_del.php"><i></i></a>
            </div>
        </div>
        <div class="section01_content">
            <div style="text-align: center;background:#ddd;text-align: center;display: block">
                <a href="<?php echo G5_URL;?>/page/shop/my_store_view.php?wr_id=<?php echo $list[$i]["wr_id"];?>&type=shop">
                    <?php if($img_content) {echo $img_content;}else{?>
                    <img src="<?php echo G5_IMG_URL?>/logo_sample.png" alt="no-image" style="text-align: center">
                    <?php }?>
                </a>
            </div>
        </div>
        <div class="list_btn_group">
            <input type="button" value="메뉴수정" class="btn bg_darkred grid_50 list_menu_edit_btn" onclick="location.href='<?php echo G5_URL."/page/shop/my_store_menu_edit.php?wr_id=".$list[$i]["wr_id"]?>'">
            <input type="button" value="<?php if($list[$i]["wr_5"]=="N"){?>상점오픈<?php }else{?>상점닫기<?php }?>" class="btn <?php if($list[$i]["wr_5"]=="N"){?>bg_gray<?php }else{?>bg_green<?php }?> grid_50 list_menu_edit_btn" onclick="location.href='<?php echo G5_URL."/page/shop/store_open_update.php?wr_id=".$list[$i]["wr_id"]."&state=".$list[$i]["wr_5"];?>'">
        </div>
    </section>
    <?php } if(count($list)==0 && count($temp)!=0){?>
    <section class="section01" id="store_view">
        <div class="section01_content no_list">
        <img src="<?php echo G5_IMG_URL?>/logo_sample.png" alt="심사대기">
        <p>상점 심사 중입니다.<br>빠른 심사 등록은 고객만족센터에 문의바랍니다.</p>
        </div>
    </section>
    <?php } else if (count($list)==0 && count($temp)==0){?>
    <section class="section01" id="store_view">
        <div class="section01_content no_list">
            <img src="<?php echo G5_IMG_URL?>/logo_sample.png" alt="심사대기">
            <p>등록된 상점이 없습니다.<br>상점을 등록해주세요.</p>
        </div>
    </section>
    <?php }?>
</div>
<div class="store_btn_group">
    <input type="button" class="store_add_btn" value="" onclick="location.href='<?php echo G5_URL;?>/page/shop/my_store_add.php?'"/>
</div>
<?php
include_once ("../../tail.php");
?>
