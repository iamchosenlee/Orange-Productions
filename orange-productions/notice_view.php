<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("notice_no", $_GET)) {
    $notice_no = $_GET["notice_no"];
    $query = "select notice_no, title, content, emp_name, notice.project_id, project_name, added_date from notice,employee,project where notice.emp_id = employee.emp_id AND notice.project_id = project.project_id AND notice_no= $notice_no";
    $res = mysqli_query($conn, $query);
    $notice = mysqli_fetch_assoc($res);
    if (!$notice) {
        msg("공지사항이 존재하지 않습니다.");
    }
}
?>
    <div class="container fullwidth">

        <h3>공지사항 정보 상세 보기</h3>

        <p>
            <label for="notice_no">고유 번호</label>
            <input readonly type="text" id="notice_no" name="notice_no" value="<?= $notice['notice_no'] ?>"/>
        </p>


        <p>
            <label for="title">제목</label>
            <input readonly type="text" id="title" name="title" value="<?= $notice['title'] ?>"/>
        </p>
        
        <p>
            <label for="content">내용</label>
            <textarea readonly id="content" name="content" rows="10"><?= $notice['content'] ?></textarea>
        </p>

        <p>
            <label for="emp_name">작성자</label>
            <input readonly type="text" id="emp_name" name="emp_name" value="<?= $notice['emp_name'] ?>"/>
        </p>
        
        <p>
            <label for="project_id">관련 프로젝트 고유 코드</label>
            <input readonly type="text" id="project_id" name="project_id" value="<?= $notice['project_id'] ?>"/>
        </p>
        
        <p>
            <label for="project_name">관련 프로젝트</label>
            <input readonly type="text" id="project_name" name="project_name" value="<?= $notice['project_name'] ?>"/>
        </p>

        <p>
            <label for="added_date">작성일</label>
            <input readonly type="text" id="added_date" name="added_dater" value="<?= $notice['added_date'] ?>"/>
        </p>
        

    </div>
<? include("footer.php") ?>