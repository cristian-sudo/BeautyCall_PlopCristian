<?php
session_start();
require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/conessione/DBHandler.php');
require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/conessione/DBHandlerObject.php');
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
            $_SESSION['Username']=$Username;
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