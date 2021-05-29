<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta charset="UTF-8">
        <style media="screen">
<?php require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/styles2.css');?>
 </style>
    <title></title>
  </head>
  <body>
  <form action="UserInformationsConfirm.php" method="post">
  <div class="container">
    <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <label for="Name">Name</label>
     <input type="text" name="Name" placeholder='Name' class='input-line full-width' required><br>
     <label for="Surname">Surname</label>
     <input type="text" name="Surname"  placeholder='Surname' class='input-line full-width' required><br>
     <label for="Username">Username</label>
     <input type="text" name="Username" placeholder='Username' class='input-line full-width' required><br>
     <label for="Password">Password</label>
     <input type="text" name="Password" placeholder='Password' class='input-line full-width' required><br>
     <label for="Country">Country</label>
     <input type="text" name="Country"  placeholder='Country' class='input-line full-width' required><br>
     <label for="City">City</label>
     <input type="text" name="City" placeholder='City' class='input-line full-width' required><br>
     <label for="Address">Address</label>
     <input type="text" name="Address"  placeholder='Address' class='input-line full-width' required><br>
     <label for="PostalCode">PostalCode</label>
     <input type="text" name="PostalCode" placeholder='Postal Code' class='input-line full-width' required><br>
     <label for="text">Email</label>
     <input type="text" name="Email" placeholder='Email' class='input-line full-width' required><br>
     <label for="PhoneNumber">PhoneNumber</label>
     <input type="text" name="PhoneNumber" placeholder='Phone Number' class='input-line full-width' required><br>
    <hr>
    <button type="submit" class="registerbtn" name="submit">Register</button>
  </div>
  <div class="container signin">
    <p>Already have an account? <a href="/EZCUT/index.php">Sign in</a>.</p>
  </div>
</form>
  </body>
</html>




