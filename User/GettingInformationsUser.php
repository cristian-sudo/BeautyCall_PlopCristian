<?php
$stmt = $dbh->getInstance()->prepare("SELECT * FROM Users
         WHERE Username =:Username");
         $stmt->bindParam(':Username', $Username);
         $Username = $_SESSION['Username'];
         $stmt->execute();
         $row = $stmt->fetch();
         if($row){
                 $_SESSION['Name'] = $row['Name'];
                 $_SESSION['Surname']=$row['Surname'];
                 $_SESSION['Username']=$row['Username'];
                 $_SESSION['Country']=$row['Country'];
                 $_SESSION['City']=$row['City'];
                 $_SESSION['Address']=$row['Address'];
                 $_SESSION['PostalCode']=$row['PostalCode'];
                 $_SESSION['Email']=$row['Email'];
                 $_SESSION['PhoneNumber']=$row['PhoneNumber'];
                 $_SESSION['UserID']=$row['UserID'];
              //header('Location: HomePage.php');
             // exit;
             }else {
             // header('Location: /EZCUT/index.php');
              //exit;
             }
          //print_r($_SESSION);

 ?>
