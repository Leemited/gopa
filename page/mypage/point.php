<?php
include_once ("../../common.php");
$wr_id=$member["mb_id"];
$wr_subject="내포인트";
$back_url= G5_URL;
include_once ("../../head.php");
$sql_common = " from {$g5['point_table']} ";

$stx =$member["mb_id"];
$sql_search = " where mb_id = '{$stx}'";
$sql_order = "order by po_id desc";
$sql = " select *
            {$sql_common}
            {$sql_search}
            {$sql_order}
            ";
$result = sql_query($sql);
$mb = array();
if ($stx)
    $mb = get_member($stx);

//$g5['title'] = '포인트관리';
//include_once ('./admin.head.php');

$po_expire_term = '';
if($config['cf_point_term'] > 0) {
    $po_expire_term = $config['cf_point_term'];
}

if (strstr($sfl, "mb_id"))
    $mb_id = $stx;
else
    $mb_id = "";

while($row=sql_fetch_array($result)){
    $list[] = $row;
}

?>
<style>
    .total_point,.point_list {width:90%;padding:5%;}
    .total_point div{border:1px solid #ddd; background:#eee;padding:10px 5%;border-radius: 5px;width:90%;font-size: 17px}
    .point_list table{width:100%;}
    .point_list table th{text-align:center;padding:5px 0; font-size: 16px;font-weight: bold;background: #cf1616;color:#fff;}
    .point_list table td{border:1px solid #ddd;text-align:center;padding:5px 0; font-size: 14px;}
    .point_tab{width:100%;border-top:1px solid #ddd}
    .point_tab li{float:left;width:50%;padding:10px 0;font-size:15px;background: #cf1616;color:#fff;border-bottom:2px solid #cf1616;text-align:center;cursor: pointer;}
    .point_tab li.active, .point_tab li:hover{font-weight:bold;background:#fff;color:#cf1616;}
</style>
<div class="width-fixed view">
    <!--<div class="sel-align">
        <div class="select-align">
            <input type="radio" name="align" id="new" value="2">
            <label for="new" ><span class="radio">포인트 충전</span></label>
        </div>
        <div class="select-align">
            <input type="radio" name="align" id="hit" value="1" checked>
            <label for="hit"><span class="radio">내포인트</span></label>
        </div>
    </div>-->
    <div>
        <ul class="point_tab">
            <li class="active">내포인트</li>
            <li onclick="location.href=g5_url+'/page/mypage/point_charge.php'">포인트충전</li>
        </ul>
    </div>
    <div class="clear"></div>
</div>
<section class="section01">
    <div class="section01_content">
        <div class="total_point">
            <div>총 포인트 : <?php echo number_format($mb['mb_point']);?> P</div>
        </div>
        <div class="point_list">
            <table>
                <tr>
                    <th>번호</th>
                    <th>날짜</th>
                    <th>항목</th>
                    <th>포인트</th>
                </tr>
            <?php for($i=0;$i<count($list);$i++){?>
                <tr>
                    <td><?php echo $i+1;?></td>
                    <td><?php echo $list[$i]["po_datetime"];?></td>
                    <td><?php echo $list[$i]["po_content"];?></td>
                    <td><?php echo number_format($list[$i]["po_point"])?></td>
                </tr>
            <?php }
            if(count($list)==0){?>
                <tr><td colspan="4">포인트 사용내역이 없습니다.</td></tr>
            <?php }?>
            </table>
        </div>
    </div>
</section>
<script>
    /*$(document).ready(function () {
        $("input[type=radio]").change(function(){
            var align_type = $(this).val();
            if(align_type == 1){
                $.ajax({
                    url:g5_url+"/page/ajax/ajax.point.php",
                    method:"POST",
                    data:{}
                }).done(function(data){
                    console.log(data)
                    $(".point_list").html(data);
                })
            }else if(align_type==2){

            }
        })
    })*/
</script>
<?php
include_once ("../../tail.php");
?>

