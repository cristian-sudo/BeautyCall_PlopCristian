<?php
require('/Applications/XAMPP/xamppfiles/htdocs/EZCUT/User/GettingInformationsUser.php');
?>

<div class="container-fluid">
  <div class="row HeaderRow">
    <div id="Logo"class="col-1">
      <a id="Logo"href="/EZCUT/User/HomePage.php">EZCUT</a>
    </div>


    

    <div  class="col-3 coll">
            <div class="dropdown">
            <a class="btn btn-secondary dropdown-toggle HeaderElement" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Products Categories
             </a>
             <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <?php
                        require('/Applications/XAMPP/xamppfiles/htdocs/EZCUT/User/GettingProductCategories.php');
                        foreach ($resultCategories as $key2 => $value2) {
                            echo '<a class="dropdown-item" href="/EZCUT/Salon/ManageOpeningTime.php">' . $value2['ProductCategoryName'] . '</a>';
                        }
                        ?>
                      </div>
      </div>
    </div>

    <div  class="col-2 coll">
            <div class="dropdown">
            <a class="btn btn-secondary dropdown-toggle HeaderElement" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Bookings
             </a>
             <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <?php
                        require('/Applications/XAMPP/xamppfiles/htdocs/EZCUT/User/GettingCategories.php');
                        foreach ($resultCategories as $key2 => $value2) {
                            echo '<a class="dropdown-item" href="/EZCUT/Salon/ManageOpeningTime.php">' . $value2['ServiceCategoryName'] . '</a>';
                        }
                        ?>
                      </div>
      </div>
    </div>

            <div class="col-4 coll">
     
            </div>

    <div  class="col-2 coll">
            <div class="dropdown">
            <a class="btn btn-secondary dropdown-toggle HeaderElement" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Account
             </a>
             <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
             <a class="dropdown-item" href="/EZCUT/User/Logout.php">Account informations</a> 
             <a class="dropdown-item" href="/EZCUT/User/Logout.php">History</a>   
             <a class="dropdown-item" href="/EZCUT/User/Logout.php">Logout</a>   
              </div>
      </div>
    </div>

</div>
    </div>
    <div class="advL">
  adv
</div>

<div class="advR">
  adv
</div>
  </body>
  </html>
