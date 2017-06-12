<?php
	include_once("../../common.php");
	$back_url=G5_URL."/page/rent/list.php";
	include_once(G5_PATH."/head.php");
	if(!$type){
		$type="short";
	}
	$best_tel=sql_fetch("select * from `best_tel`");
	$view=sql_fetch("select * from best_model where id='{$model}'");
	if($is_member){
		$link="javascript:location.href='".G5_URL."/page/rent/reserve_form.php?model=".$model."&type=".$type."';";
	}else{
		$link="javascript:location.href='".G5_URL."/page/rent/reserve_form_login.php?model=".$model."&type=".$type."';";
	}
?>
	<div class="width-fixed">
		<section class="section01">
			<header class="section01_header">
				<h1><?php $type=="short"?"단기대여":"장기대여"; ?></h1>
				<h3 class="<?php echo $type=="short"?"rent_list_head":"long_head"; ?>"></h3>
				<p>예약 후 1시간 이내에 연락드리겠습니다.</p>
			</header>
			<div class="section01_content">
				<div id="rent_view">
					<div class="top">
						<div class="img">
							<div>
								<img src="<?php echo G5_DATA_URL."/model/".$view['photo']; ?>" alt="<?php echo $view['name']; ?>" />
							</div>
						</div>
						<div class="info">
							<h1><?php echo $view['name']; ?></span><span><?php echo $view['type']; ?></span></h1>
							<p><?php echo $view['fuel']; ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo $view['gear']; ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo $view['year']; ?></p>
							<span class="type"><?php echo $view['type']; ?></span>
							<div class="m_img">
								<div>
									<img src="<?php echo G5_DATA_URL."/model/".$view['photo']; ?>" alt="<?php echo $view['name']; ?>" />
								</div>
							</div>
							
							<div class="price">
							<?php if($type!="long" && $view['day_pay']!=0){ ?>
								<h4>1일<span><?php echo number_format($view['day_pay']); ?></span></h4>
								<h4 class="last">시간당<span><?php echo number_format($view['hour_pay']); ?></span></h4>
							<?php } ?>
							</div>
							<a href="<?php echo $link; ?>">예약하기</a>
						</div>
					</div>
					<div class="bottom">
						<div class="detail">
							<h2>상세정보</h2>
							<div class="table02">
								<table>
									<tr>
										<th>연식</th>
										<td class="bdr"><?php echo $view['year']?$view['year']:"-"; ?></td>
										<th>연료</th>
										<td><?php echo $view['fuel']?$view['fuel']:"-"; ?></td>
									</tr>
									<tr>
										<th>연비</th>
										<td class="bdr"><?php echo $view['mileage']?$view['mileage']:"-"; ?></td>
										<th>인원</th>
										<td><?php echo $view['seater']?$view['seater']:"-"; ?></td>
									</tr>
									<tr>
										<th>변속기</th>
										<td class="bdr"><?php echo $view['gear']?$view['gear']:"-"; ?></td>
										<th>배기량</th>
										<td><?php echo $view['displacement']?$view['displacement']:"-"; ?></td>
									</tr>
									<tr>
										<th>색상</th>
										<td class="bdr"><?php echo $view['color']?$view['color']:"-"; ?></td>
										<th>옵션</th>
										<td><?php echo $view['option']?$view['option']:"-"; ?></td>
									</tr>
								</table>
							</div>
						</div>
						<div class="con">
							<div>
								<?php if($type=="long"){ echo "만21세.만26세 이상 / 면허취득 1년이상<br />본 차량은 종합보험 및 자차포함 된 가격 입니다.<br />".$view['content'];}else{ echo $view['content']?$view['content']:"-";} ?>
							</div>
						</div>
					</div>
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
<?php
	include_once(G5_PATH."/tail.php");
?>