<?php
require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/header.php');
require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/User/GettingInformationsUser.php');
?>
<div class="container-fluid">

<div class="TextDimension">
<nav class="navbar navbar-expand-lg navbar-light bg-light    justify-content-between">

  <a class="nav-link" id="Logo" href="/EZCUT/User/HomePage.php">BeautyCall</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNavDropdown">

    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="Categories.php">Categories <span class="sr-only">(current)</span></a>
      </li>
      
      <li class="nav-item active">
        <a class="nav-link" href="Salons.php">Providers</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#"> </a>
      </li>
</ul>
<ul class="navbar-nav">
      <li class="nav-item dropdown ">
        <a class="nav-link dropdown-toggle navbar-nav" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Account
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="BookingsView.php">Bookings</a> 
                  <a class="dropdown-item" href="PassConfirm.php">Account informations</a> 
                  <a class="dropdown-item" href="/EZCUT/User/Logout.php">Logout</a> 
        </div>
      </li>
      <li>

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
      </li>
    </ul>

  </div>


</nav>
  </div>
</div>
  </body>
  </html>







 