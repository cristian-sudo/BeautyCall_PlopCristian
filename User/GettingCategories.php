<?php
$GETCategories = $dbh->getInstance()->prepare("SELECT DISTINCT ServiceCategoryName,ImageName 
FROM servicecategories ORDER BY ServiceCategoryName DESC ;");//get categories
$GETCategories->execute();
$resultCategories=$GETCategories;
 ?>
