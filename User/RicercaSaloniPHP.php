<?php
 session_start();
 require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/conessione/DBHandler.php');
 require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/conessione/DBHandlerObject.php');
if(isset($_REQUEST["term"])){
    $stmt = $dbh->getInstance()->prepare('SELECT  DISTINCT Name FROM serviceproviders
    WHERE Name  LIKE :term
    ');   
    $term = $_REQUEST["term"] . '%';
    $stmt->bindParam(":term", $term);
    $stmt->execute();
    if($stmt->rowCount() > 0){
        while($row = $stmt->fetch()){
    $GETACategory = $dbh->getInstance()->prepare('SELECT ServiceCategoryName FROM serviceproviders 
        INNER JOIN services ON serviceproviders.ServiceProviderID=services.ServiceProviderID 
        INNER JOIN servicecategories ON services.ServiceCategoryID=servicecategories.ServiceCategoryID 
        WHERE serviceproviders.Name="'.$row['Name'].'" LIMIT 1');
        $GETACategory->execute();
        $resultCategory=$GETACategory;
        $entrato=null;
        while($row2 = $resultCategory->fetch()){
            $entrato=true;
       $DefaultCategory=$row2['ServiceCategoryName'];
        }
if($entrato!=true){
    $DefaultCategory='Hairstyle';
}        
            echo '
            <a href="Salonview.php?Salonview='.$row['Name'].'&Categoryview='.$DefaultCategory.'" class="list-group-item list-group-item-action Red">';
            echo  $row["Name"];
            echo '</a>';
        }
    } else{
        echo '<a  class="list-group-item list-group-item-action border-1">';
        echo "<p>No matches found</p>";
        echo '</a>';
    }
} 
?>