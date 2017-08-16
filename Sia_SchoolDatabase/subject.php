<?php 

include_once 'session_verification.php';
include_once 'template.php';
include_once 'retrieveData.php';

    if($_SESSION['permitsubject'][0] == 0){
        header("Location: welcome.php");
    }

?>
<!DOCTYPE html>
<html>

<head>
    
    <script src="js/jquery.js"></script>
    <script src="js/processing.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <title>Subject</title>
</head>

<body>
    <?php  printNavbar(basename(__FILE__)); ?>

    <div class="jumbotron jumbotron-generic text-center">
        <h1 id="h1Title">Subjects</h1>
        <h5>Add subjects to the list by filling up a simple form!</h5>
        <div class="container">
                <button class="btn btn-info glyphicon glyphicon-plus <?php echo $_SESSION['permitsubject'][1] == 0 ? 'hide' : '' ; ?>" data-toggle="modal" data-target="#myModal" id="btn-add" onclick="clearForm(); setAddModalType();"></button>
            </div>
        </div>
    </div>
    

    <div class="container roster">
        <table class="table table-bordered" id="tbl-list">
            <tbody>
                <tr class = "text-center tr-header">
                    <th>Code<a href=<?php echo getURL(basename(__FILE__),'code');?>></a></th>
                    <th>Title<a href=<?php echo getURL(basename(__FILE__),'title');?>></a></th>
                    <th>Unit<a href=<?php echo getURL(basename(__FILE__),'unit');?>></a></th>
                    <th>Options</th>
                </tr>
                <?php printDB_generic("SELECT code, title, unit, id FROM subject", "permitsubject", 2); ?>
            </tbody>
        </table>
    </div>
    <!-- Modal -->
    <div class="modal fade addEntryModal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class= "modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Entry Form</h4>
                </div>
                
                <div class="modal-body">
                    <!--  !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!START OF THE FORM!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
                    <div class="container col-md-offset-2 col-md-8" id="form">
                        <!-- form id is unique!!!!! -->
                        <form action="entryHandler.php" method="get" class="form-group">
                            <table class="table table-autowidth" id="recordForm">
                                <tr id="frm-code">
                                    <td>Code</td>
                                    <td>
                                        <input type="text" class="form-control" id="txt-code" name="txt-code" required="true">
                                    </td>
                                </tr>
                                <tr id="frm-title">
                                    <td>Title</td>
                                    <td>
                                        <input type="text" class="form-control" id="txt-title" name="txt-title" required="true">
                                    </td>
                                </tr>
                                <tr id="frm-unit">
                                    <td>Unit</td>
                                    <td>
                                        <input type="text" class="form-control" id="txt-unit" name="txt-unit" required="true">
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
                            <!-- <button class="btn btn-primary" id = "btn-save">Save</button> -->
                        </form>
                    </div>

                    <!--  !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!END OF THE FORM!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
                </div>
                
            </div>
        </div>
    </div>

    <?php printFooter(); ?>
</body>

</html>
