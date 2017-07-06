<?php
include_once("../../common.php");
$back_url=G5_URL."/page/rent/view.php?wr_id=".$wr_id."&wr_subject=".$wr_subject;
include_once(G5_PATH."/head.php");
$view=sql_fetch("select a.*,b.* from `g5_write_main` as a left join `store_detail` as b on a.wr_id = b.wr_id where a.wr_id='{$wr_id}' ");

?>
    <style>
        img.info{
            position: absolute;
            width:30px;
            left:10px;
            top:6px;
        }
        #view_section_info h2.detail_title{padding-left:50px;}
    </style>
    <div class="width-fixed view">
        <section class="section01" id="view_section_info">
            <div class="section01_header">
                <div ><img class="info" src="<?=G5_IMG_URL?>/store_detail_info_icon.png"><h2 class="detail_title">매장정보</h2></div>
            </div>
            <div class="section01_content">
                <dl>
                    <dt>전화번호</dt>
                    <dd><?=$view["wr_9"]?></dd>
                    <dt>주소</dt>
                    <dd><?=$view["wr_10"]?></dd>
                    <dt>운영시간</dt>
                    <dd><?=$view["wr_5"]?></dd>
                    <dt>휴무</dt>
                    <dd><?=$view["wr_9"]?></dd>
                    <dt>소개</dt>
                    <dd><?=$view["wr_content"]?></dd>
                </dl>
            </div>
        </section>
        <section class="section01" id="view_section_info">
            <div class="section01_header">
                <div><img class="info" src="<?=G5_IMG_URL?>/store_detail_delivery_icon.png"><h2 class="detail_title">배달정보</h2></div>
            </div>
            <div class="section01_content">
                <dl>
                    <dt>배달여부</dt>
                    <dd><?php echo $view["delivery"]==1?"가능":"불가능";?></dd>
                    <dt>배달가능지역</dt>
                    <dd><?php echo $view["delivery_location"];?></dd>
                    <dt>배달가능금액</dt>
                    <dd><?php echo $view["delivery_price"];?></dd>
                </dl>
            </div>
        </section>
        <section class="section01" id="view_section_info">
            <div class="section01_header">
                <div><img class="info" src="<?=G5_IMG_URL?>/store_detail_order_icon.png"><h2 class="detail_title">결제정보</h2></div>
            </div>
            <div class="section01_content">
                <dl>
                    <dt>결제수단</dt>
                    <dd><?php echo $view["order_type"]?></dd>
                    <dt>포인트</dt>
                    <dd><?php echo $view["point"]?></dd>
                </dl>
            </div>
        </section>
        <section class="section01" id="view_section_info">
            <div class="section01_header">
                <div><img class="info" src="<?=G5_IMG_URL?>/store_detail_etc_icon.png"><h2 class="detail_title">부가정보</h2></div>
            </div>
            <div class="section01_content">
                <dl>
                    <?php
                    $etc = explode("||",$view["other"]);
                    for($i=0;$i<count($etc);$i++){
                        $other = explode("|",$etc[$i]);
                    ?>
                    <dt><?php echo $other[0];?></dt>
                    <dd><?php echo $other[1]?></dd>
                    <?php } ?>
                </dl>
            </div>
        </section>
        <section class="section01" id="view_section_info" style="padding-bottom: 0px;margin-bottom:0px;">
            <div class="section01_header">
                <div><img class="info" src="<?=G5_IMG_URL?>/store_detail_oring_icon.png"><h2 class="detail_title">제품 표기</h2></div>
            </div>
            <div class="section01_content" >
                <dl>
                    <dt>원산지정보</dt>
                    <dd><?php echo nl2br($view["oring_mark"]); ?></dd>
                </dl>
                <div style="padding:10px 0; border-top:1px solid #ddd;width:90%;margin:0 5%;">
                    <div style="padding:5px 0px;">알레르기 유발정보 <a href="#">자세히보기</a></div>
                    <div style="padding:5px 0px;">영양성분정보 <a href="#">자세히보기</a></div>
                </div>
            </div>
        </section>

    </div>
<?php
include_once(G5_PATH."/tail.php");
?>