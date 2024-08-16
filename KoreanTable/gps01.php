<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>현재 위치와 지도 출력</title>
</head>
<body>
<h3>현재 위치와 지도 출력</h3>
<hr>
<div id="msg">이곳에  위치 정보 출력</div>
<iframe id="map" width="425" height="350" frameborder="0" scrolling="no" marginheight="0" 		marginwidth="0" ></iframe><br/>
<a id="bigmaplink" target="_blank">새 창에 큰 지도 보기</a>
<script>
if(navigator.geolocation) 
	navigator.geolocation.getCurrentPosition(success); // 현재 위치 정보 요청
else 
	alert("지원하지 않음");
// 위치 파악 시 success() 호출. 위치 정보가 들어 있는 position 객체가 매개 변수로 넘어온다.
function success(position) {
	let lat = position.coords.latitude; // 위도
	let lon = position.coords.longitude; // 경도
	let acc = position.coords.accuracy; // 정확도

	// 위도와 경도의 소수점 이하 자리가 너무 길어 유효 숫자 6자리로 짜름
	lat = lat.toPrecision(6); lon = lon.toPrecision(6);

	let now = new Date(position.timestamp);
	let text = "현재 시간 " + now.toUTCString() + "<br>";
	text += "현재 위치 (위도 " + lat + "°, 경도 " + lon + "°)<br>";
	text += "정확도 " + acc + "m<br>";
	document.getElementById("msg").innerHTML = text;

	let map = document.getElementById("map");
 	map.src ="https://www.openstreetmap.org/export/embed.html?bbox=" + 
		(parseFloat(lon)-0.01) + "%2C" + (parseFloat(lat)-0.01) + "%2C" + 
		(parseFloat(lon)+0.01) + "%2C" + (parseFloat(lat) + 0.01);
 		// lat와 lon은 문자열이므로 숫자로 바꾸기 위해 parseFloat() 사용

 	let maplink = document.getElementById("bigmaplink");
	let zoom = 15; // 지도의 줌 레벨. 숫자가 클수록 자세한 지도
	maplink.href = "https://www.openstreetmap.org/#map=" + zoom + "/" + lat + "/" + lon;
}
</script>
</body>
</html>
