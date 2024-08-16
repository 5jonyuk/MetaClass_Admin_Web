<?php
$id=$_POST['id'];
$u_kl=$_POST['kl'];
$u_cl=$_POST['cl'];
$u_el=$_POST['el'];
$u_rl=$_POST['rl'];
$u_date=$_POST['u_date'];

$conn = mysqli_connect('localhost','root','','metaclass');
if(!$conn){
    printf("%s\n",mysqli_connect_error());
    exit;
}

$selectData = "SELECT * FROM word WHERE id='$id'";
$resultData = mysqli_query($conn,$selectData);

if($row = mysqli_fetch_assoc($resultData)){
    $old_kl_data = $row['kl'];
    $old_cl_data = $row['cl'];
    $old_el_data = $row['el'];
    $old_rl_data = $row['rl'];
    $old_date_data = $row['regdate'];

    $u_kl = ($u_kl=="") ? $old_kl_data : $u_kl;
    $u_cl = ($u_cl=="") ? $old_cl_data : $u_cl;
    $u_el = ($u_el=="") ? $old_el_data : $u_el;
    $u_rl = ($u_rl=="") ? $old_rl_data : $u_rl;
    $u_date = ($u_date=="") ? $old_date_data : $u_date;

    $updateData = "UPDATE word SET kl='$u_kl',cl='$u_cl',el='$u_el', rl='$u_rl',regdate='$u_date' WHERE id='$id'";
    $updateQuery = mysqli_query($conn,$updateData);

    if($updateQuery){
        echo "<script> 
        alert('데이터 수정성공!');
        location.href='WordPrint.php';
        </script>";
    }
    else{
        echo "<script> 
        alert('다시 입력해주세요!');
        location.href='WordUpdate.html';
        </script>";
    } 
}else{
    echo "<script> 
    alert('해당 ID가 존재하지 않습니다. ID를 다시 입력해주세요!');
    location.href='WordUpdate.html';
    </script>";
} 
mysqli_close($conn);
?>