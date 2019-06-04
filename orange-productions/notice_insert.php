<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$title = $_POST['title'];
$content = $_POST['content'];
$emp_id = $_POST['emp_id'];
$project_id = $_POST['project_id'];
$added_date = date("Y-m-d H:i:s");


mysqli_query($conn, "set autocommit = 0"); //autocommit 해제
mysqli_query($conn, "set transaction isolation level serializable = 0"); //isolation level 설정
mysqli_query($conn, "begin"); //begin a transaction

$ret = mysqli_query($conn, "insert into notice (title, content, emp_id, project_id, added_date) values('$title', '$content', '$emp_id', '$project_id', '$added_date')");
if(!$ret)
{
	mysqli_query($conn, "rollback"); //notice insert 실패, 이전으로 rollback
	echo mysqli_error($conn);
    	msg('Query Error : '.mysqli_error($conn));
}
else
{
    	mysqli_query($conn, "commit");  // 공지사항 등록 성공, 수행 내역 commit
	s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=notice_list.php'>";
}

?>

