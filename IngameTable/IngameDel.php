<?php
$id = $_POST['id'];

$conn = mysqli_connect('localhost','root','','metaclass');
if(mysqli_connect_error()){
    printf("%s \n", mysqli_connect_error());
    exit;
}
$select_Word = "SELECT id FROM Ingame WHERE id='$id'";
$result_Word = mysqli_query($conn, $select_Word);

if (mysqli_fetch_row($result_Word)>0) {
    $deldata = "delete from Ingame where id='$id'";
    $query = mysqli_query($conn,$deldata);
    echo "<script> 
    alert('삭제완료!');
    location.href='IngamePrint.php';
    </script>" ;
}
else{
    echo "<script> 
    alert('삭제실패! 아이디가 존재하지 않습니다.');
    location.href='IngameDel.html';
    </script>";
}
mysqli_close($conn);
?>