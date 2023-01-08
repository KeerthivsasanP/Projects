<html>
<head>
	<title>seller</title>
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

<form method="post" enctype="multipart/form-data">

<fieldset>
	<legend>Seller detail</legend>
	<table align="center" cellspacing="10px">
		<tr>
			<td>User name :</td>
			<td><input type="email" name="userName" value="<?php echo $_SESSION['userName'] ?>" disabled></td>
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
		<tr>
			<td>Contact no :</td>
			<td>
				<input type="text" name="contactNo" maxlength="10" placeholder="Ex:9999999999" required <?php isset($_POST['contactNo'])?$_POST['contactNo']:"" ?>>
			</td>
		</tr>
	</table>
</fieldset>
<br><br>
<fieldset>
	<legend>Cattle detail</legend>
	<table align="center" cellspacing="10px">
		<tr>
			<td valign="top">Cattle type :</td>
			<td><input type="radio" name="cattleType" value="Cow" required>Cow<br>
				<input type="radio" name="cattleType" value="Ox" required>Ox<br>
				<input type="radio" name="cattleType" value="Goat" <?php if(isset($_POST['cattleType'])){echo 'checked="checked"';} ?>>Goat<br>
				<input type="radio" name="cattleType" value="Sheep">Sheep<br>
				<input type="radio" name="cattleType" value="Horse">Horse<br>
				<input type="radio" name="cattleType" value="Other">Other<br>
			</td>
		</tr>
		<tr>
			<td>Breed :</td>
			<td><input type="text" name="breed" placeholder="breed" required></td>
		</tr>
		<tr>
			<td>Weight in kgs :</td>
			<td><input type="number" name="weight" min=0 placeholder="0" required <?php isset($_POST['weight'])?$_POST['weight']:"" ?>></td>
		</tr>
		<tr>
			<td>About cattle in brief<br>(not more than 500 words)</td>
			<td><textarea name="cattleDesc" placeholder="Brief description of pets" rows="5" cols="40"></textarea></td>
		</tr>
		<tr>
			<td>Upload image :</td>
			<td><input type="file" name="image" required></td>
		</tr>
		<tr>
			<td>Pricing</td>
			<td><input type="number" name="price" min="0" placeholder="10" required <?php isset($_POST['price'])?$_POST['price']:"" ?>></td>
		</tr>
	</table>
</fieldset>
<br>
<input type="checkbox" name="TandC" required><span class="TandC">I agree to the</span> <a href="termsAndConditions.php">Terms and Policy</a><span class="TandC"> of the website.</span><br><br>

<?php
	error_reporting(0);
	$userName = "";
	$cattleType = "";
	$country = "";
	$weight = "";
	$state = "";
	$address = "";
	$contactNo = "";
	$imageType = "";
	$price = "";
	$cbTandC = "";
	$cattleDesc = "";
	$breed = "";
	
	if(isset($_POST['submit'])){

	$userName = $_SESSION['userName'];
	$cattleType = $_POST['cattleType'];
	$country = $_POST['country'];
	$weight = $_POST['weight'];
	$state = $_POST['state'];
	$contactNo = $_POST['contactNo'];
	$imageType = strtolower(pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION));
	$price = $_POST['price'];
	$address = $_POST['address'];
	$cbTandC = $_POST['TandC'];
	$cattleDesc = $_POST['cattleDesc'];
	$breed = $_POST['breed'];

		if($cattleType == "")	echo "<p class='errorMessage'>Please select a cattle type</p>";
		
		else if (!preg_match('/^[0-9]{10}$/',$contactNo))	echo "<p class='errorMessage'>Invalid mobile number</p>";
	

		else if($state == "")	echo "<p class='errorMessage'>Please select a state</p>";


		else if ($_FILES['image']['size']>5000000)	echo "<p class='errorMessage'>File is too large to upload.Allowed size is only 5MB</p>";

		else if($imageType != "jpg" && $imageType != "png" && $imageType != "jpeg" && $imageType != "gif" && $imageType != "jfif")	echo "Sorry, only JPG, JPEG, PNG, JFIF & GIF files are allowed.";

		else if($price == "")	echo "<p class='errorMessage'>Please fill the amount</p>";

		else if($price<0)	echo "<p class='errorMessage'>Price should be greater than 0</p>";

		else if(empty($cbTandC)) echo "<p class='errorMessage'>Accept to terms and polices by checking the check box</p>";

		else{
			$conn = mysqli_connect("localhost","root","","cattlesales");
			if(!$conn){
				echo "<p class='errorMessage'>Cannot connect. Please try again.</p>";
			}
			else
			{
				$image = $_FILES['image']['tmp_name'];
				$name = $_FILES['image']['name'];
				$image = file_get_contents($image);
				$image = base64_encode($image);
				
				$sql = "INSERT INTO seller VALUES('?','$userName','$cattleType','$breed','$country','$weight','$image','$state','$address','$contactNo',$price,'$cattleDesc',NOW(),'u','?','?') ";
				if(mysqli_query($conn,$sql)){
					echo "<script>
							alert('Now your cattle is for sale');
							document.location = 'home.php';
							 </script>";
							}else{
								echo '<p class="errorMessage">OOPS. Something went wrong. Try again</p>' ;
							}
				
			}
			if(mysqli_error($conn))
				echo "Error: ".mysqli_error($conn);
			mysqli_close($conn);
		}

	}


?>

<center>
	<input type="submit" name="submit">
</center>
</form>
</body>
	<?php 	include_once('footer.php'); ?>
</html>