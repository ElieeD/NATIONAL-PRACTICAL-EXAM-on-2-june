<?php
include('db.php');
if(isset($_POST['generate'])){
    $date=$_POST['date'];
}
if(empty($date)){
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
                <th>Player Name</th>
                <th>CARD NAME</th>
                <th>ISSUE DATE</th>
                <th>EXPIRY DATE</th>
            </tr>
            <?php
            $no=1;
            $sql=mysqli_query($conn,"SELECT * FROM player LEFT JOIN cards ON 
            cards.playerid=player.playerid  WHERE cards.cardname NOT IN('RED') AND cards.expriy_date <'$date'
           ");
            while ($row=mysqli_fetch_array($sql)){?>
                 <tr>
                    <td> <?php echo $no ++; ?></td>
                    <td> <?php echo $row[1].' ' .$row[2]; ?></td>
                    <td> <?php echo $row[4]; ?></td>
                    <td> <?php echo $row[7]; ?></td>
                    <td> <?php echo $row[8]; ?></td>

                 </tr>

            <?php
                
            }


             ?>
        </table>

    </center>
    
</body>
</html>