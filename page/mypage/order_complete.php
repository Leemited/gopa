<?php
include_once ("../../common.php");
include_once ("../../head.php");


?>
<div class="width-fixed">
    <section id="reserve_result">
       <!-- <header>
            <h1>예약완료</h1>
        </header>-->
        <div>
            <div class="top">
                <i></i>
                <h3 class="reserve_result_head"></h3>
                <p>
                    다음과 같은 정보로 예약이 완료되었습니다. <br />
                    <?php echo ""?>
                    <?php if($is_member){?>
                        예약정보 확인은 <span>마이페이지 > 주문목록</span> 메뉴에서 가능합니다.
                    <?php } else { ?>
                        예약정보 확인은 <span>메뉴 > 비회원 주문조회</span> 메뉴에서 가능합니다.
                    <?php } ?>
                </p>
            </div>
            <!--<div class="con">
                <h2><?php /*echo $view['model_name']; */?></h2>
                <?php /*if($view['type']=="short"){ */?>
                    <h1><span>결제금액</span><p><?php /*echo number_format($view['price']); */?><span>원</span></p></h1>
                    <h3><?php /*echo date("Y.m.d H:00",strtotime($view['start'])); */?> ~ <?php /*echo date("Y.m.d H:00",strtotime($view['end'])); */?> <span>(<?php /*echo $time; */?>)</span></h3>
                <?php /*} */?>
                <div class="table03">
                    <table>
                        <?php
/*                        if($view['type']=="long"){
                            switch($view['range']){
                                case"1":$range="1개월"; break;
                                case"3":$range="3개월"; break;
                                case"6":$range="6개월"; break;
                                case"12":$range="1년"; break;
                                case"36":$range="3년"; break;
                            }
                            */?>
                            <tr>
                                <th>기간</th>
                                <td>
                                    <?php /*echo $range; */?>
                                </td>
                            </tr>
                        <?php /*} */?>
                        <tr>
                            <th>대여지점</th>
                            <td><?php /*echo $view['rental_point']; */?></td>
                        </tr>
                        <tr>
                            <th>반납지점</th>
                            <td><?php /*echo $view['return_point']; */?></td>
                        </tr>
                        <tr>
                            <th>예약자명</th>
                            <td><?php /*echo $view['mb_name']; */?></td>
                        </tr>
                        <tr>
                            <th>이메일</th>
                            <td><?php /*echo $view['mb_email']; */?></td>
                        </tr>
                        <tr>
                            <th>휴대폰</th>
                            <td><?php /*echo $view['mb_phone']; */?></td>
                        </tr>
                        <tr>
                            <th>기타사항</th>
                            <td><?php /*echo $view['etc']; */?></td>
                        </tr>
                    </table>
                </div>
            </div>-->
            <div class="btn_group">
                <?php if($is_member){?>
                <a href="<?php echo G5_URL."/page/mypage/index.php"; ?>" class="btn">확인</a>
                <?php }else{?>
                <a href="<?php echo G5_URL."/page/rent/order_find.php"; ?>" class="btn">확인</a>
                <?php }?>
            </div>
        </div>
    </section>
</div>
<?php
include_once ("../../tail.php");
?>
