<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    require('/Applications/XAMPP/xamppfiles/htdocs/EZCUT/conessione/DBHandler.php');
    require('/Applications/XAMPP/xamppfiles/htdocs/EZCUT/conessione/DBHandlerObject.php');
     ?>
    <h1>User registration</h1>
    <form action="/EZCUT/User/UserRegistration.php" method="post">
      <label for="Name">Name</label>
      <input type="text" name="Name" required><br>
      <label for="Surname">Surname</label>
      <input type="text" name="Surname" required><br>
      <label for="Username">Username</label>
      <input type="text" name="Username" required><br>
      <label for="Password">Password</label>
      <input type="text" name="Password" required><br>
      <label for="Country">Country</label>
      <input type="text" name="Country" required><br>
      <label for="City">City</label>
      <input type="text" name="City" required><br>
      <label for="Address">Address</label>
      <input type="text" name="Address" required><br>
      <label for="PostalCode">PostalCode</label>
      <input type="text" name="PostalCode" required><br>
      <label for="Email">Email</label>
      <input type="email" name="Email" required><br>
      <label for="PhoneNumber">PhoneNumber</label>
      <input type="text" name="PhoneNumber" required><br>
      <input type="submit" name="submit" value="Invia" >
    </form>
      <a href="/EZCUT/index.php">Log in</a>
  </body>
</html>

<?php
    if (isset($_POST['submit'])) {
            $stmt = $dbh->getInstance()->prepare("INSERT INTO users(Name, Surname, Username, Password, Country, City, Address, PostalCode, Email, PhoneNumber)
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
            $_SESSION["Name"]=$_POST['Name'];
            header('Location: HomePage.php');
            exit;
          }
?>
