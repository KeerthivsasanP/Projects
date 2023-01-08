<html>
<head>
	<link rel="stylesheet" type="text/css" href="seller.css">
	<?php
		 session_start();
		 include_once('header.php');
	 ?>
	<script>
		//stop resubmission on refresh
		if(window.history.replaceState){
			window.history.replaceState(null,null,window.location.href);
		}
	</script>
</head>
<body>
	<h1 align="center">Update pet details</h1>
	<hr>
	<form method="post" enctype="multipart/form-data">

<fieldset>
	<legend>User detail</legend>
	<table align="center" cellspacing="10px">
		<tr>
			<td>User name :</td>
			<td><input type="email" name="userName" value="<?php echo $_SESSION['userName'] ?>" disabled></td>
		</tr>
		<tr>
			<td>Contact no :</td>
			<td>
				<input type="text" name="contactNo" maxlength="10" placeholder="Ex:9999999999" required <?php isset($_POST['contactNo'])?$_POST['contactNo']:"" ?>>
			</td>
		</tr>
				<tr>
			<td>Country:</td>
			<td>
				<select name="country" required>
					<option value=""><?php if(isset($_POST['country'])) echo $_POST['country'] ; else echo "" ?></option>
					<option value='India'>India</option>
					<option value='Bangladesh'>Bangladesh</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>State or region :</td>
			<td>
				<input type="text" name="state" required <?php isset($_POST['state'])?$_POST['state']:"" ?>>
			</td>
		</tr>
		<tr>
			<td>Address :</td>
			<td><textarea name="address" rows="5" cols="40" placeholder="Address" required></textarea></td>
		</tr>

	</table>
</fieldset>
<br><br>
<fieldset>
	<legend>Pet detail</legend>
	<table align="center" cellspacing="10px">
		<tr>
			<td valign="top">Pet type :</td>
			<td><input type="radio" name="petType" value="Dog" required>Dog<br>
				<input type="radio" name="petType" value="Cat" <?php if(isset($_POST['petType'])){echo 'checked="checked"';} ?>>Cat<br>
				<input type="radio" name="petType" value="Other" required>Other<br>
			</td>
		</tr>
		<tr>
			<td>Upload image :</td>
			<td><input type="file" name="image" required></td>
		</tr>
		<tr>
			<td>Story of pet</td>
			<td><textarea name="story"placeholder="Story of your pet" required></textarea></td>
		</tr>
	</table>
</fieldset>
<br>
<input type="checkbox" name="TandC" required>I agree to the <a href="termsAndConditions.php">Terms and Policy</a> of the website.<br><br>

<?php
	error_reporting(0);
	$userName = "";
	$address = "";
	$number = "";
	$petType = "";
	$story = "";	
	$contactNo = "";
	$imageType = "";
	$state = "";
	$country = "";
	$cbTandC = "";
	
	if(isset($_POST['submit'])){

	$address = $_POST['address'];
	$userName = $_SESSION['userName'];
	$petType = $_POST['petType'];
	$contactNo = $_POST['contactNo'];
	$imageType = strtolower(pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION));
	$country = $_POST['country'];
	$story = $_POST['story'];
	$state = $_POST['state'];
	$cbTandC = $_POST['TandC'];
	$id=$_GET['id'];

		if($petType == "")	die("Please select a pet type");
		
		else if (!preg_match('/^[0-9]{10}$/',$contactNo))	die("invalid mobile number");
	

		else if($state == "")	die("Please select a state");


		else if ($_FILES['image']['size']>5000000)	die("File is too large to upload.Allowed size is only 5MB");

		else if($imageType != "jpg" && $imageType != "png" && $imageType != "jpeg" && $imageType != "gif" && $imageType != "jfif")	die("Sorry, only JPG, JPEG, PNG, JFIF & GIF files are allowed.");


		else if(empty($cbTandC)) exit("Accept to terms and polices by checking the check box");

		else{
			$conn = mysqli_connect("localhost","root","","cattlesales");
			if(!$conn){
				echo "Cannot connect. Please try again.";
			}
			else
			{
				$image = $_FILES['image']['tmp_name'];
				$name = $_FILES['image']['name'];
				$image = file_get_contents($image);
				$image = base64_encode($image);
				$sql = "SELECT userName FROM users WHERE BINARY userName='$userName'";
				$result = mysqli_query($conn,$sql);
				if(mysqli_num_rows($result)==0)
					{
						echo 'Invalid user name. <a href="signup.php"> Signup </a> if new user';
					}else{
							$sql = "UPDATE pets SET petType='$petType',story='$story',image='$image',contact='$contactNo',country='$country',state='$state',address='$address' WHERE id='$id'  ";
							if(mysqli_query($conn,$sql)){
								echo "<script>
										alert('Updated successfully');
										document.location = 'home.php';
									 </script>";
							}else{
								echo 'Oops.Some error occurred while inserting.Please try again' ;
							}
				}
			}
			if(mysqli_error($conn))
				echo "Error: ".mysqli_error($conn);
			mysqli_close($conn);
		}

	}
?>


<center>
	<input type="submit" name="submit" align="center">
</center>
</form>
<?php 
	include_once('footer.php');
?>
</body>
</html>