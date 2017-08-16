
<?php

// session_start();
$host = 'localhost';
$user = 'encoder';
$pwd = 'encoder';
$db = 'school';
    
    function getURL($src, $col){
        $url ="". "$src?col=$col";
        //Removed single quotes here. Be cautious!
        if(!isset($_REQUEST["sortType"]))
            $url .= "&sortType=DESC class = 'glyphicon glyphicon-triangle-bottom'";
        else if($_REQUEST["sortType"] == 'DESC')
            $url .= "&sortType=ASC class = 'glyphicon glyphicon-triangle-top'";
        else
            $url .= "&sortType=DESC class = 'glyphicon glyphicon-triangle-bottom'";

        return $url;
    }

    function smearFilename($file){
        echo basename($file, 'php');
    }

    //backup getURL function
    function getURL2($src, $col){
        $url ="'". "$src?col=$col";
        if(isset($_REQUEST["sortType"])){

            if($_REQUEST["sortType"] == 'DESC')
                $url .= "&sortType=ASC' class = 'glyphicon glyphicon-triangle-top'";
            else
                $url .= "&sortType=DESC' class = 'glyphicon glyphicon-triangle-bottom'";
        }
        else{
            $url .= "&sortType=DESC' class = 'glyphicon glyphicon-triangle-bottom'";
        }
        echo $url;
    }

    function printDB_generic($q, $permissionName, $optionsIndex){
        $res = querySchoolDB($q);
        $rows = $res->num_rows;
        for($i = 0; $i < $rows; $i++){
            $res->data_seek($i);
            echo "<tr>";

            $row = $res->fetch_array(MYSQLI_NUM);

            
            
            for($j = 0; $j < count($row)-1; $j++){
                echo "<td>$row[$j]</td>";
            }

            $hide =  $_SESSION[$permissionName][$optionsIndex] == 0 ? 'hidden' : '';

            echo "<td>
                    <div class='btn-group $hide'>
                        <button type ='button' class = 'btn btn-success glyphicon glyphicon-pencil' data-toggle = 'modal', data-target = '#myModal' onclick='loadToModal(this), setEditModalType(); setSQLID({$row[count($row)-1]});' ></button>
                        <button type ='button'class = 'btn btn-danger glyphicon glyphicon-trash' width = 100px></button>

                    </div>
                </td>";
            echo "</tr>";
        }
    }

    function printDB_student(){

        $res = querySchoolDB("SELECT lastname, firstname, middlename, IF(gender = 0, 'Female', 'Male') AS gender, DATE_FORMAT(birthdate,'%M %d, %Y'), program.code, religion.name, nationality.name, yearstatus, IF(regular = 0, 'Regular', 'Irregular') AS regular, student.id from student LEFT OUTER JOIN program ON program.id = student.program_id LEFT OUTER JOIN religion ON religion.id = student.religion_id JOIN nationality ON nationality.id = student.nationality_id", "permitstudent");
        $rows = $res->num_rows;
        for($i = 0; $i < $rows; $i++){
            $res->data_seek($i);
            echo "<tr>";

            $row = $res->fetch_array(MYSQLI_NUM);

            
            
            for($j = 0; $j < count($row)-1; $j++){
                echo "<td>$row[$j]</td>";
            }

            $hideEdit =  $_SESSION['permitstudent'][2] == 0 ? 'hidden' : '';

            $hideViewGrade =  $_SESSION['permitstudent'][3] == 0 ? 'hidden' : '';

            $btngroup = '';

            if($hideEdit != 'hidden' && $hideViewGrade != 'hidden')
                $btngroup = 'btn-group';


            echo "<td>
                    <form action='student_grade.php' method = 'post' class = '$btngroup'>
                        <button type ='button' class = 'btn btn-success glyphicon glyphicon-pencil $hideEdit' data-toggle = 'modal' title = 'Edit Student' data-target = '#myModal' onclick='loadToModal(this), setEditModalType(); setSQLID({$row[count($row)-1]});'></button>
                        <input type='hidden' value = '{$row[count($row)-1]}' name = 'studentID'>
                        <button type = 'submit' class = 'btn btn-warning glyphicon glyphicon-list-alt $hideViewGrade' data-toggle='tooltip' title = 'View Grades'></button>
                    </form>
                </td>";
            echo "</tr>";
        }
    }


    function printDB_studentGrade($studentID){
        $q = "SELECT schoolyear, semester, subject.code, subject.title, unit, grade.grade
                FROM grade 
                JOIN student ON grade.student_id = student.id 
                JOIN subject ON grade.subject_id = subject.id
                JOIN program ON program.id = student.program_id
                WHERE student.id = '$studentID'";

        global $host, $user, $pwd, $db;
        $mysqli = new mysqli($host, $user, $pwd, $db);
        if($mysqli->connect_errno){
            die($mysqli->connect_errno);
        }

        $res = $mysqli->query($q);
        if(!$res)
            die($mysqli->$mysqli->error);

        $rows = $res->num_rows;
        for($i = 0; $i < $rows; $i++){
            $res->data_seek($i);
            echo "<tr>";

            $row = $res->fetch_array(MYSQLI_NUM);
            // die("inside");
            for($j = 0; $j < count($row); $j++){
                echo "<td>$row[$j]</td>";
            }
        }

    }


    function printDB_account(){

        $account_res = querySchoolDB("SELECT uname, pword, description, IF(active = 1, 'Active', 'Inactive'), id FROM account");

        $rows = $account_res->num_rows;

        for ($i=0; $i < $rows; $i++) { 
            echo "<tr>";
            $account_res->data_seek($i);
            $row = $account_res->fetch_array(MYSQLI_NUM);

            for($j = 0; $j < count($row)-1; $j++){
                echo "<td>$row[$j]</td>";
            }

            printDB_accountPrivileges($row[count($row)-1]);

            $hide = $_SESSION['permitaccounts'][2] == 0 ? 'hidden' : '';

            echo "<td>
                    <div class='btn-group $hide'>
                        <button type ='button' class = 'btn btn-success glyphicon glyphicon-pencil' data-toggle = 'modal', data-target = '#myModal' onclick='loadToModal(this), setEditModalType(); setSQLID({$row[count($row)-1]});' ></button>
                        <button type ='button'class = 'btn btn-danger glyphicon glyphicon-trash' width = 100px></button>
                    </div>
                </td>";
            echo "</tr>";
        }
    }

    function printDB_accountPrivileges($accountID){

        global $host, $user, $pwd, $db;
        $mysqli = new mysqli($host, $user, $pwd, $db);
        if($mysqli->connect_errno){
            die($mysqli->connect_errno);
        }

        $res = $mysqli->query("SELECT permitstudent, permitprogram, permitsubject, permitnationality, permitreligion, permitaccounts, permitgrades FROM account WHERE account.id = '$accountID'");

        $mysqli->close();


        $res->data_seek(0); //Seek 0 cuz only 1 row returned!
        $row = $res->fetch_array(MYSQLI_NUM);

        for($i = 0; $i < count($row); $i++){
            echo "<td hidden>$row[$i]</td>";
        }
    }




    function printDB_subject(){

        $subject_res = querySchoolDB("SELECT DISTINCT schoolyear, semester FROM grade");

        $rows = $subject_res->num_rows;
        
        for ($i=0; $i < $rows; $i++) { 
            echo "<tr>";
            $subject_res->data_seek($i);
            $row = $subject_res->fetch_array(MYSQLI_NUM);

            for($j = 0; $j < count($row); $j++){
                echo "<td> $row[$j] </td>";
            }

            echo "<td class = 'col-md-4'>
                    <form action='semestral_grade.php' method = 'get' class='form'>
                        <div class='form-group col-md-offset-2 col-md-8'>
                            <button type ='submit' class = 'btn btn-info form-control' value = 'View Subjects Offered'> 
                                <span class = 'glyphicon glyphicon-eye-open'></span> View Subjects Offered
                            </button>
                            <input type='hidden' name = 'schoolyear' value = '$row[0]'>
                            <input type='hidden' name = 'semester' value = '$row[1]'>
                        </div>
                    </form>
                </td>";
            echo "</tr>";
        }
    }

    function printDB_grades($subject_id, $schoolyear, $semester){
        global $host, $user, $pwd, $db;
        $mysqli = new mysqli($host, $user, $pwd, $db);
        if($mysqli->connect_errno){
            die($mysqli->connect_errno);
        }

        $students_res = $mysqli->query("SELECT lastname, firstname, middlename, (SELECT CASE WHEN gender = 0 THEN 'Female' ELSE 'Male' END) , grade.grade, grade.id AS 'grade.id', student.id AS 'student.id' FROM grade JOIN student ON grade.student_id = student.id JOIN subject ON grade.subject_id = subject.id WHERE subject.id = $subject_id AND schoolyear = '$schoolyear' AND semester = '$semester'");


        if(!$students_res) die("WTF " . $mysqli->error);
            $mysqli->close();

            $students_rows = $students_res->num_rows;

            for($i = 0; $i < $students_rows; $i++){
                $students_res->data_seek($i);
                $students_row = $students_res->fetch_array(MYSQLI_NUM);
                echo "<tr>";

                $studentID = $students_row[count($students_row) - 1];

                for($j = 0; $j < count($students_row) - 2; $j++){
                    echo "<td>$students_row[$j]</td>";
                }


                $hide = $_SESSION['permitgrades'][2] == 0 ? 'hide' : '';

                echo "<td>
                    <div class='btn-group $hide'>
                        <button type ='button' class = 'btn btn-success glyphicon glyphicon-pencil' data-toggle = 'modal', data-target = '#myModal' onclick='setGradeEdit($studentID);; loadToModal(this), setEditModalType(); setSQLID({$students_row[count($students_row)-2]});' ></button>
                        <button type ='button'class = 'btn btn-danger glyphicon glyphicon-trash' width = 100px></button>

                    </div>
                </td>";
                
                echo "<td name = 'gradeID' hidden> {$students_row[count($students_row)-1]}</td>"; //Stores the MySQL ID of each row!
                echo "</tr>";
            }

    }

    function printSubjectsOfSemester(){
        global $host, $user, $pwd, $db;
        $mysqli = new mysqli($host, $user, $pwd, $db);
        if($mysqli->connect_errno){
            die($mysqli->connect_errno);
        }

        $schoolYear = $_SESSION['schoolyear'];
        $semester = $_SESSION['semester'];


        $semestral_res = $mysqli->query("SELECT DISTINCT code, title, subject.id AS 'subject.id' FROM subject JOIN grade ON grade.subject_id = subject.id WHERE schoolyear = '$schoolYear' AND semester = '$semester'");
        $q = "SELECT DISTINCT code, title, subject.id AS 'subject.id', grade.id AS 'grade.id' FROM subject JOIN grade ON grade.subject_id = subject.id WHERE schoolyear = '$schoolYear' AND semester = '$semester'";
        // die($q);

        $mysqli->close();

         $semestral_rows = $semestral_res->num_rows;


            for($i = 0; $i < $semestral_rows; $i++){
                $semestral_res->data_seek($i);
                $semestral_row = $semestral_res->fetch_array(MYSQLI_ASSOC);

                $subjectID = $semestral_row['subject.id'];




                // $hideAddGrade = '';

                $hide = $_SESSION['permitgrades'][1] == 0 ? 'hidden' : '';

                echo <<<PANELHEAD
                <div class="panel panel-default">
                    <div class="panel-heading">
                    <div class='pull-right $hide'>
                    <button type ='button' class = 'btn btn-info glyphicon glyphicon-plus' data-toggle = 'modal', data-target = '#myModal' value = $i onclick='setAddModalType(); setGradesAdd($subjectID, $schoolYear, $semester); enableSelectStudent(true); '></button> <!-- Careful. Double quotes -->
                    </div>

                    <div class="program-panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse$i">
                        <h4 class="panel-title">{$semestral_row['code']}</h4>
                        <h5 class="panel-title">{$semestral_row['title']}</h5>
                    </div>
                        <div id="collapse$i" class="panel-collapse collapse">
                            <div class="panel-body">
                                <table class="table table-bordered text-center">
                                    <tbody>
                                        <tr class="tr-header">
                                            <th>Last Name</th>
                                            <th>First Name</th>
                                            <th>Middle Name</th>
                                            <th>Gender</th>
                                            <th>Grade</th>
                                            <th>Options</th>

                                            <th name = 'subjectID' hidden> {$semestral_row['subject.id']} </th>
                                        </tr>
PANELHEAD;
                                        printDB_grades($semestral_row['subject.id'], $schoolYear, $semester);
            echo <<<PANELHEAD
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
PANELHEAD;

            }
    }

    function printDB_program(){
        $program_res = querySchoolDB("SELECT program.code as 'program.code', title, year, id FROM program");
        $prog_rows = $program_res->num_rows;
        // $hide = $_SESSION['permitprogram'][3] == 0 ? 'hidden' : '';
        $hideProgramAdd = $_SESSION['permitprogram'][1] == 0 ? 'hidden' : '';
        $hideCurriculumAdd = $_SESSION['permitprogram'][4] == 0 ? 'hidden' : '';
        $hideCurriculum = $_SESSION['permitprogram'][3] == 0 ? '' : 'collapse';

        for($i = 0; $i < $prog_rows; $i++){
            $program_res->data_seek($i);
            $program_row = $program_res->fetch_array(MYSQLI_ASSOC);

            echo <<<PANELHEAD
            <div class="panel panel-default">
                <div class="panel-heading">
                <div class='btn-group pull-right $hideProgramAdd'>
                    <button type ='button' class = 'btn btn-success glyphicon glyphicon-pencil' data-toggle = 'modal', data-target = '#myModal' value = $i onclick='clearForm(); setProgram_Curriculum("program"); loadToModal(this); setEditModalType(); setProgramID({$program_row['id']}); '></button> <!-- Careful. Double quotes -->
                    <button type ='button'class = 'btn btn-danger glyphicon glyphicon-trash' width = 100px></button>
                </div>
                <div class="program-panel-heading" data-toggle="$hideCurriculum" data-parent="#accordion" href="#collapse$i">
                    <h2 class="panel-title" class = 'hCode' value = '{$program_row['program.code']}'>{$program_row['program.code']}</h2>
                    <h5 class="panel-title" class = 'hTitle' value = '{$program_row['title']}'>{$program_row['title']}</h5>
                    <span class = "panel-title" class = 'hYear' value = '{$program_row['year']}'>{$program_row['year']} Years</span>
                    
                </div> 
                    <div id="collapse$i" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table table-bordered text-center">
                                <tbody>
                                    <tr class="tr-header">
                                        <th>Year Taken</th>
                                        <th>Semester</th>
                                        <th>Subject Code</th>
                                        <th>Subject Title</th>
                                        <th>Unit</th>
                                        <th>Major</th>                                            
                                        <th>Options</th>
                                        <th name = {$program_row['id']} hidden> {$program_row['id']} </th>
                                    </tr>

PANELHEAD;
            echo <<<ADDBUTTON
            <button class="btn btn-warning glyphicon glyphicon-plus pull-right btn-accordion-add $hideCurriculumAdd" data-toggle="modal" data-target="#myModalCurriculum" onclick=" clearForm(); setAddModalType(); setProgramID({$program_row['id']})" title = "Add Subject to Curriculum"></button>
ADDBUTTON;
                                    printDB_curriculum($program_row['program.code']);
        echo <<<PANELHEAD
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
PANELHEAD;

        }
    }

    function printDB_curriculum($program_code){
        global $host, $user, $pwd, $db;
        $mysqli = new mysqli($host, $user, $pwd, $db);
        if($mysqli->connect_errno){
            die($mysqli->connect_errno);
        }

        $curriculum_res = $mysqli->query("SELECT yeartaken, semester, subject.code as 'subject.code', subject.title, subject.unit, IF(ismajor = 0, 'Minor', 'Major') AS ismajor, curriculum.id FROM curriculum JOIN program ON curriculum.program_id = program.id JOIN subject ON curriculum.subject_id = subject.id WHERE program.code = '$program_code' ORDER BY yeartaken, semester");

        if(!$curriculum_res) die($mysqli->error);
        $mysqli->close();

        $curriculum_rows = $curriculum_res->num_rows;
        $hide = $_SESSION['permitaccounts'][2] == 0 ? 'hidden' : '';


        for($i = 0; $i < $curriculum_rows; $i++){
            $curriculum_res->data_seek($i);
            $curriculum_row = $curriculum_res->fetch_array(MYSQLI_NUM);
            echo "<tr>";
            $curriculum_cols = count($curriculum_row);
            for($j = 0; $j < $curriculum_cols-1; $j++){
                echo "<td>$curriculum_row[$j]</td>";
            }

// I CHANGE THE MODAL ID HERE
            echo <<<EDITBUTTON
                <td>
                    <div class='btn-group $hide'>
                    <button type ='button' class = 'btn btn-success glyphicon glyphicon-pencil' data-toggle = 'modal', data-target = '#myModalCurriculum' value = '$i' onclick='setProgram_Curriculum("curriculum"); loadToModal(this), setEditModalType(); setCurriculumID({$curriculum_row[count($curriculum_row)-1]});' ></button>
                    <button type ='button' class = 'btn btn-danger glyphicon glyphicon-trash' width = 100px></button>
                    </div>
                </td>
EDITBUTTON;
//            echo "<td name = 'sqlID' value = '{$curriculum_row[count($curriculum_row)-1]}' hidden> {$curriculum_row[count($curriculum_row)-1]} </td>"; //Stores the MySQL ID of each row!
            echo "</tr>";
        }
    }
    function querySchoolDB($q){
        global $host, $user, $pwd, $db;
        $mysqli = new mysqli($host, $user, $pwd, $db);
        if($mysqli->connect_errno){
            die($mysqli->connect_errno);
        }

        $q .= getSortOrder();

        $res = $mysqli->query($q);
        if(!$res) die($mysqli->error);

        $mysqli->close();
        return $res;
    }

    function getSortOrder(){
        $order = "";
        if(isset($_REQUEST["col"])){
            $order .= " ORDER BY {$_REQUEST['col']}";
        }else{
            $order .= " ORDER BY 1";
        }

        if(isset($_REQUEST["sortType"])){
            // $order += " $_REQUEST['sortType']";
            if($_REQUEST["sortType"] == 'DESC'){
                $order .= " DESC";
            }
        }

        return $order;
    }

?>