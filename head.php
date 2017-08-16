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
$pageName = $_SERVER["REQUEST_URI"];
$view_chk = strpos($pageName,"view.php")===false;
$regist_chk = strpos($pageName,"register_form.php")===false;
$partner=sql_fetch("select * from `best_partner` where mb_id='".$member['mb_id']."'");
$branch=sql_fetch("select * from `best_branch` where mb_id='".$member['mb_id']."'");
$cart_count = sql_fetch("select count(*) as total from `cart` where (`mb_id` = '{$member[mb_id]}' or `mb_id` = '{$_COOKIE[PHPSESSID]}') and cart_date = CURRENT_DATE() and cart_state=0");
$cart_total = $cart_count["total"];
?>
<!-- 헤더 시작 -->
<header id="header" class="<?php echo $main?"":"sub_header"; echo $wr_id?" whiteHeader":""; ?>">
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
					<li><a href="<?php echo G5_BBS_URL."/login.php?type=user"; ?>">로그인</a></li>
					<li class="last"><a href="<?php echo G5_BBS_URL."/register_form.php"; ?>">회원가입</a></li>
				</ul>
			<?php } ?>
		</div>
	</div>
	<div id="main_header">
		<div class="width-fixed">
			<h1><a href="<?php echo G5_URL; ?>"></a></h1>
			<ul>
                <?php if($is_member && $member["mb_level"]!=5){ ?>
                    <li class="notice"><a href="<?php echo G5_URL."/bbs/board.php?bo_table=notice"; ?>">공지사항 및 이벤트</a></li>
                    <li class="info"><a href="<?php echo G5_URL."/page/guide/guide.php"; ?>">고파 안내</a></li>
                    <li class="point"><a href="<?php echo G5_URL."/page/mypage/point.php"; ?>">내포인트</a></li>
                    <li class="inquiry"><a href="<?php echo G5_URL."/bbs/board.php?bo_table=qna"; ?>">고객만족센터</a></li>
                <?php }else if($is_member && $member["mb_level"]==5 || $type=="shop"){?>
                    <li class="order"><a href="<?php echo G5_URL."/page/shop/index.php"; ?>">홈페이지로 돌아가기</a></li>
                    <li class="premium"><a href="<?php echo G5_URL."/page/shop/premium_form.php"; ?>">프리미엄전환</a></li>
                    <li class="point"><a href="<?php echo G5_URL."/page/mypage/point.php"; ?>">내포인트</a></li>
                    <li class="inquiry"><a href="<?php echo G5_URL."/bbs/board.php?bo_table=qna"; ?>">고객만족센터</a></li>
                <?php }else{ ?>
                    <li class="notice"><a href="<?php echo G5_URL."/bbs/board.php?bo_table=notice"; ?>">공지사항 및 이벤트</a></li>
                    <li class="order"><a href="<?php echo G5_URL."/page/rent/order_find.php"; ?>">비회원 주문조회</a></li>
                    <li class="info"><a href="<?php echo G5_URL."/page/guide/guide.php"; ?>">고파 안내</a></li>
                    <li class="inquiry"><a href="<?php echo G5_URL."/bbs/board.php?bo_table=qna"; ?>">고객만족센터</a></li>
                <?php } ?>
				<!--<li><a href="<?php /*echo G5_URL."/page/intro"; */?>">회사소개</a></li>
				<li><a href="<?php /*echo G5_URL."/page/rent/list.php"; */?>">단기대여</a></li>
				<li><a href="<?php /*echo G5_URL."/page/rent/long.php"; */?>">장기대여</a></li>
				<li><a href="<?php /*echo G5_URL."/page/accident"; */?>">사고대차</a></li>
				<li><a href="<?php /*echo G5_URL."/page/mypage/reserve.php"; */?>">예약확인</a></li>
				<li>
					<a href="<?php /*echo G5_BBS_URL."/board.php?bo_table=notice"; */?>">커뮤니티</a>
					<ul>
						<li><a href="<?php /*echo G5_BBS_URL."/board.php?bo_table=notice"; */?>">공지사항</a></li>
						<li><a href="<?php /*echo G5_BBS_URL."/board.php?bo_table=event"; */?>">이벤트</a></li>
						<li><a href="<?php /*echo G5_BBS_URL."/board.php?bo_table=review"; */?>">고객리뷰</a></li>
					</ul>
				</li>
				<li class="last"><a href="<?php /*echo G5_URL."/page/partner"; */?>">제휴업체</a></li>-->
			</ul>
		</div>
	</div>
	<!-- 모바일 헤더 시작 -->
	<div id="mobile_header" class="<?php echo $wr_id?"view_mode_off":"";?>">
        <?php if($pageName=="/" || $pageName=="/index.php"){?>
        <span class="mobile_search_btn" onclick="fnSearch();"></span>
		<h1><input type="text" placeholder="예) 청대 닭발" class="searchTxt"></h1>
        <?php }else{ ?>
            <h1 class="logo_header"><a href=""><span></span></a></h1>
        <?php } ?>
        <?php if($type!="shop"){?>
        <span class="mobile_menu_btn"><a href="javascript:"></a></span>
        <?php }?>
		<!-- 모바일 메뉴 시작 -->
		<div class="mobile_menu">
			<span></span>
			<div>
				<div class="user_box <?php if($member["mb_level"]==5){echo "seller";}?>">
                    <?php if($member["mb_level"]!=5){?>
					<span class="<?php echo $member["mb_sex"]=="남"?"man":"woman";?>"></span>
					<p><?php echo $is_member?$member['mb_name']:"로그인해주세요"; ?></p>
					<div>
						<?php if($is_member){ ?>
						<!--<a href="<?php /*echo G5_BBS_URL."/register_form.php?w=u"; */?>" class="bg_darkred color_white btn">정보수정</a>-->
						<a href="<?php echo G5_BBS_URL."/logout.php"; ?>" class="btn border_gray">로그아웃</a>
						<?php }else{ ?>
						<a href="<?php echo G5_BBS_URL."/login.php?type=user"; ?>" class="bg_darkred color_white btn">로그인</a>
						<a href="<?php echo G5_BBS_URL."/register_form.php"; ?>" class="btn ml10 border_gray">회원가입</a>
						<?php } ?>
					</div>
                    <?php }else{ ?>
                        <h2>오늘도 <?php echo $member["mb_name"];?>사장님의</h2>
                        <h1>성공을 응원합니다.</h1>
                    <?php }?>
				</div>
				<ul>
					<?php if($is_member && $member["mb_level"]!=5){ ?>
                    <li class="home"><a href="<?php echo G5_URL; ?>">홈으로 바로가기</a></li>
                    <li class="mypage"><a href="<?php echo G5_URL."/page/mypage/"; ?>">마이페이지</a></li>
					<li class="point"><a href="<?php echo G5_URL."/page/mypage/point.php"; ?>">내포인트</a></li>
					<li class="notice"><a href="<?php echo G5_URL."/bbs/board.php?bo_table=notice"; ?>">공지사항 및 이벤트</a></li>
					<li class="info"><a href="<?php echo G5_URL."/page/guide/guide.php"; ?>">고파 안내</a></li>
					<li class="inquiry"><a href="<?php echo G5_URL."/bbs/board.php?bo_table=qna"; ?>">고객만족센터</a></li>
                    <?php if($app){?>
                    <li class="order"><a href="<?php echo G5_URL."/page/setting"; ?>">마케팅정보 푸시 설정</a></li>
                    <?php } ?>
                    <?php }else if($is_member && $member["mb_level"]==5 || $type=="shop"){?>
                    <li class="register"><a href="<?php echo G5_BBS_URL."/logout.php?type=shop"; ?>">로그아웃</a></li>
                    <li class="home"><a href="<?php echo G5_URL."/page/shop/index.php"; ?>">홈페이지로 돌아가기</a></li>
                    <!--<li class="order"><a href="<?php /*echo G5_URL."/page/shop/setting.php"; */?>">상점 오픈 설정</a></li>-->
                    <li class="point"><a href="<?php echo G5_URL."/page/mypage/point.php"; ?>">내포인트</a></li>
                    <li class="inquiry"><a href="<?php echo G5_URL."/bbs/board.php?bo_table=qna"; ?>">고객만족센터</a></li>
                    <li class="inquiry"><a href="<?php echo G5_URL."/bbs/board.php?bo_table=error_board&parent_id=".$parent_id; ?>">수정요청게시판</a></li>
                    <?php if(!$is_mobile){?>
                    <li class="info"><a href="<?php echo G5_URL."/admin/"; ?>">PC관리 페이지</a></li>
                    <?php }?>
                    <?php }else{ ?>
                    <li class="home"><a href="<?php echo G5_URL; ?>">홈으로 바로가기</a></li>
                    <li class="register"><a href="<?php echo G5_BBS_URL."/register_form.php"; ?>">회원가입</a></li>
                    <li class="order"><a href="<?php echo G5_URL."/page/rent/order_find.php"; ?>">비회원 주문조회</a></li>
                    <li class="notice"><a href="<?php echo G5_URL."/bbs/board.php?bo_table=notice"; ?>">공지사항 및 이벤트</a></li>
                    <li class="info"><a href="<?php echo G5_URL."/page/guide/guide.php"; ?>">고파 안내</a></li>
                    <li class="inquiry"><a href="<?php echo G5_URL."/bbs/board.php?bo_table=qna"; ?>">고객만족센터</a></li>
                    <?php } ?>
					<!--<li><a href="<?php /*echo G5_URL."/page/guide/agreement.php"; */?>">이용약관</a></li>
					<li <?php /*if(!$is_admin && !$partner['id'] && !$branch['id']){ */?>class="last"<?/* } */?>><a href="<?php /*echo G5_URL."/page/guide/privacy.php"; */?>">개인정보취급방침</a></li>
					<?php /*if($is_admin || $partner['id'] || $branch['id']){ */?>
					<li class="last"><a href="<?php /*echo G5_URL."/admin"; */?>">관리자</a></li>
					--><?php /*} */?>
				</ul>
                <div class="copyright" style="">
                    <h3>DeliveryService</h3>
                    <p>Copyright ⓒ GOPA All Rights Reserved.</p>
                    <br>
                    <p>ver 0.0.1</p>
                </div>
			</div>
		</div>
		<!-- 모바일 메뉴 끝 -->
	</div>
    <div id="mobile_header" class="<?php echo $wr_id?"view_mode_on":"view_mode_off";?>">
        <span class="mobile_back_btn"><a href="javascript:fnBack('<?=$back_url?>');"></a></span>
        <h1><?php echo $wr_subject; ?></h1>
        <?php if(!$view_chk && $type!="shop"){?>
        <span class="mobile_favorite_btn" ></span>
        <span class="mobile_favorite_btn_on" ></span>
        <span class="mobile_cart_btn" ><a href="javascript:moveLink('cart','<?php echo $wr_id;?>');"></a></span>
            <div class="cart_count"><?=$cart_total?></div>
        <?php }else{ ?>
        <?php }?>
    </div>
	<!-- 모바일 헤더 끝 -->
</header>
<!-- 헤더끝 -->
<div class="msg"></div>
<div class="modal"></div>
<div class="container <?php echo $main?"main":"sub"; ?>">

