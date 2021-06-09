<?php
     require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/User/UserMenu.php');
?>
<div id="HomePageCategories"> Account informations</div>
<div class="container-fluid">
<div class="AccountInfo">
<table class="tableaccount">
<tr>
     <td>Name:</td>
     <td><?php echo $_SESSION['Name'] ?></td>
     <form action="ModifyUserInfo.php" method="post">
     <td><input type="text" name="Name"></td>

     
     <td><input type="submit" value="Confirm" name="Confirm"></td>
     </form>
</tr>

<tr>
     <td>Surname:</td>
     <td><?php echo $_SESSION['Surname'] ?></td>
     <form action="ModifyUserInfo.php" method="post">
     <td><input type="text" name="Surname"></td>
     <td><input type="submit" value="Confirm" name="Confirm"></td>
     </form>
</tr>

<tr>
     <td>Country:</td>
     <td><?php echo $_SESSION['Country'] ?></td>
     <form action="ModifyUserInfo.php" method="post">
     <td><input type="text" name="Country"></td>
     <td><input type="submit" value="Confirm" name="Confirm"></td>
     </form>
</tr>

<tr>
     <td>City:</td>
     <td><?php echo $_SESSION['City'] ?></td>
     <form action="ModifyUserInfo.php" method="post">
     <td><input type="text" name="City"></td>
     <td><input type="submit" value="Confirm" name="Confirm"></td>
     </form>
</tr>

<tr>
     <td>Address:</td>
     <td><?php echo $_SESSION['Address'] ?></td>
     <form action="ModifyUserInfo.php" method="post">
     <td><input type="text" name="Address"></td>
     <td><input type="submit" value="Confirm" name="Confirm"></td>
     </form>
</tr>

<tr>
     <td>Postal Code:</td>
     <td><?php echo $_SESSION['PostalCode'] ?></td>
     <form action="ModifyUserInfo.php" method="post">
     <td><input type="text" name="PostalCode"></td>
     <td><input type="submit" value="Confirm" name="Confirm"></td>
     </form>
</tr>

<tr>
     <td>Email:</td>
     <td><?php echo $_SESSION['Email'] ?></td>
     <form action="ModifyUserInfo.php" method="post">
     <td><input type="email" name="Email"></td>
     <td><input type="submit" value="Confirm" name="Confirm"></td>
     </form>
</tr>

<tr>
     <td>Phone Number:</td>
     <td><?php echo $_SESSION['PhoneNumber'] ?></td>
     <form action="ModifyUserInfo.php" method="post">
     <td><input type="number" name="PhoneNumber"></td>
     <td><input type="submit" value="Confirm" name="Confirm"></td>
     </form>
</tr>


<tr>
     <td>Change password:</td>
     <td></td>
     <form action="ModifyUserInfo.php" method="post">
     <td><input type="text" name="Password"></td>
     <td><input type="submit" value="Confirm" name="Confirm"></td>
     </form>
</tr>



<tr>
     <td>Profile Image:</td>
     <td></td>
     <form action="ModifyUserInfo.php" method="post" enctype="multipart/form-data">
     <td><input type="file" name="fileToUpload" id="fileToUpload"></td>
     <td><input type="submit" value="Confirm" name="Confirm"></td>
     </form>
</tr>
</table>
</div>
</div>

     </body>
     </html>