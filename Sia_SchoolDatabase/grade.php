<?php 

include_once 'session_verification.php';
include_once 'template.php';
include_once 'retrieveData.php';

    if($_SESSION['permitgrades'][0] == 0){
        header("Location: welcome.php");
    }
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <title>Grade</title>
</head>

<body>
    <?php  printNavbar(basename(__FILE__)); ?>
    <div class="jumbotron jumbotron-generic text-center">
        <h1>Grades</h1>
        <h5>View grades as they are classified into semesters</h5>
    </div>

    <div class="container">
        <table class="table table-bordered text-center" id="tbl-grade">
            <tbody>
                <tr class = "text-center tr-header">
                    <!-- <th>Subject ID<a href = <?php echo getURL(basename(__FILE__),'grade.id');?> ></a></th> -->
                    <th>School Year<a href = <?php echo getURL(basename(__FILE__),'schoolyear');?> ></a></th>
                    <th>Semester<a href = <?php echo getURL(basename(__FILE__),'semester');?>></a></th>
                    <th>View Subjects</th>
                </tr>

                <?php printDB_subject(); ?>

               
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
                            <table class="table" id="recordForm">
                                <tr id="frm-studentID">
                                    <td>Student ID</td>
                                    <td>
                                        <input type="text" class="form-control" id="txt-studentID" required="true">
                                    </td>
                                </tr>
                                <tr id="frm-subjectID">
                                    <td>Subject ID</td>
                                    <td>
                                        <input type="text" class="form-control" id="txt-subjectID" required="true">
                                    </td>
                                </tr>
                                <tr id="frm-schoolYear">
                                    <td>School Year</td>
                                    <td>
                                        <input type="text" class="form-control" id="txt-schoolYear" required="true">
                                    </td>
                                </tr>
                                <tr id="frm-semester">
                                    <td>Semester</td>
                                    <td>
                                        <input type="text" class="form-control" id="txt-semester" required="true">
                                    </td>
                                </tr>
                                <tr id="frm-grade">
                                    <td>Grade</td>
                                    <td>
                                        <input type="text" class="form-control" id="txt-grade" required="true">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!--  !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!END OF THE FORM!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
                </div>
                <div class="modal-footer">
                    <div class="col-lg-2 pull-right row">
                        <input type="hidden" id = "modalType" name="modalType">
                        <input type="hidden" id = "dataSource" name = "dataSource"  value = <?php echo basename(__FILE__);?>>
                        <input type="submit" id="hrefSave" name="entrySubmission" class="form-control pull-right" value="Add" data-dismiss="modal">
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
