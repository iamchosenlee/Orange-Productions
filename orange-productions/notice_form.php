<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "notice_insert.php";
$notice_no = $_GET["notice_no"];
$query =  "select * from notice natural join employee natural join project where notice_no = $notice_no";
$res = mysqli_query($conn, $query);
$notice  = mysqli_fetch_array($res);


출처: https://ra2kstar.tistory.com/169 [초보개발자 이야기.]

if (array_key_exists("notice_no", $_GET)) {
    $notice_no = $_GET["notice_no"];
    $query =  "select * from notice natural join employee natural join project where notice_no = $notice_no";
    $res = mysqli_query($conn, $query);
    $notice  = mysqli_fetch_array($res);
    if(!$notice ) {
        msg("공지사항이 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "notice_modify.php";
}

$employee = array();

$query = "select * from employee";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $employee[$row['emp_id']] = $row['emp_name'];
}

$project = array();

$query = "select * from project";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $project[$row['project_id']] = $row['project_name'];
}


?>
    <div class="container">
        <form name="notice_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="notice_no" value="<?=$notice ['notice_no']?>"/>
            <h3>공지사항 <?=$mode?></h3>
            
            <p>
                <label for="title">제목</label>
                <input type="text" placeholder="제목 입력" id="title" name="title" value="<?=$notice ['title']?>"/>
            </p>

	        <p>
	            <label for="content">내용</label>
	            <textarea id="content" placeholder="내용 입력" name="content" rows="5"><?= $project['content'] ?></textarea>
	        </p>
	        
	        <p>
                <label for="emp_id">작성자</label>
                <select name="emp_id" id="emp_id">
                    <option value="-1">직원을 선택해 주십시오.</option>
                    <?
                        foreach($employee as $id => $name) {
                            if($id == $notice ['emp_id']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
	        
			<p>
                <label for="project_id">해당 프로젝트/영화</label>
                <select name="project_id" id="project_id">
                    <option value="-1">프로젝트/영화를 선택해 주십시오.</option>
                    <?
                        foreach($project as $id => $name) {
                            if($id == $notice ['project_id']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
			
<!--			<p>
	            <label for="added_date">작성일</label>
	            <input type="text" placeholder="작성일 입력 ex) 2019-05-19 00:00:01" id="added_date" name="added_date" value="<?= $notice ['added_date'] ?>"/>
	        </p>-->
			
            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("title").value == "") {
                        alert ("제목을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("content").value == "") {
                        alert ("내용을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("emp_id").value == "-1") {
                        alert ("작성자를 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("project_id").value == "-1") {
                        alert ("프로젝트/영화를 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("added_date").value == "") {
                        alert ("프로젝트/영화를 선택해 주십시오"); return false;
                    }


                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>