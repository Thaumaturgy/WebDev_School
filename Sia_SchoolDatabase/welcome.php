<?php 

include_once 'session_verification.php';
include_once 'template.php';
include_once 'retrieveData.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Student Enrollment System</title>
		<link rel="stylesheet" href="css/welcome.css">
    </head>
    <body>
        <div class="flex-center full-height" >
            <div class="content">
                <img src="img/sample-school-logo.png" alt="school-logo" class="school-logo">
                <div class="title m-b-md">
                    SPRUCEWRIGHT COLLEGIATE<br> INSTITUTE OF POLITICS
                </div>

                <div class="links">
                    <a href="student.php">Student</a>
                    <a href="grade.php">Grade</a>
                    <a href="program.php">Program</a>
                    <a href="subject.php">Subject</a>
                    <a href="nationality.php">Nationality</a>
                    <a href="religion.php">Religion</a>
                    <a href="account.php">Account</a>
                </div>
                <div class="links">
                    <span class = "top-right"> <?php echo getUsername(); ?> </span>
                </div>
                <div class = "links"><a class = "top-right" href="logout.php"><h5>Logout</h5></a></div>
            </div>
        </div>
        
    </body>
</html>


