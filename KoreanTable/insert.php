<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="initial-scale=1.0, width=device-width">
	<title>한국어 정보 관리</title>
        <!-- 제이쿼리 모바일, 제이쿼리 라이브러리 화일 -->
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css"/>
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>  
<body>
  <!-- 한국어 정보 추가 화면 -->
  <div data-role="page" id="page1">
	<div data-role="header" data-position="fixed" data-theme="b">
		<a href="#" data-icon="back" data-rel="back">Back</a>
		<h1>영화 정보</h1>
		<a href="main.php" data-icon="home" data-iconpos="notext">Home</a>
		<div data-role="navbar">
			<ul>
				<li><a href="insert.php">입력</a></li>
				<li><a href="update_select.php">수정</a></li>
				<li><a href="delete_select.php">삭제</a></li>	
				<li><a href="selectAll.php">전체검색</a></li>
			</ul>
		</div>
	</div>
	<div data-role="content">
		<form name="form1" method="post" enctype="multipart/form-data" action="insert_result.php" data-ajax="false">  
        <h3>콘텐츠 내용 입력</h3>
		<div class="ui-body ui-body-a">
		<label class="select">교과목:</label>
		<select name="movieGenre1" data-native-menu="false" data-mini="true" data-inline="true">
			<option value="미정">미정</option>
			<option value="초급I">초급I</option>
			<option value="초급II">초급II</option>
			<option value="중급I">중급I</option>
			<option value="중급II">중급II</option>
		</select>
		<label>콘텐츠 명:</label>
		<input type="text" name="title1" value="" data-mini="true"/>
		<label>수업 일자(yyyy-mm-dd):</label>
		<input type="text" name="movieYear1" value="" data-mini="true">
		<label>수업료:</label>
		<input type="text" name="moviePrice1" value="" data-mini="true">
		<label>콘텐츠 포스터:</label>
		<input type="file" name="imagefile" value="" data-mini="true">
		<label>콘텐츠 영상:</label>
		<input type="file" name="moviefile" value="" data-mini="true">					
    	</div>
	<div class="ui-body">
	<fieldset class="ui-grid-a">
		<div class="ui-block-a"><input type="reset" value="취소"/></div>
		<div class="ui-block-b"><input type="submit" value="추가"/></div>
	</fieldset>
	</div>
	</form> 
	</div>
	<div data-role="footer" data-position="fixed" data-theme="b">
		<h4>movie & movie cinema</h4>
    </div>    
</div>
</body>   
</html>
