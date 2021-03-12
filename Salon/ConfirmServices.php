<?php
require('/Applications/XAMPP/xamppfiles/htdocs/EZCUT/Salon/Menu.php');
if (isset($_POST['Confirm'])) {
if ($_POST['ServiceName']!= null) {
  $stmt = $dbh->getInstance()->prepare('UPDATE services SET ServiceName="'.$_POST['ServiceName'].'"
    WHERE ServiceID="'.$_POST['ServiceID'].'"');
    $stmt->execute();
}
if ($_POST['Price']!= null) {
  $stmt = $dbh->getInstance()->prepare('UPDATE services SET Price="'.$_POST['Price'].'"
    WHERE ServiceID="'.$_POST['ServiceID'].'"');
    $stmt->execute();
}
if ($_POST['TimeDurationHours']!= null) {
  $stmt = $dbh->getInstance()->prepare('UPDATE services SET TimeDurationHours="'.$_POST['TimeDurationHours'].'"
    WHERE ServiceID="'.$_POST['ServiceID'].'"');
    $stmt->execute();
}
if ($_POST['TimeDurationMinutes']!= null) {
  $stmt = $dbh->getInstance()->prepare('UPDATE services SET TimeDurationMinutes="'.$_POST['TimeDurationMinutes'].'"
    WHERE ServiceID="'.$_POST['ServiceID'].'"');
    $stmt->execute();
}

if ($_POST['ServiceCategoryID']!= null) {
  /*
  $stmt = $dbh->getInstance()->prepare('SELECT ServiceCategoryName FROM servicecategories
    WHERE ServiceCategoryID="'.$_POST['ServiceCategoryID'].'"');
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo $result['ServiceCategoryName'];
*/

  $stmt = $dbh->getInstance()->prepare('UPDATE services SET ServiceCategoryID="'.$_POST['ServiceCategoryID'].'"
    WHERE ServiceID="'.$_POST['ServiceID'].'"');
    $stmt->execute();
}

if ($_POST['ShortDescription']!= null) {
  $stmt = $dbh->getInstance()->prepare('UPDATE services SET ShortDescription="'.$_POST['ShortDescription'].'"
    WHERE ServiceID="'.$_POST['ServiceID'].'"');
    $stmt->execute();
}
header('Location: ManageServices.php');
exit;
}
if (isset($_POST['Add'])) {
  $stmt = $dbh->getInstance()->prepare('INSERT INTO services (ServiceName,ServiceCategoryID,Price,TimeDurationHours,TimeDurationMinutes,ShortDescription,SalonID)'.'
  VALUES
("'.$_POST["ServiceName"].'",'.$_POST["ServiceCategoryID"].','.$_POST["Price"].','.$_POST["TimeDurationHours"].','.$_POST["TimeDurationMinutes"].',"'.$_POST["ShortDescription"].'",'.$_SESSION["SalonID"].')');
  $stmt->execute();
  header('Location: ManageServices.php');
  exit;
}



if (isset($_POST['Delete'])) {
  print_r($_POST);

  $stmt = $dbh->getInstance()->prepare('DELETE FROM services '.'
  WHERE ServiceID="'.$_POST['ServiceID'].'"');
  $stmt->execute();
  header('Location: ManageServices.php');
  exit;
}


?>
