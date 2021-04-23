<?php
require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/User/GettingInformationsUser.php');
?>
<div class="container-fluid">

  <div class="row HeaderRow">
          <div id="Logo"class="col-1 coll">
            <a id="Logo" href="/EZCUT/User/HomePage.php">EZCUT</a>
          </div>

          <div  class="col-3 coll">
                  <div class="dropdown coll">
                  <a class="btn btn-secondary dropdown-toggle HeaderElement" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Products Categories
                  </a>

                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                              <?php
                              require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/User/GettingProductCategories.php');
                              foreach ($resultCategories as $key2 => $value2) {
                                  echo '<a class="dropdown-item" href="/EZCUT/Salon/ManageOpeningTime.php">' . $value2['ProductCategoryName'] . '</a>';
                              }
                              ?>
                            </div>
            </div>
          </div>

          

                  <div class="col-5 coll">
          
                  </div>

          <div  class="col-2 coll">
                  <div class="dropdown">
                  <a class="btn btn-secondary dropdown-toggle HeaderElement2" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Account
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <a class="dropdown-item" href="BookingsView.php">Bookings</a> 
                  <a class="dropdown-item" href="PassConfirm.php">Account informations</a> 
                  <a class="dropdown-item" href="">History</a>   
                  <a class="dropdown-item" href="/EZCUT/User/Logout.php">Logout</a>    
                    </div>
            </div>
          </div>

          <div class="col-1 ProfileImage coll">
<?php
$stmt = $dbh->getInstance()->prepare("SELECT UserImageName FROM Users
WHERE UserID =:UserID");
$stmt->bindParam(':UserID', $UserID);
$UserID = $_SESSION['UserID'];
$stmt->execute();
$row = $stmt->fetch();
if($row){
      if($row['UserImageName']!=null){
        $_SESSION['ProfileImagine'] = $row['UserImageName'];
        echo '<img  src="/EZCUT/Images/UserImages/'.$_SESSION['ProfileImagine'].'" class="rounded-circle" alt="Profile Image"> ';
      }else{
        $_SESSION['ProfileImagine'] = null;
        echo '<img  src="/EZCUT/Images/DefaultProfileImage.jpeg'.'" class="rounded-circle" alt="Profile Image"> ';
      }    
    }
      
    
    
?>


          </div>



</div>
    </div>

    
 
  </body>
  </html>
