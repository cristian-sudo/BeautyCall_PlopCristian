<?php
require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/Salon/Menu.php');
?>
<div class="row">

<div class="col">
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  Date:
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="Bookings.php?OrderBy=Newer">Newer</a>
    <a class="dropdown-item" href="Bookings.php?OrderBy=Older">Older</a>
  </div>
</div>
</div>


<div class="col">
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  Staff:
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      <!-- get all staff-->
      <?php
      $stmt99 = $dbh->getInstance()->prepare('SELECT Name FROM Staff
      WHERE ServiceProviderID ="'.$_SESSION['ServiceProviderID'].'"
      ORDER BY Name ASC
      ');
          $stmt99->execute();
      while ($row = $stmt99->fetch()) {
echo '
<a class="dropdown-item" href="Bookings.php?OrderBy=Staff&StaffName='.$row['Name'].'">'.$row['Name'].'</a>
';
      }
      ?>

   
  </div>
</div>
</div>

<div class="col">
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  Category:
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
       <!-- get all CategoryName-->
       <?php
      $stmt99 = $dbh->getInstance()->prepare('SELECT ServiceCategoryName FROM servicecategories
      INNER JOIN services ON services.ServiceCategoryID=servicecategories.ServiceCategoryID
      WHERE ServiceProviderID ="'.$_SESSION['ServiceProviderID'].'"
      ORDER BY ServiceCategoryName ASC
      ');
          $stmt99->execute();
      while ($row = $stmt99->fetch()) {
echo '
<a class="dropdown-item" href="Bookings.php?OrderBy=CategoryName&CategoryPass='.$row['ServiceCategoryName'].'">'.$row['ServiceCategoryName'].'</a>
';
      }
      ?>
    
  </div>
</div>
</div>

<div class="col">
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  Service:
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      <!-- get all CategoryName-->
      <?php
      $stmt99 = $dbh->getInstance()->prepare('SELECT ServiceName FROM services
      WHERE ServiceProviderID ="'.$_SESSION['ServiceProviderID'].'"
      ORDER BY ServiceName ASC
      ');
          $stmt99->execute();
      while ($row = $stmt99->fetch()) {
echo '
<a class="dropdown-item" href="Bookings.php?OrderBy=ServiceName&ServicePass='.$row['ServiceName'].'">'.$row['ServiceName'].'</a>
';
      }
      ?>
  </div>
</div>
</div>


<div class="col">
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  Status:
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="Bookings.php?OrderBy=Status&StatusName=Booked">Booked</a>
    <a class="dropdown-item" href="Bookings.php?OrderBy=Status&StatusName=Refused">Refused</a>
    <a class="dropdown-item" href="Bookings.php?OrderBy=Status&StatusName=Finished">Finished</a>
  </div>
</div>



</div>


</div>
<?php

if(!isset($_GET['OrderBy'])){
                                    $stmt5 = $dbh->getInstance()->prepare("SELECT *,users.Name AS UserName,users.Surname AS UserSurname, staff.Name AS StaffName FROM bookings
                                    INNER JOIN users ON bookings.UserID=users.UserID
                                    INNER JOIN services ON bookings.ServiceID=services.ServiceID
                                    INNER JOIN staff ON bookings.StaffID=staff.StaffID
                                    INNER JOIN servicecategories ON services.ServiceCategoryID=servicecategories.ServiceCategoryID
                                    WHERE bookings.ServiceProviderID =:ServiceProviderID
                                    ORDER BY bookings.BookingID DESC
                                    ");
                                    
                                        $stmt5->bindParam(':ServiceProviderID', $ServiceProviderID);
                                        $ServiceProviderID = $_SESSION['ServiceProviderID'];
                                        $stmt5->execute();
                                    $entrato=null;
                                    while ($row = $stmt5->fetch()) {
                                      $entrato=true;
                                    echo '
                                    <div class="card-footer text-muted row">
                                    <div class="col">
                                    ID:&nbsp '.$row['BookingID'].'    <br>
                                        Date:&nbsp '.$row['Date'].'    <br>
                                        Name:&nbsp '.$row['UserName'].'  &nbsp  '.$row['UserSurname'].'   <br>
                                        Category:&nbsp '.$row['ServiceCategoryName'].'    <br>
                                        Service:&nbsp '.$row['ServiceName'].'    <br>
                                        </div>
                                        <div class="col">
                                        Begin Time:&nbsp '.$row['BeginTime'].'    <br>
                                        Finish Time:&nbsp '.$row['FinishTime'].'    <br>
                                        Costumer:&nbsp '.$row['StaffName'].'    <br>
                                        Status:&nbsp '.$row['BookingStatus'].'    <br>

                                    </div>


                                    <div class="col">';
if($row['BookingStatus']=="Booked"){

  echo '
  Actions:

                                        <form action="BookingManage.php" method="post">
                                        <input type="hidden" name="BookingID" value="'.$row['BookingID'].'">
                                        <input type="hidden" name="Action" value="Finished">
                                        <button class="btn btn-primary " name="submit" type="submit">
                                        Mark as finished
                                        </button>
                                        </form>

                                        <form action="BookingManage.php" method="post">
                                        <input type="hidden" name="BookingID" value="'.$row['BookingID'].'">
                                        <input type="hidden" name="Action" value="Refused">
                                        <button class="btn btn-primary " name="submit" type="submit">
                                        Refuse
                                        </button>
                                        
                                        </form>
  
  
  
  ';
}
if($row['BookingStatus']=="Finished"){
echo '<span style="color:green; ">Finished!!</span>';
}
if($row['BookingStatus']=="Refused"){
  echo '<span style="color:red; ">Refused!!</span>';
}

                                     echo '
                                    </div>
                                    </div>
                                    ';


                                    }
                                    if($entrato!=true)
                                    {
                                      echo 'no booking yet';
                                    }
                                    

}else{
    $Valid=null;

if($_GET['OrderBy']=="BookingStatus"){
    $stmt5 = $dbh->getInstance()->prepare("SELECT *,users.Name AS UserName,users.Surname AS UserSurname, staff.Name AS StaffName FROM bookings
    INNER JOIN users ON bookings.UserID=users.UserID
    INNER JOIN services ON bookings.ServiceID=services.ServiceID
    INNER JOIN staff ON bookings.StaffID=staff.StaffID
    INNER JOIN servicecategories ON services.ServiceCategoryID=servicecategories.ServiceCategoryID
    WHERE bookings.ServiceProviderID =:ServiceProviderID
    ORDER BY bookings.".$_GET['OrderBy']." DESC
    ");
        $stmt5->bindParam(':ServiceProviderID', $ServiceProviderID);
        $ServiceProviderID = $_SESSION['ServiceProviderID'];
        $stmt5->execute();
        $Valid=True;
}

if($_GET['OrderBy']=="Older"){
    $stmt5 = $dbh->getInstance()->prepare("SELECT *,users.Name AS UserName,users.Surname AS UserSurname, staff.Name AS StaffName FROM bookings
    INNER JOIN users ON bookings.UserID=users.UserID
    INNER JOIN services ON bookings.ServiceID=services.ServiceID
    INNER JOIN staff ON bookings.StaffID=staff.StaffID
    INNER JOIN servicecategories ON services.ServiceCategoryID=servicecategories.ServiceCategoryID
    WHERE bookings.ServiceProviderID =:ServiceProviderID
    ORDER BY bookings.Date DESC
    ");
        $stmt5->bindParam(':ServiceProviderID', $ServiceProviderID);
        $ServiceProviderID = $_SESSION['ServiceProviderID'];
        $stmt5->execute();
        $Valid=True;
}


if($_GET['OrderBy']=="Newer"){
    $stmt5 = $dbh->getInstance()->prepare("SELECT *,users.Name AS UserName,users.Surname AS UserSurname, staff.Name AS StaffName FROM bookings
    INNER JOIN users ON bookings.UserID=users.UserID
    INNER JOIN services ON bookings.ServiceID=services.ServiceID
    INNER JOIN staff ON bookings.StaffID=staff.StaffID
    INNER JOIN servicecategories ON services.ServiceCategoryID=servicecategories.ServiceCategoryID
    WHERE bookings.ServiceProviderID =:ServiceProviderID
    ORDER BY bookings.Date ASC
    ");
        $stmt5->bindParam(':ServiceProviderID', $ServiceProviderID);
        $ServiceProviderID = $_SESSION['ServiceProviderID'];
        $stmt5->execute();
        $Valid=True;
}



if($_GET['OrderBy']=="Staff" && isset($_GET['StaffName'])){
  $stmt5 = $dbh->getInstance()->prepare('SELECT *,users.Name AS UserName,users.Surname AS UserSurname, staff.Name AS StaffName FROM bookings
  INNER JOIN users ON bookings.UserID=users.UserID
  INNER JOIN services ON bookings.ServiceID=services.ServiceID
  INNER JOIN staff ON bookings.StaffID=staff.StaffID
  INNER JOIN servicecategories ON services.ServiceCategoryID=servicecategories.ServiceCategoryID
  WHERE bookings.ServiceProviderID =:ServiceProviderID
  AND Staff.Name="'.$_GET['StaffName'].'"
  ORDER BY bookings.Date ASC
  ');
      $stmt5->bindParam(':ServiceProviderID', $ServiceProviderID);
      $ServiceProviderID = $_SESSION['ServiceProviderID'];
      $stmt5->execute();
      $Valid=True;
}


if($_GET['OrderBy']=="CategoryName" && isset($_GET['CategoryPass'])){
  $stmt5 = $dbh->getInstance()->prepare('SELECT *,users.Name AS UserName,users.Surname AS UserSurname, staff.Name AS StaffName FROM bookings
  INNER JOIN users ON bookings.UserID=users.UserID
  INNER JOIN services ON bookings.ServiceID=services.ServiceID
  INNER JOIN staff ON bookings.StaffID=staff.StaffID
  INNER JOIN servicecategories ON services.ServiceCategoryID=servicecategories.ServiceCategoryID
  WHERE bookings.ServiceProviderID =:ServiceProviderID
  AND servicecategories.ServiceCategoryName="'.$_GET['CategoryPass'].'"
  ORDER BY bookings.Date ASC
  ');
      $stmt5->bindParam(':ServiceProviderID', $ServiceProviderID);
      $ServiceProviderID = $_SESSION['ServiceProviderID'];
      $stmt5->execute();
      $Valid=True;
}


if($_GET['OrderBy']=="ServiceName" && isset($_GET['ServicePass'])){
  $stmt5 = $dbh->getInstance()->prepare('SELECT *,users.Name AS UserName,users.Surname AS UserSurname, staff.Name AS StaffName FROM bookings
  INNER JOIN users ON bookings.UserID=users.UserID
  INNER JOIN services ON bookings.ServiceID=services.ServiceID
  INNER JOIN staff ON bookings.StaffID=staff.StaffID
  INNER JOIN servicecategories ON services.ServiceCategoryID=servicecategories.ServiceCategoryID
  WHERE bookings.ServiceProviderID =:ServiceProviderID
  AND services.ServiceName="'.$_GET['ServicePass'].'"
  ORDER BY services.ServiceName ASC
  ');
      $stmt5->bindParam(':ServiceProviderID', $ServiceProviderID);
      $ServiceProviderID = $_SESSION['ServiceProviderID'];
      $stmt5->execute();
      $Valid=True;
}


if($_GET['OrderBy']=="Status" && isset($_GET['StatusName'])){
  $stmt5 = $dbh->getInstance()->prepare('SELECT *,users.Name AS UserName,users.Surname AS UserSurname, staff.Name AS StaffName FROM bookings
  INNER JOIN users ON bookings.UserID=users.UserID
  INNER JOIN services ON bookings.ServiceID=services.ServiceID
  INNER JOIN staff ON bookings.StaffID=staff.StaffID
  INNER JOIN servicecategories ON services.ServiceCategoryID=servicecategories.ServiceCategoryID
  WHERE bookings.ServiceProviderID =:ServiceProviderID
  AND Bookings.BookingStatus="'.$_GET['StatusName'].'"
  ORDER BY bookings.BeginTime ASC
  ');
      $stmt5->bindParam(':ServiceProviderID', $ServiceProviderID);
      $ServiceProviderID = $_SESSION['ServiceProviderID'];
      $stmt5->execute();
      $Valid=True;
}











if($Valid==True){
    $entrato=null;
    while ($row = $stmt5->fetch()) {
$entrato=true;


echo '
<div class="card-footer text-muted row">
    <div class="col">
    ID:&nbsp '.$row['BookingID'].'    <br>
        Date:&nbsp '.$row['Date'].'    <br>
        Name:&nbsp '.$row['UserName'].'  &nbsp  '.$row['UserSurname'].'   <br>
        Category:&nbsp '.$row['ServiceCategoryName'].'    <br>
        Service:&nbsp '.$row['ServiceName'].'    <br>
        </div>
        <div class="col">
        Begin Time:&nbsp '.$row['BeginTime'].'    <br>
        Finish Time:&nbsp '.$row['FinishTime'].'    <br>
        Costumer:&nbsp '.$row['StaffName'].'    <br>
        Status:&nbsp '.$row['BookingStatus'].'    <br>

    </div>
   
    
    <div class="col">
        Actions:

        <form action="" method="post">
        <input type="submit" value="Mark as finished"></input>
        </form>

        <form action="" method="post">
        <input type="submit" value="Refuse booking"></input>
        </form>

        <form action="" method="post">
        <input type="submit" value="Contact the client"></input>
        </form>

    </div>

</div>

';

    }

if($entrato!=true){
 
  echo 'no booking yet';
}
}else{
    echo'order by not valid';
}
}


















?>
                   





</body>
</html>