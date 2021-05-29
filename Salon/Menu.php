<?php
require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/Salon/GettingInformationsSalon.php');
?>
<div class="container-fluid">
<div class="TextDimension">
<nav class="navbar navbar-expand-lg navbar-light bg-light    justify-content-between">
  <a class="nav-link" id="Logo" href="HomePageSalon.php"><?php echo $_SESSION['SalonName'];?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="Clients.php">Clients <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="Bookings.php">Bookings</a>
      </li>
</ul>
<ul class="navbar-nav">
      <li class="nav-item dropdown ">
        <a class="nav-link dropdown-toggle navbar-nav" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          MyCompany
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="StaffManage.php">Staffs</a> 
                  <a class="dropdown-item" href="ManageOpeningTime.php">Opening Times</a> 
                  <a class="dropdown-item" href="ManageServices.php">Services</a>
                  <a class="dropdown-item" href="ManageSalonInformations.php">Salon Informations</a>
                  <a class="dropdown-item" href="/EZCUT/User/Logout.php">Logout</a>
        </div>
      </li>
      <li>
<?php
$stmt = $dbh->getInstance()->prepare("SELECT administratorImage FROM administrators
WHERE AdministratorID =:AdministratorID");
$stmt->bindParam(':AdministratorID', $AdministratorID);
$AdministratorID = $_SESSION['AdministratorID'];
$stmt->execute();
$row = $stmt->fetch();
if($row){
      if($row['administratorImage']!=null){
        $_SESSION['administratorImage'] = $row['administratorImage'];
        echo '<img  src="/EZCUT/Images/AdministratorImages/'.$_SESSION['administratorImage'].'" class="rounded-circle" alt="Profile Image"> ';
      }else{
        $_SESSION['administratorImage'] = null;
        echo '<img  src="/EZCUT/Images/DefaultProfileImage.jpeg'.'" class="rounded-circle" alt="Profile Image"> ';
      }    
    }  
?>
          </div>
      </li>
    </ul>

  </div>
</nav>
  </div>
</div>
 



































