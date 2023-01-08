<html>
<head>
	<link rel="stylesheet" type="text/css" href="payment.css">
	<?php
		session_start();
	 ?>
</head>
<body>
	<br><br><br><br><br><br>
	<center>
	<div>
	<p><form method="post">
		
		
		<h1>Choose payment mode</h1>
		<table cellspacing="20px">
		<tr><td><input type="radio" name="payMode" value="Credit/Debit card">Credit/Debit card</td></tr>
		<tr><td><input type="radio" name="payMode" value="UPI">UPI</td></tr>
		<tr><td><input type="radio" name="payMode" value="Netbanking">Netbanking</td></tr>
		<tr><td><input type="radio" name="payMode" value="Cash on Delivery">Cash on Delivery</td></tr>
		</table>

		
	<?php
		error_reporting(0);
		$payMode = "";

		if(isset($_POST['proceed'])){
			$payMode = $_POST['payMode'];
			$_SESSION['payMode'] = $payMode;
			if($payMode == "") echo "<p class='errorMessage'>Please select a payment mode</p>";

			else if($payMode == "Credit/Debit card") header('location:valCard.php');
			else if($payMode == "UPI") header('location:chooseApp.php');
			else if($payMode == "Netbanking") header('location:chooseBank.php');
			else if($payMode == "Cash on Delivery") header('location:proceedToPayCattle.php');

		}
	 ?>
	 <br><br><br>
	 <input type="submit" id="proceed" name="proceed" value="Proceed">
	</form></p>
	</div>
	</center>

</body>
</html>