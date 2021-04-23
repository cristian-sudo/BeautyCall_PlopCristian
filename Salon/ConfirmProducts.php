<?php
require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/Salon/Menu.php');
if (isset($_POST['Confirm'])) {
if ($_POST['ProductName']!= null) {//
  $stmt = $dbh->getInstance()->prepare('UPDATE Products SET ProductName="'.$_POST['ProductName'].'"
    WHERE ProductID="'.$_POST['ProductID'].'"');
    $stmt->execute();
}
if ($_POST['ShortDescription']!= null) {//
  $stmt = $dbh->getInstance()->prepare('UPDATE Products SET ShortDescription="'.$_POST['ShortDescription'].'"
    WHERE ProductID="'.$_POST['ProductID'].'"');
    $stmt->execute();
}
if ($_POST['PicesAvailable']!= null) {
  $stmt = $dbh->getInstance()->prepare('UPDATE Products SET PicesAvailable="'.$_POST['PicesAvailable'].'"
    WHERE ProductID="'.$_POST['ProductID'].'"');
    $stmt->execute();
}
if ($_POST['PricePerUnit']!= null) {
  $stmt = $dbh->getInstance()->prepare('UPDATE Products SET PricePerUnit="'.$_POST['PricePerUnit'].'"
    WHERE ProductID="'.$_POST['ProductID'].'"');
    $stmt->execute();
}
if ($_POST['QuantityOfProduct']!= null) {
  $stmt = $dbh->getInstance()->prepare('UPDATE Products SET QuantityOfProduct="'.$_POST['QuantityOfProduct'].'"
    WHERE ProductID="'.$_POST['ProductID'].'"');
    $stmt->execute();
}

if ($_POST['ProductCategoryID']!= null) {
  $stmt = $dbh->getInstance()->prepare('UPDATE Products SET ProductCategoryID="'.$_POST['ProductCategoryID'].'"
    WHERE ProductID="'.$_POST['ProductID'].'"');
    $stmt->execute();
}
header('Location: ManageProducts.php');
exit;
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['Add'])) {
  $stmt = $dbh->getInstance()->prepare('INSERT INTO products (ProductName,ShortDescription,PicesAvailable,PricePerUnit,QuantityOfProduct,SalonID,ProductCategoryID)'.'
  VALUES
("'.$_POST["ProductName"].'","'.$_POST["ShortDescription"].'",'.$_POST["PicesAvailable"].','.$_POST["PricePerUnit"].','.$_POST["QuantityOfProduct"].','.$_SESSION["SalonID"].','.$_POST["ProductCategoryID"].')');
  $stmt->execute();
  header('Location: ManageProducts.php');
  exit;

}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['Delete'])) {
  print_r($_POST);

  $stmt = $dbh->getInstance()->prepare('DELETE FROM products '.'
  WHERE ProductID="'.$_POST['ProductID'].'"');
  $stmt->execute();
  header('Location: ManageProducts.php');
  exit;
}
?>
