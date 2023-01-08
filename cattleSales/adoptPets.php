<html>
<head>
		<link rel="stylesheet" type="text/css" href="adoptPets.css">
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
			$sql = "SELECT * FROM pets";
			$result = mysqli_query($conn,$sql);
				if(mysqli_num_rows($result) == 0)
					echo "Nothing for sale";
					else{
					echo "<div class='container'>";
					while($row = mysqli_fetch_assoc($result)){
						echo "<div class='gallery'>";
						echo "<img src='data:image;base64, {$row["image"]} 'alt='img' width='300' height='300'><br><br> ";
						echo "<div class='desc'> Pet type : ".$row['petType']."<br>";
						echo "Contact no : ".$row["contact"]."<br>
								<a href='petsDetailedView.php?id={$row['id']}'><p align='center'><button class='detailButton'>View details</button></p></a></div>";
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
