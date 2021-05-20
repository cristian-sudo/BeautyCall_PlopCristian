<?php
 session_start();
 require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/conessione/DBHandler.php');
 require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/conessione/DBHandlerObject.php');
if(isset($_REQUEST["term"])){
    $stmt = $dbh->getInstance()->prepare('SELECT  ServiceCategoryName FROM servicecategories
    WHERE ServiceCategoryName  LIKE :term
    ');   
    $term = $_REQUEST["term"] . '%';
    $stmt->bindParam(":term", $term);
    $stmt->execute();

    
    if($stmt->rowCount() > 0){
        while($row = $stmt->fetch()){
            
            echo '
            <a href="/EZCUT/User/CategorySalons.php?CategoryPass='.$row['ServiceCategoryName'].'" class="list-group-item list-group-item-action Red">';
            echo  $row["ServiceCategoryName"];
            echo '</a>';
        }
    } else{
        echo '<a  class="list-group-item list-group-item-action border-1">';
        echo "<p>No matches found</p>";
        echo '</a>';
    }
} 

?>