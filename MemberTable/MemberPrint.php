<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Print.css">
    <title>Member Print</title>
</head>
<body>
<header>Member Table</header>
<div id="navigation">
    <!-- <a id='nav' href="MemberUpdate.html">Update</a> -->
    <a id='nav' href="MemberDel.html">Delete</a>
    <a id='nav'href="../AdminHome.html">Home</a>
</div>
<?php
$conn = mysqli_connect("localhost","root","","wordpress"); //wordpres DB 연동
if(mysqli_connect_error()){
    printf("%s \n",mysqli_connect_error());
    exit;
}
if(empty($_GET['page'])){$page=1;}
else
{$page=$_GET['page'];}
$line_page=10;
$block_page=10;
// $query="select * from member"; MetaClass 멤버
$query="select * from wp_users"; //wordpress 멤버
$result=mysqli_query($conn,$query);
$totrow=mysqli_num_rows($result);
$totpage=ceil($totrow/$line_page);
$totblock=ceil($totpage/$block_page);
$cblock=ceil($page/$block_page);
$frow=($page-1)*$line_page;

// $query = "select * from member order by regdate desc limit $frow, $line_page";
$query = "select * from wp_users order by user_registered desc limit $frow, $line_page";
$result = mysqli_query($conn,$query);

// print "<table border=1><tr>". 
//     "<th>Name</th>".
//     "<th>Id</th>".
//     "<th>Nickname</th>".
//     "<th>E-mail</th>".
//     "<th>Password</th>".
//     "<th>RegDate</th>".
//     "<th>UserMode</th></tr>";
print "<table border=1><tr>". 
    "<th>No</th>".
    "<th>Id</th>".
    "<th>Password</th>".
    "<th>Nickname</th>".
    "<th>E-mail</th>".
    "<th>Url</th>".
    "<th>user_registered</th>".
    "<th>user_activation_key</th>".
    "<th>user_status</th>".
    "<th>display_name</th></tr>";

    while ($row = mysqli_fetch_row($result)){
        print "<tr><td>".$row[0]."</td>". 
        "<td>".$row[1]."</td>".
        "<td>".$row[2]."</td>".
        "<td>".$row[3]."</td>".
        "<td>".$row[4]."</td>".
        "<td>".$row[5]."</td>".
        "<td>".$row[6]."</td>".
        "<td>".$row[7]."</td>".
        "<td>".$row[8]."</td>".
        "<td>".$row[9]."</td></tr>";
    }
    print "</table>";

mysqli_close($conn);
?>
</body>
<div id="page-container">
<?php
// 페이지 블럭 설정과 링크 작업 코드 추가
$fpage=(($cblock-1)*$block_page)+1;
$lpage=min($totpage,$cblock*$block_page);
if($cblock>1)
{
   $prvblock=($cblock-1)*$block_page;
   echo "<a id='page' href='MemberPrint.php?page=$prvblock'>◀Prev\t</a>";
}
for($i=$fpage;$i<=$lpage;$i++)
{
	if($i==$page) echo "<b id='page_select'>$i\t</b>";
	else  echo "<a id='page' href='MemberPrint.php?page=$i'>$i\t</a>";
}
if($cblock<$totblock)
{
	$nxtblock=(($cblock+1)*$block_page)-$block_page+1;
	echo "<a id='page' href='MemberPrint.php?page=$nxtblock'>Next▶\t</a>";
}
?>
</div>
</html>