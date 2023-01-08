<html>
<head>
	<link rel="stylesheet" type="text/css" href="valCard.css">
	<?php 
		session_start();
	?>
	<script>
		//stop resubmission on refresh
		if(window.history.replaceState){
			window.history.replaceState(null,null,window.location.href);
		}
	</script>
</head>
<body>
	<br><br><br><br><br><br>
	<center>
	<div>
	<h1>Choose an UPI app :</h1><hr>
	<form method="post">
		<table align="center" cellspacing="5px" width="400px">
		<tr>
			<td><input type="radio" name="app" value="bhim">BHIM</td>
			<td align="right"><img src="images/bhimIcon.png" width="70px" height="50px"></td>
		</tr>
		<tr>
			<td><input type="radio" name="app" value="phonepe">PhonePe</td>
			<td align="right"><img src="images/phonepeIcon.png" width="70px" height="50px"><td>
		</tr>
		<tr>
			<td><input type="radio" name="app" value="googlepay">Googlepay</td>
			<td align="right"><img src="images/googlepayIcon.png" width="70px" height="50px"><td>
		</tr>
		<tr>
			<td><input type="radio" name="app" value="paytm">Paytm</td>
			<td align="right"><img src="images/paytmIcon.png" width="70px" height="50px"><td>
		</tr>
		</table>

<?php 
	error_reporting(0);
	$app = "";
	if(isset($_POST['proceedToPay'])){
		$app = $_POST['app'];
		if($app == "") echo"<p class='errorMessage'> Please choose an app to proceed</p>";
		else{
			$_SESSION['app'] = $app;
			
			if($_SESSION['itemType'] == "cattle"){
			header('location:proceedToPayCattle.php');
			}
			else if($_SESSION['itemType'] == "product"){
			header('location:proceedToPayProduct.php');
			}
		}
	}
?>

<br>
<input type="submit" name="proceedToPay" value="Proceed" id="paybtn">
</form>
	</div>
	</center>
</body>
</html>