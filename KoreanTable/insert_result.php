<?php
// movieDB 데이터베이스 연결
$conn = mysqli_connect("localhost", "root", "", "metaclass") or die("metaclass 접속 실패 !!");

// 사용자 입력 값 가져오기
$title = $_POST["title1"];
$genre = $_POST["movieGenre1"];
$myear = $_POST["movieYear1"];
$price = $_POST["moviePrice1"];
$imagefile = $_FILES['imagefile'];
$moviefile = $_FILES['moviefile'];

$upload_dir = "./photo/";
$upload_dir2 = "./media/High/high01/"; //경로 바꿔주기가 필요함

// 이미지 파일 업로드
if(isset($_FILES['imagefile']) && $_FILES['imagefile']['name'] != "") {
    $pathfile = $upload_dir.basename($imagefile['name']);
    if(move_uploaded_file($imagefile['tmp_name'], $pathfile)) {        
        $sql="INSERT INTO korean (title, genre, myear, price, photo) VALUES ('$title', '$genre', '$myear', '$price', '$pathfile')";
        $result=mysqli_query($conn, $sql); 
        if($result){
            echo "<script>alert('$title 이미지 파일이 추가되었습니다');</script>";
        } else {
            echo "<script>alert('이미지 파일이 업로드되지 않았습니다.');</script>";
        }
    } else {       
        echo "<script>alert('이미지 파일이 업로드되지 않았습니다.');</script>";
    }
} else {
    echo "<script>alert('이미지 파일이 존재하지 않습니다.');</script>";
}

// 동영상 파일 업로드 및 변환
if(isset($_FILES['moviefile']) && $_FILES['moviefile']['name'] != "") {
    $movieFilePath = $upload_dir2.basename($moviefile['name']);

    // 파일의 확장자 확인
    $fileExtension = strtolower(pathinfo($_FILES['moviefile']['name'], PATHINFO_EXTENSION));

    if ($fileExtension === 'wmv') {
        // WMV 파일인 경우
        $wmvFilePath = $upload_dir2 . $_FILES['moviefile']['name'];
        $mp4FilePath = $upload_dir2 . basename($_FILES['moviefile']['name'], '.wmv') . '.mp4';
        $ffmpegCommand = "ffmpeg -i $wmvFilePath $mp4FilePath";
        exec($ffmpegCommand, $output, $returnCode);

        if ($returnCode === 0) {
            // 변환 성공 시, MP4 파일 경로를 데이터베이스에 업데이트
            $sql2 = "UPDATE korean SET video_url = '$mp4FilePath' WHERE title = '$title' AND video_url IS NULL";
            $result2 = mysqli_query($conn, $sql2); 
            if($result2 && mysqli_affected_rows($conn) > 0){
                echo "<script>alert('$title 영상 파일이 추가되었습니다');</script>";
            } else {       
                echo "<script>alert('영상 파일이 업로드되지 않았습니다.');</script>";
            }
        } else {
            // 변환 실패 시
            echo "<script>alert('WMV 파일을 MP4로 변환하는 중 오류가 발생했습니다.');</script>";
        }
    } else {
        // 다른 유형의 파일인 경우
        if(move_uploaded_file($_FILES['moviefile']['tmp_name'], $movieFilePath)) {        
            $sql="UPDATE korean SET video_url = '$movieFilePath' WHERE title = '$title' AND video_url IS NULL";
            $result=mysqli_query($conn, $sql); 
            if($result){
                echo "<script>alert('$title 영상 파일이 추가되었습니다');</script>";
            } else {
                echo "<script>alert('영상 화일이 업로드되지 않았습니다.');</script>";
            }
        } else {       
            echo "<script>alert('영상 파일이 업로드되지 않았습니다.');</script>";
        }
    }
} 
else {
    echo "<script>alert('영상 파일이 존재하지 않습니다.');</script>";
}

mysqli_close($conn);
echo '<script>location.replace("main.php");</script>';
?>
