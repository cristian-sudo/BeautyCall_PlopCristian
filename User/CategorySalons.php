
    <?php
    require('/Applications/XAMPP/xamppfiles/htdocs/EZCUT/User/UserMenu.php');
    ?>
    <h1 id="HomePageCategories"><?php echo 'Category:'.$_GET['CategoryPass'] ?></h1>
    <br>


<div class="container-fluid centralContent">

<?php
$GETSalonsCategories = $dbh->getInstance()->prepare('SELECT DISTINCT hairdressingsalons.Name,hairdressingsalons.City,hairdressingsalons.AverageSalonRating,hairdressingsalons.Address FROM hairdressingsalons
INNER JOIN services ON hairdressingsalons.SalonID=services.SalonID
INNER JOIN servicecategories ON services.ServiceCategoryID=servicecategories.ServiceCategoryID
WHERE servicecategories.ServiceCategoryName="'.$_GET['CategoryPass'].'"
AND hairdressingsalons.Status="Confirmed"
ORDER BY hairdressingsalons.Name DESC ;');//get  salons categories
$GETSalonsCategories->execute();
$resultSalonsCategories=$GETSalonsCategories;
 ?>


<?php

while ($row = $resultSalonsCategories->fetch()) {
echo'
<a  href="Salonview.php?Salonview='.$row['Name'].'&Categoryview='.$_GET['CategoryPass'].'">
<div class="row SalonView">
<div class="col coll">

     <div class="row">
     <div class="col coll textInside">'.$row['Name'].' </div>
     </div>


    <div class="row">
    

    <div class="col colImageContainer coll">
    <img class="ImageCategoryDimentions" src="https://as2.ftcdn.net/jpg/00/61/20/35/1000_F_61203573_res38pBYqXr7gMdY8btaVuIq5ryyeruL.jpg" alt="NomeCategoria" >
    </div>


    <div class="col">

    <div class="row">
    <div class="col textInside">Ratings:</div>
    <div class="col textInside">'.$row['AverageSalonRating'].'</div>
    </div>

    <div class="row">
    <div class="col textInside">City:</div>
    <div class="col textInside">'.$row['City'].'</div>
    </div>

    <div class="row">
    <div class="col textInside">Address:</div>
    <div class="col textInside">'.$row['Address'].'</div>
    </div>
    <div class="row">
    <div class="col textInside">
    ';
    date_default_timezone_set('UTC');
    echo date("l").':';


    $GetTime = $dbh->getInstance()->prepare('SELECT '.date("l").' FROM openingtime
    INNER JOIN hairdressingsalons ON hairdressingsalons.OpeningTimeID=OpeningTime.OpeningTimeID
WHERE hairdressingsalons.Name="'.$row['Name'].'"
;');//get  salons categories
$GetTime->execute();
$resultGetTime=$GetTime;
while ($row = $resultGetTime->fetch()) {
echo '
    </div>
<div class="col textInside">
'.$row[date("l")].'
</div>
';
}
    echo '
    </div>
    </div>


</div>
    
</div>
</div>
</a>
';   
}

/*
$rowsNeeded=0;
if ($NumerOfElements%3!=0) {//if the number is divisible by 3 with no rest
    $rowsNeeded=$NumerOfElements/3;
    $rowsNeeded=floor($rowsNeeded)+1;//round the number with deffect and add 1 for an extra collumn
} else {
    $rowsNeeded=$NumerOfElements/3;
}
if ($NumerOfElements>0) {
    for ($i=0;$i<$rowsNeeded-1;$i++) {
        echo'<div class="row">';//riga esterna
                  for ($u=0;$u<3;$u++) {//faccio 3 collone esterne grandi
                      echo'
                        <div class="col-4 MainCollons">
                        <a  href="Salonview.php?Salonview='.$ArrayElements[$NumerOfElements-1].'&Categoryview='.$_GET['CategoryPass'].'">
                            <div class="row RowTitle">
                                  <div class=" col ColTitle">
                                    '.$ArrayElements[$NumerOfElements-1].'
                                  </div>
                            </div>

                            <div class="row rows">
                                <div class="col colImageContainer">
                                <img class="ImageCategoryDimentions" src="https://as2.ftcdn.net/jpg/00/61/20/35/1000_F_61203573_res38pBYqXr7gMdY8btaVuIq5ryyeruL.jpg" alt="NomeCategoria" >
                                </div>
                            </div>
                            </a>
                        </div>
                              ';
                      $NumerOfElements=$NumerOfElements-1;
                  };
        echo '</div>';
    }
    $ModificheFatte=0;
    //due collone
    if ($NumerOfElements%3==2) {//in sospeso 2 collone
                    echo'<div class="row">';//riga esterna
                    for ($u=0;$u<2;$u++) {//faccio 3 collone esterne grandi
                      echo'
                      <div class="col-4 MainCollons">
                      <a  href="Salonview.php?Salonview='.$ArrayElements[$NumerOfElements-1].'&Categoryview='.$_GET['CategoryPass'].'">
                          <div class="row RowTitle">
                                <div class=" col ColTitle">
                                  '.$ArrayElements[$NumerOfElements-1].'
                                </div>
                          </div>

                          <div class="row rows">
                              <div class="col colImageContainer">
                              <img class="ImageCategoryDimentions" src="https://as2.ftcdn.net/jpg/00/61/20/35/1000_F_61203573_res38pBYqXr7gMdY8btaVuIq5ryyeruL.jpg" alt="NomeCategoria" >
                              </div>
                          </div>
                          </a>
                      </div>
                            ';
                        $NumerOfElements=$NumerOfElements-1;
                    };
        echo '</div>';
        $ModificheFatte=1;
    };
                      
    //una collona
    if ($NumerOfElements%3==1) {
        echo'<div class="row">';//riga esterna
                  for ($u=0;$u<1;$u++) {//faccio 3 collone esterne grandi
                    echo'
                    <div class="col-4 MainCollons">
                    <a  href="Salonview.php?Salonview='.$ArrayElements[$NumerOfElements-1].'&Categoryview='.$_GET['CategoryPass'].'">
                        <div class="row RowTitle">
                              <div class=" col ColTitle">
                                '.$ArrayElements[$NumerOfElements-1].'
                              </div>
                        </div>

                        <div class="row rows">
                            <div class="col colImageContainer">
                            <img class="ImageCategoryDimentions" src="https://as2.ftcdn.net/jpg/00/61/20/35/1000_F_61203573_res38pBYqXr7gMdY8btaVuIq5ryyeruL.jpg" alt="NomeCategoria" >
                            </div>
                        </div>
                        </a>
                    </div>
                          ';
                      $NumerOfElements=$NumerOfElements-1;
                  };
        echo '</div>';
        $ModificheFatte=1;
    }

    //3 collone

    if ($NumerOfElements%3==0 && $ModificheFatte==0) {//scrittura dell'ultima riga
            echo'<div class="row">';//riga esterna
          for ($u=0;$u<3;$u++) {//faccio 3 collone esterne grandi
            echo'
                        <div class="col-4 MainCollons">
                        <a  href="Salonview.php?Salonview='.$ArrayElements[$NumerOfElements-1].'&Categoryview='.$_GET['CategoryPass'].'">
                            <div class="row RowTitle">
                                  <div class=" col ColTitle">
                                    '.$ArrayElements[$NumerOfElements-1].'
                                  </div>
                            </div>

                            <div class="row rows">
                                <div class="col colImageContainer">
                                <img class="ImageCategoryDimentions" src="https://as2.ftcdn.net/jpg/00/61/20/35/1000_F_61203573_res38pBYqXr7gMdY8btaVuIq5ryyeruL.jpg" alt="NomeCategoria" >
                                </div>
                            </div>
                            </a>
                        </div>
                              ';
              $NumerOfElements=$NumerOfElements-1;
          };
        echo '</div>';
    }
} else {
    echo '<h1 id="HomePageCategories">No salon has this category yet</h1>';
}
    echo '<br>';*/
  ?>

  </body>
</html>







