<?php
session_start();
require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/conessione/DBHandler.php');
require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/conessione/DBHandlerObject.php');

 
   $stmt = $dbh->getInstance()->prepare("SELECT Password FROM Users
            WHERE Username =:Username");
    $stmt->bindParam(':Username', $Username);
    $Username = $_SESSION['Username'];
    $stmt->execute();
    $row = $stmt->fetch();
    // $row is false if the user does not exist
    if($row){
        if(password_verify($_POST['pass'], $row['Password'])){
            header('Location: AccountInformations.php');
            exit;
        }
        else{
          header('Location: PassConfirm.php?id=falsepw');
            exit;
        }
   }
 
   header('Location: /EZCUT/index.php');
     exit;
?>
