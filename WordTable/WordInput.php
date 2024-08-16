<?php
$id = $_POST['id'];
$kl = $_POST['kl'];
$cl = $_POST['cl'];
$el = $_POST['el'];
$rl = $_POST['rl'];
$regdate = $_POST['regdate'];

$conn = mysqli_connect("localhost","root","","metaclass");
if(mysqli_connect_error()){
    printf("%s \n",mysqli_connect_error());
    exit;
}

$inrec = "insert into word values('$id','$kl','$cl','$el','$rl','$regdate')";
$info = mysqli_query($conn, $inrec);

if(!$info){
    echo "<script> 
    alert('데이터 등록실패, 키 중복 확인');
    location.href='WordInput.html';
    </script>";
}
else
    echo "<script> 
    alert('등록성공!');
    location.href='WordPrint.php';
    </script>"; 

mysqli_close($conn);
?>
