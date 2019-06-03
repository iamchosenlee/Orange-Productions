<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("project_id", $_GET)) {
    $project_id = $_GET["project_id"];
    $query = "select project_id, project_name, stage_name, genre, year, director, emp_name, synopsis from project natural join employee natural join stage where project_id= $project_id";
    $res = mysqli_query($conn, $query);
    $project = mysqli_fetch_assoc($res);
    if (!$project) {
        msg("영화가 존재하지 않습니다.");
    }
}
?>
    <div class="container fullwidth">

        <h3>프로젝트 정보 상세 보기</h3>

        <p>
            <label for="project_id">고유 코드</label>
            <input readonly type="text" id="project_id" name="project_id" value="<?= $project['project_id'] ?>"/>
        </p>


        <p>
            <label for="project_name">프로젝트 제목</label>
            <input readonly type="text" id="project_name" name="project_name" value="<?= $project['project_name'] ?>"/>
        </p>
        
        <p>
            <label for="stage_name">진행 단계</label>
            <input readonly type="text" id="stage_name" name="stage_name" value="<?= $project['stage_name'] ?>"/>
        </p>


        <p>
            <label for="genre">장르</label>
            <input readonly type="text" id="genre" name="genre" value="<?= $project['genre'] ?>"/>
        </p>

        <p>
            <label for="year">개봉예정연도</label>
            <input readonly type="text" id="year" name="year" value="<?= $project['year'] ?>"/>
        </p>
        
        <p>
            <label for="director">감독</label>
            <input readonly type="text" id="director" name="director" value="<?= $project['director'] ?>"/>
        </p>
        
        <p>
            <label for="emp_name">담당 PD</label>
            <input readonly type="text" id="emp_name" name="emp_name" value="<?= $project['emp_name'] ?>"/>
        </p>
                
        <p>
            <label for="synopsis">시놉시스</label>
            <textarea readonly id="synopsis" name="synopsis" rows="10"><?= $project['synopsis'] ?></textarea>
        </p>

    </div>
<? include("footer.php") ?>