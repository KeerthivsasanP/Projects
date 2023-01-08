<?php 

$del_id = $_GET['del_id'];
$conn = mysqli_connect('localhost','root',"",'cattlesales');
if(!$conn) die("connection failed");
else{
	$sql="DELETE FROM pets WHERE id='$del_id' ";
	$query=mysqli_query($conn,$sql) or die("Unexpected error");
	header("location:myprofile.php");

}

 ?>