<?php 
include_once 'template.php';
include_once 'session_verification.php';
include_once 'retrieveData.php';

?>

<!DOCTYPE html>
<html>
<head>
	<title>Student Grades</title>

	<script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src = "js/processing.js"></script> 

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>

<?php printNavbar(basename(__FILE__)); ?>

    <div class="jumbotron jumbotron-generic text-center">
        <h1>Student Grades</h1>
        <?php 
            global $host, $user, $pwd, $db;
            $mysqli = new mysqli($host, $user, $pwd, $db);
            if($mysqli->connect_errno){
                die($mysqli->connect_errno);
            }

            $studentID = $_POST['studentID'];

            $res = $mysqli->query("SELECT lastname, firstname, middlename FROM student WHERE id = '$studentID'");
            if(!$res) die("MySQL error in your QUERY " . $mysqli->error);

            $mysqli->close();

            $res->data_seek(0);
            $row = $res->fetch_array(MYSQLI_NUM);



            echo "<h3> Grades of $row[0], $row[1] $row[2] </h3>";
         ?>
        <!-- <h5>Add students to the roster by filling up a simple form!</h5> -->
    </div>

    <div class="container-fluid roster">
        <table class="table table-bordered text-center text-center" id="tbl-list">
            <tbody>
                <tr class = "text-center tr-header">
<!-- // echo   "$_SERVER['HTTP_HOST']$_SERVER['REQUEST_URI']"; -->
					<th>School Year</th>
                    <th>Semester</th>
                    <th>Subject Code</th>
                    <th>Subject Title</th>
                    <th>Unit</th>
                    <th>Grade</th>
                </tr>
        <?php printDB_studentGrade($_POST['studentID']); ?>
            </tbody>
        </table>
    </div>


<?php printFooter(); ?>

</body>
</html>