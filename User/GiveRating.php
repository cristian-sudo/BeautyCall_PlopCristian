
    <?php
session_start();
require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/conessione/DBHandler.php');
require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/conessione/DBHandlerObject.php');
if($_POST['Rate']!=null){
    //inserisco l'elemento
    $stmt1 = $dbh->getInstance()->prepare('INSERT INTO bookingratings (BookingRatingNumber,UserID)
    VALUES ("'.$_POST['Rate'].'","'.$_POST['UserID'].'")');
    $stmt1->execute();
 

    //mi ricavo l'ultimo id inserito
    
    $stmt4 = $dbh->getInstance()->prepare('SELECT MAX(BookingRatingID) FROM bookingratings');
    $stmt4->execute();
    $result = $stmt4->fetch();
    $toInsert=$result['MAX(BookingRatingID)'];
 
    $stmt4 = $dbh->getInstance()->prepare('INSERT INTO serviceproviderratings (ServiceProviderID,BookingRatingID)
    VALUES ("'.$_POST['ServiceProviderID'].'","'.$toInsert.'")');
    $stmt4->execute();

    $stmt8 = $dbh->getInstance()->prepare('UPDATE  bookings 
    SET BookingRatingID ="'.$toInsert.'"
    WHERE BookingID="'.$_POST['BookingID'].'"
    ');
    $stmt8->execute();
 


    $stmt2 = $dbh->getInstance()->prepare('SELECT RatingsNumber FROM serviceproviders
    WHERE ServiceProviderID="'.$_POST['ServiceProviderID'].'"');
    $stmt2->execute();
    $result2 = $stmt2->fetch();
    $IncNum=$result2['RatingsNumber']+1;
    $MAXNUMBER=0;
 
    if(!isset($result2['RatingsNumber'])){
        echo 'vuoto e lo metto a 1';
        $stmt = $dbh->getInstance()->prepare(' UPDATE serviceproviders
        SET serviceproviders.RatingsNumber = "1"
        WHERE ServiceProviderID="'.$_POST['ServiceProviderID'].'"');
        $stmt->execute();
        $MAXNUMBER=1;
    }
    else{
        echo 'non vuoto e lo incremento';
        $stmt = $dbh->getInstance()->prepare(' UPDATE serviceproviders
        SET serviceproviders.RatingsNumber = "'.$IncNum.'"
        WHERE ServiceProviderID="'.$_POST['ServiceProviderID'].'"');
        $stmt->execute();
        $MAXNUMBER=$IncNum;
    }
  

//calcolare la nuova media
$stmt6 = $dbh->getInstance()->prepare('SELECT  bookingratings.BookingRatingNumber FROM bookingratings
INNER JOIN serviceproviderratings ON serviceproviderratings.BookingRatingID=bookingratings.BookingRatingID
WHERE serviceproviderratings.ServiceProviderID="'.$_POST['ServiceProviderID'].'"');
    $stmt6->execute();
    $somma=0;
    $media=0;
    while ($row = $stmt6->fetch()) {
$somma=$somma+$row['BookingRatingNumber'];
    }
    $media=ceil($somma/$MAXNUMBER);
    $stmt10 = $dbh->getInstance()->prepare(' UPDATE serviceproviders
    SET serviceproviders.AverageSalonRating = "'.$media.'"
    WHERE ServiceProviderID="'.$_POST['ServiceProviderID'].'"');
    $stmt10->execute();
    header('Location: /EZCUT/User/BookingsView.php?fatto=TRUE');
}
header('Location: /EZCUT/User/BookingsView.php?fatto=FALSE');
/*
get ratings numbers
se e null lo metto a 1
se è diverso da null lo incremento e aggiungo

devo incrementare il numero di ratings
calcolo la nuova media e la inserisco
*/

    ?>
</body>
</html>