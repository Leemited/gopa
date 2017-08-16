<!-- 본문 end -->
	<script type="text/javascript" src="<?php echo G5_JS_URL; ?>/jquery.accordion.js"></script><!--아코디언-->
	<script type="text/javascript">
		$('.accordion').accordion({
			"transitionSpeed": 400
		});
	</script>
	<script type="text/javascript" src="./smartEditor2/js/HuskyEZCreator.js" charset="utf-8"></script>
	<script type="text/javascript">
    var oEditors = [];
    $(document).ready(function(){
        nhn.husky.EZCreator.createInIFrame({
            oAppRef: oEditors,
            elPlaceHolder: "wr_content",
            sSkinURI: "./smartEditor2/SmartEditor2Skin.html",
            fCreator: "createSEditor2"
        });
    });
    function _onSubmit(elClicked){
    // 에디터의 내용을 에디터 생성시에 사용했던 textarea에 넣어 줍니다.
    oEditors.getById["wr_content"].exec("UPDATE_CONTENTS_FIELD", []);

    try{
        $("#notice_write").submit();
        }catch(e){
        alert(e);
        }  
    }
    </script>