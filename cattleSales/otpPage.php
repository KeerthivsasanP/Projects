<html>
<head>
	<link rel="stylesheet" type="text/css" href="signin.css">
</head>
<body>
	<p align="center"><div>
	<h1>Enter the OTP</h1>
	<form method="post">
		4-digit OTP : <input type="text" name="enteredOtp" maxlength=4>
		<input type="submit" name="resendOtp" value="Resend OTP"><br>

<?php

session_start();

$userName = $_SESSION['userName'];
$newPass = $_SESSION['newPass'];
$enteredOtp = "";
$sentOtp = rand(1000,9999);

$conn = mysqli_connect("localhost","root","","cattlesales");

//SEND OTP FOR FIRST TIME
//Delete expired otp
	$sql = "DELETE FROM trackpassword WHERE endtime<NOW()";
	mysqli_query($conn,$sql);

	$msg="Your OTP to change the password is ".$sentOtp." .Don't share it with anyone.";
	
	$sql = "SELECT userName FROM trackpassword WHERE BINARY userName='$userName' ";
	 $result = mysqli_query($conn,$sql);

// send otp if user not exist
	if(mysqli_num_rows($result) == 0){
		mail($userName,"OTP for password change",$msg);
	 	$sql = "INSERT INTO trackpassword VALUES ('$userName',NOW(),ADDTIME(NOW(),'00:02:00'),'$sentOtp')";
	 	mysqli_query($conn,$sql);
	 	echo "OTP has been sent<br>";

	}
	
//else send otp for first time
	// else if (mysqli_num_rows($result) == 1){
	// 	echo "<script>
	// 		alert('OTP has been sent, please wait for 2 minutes')
	// 		</script>";
	// }
	
if(isset($_POST['submit'])){
	$enteredOtp = $_POST['enteredOtp'];

//Delete previous unused otp
	$sql = "DELETE FROM trackpassword WHERE endtime<NOW()";
	mysqli_query($conn,$sql);

//check user if exists
$sql = "SELECT userName,otp FROM trackpassword WHERE BINARY userName='$userName' AND otp='$enteredOtp' ";
$result = mysqli_query($conn,$sql);

//if user exist update password
if(mysqli_num_rows($result) == 1){
	$sql = "UPDATE users SET password = '$newPass' WHERE BINARY userName='$userName' ";
	$result = mysqli_query($conn,$sql);
	echo "<script>
			alert('Password updated successfully');
			document.location = 'signin.php';
		 </script>";

//Delete the current user from table
	$sql = "DELETE FROM trackpassword WHERE userName='$userName' ";
	mysqli_query($conn,$sql);
}

//else dont update password
else if($enteredOtp == ""){
	echo "<p class='errorMessage'>Enter OTP</p>";
}
else 
	echo "<p class='errorMessage'>OTP does not match. Try again.</p>";

echo mysqli_error($conn);
}

if(isset($_POST['resendOtp'])){
//Delete previous unused otp
	$sql = "DELETE FROM trackpassword WHERE endtime<NOW()";
	mysqli_query($conn,$sql);
	$sql = "SELECT userName FROM trackpassword WHERE BINARY userName='$userName' ";
	$result = mysqli_query($conn,$sql);

//if otp exist, ask user to wait
	if(mysqli_num_rows($result) == 1)
	echo "<script>
			alert('OTP has been sent please wait for 2 minutes');
			</script>";

//else sent otp again
	else if(mysqli_num_rows($result) == 0)
	{
		$sql = "DELETE FROM trackpassword WHERE endtime<NOW()";
		mysqli_query($conn,$sql);
		$sql = "INSERT INTO trackpassword VALUES ('$userName',NOW(),ADDTIME(NOW(),'00:02:00'),'$sentOtp')";
		$result=mysqli_query($conn,$sql);
		echo "<script>
			alert('OTP has been sent again');
			</script>";
		}
}
mysqli_close($conn);
?>

<input type="submit" name="submit" value="Update password">
</form></div></p>
</body>
</html>