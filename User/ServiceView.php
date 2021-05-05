
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
    echo '
     <h1 id="HomePageCategories"> '.$_GET['Salonview'].'  ||  '.$_GET['ServicePass'].'</h1>
     ';
     if (isset($_POST['date'])) {
         //getting the time needed for this service
         $stmt = $dbh->getInstance()->prepare("SELECT services.TimeDurationHours,services.TimeDurationMinutes FROM services
    INNER JOIN hairdressingsalons on services.SalonID=hairdressingsalons.SalonID
    WHERE services.ServiceName = :ServiceName and hairdressingsalons.Name=:SalonName");
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
         $stmt1 = $dbh->getInstance()->prepare("SELECT Staff.StaffID FROM Staff
   INNER JOIN hairdressingsalons ON Staff.SalonID=hairdressingsalons.SalonID
   WHERE hairdressingsalons.Name =:SalonName");
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
            INNER JOIN hairdressingsalons ON bookings.SalonID=hairdressingsalons.SalonID
            WHERE hairdressingsalons.Name =:SalonName
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
if(!isset($_POST['Confirm'])){
    echo'
    <div class="container-fluid">
    <div class="row">
            <div class="col-1 Back ">
              <a href="/EZCUT/User/DateSelector.php?ServicePass='.$_GET['ServicePass'].'&Salonview='.$_GET['Salonview'].'&Categoryview='.$_GET['Categoryview'].'">Change the date</a>  
            </div>
    </div>
    <div class="row">
    <div class="col">
        <h4 id="ForDateTEXT">For:'.$_POST['date'].' we have these avalable times intervals and costumers disponible:<br>
        Chose your favorite costumers and insert the time you prefer for this service, based on given intervals.</h4><br>
    </div>
</div>';
////////
}
for ($s=0;$s<count($AllStaffID);$s++) {//Analizzo ogni staff
    ///getting staff name
    $stmt = $dbh->getInstance()->prepare("SELECT Staff.Name FROM Staff
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
 <div   class="row shadow p-3 mb-5 bg-white rounded RowOgniStaff">
 <div class="col-12">
                            <div class="row RowOgniStaff2">
                                    <div class="col-6 col">'.$StaffName.'</div>
                                    <div class="col-6 col">Immagine</div>
                            </div>
                    ';
                //il ciclo per mostrare gli intervalli
                for ($i=0;$i<count($StaffIDBookingPerDate);$i++) {
                    if ($StaffIDBookingPerDate[$i][0]==$AllStaffID[$s]) {//devo controlare se il elemento analizato è di questo staf
                     
                    echo '<div class="row RowOgniStaff2">';//inizio row interna
                    echo '<div class="col">';
                    echo '<form method="POST" action="Booking.php?ServicePass='.$_GET['ServicePass'].'&Salonview='.$_GET['Salonview'].'&Categoryview='.$_GET['Categoryview'].'">';
                        if ($StaffIDBookingPerDate[$i][2]==$StaffIDBookingPerDate[$i][3]) {
                            echo '
                            <div class="row">
                            <div class="col-6 ">Booked for all day</div>
                            <div class="col-6 ">###</div>
                            </div>
                            ';
                            
                        } else {
                            echo '
                                    <div class="row">
                                            <div class="col">
                                            '.$StaffIDBookingPerDate[$i][2].'-'.$StaffIDBookingPerDate[$i][3].'
                                            </div>
                                            <div class="col ">
                                                    <div class="row">
                                                            <div class="col">
                                                                <input required min="'.$StaffIDBookingPerDate[$i][2].'" max="'.$StaffIDBookingPerDate[$i][3].'" type="time" name="InsertBeginTime" id="InsertTimeInput"> 
                                                                <input type="hidden" value="'.$AllStaffID[$s].'" name="StaffID"> 
                                                                <input type="hidden" value="'.$_POST['date'].'" name="Date">
                                                            </div>
                                                    </div>
                                                    <div class="row">
                                                            <div class="col">
                                                            <button type="submit" name="ConfirmBooking" class="btn btn-primary btn-lg btn-block buton">Confirm Booking</button>
                                                            </div>
                                                    </div>
                                            </div>
                                    </div>
                        
                            ';
                        }
                        
                        
                    echo '</form>';//fine form per ogni riga interna
                    echo '</div>';//fine col interna
                    echo '</div>';//fine row interna
                    }
                    
                }
    echo '</div>';//fine col per ogni staff
    echo '</div><br>';//fine row per ogni staff
    
}

?>
</body>
</html>