<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <!DOCTYPE html>
    <html lang="en" dir="ltr">
      <head>
        <meta charset="utf-8">
        <title></title>
      </head>
      <style media="screen">
<?php require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/styles2.css');?>
 </style>
      <body>


      <form action="AdministratorConfirm.php" method="post" enctype="multipart/form-data">
  <div class="container">
    <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>

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
          <input type="text" name="Email" required><br>
          <label for="PhoneNumber">PhoneNumber</label>
          <input type="text" name="PhoneNumber" required><br>

          <label for="ProfileImage">Profile image:</label>
          <input type="file"  name="fileToUpload" required  id="ProfileImage"><br>
    <hr>
    

    <button type="submit" class="registerbtn" name="submit">Register as administrator.</button>
  </div>
  
 
</form>

  </body>
</html>
