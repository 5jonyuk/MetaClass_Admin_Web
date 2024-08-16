<?php
$email=$_POST['email'];
$u_id=$_POST['id'];
$u_irum=$_POST['irum'];
$u_nickname=$_POST['nickname'];
$u_pwd=$_POST['pwd'];
$u_date=$_POST['regdate'];
$u_usermode=$_POST['usermode'];

$conn = mysqli_connect('localhost','root','','metaclass');
if(mysqli_connect_error()){
    printf("%s\n",mysqli_connect_error());
    exit;
}

$selectData = "SELECT * FROM member WHERE email='$email'";
$resultData = mysqli_query($conn,$selectData);

if($row = mysqli_fetch_assoc($resultData)){
    $old_irum_data = $row['irum'];
    $old_id_data = $row['id'];
    $old_nickname_data = $row['nickname'];
    $old_pwd_data = $row['pwd'];
    $old_date_data = $row['regdate'];
    $old_usermode_data = $row['usermode'];

    $u_irum = ($u_irum=="") ? $old_irum_data : $u_irum;
    $u_id = ($u_id=="") ? $old_id_data : $u_id;
    $u_nickname = ($u_nickname=="") ? $old_nickname_data : $u_nickname;
    $u_pwd = ($u_pwd=="") ? $old_pwd_data : $u_pwd;
    $u_date = ($u_date=="") ? $old_date_data : $u_date;
    $u_usermode = ($u_usermode=="") ? $old_usermode_data : $u_usermode;

    $updateData = "UPDATE member SET 
    irum='$u_irum',id='$u_id',nickname='$u_nickname', pwd='$u_pwd', regdate='$u_date', usermode='$u_usermode' 
    WHERE email='$email'";
    $updateQuery = mysqli_query($conn,$updateData);

    if($updateQuery){
        echo "<script> 
        alert('데이터 수정성공!');
        location.href='MemberPrint.php';
        </script>";
    }
    else{
        echo "<script> 
        alert('데이터 수정실패, 다시 입력해주세요!');
        location.href='MemberUpdate.html';
        </script>";
    } 
}else{
    echo "<script> 
    alert('데이터 수정실패, 해당 E-mail이 존재하지 않습니다!');
    location.href='MemberUpdate.html';
    </script>";
} 
mysqli_close($conn);
?>