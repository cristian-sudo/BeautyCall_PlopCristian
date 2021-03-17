<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1>ci siamo</h1>
    <?php
    require('/Applications/XAMPP/xamppfiles/htdocs/EZCUT/header.php');
/*    if (isset($_SESSION['Name'])) {
         echo "ciao".$_SESSION['Name']."<br>";
    }*/
    if (isset($_SESSION['Name'])) {

      $stmt = $dbh->getInstance()->prepare("SELECT ServiceCategoryName FROM ServiceCategories");
       $stmt->execute();
       $row = $stmt;
       if ($row) {
         echo "<table>";
         foreach ($row as $key => $value) {
           echo "<tr><td>";
            //echo "<a href=".url.">link text</a">
           echo $value['ServiceCategoryName'];
           echo "</td></tr>";
         }
         echo "</table>";
       }
    }
     ?>
  </body>
</html>
