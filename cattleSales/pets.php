<html>
<head>
	<style>
		*{
			box-sizing: border-box;
		}
		.container{
			background-color: #EFCDB8;
			max-width: auto;
			margin: 0;
			overflow: auto;
			}
	.givePets,.adoptPets{
			text-align: center;
			padding: 200px 0px;
			float: left;
			margin: 5%;
			margin-top: 4%;
			width: 40%;
			height: 80%;
			font-size: 50px;
			color: white;
		}
		.adoptPets{
			background-image: url('images/givePets.jfif');
			background-repeat: no-repeat;
			background-size: cover;
		}
		.givePets{
			background-image: url('images/adoptPets.jfif');
			background-repeat: no-repeat;
			background-size: cover;
		}
	</style>
</head>
<body>
	<?php 
	session_start();
	include_once('header.php');
	 ?>
	<div class="container">
		<a href="adoptPets.php"><div class="givePets">
			I want a pet
		</div></a>
		<a href="givePets.php"><div class="adoptPets">
			I have a pet for adoption
		</div></a>
	</div>
</body>
	<?php include_once('footer.php'); ?>
</html>