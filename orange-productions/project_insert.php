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

mysqli_query($conn, "set autocommit = 0"); //autocommit 해제
mysqli_query($conn, "set transaction isolation level serializable = 0"); //isolation level 설정
mysqli_query($conn, "begin"); //begin a transaction
$ret = mysqli_query($conn, "insert into project (project_name, genre, year, director, emp_id, synopsis, stage_no) values('$project_name', '$genre', '$year', '$director', '$emp_id', '$synopsis', '$stage_no')");
if(!$ret)
{
	mysqli_query($conn, "rollback"); //project insert 실패, 이전으로 rollback
	echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}
else
{
	mysqli_query($conn, "commit");  // 프로젝트 입력 성공, 수행 내역 commit
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=project_list.php'>";
}

?>

