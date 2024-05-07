<?php 
include 'connection.php';
$id = $_GET['id'];
$deletquery = "delete from usersignup where id = $id";
$query = mysqli_query($conn, $deletquery);
header('location:admininterface.php');
?>