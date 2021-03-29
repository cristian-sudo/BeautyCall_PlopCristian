<?php
require('/Applications/XAMPP/xamppfiles/htdocs/EZCUT/Salon/Menu.php');
if (isset($_POST['Confirm'])) {
if ($_POST['ServiceCategoryName']!= null) {
  $stmt = $dbh->getInstance()->prepare('UPDATE servicecategories SET ServiceCategoryName="'.$_POST['ServiceCategoryName'].'"
    WHERE ServiceCategoryID="'.$_POST['ServiceCategoryID'].'"');
    $stmt->execute();
}
header('Location: ManageServiceCategory.php');
exit;
}

if (isset($_POST['Add'])) {
$stmt = $dbh->getInstance()->prepare('INSERT INTO ServiceCategories (ServiceCategoryName)'.'
VALUES
("'.$_POST["ServiceCategoryName"].'")');
$stmt->execute();

$stmt = $dbh->getInstance()->prepare('SELECT ServiceCategoryID FROM servicecategories'.'
WHERE ServiceCategoryName="'.$_POST["ServiceCategoryName"].'"');
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $dbh->getInstance()->prepare('INSERT INTO hairdressingsalonsservicecategories (SalonID,ServiceCategoryID)'.'
VALUES
("'.$_SESSION["SalonID"].'","'.$result["ServiceCategoryID"].'")');
$stmt->execute();
header('Location: ManageServiceCategory.php');
exit;
}

if (isset($_POST['Delete'])) {
  $stmt = $dbh->getInstance()->prepare('DELETE FROM hairdressingsalonsservicecategories '.'
  WHERE SalonID="'.$_SESSION['SalonID'].'" AND ServiceCategoryID="'.$_POST['ServiceCategoryID'].'"');
  $stmt->execute();
  header('Location: ManageServiceCategory.php');
  exit;
}
?>
