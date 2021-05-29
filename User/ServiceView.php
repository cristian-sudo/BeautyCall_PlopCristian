
   <?php
    /*
Main variables
$TotalMinutesNeeded(minutes needed for this service)
$BookingsArray(a matrix containing all the booking in a specific day for a specific Staff)
$AllStaffID(all the id of the stafs that is in this salon)
$StaffIDBookingPerDate(contains for each Staff his booking for a specific day)
|StaffID|IntervalNr|BeginTime|FinishTime|
*/
    require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/User/UserMenu.php');
    if(!isset($_POST['Confirm'])){
    echo '
    <section class="py-5">
    <div class="container">
        <!-- Page Heading/Breadcrumbs-->
        <h1>
        '.$_GET['Salonview'].':'.$_GET['ServicePass'].'
        </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/EZCUT/User/DateSelector.php?ServicePass='.$_GET['ServicePass'].'&Salonview='.$_GET['Salonview'].'&Categoryview='.$_GET['Categoryview'].'">Change Dates</a></li>
            <li class="breadcrumb-item active">Chose the Staff</li>
        </ol>






     ';
     if (isset($_POST['date'])) {
         //getting the time needed for this service
         $stmt = $dbh->getInstance()->prepare("SELECT services.TimeDurationHours,services.TimeDurationMinutes FROM services
    INNER JOIN serviceproviders on services.ServiceProviderID=serviceproviders.ServiceProviderID
    WHERE services.ServiceName = :ServiceName and serviceproviders.Name=:SalonName");
         $stmt->bindParam(':ServiceName', $ServiceName);
         $stmt->bindParam(':SalonName', $SalonName);
         $ServiceName = $_GET['ServicePass'];
         $SalonName = $_GET['Salonview'];
         $stmt->execute();
         $row = $stmt->fetch();
         $ServiceTimeRequiredHours=0;
         $ServiceTimeRequiredMinutes=0;
         if ($row) {
             $ServiceTimeRequiredHours=$row['TimeDurationHours'];
             $ServiceTimeRequiredMinutes=$row['TimeDurationMinutes'];
         }
         $TotalMinutesNeeded=0;
         $TotalMinutesNeeded=($ServiceTimeRequiredHours*60)+$ServiceTimeRequiredMinutes;

         //getting all the staff fot the salon
         $stmt1 = $dbh->getInstance()->prepare("SELECT Staffs.StaffID FROM Staffs
   INNER JOIN serviceproviders ON Staffs.ServiceProviderID=serviceproviders.ServiceProviderID
   WHERE serviceproviders.Name =:SalonName");
         $stmt1->bindParam(':SalonName', $SalonName);
         $SalonName = $_GET['Salonview'];
         $stmt1->execute();
         $AllStaffID=null;
         $indice=0;
         $found=false;
         while ($row = $stmt1->fetch()) {
             $AllStaffID[$indice]=$row['StaffID'];
             $indice++;
         }
         if ($AllStaffID) {

   //getting all the bookings from given date and for the single staff
             //i need to create an associativ array for every staff
             //print_r($AllStaffID);
             $StaffIDBookingPerDate=null;
             $ScorrimentoY=0;
             for ($External=0;$External<count($AllStaffID);$External++) {
                 $IndiceIntervallo=0;
                 $stmt1 = $dbh->getInstance()->prepare("SELECT bookings.BeginTime, bookings.FinishTime FROM bookings
            INNER JOIN serviceproviders ON bookings.ServiceProviderID=serviceproviders.ServiceProviderID
            WHERE serviceproviders.Name =:SalonName
            AND bookings.Date=:today
            AND bookings.StaffID=:StaffID
            ORDER BY bookings.BeginTime ASC");

                 $stmt1->bindParam(':SalonName', $SalonName);
                 $stmt1->bindParam(':today', $today);
                 $stmt1->bindParam(':StaffID', $StaffID);
                 $SalonName = $_GET['Salonview'];
                 $today=$_POST['date'];
                 $StaffID=$AllStaffID[$External];
                 $stmt1->execute();
                 $BookingsArray=null;
                 $indiceX=0;
                 $indiceY=0;
                 $found=false;
                 while ($row = $stmt1->fetch()) {
                     $BookingsArray[$indiceX][$indiceY]=new DateTime($row['BeginTime']);
                     $BookingsArray[$indiceX][$indiceY+1]=new DateTime($row['FinishTime']);
                     $indiceX++;
                 }


                 if ($BookingsArray!=null) {//se ci sono appuntamenti nel primo giorno devo crearmi gli intervalli di disponibilità
                     $BookingsArrayLastX=0;
                     $BookingsArrayLastY=0;
                     //ho controlato se ci sta tra le ore 7 e il primo appuntamento
                     $Seven=new DateTime('07:00:00');
                     $result = $BookingsArray[$BookingsArrayLastX][$BookingsArrayLastY]->diff($Seven);
                     $BookingsArrayLastX;
                     $BookingsArrayLastY;
                     $resultH=$result->format('%H:');
                     $resultM=$result->format('%I:');
                     $insertQuestion=null;
                     $resultTotalMinutes=(intval($resultH)*60)+intval($resultM);
                     if ($resultTotalMinutes>=$TotalMinutesNeeded) {
                         $FoundDateLast = $BookingsArray[$BookingsArrayLastX][$BookingsArrayLastY]->format('H:i:s');
                         //save first interval
                         $StaffIDBookingPerDate[$ScorrimentoY][0]=strval($AllStaffID[$External]);
                         $StaffIDBookingPerDate[$ScorrimentoY][1]=strval($IndiceIntervallo);
                         $StaffIDBookingPerDate[$ScorrimentoY][2]="07:00:00";
                         //ho tutto in secondi
                         $finishTimeInSeconds=strtotime($BookingsArray[$BookingsArrayLastX][$BookingsArrayLastY]->format('H:i:s'));
                         $finishTimeInSeconds=$finishTimeInSeconds-(intval($TotalMinutesNeeded)*60);
                         $dataDaInserire=date("H:i:s", $finishTimeInSeconds);
                         //
                         $StaffIDBookingPerDate[$ScorrimentoY][3]=$dataDaInserire;
                         $insertQuestion=true;
                         $ScorrimentoY++;
                         $IndiceIntervallo++;
                     }

                    
                     for ($i=0;$i<count($BookingsArray)-1;$i++) {//se non ci sta parto dal promo appuntamento e calcolo gli intervalli successivi
                            $result=$BookingsArray[$i+1][$BookingsArrayLastY]->diff($BookingsArray[$i][$BookingsArrayLastY+1]);//la differenza tra l'inizio del secondo e la fine del 1
                            $resultH=$result->format('%H:');
                         $resultM=$result->format('%I:');
                         $resultTotalMinutes=(intval($resultH)*60)+intval($resultM);
                         if ($resultTotalMinutes>=$TotalMinutesNeeded) {
                             $FoundDateBegin = $BookingsArray[$i][$BookingsArrayLastY+1]->format('H:i:s');
                             $FoundDateFinish = $BookingsArray[$i+1][$BookingsArrayLastY]->format('H:i:s');
                             $StaffIDBookingPerDate[$ScorrimentoY][0]=strval($AllStaffID[$External]);
                             $StaffIDBookingPerDate[$ScorrimentoY][1]=strval($IndiceIntervallo);
                             $StaffIDBookingPerDate[$ScorrimentoY][2]=strval($FoundDateBegin);


                             $finishTimeInSeconds=strtotime($BookingsArray[$i+1][$BookingsArrayLastY]->format('H:i:s'));
                             $finishTimeInSeconds=$finishTimeInSeconds-(intval($TotalMinutesNeeded)*60);
                             $dataDaInserire=date("H:i:s", $finishTimeInSeconds);


                             $StaffIDBookingPerDate[$ScorrimentoY][3]=$dataDaInserire;
                             $ScorrimentoY++;
                             $IndiceIntervallo++;
                             $insertQuestion=true;
                         }
                     }
                     //alla fine calcolo se ci sta tra le ore 20 e la fine del ultimo appuntamento
                     $Twenty=new DateTime('20:00:00');
                     $resultLast = $Twenty->diff($BookingsArray[count($BookingsArray)-1][1]);
                                
                     $resultHLast=$resultLast->format('%H:');
                     $resultMLast=$resultLast->format('%I:');
                     $resultTotalMinutesLast=(intval($resultHLast)*60)+intval($resultMLast);
                     if ($resultTotalMinutesLast>=$TotalMinutesNeeded) {
                         $FoundDateLast = $BookingsArray[count($BookingsArray)-1][1]->format('H:i:s');

                         $StaffIDBookingPerDate[$ScorrimentoY][0]=strval($AllStaffID[$External]);
                         $StaffIDBookingPerDate[$ScorrimentoY][1]=strval($IndiceIntervallo);
                         $StaffIDBookingPerDate[$ScorrimentoY][2]=strval($FoundDateLast);

                         $date1="20:00:00";
                         $finishTimeInSeconds=strtotime($date1);
                         $finishTimeInSeconds=$finishTimeInSeconds-(intval($TotalMinutesNeeded)*60);
                         $dataDaInserire=date("H:i:s", $finishTimeInSeconds);

                         $StaffIDBookingPerDate[$ScorrimentoY][3]=$dataDaInserire;
                         $insertQuestion=true;
                         $ScorrimentoY++;
                         $IndiceIntervallo++;
                     }

                     //controllo se ho inserito qualche intervallo senno dichiaro questo staff occupato per quel giorno
                     if ($insertQuestion==false) {
                         $StaffIDBookingPerDate[$ScorrimentoY][0]=strval($AllStaffID[$External]);
                         $StaffIDBookingPerDate[$ScorrimentoY][1]=strval($IndiceIntervallo);
                         $StaffIDBookingPerDate[$ScorrimentoY][2]='All Day Booked';
                         $StaffIDBookingPerDate[$ScorrimentoY][3]='All Day Booked';
                         $ScorrimentoY++;
                         $IndiceIntervallo++;
                     }
                 } else {//se non ci sono appuntamenti metto come orario disponibile tutto il giorni
                     $StaffIDBookingPerDate[$ScorrimentoY][0]=strval($AllStaffID[$External]);
                     $StaffIDBookingPerDate[$ScorrimentoY][1]=strval($IndiceIntervallo);
                     $StaffIDBookingPerDate[$ScorrimentoY][2]='07:00:00';
                     $StaffIDBookingPerDate[$ScorrimentoY][3]='20:00:00';
                     $ScorrimentoY++;
                     $IndiceIntervallo++;
                 }
             }
             //print_r($StaffIDBookingPerDate);
             
         }
     }
?>
<?php
if(!$AllStaffID==null){
for ($s=0;$s<count($AllStaffID);$s++) {//Analizzo ogni staff
    echo '<div class="card mb-4">';
    ///getting staff name
    $stmt = $dbh->getInstance()->prepare("SELECT Staffs.Name, Staffs.ImageName FROM Staffs
    WHERE StaffID = :StaffID");
    $stmt->bindParam(':StaffID', $StaffID);
    $StaffID = $AllStaffID[$s];
    $stmt->execute();
    $row = $stmt->fetch();
    $StaffName=null;
    if ($row) {
        $StaffName=$row['Name'];
    }
    
    echo '
    <div class="card-body">
        <div class="row">
                 <div class="col-lg-6">
                     <h2 class="card-title">'.$StaffName.'</h2>
                     <a href="#!"><img class="img-fluid rounded" src="/EZCUT/Images/StaffImages/'.$row['ImageName'].'" alt="..." /></a>
                 </div>

                 <div class="col-lg-6">
                        <h2 class="card-title">These are the avalable intervals.</h2>
                        <p class="card-text">Chose the time you want to start the booking:</p>';


                //il ciclo per mostrare gli intervalli
                for ($i=0;$i<count($StaffIDBookingPerDate);$i++) {
                    if ($StaffIDBookingPerDate[$i][0]==$AllStaffID[$s]) {//devo controlare se il elemento analizato è di questo staf
                                                if ($StaffIDBookingPerDate[$i][2]==$StaffIDBookingPerDate[$i][3]) {
                                                    echo '
                                                    Booked all day!
                                                    ';  
                                                } else {
                                                        echo '<form method="POST" action="Booking.php?ServicePass='.$_GET['ServicePass'].'&Salonview='.$_GET['Salonview'].'&Categoryview='.$_GET['Categoryview'].'">';
                                                                                                            echo '
                                                        Avalable from '.$StaffIDBookingPerDate[$i][2].' to '.$StaffIDBookingPerDate[$i][3].'
                                                        <input required min="'.$StaffIDBookingPerDate[$i][2].'" max="'.$StaffIDBookingPerDate[$i][3].'" type="time" name="InsertBeginTime" > 
                                                        <input type="hidden" value="'.$AllStaffID[$s].'" name="StaffID"> 
                                                        <input type="hidden" value="'.$_POST['date'].'" name="Date">
                                                        <button type="submit" name="ConfirmBooking" class="btn btn-primary btn-sm">Confirm Booking</button>
                                                        </form>
                                                        ';
                                                    }




                       
                    
                }
  
    
}

echo '</div>';
echo '</div>';
echo '</div>';
echo '
<div class="card-footer text-muted">
Staff:'.$StaffName.'
</div>';
echo '</div>';


}
    }else{
echo 'No staff yet';

    }
echo '
</div>
';
    }else{
        header('Location: /EZCUT/HomePage.php');
         exit;
    }
    echo '

</section>
</div>
';//fine container e selection
?>
</body>
</html>