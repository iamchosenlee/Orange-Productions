<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$emp_id = $_POST['emp_id'];
$emp_name = $_POST['emp_name'];
$dept_id = $_POST['dept_id'];
$email = $_POST['email'];
$work = $_POST['work'];


$ret = mysqli_query($conn, "update employee set emp_name = '$emp_name', dept_id = $dept_id, email = '$email', work = '$work' where emp_id = $emp_id");

if(!$ret)
{
    msg('Query Error : '.mysqli_error($conn));
    echo "error";
}
else
{
    s_msg ('성공적으로 수정 되었습니다');

    echo "<meta http-equiv='refresh' content='0;url=employee_list.php'>";
}

?>

