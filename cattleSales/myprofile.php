<html>
<head>
	<?php 
		session_start();
		include_once('header.php');
	 ?>
	 <link rel="stylesheet" type="text/css" href="myProfile.css">
</head>
<body>

	<p align=right><a href="changeProfile.php"><button id="changeProf">Change profile</button></a></p>
	<h2>Your products for sale</h2>
	<div style="background-color: #D3F7A4;">
		<?php 
		$userName = $_SESSION['userName'];
		$conn = mysqli_connect('localhost','root',"",'cattlesales');
		if(!$conn) die("connection failed");
		else{
			$sql = "SELECT * FROM seller where soldStatus='u' and userName='$userName' ";
			$result = mysqli_query($conn,$sql);
				if(mysqli_num_rows($result) == 0)
					echo "Nothing for sale";
				else{
					echo "<table class='myProfiletable' align='center' cellpadding=10px>
							<tr class='myProfiletr' ><th width=300>Image</th>
								<th width=200>Type</th>
								<th width=200>Price</th>
								<th width=100></th>
								<th width=100></th></tr>";
					while($row = mysqli_fetch_assoc($result)){
						
						echo "<tr class='myProfiletr'><td class='myProfiletd'><div class='soldImage'><img src='data:image;base64, {$row["image"]} 'alt='img' width='100' height='100'></div></td> ";
						echo "<td class='myProfiletd'>Cattle type: ".$row['cattleType']."</td>";
						echo "<td class='myProfiletd'>Rs. ".$row['price']."</td>";
						echo "<td class='myProfiletd'><a href='updateCattle.php?id={$row['id']}'><button class='updatebtn'>Update</button></a> </td>";
						echo "<td class='myProfiletd'><input type='button' class='removebtn' value='Remove' onclick='delCattle({$row['id']})'> </td></tr>";						
							
					}
					echo "</table>";
				}
				mysqli_close($conn);
			} ?>
	</div>
	<hr>
	<h2>You bought</h2>
		<div style="background-color: #E2F082;">
		<?php 
		$userName = $_SESSION['userName'];
		$conn = mysqli_connect('localhost','root',"",'cattlesales');
		if(!$conn) die("connection failed");
		else{
			$sql = "SELECT * FROM seller where soldStatus='s' and buyer='$userName' ";
			$result = mysqli_query($conn,$sql);
				if(mysqli_num_rows($result) == 0)
					echo "No purchase done";
				else{
					echo "<table class='myProfiletable' align='center' cellpadding=10px>
							<tr class='myProfiletr' ><th class='myProfileth' width=300>Image</th>
								<th class='myProfileth' width=200>Type</th>
								<th class='myProfileth' width=200>Price</th>
								<th class='myProfileth' width=100></th>
								<th class='myProfileth' width=100></th></tr>";
					while($row = mysqli_fetch_assoc($result)){
						
						echo "<tr class='myProfiletr'><td class='myProfiletd'><div class='soldImage'><img src='data:image;base64, {$row["image"]} 'alt='img' width='100' height='100'></div></td> ";
						echo "<td class='myProfiletd'>Cattle type: ".$row['cattleType']."</td>";
						echo "<td class='myProfiletd'>Rs. ".$row['price']."</td>";
						echo "<td class='myProfiletd'></td>";
						echo "<td class='myProfiletd'></td></tr>";						
							
					}
					echo "</table>";
				}
				mysqli_close($conn);
			} ?>
	</div>
	<h2>Your pets for adoption</h2>
		<div style="background-color: #D3F7A4;">
		<?php 
		$userName = $_SESSION['userName'];
		$conn = mysqli_connect('localhost','root',"",'cattlesales');
		if(!$conn) die("connection failed");
		else{
			$sql = "SELECT * FROM pets where adoptionStatus='n' and userName='$userName' ";
			$result = mysqli_query($conn,$sql);
				if(mysqli_num_rows($result) == 0)
					echo "No pet for adoption";
				else{
					echo "<table class='myProfiletable' align='center' cellpadding=10px>
							<tr class='myProfiletr' ><th width=300>Image</th>
								<th width=200>Type</th>
								<th width=200></th>
								<th width=100></th>
								<th width=100></th></tr>";
					while($row = mysqli_fetch_assoc($result)){
						
						echo "<tr class='myProfiletr'><td class='myProfiletd'><div class='soldImage'><img src='data:image;base64, {$row["image"]} 'alt='img' width='100' height='100'></div></td> ";
						echo "<td class='myProfiletd'>Cattle type: ".$row['petType']."</td>";
						echo "<td class='myProfiletd'></td>";
						echo "<td class='myProfiletd'><a href='updatePets.php?id={$row['id']}'><button class='updatebtn'>Update</button></a> </td>";
						echo "<td class='myProfiletd'><input type='button' class='removebtn' value='Remove' onclick='delPets({$row['id']})'> </td></tr>";						
							
					}
					echo "</table>";
				}
				mysqli_close($conn);
			} ?>
	</div>

<h2>You adopted</h2>
		<div style="background-color: #E2F082;">
		<?php 
		$userName = $_SESSION['userName'];
		$conn = mysqli_connect('localhost','root',"",'cattlesales');
		if(!$conn) die("connection failed");
		else{
			$sql = "SELECT * FROM pets where adoptionStatus='y' and adoptedBy='$userName' ";
			$result = mysqli_query($conn,$sql);
				if(mysqli_num_rows($result) == 0)
					echo "Not adopted yet.";
				else{
					echo "<table class='myProfiletable' align='center' cellpadding=10px>
							<tr class='myProfiletr' ><th width=300>Image</th>
								<th width=200>Type</th>
								<th width=200></th>
								<th width=100></th>
								<th width=100></th></tr>";
					while($row = mysqli_fetch_assoc($result)){
						
						echo "<tr class='myProfiletr'><td class='myProfiletd'><div class='soldImage'><img src='data:image;base64, {$row["image"]} 'alt='img' width='100' height='100'></div></td> ";
						echo "<td class='myProfiletd'>Pet type: ".$row['petType']."</td>";
						echo "<td class='myProfiletd'></td>";
						echo "<td class='myProfiletd'></td>";
						echo "<td class='myProfiletd'></td></tr>";						
							
					}
					echo "</table>";
				}
				mysqli_close($conn);
			} ?>
	</div>

</body>
	<?php include_once('footer.php');?>
	<script>
		function delCattle(delId){
			if(confirm("Do you want to remove the cattle from sale ?")){
				window.location.href='deleteCattle.php?del_id=' +delId+'';
				return true;
			}
		}
	</script>

	<script>
		function delPets(delId){
			if(confirm("Do you want to remove the pet from adoption list ?")){
				window.location.href='deletePets.php?del_id=' +delId+'';
				return true;
			}
		}
	</script>

</html>