
        <?php
       
       session_start();
       require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/conessione/DBHandler.php');
       require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/conessione/DBHandlerObject.php');
       

       // print_r($_SESSION);
       
       // print_r($_POST);
        
        //print_r($_GET);
//getting ServiceProviderID
$ServiceProviderID;
$stmt = $dbh->getInstance()->prepare("SELECT ServiceProviderID FROM serviceproviders
         WHERE Name =:SalonName");
 $stmt->bindParam(':SalonName', $SalonName);
 $SalonName = $_GET['Salonview'];
 $stmt->execute();
 $row = $stmt->fetch();
 if($row){//if isset on administrator
    $ServiceProviderID= $row['ServiceProviderID']; 
     }
///
///Getting ServiceID
$BeginTimeGiven=date($_POST['InsertBeginTime'].":00");
//print_r($BeginTimeGiven);
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
 if($row){
    $ServiceIDFind= $row['ServiceID']; 
    $TimeDurationHours= $row['TimeDurationHours']; 
    $TimeDurationMinutes= $row['TimeDurationMinutes']; 
     }
     $TotalMinutes=($TimeDurationHours*60)+$TimeDurationMinutes;
     $BeginTimeGivenInSeconds=$BeginTimeGivenInSeconds+($TotalMinutes*60);
     $FinishTimeToPut=date("H:i:s",$BeginTimeGivenInSeconds);
     



$stmt = $dbh->getInstance()->prepare("INSERT INTO bookings (BeginTime,Date,BookingStatus,ServiceProviderID,ServiceID,UserID,FinishTime,StaffID)
VALUES (:BeginTime,:Date,:BookingStatus,:ServiceProviderID,:ServiceID,:UserID,:FinishTime,:StaffID)");
$stmt->bindParam(':BeginTime', $BeginTime);
$stmt->bindParam(':Date', $Date);
$stmt->bindParam(':BookingStatus', $BookingStatus);
$stmt->bindParam(':ServiceProviderID', $ServiceProviderID);
$stmt->bindParam(':ServiceID', $ServiceID);
$stmt->bindParam(':UserID', $UserID);
$stmt->bindParam(':FinishTime', $FinishTime);
$stmt->bindParam(':StaffID', $StaffID);

$BeginTime = $_POST['InsertBeginTime'].":00";
$Date = $_POST['Date'];
$BookingStatus = "Booked";
$UserID = $_SESSION['UserID'];
$StaffID = $_POST['StaffID'];
$ServiceProviderID = $ServiceProviderID;
$ServiceID = $ServiceIDFind;
$FinishTime = $FinishTimeToPut;
$stmt->execute();

header('Location: BookingsView.php');
exit;   
 
        ?>
  