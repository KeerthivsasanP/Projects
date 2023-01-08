<html>
<head>
    <link rel="stylesheet" type="text/css" href="header.css">
</head>
<body>
    
    <table width="100%" id="headerTable">
        <tr align="center">
            <td rowspan="2" class="tdHeader"><a href="home.php"><img src="images/home.png" id="home" width="50px" height="50px"></td>
            <td rowspan="2" class="tdHeader"><img id="logo" src="images/logo.jpg" width="60px" height="60px"></td>
            <td align="center" class="tdHeader"><p align="center" id="header"><b>Online cattle sales</b></p>
            </td>
             <td rowspan="2" class="tdHeader"><img id="logo" src="images/logo.jpg" width="60px" height="60px"></td>
            <td rowspan="2" class="tdHeader">
            <form method="post">
                <input type="submit" name="signout" id="signoutbtn" value="Signout">
            </form>
            </td>
        </tr>
        <tr align="center">
            <td><p align="center" id="subTitle" class="tdHeader"><b>Find the cattle you need</b></p></td>
        </tr>
    </table>

    <div id="menu">
        <a  <?php if($_SESSION['userName']=="") echo "href='signin.php'"; else echo "href=myprofile.php" ?>><button class="headerButton">My profile</button></a>
        <a <?php if($_SESSION['userName']=="") echo "href='signin.php'"; else echo "href=seller.php" ?>><button class="headerButton">Sell my cattle</button></a> 
       <a <?php if($_SESSION['userName']=="") echo "href='signin.php'"; else echo "href=pets.php" ?>><button class="headerButton">Adopt</button></a>
        <a <?php if($_SESSION['userName']=="") echo "href='signin.php'"; else echo "href=foodAndAcc.php" ?>><button class="headerButton">Food and accessories</button></a>
        <a href="faqs.php"><button class="headerButton">FAQs</button></a>
        <a  <?php if($_SESSION['userName']=="") echo "href='signin.php'"; else echo "href=caretaker.php" ?>><button class="headerButton">Caretaker</button></a>
    </div>
</body>
    <?php 
        if(isset($_POST['signout'])){
            session_destroy();
            echo "<script>
                    window.location = 'signin.php';
                </script>";
        }
     ?>
</html>