<?php
session_start();

if(!isset($_SESSION['username'])){
    logout();
}

function getUsername(){
    if(isset($_SESSION['username']))
        return $_SESSION['username'];
    return "Unidentified";
}

function logout(){
	session_destroy();
	header('Location: login.php');
}
?>
