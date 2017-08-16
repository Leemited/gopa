<?php
include_once ("../../common.php");

$align_type = $_REQUEST["align_type"];
$wr_id = $_REQUEST["wr_id"];
$date = date("Y-m-d");
$order = sql_query("select o.*, m.* from `order_form` as o left join `g5_write_main` as m on o.wr_id = m.wr_id where o.wr_id = '{$wr_id}' and o.delivery_state = '{$align_type}' and o.delivery_state != 3 and o.order_date like '%{$date}%' order by order_date desc ");
while($row = sql_fetch_array($order)){
    $list[] = $row;
}
?>
<li class="order_list_item">
    <div class="order_tip">
        <label for="o1"><i class="o1"></i>주문요청</label>
    </div>
    <div class="order_tip">
        <label for="o2"><i class="o2"></i>배달중</label>
    </div>
    <div class="order_tip">
        <label for="o3"><i class="o3"></i>배달완료</label>
    </div>
    <div class="clear"></div>
</li>
<?php for($i=0;$i<count($list);$i++){
$date = explode(" ", $list[$i]["order_date"]);
$menu = explode(",", $list[$i]["order_menu"]);
$menu_count = explode(",", $list[$i]["order_count"]);
$option = explode(",", $list[$i]["order_option"]);
$option_price = explode(",", $list[$i]["order_option_price"]);
$nowTime = date("Y-m-d H:i:s");
//주문 지연시간
$delayTime = strtotime($nowTime) - strtotime($list[$i]["order_date"]) ;
$delayDay = date("d일",$delayTime);
$delay = date("H시 i분",$delayTime);
$price = explode(",",$list[$i]["order_price"]);
for($p=0;$p<count($price);$p++){
    $total += $price[$p];
}
?>
    <li class="order_list_item" >
        <form action="<?php echo G5_URL?>/page/shop/order_state_update.php" method="post">
            <input type="hidden" value="<?php echo $list[$i]['order_id'];?>" name="order_id">
            <input type="hidden" value="<?php echo $wr_id ;?>" name="wr_id">
            <input type="hidden" value="<?php echo $list[$i]['delivery_state'];?>" name="delivery_state">
            <input type="hidden" value="<?=date("YmdHis",strtotime($list[$i]["order_date"]))?>" id="delay<?php echo $i;?>">
            <div class="order_date"><?php echo $date[0];?></div>
            <div class="order_number"><?php echo $list[$i]["order_number"];?></div>
            <div class="order_time"><?php echo $date[1];?></div>
            <div class="delay_time" >지연 시간 <?php echo $delayDay?> <span class="delay_real_time<?php echo $i;?>"><?php echo $delay;?></span></div>
            <?php for($j=0;$j<count($menu);$j++){?>
                <div class="order_menu <?php if($j==0){?>first<?php }?>" >
                    <div class="menu_title"><?php echo $menu[$j];?><?php if($option[$j]!=""){ echo "(".$option[$j].")"; }?></div>
                    <div class="menu_count"><?php echo $menu_count[$j];?> 개</div>
                </div>
            <?php }?>
            <div class="order_total">총 금액 : <?php echo number_format($total);?> 원</div>
            <div class="order_state <?php if($list[$i]["delivery_state"]==0){?>order_1<?php }else if($list[$i]["delivery_state"]==1){?>order_2<?php }else if($list[$i]["delivery_state"]==2){?>order_3<?php }?>"></div>
            <div class="order_btn">
                <?php if($list[$i]["delivery_state"]<4){?>
                    <input type="submit" class="btn order_state_btn <?php if($list[$i]["delivery_state"]==0){?>order_1<?php }else if($list[$i]["delivery_state"]==1){?>order_2<?php }else if($list[$i]["delivery_state"]==2){?>order_3<?php }?>" value="<?php if($list[$i]["delivery_state"]==0){?>배달출발<?php }else if($list[$i]["delivery_state"]==1){?>배달완료<?php }else if($list[$i]["delivery_state"]==2){?>정산<?php }?>" onclick="">
                <?php }else{ ?>
                    정산완료
                <?php }?>
            </div>
        </form>
    </li>
<?php }
if(count($list)==0){?>
    <li class="no-order">오늘은 주문이 없습니다.</li>
<?php }?>