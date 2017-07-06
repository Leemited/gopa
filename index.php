<?php
include_once("./common.php");
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
include_once(G5_PATH."/head.php");


$query=sql_query("select a.*, b.* from g5_write_main as a left join store_detail as b on a.wr_id = b.wr_id where a.wr_is_comment=0 ");
while($data=sql_fetch_array($query)){
    $list[]=$data;
}

$now=date("Y-m-d h:i:s");
$event_sql="SELECT * FROM  `g5_write_main` WHERE  `wr_1`<='$now' and `wr_2`>='$now' and `wr_3` = 'Y' ";
$event_query=sql_query($event_sql);
while($event_data=sql_fetch_array($event_query)){
    $event_list[]=$event_data;
}


?>
    <div class="width-fixed">
        <div class="select-all">
            <!--<div class="accordion">
                <h1 class="loc">지역 <img src="<?php /*echo G5_IMG_URL; */?>/arrow.png" alt="select-arrow"></h1>
                <div class="opened-for-codepen">
                    <h2 class="all">전체보기</h2>
                    <h2>상당구</h2>
                    <ul class="opened-for-codepen">
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
                    </ul>
                    <h2>서원구</h2>
                    <ul class="opened-for-codepen">
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
                    </ul>
                    <h2>청원구</h2>
                    <ul class="opened-for-codepen">
                        <li>내수읍</li>
                        <li>오창읍</li>
                        <li>북이면</li>
                        <li>우암동</li>
                        <li>내덕1동</li>
                        <li>내덕2동</li>
                        <li>율량사천동</li>
                        <li>오근장동</li>
                    </ul>
                    <h2>흥덕구</h2>
                    <ul class="opened-for-codepen">
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
                    </ul>
                </div>
            </div>-->
            <div class="accordion">
                <h1 class="loc harf-first">지역 <img src="<?php echo G5_IMG_URL; ?>/arrow.png" alt="select-arrow"></h1>
                <div class="opened-for-codepen harf">
                    <h2 class="all">전체보기</h2>
                    <h2>상당구</h2>
                    <ul class="opened-for-codepen price">
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
                    </ul>
                    <h2>서원구</h2>
                    <ul class="opened-for-codepen price">
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
                    </ul>
                    <h2>청원구</h2>
                    <ul class="opened-for-codepen price">
                        <li>내수읍</li>
                        <li>오창읍</li>
                        <li>북이면</li>
                        <li>우암동</li>
                        <li>내덕1동</li>
                        <li>내덕2동</li>
                        <li>율량사천동</li>
                        <li>오근장동</li>
                    </ul>
                    <h2>흥덕구</h2>
                    <ul class="opened-for-codepen">
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
                    </ul>
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
                <h1 class="harf">가맹점 <img src="<?php echo G5_IMG_URL; ?>/arrow.png" alt="select-arrow"></h1>
                <div class="opened-for-codepen harf pay">
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
                <input type="radio" name="align" id="new" checked value="1">
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
                        <a href="<?php echo G5_BBS_URL."/board.php?bo_table=event&wr_id=".$event_list[$i]['wr_id']; ?>"><?php echo $img_content; ?>
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
                <div class="swiper-slide"><a href="<?php echo G5_URL; ?>"><img src="<?php echo G5_IMG_URL."/main_slide.jpg"; ?>" alt="image" /></a></div>
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
                            $thumb = get_list_thumbnail("main", $list[$i]['wr_id'], 1100, 464);
                            if($thumb['src']) {
                                $img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'">';
                            }

                            $link="javascript:location.href='".G5_URL."/page/rent/view.php?wr_id=".$list[$i]['wr_id']."&type=".$type."'";

                            $time = explode("|",$list[$i]['wr_5']);
                            $point = explode("|",$list[$i]['wr_8']);
                            ?>
                            <li data-cate="<?php echo $list[$i]['type']; ?>">
                                <div onclick="<?php echo $link; ?>">
                                    <div class="img">
                                        <div><?php echo $img_content; ?></div>
                                    </div>
                                    <div class="txt">
                                        <h3><?php echo $list[$i]['wr_subject']; ?></h3>
                                        <h4><?php echo $list[$i]['wr_10']; ?></h4>
                                        <p>영업시간  <?php echo $time[0]."~".$time[1]; ?></p>
                                        <p>주문수  <?php echo $list[$i]['wr_6']; ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo $list[$i]['delivery_price']; ?></p>
                                        <p>적립&nbsp;&nbsp;현금&nbsp;<?php echo $point[0]." | ".$point[1] ;?></p>
                                    </div>
                                </div>
                                <!--<a href="javascript:" class="btn bg_gray">주문하기</a><br>-->
                                <a href="tel:<?php echo $list[$i]['wr_9'];?>" class="btn"></a>
                            </li>
                        <?php } ?>
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
    <script type="text/javascript">
        $(document).ready(function(){
            //지역선택
            $(".opened-for-codepen li").click(function(){
                if($(this).text!="전체보기") {
                    loc = $(this).text();
                }else{
                    loc = ''
                }
                $(".accordion h1.loc.harf-first").html($(this).text()+'<img src="<?php echo G5_IMG_URL; ?>/arrow.png" alt="select-arrow">');
                $.ajax({
                    url:"<?=G5_URL?>/page/ajax/ajax.index_list.php",
                    method:"POST",
                    data:{"loc" : loc, "order":align_type , "ca_name": ca_name, "order_type" : order_type , "searchTxt" : searchTxt}
                }).done(function (data) {
                    $(".rent_list ul").html(data);
                });
                $(this).parent().slideUp('fast');
                $(this).parent().parent().slideUp('fast');
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
            $(".opened-for-codepen.pay h2").click(function(){
                order_type = $(this).text();
                if(order_type == "전체보기")
                    order_type = '';
                $(".accordion h1.harf").html($(this).text()+'<img src="<?php echo G5_IMG_URL; ?>/arrow.png" alt="select-arrow">');
                $.ajax({
                    url:"<?=G5_URL?>/page/ajax/ajax.index_list.php",
                    method:"POST",
                    data:{"loc" : loc, "order":align_type , "ca_name": ca_name, "order_type" : order_type , "searchTxt" : searchTxt}
                }).done(function (data) {
                    $(".rent_list ul").html(data);
                });
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
        })
    </script>
<?php
include_once(G5_PATH."/tail.php");
?>