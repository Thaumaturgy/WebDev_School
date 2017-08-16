<?php 

include_once 'session_verification.php';
include_once 'template.php';
include_once 'retrieveData.php';


    if($_SESSION['permitstudent'][0] == 0){
        header("Location: welcome.php");
    }

?>


<!DOCTYPE html>
<html>

<head>
    <!-- Place custome js here so that it loads and the functions become visible -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src = "js/processing.js"></script> 

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">

    <title>Add Student</title>
</head>

<body>
    <!-- NAVBAR -->
    <?php  printNavbar(basename(__FILE__)); ?>

    <!-- <div class="container-fluid bg-primary"> -->
        <div class="jumbotron jumbotron-generic text-center">
            <h1>Student</h1>
            <h5>Add students to the database by filling up a simple form!</h5>
            <div class="container">
                <div class="row">
                    <!-- <div class="col-md-4"> -->
                        <button class="btn btn-info glyphicon glyphicon-plus <?php echo $_SESSION['permitstudent'][1] == 0 ? 'hide' : '' ; ?>" data-toggle="modal" data-target="#myModal" id = "btn-add" onclick = "setAddModalType();" title = "Add Student"></button>
                    <!-- </div> -->
                </div>
            </div>
        </div>

        
    <!-- </div> -->

    

    <div class="container-fluid roster">
        <table class="table table-bordered text-center text-center table-inverse" id="tbl-list">
            <tbody>

                <tr class = "text-center tr-header">
