<html>
<head>
	<link rel="stylesheet" type="text/css" href="proceedToPay.css">
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
	<h1>Payment</h1><hr>
	<form method="post">
	<b>I accept to pay Rs. <?php echo $_SESSION['amount']; ?> through <?php echo $_SESSION['payMode']; ?><br>to Online cattle sales.</b><br><br>
	<input type="submit" name="pay" value="Order" id="paybtn">
	</form>
	</div>
	</center>

<?php 
	
	if(isset($_POST['pay'])){

	$payMode = $_SESSION['payMode'];
	$amount = $_SESSION['amount'];
	$userName = $_SESSION['userName'];
	$productType = $_SESSION['productType'];
	$productId = $_SESSION['productId'];

	$cardNo = $_SESSION['cardNo'];
	$cardHolderName = $_SESSION['cardHolderName'];
	$expMonth = $_SESSION['expMonth'];
	$expYear = $_SESSION['expYear'];
	$cvv = $_SESSION['cvv'];

	$app = $_SESSION['app'];
	$bank = $_SESSION['bank'];
	$itemType = $_SESSION['itemType'];


	$conn = mysqli_connect("localhost","root","","cattlesales");
			if(!$conn){
				echo "Cannot connect. Please try again.";
			}
			else{

				if($payMode == "Credit/Debit card"){
					$sql = "INSERT INTO payCard VALUES('?','$userName','Product',$productId,'$productType',$amount,NOW(),'$cardNo','$cardHolderName','$expMonth','$expYear','$cvv')";
					if(mysqli_query($conn,$sql)){
						echo "<script>
							alert('Payment successful');
							document.location = 'home.php';
							 </script>";
							 }
					echo mysqli_error($conn);
					}

				else if($payMode == "UPI"){
					$sql = "INSERT INTO payUpi VALUES('?','$userName','Product',$productId,'$productType',$amount,NOW(),'$app')";
					if(mysqli_query($conn,$sql)){
						echo "<script>
							alert('Payment successful');
							document.location = 'home.php';
							 </script>";
							 }
					echo mysqli_error($conn);
				} 
				
				else if($payMode == "Netbanking"){
					$sql = "INSERT INTO payNetbanking VALUES('?','$userName','Product',$productId,'$productType',$amount,NOW(),'$bank')";
					if(mysqli_query($conn,$sql)){
						echo "<script>
							alert('Payment successful');
							document.location = 'home.php';
							 </script>";
							 }
					echo mysqli_error($conn);
				}

				else if($payMode == "Cash on Delivery"){
					$sql = "INSERT INTO payCash VALUES('?','$userName','Product',$productId,'$productType',$amount,NOW())";
					if(mysqli_query($conn,$sql)){
						echo "<script>
							alert('Order placed successfully');
							document.location = 'home.php';
							 </script>";
							 }
					echo mysqli_error($conn);
				}

				$sql = "UPDATE products SET soldStatus='s',soldTime=NOW() WHERE id='$productId' ";
						$result = mysqli_query($conn,$sql);
		}
	}

?>
</body>
</html>