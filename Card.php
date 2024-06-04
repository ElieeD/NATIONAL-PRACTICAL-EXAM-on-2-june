<?php
session_start();
if(empty($_SESSION['user'])){
    header('location:login.php');
}
$update=true;
$date1=$date2=$salary='';
include("db.php");
if(isset($_POST["card"])){
    $card=$_POST['cardi'];
    $player=$_POST['player'];
    $match=$_POST['match'];
    $date1=$_POST['date1'];
    $date2=$_POST['date2'];
    
    $sql=mysqli_query($conn,"INSERT INTO `cards`(`cardid`, `cardname`, `playerid`, `match_id`, `issue_date`, `expriy_date`) VALUES 
    ('','$card','$player','$match','$date1','$date2')");
}
if(isset($_GET['update'])){
    $update=false;
    $id=$_GET['update'];
    $sql=mysqli_query($conn,"SELECT * FROM player INNER JOIN contract ON player.playerid=contract.playerid WHERE contra_id='$id'");
    $fetch=mysqli_fetch_array($sql);
    
    if(isset($_POST['cardu'])){
        $card=$_POST['cardi'];
      $player=$_POST['player'];
      $match=$_POST['match'];
      $date1=$_POST['date1'];
      $date2=$_POST['date2'];
        $sql=mysqli_query($conn,"UPDATE `cards` SET
         `cardname`='$card',`playerid`='$player',`match_id`='$match',
         `issue_date`='$date1',`expriy_date`='$date2' WHERE `cardid`='$id' ");
        if($sql==true){
            header('location:Card.php');
        }

    }
    
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
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
    <div class="mai">
        <div class="form">
            <fieldset>
                <h3>Contract Registration</h3>
                <form action="" method="post">
                <label for="">Card Name</label>
                <select name="cardi" id="">
                    <option value="">Select Card</option>
                    <option value="RED">RED</option>
                    <option value="YELLOW">YELLOW</option>
                </select>
                  
                <label for="">Select Player</label>
                <select name="player" id="">
                    <option value="">Select Player</option>
                    <?php
                    $f=mysqli_query($conn,"SELECT * FROM player");      
                    while($row=mysqli_fetch_array($f)){
                        ?>
                        <option value="<?php echo $row[0]; ?>"><?php echo $row[1].' '.$row[2]; ?></option>
                        <?php
                    }
         
                    ?>
                </select>

                <label for="">Select Match</label>
                <select name="match" id="">
                    <option value="">Select Player</option>
                    <?php
                    $f=mysqli_query($conn,"SELECT * FROM stadium INNER JOIN matches ON matches.stadiumid=stadium.stadiumid ");      
                    while($row=mysqli_fetch_array($f)){
                        ?>
                        <option value="<?php echo $row[2]; ?>"><?php echo $row[4].' '.$row[1]; ?></option>
                        <?php
                    }
         
                    ?>
                </select>
                



                <label for="">Issue Date</label>
                <input type="date" name="date1" id="" value="<?php echo $date1; ?>">
                <label for="">Expiry Date</label>
                <input type="date" name="date2" id="" value="<?php echo $date2; ?>">

                <?php if($update==true): ?>
                <center> <br><button type="submit" name="card">SAVE</button></center>
                <?php else: ?>
                    <center> <br><button type="submit" name="cardu">Update</button></center>
                <?php endif; ?>    
                </form>
            </fieldset>
        </div>
        <div class="table">
            <table>
                <tr>
                    <th colspan="9">EXISTING PALYERS</th>
                </tr>
                <tr>
                    <th>No</th>
                    <th>PLAYER NAME</th>
                    <th>STADIUM</th>
                    <th>CARD GIVEN</th>
                    <th>ISSUE DATE</th>
                    <th>EXPIRY DATE</th>
                    <th>ACTION</th>
                </tr>
                <?php
                $no=1;
                $sql=mysqli_query($conn,"SELECT * FROM cards INNER JOIN stadium ON
                 cards.match_id=stadium.stadiumid INNER JOIN player ON cards.playerid=player.playerid");
                while($row=mysqli_fetch_array($sql)){
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $row[9].' '.$row[10]; ?></td>
                        <td><?php echo $row[7]; ?></td>
                        <td><?php echo $row[1]; ?></td>
                        <td><?php echo $row[4]; ?></td>
                        <td><?php echo $row[5]; ?></td>
                        <td>
                            <a href="?delete=<?php echo $row[0];?>" class='o'>DELETE</a>
                            |
                            <a href="?update=<?php echo $row[0];?>" class='oo'>UPDATE</a>
                        </td>

                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
    </div>
    <?php
    if(isset($_GET['delete'])){
        $id=$_GET['delete'];
        $sql=mysqli_query($conn,"DELETE FROM cards WHERE cardid='$id'");
        if($sql==true){
            header('location:card.php');
        }
    }

    ?>
    
</body>
</html>