
    <?php
    require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/User/UserMenu.php');
    ?>
      
        <!-- Page Content-->
        <section class="py-5">
            
                <!-- Page Heading/Breadcrumbs-->
                <h1 class="CenterText"><?php echo $_GET['Salonview'].'/'.$_GET['Categoryview'] ?></h1>
                <div class="row">
                    <!-- Blog Entries Column-->
                    <div class="col-md-4 sideBackground">
                        <!-- Search Widget-->
<?php
$SalonInformationsArray;
$stmt = $dbh->getInstance()->prepare("SELECT * FROM serviceproviders WHERE Name =:SalonName");
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
     INNER JOIN serviceproviders ON services.ServiceProviderID=serviceproviders.ServiceProviderID
     WHERE serviceproviders.ServiceProviderID="'.$row5['ServiceProviderID'].'"
     ORDER BY serviceproviders.Name DESC ;');//get  salons categories
     $GETSalonsCategories->execute();
           $resultSalonsCategories=$GETSalonsCategories;
           /////print all the categories for this salon
           echo '
       <div class="row">
<div class="col-sm"></div>
<div class="col-sm center  ">
</div>
<div class="row HeaderElement">
<h1> Category:</h1>
<div class="dropdown ">

 <button class="btn btn-secondary dropdown-toggle  " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  
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
      

?>
 <!-- Pagination-->
 <ul class="pagination justify-content-center mb-4">
                            <li class="page-item"></li>
                            <li class="page-item disabled"></li>
                        </ul>
                    </div>

                    <div class="col-md-8">
                      <?php
                       $GETSalonsCategoriesServices = $dbh->getInstance()->prepare('SELECT DISTINCT services.ServiceID, services.ServiceName,services.ShortDescription,services.TimeDurationHours,services.TimeDurationMinutes FROM servicecategories
                       INNER JOIN services ON servicecategories.ServiceCategoryID=services.ServiceCategoryID
                       INNER JOIN serviceproviders ON services.ServiceProviderID=serviceproviders.ServiceProviderID
                       WHERE serviceproviders.Name="'.$_GET['Salonview'].'"
                       AND servicecategories.ServiceCategoryName="'.$_GET['Categoryview'].'"
                       ORDER BY serviceproviders.Name DESC;');//get  salons services wirh this category
                       $GETSalonsCategoriesServices->execute();
                       $resultSalonsCategoriesServices=$GETSalonsCategoriesServices;
                       $InputRow=$resultSalonsCategoriesServices;
                       $NumerOfElements=0;
                       $ArrayElements;
                       $indice=1;
                       $today = date("Y-m-d");

                       function generateRandomString($length = 10) {
                        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        $charactersLength = strlen($characters);
                        $randomString = '';
                        for ($i = 0; $i < $length; $i++) {
                            $randomString .= $characters[rand(0, $charactersLength - 1)];
                        }
                        return $randomString;
                    }
                       while ($row = $InputRow->fetch()) {
                        
                        $ImgString=generateRandomString();
                        
                         echo '
                                              <div class="card mb-4">
                                              
                                                <div id="'.$ImgString.'" class="carousel slide" data-ride="carousel">
                                                  <div class="carousel-inner">';
                       //get 2 photos for this service
                       $GETPhotos = $dbh->getInstance()->prepare('SELECT ImageName FROM ServiceImages
                       WHERE ServiceID="'.$row['ServiceID'].'" LIMIT 2;');
                       $GETPhotos->execute();
                       $first=0;
   
                  
                       while ($row8 = $GETPhotos->fetch()) {
                         
                         
                          if($first==0){
                         
                                              echo '
                                                      <div class="carousel-item active">
                                                        <img class="d-block w-100" style="height: 600px;width: 350px;" src="/EZCUT/Images/ServiceImages/'.$row8['ImageName'].'" alt="">
                                                      </div>
                            ';
                            $first=1;
                       }else{
                              echo '
                                                      <div class="carousel-item ">
                                                         <img class="d-block w-100" style="height: 600px;width: 350px;" src="/EZCUT/Images/ServiceImages/'.$row8['ImageName'].'" alt="">
                                                       </div>
                             
                       ';
                        
                            }
                            
                           
                       }   
                           
                                        echo '              
                                              </div>
                                              <a class="carousel-control-prev" href="#'.$ImgString.'" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                              </a>
                                              <a class="carousel-control-next" href="#'.$ImgString.'" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                              </a>
                                        </div>
                        
                        
                                                 
                        
                        
                        
                                                  <div class="card-body">
                                                      <h2 class="card-title">'.$row['ServiceName'].'</h2>
                                                      <p class="card-text">'.$row['ShortDescription'].'</p>
                                                      <a class="btn btn-primary" href="/EZCUT/User/DateSelector.php?ServicePass='.$row['ServiceName'].'&Salonview='.$_GET['Salonview'].'&Categoryview='.$_GET['Categoryview'].'&Date='.$today.'">Book→</a>
                                                  </div>
                                                  <div class="card-footer text-muted"><br>
                                                      Time duration:'.$row['TimeDurationHours'].'H:'.$row['TimeDurationMinutes'].'M
                                                      &nbsp &nbsp &nbsp Today:'.date("l").''.date("Y.m.d").'
                                                  </div>
                                          
                                                        
                       </div>';
                       
                       }
                      ?>
                       


                    <!-- Sidebar Widgets Column-->


                       
        </section>
        <?php

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



      ?>
        <?php }?>
    </body>
</html>



















