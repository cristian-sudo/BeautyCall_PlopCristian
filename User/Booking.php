<html>
    <head>
    </head>
    <body>
        <?php
        require('/Applications/XAMPP/xamppfiles/htdocs/EZCUT/header.php');
        print_r($_SESSION);
       
        print_r($_POST);
        
        print_r($_GET);
//getting SalonID
$SalonID;
$stmt = $dbh->getInstance()->prepare("SELECT SalonID FROM hairdressingsalons
         WHERE Name =:SalonName");
 $stmt->bindParam(':SalonName', $SalonName);
 $SalonName = $_GET['Salonview'];
 $stmt->execute();
 $row = $stmt->fetch();
 if($row){//if isset on administrator
    $SalonID= $row['SalonID']; 
     }
///
///Getting ServiceID
$BeginTimeGiven=date($_POST['InsertBeginTime'].":00");
print_r($BeginTimeGiven);
$BeginTimeGivenInSeconds=strtotime($BeginTimeGiven);
$ServiceID;
$TimeDurationHours;
$TimeDurationMinutes;
$stmt = $dbh->getInstance()->prepare("SELECT ServiceID,TimeDurationHours,TimeDurationMinutes FROM services
         WHERE ServiceName =:ServiceName");
 $stmt->bindParam(':ServiceName', $ServiceName);
 $ServiceName = $_GET['ServicePass'];
 $stmt->execute();
 $row = $stmt->fetch();
 if($row){//if isset on administrator
    $ServiceIDFind= $row['ServiceID']; 
    $TimeDurationHours= $row['TimeDurationHours']; 
    $TimeDurationMinutes= $row['TimeDurationMinutes']; 
     }
     $TotalMinutes=($TimeDurationHours*60)+$TimeDurationMinutes;
     $BeginTimeGivenInSeconds=$BeginTimeGivenInSeconds+($TotalMinutes*60);
     $FinishTimeToPut=date("H:i:s",$BeginTimeGivenInSeconds);
     



$stmt = $dbh->getInstance()->prepare("INSERT INTO bookings (BeginTime,Date,BookingStatus,SalonID,ServiceID,UserID,FinishTime,StaffID)
VALUES (:BeginTime,:Date,:BookingStatus,:SalonID,:ServiceID,:UserID,:FinishTime,:StaffID)");
$stmt->bindParam(':BeginTime', $BeginTime);
$stmt->bindParam(':Date', $Date);
$stmt->bindParam(':BookingStatus', $BookingStatus);
$stmt->bindParam(':SalonID', $SalonID);
$stmt->bindParam(':ServiceID', $ServiceID);
$stmt->bindParam(':UserID', $UserID);
$stmt->bindParam(':FinishTime', $FinishTime);
$stmt->bindParam(':StaffID', $StaffID);

echo '<br>'.$BeginTime = $_POST['InsertBeginTime'].":00";
echo '<br>'.$Date = $_POST['Date'];
echo '<br>'.$BookingStatus = "Booked";
echo '<br>'.$UserID = $_SESSION['UserID'];
echo '<br>'.$StaffID = $_POST['StaffID'];
echo '<br>'.$SalonID = $SalonID;
echo '<br>'.$ServiceID = $ServiceIDFind;
echo '<br>'.$FinishTime = $FinishTimeToPut;
$stmt->execute();
header('Location: BookingsView.php');
exit;    
        ?>
    </body>
</html>