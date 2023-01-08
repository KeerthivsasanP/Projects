<html>
<head>
	<link rel="stylesheet" type="text/css" href="detailedView.css">
	<?php
		session_start();
		include_once('header.php');
	?>
</head>
<body>
	<?php
	$conn = mysqli_connect('localhost','root',"",'cattlesales');
		if(!$conn) die("connection failed");
		else{
			$id = $_GET['id'];
			$_SESSION['productId'] = $id;

			$_SESSION['itemType'] = "product";
			$sql = "SELECT * FROM products where id='$id'";
			$result = mysqli_query($conn,$sql);
				if(mysqli_num_rows($result) == 0)
					echo "Nothing for sale";
					else{
					while($row = mysqli_fetch_assoc($result)){
						echo "<p align='center'><img width=50% class='detailImg' src='data:image;base64, {$row["image"]} 'alt='img' height='50%'></p><br><br> ";
						echo "<b><p align='center' class='price'>Rs.{$row['price']}/- only</p></b>";
						echo "<table align='center' width=60% id='cattleDetailTable' cellpadding='20px'>
								<tr>
									<td class='tdDetails' width='10%'>Product type</td>
									<td class='tdDetails' width='30%'>{$row['productType']}</td>
								</tr>
								<tr>
									<td class='tdDetails'>Brand</td>
									<td class='tdDetails'>{$row['brand']}</td>
								</tr>
								<tr>
									<td class='tdDetails'>New or used</td>
									<td class='tdDetails'>{$row['newOrUsed']}</td>
								</tr>
								<tr>
									<td>Country</td>
									<td>{$row['country']}</td>
								</tr>
								<tr>
								<tr>
									<td class='tdDetails'>Available</td>
									<td class='tdDetails'>{$row['quantity']}</td>
								</tr>
								<tr>
									<td class='tdDetails'>Price</td>
									<td class='tdDetails'>{$row['price']}</td>
								</tr>
									<td class='tdDetails'>Contact</td>
									<td class='tdDetails'>{$row['contact']}</td>
								</tr>
							</table>";

							$_SESSION['amount'] = $row['price'];
							$_SESSION['productType'] = $row['productType'];
							?>


<?php
							$_SESSION['procuctId'] = $row['id'];
							$_SESSION['amount'] = $row['price'];
					}
				}
				mysqli_close($conn);
			}
?>
	<br><br>
	<center>
	 <a <?php if($_SESSION['userName']=="") echo "href='signin.php'"; else echo "href='paymentProduct.php'"; ?>><button name="buy" id='detailSubmitButton'>Buy</button></a>
	 </center>

	<?php include_once('footer.php'); ?>
</body>
</html>