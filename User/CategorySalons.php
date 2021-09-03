
    <?php
    require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/User/UserMenu.php');
    ?>
    <h1 id="HomePageCategories"><?php echo 'Category:'.$_GET['CategoryPass'] ?></h1>
    <br>
<div class="container-fluid centralContent">
<?php
$GETSalons = $dbh->getInstance()->prepare('SELECT DISTINCT serviceproviders.ServiceProviderID,serviceproviders.Name,serviceproviders.City,serviceproviders.AverageSalonRating,serviceproviders.Address,serviceproviders.ShortDescription
FROM serviceproviders
INNER JOIN services ON serviceproviders.ServiceProviderID=services.ServiceProviderID
INNER JOIN servicecategories ON services.ServiceCategoryID=servicecategories.ServiceCategoryID
WHERE servicecategories.ServiceCategoryName="'.$_GET['CategoryPass'].'"
AND serviceproviders.Status="Confirmed"
ORDER BY serviceproviders.Name DESC ;');
$GETSalons->execute();
$resultSalons=$GETSalons;
 ?>
<?php
      $entrato=false;
if ($resultSalons!=null) {
  while ($row = $resultSalons->fetch()) {
    $entrato=true;
    $GETACategory = $dbh->getInstance()->prepare('SELECT ServiceCategoryName FROM serviceproviders 
    INNER JOIN services ON serviceproviders.ServiceProviderID=services.ServiceProviderID 
    INNER JOIN servicecategories ON services.ServiceCategoryID=servicecategories.ServiceCategoryID 
    WHERE serviceproviders.Name="'.$row['Name'].'" LIMIT 1');
    $GETACategory->execute();
    $resultCategory=$GETACategory;
    while($row2 = $resultCategory->fetch()){
   $DefaultCategory=$row2['ServiceCategoryName'];
    }
echo '
<a  href="Salonview.php?Salonview='.$row['Name'].'&Categoryview='.$_GET['CategoryPass'].'">
<section class="py-5">
            <div class="container">
                <div class="row SalonRow">
                        <div class="col-lg-6">
                            <h2 class="mb-4 SalonName">'.$row['Name'].'</h2>
                            <p>'.$row['ShortDescription'].'</p>
                            <p>This service provider have this categories:</p>
                            <ul>
                            ';
                            $GETACategory1 = $dbh->getInstance()->prepare('SELECT DISTINCT ServiceCategoryName FROM serviceproviders 
                            INNER JOIN services ON serviceproviders.ServiceProviderID=services.ServiceProviderID 
                            INNER JOIN servicecategories ON services.ServiceCategoryID=servicecategories.ServiceCategoryID 
                            WHERE serviceproviders.Name="'.$row['Name'].'" LIMIT 5');
                            $GETACategory1->execute();
                            $resultCategory1=$GETACategory1;
                
                            while($row3 = $resultCategory1->fetch()){
                             
                          echo '
                          <li>'.$row3['ServiceCategoryName'].'</li>
                          ';
                        }
                            echo '
                            </ul>
                            <p>Here are some informations about the service provider:</p>
                                 <ul>
                                     <li>City:'.$row['City'].'</li>
                                     <li>Address:'.$row['Address'].'</li>
                                     <li>Average salon rating:'.$row['AverageSalonRating'].'</li>

                                </ul>
                        </div>';
                        $GETSalonImage = $dbh->getInstance()->prepare('SELECT ImageName FROM ServiceProviderImages 
                            WHERE ServiceProviderID="'.$row['ServiceProviderID'].'" LIMIT 1');
                            $GETSalonImage->execute();
                            $result=$GETSalonImage;
                            $row6=$result->fetch();
                            echo'
                              <div class="col-lg-6">
                                <img class="img-fluid rounded" src="/EZCUT/Images/SalonImages/'.$row6['ImageName'].'" alt="SalonImages" />
                                ';
                                echo '
                            </div>
                </div> 
            </div>
        </section>
        </a>
';

}
}
if($entrato!=true){
    echo '<h1 style="text-align: center; color: red;">No salons have this category yet</h1>';
}
  ?>

  </body>
</html>




