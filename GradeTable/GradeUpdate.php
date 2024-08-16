<?php
$id=$_POST['id'];
$u_irum=$_POST['irum'];
$u_game=$_POST['game'];
$u_chapter=$_POST['chapter'];
$u_mid=$_POST['mid'];
$u_final=$_POST['final'];

$conn = mysqli_connect('localhost','root','','metaclass');
if(mysqli_connect_error()){
    printf("%s\n",mysqli_connect_error());
    exit;
}

$selectData = "SELECT irum,game,chapter,mid,final FROM grade WHERE id='$id'";
$resultData = mysqli_query($conn,$selectData);

if($row = mysqli_fetch_assoc($resultData)){
    $old_irum_data = $row['irum'];
    $old_game_data = $row['game'];
    $old_chapter_data = $row['chapter'];
    $old_mid_data = $row['mid'];
    $old_final_data = $row['final'];

    $u_irum = ($u_irum=="") ? $old_irum_data : $u_irum;
    $u_game = ($u_game=="") ? $old_game_data : $u_game;
    $u_chapter = ($u_chapter=="") ? $old_chapter_data : $u_chapter;
    $u_mid = ($u_mid=="") ? $old_mid_data : $u_mid;
    $u_final = ($u_final=="") ? $old_final_data : $u_final;

    $u_total = $u_game + $u_chapter + $u_mid + $u_final;
    
    $updateData = "UPDATE grade SET 
    irum='$u_irum',game='$u_game',chapter='$u_chapter', mid='$u_mid',final='$u_final',total='$u_total' 
    WHERE id='$id'";
    $updateQuery = mysqli_query($conn,$updateData);

    if($updateQuery){
        echo "<script>
        alert('변경완료!');
        location.href='GradePrint.php';
        </script>";
    } else {
        echo "<script>
        alert('다시 입력해주세요!');
        location.href='GradeUpdate.html';
        </script>";
    }
} else {
    echo "<script>
    alert('해당 ID가 존재하지 않습니다.');
    location.href='GradeUpdate.html';
    </script>";
}
mysqli_close($conn);
?>