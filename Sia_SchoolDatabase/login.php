<?php


	// include 'account.php';
    include_once 'template.php';

    $error = false;
    session_start();
    session_destroy();
    session_start();
    $conn = new mysqli('localhost', 'encoder', 'encoder', 'school');
    if($conn->connect_errno) die($conn->connect_errno);

    if((isset($_REQUEST['uname']) && isset($_REQUEST['psw']))){
        verify($_REQUEST['uname'], $_REQUEST['psw']);

        grantPermissions($_REQUEST['uname']);

    }

    function grantPermissions($uname){
        global $conn;
        
        $q = "SELECT * FROM account WHERE uname = '$uname'";

        $result = $conn->query($q);

        
        $result->data_seek(0);
        $row = $result->fetch_array(MYSQLI_ASSOC);




        $_SESSION['permitstudent'] = $row['permitstudent'];
        $_SESSION['permitprogram'] = $row['permitprogram'];
        $_SESSION['permitsubject'] = $row['permitsubject'];
        $_SESSION['permitnationality'] = $row['permitnationality'];
        $_SESSION['permitreligion'] = $row['permitreligion'];
        $_SESSION['permitaccounts'] = $row['permitaccounts'];
        $_SESSION['permitgrades'] = $row['permitgrades'];

        $rows = $result->num_rows;

        for ($i=0; $i < $rows; $i++) { 
            # code...
        }
    }

	function isLoginError(){
		global $error;
    	if($error){
    		echo "<div id = 'login-error'>Please enter a valid username or password. </div>";
    	}
	}

    function verify($username, $password){
        $q = "SELECT * from account WHERE uname = '$username' AND pword = '$password';";

        global $conn;
        global $error;
        // echo $q;
        
        $result = $conn->query($q);
        
        // echo "\n\n$row[0] > 0";
        if($result->num_rows > 0){

            $result->data_seek(0);
            $row = $result->fetch_array(MYSQLI_ASSOC);
            if($row['active'] == 0){
                $error = true;
                return;
            }
            
            $_SESSION['username'] = $username;
            $_SESSION['accountID'] = $row['id'];
            header("Location: welcome.php");
        }else{
            $error = true;
        }
    }   

    $conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Sprucewright Student Database Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" href="css/login.css">
</head>

<body background="img/login_bg_saturated.jpg">
    <div class="container">
        <div class="jumbotron text-center jumbotron-login">
            <h2>Sprucewright Collegiate Institute of Politics</h2>
            <h4>Student Management Database</h4>
            <span><img class = "school-logo" src="img/sample-school-logo.png"></span>
            <?php isLoginError();?>
        </div>

        <div class="col-md-offset-4 col-md-4 login">
            <div id="login-header" class="default-box-header">
            <span>Sign-in</span>
                <!-- <?php isLoginError();?> -->
            </div>

            <form class="form well" action = "login.php" method = "post">
			<fieldset>
                <label><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="uname" class="form-control text-center" required>
                <br>
                <label><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" class="form-control text-center" required>
                <br>
                <input type="submit" class="form-control login-btn" value = "Login">
            </fieldset>
            </form>
        </div>

    </div>
    <script src="js/jquery.js"></script>
    <script src="js/processing.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <div class="footer">
      <div class="container">
        <p class="text-muted"> © Intellectual Property of Dewey L. Sia</p>
      </div>
    </div>

</body>

</html>
