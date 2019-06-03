<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$stage_no = $_POST['stage_no'];
$project_name = $_POST['project_name'];
$genre = $_POST['genre'];
$year = $_POST['year'];
$director = $_POST['director'];
$emp_id = $_POST['emp_id'];
$synopsis = $_POST['synopsis'];

$ret = mysqli_query($conn, "insert into project (project_name, genre, year, director, emp_id, synopsis, stage_no) values('$project_name', '$genre', '$year', '$director', '$emp_id', '$synopsis', '$stage_no')");
if(!$ret)
{
	echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=project_list.php'>";
}

?>

