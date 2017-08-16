<?php 

include_once 'session_verification.php';
include_once 'template.php';
include_once 'retrieveData.php';

    if($_SESSION['permitnationality'][0] == 0){
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
        <h1 id="h1Title"> Nationality</h1>
        <h5>Here you can add nationality</h5>
        <div class="container">
            <div class="row">
                <button class="btn btn-info glyphicon glyphicon-plus <?php echo $_SESSION['permitnationality'][1] == 0 ? 'hide' : '' ; ?>" data-toggle="modal" data-target="#myModal" id="btn-add" onclick=" clearForm(); setAddModalType();"></button>
            </div>
        </div>
    </div>
    

    <div class="container roster">
        <table class="table table-bordered text-center" id="tbl-list">
            <tbody>
                <tr class = "text-center tr-header">
                    <th>Name<a href=<?php echo getURL(basename(__FILE__),'name');?>></a></th>
                    <th>Options</th>
                </tr>
                <?php printDB_generic("SELECT name, id FROM nationality", "permitnationality", 2); ?>
            </tbody>
        </table>
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
                            <table class="table table-autowidth" id="recordForm">
                                <tr id="frm-name">
                                    <td>Name</td>
                                    <td>
                                        <input type="text" class="form-control" id="txt-name" name = "txt-name" required="true" maxlength="60">
                                    </td>
                                </tr>
                            </table>
                            <!-- <button class="btn btn-primary" id = "btn-save">Save</button> -->
                            <div class="modal-footer">
                                <div class="pull-right row">
                                    <input type="hidden" id = "dataSource" name = "dataSource"  value = <?php echo basename(__FILE__);?>>
                                    <input type="hidden" id = "modalType" name="modalType">
                                    <input type="hidden" id = "modalSQLID" name = "modalSQLID">
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
