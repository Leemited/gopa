<?php
	include_once("../../common.php");
	if($mtype!=""){
		$back_url=G5_URL."/page/rent/list.php?type=".$type;
	}else{
		if($type=="long")
			$back_url=G5_URL."/page/rent/long.php";
	}
	include_once(G5_PATH."/head.php");
	if(!$type){
		$type="short";
	}
	if($type=="short")
		$c_type="단기대여";
	else
		$c_type="장기대여";
	$best_tel=sql_fetch("select * from `best_tel`");
	$where="";
	if($mtype){
		$where=" and m.type='{$mtype}'";
	}
	$query=sql_query("select * from best_model as m inner join best_car as c on m.id=c.model where `c_type`='{$c_type}' {$where} group by m.id order by m.id desc");
	$car_query=sql_query("select count(*) as cnt,model from best_car as c where c_type='{$c_type}' group by model");
	$reverse_query=sql_query("select count(*) as cnt,model from best_reserve where (status='1' or status='0') and type='{$type}' group by model");
	while($data=sql_fetch_array($query)){
		$list[]=$data;
	}
	while($car_data=sql_fetch_array($car_query)){
		$car_list[$car_data['model']]=$car_data;
	}
	while($reverse_data=sql_fetch_array($reverse_query)){
		$reverse_list[$reverse_data['model']]=$reverse_data;
	}
?>
	<div class="width-fixed">
		<section class="section01">
			<header class="section01_header">
				<h1><?php $type=="short"?"단기대여":"장기대여"; ?></h1>
				<h3 class="<?php echo $type=="short"?"rent_list_head":"long_head"; ?>"></h3>
				<p>예약 후 1시간 이내에 연락드리겠습니다.</p>
			</header>
			<div class="section01_content wrap">
				<div class="sub_call_banner">
					<h3>예약 후 <span>1시간 이내</span>에 연락드리겠습니다.</h3>
					<h2>영업시간 내 <span>빠른예약</span>을 원하신다면?</h2>
					<p><?php if(!$best_tel['all']){ ?>영업시간 <?php echo date("A h:i",strtotime($best_tel['time1'])); ?> ~ <?php echo date("A h:i",strtotime($best_tel['time2'])); ?><?php }else{ ?>연중무휴 24시간 영업<?php } ?></p>
					<a href="tel:<?php echo $best_tel['tel']; ?>">
						<i></i>
						<div>
							전화예약<br />
							하러가기
						</div>
					</a>
				</div>
				<div class="rent_select">
					<label for="cate" <?php echo $mtype?"style='color:#000'":""; ?>><?php echo $mtype?$mtype:"차량 유형 선택"; ?></label>
					<select name="cate" id="cate" onchange="javascript:location.href='<?php echo G5_URL."/page/rent/list.php?type=".$type."&mtype="; ?>'+encodeURIComponent(this.value);">
						<option value="">차량 유형 선택</option>
						<option value="소형">소형</option>
						<option value="중형">중형</option>
						<option value="대형">대형</option>
						<option value="승합">승합</option>
						<option value="SUV/RV">SUV/RV</option>
						<option value="수입">수입</option>
					</select>
				</div>
				<div class="rent_list">
					<ul>
					<?php
					for($i=0;$i<count($list);$i++){
						$id=$list[$i]['model'];
						$stop=0;
						/*
						if($car_list[$id]['cnt']<=$reverse_list[$id]['cnt']){
							$link="javascript:";
							$stop=1;
						}else if($is_member){
							$link="javascript:location.href='".G5_URL."/page/rent/reserve_form.php?model=".$list[$i]['model']."&type=".$type."';";
						}else{
							$link="javascript:location.href='".G5_URL."/page/rent/reserve_form_login.php?model=".$list[$i]['model']."&type=".$type."';";
						}
						*/
						if($type=="short" && $car_list[$id]['cnt']<=$reverse_list[$id]['cnt']){
							$link="javascript:";
							$stop=1;
						}else{
							$link="javascript:location.href='".G5_URL."/page/rent/view.php?model=".$list[$i]['model']."&type=".$type."';";
						}
					?>
						<li data-cate="<?php echo $list[$i]['type']; ?>">
							<div onclick="<?php echo $link; ?>">
								<div class="img">
									<div><img src="<?php echo G5_DATA_URL."/model/".$list[$i]['photo']; ?>" alt="image" /></div>
								</div>
								<div class="txt">
									<h3><?php echo $list[$i]['name']; ?></h3>
									<p><?php echo $list[$i]['fuel']; ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo $list[$i]['gear']; ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo $list[$i]['year']; ?></p>
									<?php if($type!="long" && $list[$i]['day_pay']!=0){ ?><h4><span>1일</span><?php echo number_format($list[$i]['day_pay']); ?></h4><?php } ?>
								</div>
							</div>
							<?php if($stop){ ?> 
							<a href="javascript:" class="btn bg_gray">예약마감</a>
							<?php }else{ ?>
							<a href="<?php echo G5_URL."/page/rent/view.php?model=".$list[$i]['model']."&type=".$type; ?>" class="btn">상세보기</a>
							<?php } ?>
						</li>
					<?php } ?>
					</ul>
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
		/*$(function(){
			$(".rent_select select").change(function(){
				var tval=$(this).val();
				var p=$(this).parent();
				if(tval){
					p.find("label").html(tval);
					p.find("label").css("color","#000");
				}else{
					p.find("label").html("차량 유형 선택");
					p.find("label").css("color","#bebebe");
				}
				len=$(".rent_list li").length;
				for(i=0;i<len;i++){
					var cate=$(".rent_list li").eq(i).attr("data-cate");
					if(cate==tval){
						$(".rent_list li").eq(i).show();
					}else{
						$(".rent_list li").eq(i).hide();
					}
				}
			});
		});*/
	</script>
<?php
	include_once(G5_PATH."/tail.php");
?>