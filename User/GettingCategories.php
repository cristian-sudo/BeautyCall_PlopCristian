<?php
$GETCategories = $dbh->getInstance()->prepare("SELECT DISTINCT ServiceCategoryName FROM servicecategories;");//get categories
$GETCategories->execute();
$resultCategories=$GETCategories;
 ?>
