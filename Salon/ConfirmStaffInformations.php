<?php
session_start();
require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/conessione/DBHandler.php');
require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/conessione/DBHandlerObject.php');
$stmt = $dbh->getInstance()->prepare('SELECT  * FROM servicecategories  
');   
$stmt->execute();
    while($row = $stmt->fetch()){
        foreach ($_POST as $index => $value) {
           if($index==$row['ServiceCategoryName']){
           $stmt2 = $dbh->getInstance()->prepare('SELECT  ServiceCategoryID FROM servicecategories
            WHERE ServiceCategoryName="'.$row['ServiceCategoryName'].'"   
            ');   
            $stmt2->execute();
            $IDcategory=$stmt2->fetch();
           $stmt3 = $dbh->getInstance()->prepare('SELECT  StaffID FROM staffcategories
            WHERE StaffID="'.$_POST['StaffID'].'"  AND ServiceCategoryID="'.$IDcategory['ServiceCategoryID'].'"  
            ');   
            $stmt3->execute();
            $alreadyExists=$stmt3->fetch();
            if($alreadyExists['StaffID']==null){
            $stmt1 = $dbh->getInstance()->prepare('INSERT INTO StaffCategories (StaffID,ServiceCategoryID)
            VALUES ("'.$_POST['StaffID'].'","'.$IDcategory['ServiceCategoryID'].'"); 
            ');   
            $stmt1->execute();
            }
           }
        
        }
    }
if(isset($_POST['Name']) && $_POST['Name']!=null && isset($_POST['StaffID']) && $_POST['StaffID']!=null){
    $stmt1 = $dbh->getInstance()->prepare('UPDATE Staffs
    SET Name = "'.$_POST['Name'].'"
    WHERE StaffID="'.$_POST['StaffID'].'";
    ');   
    $stmt1->execute();   
}
if(isset($_POST['Surname']) && $_POST['Surname']!=null && isset($_POST['Surname']) && $_POST['Surname']!=null){
    $stmt1 = $dbh->getInstance()->prepare('UPDATE Staffs
    SET Surname = "'.$_POST['Surname'].'"
    WHERE StaffID="'.$_POST['StaffID'].'";
    ');   
    $stmt1->execute();   
}
if(isset($_POST['Email']) && $_POST['Email']!=null && isset($_POST['Email']) && $_POST['Email']!=null){
    $stmt1 = $dbh->getInstance()->prepare('UPDATE Staffs
    SET Email = "'.$_POST['Email'].'"
    WHERE StaffID="'.$_POST['StaffID'].'";
    ');   
    $stmt1->execute();   
}
if(isset($_POST['Phone']) && $_POST['Phone']!=null && isset($_POST['Phone']) && $_POST['Phone']!=null){
    $stmt1 = $dbh->getInstance()->prepare('UPDATE Staffs
    SET PhoneNumber = "'.$_POST['Phone'].'"
    WHERE StaffID="'.$_POST['StaffID'].'";
    ');   
    $stmt1->execute();   
}
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
    if(isset($_POST["submit"])) {
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
    && $imageFileType != "gif" && $imageFileType != "heic" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
       $stmt = $dbh->getInstance()->prepare('SELECT ImageName FROM Staffs
        WHERE StaffID ="'.$_POST['StaffID'].'"');  
        $stmt->execute();
        $row = $stmt->fetch();
        if($row){
        if($row['ImageName']!=null)
        unlink($_SERVER['DOCUMENT_ROOT'].'/EZCUT/Images/UserImages/'.$row['ImageName']);
        $stmt = $dbh->getInstance()->prepare('UPDATE staffs SET ImageName=:ImageName
          WHERE StaffID ="'.$_POST['StaffID'].'"');
          $stmt->bindParam(':ImageName', $ImageName);
          $ImageName=$newfilename;
          $stmt->execute();
        }else {
          $stmt = $dbh->getInstance()->prepare('UPDATE staffs SET ImageName=:ImageName
          WHERE StaffID ="'.$_POST['StaffID'].'"');
          $stmt->bindParam(':ImageName', $ImageName);
          $ImageName=$newfilename;
          $stmt->execute();
        }
    }
header('Location: StaffManage.php?StaffManageName='.$_POST['Name']);
  exit;

?>
