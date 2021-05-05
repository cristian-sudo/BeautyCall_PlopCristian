<?php
         session_start();
         require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/conessione/DBHandler.php');
         require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/conessione/DBHandlerObject.php');
      if (isset($_POST["Name"])) {
///////////////////////////////////////////////
          $stmt = $dbh->getInstance()->prepare("SELECT AdministratorID FROM Administrators WHERE AdministratorName ='".$_SESSION['AdministratorName']."'");
          $stmt->execute();
          $row = $stmt->fetch();
          $_SESSION['AdministratorID']=$row['AdministratorID'];
 /////////////////////////////////////////////
 $stmt = $dbh->getInstance()->prepare("INSERT INTO OpeningTime(Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday,AdministratorID)
         values(:Monday,:Tuesday,:Wednesday,:Thursday,:Friday,:Saturday,:Sunday,:AdministratorID)");
         $stmt->bindParam(':Monday', $Monday);
         $stmt->bindParam(':Tuesday', $Tuesday);
         $stmt->bindParam(':Wednesday', $Wednesday);
         $stmt->bindParam(':Thursday', $Thursday);
         $stmt->bindParam(':Friday', $Friday);
         $stmt->bindParam(':Saturday', $Saturday);
         $stmt->bindParam(':Sunday', $Sunday);
         $stmt->bindParam(':AdministratorID', $AdministratorID);
         $Monday = $_POST['MondayOpen']."-".$_POST['MondayClosing'];
         $Tuesday = $_POST['TuesdayOpen'] . "-" . $_POST['TuesdayClosing'];
         $Wednesday = $_POST['WednesdayOpen']."-".$_POST['WednesdayClosing'];
         $Thursday = $_POST['ThursdayOpen']."-".$_POST['ThursdayClosing'];
         $Friday = $_POST['FridayOpen']."-".$_POST['FridayClosing'];
         $Saturday = $_POST['SaturdayOpen']."-".$_POST['SaturdayClosing'];
         $Sunday = $_POST['SundayOpen']."-".$_POST['SundayClosing'];
         $AdministratorID = $_SESSION['AdministratorID'];
        $stmt->execute();

//////////////////////////////////////////////
        $stmt = $dbh->getInstance()->prepare("SELECT OpeningTimeID FROM OpeningTime WHERE AdministratorID ='".$_SESSION['AdministratorID']."'");
        $stmt->execute();
        $row1 = $stmt->fetch();
        $_SESSION['OpeningTimeID']=$row1['OpeningTimeID'];

                $stmt = $dbh->getInstance()->prepare("INSERT INTO hairdressingsalons(Name, Country, City, Address, PostalCode,ShortDescription, Email, PhoneNumber, AdministratorID, OpeningTimeID,Status)
                        values(:Name, :Country, :City, :Address, :PostalCode,:ShortDescription,:Email, :PhoneNumber, :AdministratorID, :OpeningTimeID, :Status)");
                $stmt->bindParam(':Name', $Name);
                $stmt->bindParam(':Country', $Country);
                $stmt->bindParam(':City', $City);
                $stmt->bindParam(':Address', $Address);
                $stmt->bindParam(':PostalCode', $PostalCode);
                $stmt->bindParam(':Email', $Email);
                $stmt->bindParam(':PhoneNumber', $PhoneNumber);
                $stmt->bindParam(':ShortDescription', $ShortDescription);
                $stmt->bindParam(':AdministratorID', $AdministratorID);
                $stmt->bindParam(':OpeningTimeID', $OpeningTimeID);
                $stmt->bindParam(':Status', $Status);

                $Name = $_POST['Name'];
                $Country = $_POST['Country'];
                $City = $_POST['City'];
                $Address = $_POST['Address'];
                $PostalCode = $_POST['PostalCode'];
                $Email = $_POST['Email'];
                $PhoneNumber = $_POST['PhoneNumber'];
                $ShortDescription = $_POST['ShortDescription'];
                $AdministratorID = $_SESSION['AdministratorID'];
                $OpeningTimeID = $_SESSION['OpeningTimeID'];
                $Status = "Non Confermato";
                $stmt->execute();
                header('Location: HomePageSalon.php');
              };
    ?>