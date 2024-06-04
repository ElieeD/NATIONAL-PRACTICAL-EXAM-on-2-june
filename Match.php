<?php
session_start();
if(empty($_SESSION['user'])){
    header('location:login.php');
}
$update=true;
$match='';
include("db.php");
if(isset($_POST["matche"])){
    $match=$_POST['stade'];
    $date=$_POST['date'];
    $sql=mysqli_query($conn,"INSERT INTO `matches`(`match_id`, `stadiumid`, `matchdate`) VALUES ('','$match','$date')");
}
if(isset($_GET['update'])){
    $update=false;
    $id=$_GET['update'];
    $sql=mysqli_query($conn,"SELECT * FROM stadium INNER JOIN matches ON stadium.stadiumid=matches.stadiumid");
    $fetch=mysqli_fetch_array($sql);
    $match=$fetch[4];
    if(isset($_POST['matchu'])){
        $match=$_POST['stade'];
        $date=$_POST['date'];
        $sql=mysqli_query($conn,"UPDATE `matches` SET `stadiumid`='$match',`matchdate`='$date' WHERE `match_id`='$id' ");
        if($sql==true){
            header('location:Match.php');
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
                <label for="">Select Stadium</label>
                <select name="stade" id="">
                    <option value="">Select Player</option>
                    <?php
                    $f=mysqli_query($conn,"SELECT * FROM stadium");      
                    while($row=mysqli_fetch_array($f)){
                        ?>
                        <option value="<?php echo $row[0]; ?>"><?php echo $row[1];?></option>
                        <?php
                    }
         
                    ?>
                </select>
                



                <label for="">Match Date</label>
                <input type="date" name="date" id="" value="<?php echo $match; ?>">
                <?php if($update==true): ?>
                <center> <br><button type="submit" name="matche">SAVE</button></center>
                <?php else: ?>
                    <center> <br><button type="submit" name="matchu">Update</button></center>
                <?php endif; ?>    
                </form>
            </fieldset>
        </div>
        <div class="table">
            <table>
                <tr>
                    <th colspan="9">MATCHES</th>
                </tr>
                <tr>
                    <th>No</th>
                    <th>STADIUM NAME</th>
                    <th>DATE</th>
                    <th>ACTION</th>
                </tr>
                <?php
                $no=1;
                $sql=mysqli_query($conn,"SELECT * FROM stadium INNER JOIN matches ON stadium.stadiumid=matches.stadiumid");
                while($row=mysqli_fetch_array($sql)){
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $row[1]; ?></td>
                        <td><?php echo $row[4]; ?></td>
                        <td>
                            <a href="?delete=<?php echo $row[2];?>" class='o'>DELETE</a>
                            |
                            <a href="?update=<?php echo $row[2];?>" class='oo'>UPDATE</a>
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
        $sql=mysqli_query($conn,"DELETE FROM matches WHERE match_id='$id'");
        if($sql==true){
            header('location:Match.php');
        }
    }

    ?>
    
</body>
</html>