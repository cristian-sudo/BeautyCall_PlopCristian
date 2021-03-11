<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      require_once('/Applications/XAMPP/xamppfiles/htdocs/EZCUT/header.php');
      ?>
    <!DOCTYPE html>
    <html lang="en" dir="ltr">
      <head>
        <meta charset="utf-8">
        <title></title>
      </head>
      <body>
        <h1>Registrazion Administrator</h1>
        <form action="/EZCUT/Administrator/AdministratorRegistration.php" method="post">
          <label for="Name">Name</label>
          <input type="text" name="Name"><br>
          <label for="Surname">Surname</label>
          <input type="text" name="Surname"><br>
          <label for="Username">Username</label>
          <input type="text" name="Username"><br>
          <label for="Password">Password</label>
          <input type="text" name="Password"><br>
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
          <input type="submit" name="submit" value="Invia" >
        </form>
      </body>
    </html>

    <?php
      require_once('/Applications/XAMPP/xamppfiles/htdocs/EZCUT/header.php');
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
                $Password = password_hash($_POST['Password'], PASSWORD_DEFAULT);
                $Country = $_POST['Country'];
                $City = $_POST['City'];
                $Address = $_POST['Address'];
                $PostalCode = $_POST['PostalCode'];
                $Email = $_POST['Email'];
                $PhoneNumber = $_POST['PhoneNumber'];
                $stmt->execute();
                $_SESSION["AdministratorName"]=$_POST['Name'];
                header('Location: /EZCUT/Salon/SalonRegistration.php');
              }
    ?>

  </body>
</html>
