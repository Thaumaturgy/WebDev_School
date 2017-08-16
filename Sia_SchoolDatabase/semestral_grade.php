<?php 

include_once 'session_verification.php';
include_once 'template.php';
include_once 'retrieveData.php';

// session_start();
if(isset($_REQUEST['schoolyear']))
    $_SESSION['schoolyear'] = $_REQUEST['schoolyear'];
if(isset($_REQUEST['semester']))
    $_SESSION['semester'] = $_REQUEST['semester'];
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <title>Program</title>
</head>

<body>

    <?php  printNavbar(basename(__FILE__)); ?>
    <div class="jumbotron text-center">
        <h1 id="h1Title"><?php echo "School Year {$_SESSION['schoolyear']}, Semester {$_SESSION['semester']}" ?></h1>
        <h5>Here you see the subjects offered in this semester, along with the grades of the students enrolled under them</h5>
    </div>
<!--     <div class="container">
        <div class="row">
            <div class="col-md-4 pull-right">
                <button class="btn btn-success glyphicon glyphicon-plus pull-right" data-toggle="modal" data-target="#myModal" id="btn-add" onclick=" clearForm(); setAddModalType();"></button>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button class="btn btn-primary glyphicon glyphicon-search"></button>
                    </span>
                </div>
            </div>
        </div>
    </div> -->


    <div class="container">
      <h2>Grades</h2>
      <div class="panel-group" id="accordion">
        <?php printSubjectsOfSemester(); ?>
      </div>
    </div>

<div class="modal fade addEntryModal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Entry Form</h4>
                </div>
                <div class="modal-body">
                    <!--  !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!START OF THE FORM!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
                    <div class="container col-md-offset-2 col-md-8" id="form">
                        <!-- form id is unique!!!!! -->
                        <form class="form-group" method="get" action="entryHandler.php" >
                            <table class="table" id="recordForm">
                                <tr id="frm-studentID">
                                    <td>Student</td>
                                    <td>
                                    <?php 
                                        global $host, $user, $pwd, $db;
                                        $mysqli = new mysqli($host, $user, $pwd, $db);
                                        if($mysqli->connect_errno){
                                            die($mysqli->connect_errno);
                                        }

                                        $res = $mysqli->query("SELECT id, lastname, firstname, middlename FROM student ORDER BY id");
                                        $rows = $res->num_rows;
                                        echo "<select class='form-control' id='select-student' name ='select-student'>";
                                        echo $rows;
                                        for($i = 0; $i < $rows; $i++){
                                            $res->data_seek($i);
                                            $row = $res->fetch_array(MYSQLI_NUM);
                                            echo "<option value='$row[0]'>$row[0] - $row[1], $row[2] $row[3]</option>";
                                            
                                        }
                                        echo "</select>";
                                     ?>
                                    </td>
                                </tr>
                                <tr id="frm-grade">
                                    <td>Grade</td>
                                    <td>
                                        <input type="number" class="form-control" id="num-grade" name = "num-grade" min="0" max ="100" required >
                                    </td>
                                </tr>
                            </table>

                            <div class="modal-footer">
                                <div class="pull-right row">
                                    <input type="hidden" id = "SQLschoolYear" name="SQLschoolYear">
                                    <input type="hidden" id = "SQLsemester" name="SQLsemester">
                                    <input type="hidden" id = "SQLsubjectID" name="SQLsubjectID">
                                    <input type="hidden" id = "SQLstudentID" name= "SQLstudentID">
                                    <input type="hidden" id = "modalSQLID" name = "modalSQLID">
                                    <input type="hidden" id = "modalType" name="modalType">
                                    <input type="hidden" id = "dataSource" name = "dataSource"  value = <?php echo basename(__FILE__);?>>
                                    <input type="submit" id="hrefSave" name="entrySubmission" class="form-control pull-right" value="Add">
                                </div>
                            </div>
                            <!-- <button class="btn btn-primary" id = "btn-save">Save</button> -->
                        </form>
                    </div>
                    
                    <!--  !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!END OF THE FORM!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
                </div>
                
            </div>
        </div>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/processing.js"></script>    
    <?php printFooter(); ?>
</body>

</html>