<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">
    .zui-table {
  border: solid 1px #DDEEEE;
  border-collapse: collapse;
  border-spacing: 0;
  font: normal 13px Arial, sans-serif;
}
.zui-table thead th {
  background-color: #DDEFEF;
  border: solid 1px #DDEEEE;
  color: #336B6B;
  padding: 10px;
  text-align: left;
  text-shadow: 1px 1px 1px #fff;
}
.zui-table tbody td {
  border: solid 1px #DDEEEE;
  color: #333;
  padding: 10px;
  text-shadow: 1px 1px 1px #fff;
}
    </style>
  </head>
  <body>
    <?php
    require('/Applications/XAMPP/xamppfiles/htdocs/EZCUT/Salon/Menu.php');
    $stmt = $dbh->getInstance()->prepare("
    SELECT
        bookings.BookingID,
        Services.ServiceName,
        ServiceCategories.ServiceCategoryName,
        Services.Price,
        bookings.BeginDateTime,
        Services.TimeDurationHours,
        Services.TimeDurationMinutes,
        Users.Name,
        Users.Surname,
        Users.Email,
        Users.PhoneNumber,
        bookings.BookingStatus
    FROM
    bookings
INNER JOIN services ON bookings.ServiceID = services.ServiceID
INNER JOIN users ON bookings.UserID = users.UserID
INNER JOIN hairdressingsalons ON bookings.SalonID = hairdressingsalons.SalonID
INNER JOIN servicecategories ON services.ServiceCategoryID = servicecategories.ServiceCategoryID
    WHERE hairdressingsalons.Name='".$_SESSION['SalonName']."' ORDER BY bookings.BookingStatus DESC
 ");
    $stmt->execute();
    $row=$stmt;
///////////////////////////////////////////////////////////////////////////////////////

   if ($row) {
      echo "
    <form method='post' action='ConfirmBookings.php'>
    <table class='zui-table'><tr>
    <th>BookingID</th>
    <th>ServiceName</th>
    <th>ServiceCategory</th>
    <th>Price</th>
    <th>Date</th>
    <th>Duratio(Hours)</th>
    <th>Duratio(Minutes)</th>
    <th>User's Name</th>
    <th>User's Surname</th>
    <th>User's Email</th>
    <th>User's Phone Number</th>
    <th>Booking Status</th>
  </tr>";
      foreach ($row as $key => $value) {
        echo "<tr>";
        echo "<td>".$value['BookingID']."</td>";
        echo "<td>".$value['ServiceName']."</td>";
        echo "<td>".$value['ServiceCategoryName']."</td>";
        echo "<td>".$value['Price']."</td>";
        echo "<td>".$value['BeginDateTime']."</td>";
        echo "<td>".$value['TimeDurationHours']."Hrs</td>";
        echo "<td>".$value['TimeDurationMinutes']."Min</td>";
        echo "<td>".$value['Name']."</td>";
        echo "<td>".$value['Surname']."</td>";
        echo "<td>".$value['Email']."</td>";
        echo "<td>".$value['PhoneNumber']."</td>";
        echo "<td>".$value['BookingStatus']."</td>";
        if (strcmp($value['BookingStatus'], "Confirmed") != 0) {
          echo '<td><input type="checkbox" name ="'.$value['BookingID'] . '" value="cb"></td></tr>';
        }
      echo "</tr>";}
      echo "</table>";
      echo '<input type="submit" value="Confirm selected bookings">';
      echo '</form>';
}
     ?>
  </body>
</html>
