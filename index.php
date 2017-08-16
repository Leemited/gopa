<?php
include_once("./common.php");

if($member["mb_level"]==5 || $type=="shop"){
    goto_url(G5_URL."/page/shop/index.php?type=shop");
}

include_once(G5_LIB_PATH.'/thumbnail.lib.php');
include_once(G5_PATH."/head.php");

$rand = rand(0,4);
$index_title = array("죄송합니다. 아직 판매점이 많지 않네요.","지금은 준비중인 판매점이 없나봐요!!","판매 준비중입니다. 조금만 기다려주세요!", "지금 보는 화면이 현실일까요?" , "판매점을 불러오는 중... 로딩 0.00001%");

$query=sql_query("select a.*, b.* from g5_write_main as a left join store_detail as b on a.wr_id = b.wr_id where a.wr_is_comment=0 and a.wr_file != 0 and a.wr_6 = 'Y' order by a.wr_1 asc, a.wr_5 desc");
while($data=sql_fetch_array($query)){
    $list[]=$data;
}

$now=date("Y-m-d h:i:s");
$event_sql="SELECT * FROM  `g5_write_main` WHERE  `wr_1`<='$now' and `wr_2`>='$now' and `wr_3` = 'Y' order by wr_1 , wr_2 limit 0, 5 ";
$event_query=sql_query($event_sql);
while($event_data=sql_fetch_array($event_query)){
    $event_list[]=$event_data;
}
$banner_row=sql_query("select * from `banner_list` where `seq` >= 0 group by `seq`");
while($data1=sql_fetch_array($banner_row)){
    $banner[] = $data1;
}