<!-- // echo   "$_SERVER['HTTP_HOST']$_SERVER['REQUEST_URI']"; -->
                    <th>Last Name <a href = <?php echo getURL(basename(__FILE__),'lastname');?> ></a></th>
                    <th>First Name <a href= <?php echo getURL(basename(__FILE__),'firstname');?>></a></th>
                    <th>Middle Name <a href = <?php echo getURL(basename(__FILE__),'middlename');?>></a></th>
                    <th>Gender <a href = <?php echo getURL(basename(__FILE__),'gender');?>></a></th>
                    <th>Birthdate <a href=<?php echo getURL(basename(__FILE__),'birthdate');?>></a></th>
                    <th>Program <a href=<?php echo getURL(basename(__FILE__),'program.title');?>></a></th>
                    <th>Religion <a href=<?php echo getURL(basename(__FILE__),'religion.name');?>></a></th>
                    <th>Nationality <a href=<?php echo getURL(basename(__FILE__),'nationality.name');?>></a></th>
                    <th>Year Status <a href=<?php echo getURL(basename(__FILE__),'yearstatus');?>></a></th>
                    <th>Regular <a href=<?php echo getURL(basename(__FILE__),'regular');?>></a></th>
                    <th>Options</th>

                </tr>
        <?php printDB_student(); ?>
            </tbody>
        </table>
    </div>




    <!-- Modal -->
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
                            <table class="table table-autowidth" id="recordForm">
                                    <tr id="frm-lastName">
                                        <td>Last Name</td>
                                        <td>
                                            <input type="text" class="form-control" id="txt-lastName" name ="txt-lastName" required maxlength="60">
                                        </td>
                                    </tr>
                                    <tr id="frm-firstName">
                                        <td>First Name</td>
                                        <td>
                                            <input type="text" class="form-control" id="txt-firstName" name ="txt-firstName" required maxlength="60">
                                        </td>
                                    </tr>
                                    <tr id="frm-middleName">
                                        <td>Middle Name</td>
                                        <td>
                                            <input type="text" class="form-control" id="txt-middleName" name ="txt-middleName" required maxlength="60">
                                        </td>
                                    </tr>
                                    <tr id="frm-gender">
                                        <td>Gender</td>
                                        <td>
                                            <span><input type="radio" value = "Male" name = "gender" checked="checked" id = "radio-genderM"> Male </span>
                                            <span><input type="radio" value = "Female" name = "gender" id = "radio-genderF"> Female</span>
                                        </td>
                                    </tr>
                                    <tr id="frm-birthDate">
                                        <td>Birthdate</td>
                                        <td>
                                            <input type="date" class="form-control" max="2018-01-02" id="date-birthDate" name ="date-birthDate">
                                        </td>
                                    </tr>
                                    <tr id="frm-program">
                                        <td>Program</td>
                                        <td>
                                        <?php 
                                            global $host, $user, $pwd, $db;
                                            $mysqli = new mysqli($host, $user, $pwd, $db);
                                            if($mysqli->connect_errno){
                                                die($mysqli->connect_errno);
                                            }

                                            $res = $mysqli->query("SELECT code FROM program");
                                            $rows = $res->num_rows;
                                            echo "<select class='form-control' id='select-program' name ='select-program'>";
                                            echo $rows;
                                            for($i = 0; $i < $rows; $i++){ 
                                                $res->data_seek($i);
                                                $row = $res->fetch_array(MYSQLI_NUM);

                                                for ($j = 0; $j < count($row); $j++) { 
                                                    echo "<option value='$row[$j]'> $row[$j] </option>";
                                                }

                                                
                                            }
                                            echo "</select>";
                                         ?>
                                         </td>
                                    </tr>
                                    <tr id="frm-religion">
                                        <td>Religion</td>
                                        <td>
                                        <?php 
                                            global $host, $user, $pwd, $db;
                                            $mysqli = new mysqli($host, $user, $pwd, $db);
                                            if($mysqli->connect_errno){
                                                die($mysqli->connect_errno);
                                            }
                                            
                                            $res = $mysqli->query("SELECT name FROM religion");
                                            $rows = $res->num_rows;
                                            echo "<select class='form-control' id='select-religion' name='select-religion'>";
                                            echo $rows;
                                            for($i = 0; $i < $rows; $i++){ 
                                                $res->data_seek($i);
                                                $row = $res->fetch_array(MYSQLI_NUM);

                                                for ($j = 0; $j < count($row); $j++) { 
                                                    echo "<option value='$row[$j]'> $row[$j] </option>";
                                                }

                                                
                                            }
                                            echo "</select>";
                                         ?>
                                         </td>
                                    </tr>
                                    <tr id="frm-nationality">
                                        <td>Nationality</td>
                                        <td>
                                        <?php 
                                            global $host, $user, $pwd, $db;
                                            $mysqli = new mysqli($host, $user, $pwd, $db);
                                            if($mysqli->connect_errno){
                                                die($mysqli->connect_errno);
                                            }
                                            
                                            $res = $mysqli->query("SELECT name FROM nationality");
                                            $rows = $res->num_rows;
                                            echo "<select class='form-control' id='select-nationality' name='select-nationality'>";
                                            echo $rows;
                                            for($i = 0; $i < $rows; $i++){ 
                                                $res->data_seek($i);
                                                $row = $res->fetch_array(MYSQLI_NUM);

                                                for ($j = 0; $j < count($row); $j++) { 
                                                    echo "<option value='$row[$j]'> $row[$j] </option>";
                                                }

                                                
                                            }
                                            echo "</select>";
                                         ?>
                                         </td>
                                    </tr>
                                    <tr id="frm-yearStatus">
                                        <td>Year Status</td>
                                        <td>
                                            <select class="form-control" id="select-yearStatus" name="select-yearStatus">
                                                <option value="1">1st Year</option>
                                                <option value="2">2nd Year</option>
                                                <option value="3">3rd Year</option>
                                                <option value="4">4th Year</option>
                                                <option value="5">5th Year</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr id="frm-regular">
                                        <td>Regular</td>
                                        <td>
                                            <input type="hidden" name="checkbox-regular" value = '0'>
                                            <input type="checkbox" id = "checkbox-regular" name="checkbox-regular" value = '1' checked>
                                        </td>
                                    </tr>
                                </table>    
                            
                            <div class="modal-footer">
                                <div class="pull-right row">
                                    <input type="hidden" id = "dataSource" name = "dataSource"  value = <?php echo basename(__FILE__);?>>                       
                                    <input type="hidden" id = "modalType" name="modalType">
                                    <input type="hidden" id = "modalSQLID" name = "modalSQLID">
                                    <input type="submit" id="hrefSave"  name = "entrySubmission" class="form-control pull-right" value = "Add">
                                </div>
                            </div>
                        </form>
                    </div>

                    <!--  !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!END OF THE FORM!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
                </div>
            </div>
        </div>
    </div>        

    
    <!-- <script src="js/processing.js"></script> -->

    
<?php printFooter(); ?>
</body>

</html>
