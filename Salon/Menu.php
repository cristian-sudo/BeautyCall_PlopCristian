
<!DOCTYPE html>
<html>
<head>
<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 7px 6px;
  text-decoration: none;
}

li a:hover:not(.active) {
  background-color: #111;
}

.active {
  background-color: #4CAF50;
}
</style>
</head>
<body>
<h1><?php
require('/Applications/XAMPP/xamppfiles/htdocs/EZCUT/Salon/GettingInformationsSalon.php');
 echo $_SESSION['SalonName'] ?></h1>
<ul>
  <li><a href="/EZCUT/Salon/HomePageSalon.php">Home</a></li>
  <li><a href="/EZCUT/Salon/OpeningTime.php">Opening Times</a></li>
  <li><a href="/EZCUT/Salon/Bookings.php">Bookings</a></li>
  <li><a href="/EZCUT/Salon/ManageServices.php">Manage Services</a></li>
  <li><a href="/EZCUT/Salon/ManageServiceCategory.php">Manage Service Categories</a></li>
  <li><a href="/EZCUT/Salon/AddEvent.php">Add Event</a></li>
  <li><a href="/EZCUT/Salon/ManageAdministratorAccount.php">Manage administrator account</a></li>
  <li><a href="/EZCUT/Salon/ManageHairdressSalon.php">Manage hairdress salon</a></li>
  <li><a href="/EZCUT/Salon/Products.php">Products</a></li>
  <li style="float:right"><a class="active" href="/EZCUT/User/Logout.php">Logout</a></li>
</ul>
</body>
</html>
