<?php
$GETCategories = $dbh->getInstance()->prepare("SELECT * FROM servicecategories");//get categories
$GETCategories->execute();
$resultCategories=$GETCategories;
 ?>
