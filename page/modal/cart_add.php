<?php
include_once('../../common.php');

$menu_name = $_REQUEST["menu"];
$price = $_REQUEST["price"];
$id = $_REQUEST["id"];

$sql = sql_fetch("select `menu_name` , `option`, `option_price`, `wr_id` from `store_menu` where `id` = '{$id}'");


$menu = explode(":",$sql["menu_name"]);
$op = explode(":",$sql["option"]);
$op_price = explode(":",$sql["option_price"]);
for($i=0;$i<count($menu);$i++){
    $menus = explode(",",$menu[$i]);
    $ops = explode(",",$op[$i]);
    $op_prices = explode(",",$op_price[$i]);
    for($j=0;$j<count($menus);$j++) {
        if ($menus[$j] == trim($menu_name)) {
            $option = $ops[$j];
            $option_price = $op_prices[$j];
        }
    }
}
?>

<div class="reserve_view">
    <div id="reserve_result">
        <input type="hidden" name="wr_id" value="<?=$sql["wr_id"]?>">
        <input type="hidden" name="menu_price" class="menu_price" value="<?=$price?>">
        <input type="hidden" name="menu_name" class="menu_name" value="<?=$menu_name?>">
        <div class="con">
            <h2>장바구니 추가</h2>
            <div class="cart_add">
                <a href="javascript:modal_close();"><img src="<?=G5_IMG_URL?>/modal_close_btn.png" alt=""></a>
                <dl>
                    <dt>상품명 :</dt><dd><span id="menu_name"><?=$menu_name?></span></dd>
                    <dt>가격(개당) :</dt><dd><span id="price"><?=$price?> 원</span></dd>
                    <dt>개수 :</dt><dd class="num_dd"><input type="button" value="-" id="minus"><input id="num" name="num" value="1" readonly><input type="button"value="+" id="plus"></dd>
                <?php if($option){
                $options = explode("|" , $option);
                $option_prices = explode("|" , $option_price);
                ?>
                    <dt>옵션 :</dt>
                    <dd class="option_dd">
                        <select name="option" id="option">
                            <?php
                            for($i=0;$i<count($options);$i++){
                                ?>
                                <option value="<?=$options[$i]?>/<?=$option_prices[$i]?>"><?=$options[$i]?>(<?=$option_prices[$i]?> 원)</option>
                                <?php
                            }
                            ?>
                        </select>
                    </dd>
                    <dt>총합계 :</dt><dd><span class="total_price" id="total_price"><?php echo $price+$option_prices[0];?> 원</span></dd>
                    <input type="hidden" name="menu_total_price" class="menu_total_price" value="<?php echo $price+$option_prices[0]; ?>">
                <?php }else{?>
                    <dt>총합계 :</dt><dd><span class="total_price" id="total"><?=$price?> 원</span></dd>
                <?php }?>
                </dl>
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
            data:{"wr_id":"<?=$sql["wr_id"]?>", "mb_id":"<?=$member['mb_id']?>","menu_name":$(".menu_name").val(),"menu_price":$(".menu_price").val(),"menu_option":$("#option").val(),"num":$("#num").val(),"type":"add"}
        }).done(function(data){
            $(".cart_count").html(data);
            modal_close();
        })
    }
</script>