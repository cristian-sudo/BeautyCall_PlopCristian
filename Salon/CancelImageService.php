<?php
session_start();
require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/conessione/DBHandler.php');
require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/conessione/DBHandlerObject.php');
if(isset($_GET['ServiceImageID'],$_GET['ImageName'])){
    $stmt1 = $dbh->getInstance()->prepare('DELETE FROM ServiceImages
WHERE ServiceImagesID=:ServiceImagesID
');
$stmt1->bindParam(':ServiceImagesID', $ServiceImagesID);
$ServiceImagesID = $_GET['ServiceImageID'];
$stmt1->execute();
unlink($_SERVER['DOCUMENT_ROOT'].'/EZCUT/Images/ServiceImages/'.$_GET['ImageName']);
header('Location: /EZCUT/Salon/ManageServices.php');
exit;
}
?>
