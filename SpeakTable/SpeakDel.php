<?php
$id = $_POST['id'];

$conn = mysqli_connect('localhost','root','','metaclass');
if(mysqli_connect_error()){
    printf("%s \n", mysqli_connect_error());
    exit;
}
$select_Word = "SELECT id FROM speak WHERE id='$id'";
$result_Word = $conn->query($select_Word);

if (mysqli_fetch_row($result_Word)) {
    $deldata = "delete from speak where id='$id'";
    $query = mysqli_query($conn,$deldata);
    echo "<script> 
    alert('삭제되었습니다!');
    location.href='SpeakPrint.php';
    </script>";
}
else{
    echo "<script> 
    alert('삭제실패! 해당 ID가 존재하지 않습니다.');
    location.href='SpeakDel.html';
    </script>";
}
mysqli_close($conn);
?>
