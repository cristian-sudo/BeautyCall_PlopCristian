<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <style>
input {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
  border: 3px solid #ccc;
  -webkit-transition: 0.5s;
  transition: 0.5s;
  outline: none;
}

input:focus {
  border: 3px solid #555;
}


</style>
  <body >
    <?php
    require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/Salon/Menu.php');
    $stmt = $dbh->getInstance()->prepare("SELECT * FROM OpeningTimes WHERE AdministratorID='".$_SESSION['AdministratorID']."'");
    $stmt->execute();
    $row=$stmt;
   if ($row) {
    foreach ($row as $key => $value) {

echo '
<div class="container-fluid">';

if($value['Monday']!=null &&$value['Monday']!="-"){
  echo'
<div class="card-footer text-muted">
    <div style="text-align:center;">Monday:&nbsp '.$value['Monday'].'</div>
</div>';
}elseif($value['Monday']=="-"){
  echo'
  <div class="card-footer text-muted">
      <div style="text-align:center;">Monday:&nbsp  <span style="color:red;">Closed<span></div>
  </div>'; 
}else{
  echo'
  <div class="card-footer text-muted">
  <div style="text-align:center;">Sunday:&nbsp  <span style="color:red;">Closed<span></div>
</div>';  
}



if($value['Tuesday']!=null && $value['Tuesday']!="-"){
  echo'
<div class="card-footer text-muted">
    <div style="text-align:center;">Tuesday:&nbsp '.$value['Tuesday'].'</div>
</div>';
}elseif($value['Tuesday']=="-"){
  echo'
  <div class="card-footer text-muted">
      <div style="text-align:center;">Tuesday:&nbsp <span style="color:red;">Closed<span></div>
  </div>'; 
}else{
  echo'
  <div class="card-footer text-muted">
  <div style="text-align:center;">Sunday:&nbsp  <span style="color:red;">Closed<span></div>
</div>';  
}



if($value['Wednesday']!=null && $value['Wednesday']!="-"){
  echo'
<div class="card-footer text-muted">
    <div style="text-align:center;">Wednesday:&nbsp '.$value['Wednesday'].'</div>
</div>';
}elseif($value['Wednesday']=="-"){
  echo'
  <div class="card-footer text-muted">
      <div style="text-align:center;">Wednesday:&nbsp  <span style="color:red;">Closed<span></div>
  </div>'; 
}else{
  echo'
  <div class="card-footer text-muted">
  <div style="text-align:center;">Sunday:&nbsp  <span style="color:red;">Closed<span></div>
</div>';  
}




if($value['Thursday']!=null && $value['Thursday']!="-"){
  echo'
<div class="card-footer text-muted">
    <div style="text-align:center;">Thursday:&nbsp '.$value['Thursday'].'</div>
</div>';
}elseif($value['Thursday']=="-"){
  echo'
  <div class="card-footer text-muted">
      <div style="text-align:center;">Thursday:&nbsp  <span style="color:red;">Closed<span></div>
  </div>'; 
}else{
  echo'
  <div class="card-footer text-muted">
  <div style="text-align:center;">Sunday:&nbsp  <span style="color:red;">Closed<span></div>
</div>';  
}



if($value['Friday']!=null && $value['Friday']!="-"){
  echo'
<div class="card-footer text-muted">
    <div style="text-align:center;">Friday:&nbsp '.$value['Friday'].'</div>
</div>';
}elseif($value['Friday']=="-"){
  echo'
  <div class="card-footer text-muted">
      <div style="text-align:center;">Friday:&nbsp  <span style="color:red;">Closed<span></div>
  </div>'; 
}else{
  echo'
  <div class="card-footer text-muted">
  <div style="text-align:center;">Sunday:&nbsp  <span style="color:red;">Closed<span></div>
</div>';  
}



if($value['Saturday']!=null && $value['Saturday']!="-"){
  echo'
<div class="card-footer text-muted">
    <div style="text-align:center;">Saturday:&nbsp '.$value['Saturday'].'</div>
</div>';
}elseif($value['Saturday']=="-"){
  echo'
  <div class="card-footer text-muted">
      <div style="text-align:center;">Saturday:&nbsp  <span style="color:red;">Closed<span></div>
  </div>'; 
}else{
  echo'
  <div class="card-footer text-muted">
  <div style="text-align:center;">Sunday:&nbsp  <span style="color:red;">Closed<span></div>
</div>';  
}



if($value['Sunday']!=null && $value['Sunday']!="-"){
  echo'
<div class="card-footer text-muted">
    <div style="text-align:center;">Sunday:&nbsp '.$value['Sunday'].'</div>
</div>';
}elseif($value['Sunday']=="-"){
  echo'
  <div class="card-footer text-muted">
      <div style="text-align:center;">Sunday:&nbsp  <span style="color:red;">Closed<span></div>
  </div>'; 
}else{
  echo'
  <div class="card-footer text-muted">
  <div style="text-align:center;">Sunday:&nbsp  <span style="color:red;">Closed<span></div>
</div>';  
}


      
      }
      echo "<div>";
      /////////////////////////////////////////////////////////////////////////////////////////////
      echo '
      <form action="/EZCUT/Salon/ConfirmOpeningTime.php" method="POST">
      ';
$stmt2 = $dbh->getInstance()->prepare("SELECT * FROM OpeningTimes WHERE AdministratorID='".$_SESSION['AdministratorID']."'");
$stmt2->execute();
$row2=$stmt2;
foreach ($row2 as $key => $value) {
  if($value['Monday']!=null){
$ExplodedM=explode("-",$value['Monday']);
$MondayB=$ExplodedM[0];
$MondayF=$ExplodedM[1];
  }else{
    $MondayB=0;
    $MondayF=0; 
  }



  if($value['Tuesday']!=null){
$ExplodedT1=explode("-",$value['Tuesday']);
$TuesdayB=$ExplodedT1[0];
$TuesdayF=$ExplodedT1[1];
}else{
  $TuesdayB=0;
  $TuesdayF=0; 
}


if($value['Wednesday']!=null){
$ExplodedW=explode("-",$value['Wednesday']);
$WednesdayB=$ExplodedW[0];
$WednesdayF=$ExplodedW[1];
}else{
  $WednesdayB=0;
  $WednesdayF=0; 
}


if($value['Thursday']!=null){
$ExplodedT2=explode("-",$value['Thursday']);
$ThursdayB=$ExplodedT2[0];
$ThursdayF=$ExplodedT2[1];
}else{
  $ThursdayB=0;
  $ThursdayF=0; 
}


if($value['Friday']!=null){
$ExplodedF=explode("-",$value['Friday']);
$FridayB=$ExplodedF[0];
$FridayF=$ExplodedF[1];
}else{
  $FridayB=0;
  $FridayF=0; 
}


if($value['Saturday']!=null){
$ExplodedS1=explode("-",$value['Saturday']);
$SaturdayB=$ExplodedS1[0];
$SaturdayF=$ExplodedS1[1];
}else{
  $SaturdayB=0;
  $SaturdayF=0; 
}


if($value['Sunday']!=null){
$ExplodedS2=explode("-",$value['Sunday']);
$SundayB=$ExplodedS2[0];
$SundayF=$ExplodedS2[1];
}else{
  $SundayB=0;
  $SundayF=0; 
}


echo '
<div class="row">
<div class="col" style="font-size: 30px;">Monday</div>
<div class="col"> <input type="time" name="MondayOpen" value="'.$MondayB.'"  ></div>
<div class="col" style="text-align: center;">-</div>
<div class="col"> <input type="time" name="MondayClosing" value="'.$MondayF.'"  ></div>
<div class="col"> Closed all day:<input type="checkbox" name="MondayAllDay"  ></div>
</div>

<div class="row">
<div class="col" style="font-size: 30px;">Tuesday</div>
<div class="col"> <input type="time" name="TuesdayOpen" value="'.$TuesdayB.'"  ></div>
<div class="col" style="text-align: center;">-</div>
<div class="col"> <input type="time" name="TuesdayClosing" value="'.$TuesdayF.'"  ></div>
<div class="col"> Closed all day:<input type="checkbox" name="TuesdayAllDay"  ></div>
</div>

<div class="row">
<div class="col" style="font-size: 30px;">Wednesday</div>
<div class="col"> <input type="time" name="WednesdayOpen" value="'.$WednesdayB.'"  ></div>
<div class="col" style="text-align: center;">-</div>
<div class="col"> <input type="time" name="WednesdayClosing" value="'.$WednesdayF.'"  ></div>
<div class="col"> Closed all day:<input type="checkbox" name="WednesdayAllDay"  ></div>
</div>

<div class="row">
<div class="col" style="font-size: 30px;">Thursday</div>
<div class="col"> <input type="time" name="ThursdayOpen" value="'.$ThursdayB.'"  ></div>
<div class="col" style="text-align: center;">-</div>
<div class="col"> <input type="time" name="ThursdayClosing" value="'.$ThursdayF.'"  ></div>
<div class="col"> Closed all day:<input type="checkbox" name="ThursdayAllDay"  ></div>
</div>

<div class="row">
<div class="col" style="font-size: 30px;">Friday</div>
<div class="col"> <input type="time" name="FridayOpen" value="'.$FridayB.'"  ></div>
<div class="col" style="text-align: center;">-</div>
<div class="col"> <input type="time" name="FridayClosing" value="'.$FridayF.'"  ></div>
<div class="col"> Closed all day:<input type="checkbox" name="FridayAllDay"  ></div>
</div>

<div class="row">
<div class="col" style="font-size: 30px;">Saturday</div>
<div class="col"> <input type="time" name="SaturdayOpen" value="'.$SaturdayB.'"  ></div>
<div class="col" style="text-align: center;">-</div>
<div class="col"> <input type="time" name="SaturdayClosing" value="'.$SaturdayF.'"  ></div>
<div class="col"> Closed all day:<input type="checkbox" name="SaturdayAllDay"  ></div>
</div>

<div class="row">
<div class="col" style="font-size: 30px;">Sunday</div>
<div class="col"> <input type="time" name="SundayOpen" value="'.$SundayB.'"  ></div>
<div class="col" style="text-align: center;">-</div>
<div class="col"> <input type="time" name="SundayClosing" value="'.$SundayF.'"  ></div>
<div class="col"> Closed all day:<input type="checkbox" name="SundayAllDay"  ></div>
</div>




      <input type="submit" name="submit" value="Modify" >
      </form>';}
}
  ?>
  </body>
</html>
