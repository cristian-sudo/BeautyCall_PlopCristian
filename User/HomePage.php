
    <?php
    require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/User/UserMenu.php');
    ?>
    <h1 id="HomePageCategories">Main Categories</h1>
    <br>


<div class="container-fluid centralContent">

<?php require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/User/GettingCategories.php');
$NumerOfElements=0;
$ArrayElements;
$indice=0;
while ($row = $resultCategories->fetch()) {
    $ArrayElements[$indice]=$row['ServiceCategoryName'];
    $ArrayElementsPhoto[$indice]=$row['ImageName'];
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
                        <div class="col MainCollons col-xs-12">
                        <a  href="CategorySalons.php?CategoryPass='.$ArrayElements[$NumerOfElements-1].'">
                            <div class="row RowTitle">
                                  <div class=" col ColTitle">
                                    '.$ArrayElements[$NumerOfElements-1].'
                                  </div>
                            </div>

                            <div class="row rows">
                                <div class="col colImageContainer">
                                <img class="ImageCategoryDimentions" src="/EZCUT/Images/ServiceCategoryImages/'.$ArrayElementsPhoto[$NumerOfElements-1].'" alt="NomeCategoria" >
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
                    echo'<div class="row ">';//riga esterna
                    for ($u=0;$u<2;$u++) {//faccio 3 collone esterne grandi
                      echo'
                      <div class="col MainCollons col-xs-12">
                      <a  href="CategorySalons.php?CategoryPass='.$ArrayElements[$NumerOfElements-1].'">
                          <div class="row RowTitle">
                                <div class=" col ColTitle">
                                  '.$ArrayElements[$NumerOfElements-1].'
                                </div>
                          </div>

                          <div class="row rows">
                              <div class="col colImageContainer">
                              <img class="ImageCategoryDimentions" src="/EZCUT/Images/ServiceCategoryImages/'.$ArrayElementsPhoto[$NumerOfElements-1].'" alt="NomeCategoria" >
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
                    <div class="col MainCollons col-xs-12">
                    <a  href="CategorySalons.php?CategoryPass='.$ArrayElements[$NumerOfElements-1].'">
                        <div class="row RowTitle">
                              <div class=" col ColTitle">
                                '.$ArrayElements[$NumerOfElements-1].'
                              </div>
                        </div>

                        <div class="row rows">
                            <div class="col colImageContainer">
                            <img class="ImageCategoryDimentions" src="/EZCUT/Images/ServiceCategoryImages/'.$ArrayElementsPhoto[$NumerOfElements-1].'" alt="NomeCategoria" >
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
                        <div class="col MainCollons col-xs-12">
                        <a  href="CategorySalons.php?CategoryPass='.$ArrayElements[$NumerOfElements-1].'">
                            <div class="row RowTitle">
                                  <div class=" col ColTitle">
                                    '.$ArrayElements[$NumerOfElements-1].'
                                  </div>
                            </div>

                            <div class="row rows">
                                <div class="col colImageContainer">
                                <img class="ImageCategoryDimentions" src="/EZCUT/Images/ServiceCategoryImages/'.$ArrayElementsPhoto[$NumerOfElements-1].'" alt="NomeCategoria" >
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
    echo '<h1 id="HomePageCategories">No categories yet</h1>';
}
    echo '<br>';?>

  </body>
</html>
