<?php
include_once('../../common.php');
$wr_id=$_POST['id'];
$view=sql_fetch("select a.*,b.* from `g5_write_main` as a left join `store_detail` as b on a.wr_id = b.wr_id where a.wr_id='{$wr_id}' ");
$file = get_file("main", $wr_id);
?>
<style>


</style>

<div class="share_view reserve_view">
    <div id="reserve_result">
    <div class="con">
        <h2>공유하기</h2>
        <div class="cart_add">
            <a href="javascript:modal_close();"><img src="<?=G5_IMG_URL?>/modal_close_btn.png" alt=""></a>
        </div>
    </div>
    </div>
    <ul>
        <li><a id="kakao_link_btn" href="javascript:sendLink();"></a></li>
        <li><a id="band_link_btn" href='http://band.us/plugin/share?body=<?php echo $view['wr_subject']; ?>&route=<?php echo G5_URL."/page/rent/view.php?wr_id=".$wr_id."&wr_subject=".$view['wr_subject']; ?>' target="_blank"></a></li>
        <li><a id="fb_link_btn" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(G5_URL."/page/rent/view.php?wr_id=".$wr_id."&wr_subject=".$view['wr_subject']); ?>&title=<?php echo $view['wr_subject']; ?>&description=<?php echo $view['wr_content']; ?>&img=<?php echo G5_DATA_URL."/file/main/".$file[0]['file']; ?>"  target = "_blank" ></a></li>
    </ul>
    <div class="clear"></div>
</div>

