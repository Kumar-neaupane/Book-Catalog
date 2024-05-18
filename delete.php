<?php 
include 'connection.php';
$id = $_GET['id'];
$deletquery = "delete from addbook where id = $id";
$query = mysqli_query($conn, $deletquery);
header('location:managebook.php');
?>