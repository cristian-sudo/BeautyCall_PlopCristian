<?php
require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/header.php');
$stmt = $dbh->getInstance()->prepare("SELECT * FROM Users
         WHERE UserID =:UserID");
         $stmt->bindParam(':UserID', $UserID);
         $UserID = $_SESSION['UserID'];
         $stmt->execute();
         $row = $stmt->fetch();
         if($row){//if isset on administrator
                 $_SESSION['Name'] = $row['Name'];
                 $_SESSION['Surname']=$row['Surname'];
                 $_SESSION['Username']=$row['Username'];
                 $_SESSION['Country']=$row['Country'];
                 $_SESSION['City']=$row['City'];
                 $_SESSION['Address']=$row['Address'];
                 $_SESSION['PostalCode']=$row['PostalCode'];
                 $_SESSION['Email']=$row['Email'];
                 $_SESSION['PhoneNumber']=$row['PhoneNumber'];
             }else {
              header('Location: /EZCUT/index.php');
              exit;
             }
          

 ?>
