<?php
	include_once("../common.php");
    include_once(G5_LIB_PATH.'/thumbnail.lib.php');
    include_once(G5_PATH."/admin/head.php");

    $where = " m.wr_is_comment = 0 ";

	if($search){
		$where .="and m.wr_subject like '%{$search}%'";
	}
	$total=sql_fetch("select count(m.*) as cnt from `g5_write_main` as m left join `store_detail` as s on m.wr_id = s.wr_id where 1 {$where}");
	if(!$page)
		$page=1;
	$total=$total['cnt'];
	$rows=10;
	$start=($page-1)*$rows;
	$total_page=ceil($total/$rows);
	$sql="select m.*,s.* from `g5_write_main` as m left join `store_detail` as s on m.wr_id = s.wr_id where {$where} order by m.`wr_id` desc limit {$start},{$rows}";
	$query=sql_query($sql);
	$j=0;
	while($data=sql_fetch_array($query)){
		$list[$j]=$data;
		$list[$j]['num']=$total-($start)-$j;
		$j++;
	}
?>
<style type="text/css">
    .rent_list li{padding-bottom:10px;padding-top:10px;padding-right:150px;}
    .rent_list li .img{top:15px}
	.rent_list li > .mod{margin-top:-15px;border:1px solid #ddd;padding:10px;width:100px;}
	.rent_list li > .del{margin-top:35px;border:1px solid #ddd;padding:10px;width:100px;}
	.grid_25{width:25% !important;display:inline-block;float:left;box-sizing:border-box;}
	.grid_60{width:60% !important;display:inline-block;float:left;box-sizing:border-box;}
	.grid_15{width:15% !important;display:inline-block;float:left;box-sizing:border-box;}
	.grid_85{width:85% !important;display:inline-block;float:left;box-sizing:border-box;}
	.lh30{line-height:30px !important;}
	.mb10{margin-bottom:10px !important;}
    @media all and (max-width: 1120px) {
        .rent_list li .img{top:6px}
    }
	@media all and (max-width: 768px){
		.rent_list li > .mod{margin-top:-25px;height:auto}
		.rent_list li > .del{margin-top:15px;height:auto}
	}
    @media all and (max-width: 768px){
        .rent_list li{padding-bottom:7px;padding-top:7px;padding-right:150px;}
        .rent_list li > .mod{margin-top:-25px;height:auto;width:60px;padding:5px}
        .rent_list li > .del{margin-top:15px;height:auto;width:60px;padding:5px}
    }
</style>
<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1>상점관리</h1>
			<hr />
		</header>
		<article>
			<form action="" method="get" class="grid_100 mb10">
				<div class="grid_85 pl10"><input type="text" name="search" id="search" class="grid_100 adm-input01" value="<?php echo $search; ?>" placeholder="매장명" /></div>
				<div class="grid_15 pl10"><input type="submit" class="grid_100 color_white lh30 btn" style="background:#666;border:none;" value="검색" /></div>
			</form>
			<div class="rent_list">
				<ul>
					<?php
						for($i=0;count($list)>$i;$i++){
                            $thumb = get_list_thumbnail("main", $list[$i]['wr_id'], 800, 530);
                            if($thumb['src']) {
                                $img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'">';
                            }else{
                                $img_content = '<img src="'.G5_IMG_URL.'/no_img.png" alt="'.$thumb['alt'].'">';
                            }
                            $order = sql_fetch("select COUNT(*) as cnt from `order_form` where order_state > 0 and order_state < 4 and wr_id='{$list[$i]['wr_id']}'");

                            $link="javascript:location.href='".G5_URL."/admin/model_view.php?wr_id=".$list[$i]['wr_id']."&type=".$type."'";

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
					?>
					<li >
                        <?php if($list[$i]["wr_7"]==1){?><img src="<?php echo G5_IMG_URL?>/ic_premium.png" alt="프리미엄" class="list_icon"><?php }?>
                        <div <?php if($list[$i]["wr_file"]!=0){?>onclick="<?php echo $link; ?>"<?php }else{?>onclick="alert('상점정보 등록중입니다.')"<?php }?>>
                            <?php if($list[$i]['wr_5']=="N"){ ?>
                                <div style="position:absolute;top:0;right:0;background:#cf1616;color:#fff;padding:10px;"><div>영업준비중</div></div>
                                <?php if($list[$i]["wr_file"] == 0){?>
                                <div style="position:absolute;top:0;right:80px;background:#ffce31;color:#000;padding:10px;"><div>상점정보입력중</div></div>
                                <?php }?>
                            <?php }?>
                            <div class="img" >
                                <div ><?php echo $img_content; ?></div>
                            </div>
                            <div class="txt">
                                <h3 style="margin-bottom:1px;"><?php echo $list[$i]['wr_subject']; ?></h3>
                                <h4><?php echo ($list[$i]['store_addr1'] && $list[$i]["store_add2"])?$list[$i]['store_addr1']." ".$list[$i]["store_add2"]:"주소정보 없음"; ?></h4>
                                <p>영업시간  <?php echo ($list[$i]["open_time"] && $list[$i]["close_time"])?$list[$i]["open_time"]."~".$list[$i]["close_time"]:"오픈정보 없음"; ?></p>
                                <p>주문수  <?php echo ($order["cnt"])?$order["cnt"]:"0"; ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo ($list[$i]['delivery_price'])?number_format($list[$i]['delivery_price'])."원 이상배달":"최소금액정보 없음"; ?></p>
                                <p><span class="bg_yellow bold"><?=$rank?></span></p>
                            </div>
                        </div>
                        <!--<a href="javascript:" class="btn bg_gray">주문하기</a><br>-->
                        <!--<a href="tel:<?php /*echo $list[$i]['store_hp'];*/?>" class="btn"></a>-->
                        <?php if($list[$i]["wr_file"]!=0){?>
						<a href="<?php echo G5_URL."/admin/model_write.php?page=".$page."&id=".$list[$i]['id']; ?>" class="btn mod" >수정하기</a>
						<a href="<?php echo G5_URL."/admin/model_delete.php?page=".$page."&id=".$list[$i]['id']; ?>" class="btn del" >삭제하기</a>
                        <?php }?>
					</li>
					<?php
						}
						if(count($list)==0){
					?>
						<li class="text-center" style="padding:70px 0;">등록된 상점이 없습니다.</li>
					<?php
						}
					?>
				</ul>
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
					<li class="prev"><a href="<?php echo G5_URL."/admin/model_list.php?search={$search}&page=".($page-1); ?>">&lt;</a></li>
				<?php } ?>
				<?php for($i=$start_page;$i<=$end_page;$i++){ ?>
					<li class="<?php echo $page==$i?"active":""; ?>"><a href="<?php echo G5_URL."/admin/model_list.php?search={$search}&page=".$i; ?>"><?php echo $i; ?></a></li>
				<?php } ?>
				<?php if($page<$total_page){?>
					<li class="next"><a href="<?php echo G5_URL."/admin/model_list.php?search={$search}&page=".($page+1); ?>">&gt;</a></li>
				<?php } ?>
				</ul>
			</div>
			<?php
			}
			?>
			<!--<div class="text-right mt20">
				<a href="<?php /*echo G5_URL."/admin/model_write.php"; */?>" class="adm-btn01">추가하기</a>
			</div>-->
		</article>
	</section>
</div>
<?php
	include_once(G5_PATH."/admin/tail.php");
?>
