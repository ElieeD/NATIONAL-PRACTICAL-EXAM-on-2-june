<?php
session_start();
if(empty($_SESSION['user'])){
    header('location:login.php');
}
$update=true;
$sta_name='';
include("db.php");
if(isset($_POST["sta"])){
    $sta_name=$_POST['sta_name'];
    $sql=mysqli_query($conn,"INSERT INTO `stadium`(`stadiumid`, `stadiumname`) VALUES ('','$sta_name')");
}
if(isset($_GET['update'])){
    $update=false;
    $id=$_GET['update'];
    $sql=mysqli_query($conn,"SELECT * FROM stadium WHERE stadiumid='$id'");
    $fetch=mysqli_fetch_array($sql);
    $sta_name=$fetch[1];
    if(isset($_POST['stap'])){
        $sta_name=$_POST['sta_name'];
        $sql=mysqli_query($conn,"UPDATE `stadium` SET `stadiumname`='$sta_name' WHERE `stadiumid`='$id'");
        if($sql==true){
            header('location:stadium.php');
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
                <h3>STADIUM</h3>
                <form action="" method="post">
                <label for="">Stadium Name</label>
                <input type="text" name="sta_name" value="<?php echo $sta_name; ?>">

                <?php if($update==true): ?>
                <center> <br><button type="submit" name="sta">SAVE</button></center>
                <?php else: ?>
                    <center> <br><button type="submit" name="stap">Update Stadium</button></center>
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
                    <th>STADIUM NAME</th>
                    <th>ACTION</th>
                </tr>
                <?php
                $no=1;
                $sql=mysqli_query($conn,"SELECT * FROM `stadium`");
                while($row=mysqli_fetch_array($sql)){
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $row[1]; ?></td>
    
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
        $sql=mysqli_query($conn,"DELETE FROM stadium WHERE stadiumid='$id'");
        if($sql==true){
            header('location:stadium.php');
        }
    }

    ?>
    
</body>
</html>