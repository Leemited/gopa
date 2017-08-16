<?php
include_once ("../../common.php");

$wr_id = $_REQUEST["wr_id"];

$wr_subject = "프리미엄 메뉴";
$back_url=G5_URL."/page/shop/";
include_once ("../../head.php");
?>
<style>
    .premium_list{border-top:1px solid #ccc}
    .premium_list ul{width:100%}
    .premium_list li{padding:40px 10px;font-size:20px;border-bottom:1px solid #888;background:linear-gradient(white,lightgray);margin-bottom:3px;background: -webkit-linear-gradient(white,lightgray); /* For Safari 5.1 to 6.0 */
        background: -o-linear-gradient(white,lightgray); /* For Opera 11.1 to 12.0 */
        background: -moz-linear-gradient(white,lightgray); /* For Firefox 3.6 to 15 */
        cursor: pointer;}
    .premium_info {margin:10px;border:1px solid #ccc; border-radius: 5px;padding:10px;}
    .premium_info h3{font-size:18px;color:#cf1616;padding:10px 0 20px 0;border-bottom:1px dashed #aaa}
    .premium_info ul{padding:20px 0;}
    .premium_info li{font-size:16px;}
</style>
<div class="width-fixed">
    <section class="section01">
        <div class="section01_content">
            <div class="premium_info">
                <h3>업체 노출빈도를 높이면 어떤점이 좋나요?</h3>
                <ul>
                    <li>1. 사용자의 업체 유입률이 증가합니다.</li>
                    <li>2. 바로연결 서비스로 주문량이 증가합니다.</li>
                    <li>3. 같은 업종의 다른 매장보다 이용자의 접근성이 좋습니다.</li>
                    <li>4. 저렴한 가격으로 광고효과를 낼 수 있습니다.</li>
                    <li>5. 주문량의 증가로 늘어난 리뷰와 별점으로 이 후 에도 업체 상위 노출이 유지됩니다.</li>
                </ul>
            </div>
            <div class="premium_list">
                <ul>
                    <li onclick="location.href=g5_url+'/page/shop/store_slide_list_regi.php?wr_id=<?php echo $wr_id?>'">업체 리스트 슬라이드 광고 신청</li>
                    <li onclick="location.href=g5_url+'/page/shop/store_top_list_regi.php?wr_id=<?php echo $wr_id?>'">업체 리스트 첫 페이지 노출 신청</li>
                </ul>
            </div>
        </div>
    </section>
</div>
<?php
include_once ("../../tail.php");
?>
