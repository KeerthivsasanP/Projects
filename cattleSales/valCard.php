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
	<h1>Card details</h1><hr>
	<form method="post">
		<table align="center" cellspacing="20px">
		<tr>
			<td>Card no:</td>
			<td><input type="text" name="cardNo" maxlength="16" placeholder="0000000000000000" required></td>
		</tr>
		<tr>
			<td>Card holder name:</td>
			<td><input type="text" name="cardHolderName" placeholder="name" required></td>
		</tr>
		<tr>
			<td>Expiry Month(MM) / Year(YY)</td>
			<td><input type="text" name="expMonth" maxlength="2" placeholder="00" required> / 
			<input type="text" name="expYear" maxlength="2" placeholder="00" required></td>
		</tr>
		<tr>
			<td>CVV</td>
			<td><input type="text" maxlength="3" name="cvv" placeholder="000"></td>
		</tr>
		</table>

<?php 
	
	$cardNo = "";
	$cardHolderName = "";
	$expMonth = "";
	$expYear = "";
	$cvv = "";

	if(isset($_POST['proceedToPay'])){
		$cardNo = $_POST['cardNo'];
		$cardHolderName = $_POST['cardHolderName'];
		$expMonth = $_POST['expMonth'];
		$expYear = $_POST['expYear'];
		$cvv = $_POST['cvv'];
		$currYear = date("Y")-2000;
		$currMonth = date("m");

		if($cardHolderName == "")	echo"<p class='errorMessage'> Please enter the card holder name</p>";

		else if(!preg_match('/^[0-9]{16}$/',$cardNo)) echo "<p class='errorMessage'>Card number invalid. Enter numbers without space</p>";

		else if(!preg_match('/^[0-9]{2}$/',$expMonth)) echo "<p class='errorMessage'>Only 2 digits allowed for expiry month</p>";

		else if(intval($expMonth)>12 || intval($expMonth)<1) echo "<p class='errorMessage'>Invalid expiry month</p>";

		else if(!preg_match('/^[0-9]{2}$/',$expYear)) echo "<p class='errorMessage'>Enter the last 2 digits of expiry year</p>";

		else if(intval($expYear)<$currYear) echo "<p class='errorMessage'>Invalid expiry year</p>";

		else if(intval($expYear)==$currYear && intval($expMonth)<$currMonth)	echo "<p class='errorMessage'>Invalid expiry month</p>";
		
		else if(!preg_match('/^[0-9]{3}$/',$cvv)) echo "<p class='errorMessage'>Only 3 digits allowed for CVV number</p>";
		else{
			$_SESSION['cardNo'] = $cardNo;
			$_SESSION['cardHolderName'] = $cardHolderName;
			$_SESSION['expMonth'] = $expMonth;
			$_SESSION['expYear'] = $expYear;
			$_SESSION['cvv'] = $cvv;

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