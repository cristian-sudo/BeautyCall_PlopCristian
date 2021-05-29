<?php
require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/Salon/Menu.php');
?>
  <div class="row">
                    <div class="col-lg-8 mb-4">
                        <iframe style="width: 100%; height: 650px; border: 0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBv8MQOQ5LKn7PPzSVQcvJK2XSjTgFjEkc&amp;q=<?php echo $_SESSION['SalonCity'].' '.$_SESSION['SalonAddress'] ?> "></iframe>   
                       </div>


                          <div class="col-lg-4 mb-4">
                        <div class="card h-90">
<?php
$GETSalonImage = $dbh->getInstance()->prepare('SELECT ImageName FROM serviceproviderimages 
WHERE ServiceProviderID="'.$_SESSION['ServiceProviderID'].'" LIMIT 1');
$GETSalonImage->execute();
$result=$GETSalonImage;
$row6=$result->fetch();
if(isset($row6['ImageName'])){
echo'
  <div class="col-lg-6">
    <img style="height: 300px; width: 425px;"  class="card-img-top" src="/EZCUT/Images/SalonImages/'.$row6['ImageName'].'" alt="..." /> 
    ';
    echo '
</div>';}
?>

                            <div class="card-body">
                                <h4 class="card-title"><a href="#!">Informtions:</a></h4>
                                <p class="card-text">
                                    Country:  <?php echo $_SESSION['SalonCountry']; ?> <br>
                                    Postal Code:       <?php echo $_SESSION['SalonPostalCode']; ?> <br>
                                    Address:  <?php echo $_SESSION['SalonAddress']; ?>  <br>
                                    Phone:<?php echo $_SESSION['SalonPhoneNumber']; ?><br>
                                    Email:<?php echo $_SESSION['SalonEmail']; ?>
                            </p>
                            </div>
                        </div>
        </div>
  </body>
</html>
