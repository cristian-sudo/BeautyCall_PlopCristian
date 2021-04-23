    <!DOCTYPE html>
    <html lang="en" dir="ltr">
      <body>
        <?php
          require_once($_SERVER['DOCUMENT_ROOT'].'/EZCUT/header.php');
          ?>
        <h1>Regist your salon</h1>
        <form action="/EZCUT/Salon/SalonRegistration.php" method="post">
          <label for="Name">Name</label>
          <input type="text" name="Name"><br>
          <label for="Country">Country</label>
          <input type="text" name="Country"><br>
          <label for="City">City</label>
          <input type="text" name="City"><br>
          <label for="Address">Address</label>
          <input type="text" name="Address"><br>
          <label for="PostalCode">PostalCode</label>
          <input type="text" name="PostalCode"><br>
          <label for="Email">Email</label>
          <input type="email" name="Email"><br>
          <label for="PhoneNumber">PhoneNumber</label>
          <input type="text" name="PhoneNumber"><br>
          <label for="ShortDescription">PhoneNumber</label>
          <input type="text" name="ShortDescription"><br>
          <h1>OpeningTimes</h1>
          <label for="MondayOpen">Monday</label>
          <input type="time" name="MondayOpen">
          <label for="MondayClosing"></label>
          <input type="time" name="MondayClosing"><br>

          <label for="TuesdayOpen">Tuesday</label>
          <input type="time" name="TuesdayOpen">
          <label for="TuesdayClosing"></label>
          <input type="time" name="TuesdayClosing"><br>

          <label for="WednesdayOpen">Wednesday</label>
          <input type="time" name="WednesdayOpen">
          <label for="WednesdayClosing"></label>
          <input type="time" name="WednesdayClosing"><br>

          <label for="ThursdayOpen">Thursday</label>
          <input type="time" name="ThursdayOpen">
          <label for="ThursdayClosing"></label>
          <input type="time" name="ThursdayClosing"><br>

          <label for="FridayOpen">Friday</label>
          <input type="time" name="FridayOpen">
          <label for="FridayClosing"></label>
          <input type="time" name="FridayClosing"><br>

          <label for="SaturdayOpen">Saturday</label>
          <input type="time" name="SaturdayOpen">
          <label for="SaturdayClosing"></label>
          <input type="time" name="SaturdayClosing"><br>

          <label for="SundayOpen">Sunday</label>
          <input type="time" name="SundayOpen">
          <label for="SundayClosing"></label>
          <input type="time" name="SundayClosing"><br>

          <input type="submit" name="submit" value="Invia" >
        </form>


    <?php
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

  </body>
</html>
