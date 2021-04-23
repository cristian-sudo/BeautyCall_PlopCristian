<?php
$GETCategories = $dbh->getInstance()->prepare("SELECT DISTINCT ProductCategoryName FROM productcategories");//get categories
$GETCategories->execute();
$resultProductCategories=$GETCategories;
 ?>
