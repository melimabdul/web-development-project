<?php
error_reporting(0);
//Start Session
session_start();


//Create Constants to Store Non Repeating Values
define('SITEURL', 'http://localhost/ajhb/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'ajhb');

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn)); //Database Connection
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn)); //SElecting Database
date_default_timezone_set("Asia/Kuala_Lumpur"); //Set Malaysian Timezone
