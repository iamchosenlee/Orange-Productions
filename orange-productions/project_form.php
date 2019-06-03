<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력"; //default는 프로젝트 정보 입력
$frontmode = "프로젝트";
$action = "project_insert.php";

if (array_key_exists("project_id", $_GET)) { //특정 프로젝트나 영화를 가리키니까 수정 모드이다
    $project_id = $_GET["project_id"];
    $query =  "select * from project where project_id = $project_id";
    $res = mysqli_query($conn, $query);
    $project = mysqli_fetch_array($res);
    
    if(!$project) {
        msg("프로젝트가 존재하지 않습니다.");
    }
    $mode = "수정";
    if ($project['stage_no'] == 5){ //영화>수정 눌렀을 경우 "영화정보수정"
    	$frontmode = "영화";
    }
    $action = "project_modify.php";
}

$stage = array();

$query = "select * from stage";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $stage[$row['stage_no']] = $row['stage_name'];
}

$employee = array();

$query = "select * from employee";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $employee[$row['emp_id']] = $row['emp_name'];
}

?>
    <div class="container">
        <form name="project_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="project_id" value="<?=$project['project_id']?>"/>
            <h3><?=$frontmode?> 정보 <?=$mode?></h3>
            <p>
                <label for="stage_no">진행 단계</label>
                <select name="stage_no" id="stage_no">
                	<!--<option value="-1">현재 단계를 선택해 주십시오.</option>-->
                    <?
                        foreach($stage as $id => $name) {
                            if($id == $project['stage_no']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            <p>
                <label for="project_name">프로젝트 제목</label>
                <input type="text" placeholder="프로젝트 제목 입력" id="project_name" name="project_name" value="<?=$project['project_name']?>"/>
            </p>

	        <p>
	            <label for="genre">장르</label>
	            <input type="text" placeholder="장르 입력" id="genre" name="genre" value="<?= $project['genre'] ?>"/>
	        </p>
	
	        <p>
	            <label for="year">개봉/예정연도</label>
	            <input type="text" placeholder="ex) 1984"id="year" name="year" value="<?= $project['year'] ?>"/>
	        </p>
	        
	        <p>
	            <label for="director">감독</label>
	            <input type="text" placeholder="감독 입력" id="director" name="director" value="<?= $project['director'] ?>"/>
	        </p>
	        
			<p>
                <label for="emp_id">담당자</label>
                <select name="emp_id" id="emp_id">
                    <option value="-1">담당 PD를 선택해 주십시오.</option>
                    <?
                        foreach($employee as $id => $name) {
                            if($id == $project['emp_id']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>   
	        <p>
	            <label for="synopsis">시놉시스</label>
	            <textarea id="synopsis" placeholder="시놉시스 입력" name="synopsis" rows="10"><?= $project['synopsis'] ?></textarea>
	        </p>
 

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("stage_no").value == "-1") {
                        alert ("진행단계를 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("project_name").value == "") {
                        alert ("프로젝트명을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("genre").value == "") {
                        alert ("장르를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("year").value == "") {
                        alert ("개봉연도를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("director").value == "") {
                        alert ("감독을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("emp_name").value == "") {
                        alert ("담당자를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("synopsis").value == "") {
                        alert ("시놉시스를 입력해 주십시오"); return false;
                    }

                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>