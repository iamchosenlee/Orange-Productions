﻿<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$notice_no = $_POST['notice_no'];
$title = $_POST['title'];
$content = $_POST['content'];
$emp_id = $_POST['emp_id'];
$project_id = $_POST['project_id'];
/*$added_date = $_POST['added_date'];*/


mysqli_query($conn, "set autocommit = 0"); //autocommit 해제
mysqli_query($conn, "set transaction isolation level serializable = 0"); //isolation level 설정
mysqli_query($conn, "begin"); //begin a transaction
$ret = mysqli_query($conn, "update notice set title = '$title', content = '$content', emp_id = $emp_id, project_id = $project_id where notice_no= $notice_no");

if(!$ret)
{
    mysqli_query($conn, "rollback"); //notice modify 실패, 이전으로 rollback
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    mysqli_query($conn, "commit");  // 공지사항 수정 성공, 수행 내역 commit
    s_msg ('성공적으로 수정 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=notice_list.php'>";
}

?>

