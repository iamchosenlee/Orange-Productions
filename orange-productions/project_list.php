<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select project_id, project_name, stage_name, genre, year, director, emp_name from project natural join employee natural join stage where stage_no!= 5";
    $mode = "프로젝트"; //default는 <프로젝트 리스트>
    if (array_key_exists("search_keyword", $_POST)) {  // array_key_exists() : Checks if the specified key exists in the array
        $search_keyword = $_POST["search_keyword"];
        $query =  $query . " AND project_name like '%$search_keyword%' or emp_name like '%$search_keyword%'";
        $mode = "검색"; //검색했으면 <검색 리스트>
    }

    $query =  $query . " order by stage_no desc"; //가장 많이 진행된 프로젝트가 먼저 뜬다
    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    ?>
	<h4 align = "center"><<?=$mode?> 리스트></h4>

    <table class="table table-striped table-bordered">
        <thead>
        <tr align = "center">
            <th>No.</th>
            <th>프로젝트 제목</th>
            <th>진행 단계</th>
            <th>장르</th>
            <th>개봉예정</th>
            <th>감독</th>
            <th>담당자</th>
            <th>기능</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
        	echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td><a href='project_view.php?project_id={$row['project_id']}'>{$row['project_name']}</a></td>";
            echo "<td>{$row['stage_name']}</td>";
            echo "<td>{$row['genre']}</td>";
            echo "<td width='9%'>{$row['year']}</td>";
            echo "<td>{$row['director']}</td>";
            echo "<td width='8%'>{$row['emp_name']}</td>";
	        if (!array_key_exists("search_keyword", $_POST)){
				echo "<td width='17%'>
		           <a href='project_form.php?project_id={$row['project_id']}'><button class='button primary small'>수정</button></a>
		           <button onclick='javascript:deleteConfirm({$row['project_id']})' class='button danger small'>삭제</button>
		           </td>";
            }else{ //통합검색을 한 경우 수정만 할 수 있다
	            echo "<td width='10%'>
		           <a href='project_form.php?project_id={$row['project_id']}'><button class='button primary small'>수정</button></a>
		           </td>";	
            }
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
    <script>
        function deleteConfirm(product_id) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "project_delete.php?project_id=" + product_id;
            }else{   //취소
                return;
            }
        }
    </script>
</div>
<? include("footer.php") ?>
