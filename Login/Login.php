<?php
$id = $_POST['id'];
$pwd = $_POST['pwd'];

$conn=mysqli_connect("localhost","root","","metaclass");

$sqlrec = "select * from member where id='$id' and pwd='$pwd'";
$info = mysqli_query($conn,$sqlrec);

if(mysqli_num_rows($info) == 0){
    echo "<script> 
    alert('아이디 또는 비밀번호가 존재하지 않습니다.');
    location.href='../LoginHome.html';
    </script>";
    exit;
}
while ($i = mysqli_fetch_array($info)){
    $b = $i['id'];
    $c = $i['usermode'];
}

session_start();

$_SESSION['id']= $b;
$_SESSION['usermode']= $c;

if($_SESSION['usermode']=='M'){
    echo "<script> 
    alert('로그인 성공!');
    location.href='../AdminHome.html';
    </script>";
}else{
    echo "<script> 
    alert('로그인 성공!');
    location.href='../../wordpress';
    </script>";
}
?>