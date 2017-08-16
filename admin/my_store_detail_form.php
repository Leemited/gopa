<?php
include_once("../common.php");
$wr_id=$_REQUEST["wr_id"];
$view=sql_fetch("select a.*,b.* from `g5_write_main` as a left join `store_detail` as b on a.wr_id = b.wr_id where a.wr_id='{$wr_id}' ");

$open = explode(":", $view["open_time"]);
$close = explode(":", $view["close_time"]);
$file = get_file("main", $wr_id);
include_once(G5_PATH."/admin/head.php");
?>
    <style>
        img.info{
            position: absolute;
            width:30px;
            left:10px;
            top:6px;
        }
        .shop_img_add_btn{padding:10px;font-size:15px;color:#FFF;}
        .add_img_group{padding:10px 0;width: 100%;text-align: center;display: block}
        .add_img_group > input{border:none;}
        #view_section_info h2.detail_title{padding-left:50px;}
        @media all and (max-width: 480px){
            .add_img_group {width:100%;}
            #view_section_info .section01_content dt{width:100%}
            #view_section_info .section01_content dd{width:98%}
        }
    </style>
    <div id="wrap">
        <section>
            <header id="admin-title">
                <h1>상점정보수정</h1>
                <hr />
            </header>

            <form action="<?php echo G5_BBS_URL;?>/write_update.php" enctype="multipart/form-data" method="post" name="imgForm">
                <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
                <input type="hidden" name="w" value="u">
                <input type="hidden" name="bo_table" value="main">
                <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
                <input type="hidden" name="wr_subject" value="<?php echo $view['wr_subject'] ?>">
                <input type="hidden" name="wr_content" value="<?php echo $view["store_detail"]?$view["store_detail"]:"내용을 입력하세요"; ?>">
                <input type="hidden" name="wr_3" value="<?php echo $view["wr_3"]; ?>">
                <input type="hidden" name="wr_4" value="<?php echo $view["wr_4"]; ?>">
                <input type="hidden" name="wr_5" value="<?php echo $view["wr_5"]; ?>">
                <input type="hidden" name="wr_7" value="<?php echo $view["wr_7"]; ?>">
                <section class="section01" id="view_section_info" style="padding-bottom:0">
                    <div class="section01_header">
                        <div ><img class="info" src="<?=G5_IMG_URL?>/store_detail_info_icon.png"><h2 class="detail_title">매장사진등록</h2></div>
                    </div>
                    <div class="section01_content">
                        <!-- <div id="view-slide" class="owl-carousel">
                    <?php
                        /*                    for($i=0;$i<count($file)-1;$i++){
                                            */?>
                        <div class="item"><img src="<?php /*echo G5_DATA_URL."/file/main/".$file[$i]['file']; */?>" alt=""></div>
                    <?php /*} */?>
                </div>-->
                        <dl>
                            <dt>메인사진</dt>
                            <dd style="position: relative;" >
                                <div style="text-align: center">
                                    <img src="<?php echo G5_DATA_URL."/file/main/".$file[0]['file']; ?>" alt="" >
                                </div>
                                <input type="file" name="bf_file[]" id="main_file" value="" class="input01 grid_100 input_file" accept="image/*" onchange="$(this).next().val(this.value)">
                                <input type="text" readonly style="" class="input01 file_text" value="<?=$file[0]['file'];?>">
                                <label for="main_file" style="" id="main_file_label" class="input01">등록</label>
                            </dd>
                            <?php if($view["wr_7"]==0){?>
                                <dt style="position: relative;">서브사진 1</dt>
                                <dd style="position: relative;">
                                    <input type="file" name="bf_file[]" id="sub_file1" value="" class="input01 grid_100 input_file"  accept="image/*" onchange="$(this).next().val(this.value)">
                                    <input type="text" readonly style="" class="input01 file_text" value="<?=$file[1]['file'];?>">
                                    <label for="sub_file1" style="" id="main_file_label" class="input01">등록</label>
                                    <?php if($file[1]['file']) { ?>
                                        <input type="checkbox" id="bf_file_del1" name="bf_file_del[1]" value="1"> <label for="bf_file_del1"><?php echo $file[1]['source'].'('.$file[1]['size'].')';  ?> 파일 삭제</label>
                                    <?php } ?>
                                </dd>
                                <dt>서브사진 2</dt>
                                <dd style="position: relative;">
                                    <input type="file" name="bf_file[]" id="sub_file2" value="" class="input01 grid_100 input_file"  accept="image/*" onchange="$(this).next().val(this.value)">
                                    <input type="text" readonly style="" class="input01 file_text" value="<?=$file[2]['file'];?>">
                                    <label for="sub_file2" style="" id="main_file_label" class="input01">등록</label>
                                    <?php if($file[2]['file']) { ?>
                                        <input type="checkbox" id="bf_file_del2" name="bf_file_del[2]" value="1"> <label for="bf_file_del2"><?php echo $file[2]['source'].'('.$file[2]['size'].')';  ?> 파일 삭제</label>
                                    <?php } ?>
                                </dd>
                                <dt>서브사진 3</dt>
                                <dd style="position: relative;">
                                    <input type="file" name="bf_file[]" id="sub_file3" value="" class="input01 grid_100 input_file"  accept="image/*" onchange="$(this).next().val(this.value)">
                                    <input type="text" readonly style="" class="input01 file_text" value="<?=$file[3]['file'];?>">
                                    <label for="sub_file3" style="" id="main_file_label" class="input01">등록</label>
                                    <?php if($file[3]['file']) { ?>
                                        <input type="checkbox" id="bf_file_del3" name="bf_file_del[3]" value="1"> <label for="bf_file_del1"><?php echo $file[3]['source'].'('.$file[3]['size'].')';  ?> 파일 삭제</label>
                                    <?php } ?>
                                </dd>
                                <dt>서브사진 4 </dt>
                                <dd style="position: relative;">
                                    <input type="file" name="bf_file[]" id="sub_file4" value="" class="input01 grid_100 input_file"  accept="image/*" onchange="$(this).next().val(this.value)">
                                    <input type="text" readonly style="" class="input01 file_text" value="<?=$file[4]['file'];?>">
                                    <label for="sub_file4" style="" id="main_file_label" class="input01">등록</label>
                                    <?php if($file[4]['file']) { ?>
                                        <input type="checkbox" id="bf_file_del4" name="bf_file_del[4]" value="1"> <label for="bf_file_del4"><?php echo $file[4]['source'].'('.$file[4]['size'].')';  ?> 파일 삭제</label>
                                    <?php } ?>
                                </dd>
                            <?php }else {?>
                        </dl><dl class="add_files">
                            <?php for ($i = 1; $i < count($file)-1; $i++) {
                                ?>
                                <dt>서브사진<?=$i?></dt>
                                <dd style="position: relative;">
                                    <input type="file" name="bf_file[]" id="sub_file<?=$i?>" value="" class="input01 grid_100 input_file" accept="image/*" onchange="$(this).next().val(this.value)">
                                    <input type="text" readonly style="" class="input01 file_text" value="<?= $file[$i]['file']; ?>">
                                    <label for="sub_file<?=$i?>" style="" id="main_file_label" class="input01">등록</label>
                                    <?php if($file[$i]['file']) { ?>
                                        <input type="checkbox" id="bf_file_del<?php echo $i;?>" name="bf_file_del[<?php echo $i;?>]" value="1"> <label for="bf_file_del<?php echo $i;?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제</label>
                                    <?php } ?>
                                </dd>
                            <?php }?>

                            <?php }?>
                        </dl>
                        <?php if($view["wr_7"]==1){?>
                            <div class="add_img_group">
                                <input type="button" value="사진추가" class="input01 btn" onclick="fnaddfile()" style="width:150px;background:#ffce31;text-align: center;margin:0 auto">
                            </div>
                        <?php } ?>
                    </div>
                    <div class="shop_btn_group">
                        <input type="submit" value="등록" class="btn shop_img_add_btn bg_darkred grid_100">
                    </div>
                </section>
            </form>
            <form action="<?php echo G5_URL?>/admin/my_store_detail_update.php" method="post" name="store_detail_form" enctype="multipart/form-data" >
                <input type="hidden" name="detail_id" value="<?php echo $view["detail_id"];?>">
                <input type="hidden" name="wr_id" value="<?php echo $view["wr_id"];?>">
                <section class="section01" id="view_section_info" style="padding-bottom:0">
                    <div class="section01_header">
                        <div ><img class="info" src="<?=G5_IMG_URL?>/store_detail_info_icon.png"><h2 class="detail_title">매장정보</h2></div>
                    </div>
                    <div class="section01_content">
                        <dl>
                            <dt>전화번호</dt>
                            <dd><input type="text" name="store_hp" value="<?=$view["store_hp"]?>" class="input01 grid_100" onkeyup="number_only(this)"></dd>
                            <dt>주소 </dt>
                            <dd>
                                <input type="button" value="주소찾기" onclick="DaumPostcode()" class="btn input01">
                                <div id="search_addr" style="width:100%;"></div>
                                <input type="text" name="store_zip"  value="<?=$view["store_zip"]?>" readonly class="input01 grid_100" id="sample2_postcode" >
                                <input type="text" name="store_addr1"  value="<?=$view["store_addr1"]?>" readonly class="input01 grid_100" id="sample2_address">
                                <input type="text" name="store_addr2"  value="<?=$view["store_addr2"]?>" class="input01 grid_100" id="sample2_address2" >
                                <input type="hidden" name="store_zip2"  value="<?=$view["store_zip"]?>" readonly class="input01 grid_100" id="sample2_postcode3" >
                                <input type="hidden" name="store_addr3"  value="<?=$view["store_addr1"]?>" readonly class="input01 grid_100" id="sample2_address3">
                            </dd>
                            <dt>운영시간(open)</dt>
                            <dd>
                                <select name="open_t" id="open_t" class="input01">
                                    <option value="00" <?php if($open[0]=="00"){?>selected<?php }?>>00</option>
                                    <option value="01" <?php if($open[0]=="01"){?>selected<?php }?>>01</option>
                                    <option value="02" <?php if($open[0]=="02"){?>selected<?php }?>>02</option>
                                    <option value="03" <?php if($open[0]=="03"){?>selected<?php }?>>03</option>
                                    <option value="04" <?php if($open[0]=="04"){?>selected<?php }?>>04</option>
                                    <option value="05" <?php if($open[0]=="05"){?>selected<?php }?>>05</option>
                                    <option value="06" <?php if($open[0]=="06"){?>selected<?php }?>>06</option>
                                    <option value="07" <?php if($open[0]=="07"){?>selected<?php }?>>07</option>
                                    <option value="08" <?php if($open[0]=="08"){?>selected<?php }?>>08</option>
                                    <option value="09" <?php if($open[0]=="09"){?>selected<?php }?>>09</option>
                                    <option value="10" <?php if($open[0]=="10"){?>selected<?php }?>>10</option>
                                    <option value="11" <?php if($open[0]=="11"){?>selected<?php }?>>11</option>
                                    <option value="12" <?php if($open[0]=="12"){?>selected<?php }?>>12</option>
                                    <option value="13" <?php if($open[0]=="13"){?>selected<?php }?>>13</option>
                                    <option value="14" <?php if($open[0]=="14"){?>selected<?php }?>>14</option>
                                    <option value="15" <?php if($open[0]=="15"){?>selected<?php }?>>15</option>
                                    <option value="16" <?php if($open[0]=="16"){?>selected<?php }?>>16</option>
                                    <option value="17" <?php if($open[0]=="17"){?>selected<?php }?>>17</option>
                                    <option value="18" <?php if($open[0]=="18"){?>selected<?php }?>>18</option>
                                    <option value="19" <?php if($open[0]=="19"){?>selected<?php }?>>19</option>
                                    <option value="20" <?php if($open[0]=="20"){?>selected<?php }?>>20</option>
                                    <option value="21" <?php if($open[0]=="21"){?>selected<?php }?>>21</option>
                                    <option value="22" <?php if($open[0]=="22"){?>selected<?php }?>>22</option>
                                    <option value="23" <?php if($open[0]=="23"){?>selected<?php }?>>23</option>
                                </select> 시
                                <select name="open_m" id="open_t" class="input01">
                                    <option value="00" <?php if($open[1]=="00"){?>selected<?php }?>>00</option>
                                    <option value="05" <?php if($open[1]=="05"){?>selected<?php }?>>05</option>
                                    <option value="10" <?php if($open[1]=="10"){?>selected<?php }?>>10</option>
                                    <option value="15" <?php if($open[1]=="15"){?>selected<?php }?>>15</option>
                                    <option value="20" <?php if($open[1]=="20"){?>selected<?php }?>>20</option>
                                    <option value="25" <?php if($open[1]=="25"){?>selected<?php }?>>25</option>
                                    <option value="30" <?php if($open[1]=="30"){?>selected<?php }?>>30</option>
                                    <option value="35" <?php if($open[1]=="35"){?>selected<?php }?>>35</option>
                                    <option value="40" <?php if($open[1]=="40"){?>selected<?php }?>>40</option>
                                    <option value="45" <?php if($open[1]=="45"){?>selected<?php }?>>45</option>
                                    <option value="50" <?php if($open[1]=="50"){?>selected<?php }?>>50</option>
                                    <option value="55" <?php if($open[1]=="55"){?>selected<?php }?>>55</option>
                                </select> 분
                            </dd>
                            <dt>운영시간(close)</dt>
                            <dd>
                                <select name="close_t" id="close_t" class="input01">
                                    <option value="00" <?php if($close[0]=="00"){?>selected<?php }?>>00</option>
                                    <option value="01" <?php if($close[0]=="01"){?>selected<?php }?>>01</option>
                                    <option value="02" <?php if($close[0]=="02"){?>selected<?php }?>>02</option>
                                    <option value="03" <?php if($close[0]=="03"){?>selected<?php }?>>03</option>
                                    <option value="04" <?php if($close[0]=="04"){?>selected<?php }?>>04</option>
                                    <option value="05" <?php if($close[0]=="05"){?>selected<?php }?>>05</option>
                                    <option value="06" <?php if($close[0]=="06"){?>selected<?php }?>>06</option>
                                    <option value="07" <?php if($close[0]=="07"){?>selected<?php }?>>07</option>
                                    <option value="08" <?php if($close[0]=="08"){?>selected<?php }?>>08</option>
                                    <option value="09" <?php if($close[0]=="09"){?>selected<?php }?>>09</option>
                                    <option value="10" <?php if($close[0]=="10"){?>selected<?php }?>>10</option>
                                    <option value="11" <?php if($close[0]=="11"){?>selected<?php }?>>11</option>
                                    <option value="12" <?php if($close[0]=="12"){?>selected<?php }?>>12</option>
                                    <option value="13" <?php if($close[0]=="13"){?>selected<?php }?>>13</option>
                                    <option value="14" <?php if($close[0]=="14"){?>selected<?php }?>>14</option>
                                    <option value="15" <?php if($close[0]=="15"){?>selected<?php }?>>15</option>
                                    <option value="16" <?php if($close[0]=="16"){?>selected<?php }?>>16</option>
                                    <option value="17" <?php if($close[0]=="17"){?>selected<?php }?>>17</option>
                                    <option value="18" <?php if($close[0]=="18"){?>selected<?php }?>>18</option>
                                    <option value="19" <?php if($close[0]=="19"){?>selected<?php }?>>19</option>
                                    <option value="20" <?php if($close[0]=="20"){?>selected<?php }?>>20</option>
                                    <option value="21" <?php if($close[0]=="21"){?>selected<?php }?>>21</option>
                                    <option value="22" <?php if($close[0]=="22"){?>selected<?php }?>>22</option>
                                    <option value="23" <?php if($close[0]=="23"){?>selected<?php }?>>23</option>
                                </select> 시
                                <select name="close_m" id="close_t" class="input01">
                                    <option value="00" <?php if($close[1]=="00"){?>selected<?php }?>>00</option>
                                    <option value="05" <?php if($close[1]=="05"){?>selected<?php }?>>05</option>
                                    <option value="10" <?php if($close[1]=="10"){?>selected<?php }?>>10</option>
                                    <option value="15" <?php if($close[1]=="15"){?>selected<?php }?>>15</option>
                                    <option value="20" <?php if($close[1]=="20"){?>selected<?php }?>>20</option>
                                    <option value="25" <?php if($close[1]=="25"){?>selected<?php }?>>25</option>
                                    <option value="30" <?php if($close[1]=="30"){?>selected<?php }?>>30</option>
                                    <option value="35" <?php if($close[1]=="35"){?>selected<?php }?>>35</option>
                                    <option value="40" <?php if($close[1]=="40"){?>selected<?php }?>>40</option>
                                    <option value="45" <?php if($close[1]=="45"){?>selected<?php }?>>45</option>
                                    <option value="50" <?php if($close[1]=="50"){?>selected<?php }?>>50</option>
                                    <option value="55" <?php if($close[1]=="55"){?>selected<?php }?>>55</option>
                                </select> 분
                            </dd>
                            <dt>휴무</dt>
                            <dd><input type="text" name="store_holiy" value="<?=$view["holiday"]?>" class="input01 grid_100"></dd>
                            <?php if($view["wr_7"]==1){?>
                                <dt>소개영상 링크</dt>
                                <dd>
                                    <div class='embed-container'>
                                        <?php echo $view["video_link"];?>
                                    </div>
                                    <input type="text" name="video_link" value="<?=htmlentities($view["video_link"]);?>" class="input01 grid_100" placeholder="ex) <iframe width='560' height='315' src='링크주소' frameborder='0'></iframe>">
                                </dd>
                                <dt>추가사진</dt>
                                <dd>
                                    <input type="file" name="etc3" id="etc3" value="" class="input01 grid_100 input_file" accept="image/*" onchange="$(this).next().val(this.value)">
                                    <input type="text" readonly style="" class="input01 file_text" value="<?= $view['etc3']; ?>">
                                    <label for="etc3" id="main_file_label" class="input01">등록</label>
                                </dd>
                            <?php }?>
                            <dt>소개</dt>
                            <dd><textarea name="store_content" cols="30" class="grid_100" style="height:300px;border:1px solid #ddd"><?php echo $view["store_detail"]?$view["store_detail"]:$view["wr_content"];?></textarea></dd>
                        </dl>
                    </div>
                </section>
                <section class="section01" id="view_section_info" >
                    <div class="section01_header">
                        <div><img class="info" src="<?=G5_IMG_URL?>/store_detail_delivery_icon.png"><h2 class="detail_title">배달정보</h2></div>
                    </div>
                    <div class="section01_content">
                        <dl>
                            <dt>배달여부</dt>
                            <dd>
                                <select name="store_delivery" class="input01 grid_100">
                                    <option value="1" <?php if($view["delivery"]==1){ ?>selected<?php }?>>가능</option>
                                    <option value="0" <?php if($view["delivery"]==0){ ?>selected<?php }?>>불가능</option>
                                </select>
                            </dd>
                            <dt>배달가능지역</dt>
                            <dd><input type="text" name="store_delivery_location" value="<?php echo $view["delivery_location"];?>" class="input01 grid_100"></dd>
                            <dt>배달가능금액</dt>
                            <dd><input type="text" name="store_delivery_price" value="<?php echo $view["delivery_price"];?>" class="input01 grid_100"></dd>
                        </dl>
                    </div>
                </section>
                <section class="section01" id="view_section_info">
                    <div class="section01_header">
                        <div><img class="info" src="<?=G5_IMG_URL?>/store_detail_order_icon.png"><h2 class="detail_title">결제정보</h2></div>
                    </div>
                    <div class="section01_content">
                        <dl>
                            <dt>결제수단</dt>
                            <dd><input type="text" name="order_type" value="<?php echo $view["order_type"]?>" class="input01 grid_100"></dd>
                            <dt>포인트</dt>
                            <dd><input type="text" name="point" value="<?php echo $view["point"]?>" class="input01 grid_100"></dd>
                        </dl>
                    </div>
                </section>
                <section class="section01" id="view_section_info">
                    <div class="section01_header">
                        <div><img class="info" src="<?=G5_IMG_URL?>/store_detail_etc_icon.png"><h2 class="detail_title">부가정보</h2></div>
                    </div>
                    <div class="section01_content">
                        <dl>
                            <dt>예약/단체</dt>
                            <dd><input type="text" name="store_reserve" value="<?php echo $view["other"]?>" class="input01 grid_100"></dd>
                            <dt>홈페이지</dt>
                            <dd><input type="text" name="store_homepage" value="<?php echo $view["store_homepage"]?$view["store_homepage"]:$view["wr_homepage"];?>" class="input01 grid_100"></dd>
                            <dt>흡연</dt>
                            <dd><input type="text" name="store_smoke" value="<?php echo $view["smoke_area"]?>" class="input01 grid_100"></dd>
                            <dt>주차장</dt>
                            <dd><input type="text" name="store_parking" value="<?php echo $view["parking"]?>" class="input01 grid_100"></dd>
                        </dl>
                    </div>
                </section>
                <section class="section01" id="view_section_info" style="padding-bottom: 0px;margin-bottom:0px;">
                    <div class="section01_header">
                        <div><img class="info" src="<?=G5_IMG_URL?>/store_detail_oring_icon.png"><h2 class="detail_title">제품 표기</h2></div>
                    </div>
                    <div class="section01_content" >
                        <dl>
                            <dt>원산지정보</dt>
                            <dd><textarea name="store_oring" cols="30" class="grid_100" style="height:150px;border:1px solid #ddd"><?php echo $view["oring_mark"]; ?></textarea></dd>
                            <dt>알레르기유발정보</dt>
                            <dd><textarea name="etc1" cols="30" class="grid_100" style="height:150px;border:1px solid #ddd"><?php echo $view["etc1"]; ?></textarea></dd>
                            <dt>영양성분정보</dt>
                            <dd><textarea name="etc2" cols="30" class="grid_100" style="height:150px;border:1px solid #ddd"><?php echo $view["etc2"]; ?></textarea></dd>
                        </dl>
                    </div>
                </section>
                <div class="shop_btn_group last" style="margin-bottom:20px">
                    <input type="submit" value="수정" class="btn shop_img_add_btn bg_darkred grid_100">
                </div>
            </form>
        </section>
    </div>
    <div style="display: none" class="add_file_item">
        <dt>서브사진</dt>
        <dd style="position: relative;">
            <input type="file" name="bf_file[]" id="sub_file" value="" class="input01 grid_100 input_file" accept="image/*" onchange="$(this).next().val(this.value)">
            <input type="text" readonly style="" class="input01 file_text" value="">
            <label for="sub_file" style="" id="main_file_label" class="input01">등록</label>
        </dd>
    </div>
    <script src="<?php echo G5_JS_URL ?>/owl.carousel.js"></script>

    <script>
        $(".owl-carousel").owlCarousel({
            autoplay:true,
            autoplayTimeout:5000,
            autoplaySpeed:2000,
            smartSpeed:2000,
            autoHeight:false,
            loop:true,
            dots:true,
            items:1
        });
        function fnaddfile(){
            var count = $("input[id^=sub_file]").length;

            var item = $(".add_file_item").clone();
            var itemHtml = item.html();
            var inItem = itemHtml.replace("서브사진","서브사진 "+count);
            inItem = inItem.replace("sub_file", "sub_file"+count);
            inItem = inItem.replace("for=\"sub_file\"", "for=\"sub_file"+count+"\"");

            $(".add_files").append(inItem);
        }
    </script>
<?php
include_once(G5_PATH."/admin/tail.php");
?>