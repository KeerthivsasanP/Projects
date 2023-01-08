<html>
<head>
	<link rel="stylesheet" type="text/css" href="seller.css">
	<script>
		//stop resubmission on refresh
		if(window.history.replaceState){
			window.history.replaceState(null,null,window.location.href);
		}
	</script>
</head>
<body>
	<?php 
		session_start();
		include_once('header.php');
	?>
	<h1 align="center">I need a caretaker</h1><hr>
	<br><br>
	<div>
	<form method="post">
	<table cellspacing="15px" align="center">
		<tr>
			<td>Username:</td>
			<td><input type="email" name="userName" value="<?php echo $_SESSION['userName'] ?>" disabled></td>
		</tr>
		<tr><td>Contack no:</td>
			<td><input type="text" name="contact" maxlength="10" required></td>
		</tr>
		<tr>
			<td>Start date:</td>
			<td><input type="date" name="startDate" value="<?php echo date('Y-m-d');?>" min="<?php echo date('Y-m-d');?>" required></td>
		</tr>
		<tr>
			<td>End date:</td>
			<td><input type="date" name="endDate" min="<?php echo date('Y-m-d');?>" required></td>
		</tr>
		<tr>
			<td>Address:</td><td><input type="text" name="address" required></td>
		</tr>
		<tr>
			<td>Type of animal:</td>
			<td><input type="text" name="type" required></td>
		</tr>
		<tr>
			<td>Any addional care needed for pet?<br>(including medical care)?</td>
			<td><textarea placeholder="Info..." name="additionalInfo" required></textarea></td>
		</tr>
	</table>
	<br>
	
<?php

	$userName="";
	$contact="";
	$startDate="";
	$endDate="";
	$address="";
	$type="";
	$additionalInfo="";

	if(isset($_POST['submit'])){
	$userName=$_SESSION['userName'];
	$contact=$_POST['contact'];
	$startDate=$_POST['startDate'];
	$endDate=$_POST['endDate'];
	$address=$_POST['address'];
	$type=$_POST['type'];
	$additionalInfo=$_POST['additionalInfo'];

	$conn = mysqli_connect("localhost","root","","cattlesales");
	if(!$conn){
		echo "Connection failed";
	}
	else{

		if (!preg_match('/^[0-9]{10}$/',$contact))	echo "Invalid mobile number";

		else{
			$sql = "INSERT INTO caretaker VALUES ('$userName','$contact','$startDate','$endDate','$address','$type','$additionalInfo') ";
			if(mysqli_query($conn,$sql)){
				echo "<script>
						alert('We would reach you soon through mail')
						document.location = 'home.php' 
						</script>";

			}else{
				echo "OOPS. Something went wrong";
			}
		}
	
	}
	}
?>
<br><br>
			<center>
				<input type="submit" name="submit">
			<center>
		</form>
	</div>
	<br><br><br><br><br><br><br><br><br>
<?php include_once('footer.php'); ?>
</body>
</html>