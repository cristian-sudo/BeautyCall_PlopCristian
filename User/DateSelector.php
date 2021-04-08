<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
      <?php
    require('/Applications/XAMPP/xamppfiles/htdocs/EZCUT/User/UserMenu.php');
    echo '
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
    <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" /> 
    
    <!--Font Awesome (added because you use icons in your prepend/append)-->
    <link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />
    
    <!-- Inline CSS based on choices in "Settings" tab -->
    <style>.bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso form{font-family: Arial, Helvetica, sans-serif; color: black}.bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} .asteriskField{color: red;}</style>
    
    <!-- HTML Form (wrapped in a .bootstrap-iso div) -->
    <div class="bootstrap-iso" id="DataSelectorDiv">
     <div class="container-fluid">
      <div class="row">
       <div class="col-md-6 col-sm-6 col-xs-12">
        <form method="post" action="/EZCUT/User/Serviceview.php?ServicePass='.$_GET['ServicePass'].'&Salonview='.$_GET['Salonview'].'&Categoryview='.$_GET['Categoryview'].'">
         <div class="form-group ">
          <label class="control-label " for="date">
           <span id ="ChoseDate">Chose a day you want to book:</span>
          </label>
          <div class="input-group">
           <div class="input-group-addon">
            <i class="fa fa-calendar">
            </i>
           </div>
           <input required class="form-control" id="date" name="date" placeholder="YYYY/MM/DD" type="text"/>
          </div>
         </div>
         <div class="form-group">
          <div>
           <button class="btn btn-primary " name="submit" type="submit">
            Confirm
           </button>
          </div>
         </div>
        </form>
       </div>
      </div>
     </div>
    </div>
            </div>
        </div>
    </div>';
    ?>

<!-- Include jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<!-- Include Date Range Picker -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<script>
    $(document).ready(function(){
        var date_input=$('input[name="date"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy/mm/dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
    })
</script>
  </body>
</html>
