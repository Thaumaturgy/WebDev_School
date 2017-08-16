<?php


function printFooter(){
    echo '<div class="footer">
      <div class="container">
        <p class="text-muted"> © Intellectual Property of Dewey L. Sia</p>
      </div>
    </div>';
}

function printNavbar($currentPage){

	$currentPage = basename($currentPage, '.php');
	// echo "<p>$currentPage</p>"; 
	$arr = array();

?>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <!-- <a href="#" class="navbar-left"><img class = "school-logo" src="img/sample-school-logo-inverse.png"></a> -->
            <a href="#" class="pull-left"></a>
            <!-- <span><img class = "school-logo" src="img/sample-school-logo-inverse.png"></span> -->
            <a class="navbar-brand" href="welcome.php">Student Database</a>
        </div>
        <ul class="nav navbar-nav">
            <li <?php if($currentPage == 'student') echo 'class = active';?>> <a href= <?php if($currentPage== 'student') echo '#'; else echo 'student.php'; ?>>Student</a></li>
            <li <?php if($currentPage == 'grade') echo 'class = active';?>> <a href= <?php if($currentPage== 'grade') echo '#'; else echo 'grade.php'; ?>>Grade</a></li>
            <li <?php if($currentPage == 'program') echo 'class = active';?>> <a href = <?php if($currentPage== 'program') echo '#'; else echo 'program.php'; ?>>Program</a></li>
            <li <?php if($currentPage == 'subject') echo 'class = active';?>> <a href = <?php if($currentPage== 'subject') echo '#'; else echo 'subject.php'; ?>>Subject</a></li>
            <li <?php if($currentPage == 'nationality') echo 'class = active';?>> <a href = <?php if($currentPage== 'nationality') echo '#'; else echo 'nationality.php'; ?>>Nationality</a></li>
            <li <?php if($currentPage == 'religion') echo 'class = active';?>> <a href = <?php if($currentPage== 'religion') echo '#'; else echo 'religion.php'; ?>>Religion</a></li>
            <li <?php if($currentPage == 'account') echo 'class = active';?>> <a href = <?php if($currentPage== 'account') echo '#'; else echo 'account.php'; ?>>Account</a></li>
        </ul>
        <span class="dropdown nav-drop navbar-right">
        <span class = ""><?php echo getUsername();?></span>
        <button class="btn btn-inverse dropdown-toggle" type="button" data-toggle="dropdown">
            <span class="glyphicon glyphicon-cog"></span> Settings
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu dropdown-menu">
            <li><a href="#">Profile</a></li>
            <li><a href="account.php">Manage Accounts</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
        </span>

        <?php echo "<input type = 'hidden' id = 'source' value = $currentPage>"; ?>
<!--         Page name serves as the identifier for what JS methods are used for certain pages
 -->    </div>
</nav>


<?php
}




?>