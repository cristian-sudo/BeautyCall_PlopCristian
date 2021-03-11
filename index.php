<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
      <?php
    session_start();
       ?>
<h1>Welcome to EZCUT</h1>
<h3>Login or register yourself to our website and chose your fresh cut in your favorite hair salon!</h3>
<h1>Login</h1>
    <form action="/EZCUT/User/UserLogin.php" method="post">
      <label for="Username">Username</label>
      <input type="text" name="Username"><br>
      <label for="Password">Password
<?php
if (isset($_GET['id'])) {
 if ($_GET['id']=='falsepw') {
   echo "<h8 style='color:red'>*</h8>";
 }
}?>
     </label>
      <input type="Password" name="Password"><br>

      <input type="submit" value="Login">
    </form>
  <a href="/EZCUT/User/UserRegistration.php">Register</a>
  <br>
  <a href="/EZCUT/Administrator/AdministratorRegistration.php">Work with us</a>


    </body>
</html>
