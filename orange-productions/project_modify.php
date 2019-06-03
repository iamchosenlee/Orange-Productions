<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$project_id = $_POST['project_id'];
$stage_no = $_POST['stage_no'];
$project_name = $_POST['project_name'];
$genre = $_POST['genre'];
$year = $_POST['year'];
$director = $_POST['director'];
$emp_id = $_POST['emp_id'];
$synopsis = $_POST['synopsis'];


$ret = mysqli_query($conn, "update project set project_name = '$project_name', genre = '$genre', year = '$year', director = '$director', emp_id = $emp_id, synopsis = '$synopsis', stage_no = $stage_no where project_id = $project_id");

if(!$ret)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 수정 되었습니다');
    if ($stage_no!=5){
    	echo "<meta http-equiv='refresh' content='0;url=project_list.php'>";
    }
    else
    {
    	echo "<meta http-equiv='refresh' content='0;url=movie_list.php'>";
    }
}

?>

