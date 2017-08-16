<?php 

include_once 'session_verification.php';
include_once 'template.php';
include_once 'retrieveData.php';

if($_SESSION['permitaccounts'][0] == 0){
        header("Location: welcome.php");
    }
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <title>Account</title>
</head>

<body>
    <?php  printNavbar(basename(__FILE__)); ?>
    <div class="jumbotron jumbotron-generic text-center">
        <h1>Accounts</h1>
        <h5>Add accounts to the list by filling up a simple form!</h5>

        <div class="container">
            <button class="btn btn-info glyphicon glyphicon-plus <?php echo $_SESSION['permitaccounts'][1] == 0 ? 'hide' : '' ; ?>" data-toggle="modal" data-target="#myModal" id="btn-add" onclick="setAddModalType();"></button>  
        </div>

    </div>
    
    
    <div class="container roster">
        <table class="table table-bordered text-center" id="tbl-list">
            <tbody>
                <tr class = "text-center tr-header">
<!-- // echo   "$_SERVER['HTTP_HOST']$_SERVER['REQUEST_URI']"; -->
                    <th>User <a href = <?php echo getURL(basename(__FILE__), 'uname');?>></a></th>
                    <th>Password <a href= <?php echo getURL(basename(__FILE__),'pword');?>></a></th>
                    <th>Description <a href = <?php echo getURL(basename(__FILE__),'description');?>></a></th>
                    <th>Active <a href=<?php echo getURL(basename(__FILE__),'active');?>></a></th>
                    <th>Options</th>
                </tr>
                <?php printDB_account(); ?>
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
                        <form class="form form-group" method="get" action="entryHandler.php" >
                            <table class="table table-autowidth" id="recordForm">
                                <tr id="frm-user">
                                    <td>Username</td>
                                    <td>
                                        <input type="textbox" class="form-control" id="txt-user" name = "txt-user" required>
                                    </td>
                                </tr>
                                <tr id="frm-password">
                                    <td>Password</td>
                                    <td>
                                        <input type="textbox" class="form-control" id="txt-password" name = "txt-password" required>
                                    </td>
                                </tr>
                                <tr id="frm-description">
                                    <td>Description</td>
                                    <td>
                                        <input type="textbox" class="form-control" id="txt-description" name = "txt-description" required>
                                    </td>
                                </tr>
                                <tr id="frm-active">
                                    <td>Active</td>
                                    <td>
                                        <input type="hidden" name ="checkbox-active" value = '0'>
                                        <input type="checkbox" id="checkbox-active" name ="checkbox-active" value = '1'>
                                    </td>
                                </tr>
                                <tr><td><strong>PERMISSIONS</strong></td><tr>
                                <tr>
                                    <td>Student</td>
                                    <td>
                                        <input type="hidden" name = "checkbox-student[0]" value = '0'>
                                        <input type="checkbox" id="checkbox-student-view" name = "checkbox-student[0]" value = '1'> View   

                                        <input type="hidden" name = "checkbox-student[1]" value = '0'>
                                        <input type="checkbox" id="checkbox-student-add" name = "checkbox-student[1]" value = '1'> Add  

                                        <input type="hidden" name = "checkbox-student[2]" value = '0'>
                                        <input type="checkbox" id="checkbox-student-edit" name = "checkbox-student[2]" value = '1'> Edit  
                                        <br>

                                        <input type="hidden" name = "checkbox-student[3]" value = '0'>  
                                        <input type="checkbox" id="checkbox-student-viewGrades" name = "checkbox-student[3]" value = '1'> View Grades  
                                    </td>
                                </tr>
                                <tr>
                                    <td>Program</td>
                                    <td>
                                        <input type="hidden" name = "checkbox-program[0]" value = '0'>
                                        <input type="checkbox" id="checkbox-program-view" name = "checkbox-program[0]" value = '1'> View   

                                        <input type="hidden" name = "checkbox-program[1]" value = '0'>
                                        <input type="checkbox" id="checkbox-program-add" name = "checkbox-program[1]" value = '1'> Add   

                                        <input type="hidden" name = "checkbox-program[2]" value = '0'>
                                        <input type="checkbox" id="checkbox-program-edit" name = "checkbox-program[2]" value = '1'> Edit   
                                        <br>

                                        <input type="hidden" name = "checkbox-programCurriculum[0]" value = '0'>
                                        <input type="checkbox" id="checkbox-program-viewCurriculum" name = "checkbox-programCurriculum[0]" value = '1'> View Curriculum   
                                        <br>

                                        <input type="hidden" name = "checkbox-programCurriculum[1]" value = '0'>
                                        <input type="checkbox" id="checkbox-program-addCurriculum" name = "checkbox-programCurriculum[1]" value = '1'> Add Curriculum   
                                        <br>

                                        <input type="hidden" name = "checkbox-programCurriculum[2]" value = '0'>
                                        <input type="checkbox" id="checkbox-program-editCurriculum" name = "checkbox-programCurriculum[2]" value = '1'> Edit Curriculum   
                                    </td>
                                </tr>
                                <tr>
                                    <td>Subject</td>
                                    <td>
                                        <input type="hidden" name = "checkbox-subject[0]" value = '0'>
                                        <input type="checkbox" id="checkbox-subject-view" name = "checkbox-subject[0]" value = '1'> View    

                                        <input type="hidden" name = "checkbox-subject[1]" value = '0'>
                                        <input type="checkbox" id="checkbox-subject-add" name = "checkbox-subject[1]" value = '1'> Add   

                                        <input type="hidden" name = "checkbox-subject[2]" value = '0'>
                                        <input type="checkbox" id="checkbox-subject-edit" name = "checkbox-subject[2]" value = '1'> Edit   
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nationality</td>
                                    <td>
                                        <input type="hidden" name = "checkbox-nationality[0]" value = '0'>
                                        <input type="checkbox" id="checkbox-nationality-view" name = "checkbox-nationality[0]" value = '1'> View   

                                        <input type="hidden" name = "checkbox-nationality[1]" value = '0'>
                                        <input type="checkbox" id="checkbox-nationality-add" name = "checkbox-nationality[1]" value = '1'> Add   

                                        <input type="hidden" name = "checkbox-nationality[2]" value = '0'>
                                        <input type="checkbox" id="checkbox-nationality-edit" name = "checkbox-nationality[2]" value = '1'> Edit   
                                </tr>
                                <tr>
                                    <td>Religion</td>
                                    <td>
                                        <input type="hidden" name = "checkbox-religion[0]" value = '0'>
                                        <input type="checkbox" id="checkbox-religion-view" name = "checkbox-religion[0]" value = '1'> View   

                                        <input type="hidden" name = "checkbox-religion[1]" value = '0'>
                                        <input type="checkbox" id="checkbox-religion-add" name = "checkbox-religion[1]" value = '1'> Add   

                                        <input type="hidden" name = "checkbox-religion[2]" value = '0'>
                                        <input type="checkbox" id="checkbox-religion-edit" name = "checkbox-religion[2]" value = '1'> Edit   
                                    </td>
                                </tr>
                                <tr>
                                    <td>Account</td>
                                    <td>
                                        <input type="hidden" name = "checkbox-account[0]" value = '0'>
                                        <input type="checkbox" id="checkbox-account-view" name = "checkbox-account[0]" value = '1'> View   

                                        <input type="hidden" name = "checkbox-account[1]" value = '0'>  
                                        <input type="checkbox" id="checkbox-account-add" name = "checkbox-account[1]" value = '1'> Add   

                                        <input type="hidden" name = "checkbox-account[2]" value = '0'>
                                        <input type="checkbox" id="checkbox-account-edit" name = "checkbox-account[2]" value = '1'> Edit   
                                    </td>
                                </tr>
                                <tr>
                                    <td>Grade</td>
                                    <td>
                                        <input type="hidden" name = "checkbox-grade[0]" value = '0'>
                                        <input type="checkbox" id="checkbox-grade-view" name = "checkbox-grade[0]" value = '1'> View    

                                        <input type="hidden" name = "checkbox-grade[1]" value = '0'>
                                        <input type="checkbox" id="checkbox-grade-add" name = "checkbox-grade[1]" value = '1'> Add   

                                        <input type="hidden" name = "checkbox-grade[2]" value = '0'>
                                        <input type="checkbox" id="checkbox-grade-edit" name = "checkbox-grade[2]" value = '1'> Edit   
                                    </td>
                                </tr>
                            </table>
                            <!-- <button class="btn btn-primary" id = "btn-save">Save</button> -->
                            <div class="modal-footer">
                                <div class="pull-right row">
                                    <input type="hidden" id = "modalType" name="modalType">
                                    <input type="hidden" id = "modalSQLID" name = "modalSQLID">
                                    <input type="hidden" id = "dataSource" name = "dataSource"  value = <?php echo basename(__FILE__);?>>
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
    
    <script src="js/jquery.js"></script>
    <script src="js/processing.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <?php printFooter(); ?>
</body>

</html>
