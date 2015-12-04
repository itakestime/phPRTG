<?php
session_start();

require('functions.php');
require('config.php');


//Check if logging off
if (!empty($_GET['logoff'])){
	session_unset();
	session_destroy();
	header("Location: prtgerror.php");
	exit();
}

//Passhash the password so that it can be used with the PRTG API, and for security reasaons
$passhash = passhash($_POST["username"],$_POST["password"]);


//Check if login is valid or not. If invalid, return to login page and prompt user to re-enter username and password
if ($passhash == 'Unauthorized') {

	header("Location: login.php?error=1");
	exit();
	
	}

//Put username and passhash into session variables (best I could come up with)
$_SESSION["username"] = $username;
$_SESSION["password"] = $passhash;

//Check if logged in, then redirect to error page
if (!empty($_SESSION["password"])){

	echo 'Logged in';
}

header("Location: prtgerror.php");



?>