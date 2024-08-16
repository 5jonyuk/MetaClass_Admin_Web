<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"><title>watchPosition()으로 반복 위치 서비스</title>
</head>
<body>
<h3>watchPosition()으로 반복 위치 서비스</h3><hr>
<div id="msg">이곳에 위치 정보 출력</div>
<iframe id="map" width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" ></iframe><br/>
<script>
let options = { // watchPosition()의 마지막 매개 변수로 전달할 객체  
	enableHighAccuracy: false,   timeout: 5000,  maximumAge: 0 };
let count=0; // 반복 위치 서비스가 호출되는 횟수
let watchID; 	
if(navigator.geolocation) {
	// changed() 콜백 함수를 등록하고, 반복 위치 서비스 시작
	watchID = navigator.geolocation.watchPosition(changed, null, options);  }
else { 	alert("지원하지 않음"); }
//위치가 바뀌면 changed()가 호출되고, 위치 정보가 들어 있는 position 객체가 매개 변수로 넘어온다.
function changed(position) {
	if(count == 5) { // clearWatch() 테스트를 위해 5번만 서비스 
		navigator.geolocation.clearWatch(watchID); // 반복 서비스 종료
		document.getElementById("msg").innerHTML = "위치 서비스 종료";
		return;    }
	let lat = position.coords.latitude; // 변경된 위도
	let lon = position.coords.longitude // 변경된 경도
	let text = count + ": (위도 " + lat + "°, 경도 " + lon + "°)로 변경됨<br>";
	document.getElementById("msg").innerHTML = text; // 위치 정보 출력
	let map = document.getElementById("map");
 	map.src ="https://www.openstreetmap.org/export/embed.html?bbox=" + 
			(parseFloat(lon)-0.01) + "%2C" + (parseFloat(lat)-0.01) + "%2C" + 
			(parseFloat(lon)+0.01) + "%2C" + (parseFloat(lat) + 0.01);  		// lat와 lon은 문자열이므로 숫자로 바꾸기 위해 parseFloat() 사용
	count++; // 갱신 회수 증가  
}
</script>
</body>
</html>