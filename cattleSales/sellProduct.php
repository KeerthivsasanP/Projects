<html>
<head>
	<link rel="stylesheet" type="text/css" href="seller.css">
	<script>
		//stop resubmission on refresh
		if(window.history.replaceState){
			window.history.replaceState(null,null,window.location.href);
		}
	</script>
	<?php
		session_start();
		include_once('header.php');
	?>
</head>
<body>
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
	<legend>Product detail</legend>
	<table align="center" cellspacing="10px">
		<tr>
			<td valign="top">Product type :</td>
			<td>
				<input type="text" name="productType" placeholder="Ex:belt,food,rope,etc.," required>
			</td>
		</tr>
		<tr>
			<td valign="top">Brand :</td>
			<td>
				<input type="text" name="brand" required>
			</td>
		</tr>
		<tr>
			<td>New or used ? :</td>
			<td><input type="radio" name="newOrUsed" value="new" required>New<br>
				<input type="radio" name="newOrUsed" value="used" required>Used
			</td>
		</tr>
		<tr>
			<td>About product in brief<br>(not more than 500 words)</td>
			<td><textarea name="productDesc" placeholder="Brief description of product" rows="5" cols="40"></textarea></td>

		</tr>
		<tr>
			<td>Quantity :</td>
			<td><input type="number" name="quantity" min="1" value="1" required></td>
		</tr>
		
		<tr>
			<td>Upload image :</td>
			<td><input type="file" name="image" required></td>
		</tr>
		<tr>
			<td>Pricing (in INR)</td>
			<td><input type="number" name="price" min="0" placeholder="10" required <?php isset($_POST['price'])?$_POST['price']:"" ?>></td>
	</table>
</fieldset>
<br>
<input type="checkbox" name="TandC" required>I agree to the <a href="termsAndConditions.php">Terms and Policy</a> of the website.<br><br>

<?php
	$userName = "";
	$productType = "";
	$country = "";
	$quantity = "";
	$state = "";
	$address = "";
	$contactNo = "";
	$imageType = "";
	$price = "";
	$cbTandC = "";
	$brand = "";
	$newOrUsed = "";
	$productDesc = "";
	
	if(isset($_POST['submit'])){

	$userName = $_SESSION['userName'];
	$productType = $_POST['productType'];
	$country = $_POST['country'];
	$newOrUsed = $_POST['newOrUsed'];
	$quantity = $_POST['quantity'];
	$state = $_POST['state'];
	$contactNo = $_POST['contactNo'];
	$imageType = strtolower(pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION));
	$price = $_POST['price'];
	$brand = $_POST['brand'];
	$address = $_POST['address'];
	$cbTandC = $_POST['TandC'];
	$productDesc = $_POST['productDesc'];

		if($productType == "")	echo "Please select a cattle type";
		
		else if (!preg_match('/^[0-9]{10}$/',$contactNo))	echo "invalid mobile number";
	

		else if($state == "")	echo "Please select a state";


		else if ($_FILES['image']['size']>5000000)	echo "File is too large to upload.Allowed size is only 5MB";

		else if($imageType != "jpg" && $imageType != "png" && $imageType != "jpeg" && $imageType != "gif" && $imageType != "jfif")	echo"Sorry, only JPG, JPEG, PNG, JFIF & GIF files are allowed.";

		else if($price == "") echo "Please fill the amount";

		else if($price<0) echo "Price should be greater than 0";

		else if(empty($cbTandC)) echo "Accept to terms and polices by checking the check box";

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
				
				$sql = "INSERT INTO products VALUES('$userName','?','$productType','$brand','$newOrUsed','$productDesc','$country','$quantity','$image','$state','$address','$contactNo',$price,NOW(),'u','?') ";
				if(mysqli_query($conn,$sql)){
					echo "<script>
							alert('Now your product is for sale');
							document.location = 'home.php';
							 </script>";
							}else{
								echo 'OOPS. Something went wrong. Try again' ;
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
<?php include_once('footer.php'); ?>
</body>
</html>