<?php
include_once('../../common.php');

$menu_name = $_REQUEST["menu"];
$price = $_REQUEST["price"];
$id = $_REQUEST["id"];

$menu = sql_fetch("select * from `store_menu` where `id` = '{$id}'");

?>
<style>
    .con table{width:100%;}
    .con table tr th{width:30%;text-align: left;font-size:16px;}
    .con table tr td{width:70%;height:44px;text-align: right;font-size:16px;}
    @media all and (max-width: 480px){
        .con table tr th , .con table tr td{font-size:14px;}
    }
</style>
<div class="reserve_view">
    <div id="reserve_result">
        <input type="hidden" name="wr_id" value="<?=$menu["wr_id"]?>">
        <input type="hidden" name="menu_price" class="menu_price" value="<?=$price?>">
        <input type="hidden" name="menu_name" class="menu_name" value="<?=$menu_name?>">
        <div class="con">
            <h2>장바구니 추가</h2>
            <div class="cart_add">
                <a href="javascript:modal_close();"><img src="<?=G5_IMG_URL?>/modal_close_btn.png" alt=""></a>
                <table>
                    <tr>
                        <th class="cart_title">상품명 :</th>
                        <td><span id="menu_name"><?=$menu["menu_name"]?></span></td>
                    </tr>
                    <tr>
                        <th class="cart_title">가격(개당) :</th>
                        <td><span id="price"><?=$menu["menu_price"]?> 원</span></td>
                    </tr>
                    <tr>
                        <th class="cart_title">개수 :</th>
                        <td class="num_dd"><input type="button" value="-" id="minus"><input id="num" name="num" value="1" readonly><input type="button"value="+" id="plus"></td>
                    </tr>
            <?php
            if($menu["option"]){
            $options = explode("|" , $menu["option"]);
            $option_prices = explode("|" , $menu["option_price"]);
            ?>
                <tr>
                    <th>옵션 :</th>
                    <td class="option_dd">
                        <select name="option" id="option">
                            <?php
                            for($i=0;$i<count($options);$i++){
                                ?>
                                <option value="<?=$options[$i]?>/<?=$option_prices[$i]?>"><?=$options[$i]?>(<?=$option_prices[$i]?> 원)</option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th class="cart_title">총합계 :</th>
                    <td><span class="total_price" id="total_price"><?php echo $price+$option_prices[0];?> 원</span></td>
                    <input type="hidden" name="menu_total_price" class="menu_total_price" value="<?php echo $price+$option_prices[0]; ?>">
                </tr>
            <?php }else{?>
                <tr>
                    <th class="cart_title">총합계 :</th>
                    <td><span class="total_price" id="total"><?=$price?> 원</span></td>
                </tr>
            <?php }?>
                </table>
            <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="btn_group">
        <a href="javascript:fn_submit();" class="btn">추가</a>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        $("#plus").click(function(){
            var num = Number($("#num").val())+1;
            $("#num").val(num);
            if($(".menu_total_price").val()){
                var price = (Number($(".menu_total_price").val()) ) * num;
                $(".total_price").html(number_format(String(price)) + "원");
            }else{
                var price = Number($(".menu_price").val()) * num;
                $(".total_price").html(number_format(String(price)) + "원");
            }
        })
        $("#minus").click(function(){
            var num = Number($("#num").val());
            if(num > 1) {
                num=num-1;
                $("#num").val(num);
            }
            if($(".menu_total_price").val()){
                var price = Number($(".menu_total_price").val()) * num;
                $(".total_price").html(number_format(String(price)) + "원");
            }else{
                var price = Number($(".menu_pri" +
                        "ce").val()) * num;
                $(".total_price").html(number_format(String(price)) + "원");
            }
        })
        $("#option").change(function(){
            var option_price = $(this).val().split("/");
            var num = Number($("#num").val());
            var price = Number($(".menu_price").val());
            $(".menu_total_price").val(Number(option_price[1])+price);
            var total_price = (price + Number(option_price[1])) * num;
            $(".total_price").html(number_format(String(total_price)) + "원");
        })
    })
    function fn_submit(){
        $.ajax({
            url:"<?=G5_URL?>/page/mypage/cart_update.php",
            method:"POST",
            data:{"wr_id":"<?=$menu["wr_id"]?>", "mb_id":"<?=$member['mb_id']?>","menu_name":$(".menu_name").val(),"menu_price":$(".menu_price").val(),"menu_option":$("#option").val(),"num":$("#num").val(),"type":"add"}
        }).done(function(data){
            if(data){
                alert("추가 되었습니다.");
            }
            $(".cart_count").html(data);
            modal_close();
        })
    }
</script>