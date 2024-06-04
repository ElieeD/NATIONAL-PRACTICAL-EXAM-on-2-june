<?php
session_start();
if(!empty($_SESSION['user'])){
    header('location:player.php');
}
include("db.php");
if(isset($_POST["create"])){
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $pass= $_POST["pass"];
    $mysqli_qury = mysqli_query($conn,"INSERT INTO `user`(`userid`, `firstname`, `lastname`, `email`, `password`) VALUES 
    ('','$fname','$lname','$email','$pass')");
    if($mysqli_qury==true){
        header('location:login.php');
    }
    else{
        echo "<script>window.alert('Input Correct Credentials');</script>";
    }

}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}


.hed {
  background-color: #007bff; 
  color: white;
  padding: 10px 20px;
  text-align: center;
}

.hed a {
  color: white;
  text-decoration: none;
  font-weight: bold;
}


.nav {
  background-color: #e9ecef; 
  padding: 10px 20px;
  display: flex;
  justify-content: space-between; 
}

.nav a {
  color: black;
  text-decoration: none;
  padding: 5px 10px;
  border-radius: 5px;
}

.nav a:hover {
  background-color: #cccccc; 
}


.main {
  padding: 20px;
}

.main fieldset {
  border: 1px solid #cccccc; 
  padding: 20px;
  border-radius: 5px; 
  width: 40%;
}

.main legend { 
  font-weight: bold;
  padding-bottom: 10px;
}

.main label {
  display: block; 
  margin-bottom: 5px;
}

.main input[type="text"],
.main input[type="email"],
.main input[type="password"] {
  width: 70%;
  padding: 10px;
  border: 1px solid #cccccc; 
  border-radius: 3px; 
  border:1px solid;
}

.main button {
  background-color: #007bff; 
  color: white;
  padding: 10px 20px;
  border: none; 
  border-radius: 5px; 
  cursor: pointer;
}

.main button:hover {
  background-color: #0d6aad;
}


.foot {
bottom: 0;
   background-color: #e9ecef;
  padding: 10px 20px;
  text-align: center;
  color: black;
  margin-top:51px;
}

    </style>
</head>
<body>
    <div class="hed">
        <a href="index.php">IGITEGO FOOTBAL CLUB (FC)</a>
    </div>
    <div class="nav">
        <a href="index.php">HOME</a>
        <a href="login.php">LOG IN</a>
        <a href="">CREATE ACCOUNT</a>
    </div>
    <center>
    <div class="main">
        <fieldset>
            <center><form action="" method="post">
                <h3>CREATE YOUR ACCOUNT HERE</h3>
                <label for="">First Name</label>
                <input type="text" name="fname">
                <label for="">Last Name</label>
                <input type="text" name="lname" id="">
                <label for="">Email</label>
                <input type="email" name="email" id="">
                <label for="">Password</label>
                <input type="password" name="pass">
               <center> <br><button type="submit" name="create">CREATE ACCOUNT</button></center>
            </form>
            </center>
        </fieldset>
    </div>
    </center>
    <div class="foot">
        <p>All Right Reserved IGITEGO FC &copy; <?php echo date('Y'); ?></?php>
    </div>
</body>
</html>