<?php
include('db.php');
session_start();
if(empty($_SESSION['user'])){
    header('location:login.php');
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
    <style>
      
      .all{
        display:flex;
      }
    </style>
</head>
<body>
<div class="hed">
        <a href="index.php">IGITEGO FOOTBAL CLUB (FC)</a>
    </div>
    <div class="nav">
        <a href="player.php">PLAYERS</a>
        <a href="contra.php">CONTRACTS</a>
        <a href="stadium.php">STADIUM</a>
        <a href="Match.php">MATCHES</a>
        <a href="Card.php">CARDS</a>
        <a href="form.php">REPORT</a>
    </div>
    <div class="lo">
        <a href="logout.php">LOG OUT</a>
    </div>
    <div class="all">
    <center>
    <div class="mai">
        <div class="form">
            <fieldset>
                <h3>GENEARTE REPORT</h3>
                <form action="report.php" method="post" target="_black">
             
                <label for="">DATE</label>
                <input type="date" name="date" id="" value="" required>
                
                <p> 
                    NOTE: Here You select Players who don't have 3 unexpired yellow  cards <br>
                    And One unexpired red  cards
                </p>

                
                <center> <br><button type="submit" name="generate">GENERATE</button></center>
               
                     
                </form>
            </fieldset>
        </div>
        </center>
        <center>
    <div class="mai1">
        <div class="form">
            <fieldset>
                <h3>GENEARTE REPORT</h3>
                <h6>(BASING ON RANGE OF DATES)</h6>
                <form action="report1.php" method="post" target="_black">

                <label for="">FROM</label>
                <input type="date" name="date1" id="" value="" required>
                <label for="">TO</label>    
                <input type="date" name="date2" id="" value="" required>
                
                <p> 
                    NOTE: Here You Generate a Report by Specific Range of Time
                </p>

                
                <center> <br><button type="submit" name="generate1">GENERATE</button></center>
               
                     
                </form>
            </fieldset>
        </div>
        </center>

        </div>
      
      
         
                
         
    
</body>
</html>