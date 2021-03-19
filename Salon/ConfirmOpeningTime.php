<?php
    require('/Applications/XAMPP/xamppfiles/htdocs/EZCUT/Salon/Menu.php');
    if(isset($_POST['submit'])){
      $stmt = $dbh->getInstance()->prepare("UPDATE OpeningTime SET
        Monday=:Monday,
        Tuesday=:Tuesday,
        Wednesday=:Wednesday,
        Thursday=:Thursday,
        Friday=:Friday,
        Saturday=:Saturday,
        Sunday=:Sunday
        WHERE AdministratorID=:AdministratorID
      ");
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
            header('Location: /EZCUT/Salon/ManageOpeningTime.php');
    }

 ?>
