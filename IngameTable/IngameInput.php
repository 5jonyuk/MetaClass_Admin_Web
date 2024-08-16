<?php
$id = $_POST['id'];
$irum = $_POST['irum'];
$game1 = $_POST['game1'];
$game2 = $_POST['game2'];
$game3 = $_POST['game3'];
$game4 = $_POST['game4'];
$game5 = $_POST['game5'];
$game6 = $_POST['game6'];
$game7 = $_POST['game7'];

$conn = mysqli_connect("localhost","root","","metaclass");
if(mysqli_connect_error()){
    printf("%s \n",mysqli_connect_error());
    exit;
}

$total = $game1 + $game2 + $game3 + $game4 + $game5 + $game6 + $game7;
$avg = $total/7;

$check_member = "SELECT id FROM member WHERE id='$id'";
$check_member_result = mysqli_query($conn, $check_member);

if(mysqli_num_rows($check_member_result)>0){
    $checkId = "SELECT * FROM ingame WHERE id='$id'";
    $checkId_query = mysqli_query($conn, $checkId);

    if(mysqli_num_rows($checkId_query) > 0){
        echo "<script> 
        alert('데이터 등록실패! 키 중복 확인');
        location.href='IngameInput.html';
        </script>";
    }else{
        $inrec = "insert into Ingame values
        ('$id','$irum','$game1','$game2','$game3','$game4','$game5','$game6','$game7','$total','$avg')";
        $info = mysqli_query($conn, $inrec);

        if($info){
            echo "<script> 
            alert('데이터 등록완료!');   
            location.href = 'IngamePrint.php';
            </script>";
        }else{
            echo "<script> 
            alert('데이터 등록실패! 다시 입력하세요.');   
            location.href='IngameInput.html';
            </script>";
        }
    }
}else{
    echo "<script> 
    alert('$irum 님이 존재하지 않습니다.');   
    location.href='IngameInput.html';
    </script>";
}
mysqli_close($conn);
?>