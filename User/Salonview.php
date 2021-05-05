
    <?php
    require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/User/UserMenu.php');
    ?>
    <h1 id="HomePageCategories"><?php echo $_GET['Salonview'] ?></h1>
    <br>




<div class="container-fluid centralContent">



<?php
$SalonInformationsArray;
$stmt = $dbh->getInstance()->prepare("SELECT * FROM HairdressingSalons WHERE Name =:SalonName");
$stmt->bindParam(':SalonName', $SalonName);
$SalonName = $_GET['Salonview'];
$stmt->execute();
$row5 = $stmt->fetch();
    if ($row5) {
        ///////Getting all the salon categories
        if (isset($_GET['Categoryview'])) {

         ///////Getting all the salon categories
      $GETSalonsCategories = $dbh->getInstance()->prepare('SELECT DISTINCT servicecategories.ServiceCategoryName FROM servicecategories
      INNER JOIN services ON servicecategories.ServiceCategoryID=services.ServiceCategoryID
      INNER JOIN hairdressingsalons ON services.SalonID=hairdressingsalons.SalonID
      WHERE hairdressingsalons.SalonID="'.$row5['SalonID'].'"
      ORDER BY hairdressingsalons.Name DESC ;');//get  salons categories
      $GETSalonsCategories->execute();
            $resultSalonsCategories=$GETSalonsCategories;
            /////print all the categories for this salon
            echo '
        <div class="row">
<div class="col-sm"></div>
<div class="col-sm center ">
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle HeaderElement CategoryViewCenterText" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   <h1 class="dropdownText"> '.$_GET['Categoryview'].'</h1>
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
';
            foreach ($resultSalonsCategories as $key2 => $value2) {
                echo '<a class="dropdown-item" href="/EZCUT/User/Salonview.php?Salonview='.$_GET['Salonview'].'&Categoryview='.$value2['ServiceCategoryName'].'">' . $value2['ServiceCategoryName'] . '</a>';
  
            }
            echo ' </div>
</div>   
</div>
<div class="col-sm"></div>
</div>
';
        }
///////////////
$GETSalonsCategoriesServices = $dbh->getInstance()->prepare('SELECT DISTINCT services.ServiceID, services.ServiceName,services.ShortDescription,services.TimeDurationHours,services.TimeDurationMinutes FROM servicecategories
INNER JOIN services ON servicecategories.ServiceCategoryID=services.ServiceCategoryID
INNER JOIN hairdressingsalons ON services.SalonID=hairdressingsalons.SalonID
WHERE hairdressingsalons.Name="'.$_GET['Salonview'].'"
AND servicecategories.ServiceCategoryName="'.$_GET['Categoryview'].'"
ORDER BY hairdressingsalons.Name DESC;');//get  salons services wirh this category
$GETSalonsCategoriesServices->execute();
$resultSalonsCategoriesServices=$GETSalonsCategoriesServices;
$InputRow=$resultSalonsCategoriesServices;
$NumerOfElements=0;
$ArrayElements;
$indice=0;
$today = date("Y-m-d");
while ($row = $InputRow->fetch()) {
   echo '
   <div class="col-md-8"> 
                        <div class="card mb-4">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">';
//get 2 photos for this service
$GETPhotos = $dbh->getInstance()->prepare('SELECT ImageName FROM ServiceImages
WHERE ServiceID="'.$row['ServiceID'].'" LIMIT 2;');
$GETPhotos->execute();
$resultGETPhotos=$GETPhotos;
while ($row8 = $resultGETPhotos->fetch()) {
    $first=0;
    
                        echo '
                          <div class="carousel-item active">
                            <img class="d-block w-100" src="/EZCUT/Images/ServiceImages/'.$row8['ImageName'].'" alt="">
                          </div>
                          
      ';
      
}    
      
                  echo '               
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="sr-only">Next</span>
                        </a>
                      </div>


                            



                            <div class="card-body">
                                <h2 class="card-title">'.$row['ServiceName'].'</h2>
                                <p class="card-text">'.$row['ShortDescription'].'</p>
                                <a class="btn btn-primary" href="/EZCUT/User/DateSelector.php?ServicePass='.$row['ServiceName'].'&Salonview='.$_GET['Salonview'].'&Categoryview='.$_GET['Categoryview'].'&Date='.$today.'">Book→</a>
                            </div>
                            <div class="card-footer text-muted">
                                Today:'.date("l").','.date("Y.m.d").'
                            </div>
                        </div>
                                   
</div>';
}

echo '
<footer class="py-5 bg-dark">
<div class="container">
<p class="m-0 text-center text-white">
Salon Informations:<br>
Country:'.$row5['Country'].'
Address: '.$row5['Address'].'
Postal Code:'.$row5['PostalCode'].'
Email:'.$row5['Email'].'
Phone Number:'.$row5['PhoneNumber'].'
</p>
</div>
</footer>';


        //print_r($SalonInformationsArray);
        //print_r($_GET);
    } else {
        echo 'Salon not found';
    }

  ?>

  </body>
</html>



















