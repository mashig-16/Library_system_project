<?php
include "connection.php";
 include "navbar.php";
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Login</title>
    
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-widt, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style type="text/css">
    section
    {
        margin-top: -20px;
    }
    </style>
</head>
<body>  

    <section>
        <div class="log_img">   <!--STAR log_img class-->
            <br><br>
            <div class="box1">  <!--STAR box1 class-->
                <br>
                <h1 style="text-align: center; font-size: 35px; font-family: Lucida console;">Library Management System</h1>
            
                <h1 style="text-align: center; font-size: 25px;">User Login Form</h1><br>
                <form name="login" action="" method="post">     <!--STAR login form-->
            
                    <div class="login"> <!--STAR login class-->
                      <input class="form-control" type="text" name="username" placeholder="User Name" required="" >
                      <br>
                    <input class="form-control" type="password" name="password" placeholder="password" required="">
                    <br>
                    <input class="btn btn-default" type="submit" name="submit" value="Login" 
                    style="color: black; width: 60px ; height: 33px;">
                    
                    

                </div>  <!--END login class-->
                
                <p style="color: white; padding-left: 15px;"> 
                    <br>
                    <a style="color: yellow; text-decoration: none" href="update_password.php">Forgot password?</a> &nbsp &nbsp &nbsp   
                    new to this website? <a style="color: white;" href="registration.php">sign up</a>
                </p>
            </form>     <!--END login class-->
            </div>  <!--END box1 class-->
        </div>      <!--END log_img class-->
    </section>

    <?php

    if(isset($_POST['submit']))
    {
        $count=0;
        $res=mysqli_query($db,"SELECT * FROM `admin` 
        WHERE username = '$_POST[username]' && password='$_POST[password]';");

        $row=mysqli_fetch_assoc($res);

    $count=mysqli_num_rows($res);

    if($count==0)
    {
        ?>
                        <!-- 
                            <script type="text/javascript">
                            alert("The username and password doesn't match."); 
                            </script>
                            -->
    <br><br><br><br><br>                        
    <div class="alert alert-danger" style="width: 500px; margin-left: 450px; 
    background-color: #d84040; color: white">
        <strong>The username and password doesn't match</strong>
    </div>                        
        <?php
    }
    else
            /*------------- if username & password matches------*/
    {
       $_SESSION['login_user']=$_POST['username'];
       $_SESSION['pic']=$row['pic'];
       ?>
        <script type="text/javascript">
        window.location="index.php" 
        </script>
        <?php
    }
    }
    ?>

</body>
</html> 
