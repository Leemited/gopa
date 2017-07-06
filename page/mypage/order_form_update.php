<?php
include_once ("../../common.php");

if($is_member){
    $mb_no = $member["mb_no"];
}

$order_number = generateRandomString(6).date("Hms");
//결제모듈 완료후 저장
$wr_id = substr($_REQUEST["wr_id"],0,strlen($_REQUEST["wr_id"])-1);
$cart_id = $_REQUEST["cart_id"];
$order_type = $_REQUEST["order_type"];
$order_type1 = $_REQUEST["order_type1"];
$order_type2 = $_REQUEST["order_type2"];
$order_name = $_REQUEST["order_name"];
$order_phone = $_REQUEST["order_phone"];
$order_pass = $_REQUEST["order_pass"];
$delivery_name = $_REQUEST["delivery_name"];
$delivery_addr_code = $_REQUEST["delivery_addr_code"];
$delivery_addr_1 = $_REQUEST["delivery_addr_1"];
$delivery_addr_2 = $_REQUEST["delivery_addr_2"];
$delivery_phone = $_REQUEST["delivery_phone"];
if($delivery_name==""){
    $delivery_name=$_REQUEST["order_name"];
}
if($delivery_addr_code==""){
    $delivery_addr_code=$_REQUEST["mb_zip1"];
}
if($delivery_phone==""){
    $delivery_phone = $_REQUEST["order_phone"];
}
if($delivery_addr_1==""){
    $delivery_addr_1 = $_REQUEST["mb_addr1"];
}
if($delivery_addr_2==""){
    $delivery_addr_2 = $_REQUEST["mb_addr2"];
}
$delivery_message = $_REQUEST["delivery_msg"];
$bank_account_name = $_REQUEST["bank_account_name"];
$bank_name = $_REQUEST["bank_name"];
$mb_point=$_REQUEST["mb_point"];

$menu_name = substr($_REQUEST["menu_name"],0,strlen($_REQUEST["menu_name"])-1);
$menu_price = substr($_REQUEST["menu_price"],0,strlen($_REQUEST["menu_price"])-1);
$menu_count = substr($_REQUEST["menu_count"],0,strlen($_REQUEST["menu_count"])-1);
$menu_option = substr($_REQUEST["menu_option"],0,strlen($_REQUEST["menu_option"])-1);
$menu_option_price = substr($_REQUEST["menu_option_price"],0,strlen($_REQUEST["menu_option_price"])-1);

$menu_names = explode("," , $menu_name);
$menu_prices = explode("," , $menu_price);
$menu_counts = explode("," , $menu_count);
$menu_options = explode("," , $menu_option);
$menu_option_prices = explode("," , $menu_option_price);

$total_price = 0;
for($i= 0; $i< count($menu_names);$i++) {
    if (!$menu_options[$i]) {
        $total_price += $menu_prices[$i] * $menu_counts[$i];
    } else {
        $total_price += ($menu_prices[$i] + $menu_option_prices[$i]) * $menu_counts[$i];
    }
}

if($mb_point != 0){
    $total_price = $total_price - $mb_point;
}

$sql = "insert into `order_form` set 
                  cart_id = '{$cart_id}', 
                  wr_id = '{$wr_id}', 
                  mb_no = '{$mb_no}',
                  order_number = '{$order_number}',
                  order_date = now(), 
                  order_menu = '{$menu_name}', 
                  order_count= '{$menu_count}', 
                  order_price = '{$menu_price}', 
                  order_option = '{$menu_option}', 
                  order_option_price = '{$menu_option_price}', 
                  order_user_name = '{$order_name}', 
                  order_user_phone = '{$order_phone}', 
                  order_recive_name = '{$delivery_name}', 
                  order_recive_phone = '{$delivery_phone}', 
                  order_recive_zipcode = '{$delivery_addr_code}', 
                  order_recive_addr1 = '{$delivery_addr_1}', 
                  order_recive_addr2 = '{$delivery_addr_2}', 
                  order_recive_message = '{$delivery_message}', 
                  order_type1 = '{$order_type}', 
                  order_type2 = '{$order_type1}', 
                  order_type3 = '{$order_type2}', 
                  bank_account_name = '{$bank_account_name}', 
                  bank_name = '{$bank_name}', 
                  order_state = 1, 
                  order_total_price = '{$total_price}', 
                  order_pass = PASSWORD('{$order_pass}')
                  ";

if(sql_query($sql)){
    $sql = "update `cart` set cart_state = 1  where cart_id in ({$cart_id})";
    sql_query($sql);
    goto_url(G5_URL."/page/mypage/order_complete.php");
    //주문정보 문자전송?
    //주문정보 푸쉬보내기 (상점)

}else{
    goto_url(G5_URL."/page/mypage/order_form.php");
}