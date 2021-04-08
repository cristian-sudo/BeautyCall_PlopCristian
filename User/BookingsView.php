<html>
    <head>
    </head>
    <body>
     <?php
     require('/Applications/XAMPP/xamppfiles/htdocs/EZCUT/User/UserMenu.php');


     $stmt1 = $dbh->getInstance()->prepare("SELECT BookingID FROM bookings
    WHERE bookings.UserID =:UserID");
         $stmt1->bindParam(':UserID', $UserID);
         $UserID = $_SESSION['UserID'];
         $stmt1->execute();
         while ($row = $stmt1->fetch()) {
             echo $row['BookingID'].'<br>';
         }
     ?>   
    </body>
</html>