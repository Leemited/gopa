<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 상단 파일 경로 지정 : 이 코드는 가능한 삭제하지 마십시오.
if ($config['cf_include_head'] && is_file(G5_PATH.'/'.$config['cf_include_head'])) {
    include_once(G5_PATH.'/'.$config['cf_include_head']);
    return; // 이 코드의 아래는 실행을 하지 않습니다.
}

include_once(G5_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');

if (G5_IS_MOBILE) {
    include_once(G5_MOBILE_PATH.'/head.php');
    return;
}
$partner=sql_fetch("select * from `best_partner` where mb_id='".$member['mb_id']."'");
$branch=sql_fetch("select * from `best_branch` where mb_id='".$member['mb_id']."'");
?>
<style type="text/css">
	.user_box > p > span{background:#757575;color:#fff;display:inline-block;font-size:16px;vertical-align:middle;padding:5px 10px;border-radius:3px;}
</style>
<!-- 헤더 시작 -->
<header id="header" class="<?php echo $main?"":"sub_header"; ?>">
	<div id="top_header">
		<div class="width-fixed">
			<?php if($is_member){ ?>
				<p><span></span><?php echo $member['mb_id']; ?> 님 (<?php echo number_format($member['mb_point']); ?>p)</p>
				<ul>
					<li><a href="<?php echo G5_BBS_URL."/register_form.php?w=u"; ?>">정보수정</a></li>
					<?php if($is_admin || $partner['id'] || $branch['id']){ ?>
					<li><a href="<?php echo G5_URL."/admin"; ?>">관리자</a></li>
					<?php } ?>
					<li class="last"><a href="<?php echo G5_BBS_URL."/logout.php"; ?>">로그아웃</a></li>
				</ul>
			<?php }else{ ?>
				<ul>
					<li><a href="<?php echo G5_BBS_URL."/login.php"; ?>">로그인</a></li>
					<li class="last"><a href="<?php echo G5_BBS_URL."/register_form.php"; ?>">회원가입</a></li>
				</ul>
			<?php } ?>
		</div>
	</div>
	<div id="main_header">
		<div class="width-fixed">
			<h1><a href="<?php echo G5_URL; ?>"></a></h1>
			<ul>
				<li><a href="<?php echo G5_URL."/page/intro"; ?>">회사소개</a></li>
				<li><a href="<?php echo G5_URL."/page/rent/list.php"; ?>">단기대여</a></li>
				<li><a href="<?php echo G5_URL."/page/rent/long.php"; ?>">장기대여</a></li>
				<li><a href="<?php echo G5_URL."/page/accident"; ?>">사고대차</a></li>
				<li><a href="<?php echo G5_URL."/page/mypage/reserve.php"; ?>">예약확인</a></li>
				<li>
					<a href="<?php echo G5_BBS_URL."/board.php?bo_table=notice"; ?>">커뮤니티</a>
					<ul>
						<li><a href="<?php echo G5_BBS_URL."/board.php?bo_table=notice"; ?>">공지사항</a></li>
						<li><a href="<?php echo G5_BBS_URL."/board.php?bo_table=event"; ?>">이벤트</a></li>
						<li><a href="<?php echo G5_BBS_URL."/board.php?bo_table=review"; ?>">고객리뷰</a></li>
					</ul>
				</li>
				<li class="last"><a href="<?php echo G5_URL."/page/partner"; ?>">제휴업체</a></li>
			</ul>
		</div>
	</div>
	<!-- 모바일 헤더 시작 -->
	<div id="mobile_header">
		<span class="mobile_back_btn"><a href="<?php echo $back_url?$back_url:G5_URL; ?>"></a></span>
		<h1><a href="<?php echo G5_URL; ?>"><span></span></a></h1>
		<span class="mobile_menu_btn"><a href="javascript:"></a></span>
		<!-- 모바일 메뉴 시작 -->
		<div class="mobile_menu">
			<span></span>
			<div>
				<div class="user_box">
					<span></span>
					<p><?php echo $is_member?$member['mb_id']."님 <span>".number_format($member['mb_point'])."p</span>":"로그인해주세요"; ?></p>
					<div>
						<?php if($is_member){ ?>
						<a href="<?php echo G5_BBS_URL."/register_form.php?w=u"; ?>" class="bg_darkred color_white btn">정보수정</a>
						<a href="<?php echo G5_BBS_URL."/logout.php"; ?>" class="bg_gray btn ml10">로그아웃</a>
						<?php }else{ ?>
						<a href="<?php echo G5_BBS_URL."/login.php"; ?>" class="bg_darkred color_white btn">로그인</a>
						<a href="<?php echo G5_BBS_URL."/register_form.php"; ?>" class="bg_gray btn ml10">회원가입</a>
						<?php } ?>
					</div>
				</div>
				<ul>
					<li><a href="<?php echo G5_URL."/page/intro"; ?>">회사소개</a></li>
					<li><a href="<?php echo G5_BBS_URL."/board.php?bo_table=review"; ?>">고객리뷰</a></li>
					<li><a href="<?php echo G5_BBS_URL."/board.php?bo_table=notice"; ?>">공지사항</a></li>
					<li><a href="<?php echo G5_BBS_URL."/board.php?bo_table=event"; ?>">이벤트</a></li>
					<li><a href="<?php echo G5_URL."/page/partner"; ?>">제휴업체</a></li>
					<?php if($is_member){ ?>
					<li><a href="<?php echo G5_URL."/page/setting"; ?>">설정</a></li>
					<?php } ?>
					<li><a href="<?php echo G5_URL."/page/guide/agreement.php"; ?>">이용약관</a></li>
					<li <?php if(!$is_admin && !$partner['id'] && !$branch['id']){ ?>class="last"<? } ?>><a href="<?php echo G5_URL."/page/guide/privacy.php"; ?>">개인정보취급방침</a></li>
					<?php if($is_admin || $partner['id'] || $branch['id']){ ?>
					<li class="last"><a href="<?php echo G5_URL."/admin"; ?>">관리자</a></li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<!-- 모바일 메뉴 끝 -->
	</div>
	<!-- 모바일 헤더 끝 -->
</header>
<!-- 헤더끝 -->
<div class="msg"></div>
<div class="modal"></div>
<div class="container <?php echo $main?"main":"sub"; ?>">

