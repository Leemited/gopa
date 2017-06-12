<?php
	include_once("../common.php");
	include_once(G5_PATH."/admin/head.php");
	if($search){
		$where="and name like '%{$search}%'";
	}
	$total=sql_fetch("select count(*) as cnt from `best_model` where 1 {$where}");
	if(!$page)
		$page=1;
	$total=$total['cnt'];
	$rows=10;
	$start=($page-1)*$rows;
	$total_page=ceil($total/$rows);
	$sql="select * from `best_model` where 1 {$where} order by `id` desc limit {$start},{$rows}";
	$query=sql_query($sql);
	$j=0;
	while($data=sql_fetch_array($query)){
		$list[$j]=$data;
		$list[$j]['num']=$total-($start)-$j;
		$j++;
	}
?>
<style type="text/css">
	.rent_list li > .mod{margin-top:-28px;}
	.rent_list li > .del{margin-top:28px;}
	.grid_25{width:25% !important;display:inline-block;float:left;box-sizing:border-box;}
	.grid_60{width:60% !important;display:inline-block;float:left;box-sizing:border-box;}
	.grid_15{width:15% !important;display:inline-block;float:left;box-sizing:border-box;}
	.grid_85{width:85% !important;display:inline-block;float:left;box-sizing:border-box;}
	.lh30{line-height:30px !important;}
	.mb10{margin-bottom:10px !important;}
	@media all and (max-width: 768px){
		.rent_list li > .mod{margin-top:-30px;}
		.rent_list li > .del{margin-top:3px;}
	}
</style>
<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1>차종관리</h1>
			<hr />
		</header>
		<article>
			<form action="" method="get" class="grid_100 mb10">
				<div class="grid_85 pl10"><input type="text" name="search" id="search" class="grid_100 adm-input01" value="<?php echo $search; ?>" placeholder="차종이름" /></div>
				<div class="grid_15 pl10"><input type="submit" class="grid_100 color_white lh30 btn" style="background:#666;border:none;" value="검색" /></div>
			</form>
			<div class="rent_list">
				<ul>
					<?php
						for($i=0;count($list)>$i;$i++){
					?>
					<li>
						<div onclick="location.href='<?php echo G5_URL."/admin/model_view.php?id=".$list[$i]['id']; ?>'">
							<div class="img">
								<div><img src="<?php echo G5_DATA_URL."/model/".$list[$i]['photo']; ?>" alt="image" /></div>
							</div>
							<div class="txt">
								<h3><?php echo $list[$i]['name']; ?></h3>
								<p><?php echo $list[$i]['fuel']; ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo $list[$i]['gear']; ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo $list[$i]['year']; ?></p>
								<h4><span>1일&nbsp;&nbsp;&nbsp;&nbsp;</span><?php echo number_format($list[$i]['day_pay']); ?>원</h4>
								<h4><span>1시간</span><?php echo number_format($list[$i]['hour_pay']); ?>원</h4>
							</div>
						</div>
						<a href="<?php echo G5_URL."/admin/model_write.php?page=".$page."&id=".$list[$i]['id']; ?>" class="btn mod" style="background:#666;">수정하기</a>
						<a href="<?php echo G5_URL."/admin/model_delete.php?page=".$page."&id=".$list[$i]['id']; ?>" class="btn del">삭제하기</a>
					</li>
					<?php
						}
						if(count($list)==0){
					?>
						<li class="text-center" style="padding:70px 0;">차종이 없습니다.</li>
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
			<div class="text-right mt20">
				<a href="<?php echo G5_URL."/admin/model_write.php"; ?>" class="adm-btn01">추가하기</a>
			</div>
		</article>
	</section>
</div>
<?php
	include_once(G5_PATH."/admin/tail.php");
?>
