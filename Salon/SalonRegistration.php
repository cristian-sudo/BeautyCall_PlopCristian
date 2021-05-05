    <!DOCTYPE html>
    <html lang="en" dir="ltr">
      <head>
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
input[type=text], input[type=password], input[type=number],  input[type=email] {
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
  </head>
      <body>
           <form action="SalonRegistrationConfirm.php" method="post" enctype="multipart/form-data">
  <div class="container">
    <h1>Register your salon</h1>
    <p>Please fill in this form to create your salon.</p>
    <hr>

        <form action="/EZCUT/Salon/SalonRegistration.php" method="post">
          <label for="Name">Name</label>
          <input type="text" name="Name" required><br>
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
          <label for="ShortDescription">PhoneNumber</label>
          <input type="text" name="ShortDescription" required><br>
          <p>Put the opening time for your salon</p>

<table>
<tr><td>
          <label for="MondayOpen">Monday</label>
<td><td>
          <input type="time" name="MondayOpen" required>
<td><td>
          <label for="MondayClosing"></label>
          <input type="time" name="MondayClosing" required><br>
<td></tr>

<tr><td>
          <label for="TuesdayOpen">Tuesday</label>
<td><td>
          <input type="time" name="TuesdayOpen" required>
<td><td>
          <label for="TuesdayClosing"></label>
          <input type="time" name="TuesdayClosing" required><br>
<td>
</tr>

  <tr>
  <td>

          <label for="WednesdayOpen">Wednesday</label>
          <td>
<td>
          <input type="time" name="WednesdayOpen" required>
          <td>
<td>
          <label for="WednesdayClosing"></label>
          <input type="time" name="WednesdayClosing" required><br>
<td>
</tr>

  <tr>
  <td>
          <label for="ThursdayOpen">Thursday</label>
          <td>
<td>
          <input type="time" name="ThursdayOpen" required>
          <td>
<td>
          <label for="ThursdayClosing"></label>
          <input type="time" name="ThursdayClosing" required><br>
<td>
</tr>

  <tr>
  <td>
          <label for="FridayOpen">Friday</label>
          <td>
<td>
          <input type="time" name="FridayOpen" required>
          <td>
<td>
          <label for="FridayClosing"></label>
          <input type="time" name="FridayClosing" required><br>
<td>
</tr>

  <tr>
  <td>
          <label for="SaturdayOpen">Saturday</label>
          <td>
<td>
          <input type="time" name="SaturdayOpen" required>
<td>
<td>
          <label for="SaturdayClosing"></label>
          <input type="time" name="SaturdayClosing" required><br>
<td>
</tr>

  <tr>
  <td>
          <label for="SundayOpen">Sunday</label>
          <td>
<td>
          <input type="time" name="SundayOpen" required>
          <td>
<td>
          <label for="SundayClosing"></label>
          <input type="time" name="SundayClosing" required><br>
<td>
</tr>
</table>
<p>Put some general photos of your salon:</p>
          <button type="submit"  name="submit">Register as administrator.</button>
        </form>
        <hr>
  </div>

  

  </body>
</html>
