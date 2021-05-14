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
    <a class="dropdown-item" href="Bookings.php?OrderBy=Staff?StaffName='.$.'">'.$.'</a>
   
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
       <a class="dropdown-item" href="Bookings.php?OrderBy=CategoryName?CategoryPass='.$.'">'.$.'</a>
    
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
      <a class="dropdown-item" href="Bookings.php?OrderBy=ServiceName?ServicePass='.$.'">'.$.'</a>
  </div>
</div>
</div>


<div class="col">
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  Status:
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="Bookings.php?OrderBy=Booked">Booked</a>
    <a class="dropdown-item" href="Bookings.php?OrderBy=Booked">Finished</a>
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
                                    $Control=$stmt5->fetch();
                                    if($Control!=null){
                                    while ($row = $stmt5->fetch()) {
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
                                    }else{
                                    echo 'No bookings yet.';
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






















if($Valid==True){
    $Control=$stmt5->fetch();
    if($Control!=null){
    while ($row = $stmt5->fetch()) {



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
}else{
    echo 'No bookings yet.';
}
}else{
    echo'order by not valid';
}
}


















?>
                   





</body>
</html>