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
    $target_dir = "/Applications/XAMPP/xamppfiles/htdocs/EZCUT/Images/StaffImages/";
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
header('Location: StaffManage.php?StaffManageName='.$_POST['Name']);
exit;

?>