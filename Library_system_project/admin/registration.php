<?php
include "connection.php";
include "navbar.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Registration</title>
    <title>Library Manegement Syste</title>
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
        <div class="reg_img">   <!--STAR reg_img class-->
            <div class="box2">  <!--STAR box2 class-->
                
                <h1 style="text-align: center; font-size: 35px; font-family: Lucida console;">
                    Library Management System</h1>
                <h1 style="text-align: center; font-size: 23px;">
                    User Registration Form</h1>
               
                <form name="Registration" action="" method="post">
                
                    <div class="login"> <!--STAR login class-->
                        <input class="form-control" type="text" name="first" placeholder="First Name" required="">
                        <br>
                        <input class="form-control" type="text" name="last" placeholder="Last Name" required="">
                        <br>
                        <input class="form-control" type="text" name="username" 
                        placeholder="User Name" required="" >
                        <br>
                        <input class="form-control" type="password" name="password" 
                        placeholder="password" required="">
                        <br>
                        <input class="form-control" type="text" name="email" placeholder="Email" required="">
                        <br>
                        <input class="form-control" type="text" name="contact" placeholder="Phone NO" required="">
                        <br>

                        <input class="btn btn-default" type="submit" name="submit" value="Sign Up" 
                        style="color: black; width: 75px ; height: 35px;">
                </div>  <!--END login class-->
                </form>
            </div>  <!--END box2 class-->
        </div>      <!--END reg_img class-->
    </section>

    <?php

     if(isset($_POST['submit']))
     {
            $count=0;
            $sql="SELECT username from `admin`";
            $res=mysqli_query($db,$sql);

            while($row=mysqli_fetch_assoc($res))
            {
               if($row['username']==$_POST['username'])
               {
                   $count=$count+1;
               } 
            }
          if($count==0)
          {

         mysqli_query($db,"INSERT INTO `admin`
         VALUES('','$_POST[first]','$_POST[last]','$_POST[username]','$_POST[password]',
         '$_POST[email]','$_POST[contact]','pro.jpg');");

     ?>
    
    <script type="text/javascript">
        alert("Registration successful")
    </script>

     <?php    
          }
          else
          {
              ?>
            <script type="text/javascript">
            alert("The username already exist.");
            </script>
            <?php
          }

     }
?>
