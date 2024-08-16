
<?php

//movieDB 데이터베이스 연결
$conn=mysqli_connect("localhost", "root", "", "metaclass") or die("metaclass 접속 실패 !!");

$title = $_POST["smovieTitle3"];

$sql="SELECT * FROM korean WHERE title = '".$title."'" ;
$result=mysqli_query($conn, $sql);

if($result) {
    $count = mysqli_num_rows($result) ;
    if ($count ==0) {
        echo "<script>alert('해당 정보가 없습니다');location.replace('main.php');</script>";
    }
}
else {
    $err_msg=mysqli_error($conn);
    echo "<script>alert(\"SQL문 정보조회 오류 \\n오류내용: $err_msg\");</script>" ;
}

$row = mysqli_fetch_array($result);
$title = $row['title'];
$genre = $row['genre'];
$myear = $row['myear'];
$price = $row['price'];

mysqli_close($conn);

?>

<html>
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="initial-scale=1.0, width=device-width">
	<title>한국어 콘텐츠 관리</title>
    <!-- 제이쿼리 모바일, 제이쿼리 라이브러리 화일 -->
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css"/>
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>	
</head>  
<body>
  <!-- 한국어 정보 삭제 화면 --> 
  <div data-role="page" id="page3">
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
    <h3>영화 내용 삭제</h3>
       <form name="form3-1" method="post" action="delete_result.php" data-ajax="false">  
	<div class="ui-body ui-body-a">
	<label for="movieGenre3" class="select">과목명:</label>
	<select name="movieGenre3" data-native-menu="false" data-mini="true" data-inline="true">
	<option value="<?php echo $genre ?>"><?php echo $genre ?></option>
		<option value="초급I">한국어 초급I</option>
		<option value="초급II">한국어 초급II</option>
		<option value="중급I">한국어 중급I</option>
		<option value="중급II">한국어 중급II</option>
		<option value="고급I">한국어 중급I</option>
		<option value="고급II">한국어 중급II</option>		</select>	
	<label for="movieTitle3">한국어 강좌명:</label>
	<input type="text" name="movieTitle3" value=<?php echo $title ?> data-mini="true"  />
	<label for="movieYear3">수업일자:</label>
	<input type="text" name="movieYear3" value=<?php echo $myear ?> data-mini="true">
	<label for="moviePrice3">수업료:</label>
	<input type="text" name="moviePrice3" value=<?php echo $price ?> data-mini="true">            
            </div>
	<div class="ui-body">
	<fieldset class="ui-grid-a">
	<div class="ui-block-a"><input type="reset" value="취소"/></div>
	<div class="ui-block-b"><input type="submit" value="삭제"/></div>
	</fieldset>
          </div>
	</form> 
          </div>
     <div data-role="footer" data-position="fixed" data-theme="b">
    <h4>Korean Education Center</h4>
    </div>
  </div>  </body>  </html>
