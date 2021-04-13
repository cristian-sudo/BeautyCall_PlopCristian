
     <?php
     require('/Applications/XAMPP/xamppfiles/htdocs/EZCUT/User/UserMenu.php');


     $stmt1 = $dbh->getInstance()->prepare("SELECT BookingID,Date,BeginTime,FinishTime,hairdressingsalons.Name AS SalonName,ServiceName,staff.Name AS StaffName FROM bookings
     INNER JOIN hairdressingsalons ON bookings.SalonID=hairdressingsalons.SalonID
     INNER JOIN services ON bookings.ServiceID=services.ServiceID
     INNER JOIN Staff ON bookings.StaffID=Staff.StaffID
     WHERE bookings.UserID =:UserID");
         $stmt1->bindParam(':UserID', $UserID);
         $UserID = $_SESSION['UserID'];
         $stmt1->execute();
         while ($row = $stmt1->fetch()) {
             echo'
<div class="row">
<div class="col border">'.$row['BookingID'].'</div>
<div class="col border">'.$row['Date'].'</div>
<div class="col border">'.$row['BeginTime'].'</div>
<div class="col border">'.$row['FinishTime'].'</div>
<div class="col border">'.$row['SalonName'].'</div>
<div class="col border">'.$row['ServiceName'].'</div>
<div class="col border">'.$row['StaffName'].'</div>

</div>



             ';
         }
     ?>   
    </body>
</html>