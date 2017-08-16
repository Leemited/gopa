<?php
include_once("../common.php");
include_once(G5_PATH."/admin/head.php");
$total=sql_fetch("select count(*) as cnt from `banner_list`");
if(!$page)
    $page=1;
$total=$total['cnt'];
$rows=10;
$start=($page-1)*$rows;
$total_page=ceil($total/$rows);
$sql="select * from `banner_list` order by `id` desc limit {$start},{$rows}";
$query=sql_query($sql);
$j=0;
while($data=sql_fetch_array($query)){
    $list[$j]=$data;
    $list[$j]['num']=$total-($start)-$j;
    $j++;
}
?>
<!-- 본문 start -->
<div id="wrap">
    <section>
        <header id="admin-title">
            <h1>리스트관리</h1>
            <hr />
        </header>
        <article>
            <div class="adm-table01">
                <table>
                    <thead>
                    <tr>
                        <th class="md_none">번호</th>
                        <th>업체이름</th>
                        <th>노출순서</th>
                        <th>노출날짜</th>
                        <!--<th>관리 id</th>-->
                        <th>관리</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    for($i=0;$i<count($list);$i++){
                        ?>
                        <tr>
                            <td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/list_view.php?id=".$list[$i]['id']."&page=".$page; ?>'"><?php echo $list[$i]['num']; ?></td>
                            <td onclick="location.href='<?php echo G5_URL."/admin/list_view.php?id=".$list[$i]['id']."&page=".$page; ?>'"><?php echo $list[$i]['name']; ?></td>
                            <td onclick="location.href='<?php echo G5_URL."/admin/list_view.php?id=".$list[$i]['id']."&page=".$page; ?>'"><?php echo ($list[$i]['seq'] >= 0)?($list[$i]['seq']+1)."번째":""; ?></td>
                            <td onclick="location.href='<?php echo G5_URL."/admin/list_view.php?id=".$list[$i]['id']."&page=".$page; ?>'"><?php echo($list[$i]['seq_time'])?$list[$i]['seq_time']." ~ ".$list[$i]['seq_time1']:""; ?></td>
                            <!--<td onclick="location.href='<?php /*echo G5_URL."/admin/partner_view.php?id=".$list[$i]['id']."&page=".$page; */?>'"><?php /*echo $list[$i]['mb_id']; */?></td>-->
                            <td><a href="<?php echo G5_URL."/admin/list_write.php?id=".$list[$i]['id']."&page=".$page; ?>" class="btn">수정</a> <a href="<?php echo G5_URL."/admin/list_delete.php?id=".$list[$i]['id']."&page=".$page; ?>" class="btn">삭제</a></td>
                        </tr>
                        <?php
                    }
                    if(count($list)==0){
                        ?>
                        <tr>
                            <td colspan="5" class="text-center" style="padding:50px 0;">협력업체가 없습니다.</td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <?php
            if($total_page>1){
                $start_page=1;
                $end_page=$total_page;
                if($total_page>5){
                    if($total_page<($page+2)){
                        $start_page=$total_page-4;
                        $end_page=$total_page;
                    }else if($page>3){
                        $start_page=$page-2;
                        $end_page=$page+2;
                    }else{
                        $start_page=1;
                        $end_page=5;
                    }
                }
                ?>
                <div class="num_list01">
                    <ul>
                        <?php if($page!=1){?>
                            <li class="prev"><a href="<?php echo G5_URL."/admin/list_list.php?page=".($page-1); ?>">&lt;</a></li>
                        <?php } ?>
                        <?php for($i=$start_page;$i<=$end_page;$i++){ ?>
                            <li class="<?php echo $page==$i?"active":""; ?>"><a href="<?php echo G5_URL."/admin/member_list.php?page=".$i; ?>"><?php echo $i; ?></a></li>
                        <?php } ?>
                        <?php if($page<$total_page){?>
                            <li class="next"><a href="<?php echo G5_URL."/admin/list_list.php?page=".($page+1); ?>">&gt;</a></li>
                        <?php } ?>
                    </ul>
                </div>
                <?php
            }
            ?>
            <div class="text-right mt20">
                <a href="<?php echo G5_URL."/admin/list_write.php"; ?>" class="adm-btn01">리스트추가</a>
            </div>
        </article>
    </section>
</div>
<?php
include_once(G5_PATH."/admin/tail.php");
?>
