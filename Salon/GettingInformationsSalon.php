<?php
session_start();
require('/Applications/XAMPP/xamppfiles/htdocs/EZCUT/conessione/DBHandler.php');
require('/Applications/XAMPP/xamppfiles/htdocs/EZCUT/conessione/DBHandlerObject.php');
require('/Applications/XAMPP/xamppfiles//htdocs/EZCUT/Bootstrap4.php');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<style media="screen">
  <?php require('/Applications/XAMPP/xamppfiles//htdocs/EZCUT/Style.css'); ?>
</style>
</head>
<body>
  <?php
//Administrator*
$stmt = $dbh->getInstance()->prepare("SELECT * FROM Administrators
         WHERE Username =:Username");
 $stmt->bindParam(':Username', $Username);
 $Username = $_SESSION['AdministratorUsername'];
 $stmt->execute();
 $row = $stmt->fetch();
 if($row){//if isset on administrator
         $_SESSION['AdministratorID'] = $row['AdministratorID'];
         $_SESSION['AdministratorName']=$row['AdministratorName'];
         $_SESSION['AdministratorSurname']=$row['AdministratorSurname'];
         $_SESSION['AdministratorCountry']=$row['Country'];
         $_SESSION['AdministratorCity']=$row['City'];
         $_SESSION['AdministratorAddress']=$row['Address'];
         $_SESSION['AdministratorPostalCode']=$row['PostalCode'];
         $_SESSION['AdministratorEmail']=$row['Email'];
         $_SESSION['AdministratorPhoneNumber']=$row['PhoneNumber'];
     }
//OpeningTimeID
$stmt = $dbh->getInstance()->prepare("SELECT * FROM OpeningTime WHERE AdministratorID='".$_SESSION['AdministratorID']."'");
$stmt->execute();
$row=$stmt;
if ($row) {
  foreach ($row as $key => $value) {
    $value['OpeningTimeID']=$_SESSION;
}}

//Salon*
$stmt = $dbh->getInstance()->prepare("SELECT * FROM HairdressingSalons WHERE AdministratorID ='".$_SESSION['AdministratorID']."'");
$stmt->execute();
$row = $stmt->fetch();
$_SESSION['SalonName']=$row['Name'];
$_SESSION['SalonID']=$row['SalonID'];
$_SESSION['SalonCountry']=$row['Country'];
$_SESSION['SalonAddress']=$row['Address'];
$_SESSION['SalonPostalCode']=$row['PostalCode'];
$_SESSION['SalonShortDescription']=$row['ShortDescription'];
$_SESSION['SalonEmail']=$row['Email'];
$_SESSION['SalonPhoneNumber']=$row['PhoneNumber'];
$_SESSION['SalonAverageSalonRating']=$row['AverageSalonRating'];
$_SESSION['SalonStatus']=$row['Status'];
 ?>
