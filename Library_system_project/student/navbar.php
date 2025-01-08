<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>

        <link rel="stylesheet" type="text/css" href="style.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-widt, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<body>
<nav class="navbar navbar-inverse">   <!--STAR navbar-inverse-->
        <div class="container-fluid">   <!--STAR container-fluid class-->
        <div class="navbar-header"> <!--STAR navbar-header class-->
            <a class="navbar-brand active">LIBRARY MANAGEMENT SYSTEM</a>
    </div> <!--END navbar-header class-->
           
    <ul class="nav navbar-nav">     <!--STAR nav navbar-nav ul-->
            <li><a href="index.php">HOME</a></li>
            <li><a href="books.php">BOOKS</a></li>
            <!--<li><a href="feedback.php">FEEDBACK</a></li> -->
            </ul>               <!--END nav navbar-nav ul-->
             
            <?php
                if(isset($_SESSION['login_user']))
                { 
                    ?>     
                <ul class="nav navbar-nav"> 
                <li><a href="profile.php">PROFILE</a></li>
                <li><a href="fine.php">FINE</a></li>
                
                </ul>
                <ul class="nav navbar-nav navbar-right">  
                <li><a href="">
                    <div style="color:white">
                      <?php
                       echo "<img class='img-circle profile_img' 
                       height=25 width=25 src='images/".$_SESSION['pic']."'>"; 
                    echo " ".$_SESSION['login_user'];
                    ?>  
                    </div>
                </a></li>
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"> LOGOUT</span></a></li>
                </ul>
                
               <?php
                }
                else
                {?>
                 <ul class="nav navbar-nav navbar-right">      <!--STAR navbar-right ul-->
                
                <li><a href="student_login.php"><span class="glyphicon glyphicon-log-in"> LOGIN </span></a></li>
                <li><a href="registration.php"><span class="glyphicon glyphicon-user"> SIGN UP </span></a></li>
            </ul>        <!--END navbar-right ul-->   
              <?php
                }
            ?>

        </div>      <!--END container-fluid class-->
        </nav>  <!--END navbar-inverse--> 
        <?php
  if(isset($_SESSION['login_user']))
  {
      $day=0;
    $exp='<p style="color:yellow; background-color:red;">EXPIRED</p>';
    $res=mysqli_query($db,"SELECT * FROM `isseu_book` 
     WHERE username='$_SESSION[login_user]' and approve='$exp';");
    while($row=mysqli_fetch_assoc($res))
   {
     $d=strtotime($row['returnd']);  
     $c=strtotime(date("y-m-d"));
     $diff=$c-$d;
     if($diff>=0)
     {
    $day= $day+floor($diff/(60*60*24));
        }//Days
        
     }
     $_SESSION['fine']=$day*.5;
     //echo $day;
            }
                ?>
</body>
</html>