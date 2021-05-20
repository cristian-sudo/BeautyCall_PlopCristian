<?php
require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/Salon/Menu.php');
?>
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
<div class="row">
    <div class="col">
                <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Costumers
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
<?php
$stmt = $dbh->getInstance()->prepare('SELECT  * FROM Staff
WHERE ServiceProviderID="'.$_SESSION['ServiceProviderID'].'"  
');   
$stmt->execute();
$Controll=null;
    while($row = $stmt->fetch()){
        $Controll=true;
       echo ' <a class="dropdown-item" href="StaffManage.php?StaffManageName='.$row["Name"].'">'.$row["Name"].'</a>';
    }
    if($Controll!=true){
        echo ' <a class="dropdown-item" href="">No costumers</a>'; 
    }
?>
                </div>
                </div>
        </div>
</div>

<?php
if (isset($_GET['StaffManageName'])){

    $stmt1 = $dbh->getInstance()->prepare('SELECT  * FROM Staff
    WHERE ServiceProviderID="'.$_SESSION['ServiceProviderID'].'"
    AND Name="'.$_GET['StaffManageName'].'"  
    ');   
    $stmt1->execute();
    $Controll=null;
        while($row = $stmt1->fetch()){
            $Controll=true;
            echo '
            <form action="ConfirmStaffInformations.php" method="post">
            <input type="hidden"  name="StaffID" value="'.$row['StaffID'].'">
            <div class="row"> 
            <div class="col" style="padding-left:140px">
            <label for="fname">Name:</label>
            <input type="text" id="fname" name="Name" value="'.$row['Name'].'">
            </div>
            </div>
            
            <div class="row"> 
            <div class="col" style="padding-left:140px">
            <label for="fname">Surname:</label>
            <input type="text" id="fname" name="Surname" value="'.$row['Surname'].'">
            </div>
            </div>
            
            <div class="row"> 
            <div class="col" style="padding-left:140px">
            <label for="fname">Email:</label>
            <input type="text" id="fname" name="Email" value="'.$row['Email'].'">
            </div>
            </div>
            
            <div class="row"> 
            <div class="col" style="padding-left:140px">
            <label for="fname">Phone Number:</label>
            <input type="text" id="fname" name="Phone" value="'.$row['PhoneNumber'].'" >
            </div>
            </div>
            
            <h3 style="text-align:center;">Categories:</h3><br>';
            //get all categories in general
            //get categories of this staff
            $stmt2 = $dbh->getInstance()->prepare('SELECT * FROM servicecategories
            INNER JOIN services ON services.ServiceCategoryID=servicecategories.ServiceCategoryID
            WHERE ServiceProviderID ="'.$_SESSION['ServiceProviderID'].'"
            ORDER BY ServiceCategoryName ASC
      ');  
            $stmt2->execute();
            $Controll=null;
                while($row = $stmt2->fetch()){
                    $Controll=true;
                        echo '
                        <div class="row" style="border-top:solid 1px;">
                        <div class="col" style="padding-left:140px">
            
                        <input type="checkbox"  id="Categories" name="'.$row['ServiceCategoryName'].'" value="'.$row['ServiceCategoryName'].'" >
                          <label for="Categories">'.$row['ServiceCategoryName'].'</label><br>
            
                        </div>
                        </div>   
                        
                        ';


                }if($Controll!=true){
                    echo 'No categories yet.';
                }




           
            
            
            
            
            
           echo '
            <div class="row"> 
            <div class="col" style="padding-left:140px">
            
            <label for="fname">Photo:[Recommended to be 450px  X   350px]</label>
            <input type="file" id="fname" name="fname" >
            
            </div>
            </div>
            
            
            
            <input type="submit"   value="Confirm changes" class="btn btn-dark">
            </form>
            ';
        }
        if($Controll!=true){
            echo 'Inexistent costumer.';
        }















}else{
    echo '
    <div class="row">
        <div class="col" >
        <h1 style="text-align:center;">   Select the costumer to manage OR</h1><br>
        <h1 style="text-align:center;">        <a style="color:blue" href=""> Add a new Staff<a/>     </h1>
        </div>
    </div>
    
    
';
}


?>


</body>
</html>