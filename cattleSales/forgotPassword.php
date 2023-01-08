<html>
<head>
	<link rel="stylesheet" type="text/css" href="signin.css">
</head>
<body>
	<p align="center"><div>
	<h1>Forgot Password</h1>
	<form method="post">
	<table align="center" cellspacing="20px">
		<tr>
			<td>User name :</td>
			<td><input type="email" name="userName" required></td>
		</tr>
		<tr>
			<td>New password :</td>
			<td><input type="password" name="newPass" required></td>
		</tr>
		<tr>
			<td>Confirm password :</td>
			<td><input type="password" name="conPass"required></td>
		</tr>
	</table>
	
	<?php
		session_start();
		
		$userName = "";
		$newPass = "";
		$conPass = "";

		if(isset($_POST['submit'])){

		$userName = $_POST['userName'];	
		$_SESSION['userName']=$userName;
		$newPass = $_POST['newPass'];
		$_SESSION['newPass'] = $newPass;
	
		$conPass = $_POST['conPass'];		
		$conn = mysqli_connect("localhost","root","","cattlesales");
		if(!$conn){
			echo "Error.Cannot connect to database";
		}
		else
		{
			$sql = "SELECT userName FROM users WHERE BINARY userName='$userName'";
			$result = mysqli_query($conn,$sql);
			
			if(mysqli_num_rows($result) == 0)
				echo "<p class='errorMessage'>Invalid username</p>";

			elseif($newPass != $conPass)
				echo "<p class='errorMessage'>New password DOES NOT match with confirm password</p>";
			

			else{
					// $msg="Your OTP to change the password is <b>".$sentOTP."</b>.Don't share it with anyone.";
					// mail($userName,"OTP for password change",$msg);

					echo "<script>
					alert('We have sent an 4 digit OTP to the registered email id');
					document.location='otpPage.php';
					</script>";
			}
			mysqli_close($conn);

		}
		}
		
	?>

	<input type="submit" name="submit">
</form></div></p>
</body>
</html>