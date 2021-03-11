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
//print_r($_POST);
header('Location: ManageServices.php');
exit;
}
echo '
<td><input type="text" name="ServiceID" value="'.$value['ServiceID'].'" readonly></td>
<td><input type="text" name="ServiceName"></td>
<td><input type="number" step=0.01 min=1 name="Price"></td>
<td><input type="number" name="TimeDurationHours"></td>
<td><input type="text" name="TimeDurationMinutes"></td>';
echo '
<td>
<select name="ServiceCategoryID">
<option></option>';
require('/Applications/XAMPP/xamppfiles/htdocs/EZCUT/Salon/GettingCategories.php');
foreach ($resultCategories as $key2 => $value2) {
echo '<option value="'.$value2['ServiceCategoryID'].'">' . $value2['ServiceCategoryName'] . '</option>';
}
echo '
</select>
?>
