
    <?php
    require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/User/UserMenu.php');
    ?>
    <section class="py-5 bg-light">
            <div class="container">
                <h2 id="HomePageCategories">Main Categories</h2>
                <form class="form-inline">
                          <div class="Center">
                         <input class="form-control mr-sm-2" type="search" placeholder="Search in categories" aria-label="Search">
                     <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </div>
                </form>

                <div class="row">
<?php 
 require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/User/GettingCategories.php');
while ($row = $resultCategories->fetch()) {
echo '
<div class="col-lg-4 col-sm-12 mb-4">
<a href="/EZCUT/User/CategorySalons.php?CategoryPass='.$row['ServiceCategoryName'].'">
                        <div class="card h-100">
                            <img class="card-img-top" src="/EZCUT/Images/ServiceCategoryImages/'.$row['ImageName'].'" alt="..." />
                            <div class="card-body">
                                <h4 class="card-title">'.$row['ServiceCategoryName'].'</h4>
                                
                            </div>
                        </div>
                        </a>
                    </div>
';

}?>
</div>
</div>
</section>
  </body>
</html>
