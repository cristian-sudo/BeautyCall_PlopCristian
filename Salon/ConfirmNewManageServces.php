<?php
session_start();
require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/conessione/DBHandler.php');
require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/conessione/DBHandlerObject.php');
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
    $temp = explode(".", $_FILES["fileToUpload"]["name"]);
    $newfilename = round(microtime(true)) . '.' . end($temp);
    $target_file = $target_dir . $newfilename;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if(isset($_POST["Submit"])) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }
    }
    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }
    if ($_FILES["fileToUpload"]["size"] > 500000000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
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