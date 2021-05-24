<?php
   session_start();
   require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/conessione/DBHandler.php');
   require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/conessione/DBHandlerObject.php');
   print_r($_POST);
    if(isset($_POST['submit'])){
      $stmt = $dbh->getInstance()->prepare("UPDATE OpeningTime SET
        Monday=:Monday,
        Tuesday=:Tuesday,
        Wednesday=:Wednesday,
        Thursday=:Thursday,
        Friday=:Friday,
        Saturday=:Saturday,
        Sunday=:Sunday
        WHERE AdministratorID=:AdministratorID
      ");
              $stmt->bindParam(':Monday', $Monday);
              $stmt->bindParam(':Tuesday', $Tuesday);
              $stmt->bindParam(':Wednesday', $Wednesday);
              $stmt->bindParam(':Thursday', $Thursday);
              $stmt->bindParam(':Friday', $Friday);
              $stmt->bindParam(':Saturday', $Saturday);
              $stmt->bindParam(':Sunday', $Sunday);
              $stmt->bindParam(':AdministratorID', $AdministratorID);

              $Monday = $_POST['MondayOpen']."-".$_POST['MondayClosing'];
              $Tuesday = $_POST['TuesdayOpen'] . "-" . $_POST['TuesdayClosing'];
              $Wednesday = $_POST['WednesdayOpen']."-".$_POST['WednesdayClosing'];
              $Thursday = $_POST['ThursdayOpen']."-".$_POST['ThursdayClosing'];
              $Friday = $_POST['FridayOpen']."-".$_POST['FridayClosing'];
              $Saturday = $_POST['SaturdayOpen']."-".$_POST['SaturdayClosing'];
              $Sunday = $_POST['SundayOpen']."-".$_POST['SundayClosing'];
              $AdministratorID = $_SESSION['AdministratorID'];
             $stmt->execute();
if(isset($_POST['MondayAllDay'])){
  $stmt1 = $dbh->getInstance()->prepare("UPDATE OpeningTime SET
  Monday=null
  WHERE AdministratorID=:AdministratorID
");
$stmt1->bindParam(':AdministratorID', $AdministratorID);
$AdministratorID = $_SESSION['AdministratorID'];
$stmt1->execute();
}

if(isset($_POST['TuesdayAllDay'])){
  $stmt1 = $dbh->getInstance()->prepare("UPDATE OpeningTime SET
  Tuesday=null
  WHERE AdministratorID=:AdministratorID
");
$stmt1->bindParam(':AdministratorID', $AdministratorID);
$AdministratorID = $_SESSION['AdministratorID'];
$stmt1->execute();
}


if(isset($_POST['WednesdayAllDay'])){
  $stmt1 = $dbh->getInstance()->prepare("UPDATE OpeningTime SET
  Wednesday=null
  WHERE AdministratorID=:AdministratorID
");
$stmt1->bindParam(':AdministratorID', $AdministratorID);
$AdministratorID = $_SESSION['AdministratorID'];
$stmt1->execute();
}


if(isset($_POST['ThursdayAllDay'])){
  $stmt1 = $dbh->getInstance()->prepare("UPDATE OpeningTime SET
  Thursday=null
  WHERE AdministratorID=:AdministratorID
");
$stmt1->bindParam(':AdministratorID', $AdministratorID);
$AdministratorID = $_SESSION['AdministratorID'];
$stmt1->execute();
}


if(isset($_POST['FridayAllDay'])){
  $stmt1 = $dbh->getInstance()->prepare("UPDATE OpeningTime SET
  Friday=null
  WHERE AdministratorID=:AdministratorID
");
$stmt1->bindParam(':AdministratorID', $AdministratorID);
$AdministratorID = $_SESSION['AdministratorID'];
$stmt1->execute();
}


if(isset($_POST['SaturdayAllDay'])){
  $stmt1 = $dbh->getInstance()->prepare("UPDATE OpeningTime SET
  Monday=null
  WHERE AdministratorID=:AdministratorID
");
$stmt1->bindParam(':AdministratorID', $AdministratorID);
$AdministratorID = $_SESSION['AdministratorID'];
$stmt1->execute();
}


if(isset($_POST['SundayAllDay'])){
  $stmt1 = $dbh->getInstance()->prepare("UPDATE OpeningTime SET
  Monday=null
  WHERE AdministratorID=:AdministratorID
");
$stmt1->bindParam(':AdministratorID', $AdministratorID);
$AdministratorID = $_SESSION['AdministratorID'];
$stmt1->execute();
}



            header('Location: /EZCUT/Salon/ManageOpeningTime.php');
            exit;
    }

 ?>
