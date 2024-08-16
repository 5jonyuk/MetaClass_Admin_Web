<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Print.css">
    <title>Ingame Print</title>
</head>
<body>
<header>Ingame Table</header>
<div id="navigation">
    <a id='nav' href="IngameInput.html">Insert</a>
    <a id='nav' href="IngameDel.html">Delete</a>
    <a id='nav' href="IngameUpdate.html">Update</a>
    <a id='nav' href="../AdminHome.html">Home</a>
</div>
<?php
$conn = mysqli_connect("localhost","root","","metaclass");
if(mysqli_connect_error()){
    printf("%s \n",mysqli_connect_error());
    exit;
}

if(empty($_GET['page'])){$page=1;}
else
{$page=$_GET['page'];}
$line_page=10;
$block_page=10;
$query="select * from ingame";
$result=mysqli_query($conn,$query);
$totrow=mysqli_num_rows($result);
$totpage=ceil($totrow/$line_page);
$totblock=ceil($totpage/$block_page);
$cblock=ceil($page/$block_page);
$frow=($page-1)*$line_page;

$query = "select * from Ingame order by avg desc limit $frow, $line_page";
$result = mysqli_query($conn,$query);

print "<table border=1><tr>". 
    "<th>ID</th>".
    "<th>Name</th>".
    "<th>Game1</th>".
    "<th>Game2</th>".
    "<th>Game3</th>".
    "<th>Game4</th>".
    "<th>Game5</th>".
    "<th>Game6</th>".
    "<th>Game7</th>".
    "<th>Total</th>".
    "<th>Average</th></tr>";
    while ($row = mysqli_fetch_row($result)){
        print "<tr><td>".$row[0]. "</td>". 
        "<td>".$row[1]."</td>".
        "<td>".$row[2]."</td>".
        "<td>".$row[3]."</td>".
        "<td>".$row[4]."</td>".
        "<td>".$row[5]."</td>".
        "<td>".$row[6]."</td>".
        "<td>".$row[7]."</td>".
        "<td>".$row[8]."</td>".
        "<td>".$row[9]."</td>".
        "<td>".$row[10]."</td>
        </tr>";
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
   echo "<a id='page' href='SpeakPrint.php?page=$prvblock'>◀Prev\t</a>";
}
for($i=$fpage;$i<=$lpage;$i++)
{
	if($i==$page) echo "<b id='page_select'>$i\t</b>";
	else  echo "<a id='page' href='SpeakPrint.php?page=$i'>$i\t</a>";
}
if($cblock<$totblock)
{
	$nxtblock=(($cblock+1)*$block_page)-$block_page+1;
	echo "<a id='page' href='SpeakPrint.php?page=$nxtblock'>Next▶\t</a>";
}
?>
</div>
</html>