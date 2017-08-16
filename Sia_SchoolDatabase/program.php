<?php 

include_once 'session_verification.php';
include_once 'template.php';
include_once 'retrieveData.php';

if($_SESSION['permitprogram'][0] == 0){
        header("Location: welcome.php");
    }
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
    <div class="jumbotron jumbotron-generic text-center">
        <h1>Program</h1>
        <h5>Here you can add programs and check out each program's curriculum</h5>
        <div class="container">
            <button class="btn btn-info glyphicon glyphicon-plus <?php echo $_SESSION['permitprogram'][1] == 0 ? 'hide' : '' ; ?>" data-toggle="modal" data-target="#myModal" id="btn-add" onclick="setAddModalType(); clearForm()"></button>
        </div>
    </div>
    

    <!-- PROGRAM MODAL -->
    <div class="container">
      <h2>Undergraduate Programs</h2>
      <div class="panel-group" id="accordion">
        <?php printDB_program(); ?>
      </div>
    </div>
      
    <div class="modal fade addEntryModal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Entry Form</h4>
                </div>
                <div class="modal-body"> <!-- MODAL FOR PROGRAM -->
                    <!--  !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!START OF THE FORM!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
                    <div class="container col-md-offset-2 col-md-8" id="form">
                        <!-- form id is unique!!!!! -->
                        <form class="form-group" method="get" action="entryHandler.php" >
                        
                            <table class="table" id="recordForm">
                                <tr id="frm-studentID">
                                    <td>Code</td>
                                    <td>
                                        <input type="text" class="form-control" id="txt-code" name = "txt-code" required="true" maxlength="60">
                                    </td>
                                </tr>
                                <tr id="frm-subjectID">
                                    <td>Title</td>
                                    <td>
                                        <input type="text" class="form-control" id="txt-title" name = "txt-title" required="true" maxlength="120">
                                    </td>
                                </tr>
                                <tr id="frm-schoolYear" required="true">
                                    <td>Year</td>
                                    <td>
                                        <input type="number" class="form-control" id="num-year" name = "num-year" min="1" max="5" required="true">
                                    </td>
                                </tr>
                            </table>
                            <!-- <button class="btn btn-primary" id = "btn-save">Save</button> -->
                            <div class="modal-footer">
                                <div class="pull-right row">
                                    <input type="hidden" name = "dataSource"  value = "<?php echo basename(__FILE__);?>">
                                    <input type="hidden" id = "modalType" name="modalType">
                                    <input type="hidden" id = "modalSQLID_program" name = "modalSQLID_program">
                                    <input type="submit" id="hrefSave" name="entrySubmission" class="form-control pull-right" value="Add">
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--  !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!END OF THE FORM!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade addEntryModal" id="myModalCurriculum" tabindex="-1" role="dialog" aria-labelledby="myModalLabelCurriculum">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabelCurriculum">Entry Form</h4>
                </div>
                <div class="modal-body">
                    <!--  !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!START OF THE FORM!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
                    <div class="container col-md-offset-2 col-md-8" id="formCurriculum">
                        <!-- form id is unique!!!!! -->
                        <form class="form-group" method="get" action="entryHandler.php" >
                            <table class="table" id="recordFormCurriculum">
                                <tr id="frm-yeartTaken">
                                    <td>Year Taken</td>
                                    <td>
                                        <select id="select-yearTaken" name = "select-yearTaken" class="form-control">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr id="frm-semester">
                                    <td>Semester</td>
                                    <td>
                                        <select id="select-semester" name = "select-semester" class="form-control">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr id="frm-subjectCode">
                                    <td>Subject Code</td>
                                    <td>

                                        <?php 
                                            global $host, $user, $pwd, $db;
                                            $mysqli = new mysqli($host, $user, $pwd, $db);
                                            if($mysqli->connect_errno){
                                                die($mysqli->connect_errno);
                                            }

                                            $res = $mysqli->query("SELECT code, id FROM subject ORDER BY code");
                                            $rows = $res->num_rows;
                                            echo "<select class='form-control' id='select-subjectCode' name ='select-subjectCode'>";
                                            echo $rows;
                                            for($i = 0; $i < $rows; $i++){ 
                                                $res->data_seek($i);
                                                $row = $res->fetch_array(MYSQLI_NUM);

                                                echo "<option value='$row[0]'> $row[0] </option>";
                                            }
                                            echo "</select>";
                                         ?>
                                    </td>
                                </tr>
                                <tr id="frm-major">
                                    <td>Major</td>
                                    <td>
                                        <input type="checkbox" id="checkbox-major" name = "checkbox-major">
                                    </td>
                                </tr>
                            </table>

                            <div class="modal-footer">
                                <div class="pull-right row">
                                    <!-- <input type="hidden" id = "dataSource" name = "dataSource"  value = <?php //echo basename(__FILE__);?>> -->
                                    <input type="hidden" id = "modalSQLID_programCurriculum" name = "modalSQLID_programCurriculum">
                                    <input type="hidden" id = "modalTypeCurriculum" name="modalType">
                                    <input type="hidden" id = "modalSQLID_curriculum" name = "modalSQLID_curriculum">
                                    <input type="hidden" name = "dataSource"  value = "curriculum.php">
                                    <input type="submit" id="hrefSaveCurriculum" name="entrySubmission" class="form-control pull-right" value="Add">
                                </div>
                            </div>
                        </form>
                    <!--  !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!END OF THE FORM!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
                    </div>
                </div>

            </div>
        </div>
    </div>

    
    <script src="js/jquery.js"></script>
    <script src="js/processing.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <?php printFooter(); ?>
    
</body>

</html>
