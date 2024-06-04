<?php
session_start();
if(!empty($_SESSION['user'])){
    header('location:player.php');
}
include("db.php");
if(isset($_POST["login"])){
    $email = $_POST["email"];
    $pass= $_POST["pass"];
    $sql = mysqli_query($conn,"SELECT * FROM user WHERE email='$email' AND password='$pass'");
    if(mysqli_num_rows($sql) >0){
        $row = mysqli_fetch_array($sql);
        $_SESSION['user']= $row['email'];
        header('location:player.php');
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
   background-color: #e9ecef;
  padding: 10px 20px;
  text-align: center;
  color: black;
  margin-top:135px;
}

    </style>
    </style>
</head>
<body>
    <div class="hed">
        <a href="index.php">IGITEGO FOOTBAL CLUB (FC)</a>
    </div>
    <div class="nav">
        <a href="index.php">HOME</a>    
        <a href="login.php">LOG IN</a>
        <a href="index.php">CREATE ACCOUNT</a>
    </div>
    <center>
    <div class="main"><br><br>
        <fieldset>
            <center><form action="" method="post">
            <h3>LOG IN HERE</h3>
                <label for="">Email</label>
                <input type="email" name="email" id="">
                <label for="">Password</label>
                <input type="password" name="pass">
               <center> <br><button type="submit" name="login">LOG IN</button></center>
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