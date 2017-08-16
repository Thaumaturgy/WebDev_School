
<?php 

include_once 'session_verification.php';
include_once 'template.php';
include 'retrieveData.php';
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <title>Curriculum</title>
</head>

<body>
    <?php  printNavbar(basename(__FILE__)); ?>
    
    <div class="jumbotron col-md-offset-2 col-md-8">
        <h1>Curriculum</h1>
        <h6>Add grades to the list by filling up a simple form!</h6>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 pull-right">
                <button class="btn btn-success glyphicon glyphicon-plus pull-right" data-toggle="modal" data-target="#myModal" id="btn-add"></button>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button class="btn btn-primary glyphicon glyphicon-search"></button>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="container roster">
        <table class="table table-bordered text-center" id="tbl-list">
            <tbody>
                <tr id="tr-header" class = "text-center">
                    <th>Year Taken</th>
                    <th>Semester</th>
                    <th>Major</th>
                    <th>Program</th>
                    <th>Subject</th>
                    <th>Options</th>
                </tr>
                 <?php printDB_curriculum(); ?>
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
                            </table>
                        </div>
                    </div>
                    <!--  !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!END OF THE FORM!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
                </div>
                <div class="modal-footer">
                    <div class="col-lg-2 pull-right row">
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
