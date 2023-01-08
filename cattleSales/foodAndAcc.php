<html>
<head>
	<link rel="stylesheet" type="text/css" href="foodAndAcc.css">
	<?php 
		session_start();
		include_once('header.php');
	?>
</head>
<body>
	
	<a href="sellProduct.php"><button id="sellAProdBtn">Sell a product</button></a><br><br>
	<div id="prodContainer">
		<?php 
		$userName = $_SESSION['userName'];

		$conn = mysqli_connect('localhost','root',"",'cattlesales');
		if(!$conn) die("connection failed");
		else{
			$sql = "SELECT * FROM products where soldStatus='u' ";
			$result = mysqli_query($conn,$sql);
				if(mysqli_num_rows($result) == 0)
					echo "Nothing for sale";
				else{
					echo "<table id='productTable' cellpadding=10px align='center' cellspacing='5px'>";
					while($row = mysqli_fetch_assoc($result)){
						
						echo "<tr><td class = 'tdDetails' width='200'><div><img src='data:image;base64, {$row["image"]} 'alt='img' width='150' height='150'></div></td> ";
						echo "<td class = 'tdDetails' width='200'>".$row['productType']."</td>";
						echo "<td class = 'tdDetails' width='200'>Rs. ".$row['price']."</td>";
						echo "<td class = 'tdDetails' width='200'><a href='buyProduct.php?id={$row['id']}'><button class='buybtn'>View details</button></a> </td></tr>";						
							
					}
					echo "</table>";
				}
				mysqli_close($conn);
			} ?>
	</div>
</body>
<?php 
	include_once('footer.php');
?>
</html>