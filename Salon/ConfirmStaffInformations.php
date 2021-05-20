<?php
require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/Salon/Menu.php');
print_r($_POST);
//get all categories, and control if isset a post value with that name.
$stmt = $dbh->getInstance()->prepare('SELECT  * FROM servicecategories  
');   
$stmt->execute();
    while($row = $stmt->fetch()){
  
        //scorro i risulatti dei post


        foreach ($_POST as $index => $value) {
           if($index==$row['ServiceCategoryName']){


            $stmt2 = $dbh->getInstance()->prepare('SELECT  ServiceCategoryID FROM servicecategories
            WHERE ServiceCategoryName="'.$row['ServiceCategoryName'].'"   
            ');   
            $stmt2->execute();
            $IDcategory=$stmt2->fetch();


            $stmt3 = $dbh->getInstance()->prepare('SELECT  StaffID FROM staffcategories
            WHERE StaffID="'.$_POST['StaffID'].'"  AND ServiceCategoryID="'.$IDcategory['ServiceCategoryID'].'"  
            ');   
            $stmt3->execute();
            $alreadyExists=$stmt3->fetch();
            

            if($alreadyExists['StaffID']==null){

            $stmt1 = $dbh->getInstance()->prepare('INSERT INTO StaffCategories (StaffID,ServiceCategoryID)
            VALUES ("'.$_POST['StaffID'].'","'.$IDcategory['ServiceCategoryID'].'"); 
            ');   
            $stmt1->execute();

            }
           }
        
        }

    }
?>
