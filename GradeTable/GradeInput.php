<?php
$id = $_POST['id'];
$irum = $_POST['irum'];
$game = $_POST['game'];
$chapter = $_POST['chapter'];
$mid = $_POST['mid'];
$final = $_POST['final'];

$conn = mysqli_connect("localhost","root","","metaclass");
if(mysqli_connect_error()){
    printf("%s \n",mysqli_connect_error());
    exit;
}

$total = $game + $chapter + $mid + $final;

$select_member="SELECT * FROM member WHERE id='$id'";
$select_member_result=mysqli_query($conn,$select_member);

if(mysqli_fetch_array( $select_member_result)>0){
$inrec = "insert into grade(id,irum,game,chapter,mid,final,total) 
values('$id','$irum','$game','$chapter','$mid','$final','$total')";
$info = mysqli_query($conn, $inrec);

if(!$info){
    echo "<script>
    alert('테이블 등록실패! 중복 키 값 확인');
    location.href='GradeInput.html';
    </script>";
}
else
    echo "<script>
    alert('등록성공!');
    location.href='GradePrint.php';
    </script>";
}else{
    echo "<script>
    alert('$irum 님이 존재하지 않습니다.');
    location.href='GradePrint.php';
    </script>";
}
mysqli_close($conn);
?>