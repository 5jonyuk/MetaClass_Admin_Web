<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Print.css">
    <title>Grade Print</title>
</head>
<body>
<header>Grade Table</header>
<div id="navigation">
    <a id='nav' href="GradeInput.html">Insert</a>
    <a id='nav' href="GradeDel.html">Delete</a>
    <a id='nav' href="GradeUpdate.html">Update</a>
    <a id='nav' href="../AdminHome.html">Home</a>
</div>

<?php
$conn = mysqli_connect("localhost", "root", "", "metaclass");
if(mysqli_connect_error()){
    printf("%s \n", mysqli_connect_error());
    exit;
}
if(empty($_GET['page'])){$page=1;}
else
{$page=$_GET['page'];}
$line_page=10;
$block_page=10;
$query="select * from grade";
$result=mysqli_query($conn,$query);
$totrow=mysqli_num_rows($result);
$totpage=ceil($totrow/$line_page);
$totblock=ceil($totpage/$block_page);
$cblock=ceil($page/$block_page);
$frow=($page-1)*$line_page;

// 모든 학생의 총점을 가져옵니다.
$query = "SELECT id, total FROM grade ORDER BY total DESC limit $frow, $line_page";
$result = mysqli_query($conn, $query);

if (!$result) {
    echo "데이터베이스에서 정보를 가져오는 중 문제가 발생했습니다.";
    exit;
}

// 모든 학생의 총점을 저장할 배열 초기화
$total_scores = [];

// 총점을 배열에 저장합니다.
while ($row = mysqli_fetch_assoc($result)) {
    $total_scores[] = $row['total'];
}

// 배열을 내림차순으로 정렬합니다.
rsort($total_scores);

// 랭크 변수 초기화
$rank = 0;
$prev_total = null;
$duplicate_rank = 0;
// 학생들의 순위를 업데이트합니다.
foreach ($total_scores as $total_score) {
    // 이전 총점과 다르다면 랭크를 증가시킵니다.
    if ($total_score !== $prev_total) {
        $rank = $rank + $duplicate_rank + 1;
        $duplicate_rank = 0;
    }else $duplicate_rank++;

    $prev_total = $total_score;

    // 해당 총점에 해당하는 학생들의 랭크를 업데이트합니다.
    $update_rank_query = "UPDATE grade SET rank='$rank' WHERE total='$total_score'";
    $update_rank_result = mysqli_query($conn, $update_rank_query);

    if (!$update_rank_result) {
        echo "랭크를 업데이트하는 중에 문제가 발생했습니다.";
        exit;
    }
}

// 학생들의 정보를 출력합니다.
$query = "SELECT id, irum, game, chapter, mid, final, total, rank FROM grade ORDER BY rank";
$result = mysqli_query($conn, $query);

print "<table border=1><tr>".
    "<th>ID</th>".
    "<th>NAME</th>".
    "<th>GAME</th>".
    "<th>CHAPTER</th>".
    "<th>MID</th>".
    "<th>FINAL</th>". 
    "<th>TOTAL</th>".
    "<th>RANK</th></tr>";

while ($row = mysqli_fetch_assoc($result)) {
    print "<tr><td>".$row['id']."</td>".
        "<td>".$row['irum']."</td>".
        "<td>".$row['game']."</td>".
        "<td>".$row['chapter']."</td>".
        "<td>".$row['mid']."</td>".
        "<td>".$row['final']."</td>". 
        "<td>".$row['total']."</td>".
        "<td>".$row['rank']."</td></tr>";
}

print "</table>";

mysqli_close($conn);
?>

<div id="page-container">
<?php
// 페이지 블럭 설정과 링크 작업 코드 추가
$fpage=(($cblock-1)*$block_page)+1;
$lpage=min($totpage,$cblock*$block_page);
if($cblock>1)
{
   $prvblock=($cblock-1)*$block_page;
   echo "<a id='page' href='GradePrint.php?page=$prvblock'>◀Prev\t</a>";
}
for($i=$fpage;$i<=$lpage;$i++)
{
	if($i==$page) echo "<b id='page_select'>$i\t</b>";
	else  echo "<a id='page' href='GradePrint.php?page=$i'>$i\t</a>";
}
if($cblock<$totblock)
{
	$nxtblock=(($cblock+1)*$block_page)-$block_page+1;
	echo "<a id='page' href='GradePrint.php?page=$nxtblock'>Next▶\t</a>";
}
?>
</div>