<?php
include_once ("../../common.php");

$state = $_REQUEST["delivery_state"];
$state = $_REQUEST["delivery_state"];
$order_id = $_REQUEST["order_id"];


$shop= sql_fetch("select * from `order_form` where order_id='{$order_id}'");
$mem = sql_fetch("select * from `g5_member` where mb_no = '{$shop['mb_no']}'");
//배달처리
if($state == 0){
    $sql = "update `order_form` set delivery_state = 1 where order_id = '{$order_id}'";
    $push_msg = "주문하신 상품이 배달 출발하였습니다.";
    send_GCM($mem["regid"],"고파 안내",$push_msg);
}else if($state == 1){//완료
    $sql = "update `order_form` set delivery_state = 2 where order_id = '{$order_id}'";
}else if($state == 2){//정산처리
    $sql = "update `order_form` set delivery_state = 3 where order_id = '{$order_id}'";

}

sql_query($sql);

alert("처리되었습니다." , G5_URL."/page/shop/store_order_list.php?wr_id=".$wr_id);