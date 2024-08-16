<?php
$id = $_POST['id'];

$conn = mysqli_connect('localhost','root','','metaclass');
if(mysqli_connect_error()){
    printf("%s \n", mysqli_connect_error());
    exit;
}
$select_id = "SELECT * FROM grade WHERE id='$id'";
$select_id_result = mysqli_query($conn, $select_id);

if (mysqli_fetch_array($select_id_result)>0) {
    $select_rank_query = "SELECT rank FROM grade WHERE id='$id'";
    $select_rank_result = mysqli_query($conn, $select_rank_query);
    $row = mysqli_fetch_assoc($select_rank_result);

    $delete_rank = $row['rank'];

    $update_rank_query = "UPDATE grade SET rank = rank - 1 WHERE rank > $delete_rank";
    $update_rank_result = mysqli_query($conn, $update_rank_query);
    
    $delete_id_query = "DELETE FROM grade WHERE id='$id'";
    $delete_id_result = mysqli_query($conn, $delete_id_query);
    
    echo "<script>
    alert('삭제완료!');
    location.href='GradePrint.php';
    </script>";
}
else{
    echo "<script>
    alert('삭제실패! 아이디가 존재하지않습니다.');
    location.href='GradeDel.html';
    </script>";
}
mysqli_close($conn);
?>