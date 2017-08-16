<?php 

include_once 'retrieveData.php';

if($_REQUEST['modalType'] == 'Add') //Don't worry about modalType in Curriculum. The name isn't modalTypeCurriculum.
	insertToDatabase();
else if($_REQUEST['modalType'] == 'Edit')
	editToDatabase();
else
	$REQUEST['ERRORWAWWWW'];

if($_REQUEST['dataSource'] == 'curriculum.php')
	header("Location: program.php");
else
	header("Location: " . $_REQUEST['dataSource']);


	function queryDB_generic($q){
		global $host, $user, $pwd, $db;
	    $mysqli = new mysqli($host, $user, $pwd, $db);
	    if($mysqli->connect_errno){
	        die($mysqli->connect_errno);
	    }

	    $res = $mysqli->query($q);
	    if(!$res) die("MySQL error in your QUERY " . $mysqli->error);

        $mysqli->close();

        return $res;
	}

	function hasDuplicate($q){
		$duplicateCheck  = queryDB_generic($q);

		return $duplicateCheck->num_rows > 0;
	}


	function insertToDatabase(){
		// die("INSERT BES");
		$ps = $_REQUEST['dataSource'];
		// die("INSERT TO DB " .$ps);

		if($ps == 'student.php'){
			insertToStudent();
		}else if($ps == 'subject.php')
			insertToSubject();
		else if($ps == 'nationality.php')
			insertToNationality();
		else if($ps == 'religion.php')
			insertToReligion();
		else if($ps == 'account.php')
			insertToAccount();
		else if($ps == 'program.php'){
			insertToProgram();
		}
		else if($ps == 'curriculum.php'){
			// die("Insert to Curriculum");
			insertToCurriculum();
		}else if($ps == 'semestral_grade.php')
			insertToGrade();
		else 
			echo "<h1>ERROR SONNN </h1>";
			//UNFINISHED CODEWEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE
	}



	function editToDatabase(){
		$ps = $_REQUEST['dataSource'];

		// die("EDIT TO DB ". $ps);

		if($ps == 'student.php'){
			editToStudent();
		}else if($ps == 'subject.php')
			editToSubject();
		else if($ps == 'nationality.php')
			editToNationality();
		else if($ps == 'religion.php')
			editToReligion();
		else if($ps == 'program.php')
			editToProgram();
		else if($ps == 'curriculum.php')
			editToCurriculum();
		else if($ps == 'account.php')
			editToAccount();
		else if($ps == 'semestral_grade.php')
			editToGrade();
		else
			echo die("editToDatabase ERROR. Cannot find dataSource! :((");
			//UNFINISHED CODEWEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE
	}

	function editToProgram(){
		// die("EDIT DAW SYA PROG");
		$code = $_REQUEST['txt-code'];
		$title = $_REQUEST['txt-title'];
		$year = $_REQUEST['num-year'];

		$sqliID = $_REQUEST['modalSQLID_program'];

		$q = "SELECT * FROM program WHERE (code = '$code' OR title = '$title') AND id != '$sqliID'";
		if(hasDuplicate($q))
			return;


		$q = "UPDATE program SET code = '$code', title = '$title', year = '$year' WHERE id = '$sqliID'";
		// die("UPDATE program SET code = '$code', title = '$title', year = '$year' WHERE id = '$sqliID'");
		queryDB_generic($q);
		//die($q);
		// global $host, $user, $pwd, $db;
	 //    $mysqli = new mysqli($host, $user, $pwd, $db);
	 //    if($mysqli->connect_errno){
	 //        die($mysqli->connect_errno);
	 //    }
	 //    $res = $mysqli->query($q);
		// if(!$res) die("MySQL error in editToProgram " . $mysqli->error);
		// $mysqli->close();
	}

	function editToNationality(){
		$name = $_REQUEST['txt-name'];

		$sqliID = $_REQUEST['modalSQLID'];

		$q = "SELECT * FROM nationality WHERE name = '$name' AND id != $sqliID";

		if(hasDuplicate($q))
			return;

		$q = "UPDATE nationality SET name = '$name' WHERE id = $sqliID";

		queryDB_generic($q);

		//die($q);
		// global $host, $user, $pwd, $db;
	 //    $mysqli = new mysqli($host, $user, $pwd, $db);
	 //    if($mysqli->connect_errno){
	 //        die($mysqli->connect_errno);
	 //    }
	 //    $res = $mysqli->query($q);
		// if(!$res) die("MySQL error in editToNationality " . $mysqli->error);
		// $mysqli->close();

	}

	function editToReligion(){
		$name = $_REQUEST['txt-name'];

		$sqliID = $_REQUEST['modalSQLID'];

		$q = "SELECT * FROM religion WHERE name = '$name' AND id != $sqliID";

		if(hasDuplicate($q))
			return;

		$q = "UPDATE religion SET name = '$name' WHERE id = $sqliID";
		queryDB_generic($q);

		//die($q);
		// global $host, $user, $pwd, $db;
	 //    $mysqli = new mysqli($host, $user, $pwd, $db);
	 //    if($mysqli->connect_errno){
	 //        die($mysqli->connect_errno);
	 //    }
	 //    $res = $mysqli->query($q);
		// if(!$res) die("MySQL error in editToReligon " . $mysqli->error);
		// $mysqli->close();

	}

	function editToSubject(){
		$code = $_REQUEST['txt-code'];
		$title = $_REQUEST['txt-title'];
		$unit = $_REQUEST['txt-unit'];
		$sqliID = $_REQUEST['modalSQLID'];


		$q = "SELECT * FROM subject WHERE (code = '$code' OR title = '$title') AND id != $sqliID";

		if(hasDuplicate($q))
			return;

		$q = "UPDATE subject SET code = '$code', title = '$title', unit = '$unit' WHERE id = $sqliID";
		queryDB_generic($q);
	}

	function editToStudent(){
		$lastname = $_REQUEST['txt-lastName'];
		$firstname = $_REQUEST['txt-firstName'];
		$middlename = $_REQUEST['txt-middleName'];
		$birthdate =  date('Y-m-d', strtotime($_REQUEST['date-birthDate'])); //BIRTHDATE FORMAT COPYPASTE
		//die("DATE IS $birthdate noot	");
		$program = getProgramID($_REQUEST['select-program']);
		$religion = getReligionID($_REQUEST['select-religion']);
		$nationality = getNationalityID($_REQUEST['select-nationality']);
		$yearstatus = $_REQUEST['select-yearStatus'];
		$regular = $_REQUEST['checkbox-regular'];
		$gender = $_REQUEST['gender'] == 'Male' ? 1 : 0;

		$sqliID = $_REQUEST['modalSQLID'];


		$q = "UPDATE student SET lastname = '$lastname', firstname = '$firstname', middlename = '$middlename', gender = '$gender', birthdate = '$birthdate', program_id = '$program', religion_id = '$religion', nationality_id = '$nationality', yearstatus = '$yearstatus', regular = '$regular' WHERE id = $sqliID";

		queryDB_generic($q);

		// die($q);
		// global $host, $user, $pwd, $db;
	 //    $mysqli = new mysqli($host, $user, $pwd, $db);
	 //    if($mysqli->connect_errno){
	 //        die($mysqli->connect_errno);
	 //    }

	 //    $res = $mysqli->query($q);
		// if(!$res) die("editToStudent Error " . $mysqli->error);

  //       $mysqli->close();
	}


	function editToCurriculum(){
		$curriculumID = $_REQUEST['modalSQLID_curriculum'];
		$yearTaken = $_REQUEST['select-yearTaken'];
		$semester = $_REQUEST['select-semester'];
		$subjectCode = $_REQUEST['select-subjectCode']; //Actually Returns subject_ID
		$major = isset($_REQUEST['checkbox-major']) ? 1 : 0;


		$q = "SELECT * FROM curriculum WHERE subject_id = (SELECT id FROM subject WHERE code = '$subjectCode') AND id != '$curriculumID'";
		if(hasDuplicate($q))
			return;


		$q = "UPDATE curriculum SET yeartaken = '$yearTaken', semester = '$semester', subject_id = (SELECT id FROM subject WHERE code = '$subjectCode'), ismajor = '$major' WHERE curriculum.id = '$curriculumID'";
		queryDB_generic($q);
	}

	function editToGrade(){
		$grade = $_REQUEST["num-grade"];
		$gradeID = $_REQUEST["modalSQLID"];

		$q = "UPDATE grade SET grade.grade = '$grade' WHERE grade.id = $gradeID";
		// die($q);

		queryDB_generic($q);

	}



	function insertToGrade(){
		$schoolYear = $_REQUEST['SQLschoolYear'];
		$semester = $_REQUEST['SQLsemester'];
		$subjectID = $_REQUEST['SQLsubjectID'];
		$studentID = $_REQUEST['select-student'];
		$grade = $_REQUEST["num-grade"];

		$q = "SELECT * FROM grade WHERE schoolyear = '$schoolYear' AND semester = '$semester' AND subject_id = '$subjectID' AND student_id = '$studentID'";
		if(hasDuplicate($q))
			return;
		
		$q = "INSERT INTO grade(schoolyear, semester, subject_id, student_id, grade) VALUES ('$schoolYear', '$semester', '$subjectID', '$studentID', '$grade')";
		die($q);	
		queryDB_generic($q);
	}

	function insertToAccount(){
		session_start();
		$accountID = $_SESSION['accountID'];
		$user = $_REQUEST['txt-user'];
		$password = $_REQUEST['txt-password'];
		$description = $_REQUEST['txt-description'];
		$active = $_REQUEST['checkbox-active'];
		$permitstudent = getPermission('checkbox-student');
		$permitprogram = getPermission('checkbox-program');
		$permitprogramCurriculum = getPermission('checkbox-programCurriculum');
		$permitsubject = getPermission('checkbox-subject');
		$permitnationality = getPermission('checkbox-nationality');
		$permitreligion = getPermission('checkbox-religion');
		$permitaccounts = getPermission('checkbox-account');
		$permitgrades =  getPermission('checkbox-grade');

		$q = "SELECT * FROM account WHERE uname = '$user'";
		if(hasDuplicate($q)) return;

		$q = "INSERT INTO account(uname, pword, description, active, permitstudent, permitprogram, permitsubject, permitnationality, permitreligion, permitaccounts, permitgrades, addedon, addedby_id) VALUES ('$user','$password', '$description', '$active', '$permitstudent', '$permitprogram$permitprogramCurriculum', '$permitsubject', '$permitnationality', '$permitreligion', '$permitaccounts', '$permitgrades', NOW(), '$accountID')";
		// die($q);
		queryDB_generic($q);
	}


	function getPermission($permitX){
		$permission = (array) $_REQUEST[$permitX];

		$s = "";

		foreach ($permission as $value) {
			$s .= $value;
		}

		return $s;
	}

	function editToAccount(){
		$accountID = $_REQUEST['modalSQLID'];
		$user = $_REQUEST['txt-user'];
		$password = $_REQUEST['txt-password'];
		$description = $_REQUEST['txt-description'];
		$active = $_REQUEST['checkbox-active'];
		$permitstudent = getPermission('checkbox-student');
		$permitprogram = getPermission('checkbox-program');
		$permitprogramCurriculum = getPermission('checkbox-programCurriculum');
		$permitsubject = getPermission('checkbox-subject');
		$permitnationality = getPermission('checkbox-nationality');
		$permitreligion = getPermission('checkbox-religion');
		$permitaccounts = getPermission('checkbox-account');
		$permitgrades =  getPermission('checkbox-grade');


		$q = "SELECT * FROM account WHERE uname = '$user' AND id != '$accountID'";
		if(hasDuplicate($q))
			return;

		$q = "UPDATE account SET uname = '$user', pword = '$password', description = '$description', active = '$active', ";

		$q .="permitstudent = '$permitstudent', permitprogram = '$permitprogram$permitprogramCurriculum', permitsubject = '$permitsubject', permitnationality = '$permitnationality', permitreligion = '$permitreligion', permitaccounts = '$permitaccounts', permitgrades = '$permitgrades', modifiedon = NOW(), modifiedby_id = '$accountID' WHERE id = $accountID";
		
		// die($q);
		queryDB_generic($q);
	}

	




	function insertToStudent(){
		$lastname = $_REQUEST['txt-lastName'];
		$firstname = $_REQUEST['txt-firstName'];
		$middlename = $_REQUEST['txt-middleName'];
		$birthdate =  date('Y-m-d', strtotime($_REQUEST['date-birthDate'])); //BIRTHDATE FORMAT COPYPASTE
		// die("DATE IS $birthdate noot	");
		$program = getProgramID($_REQUEST['select-program']);
		$religion = getReligionID($_REQUEST['select-religion']);
		$nationality = getNationalityID($_REQUEST['select-nationality']);
		$yearstatus = $_REQUEST['select-yearStatus'];
		$regular = $_REQUEST['checkbox-regular'];
		$gender = $_REQUEST['gender'] == 'Male' ? 1 : 0;


		$q = "INSERT INTO student(lastname, firstname, middlename, gender, birthdate, program_id, religion_id, nationality_id, yearstatus, regular) 
				VALUES ('$lastname', '$firstname', '$middlename', '$gender', '$birthdate', '$program', '$religion', '$nationality', '$yearstatus', '$regular')";
		// die($q);
		queryDB_generic($q);
	}




	function insertToReligion(){
		$name = $_REQUEST['txt-name'];

		$q = "SELECT * FROM religion WHERE name = '$name'";

		if(hasDuplicate($q))
			return;

		$q = "INSERT INTO religion(name) VALUES ('$name')";

		queryDB_generic($q);
	}

	function insertToProgram(){
		// die("WAHT");
		$code = $_REQUEST['txt-code'];
		$title = $_REQUEST['txt-title'];
		$year = $_REQUEST['num-year'];


		$q = "SELECT * FROM program WHERE code = '$code' OR title = '$title'";
		if(hasDuplicate($q)){
			return;
		}

		$q = "INSERT INTO program(code, title, year) VALUES ('$code', '$title', '$year')";

		queryDB_generic($q);
		// die($q);
		// global $host, $user, $pwd, $db;
	 //    $mysqli = new mysqli($host, $user, $pwd, $db);
	 //    if($mysqli->connect_errno){
	 //        die($mysqli->connect_errno);
	 //    }
	 //    $res = $mysqli->query($q);
		// if(!$res) die("MySQL error in insertToReligion " . $mysqli->error);
		// $mysqli->close();

	}

	function insertToCurriculum(){
		$programID = $_REQUEST['modalSQLID_programCurriculum'];
		$yearTaken = $_REQUEST['select-yearTaken'];
		$semester = $_REQUEST['select-semester'];
		$subjectCode = $_REQUEST['select-subjectCode']; //Returns subjectCode na
		$major = isset($_REQUEST['checkbox-major']) ? 1 : 0;

		$q = "SELECT * FROM curriculum WHERE subject_id = (SELECT subject.id FROM subject WHERE code = '$subjectCode') AND program_id = '$programID'";
		if(hasDuplicate($q))
			return;

		$q = "INSERT INTO curriculum(yeartaken, semester, subject_id, ismajor, program_id) VALUES
				('$yearTaken', '$semester', (SELECT subject.id FROM subject WHERE code = '$subjectCode'), '$major', '$programID')";
		// die($q);
		queryDB_generic($q);

	}


	function insertToNationality(){
		$name = $_REQUEST['txt-name'];


		$q = "SELECT * FROM nationality WHERE name = '$name'";

		if(hasDuplicate($q))
			return;


		$q = "INSERT INTO nationality(name) VALUES ('$name')";

		queryDB_generic($q);
		// die($q);
		// global $host, $user, $pwd, $db;
	 //    $mysqli = new mysqli($host, $user, $pwd, $db);
	 //    if($mysqli->connect_errno){
	 //        die($mysqli->connect_errno);
	 //    }
	 //    $res = $mysqli->query($q);
		// if(!$res) die("MySQL error in insertToNationality " . $mysqli->error);
		// $mysqli->close();
	}


	function insertToSubject(){
		$code = $_REQUEST['txt-code'];
		$title = $_REQUEST['txt-title'];
		$unit = $_REQUEST['txt-unit'];

		$q = "SELECT code, title, unit FROM subject WHERE code = '$code' OR title = '$title'";
		if(hasDuplicate($q))
			return;

		$q = "INSERT INTO subject(code, title, unit) VALUES ('$code', '$title', '$unit')";
		queryDB_generic($q);
		// global $host, $user, $pwd, $db;
	 //    $mysqli = new mysqli($host, $user, $pwd, $db);
	 //    if($mysqli->connect_errno){
	 //        die($mysqli->connect_errno);
	 //    }

	 //    $subject_res = $mysqli->query($q);
  //       $mysqli->close();
	}

	function getReligionID($religionName){
		global $host, $user, $pwd, $db;
	    $mysqli = new mysqli($host, $user, $pwd, $db);
	    if($mysqli->connect_errno){
	        die($mysqli->connect_errno);
	    }

	    $res = $mysqli->query("SELECT id from religion WHERE name = '$religionName'");

	    if(!$res) die($mysqli->error);
        $mysqli->close();

	    $res->data_seek(0);
	    $row = $res->fetch_array(MYSQLI_ASSOC);

	    return $row['id'];
	}

	function getNationalityID($nationalityName){
		global $host, $user, $pwd, $db;
	    $mysqli = new mysqli($host, $user, $pwd, $db);
	    if($mysqli->connect_errno){
	        die($mysqli->connect_errno);
	    }

	    $res = $mysqli->query("SELECT id from nationality WHERE name = '$nationalityName'");

	    if(!$res) die($mysqli->error);
        $mysqli->close();

	    $res->data_seek(0);
	    $row = $res->fetch_array(MYSQLI_ASSOC);

	    return $row['id'];

	}

	function getProgramID($programCode){
		global $host, $user, $pwd, $db;
	    $mysqli = new mysqli($host, $user, $pwd, $db);
	    if($mysqli->connect_errno){
	        die($mysqli->connect_errno);
	    }

	    $res = $mysqli->query("SELECT id FROM program WHERE program.code = '$programCode'");

	    if(!$res) die("Error in getProgramID: " . $mysqli->error);
        $mysqli->close();

	    $res->data_seek(0);
	    $row = $res->fetch_array(MYSQLI_ASSOC);

	    return $row['id'];
	}






?>