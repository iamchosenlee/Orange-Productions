<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$emp_id = $_GET["emp_id"];
$query =  "select * from employee where emp_id = $emp_id";
$res = mysqli_query($conn, $query);
$employee = mysqli_fetch_array($res);
if(!$employee) {
   msg("직원이 존재하지 않습니다.");
}
$mode = "수정";
$action = "employee_modify.php";

/*if (array_key_exists("emp_id", $_GET)) {
    $emp_id = $_GET["emp_id"];
    $query =  "select emp_id, emp_name, email, work, dept_name from employee natural join department where emp_id = $emp_id";
    $res = mysqli_query($conn, $query);
    $employee = mysqli_fetch_array($res);
    if(!$employee) {
        msg("직원이 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "employee_modify.php";
}*/

$department = array();

$query = "select * from department";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $department[$row['dept_id']] = $row['dept_name'];
}


?>
    <div class="container">
        <form name="employee_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="emp_id" value="<?=$employee['emp_id']?>"/>
            <h3>직원 정보 <?=$mode?></h3>
            
            <p>
                <label for="emp_name">직원 이름</label>
                <input type="text" placeholder="이름 입력" id="emp_name" name="emp_name" value="<?=$employee['emp_name']?>"/>
            </p>

	        <p>
	            <label for="email">이메일</label>
	            <input type="text" placeholder="이메일 입력" id="email" name="email" value="<?= $employee['email'] ?>"/>
	        </p>
	
	        <p>
	            <label for="work">업무</label>
	            <input type="text" placeholder="업무 간략히 소개"id="work" name="work" value="<?= $employee['work'] ?>"/>
	        </p>
	        
	        <p>
                <label for="dept_id">소속 부서</label>
                <select name="dept_id" id="dept_id">
                    <option value="-1">소속 부서를 선택해 주십시오.</option>
                    <?
                        foreach($department as $id => $name) {
                            if($id == $employee['dept_id']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
	        
            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("emp_name").value == "") {
                        alert ("이름을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("email").value == "") {
                        alert ("이메일을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("work").value == "") {
                        alert ("업무를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("dept_id").value == "-1") {
                        alert ("개봉연도를 입력해 주십시오"); return false;
                    }

                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>