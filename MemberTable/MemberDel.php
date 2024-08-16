<?php
$email = $_POST['email'];

$conn = mysqli_connect('localhost','root','','wordpress');
if(mysqli_connect_error()){
    printf("%s \n", mysqli_connect_error());
    exit;
}
$select_email = "SELECT * FROM wp_users WHERE user_email='$email'";
$result_email = $conn->query($select_email);

if (mysqli_fetch_array($result_email)>0) {
    $deldata = "delete from wp_users where user_email='$email'";
    $query = mysqli_query($conn,$deldata);
    echo "<script> 
    alert('삭제완료!');
    location.href='MemberPrint.php';
    </script>";
}
else{
    echo "<script> 
    alert('삭제실패! 아이디가 존재하지 않습니다.');
    location.href='MemberDel.html';
    </script>";
}
mysqli_close($conn);
?>
