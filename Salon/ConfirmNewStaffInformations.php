<?php
session_start();
require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/conessione/DBHandler.php');
require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/conessione/DBHandlerObject.php');
//get all categories, and control if isset a post value with that name.




  





///////////////////
function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    $CasualName=generateRandomString();
    

if(isset($_FILES['fileToUpload'])){
   
    $target_dir = "/Applications/XAMPP/xamppfiles/htdocs/EZCUT/Images/StaffImages/";
    // $target_file is the new file name including the extension
    // $_FILES["fileToUpload"] contains an entry corresponding to the file uploaded
    // by pushing the button with name fileToUpload
    // $_FILES["fileToUpload"]["name"] return the full name of the file (including the path)
    // e.g. c:/user/ccapuzzo/desktop/myrtle.jpg
    // basename($_FILES["fileToUpload"]["name"]) returns myrtle.jpg

    $temp = explode(".", $_FILES["fileToUpload"]["name"]);
    $newfilename = round(microtime(true)) . '.' . end($temp);
    



    $target_file = $target_dir . $newfilename;
    $uploadOk = 1;
    // get information about the extension
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image
    if(isset($_POST["Submit"])) {
        // getimagesize returns false if its argument is not an image else
            // it returns an array conatining info about the image. $check["mime"] is the extension
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }
    }
    
    // Check if file already exists
    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }
    
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";

        $stmt1 = $dbh->getInstance()->prepare('INSERT INTO Staffs (Name, Surname,Email,PhoneNumber,ServiceProviderID,ImageName)
        VALUES (:Name, :Surname,:Email,:PhoneNumber,:ServiceProviderID,:ImageName);
        ');  
         $stmt1->bindParam(':Name', $Name);
         $stmt1->bindParam(':Surname', $Surname);
         $stmt1->bindParam(':Email', $Email);
         $stmt1->bindParam(':PhoneNumber', $PhoneNumber);
         $stmt1->bindParam(':ServiceProviderID', $ServiceProviderID);
         $stmt1->bindParam(':ImageName', $ImageName);
    
         $Name=$_POST['Name']; 
         $Surname=$_POST['Surname']; 
         $Email=$_POST['Email']; 
         $PhoneNumber=$_POST['Phone']; 
         $ServiceProviderID=$_SESSION['ServiceProviderID']; 
         $ImageName=$newfilename; 
        $stmt1->execute();


        $stmt8 = $dbh->getInstance()->prepare('SELECT MAX(StaffID) AS MAX
        FROM Staffs
        WHERE StaffID;

        ');   
        $stmt8->execute();
        $MAX=$stmt8->fetch();

        $stmt6 = $dbh->getInstance()->prepare('SELECT  * FROM servicecategories  
        ');   
        $stmt6->execute();
            while($row = $stmt6->fetch()){
  
        //scorro i risulatti dei post


        foreach ($_POST as $index => $value) {
           if($index==$row['ServiceCategoryName']){




        $stmt12 = $dbh->getInstance()->prepare('SELECT ServiceCategoryID 
        FROM ServiceCategories
        WHERE ServiceCategoryName="'.$row['ServiceCategoryName'].'";

        ');   
        $stmt12->execute();
        $CategoryID=$stmt12->fetch();



          

            $stmt10 = $dbh->getInstance()->prepare('INSERT INTO StaffCategories (StaffID,ServiceCategoryID)
            VALUES ("'.$MAX['MAX'].'","'.$CategoryID['ServiceCategoryID'].'"); 
            ');   
            $stmt10->execute();

            
           
        
        }
    }
}


      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
    



        
    }
/////////////////////////////////////////////


header('Location: StaffManage.php?StaffManageName='.$_POST['Name']);
exit;

?>