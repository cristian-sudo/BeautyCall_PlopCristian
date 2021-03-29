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
    <h1 id="HomePageCategories"><?php echo $_GET['CategoryPass'] ?></h1>
    <br>

<div class="advL">
  adv
</div>

<div class="advR">
  adv
</div>

<div class="container-fluid centralContent">

<?php
$GETSalonsCategories = $dbh->getInstance()->prepare('SELECT DISTINCT hairdressingsalons.Name FROM hairdressingsalons
INNER JOIN services ON hairdressingsalons.SalonID=services.SalonID
INNER JOIN servicecategories ON services.ServiceCategoryID=servicecategories.ServiceCategoryID
WHERE servicecategories.ServiceCategoryName="'.$_GET['CategoryPass'].'"
ORDER BY hairdressingsalons.Name DESC ;');//get  salons categories
$GETSalonsCategories->execute();
$resultSalonsCategories=$GETSalonsCategories;
 ?>


<?php
$NumerOfElements=0;
$ArrayElements;
$indice=0;
while ($row = $resultSalonsCategories->fetch()) {
    $ArrayElements[$indice]=$row['Name'];
    $NumerOfElements++;
    $indice++;
}
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
                        <a  href="CategorySalons.php?CategoryPass='.$ArrayElements[$NumerOfElements-1].'">
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
                      <a  href="CategorySalons.php?CategoryPass='.$ArrayElements[$NumerOfElements-1].'">
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
                    <a  href="CategorySalons.php?CategoryPass='.$ArrayElements[$NumerOfElements-1].'">
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
                        <a  href="CategorySalons.php?CategoryPass='.$ArrayElements[$NumerOfElements-1].'">
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
    echo '<br>';
  ?>

  </body>
</html>







