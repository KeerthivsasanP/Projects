<html>
<head>
	<link rel="stylesheet" type="text/css" href="signin.css">
</head>
<body>
	<p align="center"><div>
	<h1>Sign up</h1>
	<form method="post">
		<table align="center" cellspacing="15px">
		<tr>
			<td>Username : </td>
			<td>
				<input type="email" name="userName" required>
			</td>
		</tr>
		<tr>
			<td>How shall we call you?</td>
			<td>
				<input type="text" name="nickName" required>
		</tr>
		<tr>
			<td>Mobile :
				<br>(10 digit mobile number)</td>
			 <td><input type="text" name="mobile" maxlength="10" required></td>

		</tr>
		<tr>
			<td>Password :</td>
			<td> 
				<input type="password" name="password" required>
			</td>
		</tr>
		<tr>
			<td>Confirm password</td>
			<td><input type="password" name="conPassword" required></td>
		</tr>
		</table>
		<br>

		<?php

	$userName = "";
	$password = "";
	$mobile = "";
	$conPass = "";
	$nickName= "";

	if(isset($_POST['submit'])){

	$userName = $_POST['userName'];
	$password=$_POST['password'];
	$mobile=$_POST['mobile'];
	$conPass=$_POST['conPassword'];
	$nickName=$_POST['nickName'];
	//check password and confirm password match
	if (strcmp($password, $conPass) != 0)	echo "<p class='errorMessage'>Password and confirm password do not match</p>";
	
	else if(!preg_match('/^[0-9]{10}$/',$mobile)) echo "<p class='errorMessage'>Enter 10 digit mobile number</p>";

	else{
		$conn = mysqli_connect("localhost","root","","cattleSales");
		if(!$conn){
			echo "<p class='errorMessage'>Please try again !!!</p>";
		}
		
			else{
				$sql = "SELECT userName FROM users WHERE BINARY userName='$userName'";
				$result = mysqli_query($conn,$sql);
				if(mysqli_num_rows($result) == 1)
					echo "<p class='errorMessage'>Username Exist. Try signing in or try a new username</p><br><br>";
				else{
					$sql = "INSERT INTO users VALUES ('$userName','$password','$mobile','$nickName')";
					if(mysqli_query($conn,$sql)){
						echo '<script>
						alert("successfully signed up");
						window.location.href="home.php"; 
						</script>';
					}
					else
						echo "<p class='errorMessage'>Error. Try again !!!</p>";

				}
			}
		}
		}
	?>

	<input type="submit" name="submit">
	</form></div></p>	
</body>
</html>