<?php
$GETCategories = $dbh->getInstance()->prepare("SELECT DISTINCT ProductCategoryName FROM Productcategories;");//get categories
$GETCategories->execute();
$resultCategories=$GETCategories;
 ?>