<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select project_id, project_name, genre, year, director, emp_name, synopsis from project natural join employee where stage_no = 5 order by year asc";
	//개봉 순서대로 정렬
    $res = mysqli_query($conn, $query);
    ?>
	<h4 align = "center"><영화 리스트></h4>
    <table class="table table-striped table-bordered">
        <thead>
        <tr align = "center">
            <th>No.</th>
            <th>영화제목</th>
            <th>장르</th>
            <th>개봉연도</th>
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
            echo "<td><a href='movie_view.php?project_id={$row['project_id']}'>{$row['project_name']}</a></td>";
            echo "<td>{$row['genre']}</td>";
            echo "<td>{$row['year']}</td>";
            echo "<td>{$row['director']}</td>";
            echo "<td>{$row['emp_name']}</td>";
            echo "<td width='10%'>
                <a href='project_form.php?project_id={$row['project_id']}'><button class='button primary small'>수정</button></a>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
</div>
<? include("footer.php") ?>
