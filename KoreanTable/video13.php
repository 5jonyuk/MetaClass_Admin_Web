<?php
if(isset($_GET['id'])) {
    // movieDB 데이터베이스 연결
    $conn = mysqli_connect("localhost", "root", "", "metaclass") or die("metaclass 접속 실패 !!");

    // ID 값 가져오기
    $id = $_GET['id'];

    // 해당 ID에 해당하는 레코드를 가져옴
    $sql = "SELECT video_url FROM Korean WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $videoSrc = $row['video_url'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>비디오 재생</title>
    <style>
        /* CSS 파일 내 */
/* 동영상 재생 페이지 스타일 */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* 폰트 지정 */
    background-color: #000; /* 배경색 */
    color: #fff; /* 텍스트 색상 */
    padding: 20px; /* 페이지 내부 패딩 */
}

h3 {
    text-align: center; /* 제목 중앙 정렬 */
    font-size: 24px; /* 제목 폰트 크기 */
}

hr {
    border: none; /* 수평선 없애기 */
    border-top: 1px solid #999; /* 상단 테두리 추가 */
    margin: 20px 0; /* 수평선 간격 조정 */
}

video {
    display: block; /* 비디오 플레이어를 블록 요소로 표시 */
    margin: 0 auto; /* 가운데 정렬 */
    width: 100%; /* 비디오 플레이어 너비 조정 */
    max-width: 800px; /* 최대 너비 지정 */
    border: 4px solid #fff; /* 플레이어 테두리 추가 */
    border-radius: 10px; /* 플레이어 모서리 둥글게 */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); /* 그림자 추가 */
}qq
    </style>
</head>
<body>
    <h3>비디오 재생</h3>
    <hr>
    <video controls autoplay>
        <source src="<?php echo $videoSrc; ?>" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</body>
</html>
<?php
    } else {
        echo "해당하는 동영상 파일이 없습니다.";
    }

    mysqli_close($conn);
} else {
    echo "ID 값이 전달되지 않았습니다.";
}
?>