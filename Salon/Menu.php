<?php
require('/Applications/XAMPP/xamppfiles/htdocs/EZCUT/Salon/GettingInformationsSalon.php');
echo'
<div class="container-fluid">
<div class="row HeaderRow">

<div class="col-1">
<a class="navbar-brand" id="logo" href="/EZCUT/Salon/HomePageSalon.php">'.$_SESSION['SalonName'].'</a>
</div>

<div class="col-3">
    <!-- Dropdown -->
    <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Managements</a>
              <div class="dropdown-menu">
              <a class="dropdown-item" href="/EZCUT/Salon/ManageOpeningTime.php">Opening Times</a>
              <a class="dropdown-item" href="/EZCUT/Salon/ManageBookings.php">Bookings</a>
              <a class="dropdown-item" href="/EZCUT/Salon/ManageServices.php">Manage Services</a>
              <a class="dropdown-item" href="/EZCUT/Salon/AddEvent.php">Add Event</a>
              <a class="dropdown-item" href="/EZCUT/Salon/ManageAdministratorAccount.php">Manage administrator account</a>
              <a class="dropdown-item" href="/EZCUT/Salon/ManageHairdressSalon.php">Manage hairdress salon</a>
              <a class="dropdown-item" href="/EZCUT/Salon/ManageProducts.php">Products</a>
              </div>
    </li>
</div>


<div class="col-7">

</div>


<div class="col-1">
<a class="navbar-brand" id="logout" href="/EZCUT/User/Logout.php">Logout</a>
</div>

</div>
</div>
  </body>
  </html>
'?>
