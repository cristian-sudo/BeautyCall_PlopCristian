<?php
 session_start();
 require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/conessione/DBHandler.php');
 require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/conessione/DBHandlerObject.php');
 if(isset($_POST['Action']) && isset($_POST['BookingID'])  ){
    $stmt = $dbh->getInstance()->prepare('UPDATE bookings 
    SET BookingStatus="'.$_POST['Action'] .'"
    WHERE BookingID="'.$_POST['BookingID'] .'"
    ');
    $stmt->execute();
header('Location: Bookings.php');
 }else{
    header('Location: HomePageSalon.php');
 }
?>