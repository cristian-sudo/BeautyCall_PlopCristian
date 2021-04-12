<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
      <?php
    require('/Applications/XAMPP/xamppfiles/htdocs/EZCUT/User/UserMenu.php');
    $today = date("Y-m-d");
echo '
<div class="container-fluid">
    <div class="row">
        <div class="col">
                <form method="post" action="/EZCUT/User/Serviceview.php?ServicePass='.$_GET['ServicePass'].'&Salonview='.$_GET['Salonview'].'&Categoryview='.$_GET['Categoryview'].'">
                    <br><br><br><br><br><br>
                    <div class="form-group row">
                        <label for="example-date-input" class="col-4 col-form-label">Insert the date you want to book</label>
                        <div class="col-4">
                        <input class="form-control" type="date" value="'.$today.'" id="example-date-input min="'.$today.'" name="date">
                        <button class="btn btn-primary " name="submit" type="submit">
                                Confirm
                        </button>
                        </div>
                    </div>
                </form>
         </div>
    </div>
</div>
    ';
    ?>

<!-- Include jQuery -->

  </body>
</html>

