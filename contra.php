<?php
session_start();
if(empty($_SESSION['user'])){
    header('location:login.php');
}
$update=true;
$date1=$date2=$salary='';
include("db.php");
if(isset($_POST["contra"])){
    $player=$_POST['player'];
    $date1=$_POST['date1'];
    $date2=$_POST['date2'];
    $salary=$_POST['salary'];
    $sql=mysqli_query($conn,"INSERT INTO `contract`(`contra_id`, `playerid`, `fromdate`, `expirydate`, `salary`) VALUES ('','$player','$date1','$date2','$salary')");
}
if(isset($_GET['update'])){
    $update=false;
    $id=$_GET['update'];
    $sql=mysqli_query($conn,"SELECT * FROM player INNER JOIN contract ON player.playerid=contract.playerid WHERE contra_id='$id'");
    $fetch=mysqli_fetch_array($sql);
    $date1=$fetch[5];
    $date2=$fetch[6];
    $salary=$fetch[7];
    if(isset($_POST['contrap'])){
        $player=$_POST['player'];
        $date1=$_POST['date1'];
       $date2=$_POST['date2'];
       $salary=$_POST['salary'];
        $sql=mysqli_query($conn,"UPDATE `contract` SET `playerid`='$player',
        `fromdate`='$date1',`expirydate`='$date2',`salary`='$salary' WHERE `contra_id`='$id'");
        if($sql==true){
            header('location:contra.php');
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
                



                <label for="">From Date</label>
                <input type="date" name="date1" id="" value="<?php echo $date1; ?>">
                <label for="">Expiry Date</label>
                <input type="date" name="date2" id="" value="<?php echo $date2; ?>">
                <label for="">Salary</label>
                <input type="text" name="salary" id="" value="<?php echo $salary; ?>">
                <?php if($update==true): ?>
                <center> <br><button type="submit" name="contra">SAVE</button></center>
                <?php else: ?>
                    <center> <br><button type="submit" name="contrap">Update</button></center>
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
                    <th>FIST NAME</th>
                    <th>LAST NAME</th>
                    <th>FROM DATE</th>
                    <th>EXPIRY DATE</th>
                    <th>SALARY</th>
                    <th>ACTION</th>
                </tr>
                <?php
                $no=1;
                $sql=mysqli_query($conn,"SELECT * FROM player INNER JOIN contract ON player.playerid=contract.playerid");
                while($row=mysqli_fetch_array($sql)){
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $row[1]; ?></td>
                        <td><?php echo $row[2]; ?></td>
                        <td><?php echo $row[5]; ?></td>
                        <td><?php echo $row[6]; ?></td>
                        <td><?php echo $row[7]; ?></td>
                        <td>
                            <a href="?delete=<?php echo $row[3];?>" class='o'>DELETE</a>
                            |
                            <a href="?update=<?php echo $row[3];?>" class='oo'>UPDATE</a>
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
        $sql=mysqli_query($conn,"DELETE FROM contract WHERE contra_id='$id'");
        if($sql==true){
            header('location:contra.php');
        }
    }

    ?>
    
</body>
</html>