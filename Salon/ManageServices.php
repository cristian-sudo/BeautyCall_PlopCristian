<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
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
  </head>
  <body>

  </body>
</html>
<?php
require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/Salon/Menu.php');
echo '<div class="container-fluid">';
$stmt = $dbh->getInstance()->prepare('
SELECT * 
   FROM
   services
INNER JOIN servicecategories ON services.ServiceCategoryID = servicecategories.ServiceCategoryID
WHERE services.ServiceProviderID="'.$_SESSION['ServiceProviderID'].'"
');
$stmt->execute();
$row=$stmt;
   if ($row) {
     echo '
     <div class="row"> 
          <div class="col"> 
          
          
                  <a href="AddNewService.php" style="font-size:30px; color:blue; background-color: #fff;"> ..Add a new Service..</a>
                
          
          
          </div>
     </div>
     ';
    foreach ($row as $key => $row) {


      echo '
      <div style="  padding-top:50px">
      <form action="ConfirmManageServces.php" method="post" enctype="multipart/form-data">
      <input type="hidden"  name="ServiceID" value="'.$row['ServiceID'].'">
      <div class="row" > 
      <div class="col" style="padding-left:140px">
      <label for="ServiceName">ServiceName:</label>
      <input type="text"  name="ServiceName" value="'.$row['ServiceName'].'" required>
      </div>
      </div>
      
      <div class="row"> 
      <div class="col" style="padding-left:140px">
      <label for="ShortDescription">ShortDescription:</label>
      <input type="text"  name="ShortDescription" value="'.$row['ShortDescription'].'" required> 
      </div>
      </div>
      
      <div class="row"> 
      <div class="col" style="padding-left:140px">
      <label for="Price">Price:</label>
      <input type="number"  name="Price" value="'.$row['Price'].'" required>
      </div>
      </div>
      
      <div class="row"> 
      <div class="col" style="padding-left:140px">
      <label for="TimeDurationHours">TimeDurationHours:</label>
      <input type="number"  name="TimeDurationHours" value="'.$row['TimeDurationHours'].'" required>
      </div>
      </div>
      
    
      <div class="row"> 
      <div class="col" style="padding-left:140px">
      <label for="TimeDurationMinutes">TimeDurationMinutes:</label>
      <input type="number"  name="TimeDurationMinutes" value="'.$row['TimeDurationMinutes'].'" required>
      </div>
      </div>
      <div class="row"> 
      <div class="col" style="padding-left:140px">
      <span style="font-size:30px; color:blue;">Category:'.$row['ServiceCategoryName'].'</span>
      </div>
      </div>
      
      
      ';
     echo '
      <div class="row"> 
      <div class="col" style="padding-left:140px">';
      $stmt5 = $dbh->getInstance()->prepare('SELECT * FROM ServiceImages
      
      WHERE ServiceID ="'.$row['ServiceID'].'"
');     
$stmt5->execute();
while($row5 = $stmt5->fetch()){  
  
      echo '
      <img src="/EZCUT/Images/ServiceImages/'.$row5['ImageName'].'" alt="" width="760" height="350">
      <a href="CancelImageService.php?ServiceImageID='.$row5['ServiceImagesID'].'&ImageName='.$row5['ImageName'].'" style="font-size:40px">Cancel</a>
   
      
      
      ';
  
}
echo '
<div class="row">
<div class="col">
<label for="fname">Photo:[Recommended to be 750px  X   350px]</label>
<input type="file" id="fname" name="fileToUpload" >
</div>
</div>';


      
    







      echo '
      </div>
      </div>
    
<div class="row">
<div class="col">
<input type="submit"   name="Submit" value="Confirm changes" >
</div></div>
      
      
      </form>
      </div>
      ';

    }
  
  }else{
    echo '
    <div class="row">
        <div class="col" >
        <h1 style="text-align:center; font-size:30px;">   There are not services, add some. </h1><br>
        
        </div>
    </div>
    
    
';
  }


echo '</div>';
 ?>