<html>
<head>
	<link rel="stylesheet" type="text/css" href="home.css">
</head>
<body>
	<?php 
		session_start();
		include_once('header.php');

		$conn = mysqli_connect('localhost','root',"",'cattlesales');
		if(!$conn) die("connection failed");
		else{
			$sql = "SELECT * FROM seller where soldStatus='u' ";
			$result = mysqli_query($conn,$sql);
				if(mysqli_num_rows($result) == 0)
					echo "Nothing for sale";
				else{
					echo "<div class='container'>";
					while($row = mysqli_fetch_assoc($result)){
						echo "<div class='gallery'>";
						echo "<img src='data:image;base64, {$row["image"]} 'alt='img' width='298' height='300'><br><br> ";
						echo "<div class='desc'> Country: ".$row['country']."<br>";
						echo "Cattle type: ".$row['cattleType']."<br>";
						echo "State: ".$row["state"]."<br><br>";
						echo "<p align='center' style='font-weight:900;color:black'></b>Rs.".$row['price']."</b></p><br>
								<a href='detailedView.php?id={$row["id"]}'><p align='center'><button class='detailButton'>View details</button></p></a><br></div>";
						echo "</div>";
					}
					echo "</div>";
				}
				mysqli_close($conn);
			}

		include_once('footer.php');
	 ?>
</body>
</html>

