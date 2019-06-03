<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <class="fullwidth">
    	<h4 align = "center"><공지사항 리스트></h4>
		<p align="right">
    		<a href='notice_form.php'><button class='button green small'>공지사항 작성</button></a></p>
    </class>
</div> 

<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select notice_no, title, content, emp_name, project_name, added_date from notice,employee,project where notice.emp_id = employee.emp_id AND notice.project_id = project.project_id order by added_date desc";
    //제일 최근에 작성한 공지사항부터 보여준다.

    $res = mysqli_query($conn, $query);
    ?>

    <table class="table table-striped table-bordered">
        <thead>
        <tr align = "center">
            <th>No.</th>
            <th>제목</th>
            <th>관련 프로젝트</th>
            <!--<th>내용</th>-->
            <th>작성자</th>
            <th>작성일</th>
            <th>기능</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            /*echo "<td>{$row['title']}</td>";*/
            echo "<td><a href='notice_view.php?notice_no={$row['notice_no']}'>{$row['title']}</a></td>";
            echo "<td>{$row['project_name']}</td>";
            /*echo "<td width='40%'>{$row['content']}</td>";*/
            echo "<td>{$row['emp_name']}</td>";
            echo "<td>{$row['added_date']}</td>";
            echo "<td width='17%'>
                <a href='notice_form.php?notice_no={$row['notice_no']}'><button class='button primary small'>수정</button></a>
                <button onclick='javascript:deleteConfirm({$row['notice_no']})' class='button danger small'>삭제</button>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
    <script>
        function deleteConfirm(notice_no) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "notice_delete.php?notice_no=" + notice_no;
            }else{   //취소
                return;
            }
        }
    </script>
</div>
<? include("footer.php") ?>
