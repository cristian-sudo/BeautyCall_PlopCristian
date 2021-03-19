<?php
require('/Applications/XAMPP/xamppfiles/htdocs/EZCUT/Salon/GettingInformationsSalon.php');
echo'
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" id="logo" href="/EZCUT/Salon/HomePageSalon.php">'.$_SESSION['SalonName'].'</a>
    <!-- Dropdown -->
    <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Managements</a>
              <div class="dropdown-menu">
              <a class="dropdown-item" href="/EZCUT/Salon/ManageOpeningTime.php">Opening Times</a>
              <a class="dropdown-item" href="/EZCUT/Salon/ManageBookings.php">Bookings</a>
              <a class="dropdown-item" href="/EZCUT/Salon/ManageServices.php">Manage Services</a>
              <a class="dropdown-item" href="/EZCUT/Salon/ManageServiceCategory.php">Manage Service Categories</a>
              <a class="dropdown-item" href="/EZCUT/Salon/AddEvent.php">Add Event</a>
              <a class="dropdown-item" href="/EZCUT/Salon/ManageAdministratorAccount.php">Manage administrator account</a>
              <a class="dropdown-item" href="/EZCUT/Salon/ManageHairdressSalon.php">Manage hairdress salon</a>
              <a class="dropdown-item" href="/EZCUT/Salon/ManageProducts.php">Products</a>
              </div>
    </li>
    <a class="navbar-brand" id="logout" href="/EZCUT/User/Logout.php">Logout</a>
  </ul>
</nav>
<br>
  </body>
  </html>
'?>
