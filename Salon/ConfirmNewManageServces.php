<?php
session_start();
require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/conessione/DBHandler.php');
require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/conessione/DBHandlerObject.php');
//get all categories, and control if isset a post value with that name.

print_r($_POST);


  





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
    $target_dir = "/Applications/XAMPP/xamppfiles/htdocs/EZCUT/Images/ServiceImages/";
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

        $stmt1 = $dbh->getInstance()->prepare('INSERT INTO services (ServiceName,ServiceCategoryID,Price,TimeDurationHours,TimeDurationMinutes,ShortDescription,ServiceProviderID)
        VALUES (:ServiceName, :ServiceCategoryID,:Price,:TimeDurationHours,:TimeDurationMinutes,:ShortDescription,:ServiceProviderID);
        ');  
         $stmt1->bindParam(':ServiceName', $ServiceName);
         $stmt1->bindParam(':ServiceCategoryID', $ServiceCategoryID);
         $stmt1->bindParam(':Price', $Price);
         $stmt1->bindParam(':TimeDurationHours', $TimeDurationHours);
         $stmt1->bindParam(':TimeDurationMinutes', $TimeDurationMinutes);
         $stmt1->bindParam(':ShortDescription', $ShortDescription);
         $stmt1->bindParam(':ServiceProviderID', $ServiceProviderID);
    
         $ServiceName=$_POST['ServiceName']; 
         $ServiceCategoryID=$_POST['Category']; 
         $Price=$_POST['Price']; 
         $TimeDurationHours=$_POST['TimeDurationHours']; 
         $TimeDurationMinutes=$_POST['TimeDurationMinutes']; 
         $ShortDescription=$_POST['ShortDescription']; 
         $ServiceProviderID=$_SESSION['ServiceProviderID']; 
        $stmt1->execute();

        $stmt8 = $dbh->getInstance()->prepare('SELECT MAX(ServiceID) AS MAX
        FROM services
        WHERE ServiceID;

        ');   
        $stmt8->execute();
        $MAX=$stmt8->fetch();
echo $MAX['MAX'];
        $stmt2 = $dbh->getInstance()->prepare('INSERT INTO serviceImages (ImageName,ServiceID)
        VALUES (:ImageName, :ServiceID);
        ');  
         $stmt2->bindParam(':ImageName', $ImageName);
         $stmt2->bindParam(':ServiceID', $ServiceID);
         $ImageName= $newfilename;
         $ServiceID=$MAX['MAX']; 
        $stmt2->execute();
        header('Location: ManageServices.php');
        exit;




      }


}
}
?>