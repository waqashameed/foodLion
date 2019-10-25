<?php
    require_once "security.php";
    require_once "db.php";
    require_once "dbRecord.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Print Receipt</title>
</head>
<body onload="window.print();">
<?php
    $items= "";
    $comments="";
    if (isset($_POST['print'])) {
        $items = $_POST['items']; 
        $comments = $_POST['comment']; 

        $queryUsersRecord = "INSERT INTO userrecord (items, comments) VALUES ('".$items."','".$comments."')";
        mysqli_query($connection, $queryUsersRecord);
        /*
        $queryUsersRecord = "INSERT INTO users_record (item, comment, userid) VALUES ('".$items."','".$comments."', ".$_SESSION['id'].")";
        mysqli_query($conn, $queryUsersRecord);
        */

        //The prev_order table maintains in this block.

        //To check if the record exists or not
        $querySearchExistingUserDetails = "SELECT userid FROM prev_order WHERE userid=".$_SESSION['id'];
        
        $resultQSEUD = mysqli_query($conn, $querySearchExistingUserDetails);
        
        if (mysqli_num_rows($resultQSEUD) > 0) {
            //If the user's data exist then the record will be updated.
            $queryUpdateRecord = "UPDATE prev_order SET items='".$items."', comments='".$comments."' WHERE userid=".$_SESSION['id'];
            
            
            mysqli_query($conn, $queryUpdateRecord);
        } 
        else {
            //If the user is new.
            //To add data in database as previous record if no previous data is available
            $queryAddRecord = "INSERT INTO prev_order (items, comments, userid) VALUES ('".$items."','".$comments."', ".$_SESSION['id'].")";
            
            
            mysqli_query($conn, $queryAddRecord);
            
        }

        


        


        $query = "SELECT firstname, lastname, email, phonenumber, zip FROM users WHERE id=".$_SESSION['id'];
        $results=mysqli_query($conn, $query);
        if (mysqli_num_rows($results) == 1) {
                $rows=mysqli_fetch_assoc($results);
                
        }
    }
    if (count($rows)>0) {
    ?>
    <table style="width: 400px;" border="black" cellpadding="2" cellspacing="0">
        <thead>
            <th>&nbsp;</th>
            <th>Contents</th>
        </thead>
        <tr>
            <td>First Name</td>
            <td><?= $rows['firstname']?></td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td><?= $rows['lastname']?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><?= $rows['email']?></td>
        </tr>
        <tr>
            <td>Phone Number</td>
            <td><?= $rows['phonenumber']?></td>
        </tr>
        <tr>
            <td>Zip</td>
            <td><?= $rows['zip']?></td>
        </tr>
        <tr>
            <td>Items list</td>
            <?php

            //str_replace(search, replace, subject)
               // $items = str_replace(array("\n","\r"),"",$items);
            ?>
            <td><?php echo nl2br($items);?></td>
        </tr>
        <tr>
            <td>Pickup Time</td>
            <td><?php echo date("h:i a");?></td>
        </tr>
        <tr>
            <td>Date</td>
            <td><?php echo date("d-m-Y"); ?></td>
        </tr>
        <tr>
            <td>Comments</td>
            <td><?= $comments?></td>
        </tr>
    </table>
    <?php
    }
    ?>
</body>
</html>