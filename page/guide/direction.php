<?php
	include_once("../../common.php");
	include_once(G5_PATH."/head.php");
	if(!$type){
		$type="short";
	}
	$best_tel=sql_fetch("select * from `best_tel`");
	$query=sql_query("select * from best_model as m inner join best_car as c on m.id=c.model");
	while($data=sql_fetch_array($query)){
		$list[]=$data;
	}
	$branch_query=sql_query("select * from `best_branch`");
	while($branch_data=sql_fetch_array($branch_query)){
		$branch_list[]=$branch_data;
	}
?>
	<div class="width-fixed">
		<section class="section01">
			<header class="section01_header">
				<h1>오시는 길</h1>
				<h3 class="direction_head"></h3>
				<p>베스트렌터카의 오프라인 지점별 위치를 안내해 드립니다.</p>
			</header>
		</section>
		<div class="direction_select">
			<select name="direction_select" id="direction_select" onchange="direction_select_change();">
				<?php
					for($i=0;$i<count($branch_list);$i++){
				?>
					<option value="<?php echo $branch_list[$i]['name']; ?>" data-addr1="<?php echo $branch_list[$i]['addr1']; ?>" data-addr2="<?php echo $branch_list[$i]['addr2']; ?>" data-tel="<?php echo $branch_list[$i]['tel']; ?>" data-fax="<?php echo $branch_list[$i]['fax']; ?>"><?php echo $branch_list[$i]['name']; ?></option>
				<?php
					}
				?>
			</select>
		</div>
		<input type="hidden" name="addr1" id="addr1" value="<?php echo $branch_list[0]['addr1']; ?>" />
		<input type="hidden" name="name" id="name" value="<?php echo $branch_list[0]['name']; ?>" />
		<input type="hidden" name="tel" id="tel" value="<?php echo $branch_list[0]['tel']; ?>" />
		<div class="map_wrap" id="map"></div>
		<div class="map_txt">
			<h4><div></div>베스트렌터카<span class="name"><?php echo $branch_list[0]['name']; ?></span></h4>
			<address><?php echo $branch_list[0]['addr1']; ?> <?php echo $branch_list[0]['addr2']; ?></address>
			<div class="contect">
				<div><span>TEL</span><?php echo $branch_list[0]['tel']; ?></div>
				<?php if($branch_list[0]['fax']){ ?><div><span>FAX</span><?php echo $branch_list[0]['fax']; ?></div><?php } ?>
			</div>
		</div>
		<div class="sub_call_pop">
			<div class="top">
				<i></i>
				<div>
					<h3>빠르고 간편한</h3>
					<h2>전화예약</h2>
				</div>
			</div>
			<div class="bottom">
				<h1><?php echo dot_hp_number($best_tel['tel']); ?></h1>
				<p><?php if(!$best_tel['all']){ echo date("A h:i",strtotime($best_tel['time1'])); ?> ~ <?php echo date("A h:i",strtotime($best_tel['time2'])); ?><?php }else{ ?>연중무휴 24시간 영업<?php } ?></p>
			</div>
		</div>
	</div>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBnqdTR1gS-OgLkCe2g3trbAbjIvQjy5GU&callback=initMap"
        async defer></script>
	<script type="text/javascript">
		var addr1=$("#addr1").val();
		var name=$("#name").val();
		var tel=$("#tel").val();
		function initMap() {
			var mapOptions = {
								zoom: 18, // 지도를 띄웠을 때의 줌 크기
								mapTypeId: google.maps.MapTypeId.ROADMAP
							};
			var map = new google.maps.Map(document.getElementById("map"), // div의 id과 값이 같아야 함. "map-canvas"
										mapOptions);
			var size_x = 40; // 마커로 사용할 이미지의 가로 크기
			var size_y = 40; // 마커로 사용할 이미지의 세로 크기
		 
			// 마커로 사용할 이미지 주소
			//var image = new google.maps.MarkerImage( '',new google.maps.Size(size_x, size_y),'', '', new google.maps.Size(size_x, size_y));
			 
			// Geocoding *****************************************************
			var address = addr1; // DB에서 주소 가져와서 검색하거나 왼쪽과 같이 주소를 바로 코딩.
			var marker = null;
			var geocoder = new google.maps.Geocoder();
			geocoder.geocode( { 'address': address}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					map.setCenter(results[0].geometry.location);
					marker = new google.maps.Marker({
						map: map,
						 //icon: image,  마커로 사용할 이미지(변수)
						title: name, // 마커에 마우스 포인트를 갖다댔을 때 뜨는 타이틀
						position: results[0].geometry.location
					});
	 
					var content = "<span style='color:#000;'>베스트렌트카 "+name+"<br/><br/>Tel: "+tel+"</span>"; // 말풍선 안에 들어갈 내용
				 
					// 마커를 클릭했을 때의 이벤트. 말풍선 뿅~
					var infowindow = new google.maps.InfoWindow({ content: content});
					google.maps.event.addListener(marker, "click", function() {infowindow.open(map,marker);});
				} else {
					alert("Geocode was not successful for the following reason: " + status);
				}
				document.getElementById('direction_select').addEventListener('change', function() {
					geocodeAddress(geocoder, map);
				});
			});
			// Geocoding // *****************************************************
			 
		}
		google.maps.event.addDomListener(window, 'load', initialize);
		function geocodeAddress(geocoder, resultsMap) {
		  var address = $("#direction_select option:selected").attr("data-addr1");
		  name = $("#direction_select").val();
		  tel = $("#direction_select option:selected").attr("data-tel");
		  geocoder.geocode({'address': address}, function(results, status) {
			if (status === google.maps.GeocoderStatus.OK) {
			  resultsMap.setCenter(results[0].geometry.location);
			  var marker = new google.maps.Marker({
				map: resultsMap,
				title: name,
				position: results[0].geometry.location
			  });
				var content = "<span style='color:#000;'>베스트렌트카 "+name+"<br/><br/>Tel: "+tel+"</span>"; // 말풍선 안에 들어갈 내용
				// 마커를 클릭했을 때의 이벤트. 말풍선 뿅~
				var infowindow = new google.maps.InfoWindow({ content: content});	
				google.maps.event.addListener(marker, "click", function() {infowindow.open(map,marker);});
			} else {
			  alert('Geocode was not successful for the following reason: ' + status);
			}
		  });
		}
		function direction_select_change(){
			var name=$("#direction_select").val();
			var addr1=$("#direction_select option:selected").attr("data-addr1");
			var addr2=$("#direction_select option:selected").attr("data-addr2");
			var tel=$("#direction_select option:selected").attr("data-tel");
			var fax=$("#direction_select option:selected").attr("data-fax");
			$(".name").html(name);
			$(".map_txt address").html(addr1+" "+addr2);
			var tel_con="";
			var fax_con="";
			if(tel){
				tel_con="<div><span>TEL</span>"+tel+"</div>";
			}
			if(fax){
				fax_con="<div><span>TEL</span>"+fax+"</div>";
			}
			$(".map_txt .contect").html(tel_con+fax_con);
			
		}
	</script>
<?php
	include_once(G5_PATH."/tail.php");
?>