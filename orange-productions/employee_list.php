<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select emp_id, emp_name, email, work, dept_name from employee natural join department order by emp_id asc";
/*    if (array_key_exists("search_keyword", $_POST)) {  // array_key_exists() : Checks if the specified key exists in the array
        $search_keyword = $_POST["search_keyword"];
        $query =  $query . " where product_name like '%$search_keyword%' or manufacturer_name like '%$search_keyword%'";
    
    }
    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }*/
    $res = mysqli_query($conn, $query);
    ?>
	<h4 align = "center"><직원 리스트></h4>
    <table class="table table-striped table-bordered">
        <thead>
        <tr align = "center">
            <th>No.</th>
            <th>성명</th>
            <th>이메일</th>
            <th>업무</th>
            <th>소속 부서</th>
            <th>기능</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td>{$row['emp_name']}</td>";
            echo "<td>{$row['email']}</td>";
            echo "<td>{$row['work']}</td>";
            echo "<td>{$row['dept_name']}</td>";
            echo "<td width='10%'>
                <a href='employee_form.php?emp_id={$row['emp_id']}'><button class='button primary small'>수정</button></a>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
</div>
<? include("footer.php") ?>
