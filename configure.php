<?php
$db_hostname="localhost";
$db_username="root";
$db_password="password";
$db_database="topscodingcppwiki";
$conn=mysqli_connect($db_hostname,$db_username,$db_password,$db_database);
if($conn->connect_error){
    die("Connect to database error: ". $conn->connect_error);
}
?>