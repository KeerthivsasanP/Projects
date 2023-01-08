<html>
<head>
	<link rel="stylesheet" type="text/css" href="signin.css">
</head>
<body>
		<p align="center"><div>
		<h1>Sign in</h1>
		<form method="post">
			<table align="center" cellspacing="20px">
				<tr>
					<td>User name :</td>
					<td><input type="email" name="userName" required></td>
				</tr>
				<tr>
					<td>Password :</td>
					<td><input type="password" name="password" required></td>
				</tr>
			</table>
			<br>
			<?php
			session_start();
			$_SESSION['userName'] = "";
			
			$userName="";
			$password="";
			
			if(isset($_POST['submit'])){
			$conn = mysqli_connect("localhost","root","","cattlesales");
			if(!$conn){
				echo "Error. Please try again!!!";
			}
			
			$userName=$_POST['userName'];
			$_SESSION['userName']=$userName;
			$password=$_POST['password'];
			$_SESSION['password']=$password;
			
		
				$sql = "SELECT userName FROM users WHERE BINARY userName='$userName'";
				$result = mysqli_query($conn,$sql);
				if(mysqli_num_rows($result) == 0){
					echo "New user need to signup<br><br>";
					$_SESSION['userName'] = "";
				}
				else{
					$sql = "SELECT password FROM users WHERE BINARY userName='$userName' and BINARY password='$password'";
					$result = mysqli_query($conn,$sql);
					if(mysqli_num_rows($result) == 0){
						echo "Invalid username or password<br><br>";
						$_SESSION['userName'] = "";
					}
					else
						header("location:home.php");
					mysqli_close($conn);
				}
			}				
				
		?>
			<input type="submit" name="submit">
			<br><br>
			<a href="forgotPassword.php">forgot password&nbsp;&nbsp;&nbsp;&nbsp;|<a>
			<a href="signup.php">&nbsp;&nbsp;&nbsp;&nbsp;Signup&nbsp;&nbsp;&nbsp;&nbsp;|</a>
			<a href="home.php">&nbsp;&nbsp;&nbsp;&nbsp;Skip for now</a>
		</form>
	</div></p>
</body>
</html>