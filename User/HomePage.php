<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    require('/Applications/XAMPP/xamppfiles/htdocs/EZCUT/User/UserMenu.php');
    ?>
    <h1 id="HomePageCategories">Main Categories</h1>
    <br>

<div class="advL">
  adv
</div>

<div class="advR">
  adv
</div>

<div class="container-fluid centralContent">

<?php
require('/Applications/XAMPP/xamppfiles/htdocs/EZCUT/User/GettingCategories.php');
$NumerOfElements;
while($row = $resultCategories->fetch()){
  $NumerOfElements++;
}
echo $NumerOfElements;
$rowsNeeded;
$rowsNeeded=$NumerOfElements/3;
echo $rowsNeeded;


?>
<br><br>
<div>
  <div class="row">
    <div class=" col cols">
      <div class="row rows">
         <div class=" col cols TitleCategory">
            TitleCategory
         </div>
         </div>

         <div class="row rows">
         <div class=" col cols">
            Image
         </div>
      </div>
    </div>
  </div>
</div>


</div>
  </body>
</html>
