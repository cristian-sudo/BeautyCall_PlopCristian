<?php
    require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/User/UserMenu.php');
    ?>
 <h1 id="HomePageCategories">Main Providers</h1>
    <form class="form-inline">
        <div class="Center">
    <input class="form-control mr-sm-2" type="search" placeholder="Search in categories" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
</div>
  </form>
    <br>



<?php


$GETSalons = $dbh->getInstance()->prepare("SELECT DISTINCT serviceprovider.ServiceProviderID,serviceprovider.Name,serviceprovider.City,serviceprovider.AverageSalonRating,serviceprovider.Address,serviceprovider.ShortDescription
FROM serviceprovider ORDER BY Name DESC LIMIT 7;");
$GETSalons->execute();
$resultSalons=$GETSalons;
while ($row = $resultSalons->fetch()) {
    $GETACategory = $dbh->getInstance()->prepare('SELECT ServiceCategoryName FROM serviceprovider 
    INNER JOIN services ON serviceprovider.ServiceProviderID=services.ServiceProviderID 
    INNER JOIN servicecategories ON services.ServiceCategoryID=servicecategories.ServiceCategoryID 
    WHERE serviceprovider.Name="'.$row['Name'].'" LIMIT 1');
    $GETACategory->execute();
    $resultCategory=$GETACategory;
    while($row2 = $resultCategory->fetch()){
   $DefaultCategory=$row2['ServiceCategoryName'];
    }
    

if(isset($DefaultCategory)){
echo '
<a  href="Salonview.php?Salonview='.$row['Name'].'&Categoryview='.$DefaultCategory.'">
<section class="py-5">
            <div class="container">
                <div class="row SalonRow">
                        <div class="col-lg-6">
                            <h2 class="mb-4 SalonName">'.$row['Name'].'</h2>
                            <p>'.$row['ShortDescription'].'</p>
                            <p>This service provider have this categories and much more:</p>
                            <ul>
                            ';
                            //get max 5 categories
                            $GETACategory1 = $dbh->getInstance()->prepare('SELECT DISTINCT ServiceCategoryName FROM serviceprovider 
                            INNER JOIN services ON serviceprovider.ServiceProviderID=services.ServiceProviderID 
                            INNER JOIN servicecategories ON services.ServiceCategoryID=servicecategories.ServiceCategoryID 
                            WHERE serviceprovider.Name="'.$row['Name'].'" LIMIT 5');
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
                        $GETSalonImage = $dbh->getInstance()->prepare('SELECT ImageName FROM serviceproviderimages 
                            WHERE ServiceProviderID="'.$row['ServiceProviderID'].'" LIMIT 1');
                            $GETSalonImage->execute();
                            $result=$GETSalonImage;
                            $row6=$result->fetch();
                            if(isset($row6['ImageName'])){
                            echo'
                              <div class="col-lg-6">
                                <img class="img-fluid rounded" src="/EZCUT/Images/SalonImages/'.$row6['ImageName'].'" alt="..." />
                                ';
                                echo '
                            </div>';}
                echo '
                            </div>';}
                            else{
                             
                            }
                            echo '

                
            </div>
        </section>
        </a>










';
}
?>
</div>
</body>
</html>




