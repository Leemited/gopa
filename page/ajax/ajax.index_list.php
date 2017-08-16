<?php
include_once("../../common.php");
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

$loc = $_REQUEST["loc"];
$ca_name = $_REQUEST["ca_name"];
$order_type = $_REQUEST["order_type"];
$order = $_REQUEST["order"];
$searchTxt = $_REQUEST["searchTxt"];
$page = $_REQUEST["page"];

$where = " WHERE a.wr_is_comment=0 and wr_file != 0";
if($loc){
    $where .= " and a.wr_10 like '%{$loc}%' or b.delivery_location like '%{$loc}%' or jibun_address like '%{$loc}%'";
}
if($ca_name){
    $where .= " and a.ca_name = '{$ca_name}'";
}
if($order_type){
    $where .= " and b.order_type like '%{$order_type}%'";
}
if($searchTxt){
    $where .= " and (a.wr_subject like '%{$searchTxt}%' or a.wr_content like '%{$searchTxt}%')";
}

if($order){
    switch ($order){
        case "1":
            $order = " order by a.wr_datetime";
            break;
        case "2":
            $order = " order by a.wr_hit";
            break;
        case "3":
            //$order = " order by b.location";
            break;
    }
}


$query=sql_query("select a.*, b.* from g5_write_main as a left join store_detail as b on a.wr_id = b.wr_id {$where} {$order} {$limit}");
while($data=sql_fetch_array($query)){
    $list[]=$data;
}

for($i=0;$i<count($list);$i++){
    //$id=$list[$i]['model'];
    $thumb = get_list_thumbnail("main", $list[$i]['wr_id'], 800, 530);
    if($thumb['src']) {
        $img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'">';
    }
    $even = $list[$i]['wr_comment'];
    if($even==0){
        $rank_total = $list[$i]["wr_4"];
    }else {
        $rank_total = ceil($list[$i]["wr_4"] / $list[$i]['wr_comment']);
    }
    switch ($rank_total){
        case "5":
            $rank = "★★★★★";
            break;
        case "4":
            $rank = "★★★★☆";
            break;
        case "3":
            $rank = "★★★☆☆";
            break;
        case "2":
            $rank = "★★☆☆☆";
            break;
        case "1":
            $rank = "★☆☆☆☆";
            break;
        case "0":
            $rank = "☆☆☆☆☆";
            break;
    }

    $order = sql_fetch("select COUNT(*) as cnt from `order_form` where order_state > 0 and order_state < 4 and wr_id='{$list[$i]['wr_id']}'");
    $link="javascript:location.href='".G5_URL."/page/rent/view.php?wr_id=".$list[$i]['wr_id']."&type=".$type."&wr_subject=".$list[$i]['wr_subject']."'";

?>
    <li data-cate="<?php echo $list[$i]['type']; ?>">
        <div <?php if($list[$i]["wr_5"]=="Y"){?>onclick="<?php echo $link; ?>"<?php }else{?>onclick="alert('영업준비중입니다.');"<?php }?> >
            <?php if($list[$i]['wr_5']=="N"){ ?>
                <div class="no_open"><div></div></div>
            <?php }?>
            <div class="img">
                <div><?php echo $img_content; ?></div>
            </div>
            <div class="txt">
                <h3><?php echo $list[$i]['wr_subject']; ?></h3>
                <h4><?php echo ($list[$i]['store_addr1'] && $list[$i]["store_add2"])?$list[$i]['store_addr1']." ".$list[$i]["store_add2"]:"주소정보 없음"; ?></h4>
                <p>영업시간  <?php echo ($list[$i]["open_time"] && $list[$i]["close_time"])?$list[$i]["open_time"]."~".$list[$i]["close_time"]:"영업시간 정보 없음"; ?></p>
                <p>주문수  <?php echo $order["cnt"]; ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo ($list[$i]['delivery_price']!=0)?number_format($list[$i]['delivery_price'])."원 이상배달":"최소배달가격 정보없음"; ?></p>
                <p><span class="bg_yellow bold"><?=$rank?></span> | 거리</p>
            </div>
        </div>
        <!--<a href="javascript:" class="btn bg_gray">주문하기</a><br>-->
        <a href="tel:<?php echo $list[$i]['store_hp'];?>" class="btn"></a>
    </li>
<?php } ?>