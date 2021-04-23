<?php
session_start();
require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/conessione/DBHandler.php');
require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/conessione/DBHandlerObject.php');
if (isset($_POST['Confirm'])) {
    if (isset($_POST['Name']) && $_POST['Name']!= null) {
        $stmt = $dbh->getInstance()->prepare('UPDATE users SET Name="'.$_POST['Name'].'"
        WHERE UserID="'.$_SESSION['UserID'].'"');
        $stmt->execute();
    }
    if (isset($_POST['Surname']) && $_POST['Surname']!= null) {
        $stmt = $dbh->getInstance()->prepare('UPDATE users SET Surname="'.$_POST['Surname'].'"
        WHERE UserID="'.$_SESSION['UserID'].'"');
        $stmt->execute();
    }

    if (isset($_POST['Country']) && $_POST['Country']!= null) {
        $stmt = $dbh->getInstance()->prepare('UPDATE users SET Country="'.$_POST['Country'].'"
        WHERE UserID="'.$_SESSION['UserID'].'"');
        $stmt->execute();
    }

    if (isset($_POST['City']) && $_POST['City']!= null) {
        $stmt = $dbh->getInstance()->prepare('UPDATE users SET City="'.$_POST['City'].'"
        WHERE UserID="'.$_SESSION['UserID'].'"');
        $stmt->execute();
    }

    if (isset($_POST['Address']) && $_POST['Address']!= null) {
        $stmt = $dbh->getInstance()->prepare('UPDATE users SET Address="'.$_POST['Address'].'"
        WHERE UserID="'.$_SESSION['UserID'].'"');
        $stmt->execute();
    }

    if (isset($_POST['PostalCode']) && $_POST['PostalCode']!= null) {
        $stmt = $dbh->getInstance()->prepare('UPDATE users SET PostalCode="'.$_POST['PostalCode'].'"
        WHERE UserID="'.$_SESSION['UserID'].'"');
        $stmt->execute();
    }

    if (isset($_POST['Email']) && $_POST['Email']!= null) {
        $stmt = $dbh->getInstance()->prepare('UPDATE users SET Email="'.$_POST['Email'].'"
        WHERE UserID="'.$_SESSION['UserID'].'"');
        $stmt->execute();
    }

    if (isset($_POST['PhoneNumber']) && $_POST['PhoneNumber']!= null) {
        $stmt = $dbh->getInstance()->prepare('UPDATE users SET PhoneNumber="'.$_POST['PhoneNumber'].'"
        WHERE UserID="'.$_SESSION['UserID'].'"');
        $stmt->execute();
    }

    if (isset($_POST['Password']) && $_POST['Password']!= null) {
        $stmt = $dbh->getInstance()->prepare('UPDATE users SET Password=:Password
        WHERE UserID="'.$_SESSION['UserID'].'"');
        $stmt->bindParam(':Password', $Password);
        $Password = password_hash($_POST['Password'], PASSWORD_DEFAULT);
        $stmt->execute();
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
    echo 'entrato';
    $target_dir = "/Applications/XAMPP/xamppfiles/htdocs/EZCUT/Images/UserImages/";
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
    if(isset($_POST["submit"])) {
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
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
    
       //chech if was onother image and cancel that first
       $stmt = $dbh->getInstance()->prepare("SELECT UserImageName FROM Users
        WHERE UserID =:UserID");
        $stmt->bindParam(':UserID', $UserID);
        $UserID = $_SESSION['UserID'];
        $stmt->execute();
        $row = $stmt->fetch();
        if($row){
        if($row['UserImageName']!=null)
        unlink($_SERVER['DOCUMENT_ROOT'].'/EZCUT/Images/UserImages/'.$row['UserImageName']);
        $stmt = $dbh->getInstance()->prepare('UPDATE users SET UserImageName=:ImageName
          WHERE UserID="'.$_SESSION['UserID'].'"');
          $stmt->bindParam(':ImageName', $ImageName);
          $ImageName=$newfilename;
          $stmt->execute();

        }else {
          $stmt = $dbh->getInstance()->prepare('UPDATE users SET UserImageName=:ImageName
          WHERE UserID="'.$_SESSION['UserID'].'"');
          $stmt->bindParam(':ImageName', $ImageName);
          $ImageName=$newfilename;
          $stmt->execute();
        }
    }
}

header('Location: AccountInformations.php');
exit;  
?>

</body>
</html>