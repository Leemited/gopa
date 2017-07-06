<?php
include_once("../../common.php");
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

$loc = $_REQUEST["loc"];
$ca_name = $_REQUEST["ca_name"];
$order_type = $_REQUEST["order_type"];
$order = $_REQUEST["order"];
$searchTxt = $_REQUEST["searchTxt"];

$where = " WHERE a.wr_is_comment=0 ";
if($loc){
    $where .= " and a.wr_10 like '%{$loc}%' or b.delivery_location like '%{$loc}%'";
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

$query=sql_query("select a.*, b.* from g5_write_main as a left join store_detail as b on a.wr_id = b.wr_id {$where} {$order} ");
while($data=sql_fetch_array($query)){
    $list[]=$data;
}

for($i=0;$i<count($list);$i++){
    //$id=$list[$i]['model'];
    $thumb = get_list_thumbnail("main", $list[$i]['wr_id'], 1100, 464);
    if($thumb['src']) {
        $img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'">';
    }

    $link="javascript:location.href='".G5_URL."/page/rent/view.php?wr_id=".$list[$i]['wr_id']."&type=".$type."&wr_subject=".$list[$i]['wr_subject']."'";

    $time = explode("|",$list[$i]['wr_5']);
    $point = explode("|",$list[$i]['wr_8']);
?>
    <li data-cate="<?php echo $list[$i]['type']; ?>">
        <div onclick="<?php echo $link; ?>">
            <div class="img">
                <div><?php echo $img_content; ?></div>
            </div>
            <div class="txt">
                <h3><?php echo $list[$i]['wr_subject']; ?></h3>
                <h4><?php echo $list[$i]['wr_10']; ?></h4>
                <p>영업시간  <?php echo $time[0]."~".$time[1]; ?></p>
                <p>주문수  <?php echo $list[$i]['wr_6']; ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo $list[$i]['delivery_price']; ?></p>
                <p>적립&nbsp;&nbsp;현금&nbsp;<?php echo $point[0]." | ".$point[1] ;?></p>
            </div>
        </div>
        <!--<a href="javascript:" class="btn bg_gray">주문하기</a><br>-->
        <a href="tel:<?php echo $list[$i]['wr_9'];?>" class="btn"></a>
    </li>
<?php } ?>