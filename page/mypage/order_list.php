<?php
include_once("../../common.php");
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
$mb_no = $_REQUEST["mb_no"];
$list_result = sql_query("select * from `order_form` as a left join `g5_write_main` as b on a.wr_id in (b.wr_id) where a.mb_no = ".$mb_no);
while($row=sql_fetch_array($list_result)){
    $list[]=$row;
}
$rand = mt_rand(0,4);
$favo_title = ["오늘은 쇼핑하기 좋은 날~ \r\n지금 바로 주문하러 가요!","오늘은 왠지 배달이 땡기는 날이야!","같은 메뉴 지겨워! 새로운 음식점 없을까?", "이제 색다를 메뉴가 필요해~" , "우리동네 인기 짱 맛집은?"];
if(count($list) > 0){
?>
<ul>
    <?php
    for($i=0;$i<count($list);$i++){
        switch($list[$i]["order_state"]){
            case "1":
                $order_state = "배달준비";
                break;
            case "2":
                $order_state = "배달중";
                break;
            case "3":
                $order_state = "배달완료";
                break;
            case "4":
                $order_state = "주문취소";
                break;
        }

       $thumb = get_list_thumbnail("main", $list[$i]['wr_id'], 1100, 464);
        if($thumb['src']) {
            $img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'">';
        }

        $link="javascript:location.href='".G5_URL."/page/mypage/order_view.php?order_id=".$list[$i]['order_id']."'";

        ?>
        <li class="order_li" data-cate="<?php echo $list[$i]['type']; ?>">
            <div onclick="<?php echo $link; ?>">
                <div class="img">
                    <div><?php echo $img_content; ?></div>
                </div>
                <div class="txt">
                    <h3><?php echo $list[$i]['wr_subject']; ?> <span class="state"><?php echo $order_state;?></span></h3>
                    <p>주문시간 : <?php echo $list[$i]["order_date"];?></p>
                    <p>주문번호 : <?php echo $list[$i]["order_number"];?></p>
                </div>
            </div>
            <a href="javascript:fnDel(<?php echo $list[$i]['id'];?>);" class="btn"></a>
        </li>
    <?php } ?>
</ul>
<?php }else if(count($list)==0){?>
    <div class="mypage_no_list">
        <p><?php echo $favo_title[$rand]?></p>
        <div class="mypage_btn_group">
            <input type="button" class="btn grid_30 btn_pink" value="주문 하러가기" onclick="moveLink('main','')">
        </div>
    </div>
<?php }?>
<script type="text/javascript">
    function fnDel(id){
        $.ajax({
            url: "<?=G5_URL?>/page/mypage/ajax.favorite_update.php",
            method:"POST",
            data:{"id":id}
        }).done(function(data){
            switch (data){
                case "2":
                    alert("삭제되었습니다.");
                    document.location.reload();
                    break;
                case "3":
                    alert("삭제오류입니다. \r\n관리자에게 문의하시기 바랍니다.");
                    break;
            }
        })
    }
</script>