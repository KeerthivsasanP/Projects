<html>
<head>
	<link rel="stylesheet" type="text/css" href="confirmAdoption.css">
	<?php
		session_start();
	?>
</head>
<body>
	<br><br><br><br><br>
	<div>
		<br><br>
	<h1 align="center">Adoption page</h1>
	<p align="center">Adoption is a responsibility. Are you sure to hold it?</p><br><br>
	<form method="post">
		<center><input id="yesbtn" type="submit" name="positive" value="YES"></center>
	</form>
	<center><a href="adoptPets.php"><button id="nobtn">NO</button></a></center>
	</div>
</body>
<?php
	
	$petId = "";
	$userName = "";
	if(isset($_POST['positive'])){
		$petId = $_SESSION['petId'];
		$userName = $_SESSION['userName'];

		$conn = mysqli_connect("localhost","root","","cattlesales");
			if(!$conn){
				echo "Cannot connect. Please try again.";
			}
			else{
				$sql = "UPDATE pets SET adoptionStatus='y',adoptionDate=NOW(),adoptedBy='$userName' WHERE id='$petId' ";
				
				if(mysqli_query($conn,$sql)){
					echo "<script>
							alert('Adoption successful');
							document.location = 'home.php';
							 </script>";
		}

		mysqli_close($conn);
	}
}

?>
</html>