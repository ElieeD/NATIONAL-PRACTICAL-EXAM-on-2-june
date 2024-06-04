<?php
session_start();
if(empty($_SESSION['user'])){
    header('location:login.php');
}
$update=true;
$fname=$lname='';
include("db.php");
if(isset($_POST["player"])){
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $sql=mysqli_query($conn,"INSERT INTO `player`(`playerid`, `player_firstname`, `player_lastname`) VALUES ('','$fname','$lname')");
}
if(isset($_GET['update'])){
    $update=false;
    $id=$_GET['update'];
    $sql=mysqli_query($conn,"SELECT * FROM player WHERE playerid='$id'");
    $fetch=mysqli_fetch_array($sql);
    $fname=$fetch[1];
    $lname=$fetch[2];
    if(isset($_POST['updatep'])){
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $sql=mysqli_query($conn,"UPDATE `player` SET `player_firstname`='$fname',`player_lastname`='$lname' WHERE `playerid`='$id'");
        if($sql==true){
            header('location:player.php');
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
                <h3>Register New Player</h3>
                <form action="" method="post">
                <label for="">First Name</label>
                <input type="text" name="fname" value="<?php echo $fname; ?>">
                <label for="">Last Name</label>
                <input type="text" name="lname" id="" value="<?php echo $lname; ?>">
                <?php if($update==true): ?>
                <center> <br><button type="submit" name="player">Register Player</button></center>
                <?php else: ?>
                    <center> <br><button type="submit" name="updatep">Update Player</button></center>
                <?php endif; ?>    
                </form>
            </fieldset>
        </div>
        <div class="table">
            <table>
                <tr>
                    <th colspan="5">EXISTING PALYERS</th>
                </tr>
                <tr>
                    <th>No</th>
                    <th>FIST NAME</th>
                    <th>LAST NAME</th>
                    <th>ACTION</th>
                </tr>
                <?php
                $no=1;
                $sql=mysqli_query($conn,"SELECT * FROM `player`");
                while($row=mysqli_fetch_array($sql)){
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $row[1]; ?></td>
                        <td><?php echo $row[2]; ?></td>
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
        $sql=mysqli_query($conn,"DELETE FROM player WHERE playerid='$id'");
        if($sql==true){
            header('location:player.php');
        }
    }

    ?>
    
</body>
</html>