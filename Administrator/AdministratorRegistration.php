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
body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: black;
}

* {
  box-sizing: border-box;
}

/* Add padding to containers */
.container {
  padding: 16px;
  background-color: white;
}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input {
  background-color: #ddd;
  outline: none;
}



/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit button */
.registerbtn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.registerbtn:hover {
  opacity: 1;
}

/* Add a blue text color to links */
a {
  color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
  background-color: #f1f1f1;
  text-align: center;
}
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
