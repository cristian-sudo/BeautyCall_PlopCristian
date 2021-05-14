
      <?php
    require($_SERVER['DOCUMENT_ROOT'].'/EZCUT/User/UserMenu.php');
    $today = date("Y-m-d");
    $MaxDay=date('Y-m-d', strtotime($today. ' + 10 days'))
      ?>
<div class="container-fluid">
<div class="row">


<div class="col-md-4">
<img  src="https://media.istockphoto.com/vectors/black-line-calendar-with-check-mark-icon-isolated-on-white-background-vector-id1226363456?k=6&m=1226363456&s=612x612&w=0&h=zcOS4F8tjbO5be78K4NykoDHHa03tCOkU_5z86-R4yk=" class="img-fluid">


</div>

<div class="col-md-5 formDate ">
    <?php
echo '

                            <span class="MyBB">Chose the day:</span>



                <form  method="post" action="/EZCUT/User/Serviceview.php?ServicePass='.$_GET['ServicePass'].'&Salonview='.$_GET['Salonview'].'&Categoryview='.$_GET['Categoryview'].'">
                     
                            <input class="form-control DataStyle" type="date" value="'.$today.'" min="'.$today.'"   max="'.$MaxDay.'"   name="date">
                            <div class="MyBB">
                            <button class="btn btn-primary " name="submit" type="submit">
                                    Confirm
                            </button>
                        </div>
                    
                </form>
        

    ';
    ?>


</div>




</div>
</div>
</body>
</html>



  
