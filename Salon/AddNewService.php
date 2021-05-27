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



      echo '
      <div style="  padding-top:50px">
      <form action="ConfirmNewManageServces.php" method="post" enctype="multipart/form-data">
      <input type="hidden"  name="ServiceID" ">
      <div class="row" > 
      <div class="col" style="padding-left:140px">
      <label for="ServiceName">ServiceName:</label>
      <input type="text"  name="ServiceName"  required>
      </div>
      </div>
      
      <div class="row"> 
      <div class="col" style="padding-left:140px">
      <label for="ShortDescription">ShortDescription:</label>
      <input type="text"  name="ShortDescription" required> 
      </div>
      </div>
      
      <div class="row"> 
      <div class="col" style="padding-left:140px">
      <label for="Price">Price:</label>
      <input type="number"  name="Price"  required>
      </div>
      </div>
      
      <div class="row"> 
      <div class="col" style="padding-left:140px">
      <label for="TimeDurationHours">TimeDurationHours:</label>
      <input type="number"  name="TimeDurationHours" required>
      </div>
      </div>
      
    
      <div class="row"> 
      <div class="col" style="padding-left:140px">
      <label for="TimeDurationMinutes">TimeDurationMinutes:</label>
      <input type="number"  name="TimeDurationMinutes" required>
      </div>
      </div>


      <div class="row"> 
      <div class="col" style="padding-left:140px">
      <label for="cars">Category:</label>

<select name="Category">';
$stmt = $dbh->getInstance()->prepare('SELECT DISTINCT servicecategories.ServiceCategoryID,servicecategories.ServiceCategoryName FROM servicecategories
');     
$stmt->execute();
while($row = $stmt->fetch()){  
echo 'a';
echo '
<option  value="'.$row['ServiceCategoryID'].'">'.$row['ServiceCategoryName'].'</option>

';

}

  echo '
</select>
      </div>
      </div>
      
      
      ';     
  

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

    
  
  


echo '</div>';
 ?>
