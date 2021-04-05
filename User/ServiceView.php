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
   print_r($AllStaffID);
   $StaffIDBookingPerDate=null;
   $ScorrimentoY=0;
   for ($External=0;$External<count($AllStaffID);$External++) {
       $IndiceIntervallo=0;
       $IndiceAllAvalablesBookingsIntervals=0;
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
                            $StaffIDBookingPerDate[$ScorrimentoY][3]=strval($FoundDateLast);
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
                        $StaffIDBookingPerDate[$ScorrimentoY][3]=strval($FoundDateFinish);
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
                            $StaffIDBookingPerDate[$ScorrimentoY][3]="20:00:00";
                            $ScorrimentoY++;
                            $IndiceIntervallo++;
                        }
                    }
                } else {//se non ci sono appuntamenti metto come orario disponibile tutto il giorni
                    echo 'All day free!!';
                }
   }

}

print_r($StaffIDBookingPerDate);

//devo costruirmi quante volte ci sta il servicio dentro un intervallo per poter illustrare a video 
//hli efettivi intervalli in cui puo prenotare












/*
     //getting all avalable times of the salon of the curent day
     $stmt = $dbh->getInstance()->prepare("SELECT * FROM FreeSeatsAvalableMinutes
     INNER JOIN Day0 ON Day0.FreeSeatsAvalableMinutesID=FreeSeatsAvalableMinutes.FreeSeatsAvalableMinutesID
          INNER JOIN hairdressingsalons ON hairdressingsalons.Day0ID=Day0.Day0ID
          WHERE hairdressingsalons.Name =:SalonName");
     $stmt->bindParam(':SalonName', $SalonName);
     $SalonName = $_GET['Salonview'];
     $stmt->execute();
     $row = $stmt->fetch();
     $SalonDay0AvalableTimesArray=null;
    if ($row) {
        ///////putting informations of salons in an array
        if ($row['EightToNineFreeSeats']>0 & $row['EightToNineAvalableMinutes']>=$TotalMinutesNeeded) {
            $SalonAvalableTimesArray['8-9']=$row['EightToNineAvalableMinutes'];
        }else{
            $SalonAvalableTimesArray['8-9']="FULL";
        }
        //////////////////////////////////////////
        if ($row['NineToTenFreeSeats']>0 & $row['NineToTenAvalableMinutes']>=$TotalMinutesNeeded) {
            $SalonAvalableTimesArray['9-10']=$row['NineToTenAvalableMinutes'];
        }else{
            $SalonAvalableTimesArray['9-10']="FULL";
        }
        //////////////////////////////////////////
        if ($row['TenToElevenFreeSeats']>0 & $row['TenToElevenAvalableMinutes']>=$TotalMinutesNeeded) {
            $SalonAvalableTimesArray['10-11']=$row['TenToElevenAvalableMinutes'];
        }else{
            $SalonAvalableTimesArray['10-11']="FULL";
        }
        //////////////////////////////////////////
        if ($row['ElevenToTwelveFreeSeats']>0 & $row['ElevenToTwelveAvalableMinutes']>=$TotalMinutesNeeded) {
            $SalonAvalableTimesArray['11-12']=$row['ElevenToTwelveAvalableMinutes'];
        }else{
            $SalonAvalableTimesArray['11-12']="FULL";
        }
        //////////////////////////////////////////
        if ($row['TwelveToThirteenFreeSeats']>0 & $row['TwelveToThirteenAvalableMinutes']>=$TotalMinutesNeeded) {
            $SalonAvalableTimesArray['12-13']=$row['TwelveToThirteenAvalableMinutes'];
        }else{
            $SalonAvalableTimesArray['12-13']="FULL";
        }
        //////////////////////////////////////////
        if ($row['ThirteenToFourteenFreeSeats']>0 & $row['ThirteenToFourteenAvalableMinutes']>=$TotalMinutesNeeded) {
            $SalonAvalableTimesArray['13-14']=$row['ThirteenToFourteenAvalableMinutes'];
        }else{
            $SalonAvalableTimesArray['13-14']="FULL";
        }
        //////////////////////////////////////////
        if ($row['FourteenToFifteenFreeSeats']>0 & $row['FourteenToFifteenAvalableMinutes']>=$TotalMinutesNeeded) {
            $SalonAvalableTimesArray['14-15']=$row['FourteenToFifteenAvalableMinutes'];
        }else{
            $SalonAvalableTimesArray['14-15']="FULL";   
        }
        //////////////////////////////////////////
        if ($row['FifteenToSixteenFreeSeats']>0 & $row['FifteenToSixteenAvalableMinutes']>=$TotalMinutesNeeded) {
            $SalonAvalableTimesArray['15-16']=$row['FifteenToSixteenAvalableMinutes'];
        }else{
            $SalonAvalableTimesArray['15-16']="FULL";
        }
        //////////////////////////////////////////
        if ($row['SixteenToSeventeenFreeSeats']>0 & $row['SixteenToSeventeenAvalableMinutes']>=$TotalMinutesNeeded) {
            $SalonAvalableTimesArray['16-17']=$row['SixteenToSeventeenAvalableMinutes'];
        }else{
            $SalonAvalableTimesArray['16-17']="FULL";
        }
        //////////////////////////////////////////
        if ($row['SeventeenToEighteenFreeSeats']>0 & $row['SeventeenToEighteenAvalableMinutes']>=$TotalMinutesNeeded) {
            $SalonAvalableTimesArray['17-18']=$row['SeventeenToEighteenAvalableMinutes'];
        }else{
            $SalonAvalableTimesArray['17-18']="FULL"; 
        }
        //////////////////////////////////////////
        if ($row['EighteenToNineteenFreeSeats']>0 & $row['EighteenToNineteenAvalableMinutes']>=$TotalMinutesNeeded) {
            $SalonAvalableTimesArray['18-19']=$row['EighteenToNineteenAvalableMinutes'];
        }else{
            $SalonAvalableTimesArray['18-19']="FULL";
        }
        //////////////////////////////////////////
        if ($row['NineteenToTwentyFreeSeats']>0 & $row['NineteenToTwentyAvalableMinutes']>=$TotalMinutesNeeded) {
            $SalonAvalableTimesArray['19-20']=$row['NineteenToTwentyAvalableMinutes'];
        }else{
            $SalonAvalableTimesArray['19-20']="FULL";
        }
    }

    print_r($SalonAvalableTimesArray);

    /*
    $SalonAvalableTimesArray
    $ServiceTimeRequiredHours
    $ServiceTimeRequiredMinutes
   */

   

   
  

    //verify in what avalable time will fit this service
    //show the results





?>
</body>
</html>