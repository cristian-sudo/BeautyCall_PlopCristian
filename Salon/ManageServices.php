<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">
    .zui-table {
  border: solid 1px #DDEEEE;
  border-collapse: collapse;
  border-spacing: 0;
  font: normal 13px Arial, sans-serif;
}
.zui-table thead th {
  background-color: #DDEFEF;
  border: solid 1px #DDEEEE;
  color: #336B6B;
  padding: 10px;
  text-align: left;
  text-shadow: 1px 1px 1px #fff;
}
.zui-table tbody td {
  border: solid 1px #DDEEEE;
  color: #333;
  padding: 10px;
  text-shadow: 1px 1px 1px #fff;
}
    </style>
  </head>
  <body>

  </body>
</html>
<?php
require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/Salon/Menu.php');
$stmt = $dbh->getInstance()->prepare("
SELECT ServiceCategories.ServiceCategoryName, ServiceCategories.ServiceCategoryID
   FROM
   hairdressingsalonsservicecategories
INNER JOIN hairdressingsalons ON hairdressingsalonsservicecategories.ServiceProviderID = hairdressingsalons.ServiceProviderID
INNER JOIN servicecategories ON hairdressingsalonsservicecategories.ServiceCategoryID = servicecategories.ServiceCategoryID
WHERE hairdressingsalonsservicecategories.ServiceProviderID='".$_SESSION['ServiceProviderID']."' ORDER BY ServiceCategories.ServiceCategoryName ASC
");
$stmt->execute();
$Try=$stmt->fetch();
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo "<h1>Add a new ServiceCategory<h1><br>";
echo '<form method="POST" action="ConfirmServiceCategories.php">
<table class="zui-table">
<tr>
<th><h4>Service Category Name</h4></th>
</tr>
<tr>
<td><input type="text" name="ServiceCategoryName" required></td>
<td><button type="submit" name="Add">Add a new service category</button></td>
</tr>
</table>
</form>';
if ($Try) {//if exist results
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo "<h1>Edit existing service categories</h1><br>";
  echo "
<table class='zui-table'><tr>
<th>Service Category ID</th>
<th>Service Category Name</th>
</tr>";//print the values
$stmt->execute();
$row=$stmt;
  foreach ($row as $key => $value) {
    echo "<form method='post' action='ConfirmServiceCategories.php'>";
    echo "<tr>";
    echo "<td>".$value['ServiceCategoryID']."</td>";
    echo "<td>".$value['ServiceCategoryName']."</td>";
    echo "</tr>";
    //inputs
    echo "<tr>";
    echo '
    <td><input type="text" name="ServiceCategoryID" value="'.$value['ServiceCategoryID'].'" readonly></td>
    <td><input type="text" name="ServiceCategoryName"></td>
    <td><input type="submit" value="Confirm Changes" name="Confirm"></td>
    <td><input type="submit" value="Delete ServiceCategory" name="Delete"></td>
    </form>
    </tr>';}
  echo "</table>";
}else{
  echo "No service categories yet";
}
 ?>
