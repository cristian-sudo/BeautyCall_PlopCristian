<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body class="jumbotron">
    <?php
    require('/Applications/XAMPP/xamppfiles/htdocs/EZCUT/Salon/Menu.php');
    $stmt = $dbh->getInstance()->prepare("SELECT * FROM OpeningTime WHERE AdministratorID='".$_SESSION['AdministratorID']."'");
    $stmt->execute();
    $row=$stmt;
   if ($row) {
      echo "<table>";
      foreach ($row as $key => $value) {
        echo "<tr><td>Monday</td>"."<td>".$value['Monday']."</td></tr>";
        echo "<tr><td>Tuesday</td>"."<td>".$value['Tuesday']."</td></tr>";
        echo "<tr><td>Wednesday</td>"."<td>".$value['Wednesday']."</td></tr>";
        echo "<tr><td>Thursday</td>"."<td>".$value['Thursday']."</td></tr>";
        echo "<tr><td>Friday</td>"."<td>".$value['Friday']."</td></tr>";
        echo "<tr><td>Saturday</td>"."<td>".$value['Saturday']."</td></tr>";
        echo "<tr><td>Sunday</td>"."<td>".$value['Sunday']."</td></tr>";}
      echo "</table>";
      /////////////////////////////////////////////////////////////////////////////////////////////
      echo '
      <form action="/EZCUT/Salon/ManageOpeningTime.php" method="post">
      <h1>OpeningTime</h1>
      <label for="MondayOpen">Monday</label>
      <input type="time" name="MondayOpen" required>
      <label for="MondayClosing">-</label>
      <input type="time" name="MondayClosing" required><br>

      <label for="TuesdayOpen">Tuesday</label>
      <input type="time" name="TuesdayOpen" required>
      <label for="TuesdayClosing">-</label>
      <input type="time" name="TuesdayClosing" required><br>

      <label for="WednesdayOpen">Wednesday</label>
      <input type="time" name="WednesdayOpen" required>
      <label for="WednesdayClosing">-</label>
      <input type="time" name="WednesdayClosing" required><br>

      <label for="ThursdayOpen">Thursday</label>
      <input type="time" name="ThursdayOpen" required>
      <label for="ThursdayClosing">-</label>
      <input type="time" name="ThursdayClosing" required><br>

      <label for="FridayOpen">Friday</label>
      <input type="time" name="FridayOpen" required>
      <label for="FridayClosing">-</label>
      <input type="time" name="FridayClosing" required><br>

      <label for="SaturdayOpen">Saturday</label>
      <input type="time" name="SaturdayOpen" required>
      <label for="SaturdayClosing">-</label>
      <input type="time" name="SaturdayClosing" required><br>

      <label for="SundayOpen">Sunday</label>
      <input type="time" name="SundayOpen" required>
      <label for="SundayClosing">-</label>
      <input type="time" name="SundayClosing" required><br>

      <input type="submit" name="submit" value="Modifica" >
      </form>';
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
  }}
  ?>
  </body>
</html>
