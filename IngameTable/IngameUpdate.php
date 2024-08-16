<?php
$id=$_POST['id'];
$u_irum=$_POST['irum'];
$u_game1=$_POST['game1'];
$u_game2=$_POST['game2'];
$u_game3=$_POST['game3'];
$u_game4=$_POST['game4'];
$u_game5=$_POST['game5'];
$u_game6=$_POST['game6'];
$u_game7=$_POST['game7'];


$conn = mysqli_connect('localhost','root','','metaclass');
if(mysqli_connect_error()){
    printf("%s\n",mysqli_connect_error());
    exit;
}

$selectData = "SELECT irum, game1, game2, game3, game4, game5, game6, game7 
FROM ingame WHERE id='$id'";
$resultData = mysqli_query($conn,$selectData);

if($row = mysqli_fetch_assoc($resultData)){
    $old_irum_data = $row['irum'];
    $old_game1_data = $row['game1'];
    $old_game2_data = $row['game2'];
    $old_game3_data = $row['game3'];
    $old_game4_data = $row['game4'];
    $old_game5_data = $row['game5'];
    $old_game6_data = $row['game6'];
    $old_game7_data = $row['game7'];
    
    $u_irum = ($u_irum=="") ? $old_irum_data : $u_irum;
    $u_game1 = ($u_game1=="") ? $old_game1_data : $u_game1;
    $u_game2 = ($u_game2=="") ? $old_game2_data : $u_game2;   
    $u_game3 = ($u_game3=="") ? $old_game3_data : $u_game3;   
    $u_game4 = ($u_game4=="") ? $old_game4_data : $u_game4;
    $u_game5 = ($u_game5=="") ? $old_game5_data : $u_game5;
    $u_game6 = ($u_game6=="") ? $old_game6_data : $u_game6;
    $u_game7 = ($u_game7=="") ? $old_game7_data : $u_game7;

    $updateData = "UPDATE ingame SET 
    irum='$u_irum', game1='$u_game1', game2='$u_game2', game3='$u_game3', game4='$u_game4', 
    game5='$u_game5', game6='$u_game6', game7='$u_game7' 
    WHERE id='$id'";
    $updateQuery = mysqli_query($conn,$updateData);
    
    if($updateQuery){
        $u_total  = $u_game1+$u_game2+$u_game3+$u_game4+$u_game5+$u_game6+$u_game7;
        $u_avg = $u_total/7;

        $updateToT_Avg = "UPDATE ingame SET total='$u_total', avg='$u_avg' Where id='$id'";
        $updateToT_Avg_query = mysqli_query($conn,$updateToT_Avg);

        if($updateToT_Avg_query){
            echo "<script>
            alert('수정완료!');
            location.href='IngamePrint.php';
            </script>";
        }else{
            die("<script>
            alert('수정실패! 다시입력하세요.');
            location.href='IngameUpdate.html';
            </script>"); 
        }
    }else{ 
        die("<script> 
        alert('수정실패! 아이디가 존재하지 않습니다. 아이디를 다시 입력해주세요.');
        location.href='IngameUpdate.html';
        </script>");
    }
}else{
    die("<script> 
    alert('수정실패! 아이디가 존재하지 않습니다. 아이디를 다시 입력해주세요.');
    location.href='IngameUpdate.html';
    </script>");
} 
mysqli_close($conn);
?>