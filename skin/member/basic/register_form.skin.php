<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>
<script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
<?php if($config['cf_cert_use'] && ($config['cf_cert_ipin'] || $config['cf_cert_hp'])) { ?>
<script src="<?php echo G5_JS_URL ?>/certify.js"></script>
<?php } ?>
<div class="width-fixed">
	<section class="section01">
		<header class="section01_header">
			<h1><?php echo $w?"정보수정":"회원가입"; ?></h1>
			<h3 class="<?php echo $w?"register_modify_head":"register_form_head"; ?>"></h3>
			<p><?php echo $w?"수정할 정보를 입력해주세요.":"베스트 렌터카의 회원가입을 위한 필수정보를 입력해주세요."; ?></p>
		</header>
		<div class="section01_content wrap">
			<div id="register_form">
				<form id="fregisterform" name="fregisterform" action="<?php echo $register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
					<input type="hidden" name="w" value="<?php echo $w ?>">
					<input type="hidden" name="url" value="<?php echo $urlencode ?>">
					<input type="hidden" name="agree" value="<?php echo $agree ?>">
					<input type="hidden" name="agree2" value="<?php echo $agree2 ?>">
					<input type="hidden" name="cert_type" value="<?php echo $member['mb_certify']; ?>">
					<input type="hidden" name="cert_no" value="">
					<input type="hidden" name="regid" id="regid" value="">
					<?php if (isset($member['mb_sex'])) {  ?><input type="hidden" name="mb_sex" value="<?php echo $member['mb_sex'] ?>"><?php }  ?>
					<?php if (isset($member['mb_nick_date']) && $member['mb_nick_date'] > date("Y-m-d", G5_SERVER_TIME - ($config['cf_nick_modify'] * 86400))) { // 닉네임수정일이 지나지 않았다면  ?>
					<input type="hidden" name="mb_nick_default" value="<?php echo $member['mb_nick'] ?>">
					<input type="hidden" name="mb_nick" value="<?php echo $member['mb_nick'] ?>">
					<input type="hidden" name="mb_mailling" value="1" id="reg_mb_mailling"/>
					<input type="hidden" name="mb_sms" value="1" id="reg_mb_sms" />
					<?php }  ?>
					<div class="form_list01">
						<ul>
							<li>
								<div>
									<label for="reg_mb_id">아이디<span>*</span></label>
									<div>
										<input type="text" name="mb_id" value="<?php echo $member['mb_id'] ?>" id="reg_mb_id" <?php echo $required ?> <?php echo $readonly ?> class="input01" minlength="3" maxlength="20">
										<span id="msg_mb_id"></span>
									</div>
								</div>
							</li>
							<li>
								<div>
									<label for="reg_mb_id">성명<span>*</span></label>
									<div>
										<input type="text" name="mb_name" value="<?php echo $member['mb_name'] ?>" id="reg_mb_id" <?php echo $required ?> <?php echo $readonly ?> class="input01" minlength="3" maxlength="20">
										<span id="msg_mb_name"></span>
									</div>
								</div>
							</li>
							<li>
								<div class="bdr">
									<label for="reg_mb_password">비밀번호<span>*</span></label>
									<div><input type="password" name="mb_password" id="reg_mb_password" <?php echo $required ?> class="input01" minlength="3" maxlength="20"></div>
								</div>
								<div>
									<label for="reg_mb_password_re">비밀번호 확인<span>*</span></label>
									<div><input type="password" name="mb_password_re" id="reg_mb_password_re" <?php echo $required ?> class="input01" minlength="3" maxlength="20"></div>
								</div>
							</li>
							<li>
								<div class="bdr">
									<label for="reg_mb_hp">휴대폰번호<span>*</span></label>
									<div>
										<input type="text" name="mb_hp" value="<?php echo get_text($member['mb_hp']) ?>" id="reg_mb_hp" <?php echo ($config['cf_req_hp'])?"required":""; ?> onkeyup="return number_only(this);" class="input01" maxlength="20">
									</div>
									<?php if ($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
										<input type="hidden" name="old_mb_hp" value="<?php echo get_text($member['mb_hp']) ?>">
									<?php } ?>
								</div>
								<div>
									<label for="reg_mb_email">E-mail<span>*</span></label>
									<?php if ($config['cf_use_email_certify']) {  ?>
									<span class="frm_info">
										<?php if ($w=='') { echo "E-mail 로 발송된 내용을 확인한 후 인증하셔야 회원가입이 완료됩니다."; }  ?>
										<?php if ($w=='u') { echo "E-mail 주소를 변경하시면 다시 인증하셔야 합니다."; }  ?>
									</span>
									<?php }  ?>
									<input type="hidden" name="old_email" value="<?php echo $member['mb_email'] ?>">
									<div><input type="email" name="mb_email" value="<?php echo isset($member['mb_email'])?$member['mb_email']:''; ?>" id="reg_mb_email" required class="input01" maxlength="100"></div>
								</div>
							</li>
						</ul>
						<p><span>*</span> 는 필수입력사항입니다.</p>
					</div>
					<?php if(!$w){ ?><p><input type="checkbox" name="agree" id="agree" class="check01" /><label for="agree" class="check01_label"></label><label for="agree"><a href="<?php echo G5_URL."/page/guide/agreement.php"; ?>">이용약관</a>과 <a href="<?php echo G5_URL."/page/guide/privacy.php";?>">개인정보취급방침</a>에 동의합니다.</label></p><?php } ?>
					<div class="btn_group01">
						<?php if(!$w){ ?><a href="<?php echo G5_URL ?>" class="bg_lightgray btn color_white grid_50">취소</a><?php }else{ ?><a href="<?php echo G5_BBS_URL."/member_leave.php" ?>" class="bg_lightgray btn color_white grid_50">회원탈퇴</a><?php } ?>
						<input type="submit" value="<?php echo $w==''?'회원가입':'정보수정'; ?>" class="bg_darkred btn color_white grid_50" accesskey="s">
					</div>
				</form>
			</div>
		</div>
	</section>
