<?php
include('db.php');
if(isset($_POST['generate1'])){
    $date1=$_POST['date1'];
    $date2=$_POST['date2']; 
}
if(empty($date1) || empty($date2)){
    header('location:form.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table,tr,th,td{
            border: 2px solid;
            border-collapse: collapse;
        }
        table{
            height:50%;
            width:70%;
        }

        </style>
</head>
<body>
    <p>
        Kigali City <br>
        Gasabo District <br>
        Kinyinya Sector <br>
        P.BOX 317
    </p> <br><br>
    <p?>ON <?php echo date('d/m/y') ?></p>
    <center>
        <table>
            <tr>
                <th colspan="8">GENERAL REPORT</th>
            </tr>
            <tr>
                <th>No</th>
                <th>PLAYER NAME</th>
                <th>CONTRACT ID</th>
                <th>SIGNED CONTRACT DATE</th> 
                <th>CONTRACT EXPIRY DATE</th>
                <th>SALARY (USD)</th>
            </tr>
            <?php
            $no=1;
            $sql=mysqli_query($conn,"SELECT * FROM player INNER JOIN contract
             ON contract.playerid=player.playerid WHERE contract.fromdate BETWEEN '$date1' AND '$date2'");
            while ($row=mysqli_fetch_array($sql)){?>
                 <tr>
                    <td> <?php echo $no ++; ?></td>
                    <td> <?php echo $row[1].' ' .$row[2]; ?></td>
                    <td> <?php echo $row[3]; ?></td>
                    <td> <?php echo $row[5]; ?></td>
                    <td> <?php echo $row[6]; ?></td>
                    <td> <?php echo $row[7].' '. 'USD'; ?></td>

                 </tr>

            <?php
                
            }


             ?>
        </table>

    </center>
    
</body>
</html>