?>
    <div class="width-fixed">
        <div class="select-all">
            <div class="accordion">
                <h1 class="loc harf-first title">지역 <img src="<?php echo G5_IMG_URL; ?>/arrow.png" alt="select-arrow"></h1>
                <div class="opened-for-codepen harf" id="location_cate">
                    <h2 class="all">전체보기</h2>
                    <h2>상당구</h2>
                    <!--<ul class="opened-for-codepen price ">
                        <li>낭성면</li>
                        <li>미원면</li>
                        <li>가덕면</li>
                        <li>남일면</li>
                        <li>문의면</li>
                        <li>중앙동</li>
                        <li>성안동</li>
                        <li>탑대성동</li>
                        <li>영운동</li>
                        <li>금천동</li>
                        <li>용담명암산성동</li>
                        <li>용암1동</li>
                        <li>용암2동</li>
                    </ul>-->
                    <h2>서원구</h2>
                    <!--<ul class="opened-for-codepen price ">
                        <li>남이면</li>
                        <li>현도면</li>
                        <li>사직1동</li>
                        <li>사직2동</li>
                        <li>사창동</li>
                        <li>모충동</li>
                        <li>분평동</li>
                        <li>산남동</li>
                        <li>수곡1동</li>
                        <li>수곡2동</li>
                        <li>성화개신죽림동</li>
                    </ul>-->
                    <h2>청원구</h2>
                    <!--<ul class="opened-for-codepen price">
                        <li>내수읍</li>
                        <li>오창읍</li>
                        <li>북이면</li>
                        <li>우암동</li>
                        <li>내덕1동</li>
                        <li>내덕2동</li>
                        <li>율량사천동</li>
                        <li>오근장동</li>
                    </ul>-->
                    <h2>흥덕구</h2>
                    <!--<ul class="opened-for-codepen">
                        <li>오송읍</li>
                        <li>강내면</li>
                        <li>옥산면</li>
                        <li>운천신봉동</li>
                        <li>복대1동</li>
                        <li>복대2동</li>
                        <li>가경동</li>
                        <li>봉명1동</li>
                        <li>봉명2송정동</li>
                        <li>강서1동</li>
                        <li>강서2동</li>
                    </ul>-->
                </div>
                <h1 class="harf-first center-acc">업종 <img src="<?php echo G5_IMG_URL;?>/arrow.png" alt="select-arrow"></h1>
                <div class="opened-for-codepen harf-first">
                    <h2 class="line">전체보기</h2>
                    <h2>카페/디저트</h2>
                    <h2 class="line">한식/분식</h2>
                    <h2>중식</h2>
                    <h2 class="line">고기/족발/보쌈</h2>
                    <h2>치킨/피자</h2>
                    <h2 class="line">패스트푸드</h2>
                    <h2>야식/찜/탕</h2>
                    <h2 class="line">도시락/죽/기타</h2>
                    <h2>회/돈까스/일식</h2>
                </div>
                <h1 class="harf title" id="ordertypes">가맹점 <img src="<?php echo G5_IMG_URL; ?>/arrow.png" alt="select-arrow"></h1>
                <div class="opened-for-codepen harf pay" id="order_cate">
                    <h2>전체보기</h2>
                    <h2>고파페이</h2>
                    <h2>현장결제</h2>
                    <h2>주문결제</h2>
                    <h2>통합포인트</h2>
                    <h2>단독포인트</h2>
                </div>
            </div>
        </div>
        <div style="clear: both;"></div>
        <div class="sel-align">
            <div class="select-align">
                <input type="radio" name="align" id="new" value="1">
                <label for="new" ><span class="radio">최신순</span></label>
            </div>
            <div class="select-align">
                <input type="radio" name="align" id="hit" value="2">
                <label for="hit"><span class="radio">인기순</span></label>
            </div>
            <?php if($mobile){?>
            <div class="select-align">
                <input type="radio" name="align" id="loc" value="3">
                <label for="loc"><span class="radio">거리순</span></label>
            </div>
            <?php }?>
        </div>
        <div style="clear: both;"></div>
        <div class="swiper-container">
            <div class="swiper-wrapper">
            <?php
            for($i=0;$i<count($event_list);$i++){
                $thumb = get_list_thumbnail("main", $event_list[$i]['wr_id'], 1100, 464);
                if($thumb['src']) {
                    $img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'">';
                }
                $even = $event_list[$i]['wr_comment'];
                if($even==0){
                    $rank_total = $event_list[$i]["wr_4"];
                }else {
                    $rank_total = ceil($event_list[$i]["wr_4"] / $event_list[$i]['wr_comment']);
                }
                switch ($rank_total){
                    case "5":
                        $rank = "★★★★★";
                        break;
                    case "4":
                        $rank = "★★★★☆";
                        break;
                    case "3":
                        $rank = "★★★☆☆";
                        break;
                    case "2":
                        $rank = "★★☆☆☆";
                        break;
                    case "1":
                        $rank = "★☆☆☆☆";
                        break;
                    case "0":
                        $rank = "☆☆☆☆☆";
                        break;
                }
                if($img_content){
                    ?>
                    <div class="swiper-slide">
                        <a href="<?php echo G5_URL."/page/rent/view.php?wr_id=".$event_list[$i]['wr_id']; ?>"><?php echo $img_content; ?>
                            <div class="rank-block" >
                                <p class="rank"><?=$rank?><span style="float: right;"><?php echo $event_list[$i]["wr_subject"]?></span></p>
                            </div>
                        </a>
                    </div>
                    <?php
                }
            }
            if(count($event_list)<=0){
                ?>
                <div class="swiper-slide"><img src="<?php echo G5_IMG_URL?>/logo_sample.png" alt="배너등록 유도 이미지"></div>
                <?php
            }
            ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
        <div class="clear"></div>
        <section class="section01">
            <div class="section01_content">
                <div class="rent_list">
                    <ul>
                        <?php
                        for($i=0;$i<count($list);$i++){
                            //$id=$list[$i]['model'];
                            $thumb = get_list_thumbnail("main", $list[$i]['wr_id'], 800, 530);
                            if($thumb['src']) {
                                $img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'">';
                            }

                            $link="javascript:location.href='".G5_URL."/page/rent/view.php?wr_id=".$list[$i]['wr_id']."&type=".$type."'";

                            $order = sql_fetch("select COUNT(*) as cnt from `order_form` where order_state > 0 and order_state < 4 and wr_id='{$list[$i]['wr_id']}'");

                            $even = $list[$i]['wr_comment'];
                            if($even==0){
                                $rank_total = $list[$i]["wr_4"];
                            }else {
                                $rank_total = ceil($list[$i]["wr_4"] / $list[$i]['wr_comment']);
                            }
                            switch ($rank_total){
                                case "5":
                                    $rank = "★★★★★";
                                    break;
                                case "4":
                                    $rank = "★★★★☆";
                                    break;
                                case "3":
                                    $rank = "★★★☆☆";
                                    break;
                                case "2":
                                    $rank = "★★☆☆☆";
                                    break;
                                case "1":
                                    $rank = "★☆☆☆☆";
                                    break;
                                case "0":
                                    $rank = "☆☆☆☆☆";
                                    break;
                            }
                            ?>
                            <li data-cate="<?php echo $list[$i]['type']; ?>">
                                <?php if($list[$i]["wr_7"]==1){?><img src="<?php echo G5_IMG_URL?>/ic_premium.png" alt="프리미엄" class="list_icon"><?php }?>
                                <div <?php if($list[$i]["wr_5"]=="Y"){?>onclick="<?php echo $link; ?>"<?php }else{?>onclick="alert('영업준비중입니다.');"<?php }?> >
                                    <?php if($list[$i]['wr_5']=="N"){ ?>
                                        <div class="no_open"><div></div></div>
                                    <?php }?>
                                    <div class="img">
                                        <div ><?php echo $img_content; ?></div>
                                    </div>
                                    <div class="txt">
                                        <h3><?php echo $list[$i]['wr_subject']; ?></h3>
                                        <h4><?php echo ($list[$i]['store_addr1'] && $list[$i]["store_add2"])?$list[$i]['store_addr1']." ".$list[$i]["store_add2"]:"주소정보 없음"; ?></h4>
                                        <p>영업시간  <?php echo ($list[$i]["open_time"] && $list[$i]["close_time"])?$list[$i]["open_time"]."~".$list[$i]["close_time"]:"영업시간 정보 없음"; ?></p>
                                        <p>주문수  <?php echo $order["cnt"]; ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo ($list[$i]['delivery_price']!=0)?number_format($list[$i]['delivery_price'])."원 이상배달":"최소배달가격 정보없음"; ?></p>
                                        <p><span class="bg_yellow bold"><?=$rank?></span> | 거리</p>
                                    </div>
                                </div>
<!--                                <a href="javascript:" class="btn bg_gray">주문하기</a><br>-->
                                <a href="tel:<?php echo $list[$i]['store_hp'];?>" class="btn call"></a>                               
                            </li>                            
                                <?php 
                            $now_time = date('Y-m-d');
                            $time_check = strtotime($now_time) - strtotime($banner[$i]['seq_time1']); //종료날짜 계산
                            $total_time = $time_check; 
                            $days = floor($total_time/86400);
                            
                            $time_check1 = strtotime($now_time) - strtotime($banner[$i]['seq_time']); //시작날짜 계산
                            $total_time1 = $time_check1; 
                            $days1 = floor($total_time1/86400); 

//                            if($days1>=0)                                
//                                echo "시작 후 ".abs($days1)."일 경과 ";                              
//                            else
//                                echo "시작 까지 ".abs($days1)."일 남음 ";                            
//                            if($days<=0)                                
//                                echo "종료까지 ".abs($days)."일 남음 ";                              
//                            else
//                                echo "종료 후 ".$days."일 경과";
                       
                            if($banner[$i]['seq']==$i || $banner[$i]['show']==1){ 
                                if($days<=0&&$days1>=0){ ?>
                            <div class="item"><img src="<?php echo G5_DATA_URL."/partner/".$banner[$i]['banner']; ?>" alt=""></div>
                            <?php }else if($days>=0){                
                                sql_query("update `banner_list` set `seq`='-1' where `id`='{$banner[$i]['id']}';");
                                }
                            }?>
                            
                        <?php }
                        if(count($list)==0){?>
                            <li class="no-list" style=""><?php echo $index_title[$rand];?></li>
                        <?php }?>
                    </ul>
                                     
                </div>
            </div>
        </section>
    </div>
    <div class="cart">
        <div class="cart_count_large"><?php echo $cart_total;?></div>
        <input type="button" class="cart_btn" value="" onclick="location.href='<?=G5_URL?>/page/mypage/cart.php';" />
    </div>
    <!-- Swiper JS -->
    <script src="<?=G5_JS_URL?>/swiper.min.js"></script>

    <!-- Initialize Swiper -->
    <script>

        var appendNumber = 4;
        var prependNumber = 1;
        var swiper = new Swiper('.swiper-container', {
            pagination: '.swiper-pagination',
            nextButton: '.swiper-button-next',
            prevButton: '.swiper-button-prev',
            slidesPerView: 2,
            centeredSlides: true,
            paginationClickable: true,
            spaceBetween: 10,
            loop:true
        });
        document.querySelector('.prepend-2-slides').addEventListener('click', function (e) {
            e.preventDefault();
            swiper.prependSlide([
                '<div class="swiper-slide">Slide ' + (--prependNumber) + '</div>',
                '<div class="swiper-slide">Slide ' + (--prependNumber) + '</div>'
            ]);
        });
        document.querySelector('.prepend-slide').addEventListener('click', function (e) {
            e.preventDefault();
            swiper.prependSlide('<div class="swiper-slide">Slide ' + (--prependNumber) + '</div>');
        });
        document.querySelector('.append-slide').addEventListener('click', function (e) {
            e.preventDefault();
            swiper.appendSlide('<div class="swiper-slide">Slide ' + (++appendNumber) + '</div>');
        });
        document.querySelector('.append-2-slides').addEventListener('click', function (e) {
            e.preventDefault();
            swiper.appendSlide([
                '<div class="swiper-slide">Slide ' + (++appendNumber) + '</div>',
                '<div class="swiper-slide">Slide ' + (++appendNumber) + '</div>'
            ]);
        });
    </script>
    <script src="<?php echo G5_JS_URL ?>/owl.carousel.js"></script>
    <script>
    $(".owl-carousel").owlCarousel({
            autoplay:true,
            autoplayTimeout:5000,
            autoplaySpeed:2000,
            smartSpeed:2000,
            loop:true,
            dots:true,
            items:1
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            //지역선택
            $("#location_cate h2").click(function(){
                if($(this).text!="전체보기") {
                    loc = $(this).text();
                }else{
                    loc = ''
                }
                $(".accordion h1.loc.harf-first.title").html($(this).text()+'<img src="<?php echo G5_IMG_URL; ?>/arrow.png" alt="select-arrow">');
                $.ajax({
                    url:"<?=G5_URL?>/page/ajax/ajax.index_list.php",
                    method:"POST",
                    data:{"loc" : loc, "order":align_type , "ca_name": ca_name, "order_type" : order_type , "searchTxt" : searchTxt}
                }).done(function (data) {
                    $(".rent_list ul").html(data);
                });
                $(this).parent().slideUp('fast');
                //$(this).parent().parent().slideUp('fast');
            });

            //지역 전체선택
            $(".opened-for-codepen .all").click(function(){
                loc = '';
                $(".accordion h1.loc.harf-first").html($(this).text()+'<img src="<?php echo G5_IMG_URL; ?>/arrow.png" alt="select-arrow">');
                $.ajax({
                    url:"<?=G5_URL?>/page/ajax/ajax.index_list.php",
                    method:"POST",
                    data:{"loc" : '', "order":align_type , "ca_name": ca_name, "order_type" : order_type , "searchTxt" : searchTxt}
                }).done(function (data) {
                    $(".rent_list ul").html(data);
                });
                $(this).parent().slideUp('fast');
            });

            //업종 선택
            $(".opened-for-codepen.harf-first h2").click(function(){
                ca_name = $(this).text();
                if(ca_name == "전체보기")
                    ca_name='';
                $(".accordion h1.harf-first.center-acc").html($(this).text()+'<img src="<?php echo G5_IMG_URL; ?>/arrow.png" alt="select-arrow">');
                $.ajax({
                    url:"<?=G5_URL?>/page/ajax/ajax.index_list.php",
                    method:"POST",
                    data:{"loc" : loc, "order":align_type , "ca_name": ca_name, "order_type" : order_type , "searchTxt" : searchTxt}
                }).done(function (data) {
                    $(".rent_list ul").html(data);
                });
                $(this).parent().slideUp('fast');
            });

            //주문타입
            $("#order_cate h2").click(function(){
                order_type = $(this).text();
                if(order_type == "전체보기")
                    order_type = '';
                $(".accordion > #ordertypes").html($(this).text()+'<img src="<?php echo G5_IMG_URL; ?>/arrow.png" alt="select-arrow">');
                $.ajax({
                    url:"<?=G5_URL?>/page/ajax/ajax.index_list.php",
                    method:"POST",
                    data:{"loc" : loc, "order":align_type , "ca_name": ca_name, "order_type" : order_type , "searchTxt" : searchTxt}
                }).done(function (data) {
                    $(".rent_list ul").html(data);
                });
                console.log($(this).parent().html());
                $(this).parent().slideUp('fast');
            });

            //정렬
            $("input[type=radio]").change(function(){
                align_type = $(this).val();
                $.ajax({
                    url:"<?=G5_URL?>/page/ajax/ajax.index_list.php",
                    method:"POST",
                    data:{"loc" : loc, "order":align_type , "ca_name": ca_name, "order_type" : order_type , "searchTxt" : searchTxt}
                }).done(function (data) {
                    $(".rent_list ul").html(data);
                })
            })

            try {
                var regId = window.android.getRegid();
                $.ajax({
                    url: '<?=G5_URL?>/page/mypage/ajax.regId_insert.php',
                    method: 'POST',
                    data: {'regid': regId , 'mb_id':'<?=$member[mb_id]?>'}
                });
            } catch (err) {
                var regId = undefined;
                console.log(err);
            }

        });

    </script>
<?php
include_once(G5_PATH."/tail.php");
?>