<?php
include "connection.php";
include "navbar.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Book Request</title>

    <meta name="viewport" content="width=device-width, 
    initial-scale=1">

    <style type="text/css">
    .srch
    {
        padding-left:900px;
    }
    .form-control
    {
      width: 300px;
      height:30px;
      background-color: black;
      color:white;
    }

    body {
      background-image:url("images/req.jpg");
      background-repeat: no-repeat;
    background-size: 1550px 750px;
  font-family: "Lato", sans-serif;
  transition: background-color .5s;
}

.sidenav {
  height: 100%;
  margin-top:50px;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #222;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

#main {
  transition: margin-left .5s;
  padding-left: 10px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
.img-circle
{
  margin-left: 20px;
}
.h:hover
{
  color:white;
  width: 300px;
  height: 50px;
  background-color: #00544c;
}
.container
{
  height: 700px;
  width: 85%;
  background-color: black;
  opacity:.8;
  color:white;
  margin-top: -55px;
}
.scroll
{
    width: 100%;
    height: 350px;
    overflow: auto;
}
th,td
{
    width: 10%; 
}
    </style>

</head>

<body>
    <!--___________________________ sidenav________________-->

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

  <div style="color: white; margin-left: 60px; font-size: 20px;">
   
   <?php 
   if(isset($_SESSION['login_user']))
    { echo "<img class='img-circle profile_img' height=120 width=120 src='images/".$_SESSION['pic']."'> ";  
    echo "</br></br>";
    echo "Welcome ".$_SESSION['login_user'];
   }
     ?>
     </div><br><br>  
    <div class="h"> <a href="add.php">Add Books</a> </div>
    <div class="h"> <a href="request.php">Book Request</a> </div>
    <div class="h"> <a href="issue_info.php">Issue Information</a> </div>
    <div class="h"> <a href="expired.php">Expired List </a> </div>

</div>

<div id="main"> 
  <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>

<script>
function openNav() 
{
  document.getElementById("mySidenav").style.width = "300px";
  document.getElementById("main").style.marginLeft = "300px";
  document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() 
{
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
  document.body.style.backgroundColor = "white";
} 

</script>


<div class="container">
  
<?php
if(isset($_SESSION['login_user']))
{
  ?>
  <div style="float: left; padding: 25px;"> 
  <form action="" method="post">
  <button name="submit2" type="submit" class="btn btn-default" style="background-color: #06861a; color: yellow;">RETURNED</button>&nbsp&nbsp
  <button name="submit3" type="submit" class="btn btn-default" style="background-color: red; color: yellow;">EXPIRED</button>
</form>
</div>


      <div class="srch"><br>
          <form method="post" action="" name="form1">
            <input type="text" name="username" class="form-control"
            placeholder="Username" required=""><br>
            <input type="text" name="bid" class="form-control"
            placeholder="Book ID" required=""><br>
            <button class="btn btn-default" name="submit" type="submit">Submit  </button>
          </form><br>
      </div>
  <?php
  if(isset($_POST['submit']))
  {
    $res=mysqli_query($db,"SELECT * FROM `isseu_book` 
    WHERE username='$_POST[username]' AND bid='$_POST[bid]'; ");
    while($row=mysqli_fetch_assoc($res))
    {
      $d= strtotime($row['returnd']);
      $c= strtotime(date("y-m-d"));
      $diff= $c-$d;
  
      if($diff>=0)
      {
        $day=floor($diff/(60*60*24));
        $fine=$day*5;
      }
    }

    $x=date("y-m-d");
   mysqli_query($db,"INSERT INTO `fine` 
    value ('$_POST[username]','$_POST[bid]','$x','$day','$fine','paid');");
    $var1='<p style="color:yellow; background-color:green;">RETURNED</p>';
    
    mysqli_query($db,"UPDATE isseu_book SET approve='$var1' 
    WHERE username='$_POST[username]' and bid='$_POST[bid]'");
  }
}
?>
<h3 style="text-align: center;">Date expired list</h3></br>
<?php
$c=0;
    if(isset($_SESSION['login_user']))
{
  $ret='<p style="color:yellow; background-color:green;">RETURNED</p>';
  $exp='<p style="color:yellow; background-color:red;">EXPIRED</p>';

if(isset($_POST['submit2']))
{
  $sql="SELECT student.username,roll,books.bid,
  name,authors,edition,approve,issue,isseu_book.returnd FROM student 
  INNER JOIN isseu_book ON student.username=isseu_book.username 
  INNER JOIN books ON isseu_book.bid=books.bid 
  WHERE isseu_book.approve ='$ret' ORDER BY `isseu_book`.`returnd` DESC";
  $res=mysqli_query($db,$sql);
}
else if(isset($_POST['submit3']))
{
  $sql="SELECT student.username,roll,books.bid,
    name,authors,edition,approve,issue,isseu_book.returnd FROM student 
    INNER JOIN isseu_book ON student.username=isseu_book.username 
    INNER JOIN books ON isseu_book.bid=books.bid 
    WHERE isseu_book.approve ='$exp' ORDER BY `isseu_book`.`returnd` DESC";
    $res=mysqli_query($db,$sql);
}
else
{
  $sql="SELECT student.username,roll,books.bid,
  name,authors,edition,approve,issue,isseu_book.returnd FROM student 
  INNER JOIN isseu_book ON student.username=isseu_book.username 
  INNER JOIN books ON isseu_book.bid=books.bid 
  WHERE isseu_book.approve !='' and isseu_book.approve !='yes' 
  ORDER BY `isseu_book`.`returnd` DESC";
  $res=mysqli_query($db,$sql);
}
     echo "<table class='table table-bordered'>";
     echo "<tr style='background-color:#89c6cb; '>";
          //Table header
             
              echo "<th>"; echo "Username"; echo "</th>";
              echo "<th>"; echo "Student ID"; echo "</th>";
              echo "<th>"; echo "Book ID"; echo "</th>";
              echo "<th>"; echo "Book Name"; echo "</th>";
              echo "<th>"; echo "Author Name"; echo "</th>";
              echo "<th>"; echo "Edition"; echo "</th>";
              echo "<th>"; echo "Status"; echo "</th>";
              echo "<th>"; echo "Issue Date"; echo "</th>";
              echo "<th>"; echo "Return Date"; echo "</th>";
      echo "</tr>";
      echo "</table>";
      echo "<div class='scroll'>"; 
      echo "<table class='table table-bordered'>";
      while($row=mysqli_fetch_assoc($res))
      {  
         
        echo "<tr>";
          echo "<td>"; echo $row['username']; echo "</td>";
          echo "<td>"; echo $row['roll']; echo "</td>";
          echo "<td>"; echo $row['bid']; echo "</td>";
          echo "<td>"; echo $row['name']; echo "</td>";
          echo "<td>"; echo $row['authors']; echo "</td>";
          echo "<td>"; echo $row['edition']; echo "</td>";
          echo "<td>"; echo $row['approve']; echo "</td>";
          echo "<td>"; echo $row['issue']; echo "</td>";
          echo "<td>"; echo $row['returnd']; echo "</td>";
          echo "</tr>";
      }
      
       echo "</table>";
       echo "</div>";
}
else
{
    ?>
<h3 style="text-align: center;">Login to see date expired list</h3>
    <?php
}
?>
    </div>
</div>
</body>
</html>