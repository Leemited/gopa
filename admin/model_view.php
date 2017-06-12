<?php
	include_once("../common.php");
	$p=true;
	include_once(G5_PATH."/admin/head.php");
	if(!$id){
		alert("잘못된 정보입니다.");
	}
	$view=sql_fetch("select * from `best_model` where id='".$id."'");
?>
<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1>차종관리</h1>
			<hr />
		</header>
		<article>
			<div class="adm-table02">
				<table>
					<tr>
						<th>사진 *</th>
						<td><img src="<?php echo G5_DATA_URL."/model/".$view['photo']; ?>" alt="image" /></td>
					</tr>
					<tr>
						<th>차종이름 *</th>
						<td><?php echo $view['name']; ?></td>
					</tr>
					<tr>
						<th>렌탈자격요건</th>
						<td><?php echo $view['condition']; ?></td>
					</tr>
				</table>
			</div>
			<div class="adm-table02 mt20">
				<table>
					<tr>
						<th>1일 *</th>
						<td><?php echo number_format($view['day_pay']); ?>원</td>
					</tr>
					<tr>
						<th>3~4일 *</th>
						<td><?php echo number_format($view['day_pay3']); ?>원</td>
					</tr>
					<tr>
						<th>5~6일 *</th>
						<td><?php echo number_format($view['day_pay5']); ?>원</td>
					</tr>
					<tr>
						<th>7일~ *</th>
						<td><?php echo number_format($view['day_pay7']); ?>원</td>
					</tr>
					<tr>
						<th>시간당 *</th>
						<td><?php echo number_format($view['hour_pay']); ?>원</td>
					</tr>
					<tr>
						<th>픽업서비스 *</th>
						<td><?php echo number_format($view['pick_pay']); ?>원</td>
					</tr>
				</table>
			</div>
			<div class="adm-table02 mt20">
				<table>
					<tr>
						<th>차량유형 *</th>
						<td><?php echo $view['type']; ?></td>
					</tr>
					<tr>
						<th>연료 *</th>
						<td><?php echo $view['fuel']; ?></td>
					</tr>
					<tr>
						<th>연비</th>
						<td><?php echo $view['mileage']; ?></td>
					</tr>
					<tr>
						<th>인원 *</th>
						<td><?php echo $view['seater']; ?></td>
					</tr>
					<tr>
						<th>변속기 *</th>
						<td><?php echo $view['gear']; ?></td>
					</tr>
					<tr>
						<th>연식 *</th>
						<td><?php echo $view['year']; ?></td>
					</tr>
					<tr>
						<th>배기량</th>
						<td><?php echo $view['displacement']; ?></td>
					</tr>
					<tr>
						<th>색상</th>
						<td><?php echo $view['color']; ?></td>
					</tr>
					<tr>
						<th>옵션</th>
						<td><?php echo $view['option']; ?></td>
					</tr>
					<tr>
						<th>설명</th>
						<td><?php echo $view['content']; ?></td>
					</tr>
				</table>
			</div>
			<div class="text-center mt20" style="margin-bottom:20px;">
				<a href="<?php echo G5_URL."/admin/model_write.php?id=".$id."&page=".$page; ?>" class="adm-btn01">수정하기</a>
				<?php if($is_admin){ ?><a href="<?php echo G5_URL."/admin/model_list.php?page=".$page; ?>" class="adm-btn01">목록으로</a><?php } ?>
			</div>
		</article>
	</section>
</div>
<?php
	include_once(G5_PATH."/admin/tail.php");
?>
