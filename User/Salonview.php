<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    require('/Applications/XAMPP/xamppfiles/htdocs/EZCUT/User/UserMenu.php');
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
$row = $stmt->fetch();
    if ($row) {
        ///////putting informations of salons in an array
        $SalonInformationsArray['SalonName']=$row['Name'];
        $SalonInformationsArray['SalonID']=$row['SalonID'];
        $SalonInformationsArray['SalonCountry']=$row['Country'];
        $SalonInformationsArray['SalonAddress']=$row['Address'];
        $SalonInformationsArray['SalonPostalCode']=$row['PostalCode'];
        $SalonInformationsArray['SalonShortDescription']=$row['ShortDescription'];
        $SalonInformationsArray['SalonEmail']=$row['Email'];
        $SalonInformationsArray['SalonPhoneNumber']=$row['PhoneNumber'];
        $SalonInformationsArray['SalonAverageSalonRating']=$row['AverageSalonRating'];
        $SalonInformationsArray['SalonStatus']=$row['Status'];
        //Display basic informations
        echo '
<div class="row">
      <div class="col-sm">
      <h7>Country:</h7><br>'.$SalonInformationsArray['SalonCountry'].'</h7>
      </div>
      <div class="col-sm">
      <h7>Address:</h7><br>'.$SalonInformationsArray['SalonAddress'].'</h7>
      </div>
      <div class="col-sm">
      <h7>Postal code:</h7><br>'.$SalonInformationsArray['SalonPostalCode'].'</h7>
      </div>
      <div class="col-sm">
      <h7>Email:</h7><br>'.$SalonInformationsArray['SalonEmail'].'</h7>
      </div>
      <div class="col-sm">
      <h7>Phone Number:</h7><br>'.$SalonInformationsArray['SalonPhoneNumber'].'</h7>
      </div>
      <div class="col-sm">
      <h7>Phone Average Ratings:</h7><br>'.$SalonInformationsArray['SalonAverageSalonRating'].'</h7>
      </div>
</div>
<div class="row">
      <div class="col-sm"> 
      <h2 class="ShortDescription">Short Description</h2><br>
      <h4 class="ShortDescription">'.$SalonInformationsArray['SalonShortDescription'].'</h4>
      </div>
</div>
 ';
        ///////Getting all the salon categories
        if (isset($_GET['Categoryview'])) {

         ///////Getting all the salon categories
      $GETSalonsCategories = $dbh->getInstance()->prepare('SELECT DISTINCT servicecategories.ServiceCategoryName FROM servicecategories
      INNER JOIN services ON servicecategories.ServiceCategoryID=services.ServiceCategoryID
      INNER JOIN hairdressingsalons ON services.SalonID=hairdressingsalons.SalonID
      WHERE hairdressingsalons.SalonID="'.$SalonInformationsArray['SalonID'].'"
      ORDER BY hairdressingsalons.Name DESC ;');//get  salons categories
      $GETSalonsCategories->execute();
            $resultSalonsCategories=$GETSalonsCategories;
            /////print all the categories for this salon
            echo '
        <div class="row">
<div class="col-sm"></div>
<div class="col-sm ">
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
$GETSalonsCategoriesServices = $dbh->getInstance()->prepare('SELECT DISTINCT services.ServiceName,services.ShortDescription,services.TimeDurationHours,services.TimeDurationMinutes FROM servicecategories
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
   <a href="/EZCUT/User/DateSelector.php?ServicePass='.$row['ServiceName'].'&Salonview='.$_GET['Salonview'].'&Categoryview='.$_GET['Categoryview'].'&Date='.$today.'">

   <div class="row ServicesRows">
      <div class="col-3 col">
       <h1 class="ServiceName">' .$row['ServiceName'].'</h1>
      </div>

      <div class="col-4 col">
       <h6>Description:<br>
       '.$row['ShortDescription'].'
       </h6>
      </div>

      <div class="col-3 col">
       3 images
      </div>

      <div class="col-1 col">
      <h6>Time:<br>
      '.$row['TimeDurationHours'].'h,'.$row['TimeDurationMinutes'].'min
      </h6>
      </div>

    </div>
    </a> <br>';
}




        //print_r($SalonInformationsArray);
        //print_r($_GET);
    } else {
        echo 'Salon not found';
    }

  ?>

  </body>
</html>



















