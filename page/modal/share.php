<?php
include_once('../../common.php');
$wr_id=$_POST['id'];
$view=sql_fetch("select a.*,b.* from `g5_write_main` as a left join `store_detail` as b on a.wr_id = b.wr_id where a.wr_id='{$wr_id}' ");
$file = get_file("main", $wr_id);
?>
<style>
    .share_view ul {width:100%;}
    .share_view ul li {float:left;width:33.33%;cursor: pointer;text-align:center;}
</style>

<div class="share_view">
    <ul>
        <li><a id="kakao-link-btn" href="javascript:sendLink();">카카오톡</a></li>
        <li><a  href='http://band.us/plugin/share?body=<?php echo $view['wr_subject']; ?>&route=<?php echo G5_URL."/page/rent/view.php?wr_id=".$wr_id."&wr_subject=".$view['wr_subject']; ?>' target="_blank">밴드</a></li>
        <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(G5_URL."/page/rent/view.php?wr_id=".$wr_id."&wr_subject=".$view['wr_subject']); ?>&title=<?php echo $view['wr_subject']; ?>&description=<?php echo $view['wr_content']; ?>&img=<?php echo G5_DATA_URL."/file/main/".$file[0]['file']; ?>"  target = "_blank" >패이스북</a></li>
    </ul>
    <div class="clear"></div>
    <div class="btn_group">
        <a href="javascript:modal_close();" class="btn ">확인</a>
    </div>
</div>

