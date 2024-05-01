<?php 
$server = "localhost";
$username = "root";
$password = "";
$database = "bookcatalog";
$conn = mysqli_connect($server, $username, $password, $database);
if (mysqli_connect_errno()) {

    die("". mysqli_connect_error());
}
else{
   
}
?>