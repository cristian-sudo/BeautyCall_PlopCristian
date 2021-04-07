<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    /*
Main variables
$TotalMinutesNeeded(minutes needed for this service)
$BookingsArray(a matrix containing all the booking in a specific day for a specific Staff)
$AllStaffID(all the id of the stafs that is in this salon)
$StaffIDBookingPerDate(contains for each Staff his booking for a specific day)
|StaffID|IntervalNr|BeginTime|FinishTime|
*/
    require('/Applications/XAMPP/xamppfiles/htdocs/EZCUT/User/UserMenu.php');
    echo '
     <h1 id="HomePageCategories"> '.$_GET['Salonview'].'  ||  '.$_GET['ServicePass'].'</h1>
     ';
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
   }if($AllStaffID){

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
                $today=$_GET['Date'];
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
                if ($BookingsArray[0][0]!=null) {//se ci sono appuntamenti nel primo giorno devo crearmi gli intervalli di disponibilità
                    $BookingsArrayLastX=0;
                    $BookingsArrayLastY=0;
                    //ho controlato se ci sta tra le ore 7 e il primo appuntamento
                    $Seven=new DateTime('07:00:00');
                    $result = $BookingsArray[$BookingsArrayLastX][$BookingsArrayLastY]->diff($Seven);
                    $BookingsArrayLastX;
                    $BookingsArrayLastY;
                    $resultH=$result->format('%H:');
                    $resultM=$result->format('%I:');
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
                            $dataDaInserire=date("H:i:s",$finishTimeInSeconds);
                            //
                            $StaffIDBookingPerDate[$ScorrimentoY][3]=$dataDaInserire;

                            $ScorrimentoY++;
                            $IndiceIntervallo++;

                        
                    
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
                        $dataDaInserire=date("H:i:s",$finishTimeInSeconds);


                        $StaffIDBookingPerDate[$ScorrimentoY][3]=$dataDaInserire;
                        $ScorrimentoY++;
                        $IndiceIntervallo++;
                        
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
                            $dataDaInserire=date("H:i:s",$finishTimeInSeconds);

                            $StaffIDBookingPerDate[$ScorrimentoY][3]=$dataDaInserire;
                            $ScorrimentoY++;
                            $IndiceIntervallo++;
                        }
                    }
                } else {//se non ci sono appuntamenti metto come orario disponibile tutto il giorni
                    echo 'All day free!!';
                }
   }

}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <span>Chose a day you want to book!</span>
        </div>
    </div>
</div>

</body>
</html>