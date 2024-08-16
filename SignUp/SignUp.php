<?php
$irum = $_POST['irum'];
$id = $_POST['id'];
$nickname = $_POST['nickname'];
$email = $_POST['email'];
$pwd = $_POST['pwd'];
$regdate = $_POST['regdate'];
$usermode = $_POST['usermode'];

$conn=mysqli_connect("localhost","root","","metaclass");

if(mysqli_connect_error()){
    printf("%s\n", mysqli_connect_error());
}

$CheckId = "select * from member where id = '$id'";
$Query_CI = mysqli_query($conn,$CheckId);

if(mysqli_num_rows($Query_CI)>0){
    echo "<script>
    alert('이미 존재하는 아이디입니다. 다른 아이디를 사용해주세요!')
    history.back();
    </script>";
}else{
    $InsertData = "INSERT INTO member VALUES 
    ('$irum', '$id', '$nickname', '$email', '$pwd', '$regdate', '$usermode')";
    $Query_ID = mysqli_query($conn,$InsertData);

    if(!$Query_ID){
        echo "<script> 
        alert('회원가입 실패! 다시 입력해주세요!');
        location.href='SignUp.html';
        </script>";
    }else{
        echo "<script>
        alert('회원가입 완료!');
        location.href='../LoginHome.html';
        </script>";
    }
}
mysqli_close($conn);
?>