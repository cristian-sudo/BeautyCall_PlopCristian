<?php
session_start();
 require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/conessione/DBHandler.php');
 require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/conessione/DBHandlerObject.php');
 print_r($_POST);

        if (isset($_POST['submit'])) {
                $stmt = $dbh->getInstance()->prepare("INSERT INTO administrators(AdministratorName, AdministratorSurname, Username, Password, Country, City, Address, PostalCode, Email, PhoneNumber)
                        values(:Name, :Surname, :Username, :Password, :Country, :City, :Address, :PostalCode, :Email, :PhoneNumber)");
                $stmt->bindParam(':Name', $Name);
                $stmt->bindParam(':Surname', $Surname);
                $stmt->bindParam(':Username', $Username);
                $stmt->bindParam(':Password', $Password);
                $stmt->bindParam(':Country', $Country);
                $stmt->bindParam(':City', $City);
                $stmt->bindParam(':Address', $Address);
                $stmt->bindParam(':PostalCode', $PostalCode);
                $stmt->bindParam(':Email', $Email);
                $stmt->bindParam(':PhoneNumber', $PhoneNumber);

                $Name = $_POST['Name'];
                $Surname = $_POST['Surname'];
                $Username = $_POST['Username'];
                $_SESSION["AdministratorUsername"]=$_POST['Username'];
                $Password = password_hash($_POST['Password'], PASSWORD_DEFAULT);
                $Country = $_POST['Country'];
                $City = $_POST['City'];
                $Address = $_POST['Address'];
                $PostalCode = $_POST['PostalCode'];
                $Email = $_POST['Email'];
                $PhoneNumber = $_POST['PhoneNumber'];
                $stmt->execute();
                $_SESSION["AdministratorName"]=$_POST['Name'];
    


                if(isset($_FILES['fileToUpload'])){
                    echo 'entrato';
                    $target_dir = "/Applications/XAMPP/xamppfiles/htdocs/EZCUT/Images/AdministratorImages/";
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
                       $stmt = $dbh->getInstance()->prepare("SELECT administratorImage FROM administrators
                        WHERE Username =:Username");
                        $stmt->bindParam(':Username', $Username);
                        $Username = $_POST['Username'];
                        $stmt->execute();
                        $row = $stmt->fetch();
                        if($row){
                        if($row['administratorImage']!=null)
                        unlink($_SERVER['DOCUMENT_ROOT'].'/EZCUT/Images/AdministratorImages/'.$row['administratorImage']);
                        $stmt = $dbh->getInstance()->prepare('UPDATE administrators SET administratorImage=:administratorImage
                          WHERE Username=:Username');
                          $stmt->bindParam(':Username', $Username);
                          $stmt->bindParam(':administratorImage', $administratorImage);
                          $Username=$_POST['Username'];
                          $administratorImage=$newfilename;
                          $stmt->execute();
                
                        }else {
                            $stmt = $dbh->getInstance()->prepare('UPDATE administrators SET administratorImage=:administratorImage
                            WHERE Username=:Username');
                            $stmt->bindParam(':Username', $Username);
                            $stmt->bindParam(':administratorImage', $administratorImage);
                            $Username=$_POST['Username'];
                            $administratorImage=$newfilename;
                            $stmt->execute();
                        }
                    }
                    header('Location: /EZCUT/Salon/SalonRegistration.php');
                    exit;

              }
    ?>