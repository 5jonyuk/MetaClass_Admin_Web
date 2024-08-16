<?php
// movieDB 데이터베이스 연결
$conn = mysqli_connect("localhost", "root", "", "metaclass") or die("metaclass 접속 실패 !!");

$sql = "SELECT * FROM Korean ";
$result = mysqli_query($conn, $sql);

if ($result) {
    $count = mysqli_num_rows($result);
    if ($count == 0) {
        echo "<script>alert('해당 정보가 없습니다');location.replace('main.php');</script>";
    }
} else {
    $err_msg = mysqli_error($conn);
    echo "<script>alert(\"SQL문 정보조회 오류 \\n오류내용: $err_msg\");</script>";
}

$tagList = '<li data-role="list-divider">한국어 콘텐츠 목록' . '<span style="float:right">' . $count . '건' . '</span></li>';
while ($row = mysqli_fetch_array($result)) {
    $tagList .= '<li><a href="video13.php?id=' . $row["id"] . '">';
    $tagList .= '<img style="margin:11px 20px;", src="'.$row["photo"].'">';
    $tagList .= '<span class="ui-li-count"> 장르 : ' . $row["genre"] . '</span>';
    $tagList .= '<h2>' . $row["title"] . '</h2>';
    $tagList .= '<p> 수강요금 : ' . $row["price"] . ' 원</p>';
    $tagList .= '<p> 공개일자 : ' . $row["myear"] . '</p></li>';
}
mysqli_free_result($result);
mysqli_close($conn);
?>

<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1.0, width=device-width">
    <title>한국어 관리</title>
    <!-- 제이쿼리 모바일, 제이쿼리 라이브러리 화일 -->
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>

<body>
    <!-- 전체 콘텐츠 조회 화면 -->
    <div data-role="page" id="page4">
        <div data-role="header" data-position="fixed" data-theme="b">
            <a href="#" data-icon="back" data-rel="back">Back</a>
            <h1>콘텐츠 정보</h1>
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
            <ul data-role="listview" data-divider-theme="b" data-inset="true">
                <?php echo $tagList ?>
            </ul>
        </div>
        <div data-role="footer" data-position="fixed" data-theme="b">
            <h4>korean education center</h4>
        </div>
    </div>
</body>

</html>
