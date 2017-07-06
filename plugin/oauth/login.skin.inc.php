<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if((defined('G5_NAVER_OAUTH_CLIENT_ID') && G5_NAVER_OAUTH_CLIENT_ID) || (defined('G5_KAKAO_OAUTH_REST_API_KEY') && G5_KAKAO_OAUTH_REST_API_KEY) || (defined('G5_FACEBOOK_CLIENT_ID') && G5_FACEBOOK_CLIENT_ID) || (defined('G5_GOOGLE_CLIENT_ID') && G5_GOOGLE_CLIENT_ID)) {

//add_stylesheet('<link rel="stylesheet" href="'.G5_PLUGIN_URL.'/oauth/style.css">', 10);
add_javascript('<script src="'.G5_PLUGIN_URL.'/oauth/jquery.oauth.login.js"></script>', 10);

$social_oauth_url = G5_PLUGIN_URL.'/oauth/login.php?service=';

if (preg_match('/(iPhone|Android|iPod|BlackBerry|IEMobile|HTC|Server_KO_SKT|SonyEricssonX1|SKT)/',
    $_SERVER['HTTP_USER_AGENT']) ) {
    define('BROWSER_TYPE', 'M'); // mobile
} else {
    define('BROWSER_TYPE', 'W'); // web (iPad 는 웹으로 간주)
}
$mobile=false;
if(BROWSER_TYPE == "M")
{
   $mobile=true;
}
?>
<div class="<?php echo (G5_IS_MOBILE ? 'm-' : ''); ?>login-sns sns-wrap-32 sns-wrap-over">
    <div class="sns-wrap">
        <?php if(defined('G5_NAVER_OAUTH_CLIENT_ID') && G5_NAVER_OAUTH_CLIENT_ID) { ?>
        <a href="<?php echo $social_oauth_url.'naver'; ?>" target="_blank" class="sns-icon social_oauth sns-naver"><span class="ico"></span><span class="txt">네이버 로그인</span></a>
        <?php } ?>
        <?php if(defined('G5_KAKAO_OAUTH_REST_API_KEY') && G5_KAKAO_OAUTH_REST_API_KEY) { ?>
            <input type="button" class="grid_100 btn kakao" value="카카오톡 로그인" onclick="<?php if($mobile){ echo "location.href='".$social_oauth_url."kakao'"; } else { echo "alert('모바일로 이용바랍니다.');"; } ?>">
        <?php } ?>
        <?php if(defined('G5_FACEBOOK_CLIENT_ID') && G5_FACEBOOK_CLIENT_ID) { ?>
            <input type="button" class="grid_100 btn facebook" value="페이스북 로그인" onclick="<?php if($mobile){ echo "location.href='".$social_oauth_url."facebook'"; }else{echo "alert('모바일로 이용바랍니다.')"; } ?>">
        <?php } ?>
        <?php if(defined('G5_GOOGLE_CLIENT_ID') && G5_GOOGLE_CLIENT_ID) { ?>
        <a href="<?php echo $social_oauth_url.'google'; ?>" target="_blank" class="sns-icon social_oauth sns-gg"><span class="ico"></span><span class="txt">구글 로그인</span></a>
        <?php } ?>
    </div>
</div>
<?php
}
?>