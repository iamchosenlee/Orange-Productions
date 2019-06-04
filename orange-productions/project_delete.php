<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$project_id = $_GET['project_id'];

mysqli_query($conn, "set autocommit = 0"); //autocommit 해제
mysqli_query($conn, "set transaction isolation level serializable = 0"); //isolation level 설정
mysqli_query($conn, "begin"); //begin a transaction

$ret = mysqli_query($conn, "delete from project where project_id = $project_id");

if(!$ret)
{
    mysqli_query($conn, "rollback"); //project delete 실패, 이전으로 rollback
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    mysqli_query($conn, "commit");  // 프로젝트 삭제 성공, 수행 내역 commit
    s_msg ('성공적으로 삭제 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=project_list.php'>";
}

?>
