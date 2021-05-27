

     <?php
     require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/User/UserMenu.php');
     ?>
     <head>
<link rel="stylesheet" href="./jquery.rateyo.min.css"/>
</head>
<div class="container-fluid">
<?php
$stmt1 = $dbh->getInstance()->prepare("SELECT BookingRatingID,BookingID,Date,BeginTime,FinishTime,serviceprovider.ServiceProviderID,serviceprovider.Name AS SalonName,ServiceName,staff.Name AS StaffName, BookingStatus, deleted FROM bookings
INNER JOIN serviceprovider ON bookings.ServiceProviderID=serviceprovider.ServiceProviderID
INNER JOIN services ON bookings.ServiceID=services.ServiceID
INNER JOIN Staff ON bookings.StaffID=Staff.StaffID
WHERE bookings.UserID =:UserID ORDER BY BookingID DESC");
    $stmt1->bindParam(':UserID', $UserID);
    $UserID = $_SESSION['UserID'];
    $stmt1->execute();
    while ($row = $stmt1->fetch()) {
        if($row['deleted']==null){
echo '
<div class="row SalonRow">
    <div class="col-sm-7">
    ID:&nbsp &nbsp'.$row['BookingID'].'<br>
    Date&nbsp&nbsp:'.$row['Date'].'<br>
    Begin Time:&nbsp&nbsp'.$row['BeginTime'].'<br>
    Finish Time:&nbsp&nbsp'.$row['FinishTime'].'<br>
    Salon Name:&nbsp&nbsp'.$row['SalonName'].'<br>
    Service Name:&nbsp&nbsp'.$row['ServiceName'].'<br>
    Costumer:&nbsp&nbsp'.$row['StaffName'].'<br>
    </div>

    <div class="col-sm-5">';
    if($row['BookingStatus']=="Booked" ){
        echo '
        <div class="row">
         
         
        <div class="col-sm">
        <form method="post" action="CancelBooking">

        <button class="btn btn-primary " name="submit" type="submit">
        Require cancelation.
                            </button>
        </form>
         
        </div></div>';
        }

        //get salonID
        echo'  
           ';
           if($row['BookingStatus']=="Finished" && ($row['BookingRatingID']==null)){
               echo '
               <div class="row">
                     <div class="col-sm-3">Give a rating:</div>
                     <div class="col-sm-1">

<form method="post" action="GiveRating.php">
<div class="rateYo"></div>

<input class="rating" type="hidden" value="" name="Rate">
<input id="" type="hidden" value="'.$row['ServiceProviderID'].'" name="ServiceProviderID">
<input id="" type="hidden" value="'.$row['BookingID'].'" name="BookingID">
<input id="" type="hidden" value="'.$_SESSION['UserID'].'" name="UserID">


<input type="submit" value="Confirm">
</form>

                     </div>
               
             </div>
              
              
               ';
           }

           if($row['BookingStatus']=="Finished" && ($row['BookingRatingID']!=null)){

            $stmt6 = $dbh->getInstance()->prepare("SELECT BookingRatingNumber FROM bookingratings
            INNER JOIN bookings ON bookings.BookingRatingID=bookingratings.BookingRatingID
        
            WHERE bookings.BookingID =:BookingID");
                $stmt6->bindParam(':BookingID', $BookingID);
                $BookingID = $row['BookingID'];
                $stmt6->execute();
                while ($row3 = $stmt6->fetch()) {
                    echo '
            <div class="row">
                  <div class="col-sm-3">Rating:</div>
                  <div class="col-sm-1">


<div class="rateYo1" data-rateyo-rating="'.$row3['BookingRatingNumber'].'"></div>
                  </div>
            
          </div>
           
           
            ';


                }
        }

        if($row['BookingStatus']=="Refused" ){

            
                    echo '
            <div class="row">
                  <div class="col-sm-3">Status:</div>
                  <div class="col-sm-1">
                  <span style="color:red">Refused</span>
                  </div>
            
          </div>
           
           
            ';


                
        }


           
        
    echo '
    </div>

</div>';
    }
    }
         
     ?>  
     

     
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

    <script>




$(function(){

$(".rateYo").rateYo({
 fullStar: true,
 onSet: function(rating, rateYoInstance){
     $(".rating").val(rating);
 }


});


$(".rateYo1").rateYo({
 readOnly:true,

 fullStar: true,
 onSet: function(rating, rateYoInstance){
     $(".rating1").val(rating);
 }


});




});




    </script>
     
   
    </body>
</html>