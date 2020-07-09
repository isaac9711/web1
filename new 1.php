<?php
$host ="localhost";
$user ="root";

$connect = mysqli_connect($host, $user) or die("mysql서버 접속 에러");
mysqli_select_db($connect, 'apm_db') or die("DB서버 접속 에러");
$YY=date('Y');
$MM=date('M');
$DD=date('D');
$dat = $YY. "-" . $MM. "-" . $DD;

$sql = "select *from count_table where REDATE = '$dat' ";
$result = mysqli_query($connect, $sql);
$list = mysqli_num_rows($result);

if(!$list) {
$count = 0;
}else{
$row=mysqli_fetch_array($result);
$count = $row['CNT'];
}
if($count ==0) {
	$count++;
	$to_sql="insert into count_table(CNT, REDATE) values ($count,'$dat')";
} else {
	$count++;
	$to_sql="update count_table set CNT = $count where redate='$dat' ";
}

mysqli_query($connect, $to_sql);

$tot_sql = "select sum(CNT) from count_table";
$tot_rst = mysqli_query($connect, $tot_sql);

$tot_row = mysqli_fetch_array($tot_rst);
$total = $tot_row[0];
mysqli_close($connect);

 echo "<font color=#086A87> [ 오늘 : ";
 for($a=0;$a<8-strlen(strval($count));$a++) echo"0";
 echo $count."] <br>";
 echo " [ 전체 : ";
 for($a=0; $a<8-strlen(strval($total));$a++) echo"0";
 echo $total."]</font>";
 ?>