<?php
	include_once("../../common.php");
	include_once(G5_PATH."/head.php");
	$best_tel=sql_fetch("select * from `best_tel`");
	$best_long=sql_fetch("select * from `best_long`");
	$end=date("Y-m-t");
	$start=date("Y-m-01");
	$best_event_query=sql_query("select * from `g5_write_event` where `wr_3`='장기대여' and ((`wr_1`>'{$start}' and `wr_1`<'{$end}') or (`wr_2`>'{$start}' and `wr_2`<'{$end}'))");
	while($best_event_data=sql_fetch_array($best_event_query)){
		$best_event[]=$best_event_data;
	}
?>
	<div class="width-fixed">
		<section class="section01">
			<header class="section01_header">
				<h1>장기대여</h1>
				<h3 class="long_head"></h3>
				<p>예약 후 1시간 이내에 연락드리겠습니다.</p>
			</header>
			<div class="section01_content">
				<div id="long">
					<div class="top">
						<div>
							<h3></h3>
							<h1></h1>
							<p></p>
							<div class="btn_group">
								<a href="tel:<?php echo $best_tel['tel']; ?>" class="btn tel">전화예약<br /><span><?php echo dot_hp_number($best_tel['tel']); ?></span></a>
								<a href="<?php echo G5_URL."/page/rent/list.php?type=long"; ?>" class="btn">온라인 예약</a>
							</div>
						</div>
					</div>
					<div class="wrap">
						<div class="tab">
							<div>
								<div class="menu">
									<ul>
										<li rel="small" class="active">소형</li>
										<li rel="middle">중형</li>
										<li rel="big">대형</li>
										<li rel="van">승합</li>
										<li rel="suvrv">SUV/RV</li>
										<li rel="imported">수입</li>
									</ul>
								</div>
								<div id="small" class="tab_content active">
									<div class="table04">
										<table>
											<tr class="bg">
												<th>~1개월</th>
												<td><?php echo number_format($best_long['s1']); ?>~</td>
											</tr>
											<tr>
												<th>~3개월</th>
												<td><?php echo number_format($best_long['s3']); ?>~</td>
											</tr>
											<tr class="bg">
												<th>~6개월</th>
												<td><?php echo number_format($best_long['s6']); ?>~</td>
											</tr>
											<tr>
												<th>~1년</th>
												<td><?php echo number_format($best_long['s12']); ?>~</td>
											</tr>
											<tr class="bg">
												<th>~3년</th>
												<td><?php echo number_format($best_long['s36']); ?>~</td>
											</tr>
										</table>
									</div>
								</div>
								<div id="middle" class="tab_content">
									<div class="table04">
										<table>
											<tr class="bg">
												<th>~1개월</th>
												<td><?php echo number_format($best_long['m1']); ?>~</td>
											</tr>
											<tr>
												<th>~3개월</th>
												<td><?php echo number_format($best_long['m3']); ?>~</td>
											</tr>
											<tr class="bg">
												<th>~6개월</th>
												<td><?php echo number_format($best_long['m6']); ?>~</td>
											</tr>
											<tr>
												<th>~1년</th>
												<td><?php echo number_format($best_long['m12']); ?>~</td>
											</tr>
											<tr class="bg">
												<th>~3년</th>
												<td><?php echo number_format($best_long['m36']); ?>~</td>
											</tr>
										</table>
									</div>
								</div>
								<div id="big" class="tab_content">
									<div class="table04">
										<table>
											<tr class="bg">
												<th>~1개월</th>
												<td><?php echo number_format($best_long['b1']); ?>~</td>
											</tr>
											<tr>
												<th>~3개월</th>
												<td><?php echo number_format($best_long['b3']); ?>~</td>
											</tr>
											<tr class="bg">
												<th>~6개월</th>
												<td><?php echo number_format($best_long['b6']); ?>~</td>
											</tr>
											<tr>
												<th>~1년</th>
												<td><?php echo number_format($best_long['b12']); ?>~</td>
											</tr>
											<tr class="bg">
												<th>~3년</th>
												<td><?php echo number_format($best_long['b36']); ?>~</td>
											</tr>
										</table>
									</div>
								</div>
								<div id="van" class="tab_content">
									<div class="table04">
										<table>
											<tr class="bg">
												<th>~1개월</th>
												<td><?php echo number_format($best_long['v1']); ?>~</td>
											</tr>
											<tr>
												<th>~3개월</th>
												<td><?php echo number_format($best_long['v3']); ?>~</td>
											</tr>
											<tr class="bg">
												<th>~6개월</th>
												<td><?php echo number_format($best_long['v6']); ?>~</td>
											</tr>
											<tr>
												<th>~1년</th>
												<td><?php echo number_format($best_long['v12']); ?>~</td>
											</tr>
											<tr class="bg">
												<th>~3년</th>
												<td><?php echo number_format($best_long['v36']); ?>~</td>
											</tr>
										</table>
									</div>
								</div>
								<div id="imported" class="tab_content">
									<div class="table04">
										<table>
											<tr class="bg">
												<th>~1개월</th>
												<td><?php echo $best_long['i1']?number_format($best_long['i1'])." ~":"전화상담"; ?></td>
											</tr>
											<tr>
												<th>~3개월</th>
												<td><?php echo $best_long['i3']?number_format($best_long['i3'])." ~":"전화상담"; ?></td>
											</tr>
											<tr class="bg">
												<th>~6개월</th>
												<td><?php echo $best_long['i6']?number_format($best_long['i6'])." ~":"전화상담"; ?></td>
											</tr>
											<tr>
												<th>~1년</th>
												<td><?php echo $best_long['i12']?number_format($best_long['i12'])." ~":"전화상담"; ?></td>
											</tr>
											<tr class="bg">
												<th>~3년</th>
												<td><?php echo $best_long['i36']?number_format($best_long['i36'])." ~":"전화상담"; ?></td>
											</tr>
										</table>
									</div>
								</div>
								<div id="suvrv" class="tab_content">
									<div class="table04">
										<table>
											<tr class="bg">
												<th>~1개월</th>
												<td><?php echo $best_long['r1']?number_format($best_long['r1'])." ~":"전화상담"; ?></td>
											</tr>
											<tr>
												<th>~3개월</th>
												<td><?php echo $best_long['r3']?number_format($best_long['r3'])." ~":"전화상담"; ?></td>
											</tr>
											<tr class="bg">
												<th>~6개월</th>
												<td><?php echo $best_long['r6']?number_format($best_long['r6'])." ~":"전화상담"; ?></td>
											</tr>
											<tr>
												<th>~1년</th>
												<td><?php echo $best_long['r12']?number_format($best_long['r12'])." ~":"전화상담"; ?></td>
											</tr>
											<tr class="bg">
												<th>~3년</th>
												<td><?php echo $best_long['r36']?number_format($best_long['r36'])." ~":"전화상담"; ?></td>
											</tr>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php if(count($best_event)>0){ ?> 
					<div class="event">
						<h2></h2>
						<div>
							<ul>
							<?php
							for($i=0;$i<count($best_event);$i++){
								if(strtotime(date("Y-m-d")) < strtotime($best_event[$i]['wr_1'])){
									$status='<span class="waiting">[준비중]</span>';
								}else if(strtotime(date("Y-m-d")) > strtotime($best_event[$i]['wr_2'])){
									$status='<span class="end">[종료]</span>';
								}else{
									$status='<span class="ing">[진행중]</span>';
								}
							?>
								<li class="<?php echo $i+1==count($best_event)?"last":""; ?>"><a href="<?php echo G5_BBS_URL."/board.php?bo_table=event&wr_id=".$best_event[$i]['wr_id']; ?>"><?php echo $status; ?><?php echo $best_event[$i]['wr_subject']; ?><span class="range"><?php echo date("Y.m.d",strtotime($best_event[$i]['wr_1'])); ?> ~ <?php echo date("Y.m.d",strtotime($best_event[$i]['wr_2'])); ?></span></a></li>
							<?php } ?>
							</ul>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
		</section>
		<div class="sub_call_pop">
			<div class="top">
				<i></i>
				<div>
					<h3>빠르고 간편한</h3>
					<h2>전화예약</h2>
				</div>
			</div>
			<div class="bottom">
				<h1><?php echo dot_hp_number($best_tel['tel']); ?></h1>
				<p><?php if(!$best_tel['all']){ echo date("A h:i",strtotime($best_tel['time1'])); ?> ~ <?php echo date("A h:i",strtotime($best_tel['time2'])); ?><?php }else{ ?>연중무휴 24시간 영업<?php } ?></p>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(function () {
			$(".tab_content").hide();
			$(".tab_content:first").show();

			$(".tab > div li").click(function () {
				$(".tab > div li").removeClass("active");
				$(this).addClass("active");
				$(".tab_content").hide()
				var activeTab = $(this).attr("rel");
				$("#" + activeTab).fadeIn()
			});
		});
	</script>
<?php
	include_once(G5_PATH."/tail.php");
?>