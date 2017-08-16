<?php 

include_once 'session_verification.php';
include_once 'template.php';
include_once 'retrieveData.php';
?>

<!DOCTYPE html>
<html>
<head>
	
	<link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
	<title>Home</title>

</head>
<body>

<?php  printNavbar(basename(__FILE__)); ?>
<div class="container"></div>
	<div class="container-fluid">
        <div class="jumbotron">
            <h1>Welcome to the Student Enrollment System</h1>
            <h6>Click around to see what you can do!</h6>
        </div>
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src = "js/processing.js"></script> <!-- Place custome js here so that it loads and the functions become visible -->
    <div class="footer single-page-footer">
      <div class="container">
        <p class="text-muted"> © Intellectual Property of Dewey L. Sia</p>
      </div>
    </div>
</body>
    
</html>