</div>
<script>
$(function(){
	//getRegid
	try{
		var regId = window.android.getRegid();
		console.log(regId);
		$("#regid").val(regId);
	}catch(err){
		var regId = undefined;
		console.log(err);
	}
});
$(function() {
	$("#reg_zip_find").css("display", "inline-block");

	<?php if($config['cf_cert_use'] && $config['cf_cert_ipin']) { ?>
	// 아이핀인증
	$("#win_ipin_cert").click(function() {
		if(!cert_confirm())
			return false;

		var url = "<?php echo G5_OKNAME_URL; ?>/ipin1.php";
		certify_win_open('kcb-ipin', url);
		return;
	});

	<?php } ?>
	<?php if($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
	// 휴대폰인증
	$("#win_hp_cert").click(function() {
		if(!cert_confirm())
			return false;

		<?php
		switch($config['cf_cert_hp']) {
			case 'kcb':
				$cert_url = G5_OKNAME_URL.'/hpcert1.php';
				$cert_type = 'kcb-hp';
				break;
			case 'kcp':
				$cert_url = G5_KCPCERT_URL.'/kcpcert_form.php';
				$cert_type = 'kcp-hp';
				break;
			case 'lg':
				$cert_url = G5_LGXPAY_URL.'/AuthOnlyReq.php';
				$cert_type = 'lg-hp';
				break;
			default:
				echo 'alert("기본환경설정에서 휴대폰 본인확인 설정을 해주십시오");';
				echo 'return false;';
				break;
		}
		?>

		certify_win_open("<?php echo $cert_type; ?>", "<?php echo $cert_url; ?>");
		return;
	});
	<?php } ?>
});

// submit 최종 폼체크
function fregisterform_submit(f)
{
	// 회원아이디 검사
	if (f.w.value == "") {
		var msg = reg_mb_id_check();
		if (msg) {
			alert(msg);
			f.mb_id.select();
			return false;
		}
	}

	if (f.w.value == "") {
		if (f.mb_password.value.length < 3) {
			alert("비밀번호를 3글자 이상 입력하십시오.");
			f.mb_password.focus();
			return false;
		}
	}

	if (f.mb_password.value != f.mb_password_re.value) {
		alert("비밀번호가 같지 않습니다.");
		f.mb_password_re.focus();
		return false;
	}

	if (f.mb_password.value.length > 0) {
		if (f.mb_password_re.value.length < 3) {
			alert("비밀번호를 3글자 이상 입력하십시오.");
			f.mb_password_re.focus();
			return false;
		}
	}

	// 이름 검사
	if (f.w.value=="") {
		if (f.mb_name.value.length < 1) {
			alert("이름을 입력하십시오.");
			f.mb_name.focus();
			return false;
		}
		/*
		var pattern = /([^가-힣\x20])/i;
		if (pattern.test(f.mb_name.value)) {
			alert("이름은 한글로 입력하십시오.");
			f.mb_name.select();
			return false;
		}
		*/
		
	}

	<?php if($w == '' && $config['cf_cert_use'] && $config['cf_cert_req']) { ?>
	// 본인확인 체크
	if(f.cert_no.value=="") {
		alert("회원가입을 위해서는 본인확인을 해주셔야 합니다.");
		return false;
	}
	<?php } ?>
	/*
	// 닉네임 검사
	if ((f.w.value == "") || (f.w.value == "u" && f.mb_nick.defaultValue != f.mb_nick.value)) {
		var msg = reg_mb_nick_check();
		if (msg) {
			alert(msg);
			f.reg_mb_nick.select();
			return false;
		}
	}
*/
	// E-mail 검사
	if ((f.w.value == "") || (f.w.value == "u" && f.mb_email.defaultValue != f.mb_email.value)) {
		var msg = reg_mb_email_check();
		if (msg) {
			alert(msg);
			f.reg_mb_email.select();
			return false;
		}
	}

	<?php if (($config['cf_use_hp'] || $config['cf_cert_hp']) && $config['cf_req_hp']) {  ?>
	// 휴대폰번호 체크
	var msg = reg_mb_hp_check();
	if (msg) {
		alert(msg);
		f.reg_mb_hp.select();
		return false;
	}
	<?php } ?>

	if (typeof f.mb_icon != "undefined") {
		if (f.mb_icon.value) {
			if (!f.mb_icon.value.toLowerCase().match(/.(gif)$/i)) {
				alert("회원아이콘이 gif 파일이 아닙니다.");
				f.mb_icon.focus();
				return false;
			}
		}
	}

	if (typeof(f.mb_recommend) != "undefined" && f.mb_recommend.value) {
		if (f.mb_id.value == f.mb_recommend.value) {
			alert("본인을 추천할 수 없습니다.");
			f.mb_recommend.focus();
			return false;
		}

		var msg = reg_mb_recommend_check();
		if (msg) {
			alert(msg);
			f.mb_recommend.select();
			return false;
		}
	}

	<?php echo chk_captcha_js();  ?>

	document.getElementById("btn_submit").disabled = "disabled";

	return true;
}
</script>
<!-- } 회원정보 입력/수정 끝 -->