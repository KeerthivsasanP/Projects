<html>
<head>
	<link rel="stylesheet" type="text/css" href="detailedView.css">
	<?php 
		session_start();
		include_once("header.php");
	?>
</head>
<body>
		<?php 
		
		$conn = mysqli_connect('localhost','root',"",'cattlesales');
		if(!$conn) die("connection failed");
		else{
			$id = $_GET['id'];
			$_SESSION['cattleId'] = $id;
			$_SESSION['itemType'] = "cattle";
			$sql = "SELECT * FROM seller where id='$id'";
			$result = mysqli_query($conn,$sql);
				if(mysqli_num_rows($result) == 0)
					echo "Nothing for sale";
				else{
					
					while($row = mysqli_fetch_assoc($result)){
					
						echo "<p align='center'><img width=50% class='detailImg' src='data:image;base64, {$row["image"]} 'alt='img' height='50%'></p><br><br> ";
						echo "<b><p align='center' class='price'>Rs.{$row['price']}/- only</p></b>";
						echo "<table id='cattleDetailTable' align='center' cellpadding='20px'>
								<tr>
									<td width='20%' class = 'tdDetails'>Catle type</td>
									<td width='50%' class = 'tdDetails'>{$row['cattleType']}</td>
								</tr>
								<tr>
									<td class = 'tdDetails'>Breed</td>
									<td class = 'tdDetails'>{$row['breed']}</td>
								</tr>
								<tr>
									<td class = 'tdDetails'>Country</td>
									<td class = 'tdDetails'>{$row['country']}</td>
								</tr>
								<tr>
									<td class = 'tdDetails'>Weight(in kgs)</td>
									<td class = 'tdDetails'>{$row['weight']}</td>
								</tr>
								<tr>
									<td class = 'tdDetails'>Brief description</td>
									<td class = 'tdDetails'>{$row['cattleDesc']}</td>
								</tr>
								<tr>
									<td class = 'tdDetails'>Address</td>
									<td class = 'tdDetails'>{$row['address']}</td>
								</tr>
								<tr>
									<td>State</td>
									<td>{$row['state']}</td>
								</tr>
								<tr>
									<td class = 'tdDetails'>Contact no</td>
									<td class = 'tdDetails'>{$row['contact']}</td>
								</tr>
								<tr>
									<td class = 'tdDetails'>E-mail</td>
									<td class = 'tdDetails'>{$row['userName']}</td>
								</tr>	
						</table>";	
						$_SESSION['amount'] = $row['price'];
						$_SESSION['cattleType'] = $row['cattleType'];
							}
				
				}
				mysqli_close($conn);
			}
	 ?>
	 <br><br>
	 <center>
	 <a <?php if($_SESSION['userName']=="") echo "href='signin.php'"; else echo "href='paymentCattle.php'"; ?>><button name="buy" id='detailSubmitButton'>Buy</button></a>
	 </center>

	 <?php
	 	include_once('footer.php');
	 ?>
</body>
</html>