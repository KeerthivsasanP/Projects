<html>
<head>
	<link rel="stylesheet" type="text/css" href="petsDetailedView.css">
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
			$sql = "SELECT * FROM pets where id='$id'";
			$result = mysqli_query($conn,$sql);
				if(mysqli_num_rows($result) == 0)
					echo "Nothing for sale";
					else{
					while($row = mysqli_fetch_assoc($result)){
						echo "<p align='center'><img width=50% class='detailImg' src='data:image;base64, {$row["image"]} 'alt='img' height='50%'></p><br><br> ";
						echo "<table id='cattleDetailTable' align='center' cellpadding='20px'>
								<tr>
								<td class = 'tdDetails' width='20%'>Catle type</td>
								<td class = 'tdDetails' width='50%'>{$row['petType']}</td>
								</tr>
								<tr>
								<td class = 'tdDetails'>Story of the pet</td>
								<td class = 'tdDetails'>{$row['story']}</td>
								</tr>
								<tr>
								<td class='tdDetails'>State</td>
								<td class='tdDetails'>{$row['story']}</td>
								</tr>
								<tr>
								<td class='tdDetails'>Contact</td>
								<td class='tdDetails'>{$row['contact']}</td>
								</tr>
							</table>";
					}
					$_SESSION['petId'] = $id;
				}
				mysqli_close($conn);
			}
?>

<br><br>
<center>
	<a href="confirmAdoption.php"><button id="adoptbtn">Adopt</button></a>
</center>

<?php include_once('footer.php'); ?>
</body>
</html>