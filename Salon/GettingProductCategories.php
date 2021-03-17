<?php
$GETCategories = $dbh->getInstance()->prepare("SELECT * FROM productcategories");//get categories
$GETCategories->execute();
$resultProductCategories=$GETCategories;
 ?>
