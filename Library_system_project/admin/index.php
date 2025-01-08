<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Library Manegement Syste</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-widt, initial-scale=1">

    <style type="text/css">
        nav{
            float: right;
            word-spacing: 30px;
            padding: 20px;
        }
        nav li{
            display: inline-block;
            line-height: 80px;
        }
    </style>

</head>

<body>
    <div class="wrapper"> <!--STAR wrapper class-->
        <header>
            <div class="logo"> <!--STAR logo class-->
                <img src="images/logo.jpg" alt="" width="120" height="100">
                <h1 style="color: white;">LIBRARY MANAGEMENT SYSTEM</h1> 
        </div> <!--END logo class-->
         
        <?php
        if(isset($_SESSION['login_user']))
        {?>
            <nav>
            <ul>
                <li><a href="index.php">HOME</a></li>
                <li><a href="books.php">BOOKS</a></li>
                <li><a href="logout.php">LOGOUT</a></li>
                <!--<li><a href="feedback.php">FEEDBACK</a></li>-->
            </ul>
            </nav>
            <?php
        }
    else
    {?>
    <nav>
                <ul>
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="books.php">BOOKS</a></li>
                    <li><a href="admin_login.php">LOGIN</a></li>
                   <!-- <li><a href="feedback.php">FEEDBACK</a></li>-->
                </ul>
            </nav>
    <?php    
    }

    ?>

            
        </header> 
        <section>
            <div class="sec_img">   <!--STAR sec_img class-->
         <br><br><br>
            <div class="box">       <!--STAR box class-->
                <br><br><br>
                <h1 style="text-align: center; font-size: 35px;">Welcom to Library</h1><br>
                <h1 style="text-align: center; font-size: 25px;">Opens at:09.00</h1><br>
                <h1 style="text-align: center; font-size: 25px;">Closes at:15.00</h1><br>
            </div>      <!--END box class-->
        </div>      <!--END sec_img class-->
        </section>
        <footer>
            <p style="color: white; text-align: center;">
                <br>
                Email:&nbsp tech.library@gmail.com <br><br>
                Mobile:&nbsp &nbsp +94372238400
            </p>
        </footer>
    </div>              <!--END bgimage-->
</body>
</html> 