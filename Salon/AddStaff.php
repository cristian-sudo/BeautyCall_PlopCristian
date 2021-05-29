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
<?php
echo'
</style>
<form action="ConfirmNewStaffInformations.php" method="post" enctype="multipart/form-data">
            <input type="hidden"  name="StaffID" >
            <div class="row"> 
            <div class="col" style="padding-left:140px">
            <label for="fname">Name:</label>
            <input type="text" id="fname" name="Name" >
            </div>
            </div>          
            <div class="row"> 
            <div class="col" style="padding-left:140px">
            <label for="fname">Surname:</label>
            <input type="text" id="fname" name="Surname" >
            </div>
            </div>          
            <div class="row"> 
            <div class="col" style="padding-left:140px">
            <label for="fname">Email:</label>
            <input type="email" id="fname" name="Email" >
            </div>
            </div>
            <div class="row"> 
            <div class="col" style="padding-left:140px">
            <label for="fname">Phone Number:</label>
            <input type="number" id="fname" name="Phone"  >
            </div>
            </div>';
            echo ' <h3 style="text-align:center;">Categories:</h3><br>';
            //get all categories in general
            //get categories of this staff
            $stmt2 = $dbh->getInstance()->prepare('SELECT DISTINCT servicecategories.ServiceCategoryName,servicecategories.ServiceCategoryID FROM servicecategories
            INNER JOIN services ON services.ServiceCategoryID=servicecategories.ServiceCategoryID
            WHERE ServiceProviderID ="'.$_SESSION['ServiceProviderID'].'"
            ORDER BY ServiceCategoryName ASC
      ');  
            $stmt2->execute();
            $Controll=null;
                while($row10 = $stmt2->fetch()){
                    $Controll=true;
                        echo '
                        <div class="row" style="border-top:solid 1px;">
                        <div class="col" style="padding-left:140px">            
                        <input type="checkbox"  id="Categories" name="'.$row10['ServiceCategoryName'].'" value="'.$row10['ServiceCategoryName'].'"';
                        echo '
                        " >
                          <label for="Categories">'.$row10['ServiceCategoryName'].'</label><br>          
                        </div>
                        </div>                         
                        ';
                }if($Controll!=true){
                    echo 'No categories yet.';
                } 
           echo '
            <div class="row"> 
            <div class="col" style="padding-left:140px">';
           
            echo 'No Photo set.
            <label for="fname">Photo:[Recommended to be 450px  X   350px]</label>
            <input type="file" id="fname" name="fileToUpload" >
            ';
            echo '
            </div>
            </div>
            <input type="submit"  Name="Submit" value="Confirm" class="btn btn-dark">
            </form>
            ';
            ?>