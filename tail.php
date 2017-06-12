<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 하단 파일 경로 지정 : 이 코드는 가능한 삭제하지 마십시오.
if ($config['cf_include_tail'] && is_file(G5_PATH.'/'.$config['cf_include_tail'])) {
    include_once(G5_PATH.'/'.$config['cf_include_tail']);
    return; // 이 코드의 아래는 실행을 하지 않습니다.
}

if (G5_IS_MOBILE) {
    include_once(G5_MOBILE_PATH.'/tail.php');
    return;
}
$best_tel=sql_fetch("select * from `best_tel`");
?>
</div>
<footer id="footer" class="<?php echo $main?"":"sub_footer"; ?>">
	<div class="width-fixed">
		<ul>
			<li><a href="<?php echo G5_URL."/page/guide/agreement.php"; ?>">개인정보취급방침</a></li>
			<li><a href="<?php echo G5_URL."/page/guide/privacy.php"; ?>">이용약관</a></li>
			<li class="last"><a href="<?php echo G5_URL."/page/guide/direction.php"; ?>">오시는길</a></li>
		</ul>
		<p>
			bestrentcar<!-- &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;대표 : 홍길동 -->&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;충북 청주시 흥덕구 봉명동 2449번지 파비뇽아울렛A 104호<br />
			TEL : <?php echo hyphen_hp_number($best_tel['tel']); ?>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;fax :&nbsp;&nbsp;043-260-0042&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;E-mail : idlove38@naver.com<br />
			Copyrightⓒ 2016 bestrentcar. All rights reserved.
		</p>
	</div>
</footer>
<?php
include_once(G5_PATH."/tail.sub.php");
?>