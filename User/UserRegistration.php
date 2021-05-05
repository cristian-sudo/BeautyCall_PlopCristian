<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta charset="UTF-8">
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




