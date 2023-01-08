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
	<h1>Choose your bank :</h1><hr>
	<form method="post">
		<table align="center" cellspacing="5px" width="400px">
		<tr>
			<td>Choose your bank :</td>
			<td>
				<select name="bank" required>
					<option value=""></option>
					<option value='SBI'>State bank of India</option>
					<option value='IOB'>Indian Overseas Bank</option>
					<option value='Axis'>Axis Bank</option>
					<option value='ICICI'>ICICI Bank</option>
					<option value='KVB'>Karur Vyasa Bank</option>
				</select>
			</td>
		</tr>
		</table>

<?php 
	error_reporting(0);
	$bank = "";
	if(isset($_POST['proceedToPay'])){
		$bank = $_POST['bank'];
		if($bank == "") echo"<p class='errorMessage'> Please choose your bank to proceed</p>";
		else{
			$_SESSION['bank'] = $bank;
			
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