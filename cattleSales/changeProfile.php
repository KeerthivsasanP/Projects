<html>
<head>
	<link rel="stylesheet" type="text/css" href="signin.css">
	<?php 
		session_start();

		$conn = mysqli_connect("localhost","root","","cattleSales");
		if(!$conn){
			echo "Please try again !!!";
		}else{
			$userName = $_SESSION['userName'];
			$sql = "SELECT * FROM users WHERE BINARY userName='$userName' ";
			$result = mysqli_query($conn,$sql);
			if(mysqli_num_rows($result) != 1) die("Oops!!! Something went wrong");
			else{
			$row = mysqli_fetch_assoc($result);
			}
		}
	 ?>
</head>
<body>
	<p align="center"><div>
	<h1>Change profile</h1>
	<form method="post">
		<table align="center" cellspacing="30px">
		<tr>
			<td>Username : </td>
			<td>
				<input type="email" name="userName" value="<?php echo $_SESSION['userName'] ?>" disabled>
			</td>
		</tr>
		<tr>
			<td>How shall we call you?</td>
			<td>
				<input type="text" name="nickName" value="<?php echo $row['nickName']; ?>" required>
		</tr>
		<tr>
			<td>mobile :
				<br>(10 digit mobile number)</td>
			 <td><input type="text" name="mobile" maxlength="10" value="<?php echo $row['mobile']; ?>" required></td>

		</tr>
		</table>
		<?php

		$mobile = "";
		$nickName = "";
		if(isset($_POST['update'])){

			$mobile = $_POST['mobile'];
			$nickName = $_POST['nickName'];

			if(!preg_match('/^[0-9]{10}$/',$mobile))	die("Enter 10 digit mobile number");
			else{
						$sql = "UPDATE users SET mobile='$mobile',nickName='$nickName'WHERE userName='$userName' ";
						$result = mysqli_query($conn,$sql);
						if($result)
							echo "<script>
									alert('Update success');
									document.location='home.php'</script>";
						else
							echo "<p class='errorMessage'>Update failed</p>".mysqli_error($conn);
					}
		}
	 ?>

<input type="submit" name="update" value="Update">
</form></div></p>
</body>
</html>